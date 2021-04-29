<?php

// File: infoupdate.php
// Group: 3
// Members:
// 	Mykyta Koryliuk
// 	Dominick Smith
// 	Andrew Todd
// 	Xuezhi Wang
// 	Katherine Ziomek
// Purpose of file:
// This file handles updating a user's information.

error_reporting(E_ALL);

ini_set('display_errors', '1');
require_once('connect.php'); //connect
require_once("./DeleteUser.php");

session_start();

//For safety
function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function valuecheck($data){
   	if($data=="1"){		
        //set a session variable for the chosen modal
        $_SESSION['modal'] = "countryAndProvince";
        //redirect
        header('Location: ./modals/modalsUserInfo.php');

		//  echo '<script>alert("Please update your country and province");window.location.href="./userInformation.php";</script>';
		exit();
	}
}

function nullcheck($data){
   	if(!empty($data)){
	}
    else{
        //set a session variable for the chosen modal
        $_SESSION['modal'] = "empty";
        //redirect
        header('Location: ./modals/modalsUserInfo.php');

		//  echo '<script>alert("Please fill out your information");window.location.href="./userInformation.php";</script>';
		exit();
	}
}

$id= $_SESSION["user_id"];
$email = test_input($_POST['email']);
$username = test_input($_POST['user_name']);
$password = test_input($_POST['password']);
$password2 = test_input($_POST['password2']);
$city = test_input($_POST['city']);
$province = test_input($_POST['province']);
$country = test_input($_POST['country']);

nullcheck($email);
nullcheck($username);
nullcheck($city);
valuecheck($province);
valuecheck($country);

try {

    // check password for mistakes
    if ($_POST['password'] !== $_POST['password2']) {
        //set a session variable for the chosen modal
        $_SESSION['modal'] = "mismatch";
        //redirect
        header('Location: ./modals/modalsUserInfo.php');

        // // output error message
        // echo '<script>alert("Password fields do not match\nPlease enter password again");window.location.href="./userInformation.php";</script>';
    }
    // check for funky characters in password
    else if($password !== $_POST['password']) {
        //set a session variable for the chosen modal
        $_SESSION['modal'] = "invalidCharacters";
        //redirect
        header('Location: ./modals/modalsUserInfo.php');

        // echo '<script>alert("Password cannot contain spaces and funky characters\nPlease enter a valid password");window.location.href="./userInformation.php";</script>';
    }
    // password looks good
    else {

        //$password !== ""
        //If post not null
        if (!empty($_POST) && $password !== "" && $password2 !== "") {
            // connect to DB
            $dbh = initialize_database();
            if (isset($_POST['deleteUser'])) {
                $user_id = $_SESSION['user_id'];
            
                delete_user($user_id,$saved_list_id);
            }
            elseif ($password == ""){
                $sql = "UPDATE lyst_database.customers SET email_address='$email',username='$username',city='$city',province_id='$province',country_id='$country' WHERE customer_id='$id';";
            }else{
                $sql = "UPDATE lyst_database.customers SET email_address='$email',username='$username',password=MD5('$password'),city='$city',province_id='$province',country_id='$country' WHERE customer_id='$id';";
            }            
            
            $dbh->exec($sql);
            $dbh = null;
        $_SESSION["username"] = $username;
        //set a session variable for the chosen modal
        $_SESSION['modal'] = "saved";
        //redirect
        header('Location: ./modals/modalsUserInfo.php');  
        // echo '<script>alert("Information Saved");window.location.href="./listPage.php";</script>';
        } 
        else {
            //set a session variable for the chosen modal
            $_SESSION['modal'] = "invalid";
            //redirect
            header('Location: ./modals/modalsUserInfo.php');

            //echo '<script>alert("Invalid Email Address or Password");window.location.href="./userInformation.php";</script>';
        }
    } 
}
    catch (PDOException $e) {
        //check error
        echo $e->getMessage() . '<br>';
        //error line
        echo $e->getLine() . '<br>';
        echo $e->__toString() . '<br>';
    }

?>
