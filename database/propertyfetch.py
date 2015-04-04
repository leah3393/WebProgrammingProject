#!/usr/bin/env python

import sys
import requests

pid = sys.argv[1]
zwsid = "X1-ZWz1eqfnse75e3_86zet"

url = "http://www.zillow.com/webservice/GetUpdatedPropertyDetails.htm?zws-id="+zwsid+"&zpid="+pid

print url

response = requests.get(url);

filename = "./properties/" + pid + ".xml"

with open(filename, 'wb') as f:
	f.write(response.text)