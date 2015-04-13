import yaml


def create_query(entry):
	columns = ""
	values = ""

	first = True

	for k in entry.keys():
		if(k == "seller"):
			pass
		elif k == "type":
			columns += ", typeID"
			if entry[k] == "SingleFamily":
				values += ", '0'"
			elif entry[k] == "Condominium":
				values += ", '1'"
			elif entry[k] == "MultiFamily2To4" or entry[k] == "MultiFamily5Plus" or entry[k] == "Cooperative":
				values += ", '2'"
			elif entry[k] == "Townhouse":
				values += ", '3'"
			elif entry[k] == "VacantResidentialLand":
				values += ", '5'"
			else:
				values += ", '4'"
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
	dbfile = "../data/database.json"

	db = []

	with open(dbfile, 'rb') as f:
		for line in f.readlines():
			entry = yaml.load(line)
			db.append(entry)

	return db

def main():
	sqlfile = "../InsertProperties.sql"
	with open(sqlfile, 'wb') as f:
		f.write("USE realestate_db;\n")
		db = readobjects()
		for e in db:
			query = create_query(e)
			f.write(query + "\n")

main()

