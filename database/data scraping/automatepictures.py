#!/usr/bin/env python

import os

filenames = os.listdir("./properties")
cities = []

for f in filenames:
	cities.append("python fetchpictures.py properties/" + f)

print cities

with open('pictures.sh', 'wb') as script:
	for c in cities:
		script.write(c + "\n")