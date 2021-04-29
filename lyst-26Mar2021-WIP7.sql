-- lyst.sql
-- Mar 26, 2021
-- Version 7 WIP
-- Group 3

-- delete the database if it exists
drop database if exists lyst_database;

-- create the new database
create database lyst_database CHARACTER SET utf8 COLLATE utf8_bin;

-- delete the database user account if it exists
drop USER if exists 'lyst_admin'@'localhost';

-- create the new user
create USER 'lyst_admin'@'localhost' IDENTIFIED BY '!lystProject2021!';
grant ALL PRIVILEGES on lyst_database.* TO 'lyst_admin'@'localhost';

-- select the database to use
use lyst_database;

-- create countries table 
create table countries (
    country_id int AUTO_INCREMENT NOT NULL,
    country_name varchar(50) NOT NULL,
    CONSTRAINT pk_countries PRIMARY KEY (country_id)
);

-- create provinces table 
create table provinces(
    province_id int AUTO_INCREMENT NOT NULL,
    province_name varchar(50) NOT NULL,
    CONSTRAINT pk_provinces PRIMARY KEY (province_id)
);

-- create passwords table (if necessary)


-- create customers table
create table customers(
    customer_id int AUTO_INCREMENT NOT NULL,
    email_address varchar(100) NOT NULL,
    username varchar(50) NOT NULL,
    password varchar(50) NOT NULL,
    city varchar(50) NOT NULL,
    province_id int NOT NULL,
    country_id int NOT NULL,
    CONSTRAINT pk_customers PRIMARY KEY (customer_id),
    CONSTRAINT fk_customers_provinces_province_id FOREIGN KEY (province_id) REFERENCES provinces(province_id),
    CONSTRAINT fk_customers_countries_country_id FOREIGN KEY (country_id) REFERENCES countries(country_id)
);

-- create items table
create table items(
    item_id int AUTO_INCREMENT NOT NULL,
    item_name varchar(50) NOT NULL,
    CONSTRAINT pk_items PRIMARY KEY (item_id)
);

-- create saved_lists table
create table saved_lists(
    saved_list_id int AUTO_INCREMENT NOT NULL,
    title varchar(50) NULL,    
    notes varchar(100) NULL,
    customer_id int NOT NULL,
    created_date datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    modified_date datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT pk_saved_list PRIMARY KEY (saved_list_id),    
    CONSTRAINT fk_saved_lists_customers_customer_id FOREIGN KEY (customer_id) REFERENCES customers(customer_id)
);

-- create current_list table
create table current_list(
    current_list_id int AUTO_INCREMENT NOT NULL,
    list_id int NOT NULL,
    item_id int NOT NULL,
    quantity int NULL,
    notes varchar(100) NULL,
    CONSTRAINT pk_current_list PRIMARY KEY (current_list_id),
    CONSTRAINT fk_current_list_saved_lists_list_id FOREIGN KEY (list_id) REFERENCES saved_lists(saved_list_id),
    CONSTRAINT fk_current_list_items_item_id FOREIGN KEY (item_id) REFERENCES items(item_id)
);

-- insert data into countries table
insert into countries (country_name) values ("Please select a country"), ("Canada");

-- insert data into provinces table
insert into provinces (province_name) values ("Please select a province"), ("Alberta"), ("British Columbia"), ("Manitoba"), ("Newfoundland"), ("New Brunswick"), ("Northwest Territories"), ("Nova Scotia"), ("Nunavut"), ("Ontario"), ("Prince Edward Island"), ("Quebec"), ("Saskatchewan"), ("Yukon");

-- insert data into items table
insert into items (item_name) values ("Apples"), ("Ham"), ("Baguette"), ("Steak"), ("Milk"), ("Fries"), ("Doritos"), ("Dish Soap"), ("Flowers");

-- insert a test customer
insert into customers (email_address, username, password, city, province_id, country_id) values ("test@test.com" , "test", MD5("test"), "London", 10, 2);

-- create a saved_list
insert into saved_lists (title, notes, customer_id) values ("Test List", "Test Notes", 1);
insert into saved_lists (customer_id) values (1);

-- create a current_list
insert into current_list (list_id, item_id, quantity) values (1,1,1), (1,2,1), (1,3,1), (1,4,1);