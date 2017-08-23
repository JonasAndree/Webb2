console.log("JS working");

var toggleMenuBoolean = false;

/* This is how functions work in javascript.*/
function toggleMenu(menuState) {
	// Toggles the change class of the child elements to the 
	// sent element.x	
	menuState.classList.toggle("change");
	
	// toggles the value between false and true.
	toggleMenuBoolean = !toggleMenuBoolean;
	if(toggleMenuBoolean) {
		document.getElementById("nav").style.width = "200px";
	} else {
		document.getElementById("nav").style.width = "0px";
	}
	
	//  Automaticly toggles the class
	document.getElementById("nav-ul").classList.toggle("change");
	
}