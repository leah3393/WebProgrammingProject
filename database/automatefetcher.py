#!/usr/bin/env python

import os

with open('pid-list.txt','rb') as f:
	pidlist = [line.rstrip('\n') for line in f]

pids = []

for p in pidlist:
	pids.append("python propertyfetch.py " + p)

fetchfiles = []

count = 0
fetch = []

for p in pids:
	if(count == 100):
		count = 0
		fetchfiles.append(fetch)
		fetch = []
	fetch.append(p)
	count += 1

fetchfiles.append(fetch)

#print pids

for f in fetchfiles:
	print "fetching"

count = 1

for f in fetchfiles:
	filename = "fetch"+str(count)+".sh"
	with open(filename, 'wb') as script:
		for p in f:
			script.write(p + "\n")
	count += 1