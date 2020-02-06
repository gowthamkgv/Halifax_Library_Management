import csv
import sys
reload(sys)
sys.setdefaultencoding('utf-8')
import csv
article_id = ['Article_id']
author_id = ['Author_id']

with open(r"articles.csv") as csvfile:
    readCSV = csv.DictReader(csvfile, delimiter=',')
    for row in readCSV:
        article_id.append(row['Article_id'])
with open(r"authors.csv") as csvfile:
    readCSV1 = csv.DictReader(csvfile, delimiter=',')
    for row in readCSV1:
        author_id.append(row['_id'])
X = [list(a) for a in zip(article_id,author_id)]
with open (r"Author_Article2.csv","wb") as csvfile:
    csvwriter = csv.writer(csvfile)
    csvwriter.writerows(X)