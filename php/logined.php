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
 $id = $_SESSION["user_id"];
 $username = $_SESSION["username"];

 ?>
 <!doctype html>
<html lang="en">

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

    <title>Lyst</title>

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
                <br>
                <h5 class="display-5 text-center mb-10 NanumGothic">Hello, <?php echo $username;?></h5>
                <br>
                <a href="./logout.php"><button class="btn btn-primary full-width mt-3 mb-3 p-2">Logout</button></a>
                <hr class="bg-light">
                <a href="./currentLists.php"><button class="btn btn-info full-width mt-3 mb-3 p-2">Back Home</button></a><br>
            </div>
        </div>
    </div>
</body>

</html>
