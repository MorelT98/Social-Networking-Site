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