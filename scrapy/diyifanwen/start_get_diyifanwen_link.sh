#!/bin/bash

time=`date +"%Y%m%d%H%M"`
echo $time

nohup scrapy crawl get_link_spider 1>>"./log/link.log.$time" 2>&1 &

