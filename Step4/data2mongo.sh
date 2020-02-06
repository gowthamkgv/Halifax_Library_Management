#!/bin/bash

#
db="$1"
user="$2"
pass="$3"
#
echo
echo  -u "$user" -p"$pass" "$db" -e "source NEW_TABLES.sql;" 
echo
echo "-> Inserted from NEW_TABLES.sql"
echo
mysql "$db" -u"$user" -p"$pass" -e 'select * from AUTHOR' | awk '{print $1",",$2","$3","$4}' >author.csv
echo  "-> Export Well"
echo
echo
javac csv2json.java
java csv2json
echo   "welldone1"
java -cp json-simple-1.1.1.jar  clr4article.java
echo   "welldone2"
echo
echo
mongoimport -d  "$db" -u "$user" -p "$pass" -c author1 --file ./AUTHOR.json --jsonArray
mongoimport -d  "$db" -u "$user" -p "$pass" -c article --file ./ARTICLE.json --jsonArray
echo
echo
echo "import wells"

