#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <string>
#include <vector>
#include <algorithm>
#include <ext/hash_map>
using namespace std;
using namespace __gnu_cxx;

#include "trie.h"

struct TermHitUrlNode {
  string url;
  vector<int> hit_title_pos;
  vector<int> hit_content_pos;
};

struct Term {
  string term;
  int pos;
};

struct Query {
  string raw_query;
  vector<string> query_term_vec;
};

struct ResultNode {
  string url;
  vector<Term> hit_vec;
  int score;
};

struct AttachMent {
  string title;
};

bool cmp_term(const Term &t1, const Term &t2) {
  return t1.pos < t2.pos;
}

bool cmp_result_node(const ResultNode &r1, const ResultNode &r2) {
  return r1.score > r2.score;
}

struct str_hash {
  size_t operator()(const string &str) const {
    return __stl_hash_string(str.c_str());
  }
};

class Index {
  public:
    Index() {
      worddict.load("./worddict/word.txt");
    }
    ~Index() {
    }
    int AddIndex(string url, string title, string content);
    int BuildIndex(const char *path);
    int SearchIndex(string keyword);

  private:
    Trie worddict;
    int ScoreDoc(Query query, ResultNode query_hit_url);
    int SegText(string text, vector<string> &seg_vec);
    hash_map<string, vector<TermHitUrlNode>, str_hash> index_table;
    hash_map<string, AttachMent, str_hash> attachment_table;
};
