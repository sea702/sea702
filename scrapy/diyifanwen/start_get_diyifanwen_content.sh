#!/bin/bash

time=`date +"%Y%m%d%H%M"`
echo $time

nohup scrapy crawl get_content_spider 1>>"./log/content.log.$time" 2>&1 &

