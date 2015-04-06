#!/usr/bin/env python

import os

filenames = os.listdir("./properties")
cities = []

for f in filenames:
	cities.append("python data.py properties/" + f)

print cities

with open('data.sh', 'wb') as script:
	for c in cities:
		script.write(c + "\n")