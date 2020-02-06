import sys
reload(sys)
sys.setdefaultencoding('utf-8')
import csv

article_id = ['Article_id']
article_title = ['Title']
page_no = ['Pages']
volume_id = ['Volume']

with open(r"articles.csv") as csvfile:
    readCSV = csv.DictReader(csvfile, delimiter=',')
    for row in readCSV:
        article_id.append(row['Article_id'])
        article_title.append(row['Title'])
        page_no.append(row['Pages'])
        volume_id.append(row['Volume'])

X = [list(a) for a in zip(article_id,volume_id,article_title,page_no)]

with open (r"New_Article.csv", "wb") as csvfile:
    csvwriter = csv.writer(csvfile)
    csvwriter.writerows(X)