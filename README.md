# Winter_hoodie_shopping_portal
A web application (a shopping cart system for winter hoodies)

Combination used:
HTML+CSS (frontend)
PHP (backend)
MySql (database)

For testing this application on your server , changes need to be made only in pdo.php file(Selection of host, username, password and database name)
In the server,  the following 2 database creations must take place.

CREATE TABLE STUDENTS (ID TEXT UNIQUE NOT NULL , NAME TEXT , COLOUR TEXT , SIZE TEXT , STATE TEXT) ;

CREATE TABLE ADMINS (ADMI TEXT UNIQUE NOT NULL , PASS TEXT ) ;

The table students contains the data input by the students regarding their choice of hoodies.
The table admins contains the usernames and passwords for admin login to view all data from students table. 

ONLY THE LOGIN_PAGE.PHP MUST BE ACCESSED AS THE STARTING POINT FOR ANY ACTION, ELSE THE USER WILL BE REDIRECTED TO AN ACCESS DENIED PAGE. TO PREVENT UNAUTHORISED ACCESS TO OTHER PAGES, THIS HAS BEEN DONE.
