#!/usr/bin/env python

import requests
import sys
from bs4 import BeautifulSoup

query = sys.argv[1]
for t in sys.argv[2:]:
	query += "-" + t

outputname = "./scraper2/" + query + ".txt"

response = requests.get('http://www.zillow.com/homes/'+query+'/');

html = response.text

#with open("output.txt", 'rb') as f:
#	html = f.read()

soup = BeautifulSoup(html)

properties_dirty = soup.find_all("a", {"class":"hdp-link routable"})

pid_list = []

with open(outputname, 'wb') as output:
	for p in properties_dirty:
		addr =  p['href'].encode('ascii','ignore')
		output.write(addr + "\n")
		addr_pieces = str.split(addr, '/')
		pid = addr_pieces[3]
		pid_trim = str.split(pid, '_')[0]

		pid_list.append(pid_trim)

		output.write(pid_trim + "\n")
		spans = p.select("span")
		for s in spans:
			output.write(s.string + "\n")
		output.write("\n")

#print pid_list
with open("./pid-list.txt", 'ab') as pidfile:
	for p in pid_list:
		pidfile.write(p + "\n")

