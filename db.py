import mysql.connector
import datetime

def tp():
        
    cnx = mysql.connector.connect(host="localhost",
        user="root",
        passwd="",
        database="cyrus")
    cursor = cnx.cursor()

    #tomorrow = datetime.now().date() + timedelta(days=1)

    '''add_employee = ("INSERT INTO employees "
                "(first_name, last_name, hire_date, gender, birth_date) "
                "VALUES (%s, %s, %s, %s, %s)")'''
    add_salary = ("INSERT INTO session "
                "(drowse, visibility, picture, glare) "
                "VALUES (%(drowse)s, %(visibility)s, %(picture)s, %(glare)s)")

    #data_employee = ('Geert', 'Vanderkelen', tomorrow, 'M', date(1977, 6, 14))

    # Insert new employee
    #cursor.execute(add_employee, data_employee)
    #emp_no = cursor.lastrowid

    # Insert salary information
    data_salary = {
    'drowse': 0,
    'visibility': 1,
    'picture': 1,
    'glare': 0,
    }
    cursor.execute(add_salary, data_salary)

    # Make sure data is committed to the database
    cnx.commit()

    cursor.close()
    cnx.close()

time1=datetime.datetime.now().strftime('%S')
time2=datetime.datetime.now().strftime('%S')
print(int(time2)-int(time1))
print(int(datetime.datetime(1, 1, 1, 0, 0).strftime('%S')))

print(time1,time2)