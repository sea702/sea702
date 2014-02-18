from scrapy.spider import BaseSpider
from scrapy.selector import HtmlXPathSelector
from scrapy.http import Request
from diyifanwen.items import DiyifanwenItem

import time
import MySQLdb
from scrapy import log
from scrapy.exceptions import DontCloseSpider
import collections
from scrapy import signals

# title: //div[@id='ArtContent']/h1
# content: //div[@id='ArtContent']
# pos: //div[@id='Position']

class GetContentSpider(BaseSpider):
    name = "get_content_spider"
    allowed_domains = ["diyifanwen.com"]

    start_urls = []

    def _connect_database(self):
        self.conn = MySQLdb.connect(user="root", passwd="q1w2e3r4", host="127.0.0.1",db="spider",port=3306, charset="utf8")
        self.cur = self.conn.cursor()
        self.cur.execute("SET NAMES utf8")
        log.msg("connect to database...")

    def __init__(self):
        self._connect_database()

    def spider_idle(self):
        """Schedules a request if available, otherwise waits."""
        req = self.next_request()
        if req:
            if isinstance(req, collections.Iterable):
                for r in req:
                    self.crawler.engine.crawl(r, spider=self)
            else:
                self.crawler.engine.crawl(req, spider=self)
        raise DontCloseSpider

    def set_crawler(self, crawler):
        super(GetContentSpider, self).set_crawler(crawler)
        self.crawler.signals.connect(self.spider_idle, signal=signals.spider_idle)

    def next_request(self):
        time.sleep(1)
        count = 0
        while count == 0:
            try:
                count = self.cur.execute('select ID, url from linkbase_diyifanwen where status > 1000000000 and status < 2000000000 limit 1')
                log.msg('select ID, url from linkbase_diyifanwen.. count = %d' % count)
                if count > 0:
                    row = self.cur.fetchone()
                    ID = row[0]
                    url = row[1]
                    status = int(ID) + 2000000000
                    self.cur.execute('update linkbase_diyifanwen set status = %s where url = %s', (str(status),url))
                    log.msg('update linkbase_diyifanwen set status = %s where url = %s' % (str(status),url), level=log.INFO)
                    return Request(url, callback=self.parse)
                else:
                    log.msg('no valid data, waiting for 10 seconds')
                    time.sleep(10)
            except MySQLdb.Error,e:
                log.msg("Mysql Error %d: %s" % (e.args[0], e.args[1]), level=log.WARNING)
                self._connect_database()
                count = 0

    def parse(self, response):
        hxs = HtmlXPathSelector(response)
        title_xpath = hxs.select('//div[@id=\'ArtContent\']/h1')
        content_xpath = hxs.select('//div[@id=\'ArtContent\']')
        pos_xpath = hxs.select('//div[@id=\'Position\']')
        title_text = title_xpath.select('text()').extract()
        content_text = content_xpath.extract()
        pos_text = pos_xpath.extract()

        if len(title_text) > 0 and len(content_text) > 0 and len(pos_text) > 0 and len(title_text[0]) > 0 and len(content_text[0]) > 10 and len(pos_text[0]) > 0:
            item = DiyifanwenItem()
            item['url'] = response.url
            item['title'] = "".join(title_text)
            item['content'] = "".join(content_text)
            item['pos'] = "".join(pos_text)
            yield DiyifanwenItem(item)
        else:
            log.msg("title or content format error, extract error, url:%s" % response.url)
