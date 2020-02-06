#!/bin/bash
#
  db="$1"
  user="$2"
  pass="$3"
#
#PLEASE RUN THIS COMMAND BEFORE EXECUTING THIS FILE: pip install pandas
#step 1 - export mongo article collection to a csv file
mongoexport -d $db -p $pass -u $user -c article --type csv --fields Article_id,Title,Journal,Volume,Year,Pages,Authors --out article.csv

#step 2 - export mongo author collection to a csv file
mongoexport -d $db -p $pass -u $user -c author1  -o author.csv

#step 3 - python scripts to create csv files to insert to corresponding tables 
python Authors.py
python AddnewArticle.py
python Magazine.py
python Magazines_Volumes.py
python author_article.py

#step 4 - python scripts to create mysql inser scripts  to insert to corresponding tables

python data2sql_Magazine.py
python data2sql.Magazine_Volume.py
python data2sql_articleauthor.py
javac authorscsv_to_sql.java
java authorscsv_to_sql
javac articlescsv_to_sql.java
java articlescsv_to_sql


#step 5 - Importing the csv files to sql
mysql -u "$user" --password="$pass" "$db" --force  < article_author_queries.sql
mysql -u "$user" --password="$pass" "$db" --force  < insert_authors.sql
mysql -u "$user" --password="$pass" "$db" --force  < insert_queries_Magazines.sql
mysql -u "$user" --password="$pass" "$db" --force  < article1.sql
mysql -u "$user" --password="$pass" "$db" --force  <  source insert_queries_Magazine_Volume.sql


#step 6 - Delete all csv files and insert scripts
rm authors.csv article_author.csv Magazines.csv Magazine_Volume.csv New_Article.csv articles.csv
rm article_author_queries.sql insert_authors.sql insert_queries_Magazines.sql article1.sql insert_queries_Magazine_Volume.sql