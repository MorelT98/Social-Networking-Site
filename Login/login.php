<!DOCTYPE html>
<html>
	<head>
		<title>Sign In</title>
		<?php if(session_status() == PHP_SESSION_NONE) session_start(); ?>
		<?php
			if(!isset($_SESSION['username'])){
				$_SESSION['username'] = "";
			}
			if(!isset($_SESSION['password'])){
				$_SESSION['password'] = "";
			}
			if(!isset($_SESSION['wrong_username'])){
				$_SESSION['wrong_username'] = "FALSE";
			}
			if(!isset($_SESSION['wrong_password'])){
				$_SESSION['wrong_password'] = "FALSE";
			}
		?>
		<link rel="stylesheet" type="text/css" href="../style.css">
		<!-- <script src="login.js"></script> -->
	</head>
	<body>
		<div class="form-style">
			<h2>Sign In</h2>
			<form id = "form" action="confirm.php" method="POST">
				<input type="text" id="username" name="username" required="required" placeholder="Username" />
				<span class="invalidated" id="spusername">Incorrect username.</span>
				<input type="password" id="password" name="password" required="required" placeholder="Password" />
				<span class="invalidated" id="sppassword">Incorrect password</span>

				<!--hidden input coming containing php values-->
				<input type="hidden" id="wrong_username" name="wrong_username" value="<?php echo $_SESSION['wrong_username']; ?>">
				<input type="hidden" id="wrong_password" name="wrong_password" value="<?php echo $_SESSION['wrong_password']; ?>">
				<input type="hidden" id="old_username" name="old_username" value="<?php echo $_SESSION['username']; ?>">
				<input type="hidden" id="old_password" name="old_password" value="<?php echo $_SESSION['password']; ?>">

				
				<script>
					function O(id) {
						return document.getElementById(id);
					}
					
					results = {
						"wrong_username":O('wrong_username').value,
						"wrong_password":O('wrong_password').value,
						"username":O('old_username').value,
						"password":O('old_password').value
					}
					console.log(results);
					// Check if the previous username and password were wrong
					if(O('wrong_username').value == 'TRUE'){
						O('spusername').style.display = 'block';
					} else {
						O('spusername').style.display = 'none';
					}

					if(O('wrong_password').value == 'TRUE'){
						O('sppassword').style.display = 'block';
					} else {
						O('sppassword').style.display = 'none';
					}

					// Reenter the previously entered username and password
					old_username = O('old_username').value;
					if(old_username == ""){
						O('username').placeholder = "Username";
					} else {
						O('username').value = old_username;
					}

					old_password = O('old_password').value;
					if(old_password == ""){
						O('password').placeholder = "Password";
					} else {
						O('password').value = old_password;
					}
				</script>
				<br>
				<input type="submit" value="Sign In" >
			</form>
		</div>
	</body>
</html>