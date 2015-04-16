import os

filenames = os.listdir("./images/")

pictures = []

for f in filenames:
	pictures.append(("resources/images/property/" + f, f[:-6], f[-5:-4]))

print pictures

sql_queries = []

pictureID = 0

for (path,pid,pnum) in pictures:

	query = "INSERT INTO PICTURE (pictureID,picture,pid,isPrimary) VALUES ("
	query += str(pictureID) + ",'"
	query += path + "',"
	query += pid + ","
	if pnum == "1":
		query += "1);"
	else:
		query += "0);"

	sql_queries.append(query)

	pictureID += 1

print sql_queries

with open("InsertPictures.sql", 'wb') as f:
	f.write("USE realestate_db;\n")
	for q in sql_queries:
		f.write(q + "\n")
