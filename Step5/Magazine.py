import sys
reload(sys)
sys.setdefaultencoding('utf-8')

import csv
Magazine_Id = ['Magazine_id']
Magazine_Id_count = 1
Magazine_Name = ['Journal']

with open(r"articles.csv") as csvfile:
    readCSV = csv.DictReader(csvfile, delimiter=',')
    for row in readCSV:
        if row['Journal'] in Magazine_Name:
            continue
        Magazine_Name.append(row['Journal'])
        Magazine_Id.append(Magazine_Id_count)
        Magazine_Id_count += 1
        # print(X)

X = [list(a) for a in zip(Magazine_Id, Magazine_Name)]

#with open (r"Magazines.csv", "a",newline = '') as csvfile:
with open (r"Magazines.csv", "wb") as csvfile:
    csvwriter = csv.writer(csvfile)
    csvwriter.writerows(X)
    