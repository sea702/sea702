# Scrapy settings for diyifanwen project
#
# For simplicity, this file contains only the most important settings by
# default. All the other settings are documented here:
#
#     http://doc.scrapy.org/topics/settings.html
#

BOT_NAME = 'Googlebot'

SPIDER_MODULES = ['diyifanwen.spiders']
NEWSPIDER_MODULE = 'diyifanwen.spiders'

ITEM_PIPELINES = [
    'diyifanwen.pipelines.DiyifanwenPipeline'
]

LOG_LEVEL = 'INFO'

# Crawl responsibly by identifying yourself (and your website) on the user-agent
#USER_AGENT = 'diyifanwen (+http://www.yourdomain.com)'
