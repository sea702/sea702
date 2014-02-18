# Define here the models for your scraped items
#
# See documentation in:
# http://doc.scrapy.org/topics/items.html

from scrapy.item import Item, Field

class DiyifanwenItem(Item):
    # define the fields for your item here like:
    # name = Field()
    ID = Field()
    link = Field()
    url = Field()
    title = Field()
    content = Field()
    pos = Field()
    pass
