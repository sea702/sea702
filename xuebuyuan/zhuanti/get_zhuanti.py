# -*- coding: utf-8 -*-
#!/usr/bin/python
import time
import MySQLdb
import random
import logging
import logging.config
import lxml.html
import sys
logging.basicConfig(level=logging.INFO)
reload(sys)   
sys.setdefaultencoding('utf8')

def get_max_id(cur1):
    count = cur1.execute('select max(ID) from jc_posts where 1')
    if (count > 0):
        row = cur1.fetchone()
        ID = int(row[0])
        return ID
    else:
        return 4000

def get_time():
    cur_time = time.strftime('%Y-%m-%d %H:%M:%S',time.localtime(time.time()))
    return str(cur_time)

def insert_data(cur1, ID, title, content):
    title = title.strip()
    auth = random.randint(11, 4000)

    time = get_time()
    post_content = content
    post_title = title
    post_excerpt = ""
    post_status = "publish"
    com_status = "open"
    ping_status = "open"
    post_passwd = ""
    post_name = "art" + str(ID)
    to_ping = ""
    pinged = ""
    filtered = ""
    parent = 0
    guid = "http://www.xuebuyuan.com/zt/?p=%d" % ID
    menu_order = 0
    post_type = "post"
    post_mime_type = ""
    comment_count = 0

    value = (ID, auth, time, time, content, title, post_excerpt, post_status, com_status, ping_status, post_passwd, post_name, to_ping, pinged, time, time, filtered, parent, guid, menu_order, post_type, post_mime_type, comment_count)
    cur1.execute('insert into jc_posts values(%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s)', value)

    logging.info("insert %s, title:%s" % (guid, title))

def get_content(ID, cur2):
  count = cur2.execute('select post_content from wp_posts where ID = %s' % ID)
  if (count > 0):
    row = cur2.fetchone()
    content = row[0]
    return content

def print_head(query, post_content):
  post_content += "<p>学步园推荐专题: 关于%s的相关文章</p>\n" % query
  post_content += "<table>\n"
  post_content += "<tr>\n"
  post_content += "<td width='25%' style=\"word-break: break-all;\">文章标题</td>\n"
  post_content += "<td width='30%' style=\"word-break: break-all;\">文章链接</td>\n"
  post_content += "<td width='45%' style=\"word-break: break-all;\">文章简介</td>\n"
  post_content += "</tr>\n"
  return post_content

def print_table_line(ID, title, cur2, post_content):
  post_content += "<tr>\n"
  post_content += "<td>%s</td>\n" % title
  post_content += "<td><a href=http://www.xuebuyuan.com/%s.html>http://www.xuebuyuan.com/%s.html</a></td>\n" % (ID, ID)

  content = get_content(ID, cur2)
  document = lxml.html.document_fromstring(content.decode('utf-8'))
  raw_text = document.text_content().encode('utf-8')
  summary = raw_text.decode('utf-8')[0:500]
  summary = summary.replace("\n", " ")
  summary = summary.replace("\r", " ")
  summary = summary.replace("\t", " ")
  summary = summary.strip()
  summary = ' '.join(summary.split())
 
  summary = summary[0:75]
  summary = summary.encode('utf-8') 
  if summary.find("<") >= 0:
    summary = ""
  post_content += "<td style=\"word-break: break-all;\">%s.. 全文: <a href=http://www.xuebuyuan.com/%s.html>%s</a></td>\n" % (summary, ID, title)
  post_content += "</tr>\n"
  return post_content

def print_end(post_content):
  post_content += "</table>\n"
  return post_content

fp = open("result.txt")
query = ""
ID = ""
title = ""

conn2 = MySQLdb.connect(user="root", passwd="***", host="www2.xuebuyuan.com",db="wordpress",port=3306)
cur2 = conn2.cursor()
cur2.execute("SET NAMES utf8")

conn1 = MySQLdb.connect(user="root", passwd="***", host="www1.xuebuyuan.com",db="wordpress",port=3306)
cur1 = conn1.cursor()
cur1.execute("SET NAMES utf8")

post_title = ""
post_content = ""
post_ID = get_max_id(cur1)

for line in fp:
  line = line.decode('utf-8')
  line = line.strip()
  line = line.encode('utf-8')
  if line.find("query:") == 0:
    if query != "":
      post_title = "【%s】_%s的相关文章，教程，源码" % (query, query)
      post_content = print_end(post_content)
      post_ID = post_ID + random.randint(1, 2000)
      insert_data(cur1, post_ID, post_title, post_content)
      post_content = ""
    query = line[6:]
    post_content = print_head(query,post_content)
  if line.find("ID:") == 0:
    ID = line[3:]
    post_content = print_table_line(ID, title, cur2, post_content)
  if line.find("title:") == 0:
    title = line[6:]
