usernameTaken = false;

/*
	Checks the user imputs and returns true if the i
	mputs are valid, false if not
*/
function validate(form){
	fails = {
		"username": validateUsername(form.username.value),
		"password": validatePassword(form.password.value),
		"rpassword": validateRPassword(form.password.value, form.rpassword.value),
		"email": validateEmail(form.email.value),
		"age": validateAge(form.age.value)
	};
	console.log(fails);
	if (fails["username"] == "" &&
		fails["password"] == "" &&
		fails["rpassword"] == "" &&
		fails["email"] == "" &&
		fails["age"] == "")
		return !usernameTaken;
	else {
		if((fails["username"] == "") && usernameTaken)
			fails["username"] = form.username.value + " is already taken.";
		showErrors(fails, form);
		return false;
	}
}

function validateUsername(field) {
	if(field.length < 5)
		return "Usernames must be at least 5 characters";
	else if(/[^a-zA-Z0-9_-]/.test(field))
		return "Only a-z, A-Z, 0-9, _ and - are allowed in usernames.";
	else return "";
}

function validatePassword(field) {
	if(field.length < 6)
		return "Passwords must be at least 6 characters";
	else if(!/[a-z]/.test(field) || !/[A-Z]/.test(field) || !/[0-9]/.test(field))
		return "Passwords require one each of a-z, A-Z and 0-9";
	else return "";
}

function validateRPassword(password, rpassword){
	if(password == rpassword) return "";
	else return "The two passwords should be identical."
}

function validateAge(field) {
	if(isNaN(field)) return "No age was entered.";
	else if(field < 12 || field > 110)
		return "Age must be between 12 and 110";
	else return "";
}

function validateEmail(field) {
	if(!((field.indexOf(".") > 0) && (field.indexOf("@") > 0)) || /[^a-zA-Z0-9.@_-]/.test(field))
		return "The email address is invalid."
	else return "";
}

/*
	Shows the validation errors, if any
*/
function showErrors(fails, form){
	for (var id in fails) {
		var spid = 'sp' + id;
		if (fails[id] != "") {
			O(spid).innerHTML = fails[id];
			S(spid).display = 'block';
		} else hideError(spid);
	}
}

/*
	Hides the span given by its id, when there is no error associated
*/
function hideError(id){
	O(id).innerHTML = "";
	S(id).display = "none";
}


/*
	This function uses AJAX to check if the username entered by the user
	is already in the database
*/
function checkUsernameAvailability(username, form) {
	if(username == "") {
		 hideError("spusername");
		 return;
	}
	if(validateUsername(username) != "") return;
	xhttp = new XMLHttpRequest();
	nochache = "&nochache" + Math.random() * 1000000;

	xhttp.onreadystatechange = function() {
		if(this.readyState == 4 && this.status == 200) {
			console.log(this.responseText);
			if(this.responseText != "") {
				var fail = {"username": username + " is already taken."};
				usernameTaken = true;
				showErrors(fail, form);
			} else {
				usernameTaken = false;
				hideError("spusername");
			}
		}
	}
	xhttp.open("GET", "checkusername.php?username=" + username + nochache, true);
	xhttp.send();
}
































/*
	Given an id, this function returns the html element that has that id;
	Given an object, the function just returns the same object.
*/
function O(obj){
	if(typeof obj == 'object') return obj;
	else return document.getElementById(obj);
}

/*
	Returns the style of an object, or of the object with the given id
*/
 function S(obj){
	return O(obj).style;
}

/*
	Return all the html objects whose class corresponds to the given class name
*/
function C(name){
	var elements = document.getElementByTagName('*');
	var objects = []

	for(var i = 0; i < elements.length; i++) {
		if(elements[i].className == name)
			objects.push(elements[i]);
	}

	return objects;
}