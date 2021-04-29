<!-- 
File: index.php
Group: 3
Members:
	Mykyta Koryliuk
	Dominick Smith
	Andrew Todd
	Xuezhi Wang
	Katherine Ziomek
Purpose of file:
This is the main landing page of our website application.
 -->

<?php
session_start();

// var_dump($_SESSION);
// echo "<br><br>";


function logincheck()
{
    $id = $_SESSION["user_id"];
    echo $id;
    if (!empty($id)) {
        echo $id;
        echo '<script>window.location.href="./php/logined.php";</script>';
        exit();
    }
}
logincheck();
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!--Google Fonts-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic&family=Noto+Sans+KR&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">

    <title>Lyst</title>

    <script src="js/Login.js"></script>
    <script src="js/Register.js"></script>
</head>

<body class="bg-light text-dark">

    <!--Use Bootstrap grids to section off the main page-->
    <div class="container">
        <div class="row justify-content-center vertical-center">
            <!--text div-->
            <div class="col-lg-8">
                <!--Product Name-->
                <h1 class="display-1 SourceCodePro mb-4" id="LystTitle">Lyst</h1>

                <!--Product Vision Statement-->
                <p class="lead NanumGothic mb-5">
                    Our purpose is to empower households by helping them save money<br class="lineBreak"> and stay organized when grocery shopping.
                </p>
                <hr class="bg-light hidden mb-5">
            </div>
            <!--Div containing the user login/register form-->
            <div class="col-md-4 NanumGothic">
                <h1 class="display-5 text-center mb-4 NanumGothic">Sign In</h1>
                <form name="form1" id="form1" method="post">
                    <!--Optional Username Form
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="username" class="form-control" id="username" aria-describedby="usernameHelp" placeholder="Enter username">
                        </div>
                        -->
                    <!--Email text input-->
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="username" name="username" aria-describedby="emailHelp" placeholder="Enter email">
                    </div>
                    <!--Password text input-->
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    </div>
                    <!--Login button for existing users-->
                    <button type="submit" class="btn btn-primary full-width mt-3 mb-3 p-2" onclick="login();">Login</button><br>
                    <hr class="bg-light">
                    <!--Register button for new users-->
                    <button type="submit" class="btn btn-info full-width mt-3 p-2 mb-4" onclick="register();">Create a New Account</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
