#include <cstdio>
#include <cstdlib>
#include <cstring>
#include <queue>
#include "time.h"
using namespace std;

#define MAX_CNT 100000

struct node {
  char str[MAX_CNT];
  int random_num;

  friend bool operator <(node a,node b) {
    return a.random_num > b.random_num;
  }
};

int main(int argc, char *argv[]) {
  char line[MAX_CNT];
  char str[MAX_CNT];
  char *t_str;
  int num, N;
  unsigned long count;
  priority_queue<node> Q;
  node pq_node;

  if (argc <= 1 || argc >=3) {
    fprintf(stderr, "Usage : %s number\n", argv[0]);
    return -1;
  }
  N = atoi(argv[1]);

  srand((unsigned)time(NULL));
  count = 0;
  int cl = 0;

  while (fgets(line, sizeof(line), stdin) != NULL) {
    cl++;
    if ((t_str = strtok(line, "\t\n")) == NULL) {
      continue;
    }
    strcpy(pq_node.str, t_str);

    if ((t_str = strtok(NULL, "\t\n")) == NULL) {
      num = 1;
    }
    else {
      num = atoi(t_str);
    }

    for (int i = 0; i < num; i++) {
      if (++count % 5000 == 0) {
        fprintf(stderr, "cal %ld-%d words\n", count, cl);
      }

      pq_node.random_num = rand();

      if (Q.size() < N) {
        Q.push(pq_node);
      }
      else {
        if (pq_node.random_num > Q.top().random_num) {
          Q.push(pq_node);
          Q.pop();
        }
      }
    }
  }

  while (!Q.empty()) {
    pq_node = Q.top();
    Q.pop();
    printf("%s\t%d\n", pq_node.str, pq_node.random_num);
  }
  
  return 0;
}
