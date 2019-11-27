<?php
	include_once '../functions.php';

	// Sanitize and collect information
	$firstname = ucfirst(strtolower(fix_string($_POST['firstname'])));
	$lastname = ucfirst(strtolower(fix_string($_POST['lastname'])));
	$username = fix_string($_POST['username']);
	$password = fix_string($_POST['password']);
	$age = fix_string($_POST['age']);
	$email = fix_string($_POST['email']);

	// Save values in database here
	// Since we already checked that the username wasn't taken, 
	// we just have to insert it into the database
	$query = "INSERT INTO members VALUES(
		'$username', '$password', '$firstname', '$lastname', '$email', '$age')";
	
	query($query);
	
	// Redirect to his profile
	if(session_status() == PHP_SESSION_NONE) session_start();
	$_SESSION['username'] = $username;
	header("Location: ../profile.php");
    exit;

	function fix_string($string) {
		if(get_magic_quotes_gpc()) $string = stripslashes($string);
		return htmlentities($string);
	}
?>