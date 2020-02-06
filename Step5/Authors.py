import sys
reload(sys)
sys.setdefaultencoding('utf-8')

import csv
seg_authors = []
new_seg = []
with open(r"articles.csv") as csvfile:
    readCSV = csv.DictReader(csvfile, delimiter=',')
    for row in readCSV:
        seg_authors.append(row['Authors'])
       
        

seg_authors = [w.replace("[", "") for w in seg_authors]
seg_authors = [w.replace("]", "") for w in seg_authors]
seg_authors = [w.replace("\"", "") for w in seg_authors]


for a in seg_authors:
    if "," in a:
        X = a.split(",")
        for i in X:
            new_seg.append(i)
    else:
        new_seg.append(a)


id = 100
_id = ['_id']
fname = ['fname']
lname = ['lname']
email = ['email']

for a in new_seg:
    Y = a.split(" ",1)
    if(len(Y)>1):
       _id.append(id)
       id += 1
       fname.append(Y[0])
       lname.append(Y[1])
       email.append(Y[0] + Y[1] + "@gmail.com")
    else:
       fname.append(Y[0])
       lname.append("")
       email.append(Y[0]+"@gmail.com")
    

final = [list(a) for a in zip(_id,lname,fname,email)]

with open (r"authors.csv", "wb") as csvfile:

    csvwriter = csv.writer(csvfile)
    csvwriter.writerows(final)