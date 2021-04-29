<?php 

// File: PHP Validation.php
// Group: 3
// Members:
// 	Mykyta Koryliuk
// 	Dominick Smith
// 	Andrew Todd
// 	Xuezhi Wang
// 	Katherine Ziomek
// Purpose of file:
// This is a WIP file that will handle PHP validations in future sprints.


$text = "";
$err_msg="";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	// Text 
	if (!isset($_POST['text'])) {
		$error_msg[] = "There must be text in the field ";
	} else {
		$text = trim(htmlentities($_POST['text']));
		if (empty($text)) {
			$error_msg[] = "The area cannot be empty";
		} else if (strlen($text) >  5) {
			$error_msg[] = "The list must contain at least one thing";
		}
	}
}

?>