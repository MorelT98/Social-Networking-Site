<?php
	include_once '../functions.php';

	if(isset($_GET['username'])) {
		// Check if the username is in the database here
		$username = sanitize_string($_GET['username']);
		$query = "SELECT user FROM members WHERE user='$username'";
		$result = query($query);
		if($result->num_rows > 0) echo "taken";
		else echo "";
	}


	// // Just output this for now
	// if(isset($_GET['username'])) {
	// 	echo "taken";
	// }
?>