#!/usr/bin/env python
import sys
from bs4 import BeautifulSoup
import json

filename = sys.argv[1]
pid = str.split(filename, '/')[1]

with open(filename, 'rb') as f:
	html = f.read()

data = {}

soup = BeautifulSoup(html)

response = soup.find("response")

data["pid"] = response.find("zpid").string.encode('ascii','ignore')

address = response.find("address")

data["addr"] = address.find("street").string.encode('ascii','ignore')
data["zip"] = address.find("zipcode").string.encode('ascii','ignore')
data["city"] = address.find("city").string.encode('ascii','ignore')
data["state"] = address.find("state").string.encode('ascii','ignore')

if(response.find("agentname") != None):
	data["seller"] = response.find("agentname").string.encode('ascii','ignore')
if(response.find("price") != None):
	data["price"] = response.find("price").string.encode('ascii','ignore')
if(response.find("bedrooms") != None):
	data["beds"] = response.find("bedrooms").string.encode('ascii','ignore')
if(response.find("bathrooms") != None):
	data["baths"] = response.find("bathrooms").string.encode('ascii','ignore')
if(response.find("finishedsqft") != None):
	data["homeSize"] = response.find("finishedsqft").string.encode('ascii','ignore')
if(response.find("lotsizesqft") != None):
	data["lotSize"] = response.find("lotsizesqft").string.encode('ascii','ignore')
if(response.find("homedescription") != None):
	data["description"] = response.find("homedescription").string.encode('ascii','ignore')
if(response.find("yearbuilt") != None):
	data["yearBuilt"] = response.find("yearbuilt").string.encode('ascii','ignore')
if(response.find("usecode") != None):
	data["type"] = response.find("usecode").string.encode('ascii','ignore')

print json.dumps(data)