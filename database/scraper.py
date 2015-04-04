#!/usr/bin/env python

import requests
import sys
from bs4 import BeautifulSoup

query = sys.argv[1]
for t in sys.argv[2:]:
	query += "-" + t

outputname = "./scraper/" + query + ".txt"

response = requests.get('http://www.zillow.com/homes/'+query+'/');

html = response.text

soup = BeautifulSoup(html)

properties_dirty = soup.find_all("a", {"class":"hdp-link routable"})

with open(outputname, 'wb') as output:
	for p in properties_dirty:
		spans = p.select("span")
		for s in spans:
			output.write(s.string + "\n")
		output.write("\n")

