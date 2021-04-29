# Lyst

Our purpose is to empower households by helping them save money and stay organized when grocery shopping.<br>

## Development Environment

The Lyst application was developed on a Ubuntu 20.04.2 LTS environment. For best results, please open the files within this environment.<br>

# Set-up Instructions

## Installation in Ubuntu

Our application uses a LAMP stack. For the Lyst application to work, you will need to make sure that the following is installed:<br>

### apache2

Use the following commands:<br>

**sudo apt-get install apache2** <br>
**sudo apt-get install tasksel** <br>
**sudo tasksel install lamp-server** <br>

### mysql

Use the following commands:<br>

**apt-get install mysql-server mysql-client** <br>

### php

Use the following commands:<br>

**apt-get install php7.4-mysql php7.4-curl php7.4-json php7.4-cgi php7.4 libapache2-mod-php7.4** <br>

## Database

In order to properly use the application, you will need to configure the database.<br>

Add the Lyst folder to the following directory:<br>

**/var/www/html**<br>

Open the command line, and navigate to the following directory:<br>

**/var/www/html/Lyst**<br>

Login to mysql using root:<br>

**sudo mysql -u root -p**<br>

Once logged into mysql, source the database script with the following command:<br>

**source lyst-26Mar2021-WIP7.sql**<br>

# Running the website

Please open a browser (preferably Firefox or Google Chrome), and navigate to the following URL:<br>

**localhost/Lyst**<br>

Enter an email and password, and click register. Re-enter the email and password, and navigate to the list page.<br>

#### Please enjoy our website!



