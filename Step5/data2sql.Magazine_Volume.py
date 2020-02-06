# -*- coding: utf-8 -*-
"""
Created on Mon Dec  9 22:24:00 2019

@author: vidhy
"""


import csv
h = open(r'Magazine_Volume.csv')
                             
csv_f = csv.reader(h)
next(csv_f)
h = open('insert_queries_Magazine_Volume.sql', 'w')
for row in csv_f:
    h.write(str("insert into MAGAZINEVOLUME(Mag_ID,volumeNumber,year) values (")+row[2]+str(",")+row[0]+str(",")+str("'")+row[1]+str("');")+str('\n'))
h.close()

