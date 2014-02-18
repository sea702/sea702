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

# title: //a[@id='cb_post_title_url']/text()
# content: //div[@id='cnblogs_post_body']

class GetLinkSpider(BaseSpider):
    name = "get_link_spider"
    allowed_domains = ["diyifanwen.com"]

    start_urls = []

    def _connect_database(self):
        self.conn = MySQLdb.connect(user="root", passwd="***", host="127.0.0.1",db="spider",port=3306, charset="utf8")
        self.cur = self.conn.cursor()
        self.cur.execute("SET NAMES utf8")
        log.msg("connect to database...")

    def _valid_url(self, url):
        if url.find("http://www.diyifanwen.com/") != 0:
            return False

        if url.find("#") > 0 or url.find("?") > 0 or url.find("&") > 0:
            return False

        return True

    def _get_url_path(self, url):
        pos = url.rfind("/")
        path = ""
        if (pos > 0):
            path = url[0:pos+1]
        return path

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
        super(GetLinkSpider, self).set_crawler(crawler)
        self.crawler.signals.connect(self.spider_idle, signal=signals.spider_idle)

    def next_request(self):
        time.sleep(1)
        count = 0
        while count == 0:
            try:
                count = self.cur.execute('select ID, url from linkbase_diyifanwen where status < 100000000 or status is null limit 1')
                log.msg('select url from linkbase_diyifanwen..')
                if count > 0:
                    row = self.cur.fetchone()
                    ID = row[0]
                    url = row[1]
                    status = int(ID) + 1000000000
                    self.cur.execute('update linkbase_diyifanwen set status = %s where ID = %s', (str(status),str(ID)))
                    log.msg('update linkbase_diyifanwen set status = %s where url = %s' % (str(status), url), level=log.INFO)
                    return Request(url, callback=self.parse_link)
                else:
                    log.msg('no valid data, waiting for 10 seconds')
                    time.sleep(10)
            except MySQLdb.Error,e:
                log.msg("Mysql Error %d: %s" % (e.args[0], e.args[1]), level=log.WARNING)
                self._connect_database()
                count = 0

    def parse_link(self, response):
        hxs = HtmlXPathSelector(response)
        xpath_res = hxs.select('//a')
        for xpath_node in xpath_res:
            item = DiyifanwenItem()
            item['link'] = xpath_node.select('@href').extract()
            if (len(item['link']) > 0):
                url = item['link'][0].lower()
                if (len(url) > 0 and url[0] == '/'):
                    url = "http://www.diyifanwen.com" + url
                if (url.find("/") < 0):
                    path = self._get_url_path(response.url)
                    url = path + url
                if self._valid_url(url):
                    yield DiyifanwenItem(link=url)

