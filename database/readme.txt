Downloading info steps:

chmod +x ./fetch#.sh
./fetch#.sh
[remove xml files <1K]
python automatedata.py
python automatepictures.py
[remove .DStore file]
./data.sh >> data/database.json
./pictures.sh
rm ./fetch#.sh