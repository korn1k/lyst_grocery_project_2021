<?php

	session_start();
	$_SESSION["user_id"] = "";
	
	//set a session variable for the chosen modal
	$_SESSION['modal'] = "logout";
	//redirect
	header('Location: ./modals/modalsRegLogin.php');

// File: logout.php
// Group: 3
// Members:
// 	Mykyta Koryliuk
// 	Dominick Smith
// 	Andrew Todd
// 	Xuezhi Wang
// 	Katherine Ziomek
// Purpose of file:
// This file handles logging out of the website.
?>
