# 09-07-2016
# ouiUpdate, grabs the iee oui list and adds it to a table in mysql database.
# Provides no syntax checking of the input file, use with caution
# based on load_iou_to_pgsql.py https://gist.github.com/pwldp/dee6d5f9868a1dd1d076
#
# Usage:
# python ouiUpdateMysql.py

import MySQLdb
import re
import urllib
import sys

# Globals
# Database Handle, again, no need to change them; Only Declarations
DB = ''
DB_CURSOR = ''
OUI_URL = "http://standards.ieee.org/develop/regauth/oui/oui.txt"
OUI_FILE = "oui.txt"

# Database Related Globals
DB_NAME='att4ck'
DB_USERNAME='runcif'
DB_PASSWORD='att4ck'
DB_TABLE='ouiList'
DB_HOST='localhost'

def main():
	global DB
	global DB_CURSOR
	global DB_TABLE
	#
    # Download oui.txt  Comment out the two lines below if you do not want to download the file and use a offline copy
	#####
	#print "Scarico il database dei Vendor ",OUI_URL
	#urllib.urlretrieve(OUI_URL, OUI_FILE)
    #####
    ##connect to db
	try:
		## Opening connection to Database with pre-configured Database, Host, User and Password
		DB = MySQLdb.connect(host=DB_HOST, user=DB_USERNAME, passwd=DB_PASSWORD, db=DB_NAME) 
		DB_CURSOR = DB.cursor()
	except:
		sys.exit('Non riesco a connettermi al DataBase, controlla!')
	
	# Drop table and start from new
	DB_CURSOR.execute("DROP TABLE IF EXISTS ouiList")
	# Create table as per requirement
	sql ="""CREATE TABLE IF NOT EXISTS ouiList (
		id int(6) NOT NULL AUTO_INCREMENT,
		oui varchar(8) DEFAULT NULL,
		vendor varchar(100) DEFAULT NULL,
		PRIMARY KEY (id)
		) ENGINE=InnoDB"""

	# make the new table
	DB_CURSOR.execute(sql)
		
	# parsing oui.txt data and adding to table
	print "Recupero informazioni..."
	with open(OUI_FILE) as infile:
		print "Inserisco le informazioni nel database, attendi..."
		for line in infile:
			#do_something_with(line)
			if re.search("(hex)", line):
				try:
					mac,vendor = line.strip().split("(hex)")
				except:
					mac = vendor = ''
				#print line.strip().split("(hex)")
				#print mac.strip().replace("-",":").lower(), vendor.strip()
				if mac!='' and vendor!='':
					sql = "INSERT INTO ouiList "
					sql+= "(oui,vendor) "
					sql+= "VALUES ("
					sql+= "'%s'," % mac.strip().replace("-",":").lower()
					sql+= "'%s'" % vendor.strip().replace("'","`")
					sql+= ")"
					#print sql
					try:
						DB_CURSOR.execute(sql)
						DB.commit()
					except Exception, e:
						DB.rollback()
						print "Non inserito, l'errore è: "
	
	# count the number of lines in the table
	sql = ("SELECT count(id) FROM ouiList WHERE 1")
	DB_CURSOR.execute(sql)
	result = DB_CURSOR.fetchone()
	if result:
		print 'Completato: Linee totali nella tabella: {0}'.format(result[0])
	else:	
		print "Non riesco a conteggiare le linee nel database -.-"
	
	infile.close()
	DB_CURSOR.close()
	DB.close()
	#

    
if __name__=="__main__":
    main()

