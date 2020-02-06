import csv
q = open('Author_Article2.csv')
csv_f = csv.reader(q)
next(csv_f) 
f = open('article_author_queries.sql', 'w')
for row in csv_f:
	f.write(str("insert IGNORE into ARTICLE_AUTHOR(article_id,author_id) values (")+str("'")+row[0]+str("','")+row[1]+str("');")+str('\n'))
f.close()