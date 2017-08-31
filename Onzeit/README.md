# Django rest - Angular frontend project
====================================

This is the uber like app using bootstrap template and admin dashboard template.

INSPINIA - Responsive Admin Theme https://wrapbootstrap.com/theme/inspinia-responsive-admin-theme-WB0R5L90S

To setup and run the frontend, you are going to need npm from NodeJS available to install and launch the frontend code.
Or you can use apache server to host frontend.

    INCLUDED
        - RESTFUL API service using Django rest framework
        - Angularjs frontend using Admin dashboard and landing Template

After cloning down the repository:
## Installing MySQL server and Setting configure
1.  apt-get install mysql-server
2.  apt-get install virtualenv

After installing mysql server,
you should create database to be used in backend. 
And do configure.

## Running Django rest daemon
1.  cd backend
2.  source env/bin/activate
3.  cd onzeit
4.  python manage.py makemigrations
5.  python manage.py migrate
6.  python manage.py createsuperuser
7.  python manage.py runserver 0.0.0.0:8000
8.  Open browser, and http://localhost:8000/admin/

You can use gunicorn for running backend

##  Runnig Frontend
1.  npm install http-server -g
2.  http-server frontend/
3.  Open browser to http://localhost:8000/admin 
4.  Add a few table data
5.  Go to http://localhost:8080

You can use server like apache2 instead of http-server module

##  Configure
1.  Open frontend/js/services.js, and you can find rest api host address. Please set it to backend hosting address
2.  Open backend/onzeit/onzeit/settings.py, and you can find database setting. Please set db name to your db.
