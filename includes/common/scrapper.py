import requests,os,mysql.connector
from bs4 import BeautifulSoup

def dbupdate():
    mydb = mysql.connector.connect(host='localhost',user='root',passwd='tony3212',database='piedpiper')
    cur = mydb.cursor()

    # Delete all the existing data
    print('Removing old data from table')
    cur.execute("DELETE FROM SUB_ALLOC")

    #Insert new data
    print('Inserting new data')
    cur.execute("LOAD DATA LOCAL INFILE 'temp.csv' INTO TABLE SUB_ALLOC FIELDS TERMINATED BY ','")
    mydb.commit()
    
sems = ['first', 'second', 'third', 'fourth', 'fifth', 'sixth']

if os.path.isfile('latest.csv'):
    latest = open('latest.csv', 'r')
    
temp = open('temp.csv', 'w')
    
for i in range(len(sems)):
    source = requests.get('http://spuvvn.edu/students_corner/syllabi/bca/' + sems[i] + '_semester/index.php').text

    soup = BeautifulSoup(source, 'lxml')

    rows = soup.find(id='box-table-a').table.findAll('tr')

    print('Fetching BCA Sem-' + str(i+1) + ' Subjects')
    for row in rows[1:]:
        cols = row.findAll('font')
        line = 'BCA SEM-' + str(i+1) + ',' + cols[1].text + ',' + cols[2].text.replace(',', ' ').strip() + '\n'
        temp.write(line)
    print('Found ' + str(len(rows)) + ' Subjects')
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