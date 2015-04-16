import yaml

filename = "data/database.json"

data = []

with open(filename, 'rb') as f:
	for line in f.readlines():
		entry = yaml.load(line)
		data.append(entry)

seller = []

for e in data:
	for k in e.keys():
		if(k == "seller"):
			names = e[k].split(" ",1)
			fullname = (names[0], names[1])
			if fullname not in seller:
				names = e[k].split(" ",1)
				seller.append(fullname)

#print seller

sql_queries = []
sellerID = 0

for (fname,lname) in seller:
	email = "seller"+str(sellerID)+"@gmail.com"
	password = "pass"

	query = "INSERT INTO SELLER (sid,fname,lname,email,password) VALUES ("

	query += str(sellerID) + ", '"
	query += fname + "','"
	query += lname + "','"
	query += email + "','"
	query += password + "');"

	sql_queries.append(query)

	sellerID += 1

#print sql_queries

with open("InsertSellers.sql", 'wb') as f:
	f.write("USE realestate_db;\n")
	for q in sql_queries:
		f.write(q + "\n")
