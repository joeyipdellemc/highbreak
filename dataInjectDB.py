import mysql.connector

mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  password="root",
  port="3306",
  database="mysql"
)

print(mydb)