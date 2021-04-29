<?php 
    declare(strict_types=1); // strict type checking
    session_start();
    // var_dump($_SESSION);
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
This file contains the modals for the listPage.php page
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
        //saved list
        if($_SESSION['modal'] == "saved") { ?>
            $(document).ready(function(){
                $('#saved').modal('show');
            });
        <?php
        }
        //updated list
        elseif($_SESSION['modal'] == "updated") { ?>
            $(document).ready(function(){
                $('#updated').modal('show');
            });
        <?php
        }
        //deleted list
        elseif($_SESSION['modal'] == "deleted") { ?>
            $(document).ready(function(){
                $('#deleted').modal('show');
            });
        <?php
        }
        ?>     
    </script>
</head>

<body class="bg-light text-dark">

    <!--Modal for a saved list-->
    <div class="modal" id="saved" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Success!</h5>
            </div>
            <div class="modal-body">
                <p>New list has been saved.</p>
                <p></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="window.location.href='../listPage.php'">Create a New List</button>
                <button type="button" class="btn btn-primary" onclick="window.location.href='../currentLists.php'">See All Lists</button>
            </div>
            </div>
        </div>
    </div>    

    <!--Modal for an updated list-->
    <div class="modal" id="updated" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Success!</h5>
            </div>
            <div class="modal-body">
                <p>Your list has been updated.</p>
                <p></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="window.location.href='../listPage.php'">Create a New List</button>
                <button type="button" class="btn btn-primary" onclick="window.location.href='../currentLists.php'">See All Lists</button>
            </div>
            </div>
        </div>
    </div>   

    <!--Modal for a deleted list-->
    <div class="modal" id="deleted" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Success!</h5>
            </div>
            <div class="modal-body">
                <p>Your list has been deleted.</p>
                <p></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="window.location.href='../listPage.php'">Create a New List</button>
                <button type="button" class="btn btn-primary" onclick="window.location.href='../currentLists.php'">See All Lists</button>
            </div>
            </div>
        </div>
    </div>   


</body>
</html>