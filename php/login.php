<?php

// File: login.php
// Group: 3
// Members:
// 	Mykyta Koryliuk
// 	Dominick Smith
// 	Andrew Todd
// 	Xuezhi Wang
// 	Katherine Ziomek
// Purpose of file:
// This file handles the code for user logins from index.php.

session_start();
require_once('connect.php'); //connect

//For safety
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


$username = test_input($_POST['username']); //postusername
// using encrypted passwords - AT (26 Mar 2021)
$password = md5(test_input($_POST['password'])); //postpassword
//$password = test_input($_POST['password']); //postpassword

//For safety
if (!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/", $username)) {
    
	//set a session variable for the chosen modal
	$_SESSION['modal'] = "emailFormatError";
	//redirect
	header('Location: ./modals/modalsRegLogin.php');
}


try {

    if ($username && $password && $password !== "") { //if have all
        // connect to DB
        $dbh = initialize_database();

        //Select in sql
        $sql = "select customer_id,username,password from lyst_database.customers where email_address='$username' AND password='$password';";
        $stmt = $dbh->query($sql);
        $row = $stmt->fetch(PDO::FETCH_BOTH);
        if (empty($row[0])) {
            //error
            //set a session variable for the chosen modal
            $_SESSION['modal'] = "incorrectUserPassword";
            //redirect
            header('Location: ./modals/modalsRegLogin.php');
        } else {
            //Correct
            // setcookie("user_id", $row[0]);
            // $_COOKIE['user_id'] = $row[0];
            session_start();

            $_SESSION["user_id"] = $row[0];
            $_SESSION["username"] = $row[1];
            //echo 'Login success';
            //set a session variable for the chosen modal
            $_SESSION['modal'] = "successfulLogin";
            //redirect
            header('Location: ./modals/modalsRegLogin.php');            
            // echo '<script>alert("Welcome to Lyst!");window.location.href="./currentLists.php";</script>';
        }
    } else { //lost some
        echo "Incorrect Username or Password";
        echo "
                        <script>
                                setTimeout(function(){window.location.href='../index.php';},1000);
                        </script>";

        //back to login;
    }
} catch (PDOException $e) {
    //check error
    echo $e->getMessage() . '<br>';
    //error line
    echo $e->getLine() . '<br>';
    echo $e->__toString() . '<br>';
}
