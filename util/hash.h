#include <cstdio>
#include <cstdlib>
#include <set>
#include <cstring>
#include <string>
using namespace std;

struct hash_node {
  hash_node(){value=0;word=NULL;next=NULL;}
  char *word;
  int value;
  struct hash_node *next;
};

class hash_map {
  public:
    hash_map(int length) {
      hash_table_size = length;
      hash_table = new hash_node[hash_table_size];
    }
    ~hash_map() {
      for (int i = 0; i < hash_table_size; i++) {
        hash_node *t1 = hash_table[i].next;
        hash_node *t2 = NULL;

        while (t1 != NULL) {
          t2 = t1->next;
          delete t1;
          t1 = t2;
        }
      }
      delete hash_table;
    }

    bool find(char *word, int &value) {
      int hash_code = hash(word) % hash_table_size;

      hash_node *t = hash_table + hash_code;

      while(t!=NULL) {
        if(t->word==NULL) {
          return false;
        }

        if(strcmp(t->word, word)==0) {
          value = t->value;
          return true;
        }

        t = t->next;
      }
      return false;
    }

    bool find(char *word) {
            int value;
      return find(word, value);
        }

    int add_hash_node(char *word, int value = 0) {
      int len = strlen(word);
      int hash_code = hash(word) % hash_table_size;

      hash_node *t = hash_table + hash_code;
      try {
        while(t!=NULL) {
          /* empty */
          if(t->word==NULL) {
            t->word = (char *)malloc((len+1)*sizeof(char));
            if (t->word == NULL) {
              return -1;
            }
            snprintf(t->word, len+1, "%s", word);
            t->value = value;
            break;
          }
          else {
            if (t->next == NULL) {
              t->next = new hash_node();
            }
            t = t->next;
          }
        }
      }
      catch(...) {
        return -1;
      }
      return 0;
    }

    int load_worddict(const char *filename) {
      fprintf(stderr, "[Notice]: open file %s\n", filename);

      FILE *fp = NULL;
      char words[20000];
      char *t, *key;
      int len;
      int value;
      int count = 0;

      if((fp=fopen(filename, "r"))==NULL) {
        fprintf(stderr, "[Error]: open file %s failed\n", filename);
        return -1;
      }

      while(fgets(words, sizeof(words), fp)) {
        len = strlen(words);
        if (len == 0) return -1;

        while(len > 0 && (words[len-1]=='\r' || words[len-1]=='\n')) {
          words[len-1]='\0';
          len--;
        }

        if ((key = strtok(words, "\t")) == NULL) continue;

        if ((t = strtok(NULL, "\t")) == NULL){
          value=0;
        }
        else {
          value = atoi(t);
        }
        if (add_hash_node(words, value) == -1) {
          return -1;
        }
        count++;
        if (count % 50000 == 0)fprintf(stderr, "[Notice]: add %d words\n", count);
      }
      return 0;
    }

  private:

    int hash_table_size;
    hash_node *hash_table;

    unsigned int hash(char *str) {
      unsigned int seed = 131;
      unsigned int hash = 0;

      while (*str) {
        hash = hash * seed + (*str++);
      }

      return (hash & 0x7FFFFFFF);
    }
};

