# -*- coding: utf-8 -*-

import csv
h = open(r'Magazines.csv')
                             
csv_f = csv.reader(h)
next(csv_f)
h = open('insert_queries_Magazines.sql', 'w')
for row in csv_f:
    h.write(str("insert into Magazines(name) values (")+str("'")+row[1]+str("');")+str('\n'))
h.close()
