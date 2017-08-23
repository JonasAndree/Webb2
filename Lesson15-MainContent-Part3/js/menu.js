console.log("JS working");

var toggleMenuBoolean = false;

/* This is how functions work in javascript.*/
function toggleMenu() {
	// Toggles the change class of the child elements to the 
	// sent element.x	
	
	/** This needs to be changed so that we can call the function!*/
	document.getElementById("menu-button").classList.toggle("change");
	
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

/** Introducing event listeners  */
document.getElementById("main").addEventListener("click", displayDate);

function displayDate() {
	/** Do the alert first alert ("Event Listeners are great!!!!!"); */
	 if (toggleMenuBoolean)
		 toggleMenu();
}