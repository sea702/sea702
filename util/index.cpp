#include "index.h"
#define MAX_SCORE 10000000

int Index::AddIndex(string url, string title, string content) {
  vector<string> title_term_vector;
  vector<string> content_term_vector;
  
  SegText(title, title_term_vector);
  SegText(content, content_term_vector);

  hash_map<string, TermHitUrlNode, str_hash> term_table;
  for (int i = 0; i < (int)title_term_vector.size(); ++i) {
    term_table[title_term_vector[i]].hit_title_pos.push_back(i);
    term_table[title_term_vector[i]].url = url;
  }

  hash_map<string, TermHitUrlNode, str_hash>::iterator it;
  for (it = term_table.begin(); it != term_table.end(); ++it) {
    TermHitUrlNode cur_hit;
    cur_hit.url = it->second.url;
    cur_hit.hit_title_pos = it->second.hit_title_pos;
    index_table[it->first].push_back(cur_hit);
  }

  attachment_table[url].title = title;

  return 0;
}

int Index::BuildIndex(const char *path) {
  FILE *fp = fopen(path, "r");
  if (fp == NULL) {
    return -1;
  }

  char line[10000];
  string url, title;
  int count = 0;

  while (fgets(line, sizeof(line), fp) != NULL) {
    int len = strlen(line);
    if (line[len - 1] == '\n') {
      line[len - 1] = '\0';
      --len;
    }

    if (strstr(line, "url") == line) {
      url = string(line + 4);
    } else if (strstr(line, "title") == line) {
      title = string(line + 6);
      AddIndex(url, title, "");
      ++count;
      if (count % 2000 == 1) {
        fprintf(stderr, "build %d docs\n", count);
      }
    }
//    if (count > 10000)break;
  }
  
  return 0;
}

int Index::ScoreDoc(Query query, ResultNode query_hit_url) {
  hash_map<string, int, str_hash> query_map, hit_map;
  hash_map<string, int, str_hash> term_near_map;

  /* 统计query中的总term数量、不相同term数量 */
  int diff_term_num, total_term_num;
  diff_term_num = 0;
  total_term_num = query.query_term_vec.size();
  for (int i = 0; i < total_term_num; ++i) {
    if (query_map.find(query.query_term_vec[i]) == query_map.end()) {
      ++diff_term_num;
      query_map[query.query_term_vec[i]] = 1;
    } else {
      ++query_map[query.query_term_vec[i]];
    }
    string cur_str = query.query_term_vec[i];
    for (int j = i + 1; j < total_term_num; ++j) {
      cur_str = cur_str + query.query_term_vec[j];
      term_near_map[cur_str] = 1;
    }
  }

  /* 统计hit的总term数量、不相同term数量 */
  int hit_diff_term_num, hit_total_term_num;
  hit_diff_term_num = 0;
  hit_total_term_num = query_hit_url.hit_vec.size();
  for (int i = 0; i < query_hit_url.hit_vec.size(); ++i) {
    Term cur_term = query_hit_url.hit_vec[i];
    if (hit_map.find(cur_term.term) == hit_map.end()) {
      ++hit_diff_term_num;
      hit_map[cur_term.term] = 1;
    } else {
      ++hit_map[cur_term.term];
    }
  }

  double score = 0, perfect_score = 0;
  score += 1000 * (hit_diff_term_num / (double)diff_term_num);
  perfect_score = 1000;

  for (int i = 1; i < query_hit_url.hit_vec.size(); ++i) {
    if (query_hit_url.hit_vec[i].pos == query_hit_url.hit_vec[i - 1].pos + 1) {
      string cur_str = query_hit_url.hit_vec[i - 1].term + query_hit_url.hit_vec[i].term;
      if (term_near_map.find(cur_str) != term_near_map.end()) {
        score *= 1.2;
        term_near_map.erase(cur_str);
      }
      perfect_score *= 1.2;
    }
  }
  return (int)(score/perfect_score * 1000);
}

int Index::SearchIndex(string keyword) {
  Query search_query;
  hash_map<string, ResultNode, str_hash> result_table;
  vector<ResultNode> result_vector;

  search_query.raw_query = keyword;
  SegText(keyword, search_query.query_term_vec);

  /* 将所有hit信息以url为key存储起来 */
  for (int i = 0; i < search_query.query_term_vec.size(); ++i) {
    /* query中的term */
    string term = search_query.query_term_vec[i];

    /* 获取term对应的url列表 */
    for (int j = 0; j < index_table[term].size(); ++j) {
      Term cur_term;
      TermHitUrlNode cur_term_hit_url_node;

      cur_term_hit_url_node = index_table[term][j];
      for (int k = 0; k < cur_term_hit_url_node.hit_title_pos.size(); ++k) {
        cur_term.pos = cur_term_hit_url_node.hit_title_pos[k];
        cur_term.term = term;
        if (i > 0 && result_table.find(cur_term_hit_url_node.url) == result_table.end()) {
          ;
        } else {
          result_table[cur_term_hit_url_node.url].url = cur_term_hit_url_node.url;
          result_table[cur_term_hit_url_node.url].hit_vec.push_back(cur_term);
        }
      }
    }
  }

  int max_hit_length = 0;
  /* 存储到result_vector数组，打分、排序，作为最后的结果 */
  hash_map<string, ResultNode, str_hash>::iterator it;
  for (it = result_table.begin(); it != result_table.end(); ++it) {
    /* 所有term按命中位置排序 */
    sort(it->second.hit_vec.begin(), it->second.hit_vec.end(), cmp_term);
    if (it->second.hit_vec.size() > max_hit_length) max_hit_length = it->second.hit_vec.size();
    /* query->url的打分 */
    it->second.score = ScoreDoc(search_query, it->second);
    /* 放入结果数组 */
    result_vector.push_back(it->second);
  }
  /* 按score从大到小排序，数组记录分数、url、hit信息 */
  sort(result_vector.begin(), result_vector.end(), cmp_result_node);

  /* 多余代码，打印结果 */
  int result_cnt = 0;
  for (int i = 0; i < result_vector.size(); ++i) {
    ResultNode cur_result_node = result_vector[i];
    if (cur_result_node.score >= 700) {
      ++result_cnt;
    } else {
      break;
    }
  }

  if (result_cnt < 5) return 0;

  const int print_cnt = 20;
  printf("query:%s\n", search_query.raw_query.c_str());
  for (int i = 0; i < result_cnt; ++i) {
    if (i >= print_cnt) {
      break;
    }
    ResultNode cur_result_node = result_vector[i];
    printf("title:%s\nID:%s\nscore:%d\n\n", attachment_table[cur_result_node.url].title.c_str(),
      cur_result_node.url.c_str(), cur_result_node.score);
  }
  
  return 0;
}

/* 返回连着的字母/数字长度 */
int is_alphabet(string str, int start) {
  int len = 0;
  char c = str[start + len];
  while ((c >= 'a' && c <= 'z') || (c >= 'A' && c <= 'Z') || c >= '0' && c <= '9') {
    ++len;
    c = str[start + len];
    if (start + len >= (int)str.size()) {
      break;
    }
  }
  return len;
}

int Index::SegText(string text, vector<string> &seg_vec) {
  int text_pos;
  int word_len;
  
  text_pos = 0;

  while (text_pos < text.size()) {
    word_len = is_alphabet(text, text_pos);

    /* 不是英文串，就按最长匹配切 */
    if (word_len == 0) {
      word_len = worddict.match(text.c_str() + text_pos);
    }

    /* 无法匹配，安utf8字节切 */
    char t_char = text[text_pos];
    if (word_len == 0) {
      if ((char)(t_char & 0x80) == (char)0x0) {
        word_len = 1;
      } else if ((char)(t_char & 0xe0) == (char)0xc0) {
        word_len = 2;
      } else if ((char)(t_char & 0xf0) == (char)0xe0) {
        word_len = 3;
      } else {
        word_len = 1;
      }
    }

    string word;
    while (word_len--) {
      word += text[text_pos++];
    }

    // 过滤掉空格
    if (word.size() == 1 && word[0] == ' ') {
      continue;
    }
    seg_vec.push_back(word);
  }

  return 0;
}

int main() {
  Index Ind;
  Ind.BuildIndex("./input.txt");

  char keyword[10000];
  int count = 0;
  while (fgets(keyword, sizeof(keyword), stdin) != NULL) {
    int len = strlen(keyword);
    keyword[len - 1] = '\0';
    Ind.SearchIndex(string(keyword));
    ++count;
    if (count % 10 == 1) fprintf(stderr, "%d querys had done\n", count);
  }

  return 0;
}
