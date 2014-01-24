
#ifndef _TRIE_H
#define _TRIE_H

#include <stdio.h>
#include <stdlib.h>
#include <string.h>

enum Load_Type {
  NORMAL_LOAD_TYPE = 0,
  VALUE_LOAD_TYPE = 1
};

inline int sub_size(int level) {
  return level > 8 ? 1 : 256 / (level * level);
}

struct search_tree {
  search_tree(int level) {
    int len = sub_size(level);
    word = false;
    sub_tree = new search_tree *[len];
    next = NULL;

    for (int i = 0; i < len; i++)
      sub_tree[i] = NULL;      
  }

  char cchar;
  bool word;
  int fre;
  search_tree **sub_tree;
  search_tree *next;
};

class Trie
{
  public:
    Trie() {
      min_wordlen = 0; 
      for (int i = 0; i < 256; i++) {
        T[i] = NULL;
      }
    }

    ~Trie() {
      for (int i = 0; i < 256; i++) {
        search_tree_delete(T[i], 1);
      }
    }
    
    void set_min_wordlen(int value) {
      min_wordlen = value;
    }

    int add(char *str, int fre = 1) {
      if (str == NULL) {
        return -1;
      }

      int len = strlen(str);
      if (len >= 256) {
        fprintf(stderr, "Trie::add : too long string : %s", str);
        return -1;
      }

      if (len < min_wordlen) {
        fprintf(stderr, "Trie::add : too short string : %s", str);
        return -1;
      }

      int hash_code = hash((unsigned char)(*str), 256);
      search_tree_add(T[hash_code], str, 1, fre);
      
      return 1;
    }

    int load(const char *file_name, Load_Type load_type = NORMAL_LOAD_TYPE, int value = 1)
    {
      FILE *fp = NULL;
      if ((fp = fopen(file_name, "r")) == NULL)
      {        
        fprintf(stderr, "load file : %s error!", file_name);
        return -1;
      }
          
      int len, ivalue;
      char line[256], *str;
      try
      {
        while (fgets(line, sizeof(line), fp) != NULL)
        {
          len = strlen(line);
          if (len > (int)sizeof(line) - 5)
          {
            fprintf(stderr, "too long word while load: %s, line : %s", file_name,line);
            throw "too long word";
          }

          while (len > 0 && (line[len - 1] == '\r' || line[len - 1] == '\n'))
            line[--len] = '\0';

          switch (load_type)
          {
            case NORMAL_LOAD_TYPE:
              if (this->add(line, value) == -1)
              {
                fprintf(stderr, "Trie::add(...) failed with file: %s, line : %s",file_name,line);
                throw "add failed";
              }
              break;
        
            case VALUE_LOAD_TYPE:
              str = strchr(line, '\t');
              if (str == NULL)
              {
                fprintf(stderr, "format error! with file : %s, line : %s", file_name, line);
                throw "Trie::load(...) failed";
              }

              *str = '\0';
              ivalue = atoi(str + 1);
          
              if (this->add(line, ivalue) == -1)
              {
                fprintf(stderr, "Trie::add error with file %s word %s", file_name, line);
                throw "Trie::load(...) failed";
              }
              break;          
          }
        }
    
        if (!feof(fp))
        {
          fprintf(stderr, "error in load file %s", file_name);
          fclose(fp);
          return -1;
        }
      }
      catch (...)
      {
        fclose(fp);
        return -1;
      }

      fclose(fp);
      return 1;
    }

    int match(const char *str, int *fre = NULL) {
      return prefix_in_tree(*(T + (unsigned char)(*str)), str, 1, fre);
    }

  private:
    void search_tree_delete(search_tree *s_tree, int level)
    {
      if (s_tree == NULL)
        return;

      search_tree_delete(s_tree->next, level);

      int len = sub_size(level + 1);
      for (int i = 0; i < len; i++)
      {
        search_tree_delete(s_tree->sub_tree[i], level + 1);
      }

      delete[] s_tree->sub_tree;
      
      delete s_tree;
    }
    
    void search_tree_add(search_tree *&s_tree, char *str, int level, int fre)
    {
      if (*str == '\0')
        return;
      
      search_tree *cur = NULL;

      if (s_tree == NULL)
      {
        s_tree = new search_tree(level + 1);
        s_tree->cchar = *str;
        cur = s_tree;
      }
      else
      {
        search_tree *cur_tree = s_tree;
        search_tree *pre = s_tree;
        for (cur_tree = s_tree; cur_tree != NULL; cur_tree = cur_tree->next)
        {
          if (cur_tree->cchar == *str)
          {
            cur = cur_tree;
          }
          pre = cur_tree;
        }
        if (cur == NULL)
        {
          pre->next = new search_tree(level + 1);
          pre->next->cchar = *str;
          cur = pre->next;
        }
      }
          
      if (*(str + 1) == '\0')
      {
        if(cur->word) {
          cur->fre = fre;
        } else {
          cur->word = true;
          cur->fre = fre;
        }
        return;
      }

      int hash_code = hash(*(str + 1), sub_size(level + 1));
      search_tree_add(cur->sub_tree[hash_code], str + 1, level + 1, fre);
      
      return;
    }

    int prefix_in_tree(search_tree *s_tree, const char *str, int level, int *fre)
    {
      if (s_tree == NULL || *str == '\0')
        return 0;

      int hash_code, temp;

      for (search_tree *cur = s_tree; cur != NULL; cur = cur->next)
      {
        if (cur->cchar == *str)
        {
          if (cur->word)
          {
            hash_code = hash(*(str + 1), sub_size(level + 1));
            temp = prefix_in_tree(cur->sub_tree[hash_code], str + 1, level + 1, fre);
            
            if (temp > level)
              return temp;

            if (fre != NULL)
              *fre = cur->fre;

            return level;
          }
          
          hash_code = hash(*(str + 1), sub_size(level + 1));
          return prefix_in_tree(cur->sub_tree[hash_code], str + 1, level + 1, fre);
        }
      }
      
      return 0;
    }
    
    unsigned int hash(unsigned char cchar, int len) {
      return cchar % len;
    }

    search_tree *T[256];
    int min_wordlen;
};

#endif
