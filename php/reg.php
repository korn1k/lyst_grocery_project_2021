<?php

// File: reg.php
// Group: 3
// Members:
// 	Mykyta Koryliuk
// 	Dominick Smith
// 	Andrew Todd
// 	Xuezhi Wang
// 	Katherine Ziomek
// Purpose of file:
// This file handles validations and matching regular expressions (regex) for user logins/registrations

session_start();
//error_reporting(E_ALL);

ini_set('display_errors', '1');
require_once('connect.php'); //connect

//For safety
function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


$username = test_input($_POST['username']); //postusername
// passwords are encrypted in the db - AT
$password = md5(test_input($_POST['password'])); //postpassword


//For safety
if (!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/",$username)) {
	//set a session variable for the chosen modal
	$_SESSION['modal'] = "emailFormatError";
	//redirect
	header('Location: ./modals/modalsRegLogin.php');

	exit();
}

try {


    //If post not null
    if (!empty($_POST) && $password !== "") {
        // connect to DB
        $dbh = initialize_database();

        $sql = "insert into lyst_database.customers (email_address,username,password,city,province_id,country_id) values('$username','$username','$password','none',1,1);";
        $stmt = $dbh->query("select username from lyst_database.customers where username='$username';");
        //Check
        $row = $stmt->fetch(PDO::FETCH_BOTH);


        if (empty($row[0])) //if already have this username
        {
            	$dbh->exec($sql);
            	$dbh = null;
 		try {
            

                    // connect to DB
                    $dbh = initialize_database();
            
                    //Select in sql
                    $sql = "select customer_id,username,password from lyst_database.customers where email_address='$username' AND password='$password';";
                    $stmt = $dbh->query($sql);
                    $row = $stmt->fetch(PDO::FETCH_BOTH);
                    if (empty($row[0])) {
                        // //error
	                    $_SESSION['modal'] = "emailFormatError";
                        //redirect
                        header('Location: ./modals/modalsRegLogin.php');
                    } else {
                        //Correct
                        session_start();
            
                        $_SESSION["user_id"] = $row[0];
                        $_SESSION["username"] = $row[1];
                        //echo 'Login success';
                        header('Location: ./currentLists.php');
                    }

            	} catch (PDOException $e) {
                	// //check error
                	// echo $e->getMessage() . '<br>';
                	// //error line
                	// echo $e->getLine() . '<br>';
                	// echo $e->__toString() . '<br>';
            	}
            
           
        } else {
		echo '<script>alert("Error: Existing Username/Email");window.location.href="../index.php";</script>';
            //set a session variable for the chosen modal
            $_SESSION['modal'] = "existing";
            //redirect
            header('Location: ./modals/modalsRegLogin.php');
            $dbh = null;
        }
    } else {
        //set a session variable for the chosen modal
        $_SESSION['modal'] = "emailFormatError";
        //redirect
        header('Location: ./modals/modalsRegLogin.php');

    }
} catch (PDOException $e) {
    //check error
    echo $e->getMessage() . '<br>';
    //error line
    echo $e->getLine() . '<br>';
    echo $e->__toString() . '<br>';
}
