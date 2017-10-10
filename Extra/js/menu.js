var toggleMainMenu = true;

var navContainer = document.getElementById("nav-container");


if (toggleMainMenu) {
	navContainer.style.height = "200px";
	navContainer.style.opacity = "1";
} else {
	navContainer.style.height = "0px";
	navContainer.style.opacity = "0";
}

function toggleMenu(menuElement) {	
	menuElement.classList.toggle("change");
	toggleMainMenu = !toggleMainMenu;
	if (toggleMainMenu) {
		navContainer.style.height = "200px";
		navContainer.style.opacity = "1";
	} else {
		navContainer.style.height = "0px";
		navContainer.style.opacity = "0";
	}	
}

window.addEventListener("resize", function(event) {
	console.log("Height" + window.innerHeight);
	console.log("Width" + window.innerWidth);
});




var toggleStateToBe = true;
function toggleingAContainer() {
	var element = document.getElementById("to-be-or-not-to-be");
	if (toggleStateToBe) {
		element.style.height = "0px";
		element.style.opacity = "0";
	} else {
		element.style.height = "200px";
		element.style.opacity = "1";
	}
	
	toggleStateToBe = !toggleStateToBe;
}