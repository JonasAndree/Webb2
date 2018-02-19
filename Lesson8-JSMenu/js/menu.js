console.log("JS working");
/* This is how functions work in javascript.*/

var navHidden = false;

function toggleMenu(menuState) {
	menuState.classList.toggle("change");
	
	var nav = document.getElementById("nav");
	
	if(navHidden == false) {
		nav.style.width = "0px";
		nav.style.opacity = "0";
		navHidden = true;
	} else {
		nav.style.width = "250px";
		nav.style.opacity = "1";
		navHidden = false;
	}
}