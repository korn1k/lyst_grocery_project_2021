<?php

declare(strict_types=1); // strict type checking
session_start();

// File: userInformation.php
// Group: 3
// Members:
// 	Mykyta Koryliuk
// 	Dominick Smith
// 	Andrew Todd
// 	Xuezhi Wang
// 	Katherine Ziomek
// Purpose of file:
// This file outputs a form that displays the currently logged in user's information, and allows a user to update that information.

//includes go here
define('__ROOT__', dirname(__FILE__));
// Includes
require_once("./navigationBar.php");
require_once("./infoget.php");
//session variables, etc.

?>

<!DOCTYPE html>
<html lang='en'>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">

    <!--Google Fonts-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic&family=Noto+Sans+KR&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/style.css">

    <title>Lyst - Account Details</title>
</head>

<body class="bg-light text-dark">

    <!--include nav bar here-->
    <?php
    //this was included for testing purposes only
    //can be removed/changed if another method is used (or if sessions are used) 
    displayNavBar();
    ?>

    <!--using Bootstrap grids to center the user information-->
    <div class="container">
        <div class="row">
            <!--first column-->
            <div class="col-lg-2"></div>
            <!--middle column-->
            <div class="col-lg-8">
                <!--"User Information" heading-->
                <h1 class="display-4 text-center mb-4 mt-4 NanumGothic">Account Details</h1>
                <hr class="bg-muted">


                <!--user information form-->
                <form action='infoupdate.php' method='post' class="pt-3 pb-5 mb-2 mt-3 NanumGothic">
                    <!--email address-->
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="text" class="form-control" id="email" name="email" maxlength=100 value="<?php echo $email; ?>">
                    </div>
                    <!--user name-->
                    <div class="form-group">
                        <label for="user_name">User Name</label>
                        <input type="text" class="form-control" id="user_name" name="user_name" maxlength=50 value="<?php echo $username; ?>">
                    </div>
                    <!--password-->
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" maxlength=50 value="">
                    </div>
                    <!--repeat password-->
                    <div class="form-group">
                        <label for="password">Retype Password</label>
                        <input type="password" class="form-control" id="password2" name="password2" maxlength=50 value="">
                    </div>
                    <div class="row form-group">
                        <!--city-->
                        <div class="col">
                            <label for="city">City</label>
                            <input type="text" class="form-control" id="city" name="city" maxlength=50 value="<?php echo $city; ?>">
                        </div>
                        <!-- province - 
                            note: can be changed to drop-down if that is preferred -->
                        <div class="col">
                            <label for="province">Province</label>
                            <select id="province" name="province" class="form-control">
                                <option value="1">Please select a province</option>
                                <option value="2">Alberta</option>
                                <option value="3">British Columbia</option>
                                <option value="4">Manitoba</option>
                                <option value="5">Newfoundland</option>
                                <option value="6">New Brunswick</option>
                                <option value="7">Northwest Territories</option>
                                <option value="8">Nova Scotia</option>
                                <option value="9">Nunavut</option>
                                <option value="10">Ontario</option>
                                <option value="11">Prince Edward Island</option>
                                <option value="12">Quebec</option>
                                <option value="13">Saskatchewan</option>
                                <option value="14">Yukon</option>
                            </select>
                        </div>
                        <script type="text/javascript">
                            function changeprovince($provinceid) {
                                document.getElementById("province")[$provinceid-1].selected = true;
                            }
                            changeprovince(<?php echo $provinceid; ?>);
                        </script>

                    </div>
                    <div class="row form-group">
                        <!--country - 
                        note: can be changed to drop-down if that is preferred -->
                        <div class="col">
                            <label for="country">Country</label>
                            <select id="country" name="country" class="form-control" >
                                <option value="1">Please select a Country</option>
                                <option value="2">Canada</option>
                            </select>
                        </div>
                        <script type="text/javascript">
                            function changecountry($country) {
                                document.getElementById("country")[$country-1].selected = true;
                            }
                            changecountry(<?php echo $countryid; ?>);
                        </script>
                        <div class="col"></div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <!--ubdate button-->
                                <div class="d-flex justify-content-center mt-5">
                                    <button type="submit" name="updateInfo" class="btn btn-primary full-width mt-3 mb-3 p-2" data-toggle="popover" title="Click to update your information.">Save Information</button>
                                </div>
                            </div>
                            <?php
                            
                                if($city!='none'){
                                    echo '
                                    <div class="col">
                                    <!--delete button-->
                                    <div class="d-flex justify-content-center mt-5">
                                        <button type="submit" name="deleteUser" class="btn btn-danger full-width mt-3 mb-3 p-2" data-toggle="popover" title="Click to delete your account.">Delete User Account</button>
                                    </div>
                                    </div>
                                    ';
                                }
                            ?>
 
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!--third column-->
        <div class="col-lg-2"></div>
    </div>
</body>

</html>
