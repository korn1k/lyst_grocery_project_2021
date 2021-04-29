<?php

// File: connect.php
// Group: 3
// Members:
// 	Mykyta Koryliuk
// 	Dominick Smith
// 	Andrew Todd
// 	Xuezhi Wang
// 	Katherine Ziomek
// Purpose of file:
// This file handles the database connection for index.php.

// ini_set("display_errors", "On");
// error_reporting(E_ALL | E_STRICT);

function initialize_database()
{
    define("servername", "mysql:host=localhost;dbname=lyst_database");
    define("username", "lyst_admin");
    define("password", "!lystProject2021!");

    try {
        global $conn;

        $conn = new PDO(servername, username, password);

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $conn;
        echo "Connected successfully";
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}

?>