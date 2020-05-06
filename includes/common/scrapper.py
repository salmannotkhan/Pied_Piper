import requests
import os
import mysql.connector
from bs4 import BeautifulSoup


def dbupdate():
    mydb = mysql.connector.connect(
        host="localhost",
        user="root",
        passwd="tony3212",
        database="piedpiper"
    )
    cur = mydb.cursor()

    # Delete all the existing data
    print('Removing old data from table')
    query = "DELETE FROM SUB_ALLOC"
    cur.execute(query)

    # Insert new data
    print('Inserting new data')
    query = "LOAD DATA LOCAL INFILE 'temp.csv' \
            INTO TABLE SUB_ALLOC FIELDS TERMINATED BY ','"
    cur.execute(query)
    mydb.commit()


sems = ['first', 'second', 'third', 'fourth', 'fifth', 'sixth']

if os.path.isfile('latest.csv'):
    latest = open('latest.csv', 'r')

temp = open('temp.csv', 'w')

for i, sem in enumerate(sems):
    index_page = f"{sem}_semester/index.php"
    url = f"http://spuvvn.edu/students_corner/syllabi/bca/{index_page}"
    source = requests.get(url).text

    soup = BeautifulSoup(source, 'lxml')

    rows = soup.find(id='box-table-a').table.findAll('tr')

    print(f"Fetching BCA Sem-{i+1} Subjects")
    for row in rows[1:]:
        cols = row.findAll('font')
        subject_code = cols[1].text
        subject_name = cols[2].text.replace(',', ' ').strip()
        line = f"BCA SEM-{i+1},{subject_code},{subject_name}\n"
        temp.write(line)
    print(f"Found {len(rows)} Subjects")
temp.close()
temp = open('temp.csv', 'r')
if os.path.isfile('latest.csv'):
    if temp.read() == latest.read():
        print('No update found!!')
        os.remove('temp.csv')
    else:
        print('Update Found')
        dbupdate()
        print('Database Updated')
        os.rename('temp.csv', 'latest.csv')
else:
    dbupdate()
    print('Database Created')
    os.rename('temp.csv', 'latest.csv')
