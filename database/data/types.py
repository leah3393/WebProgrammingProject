import yaml

filename = "database.json"

data = []

with open(filename, 'rb') as f:
	for line in f.readlines():
		entry = yaml.load(line)
		data.append(entry)

types = {}

for e in data:
	for k in e.keys():
		if(k == "type"):
			if e[k] in types:
				types[e[k]] += 1
			else:
				types[e[k]] = 1

print types