#!/usr/bin/env python

import os

filenames = os.listdir("./scraper")
cities = []

for f in filenames:
	cities.append("python scraper.py " + f[:-4])

print cities

with open('scrape.sh', 'wb') as script:
	for c in cities:
		script.write(c + "\n")