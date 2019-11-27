<?php
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }

    include_once '../functions.php';

    $username = fix_string($_POST['username']);
    $password = fix_string($_POST['password']);

    // Save username and password in current session
    $_SESSION['username'] = $username;
    $_SESSION['password'] = $password;

    // Check if the username and password exist in the database here
    $query = "SELECT * FROM members WHERE user='$username'";
    $result = query($query);

    // if the username is incorrect
    if($result->num_rows == 0) {
        // Handle incorrect username here
        $_SESSION['wrong_username'] = 'TRUE';
    } else {
        $_SESSION['wrong_username'] = 'FALSE';
        // Check if the password is incoreect
        $row = $result->fetch_assoc();
        if($row['pass'] !=  $password) {
            $_SESSION['wrong_password'] = 'TRUE';
        } else {
            $_SESSION['wrong_password'] = 'FALSE';
        }
    }

    // Respond to the username and password
    if($_SESSION['wrong_username'] == "TRUE" || $_SESSION['wrong_password'] == "TRUE"){
        include_once 'login.php';
    } else {
        header("Location: ../members.php?view=$username");
        exit;
    }

    function fix_string($string) {
		if(get_magic_quotes_gpc()) $string = stripslashes($string);
		return htmlentities($string);
	}
?>