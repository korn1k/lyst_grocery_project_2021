<?php 
    declare(strict_types=1); // strict type checking
    session_start();
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
        //empty country and province
        if($_SESSION['modal'] == "countryAndProvince") { ?>
            $(document).ready(function(){
                $('#countryAndProvince').modal('show');
            });
        <?php
        }
        //empty fields
        elseif($_SESSION['modal'] == "empty") { ?>
            $(document).ready(function(){
                $('#empty').modal('show');
            });
        <?php
        }
        //passwords don't match
        elseif($_SESSION['modal'] == "mismatch") { ?>
            $(document).ready(function(){
                $('#mismatch').modal('show');
            });
        <?php
        }
        //password has invalid characters
        elseif($_SESSION['modal'] == "invalidCharacters"){ ?>
            $(document).ready(function(){
                $('#invalidCharacters').modal('show');
            });
        <?php 
        }
        //user information has been saved
        elseif($_SESSION['modal'] == "saved"){ ?>
            $(document).ready(function(){
                $('#saved').modal('show');
            });
        <?php
        }
        //invalid user information
        elseif($_SESSION['modal'] == "invalid") {
        ?>
            $(document).ready(function(){
                $('#invalid').modal('show');
            });
        <?php
        }
        elseif($_SESSION['modal'] == "deletedUser") {
        ?>
            $(document).ready(function(){
                $('#deletedUser').modal('show');
            });
        <?php
        //delete the session ONLY IF the user is deleted
        //uncomment when everything else is ready to go
        //unset($_SESSION);
        }
        ?>
    </script>
</head>

<body class="bg-light text-dark">

    <!--Modal for invalid email or password-->
    <div class="modal" id="invalid" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Error!</h5>
            </div>
            <div class="modal-body">
                <p>Invalid Email Address or Password.</p>
                <p>Tip: Make sure to enter your password when changing or updating account information.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="window.location.href='../userInformation.php'">Back</button>
                <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
            </div>
            </div>
        </div>
    </div>    

    <!--Modal for saved user information-->
    <div class="modal" id="saved" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Success!</h5>
            </div>
            <div class="modal-body">
                <p>Your information has been updated!</p>
                <p>Make sure to never share your credentials with anyone else.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="window.location.href='../userInformation.php'">Back to Account Details</button>
                <button type="button" class="btn btn-primary" onclick="window.location.href='../currentLists.php'">See All Saved Lists</button>
            </div>
            </div>
        </div>
    </div>    

    <!--Modal for invalid/funky characters-->
    <div class="modal" id="invalidCharacters" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Error!</h5>
            </div>
            <div class="modal-body">
                <p>Your password cannot contain spaces or funky characters.</p>
                <p>Please enter a valid password.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="window.location.href='../userInformation.php'">Back</button>
                <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
            </div>
            </div>
        </div>
    </div>   

    <!--Modal for passwords that don't match-->
    <div class="modal" id="mismatch" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Error!</h5>
            </div>
            <div class="modal-body">
                <p>Password fields do not match.</p>
                <p>Please enter passwords again.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="window.location.href='../userInformation.php'">Back</button>
                <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
            </div>
            </div>
        </div>
    </div>  

    <!--Modal for empty fields-->
    <div class="modal" id="empty" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Error!</h5>
            </div>
            <div class="modal-body">
                <p>User information fields cannot be empty.</p>
                <p>Please fill out your information before submitting.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="window.location.href='../userInformation.php'">Back</button>
                <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
            </div>
            </div>
        </div>
    </div>  

    <!--Modal for empty country and/or province-->
    <div class="modal" id="countryAndProvince" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Error!</h5>
            </div>
            <div class="modal-body">
                <p>Country and/or province cannot be blank.</p>
                <p>Please update your country and province.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="window.location.href='../userInformation.php'">Back</button>
                <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
            </div>
            </div>
        </div>
    </div>  

    <!--Modal for deleting a user-->
    <div class="modal" id="deletedUser" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Your Account Has Been Deleted</h5>
            </div>
            <div class="modal-body">
                <p>Thank you for using Lyst.</p>
                <p>We hope to see you again!</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="window.location.href='../../index.php'">Return to Login</button>
            </div>
            </div>
        </div>
    </div>      

</body>
</html>