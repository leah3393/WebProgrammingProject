#!/usr/bin/env python
import sys
from bs4 import BeautifulSoup
import urllib

filename = sys.argv[1]
pid = str.split(filename, '/')[1]

with open(filename, 'rb') as f:
	html = f.read()

soup = BeautifulSoup(html)

images = soup.find_all("image")[0]

urls = images.select("url")

count = 1

for u in urls:
	url = u.string
	imagefile = "./images/"+pid[:-4] + "_" + str(count) + ".jpg"
	print url
	print imagefile
	urllib.urlretrieve(u.string, imagefile)
	count += 1