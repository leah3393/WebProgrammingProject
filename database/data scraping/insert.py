import yaml


def create_query(entry):
	columns = ""
	values = ""

	first = True

	for k in entry.keys():
		if(k == "type" or k == "seller"):
			pass
		else:
			clean1 = entry[k].replace('\n', ' ')
			clean2 = clean1.replace("'", "''")
			if first:
				columns += k
				values += "'" + clean2 + "'"
				first = False
			else:
				columns += ", " + k
				values += ", '" + clean2 + "'"

	sql = "INSERT INTO PROPERTY (" + columns + ") VALUES (" + values + ");"
	return sql

def readobjects():
	dbfile = "data/database.json"

	db = []

	with open(dbfile, 'rb') as f:
		for line in f.readlines():
			entry = yaml.load(line)
			db.append(entry)

	return db

def main():
	sqlfile = "InsertProperties.sql"
	with open(sqlfile, 'wb') as f:
		f.write("USE realestate_db;\n")
		db = readobjects()
		for e in db:
			query = create_query(e)
			f.write(query + "\n")

main()

