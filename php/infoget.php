<?php
require_once('connect.php'); //connect

// File: infoget.php
// Group: 3
// Members:
// 	Mykyta Koryliuk
// 	Dominick Smith
// 	Andrew Todd
// 	Xuezhi Wang
// 	Katherine Ziomek
// Purpose of file:
// This file handles identifying the information from the userInformation.php inputs.

try {

session_start();
    // connect to DB
    $dbh = initialize_database();

    //Select in sql
    $userid =$_SESSION["user_id"];
    $sql = "select email_address,username,city,province_id,country_id from lyst_database.customers where customer_id='$userid'";
    $stmt = $dbh->query($sql);
    $row = $stmt->fetch(PDO::FETCH_BOTH);
    if (empty($row[0])) {
        //error
        echo '<script>alert("Error: Incorrect Username or Password");window.location.href="../index.php";</script>';
    } else {
        //Correct
        $email = $row[0];
        $username = $row[1];
        $city = $row[2];
        $provinceid =$row[3];
        $countryid = $row[4];
    }



} catch (PDOException $e) {
    //check error
    echo $e->getMessage() . '<br>';
    //error line
    echo $e->getLine() . '<br>';
    echo $e->__toString() . '<br>';
}

