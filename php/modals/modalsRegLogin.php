<?php 
    declare(strict_types=1); // strict type checking
    session_start();

    // //for testing
    // var_dump($_SESSION);
    // echo "<br><br>";
    // var_dump($_POST);
?>
<!-- 
File: modalsUserInfo.php
Group: 3
Members:
	Mykyta Koryliuk
	Dominick Smith
	Andrew Todd
	Xuezhi Wang
	Katherine Ziomek
Purpose of file:
This file contains the modals for the userInformation.php page
 -->


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--Google Fonts-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic&family=Noto+Sans+KR&display=swap" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/style.css"> 

    <title>Lyst</title>

    <!--JavaScript and PHP code that handles calling the modals-->
    <script>
        <?php
        //logging out
        if($_SESSION['modal'] == "logout") { ?>
            $(document).ready(function(){
                $('#logout').modal('show');
            });
        <?php
        }
        //empty fields/bad email
        elseif($_SESSION['modal'] == "emailFormatError") { ?>
            $(document).ready(function(){
                $('#emailFormatError').modal('show');
            });
        <?php
        }
        //incorrect user or password
        elseif($_SESSION['modal'] == "incorrectUserPassword") { ?>
            $(document).ready(function(){
                $('#incorrectUserPassword').modal('show');
            });
        <?php
        }
        //user is existing
        elseif($_SESSION['modal'] == "existing"){ ?>
            $(document).ready(function(){
                $('#existing').modal('show');
            });
        <?php 
        }
        //asking user to login
        elseif($_SESSION['modal'] == "pleaseLogin"){ ?>
            $(document).ready(function(){
                $('#pleaseLogin').modal('show');
            });
        <?php
        }
        //telling user to complete their information
        elseif($_SESSION['modal'] == "completeInfo") {
        ?>
            $(document).ready(function(){
                $('#completeInfo').modal('show');
            });
        <?php
        }
        elseif($_SESSION['modal'] == "successfulLogin") {
        ?>
            $(document).ready(function(){
                $('#successfulLogin').modal('show');
            });
        <?php
        // //delete the session ONLY IF the user is deleted
        // //uncomment when everything else is ready to go
        // //unset($_SESSION);
        // unset($_SESSION['modal']);
        }
        
        ?>
    </script>
</head>

<body class="bg-light text-dark">

    <!--Modal for logging out-->
    <div class="modal" id="logout" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Success!</h5>
            </div>
            <div class="modal-body">
                <p>You have been logged out successfully.</p>
                <p>Thank you for using Lyst!</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="window.location.href='../../index.php'">Back to Home</button>
            </div>
            </div>
        </div>
    </div>    

    <!--Modal for bad email/empty fields-->
    <div class="modal" id="emailFormatError" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Error!</h5>
            </div>
            <div class="modal-body">
                <p>Incorrect email format.</p>
                <p>Make sure that your email is formatted correctly.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="window.location.href='../../index.php'">Back to Home</button>
            </div>
            </div>
        </div>
    </div>    

    <!--Modal for invalid username or password-->
    <div class="modal" id="incorrectUserPassword" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Error!</h5>
            </div>
            <div class="modal-body">
                <p>Incorrect username and/or password.</p>
                <p>Please enter a valid username and password.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="window.location.href='../../index.php'">Back to Home</button>
            </div>
            </div>
        </div>
    </div>   

    <!--Modal for existing account-->
    <div class="modal" id="existing" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Error!</h5>
            </div>
            <div class="modal-body">
                <p>There is already an existing account with these details.</p>
                <p>Try logging in instead.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="window.location.href='../../index.php'">Back to Home</button>
            </div>
            </div>
        </div>
    </div>  

    <!--Modal for telling the user to login-->
    <div class="modal" id="pleaseLogin" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Please login</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="window.location.href='../../index.php'">Back to Home</button>
            </div>
            </div>
        </div>
    </div>  

    <!--Modal for telling the user to complete their information-->
    <div class="modal" id="completeInfo" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Welcome to Lyst!</h5>
            </div>
            <div class="modal-body">
                <p>Please complete your account information before signing in.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="window.location.href='../userInformation.php'">Continue</button>
            </div>
            </div>
        </div>
    </div>  

    <!--Modal for deleting a user-->
    <div class="modal" id="successfulLogin" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Welcome back to Lyst!</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="window.location.href='../currentLists.php'">Continue</button>
            </div>
            </div>
        </div>
    </div>      

</body>
</html>