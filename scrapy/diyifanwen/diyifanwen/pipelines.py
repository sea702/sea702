# Define your item pipelines here
#
# Don't forget to add your pipeline to the ITEM_PIPELINES setting
# See: http://doc.scrapy.org/topics/item-pipeline.html
import json
import time
import MySQLdb
from scrapy import log

class DiyifanwenPipeline(object):
    def _connect_database(self):
        self.conn = MySQLdb.connect(user="root", passwd="q1w2e3r4", host="127.0.0.1",db="spider",port=3306, charset="utf8")
        self.cur = self.conn.cursor()
        self.cur.execute("SET NAMES utf8")
        log.msg("connect to database...")

    def __init__(self):
        self._connect_database()

    def process_item(self, item, spider):
        if (cmp(spider.name, 'get_link_spider') == 0):
            try:
                url = item['link'].lower()
                count = self.cur.execute('select ID from linkbase_diyifanwen where url = %s', url)
                if count == 0:
                    self.cur.execute('insert into linkbase_diyifanwen (url) values(%s)', url)
                    self.cur.execute('update linkbase_diyifanwen set status = ID where url = %s', url)
                    log.msg("insert %s to linkbase_diyifanwen" % url, level=log.INFO)
                else:
                    log.msg("%s already in linkbase_diyifanwen" % url, level=log.INFO)
            except MySQLdb.Error,e:
                log.msg("Mysql Error %d: %s" % (e.args[0], e.args[1]), level=log.WARNING)
                self._connect_database()
        if (cmp(spider.name, 'get_content_spider') == 0):
            url = item['url'].encode('utf-8')
            title = item['title'].encode('utf-8')
            title = title.strip()
            content = item['content'].encode('utf-8')
            pos = item['pos'].encode('utf-8')
            try:
                count = self.cur.execute('select ID from linkbase_diyifanwen where url = %s', url)
                if count > 0:
                    row = self.cur.fetchone()
                    ID = row[0]
                    page = (ID, url, pos, title, content, ID)
                    self.cur.execute('insert into diyifanwen (ID, url, pos, title, content, status) values(%s,%s,%s,%s,%s,%s)', page)
                    log.msg("insert %s to diyifanwen" % url, level=log.INFO)
                else:
                    log.msg("can not find %s in linkbase_diyifanwen" % url, level=log.INFO)
            except MySQLdb.Error,e:
                log.msg("Mysql Error %d: %s" % (e.args[0], e.args[1]), level=log.WARNING)
                self._connect_database()
        return item
