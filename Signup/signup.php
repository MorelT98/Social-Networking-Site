<!DOCTYPE html>
<html>
	<head>
		<title>Sign Up</title>
		<link rel="stylesheet" type="text/css" href="../style.css">
		<script src="signup.js"></script>
	</head>
	<body>
		<div class="form-style">
			<h2>Sign Up</h2>
			<form id = "form" action="confirm.php" method="post" onsubmit="return validate(this)">
				<input type="text" name="firstname" required="required" placeholder="First Name" />
				<input type="text" name="lastname" required="required" placeholder="Last Name" />
				<input type="text" name="username" required="required" oninput="checkUsernameAvailability(this.value, O('form'))" placeholder="Username" />
				<span class='invalidated' id="spusername">The username should be at least 6 characters</span>
				<input type="password" name="password" required="required" placeholder="Password" />
				<span class='invalidated' id="sppassword">The password should be at least 6 characters</span>
				<input type="password" name="rpassword" required="required" placeholder="Repeat Password" />
				<span class='invalidated' id="sprpassword">The two passwords should be identical</span>
				<input type="text" name="email" required="required" placeholder="Email: myemail@domain.com" />
				<span class='invalidated' id="spemail">Invalid email</span>
				<input type="text" name="age" required="required" placeholder="Age (Between 12 and 110)" />
				<span class='invalidated' id="spage">The age should be between 12 and 110</span>
				<input type="submit" value="Sign Up">
			</form>
		</div>
	</body>
</html>
