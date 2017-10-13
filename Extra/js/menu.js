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
	var nav = document.getElementsByTagName("nav")[0].children[0].children;
	
	var width = nav[0].offsetWidth;
	var length = nav.length;
	var totalWidthOfNavElements = width*length+ length*10*2;
	var navContainer = document.getElementById("nav-container");
	
	 if (window.innerWidth < 400) {
		navContainer.style.width = "100vw";
		navContainer.style.height = "100vh";
		for (var i = 0; i < length; i++) {
			console.log(nav[i].children[0].children[0]);
			nav[i].children[0].children[0].style.width = "100vw";
			nav[i].children[0].children[0].style.height = "30px";
		}
		
		
	} else if (window.innerWidth < totalWidthOfNavElements) {
		console.log(true);
		navContainer.style.width = "180px";
		navContainer.style.height = "100vh";
	} else {
		console.log(false);
		navContainer.style.width = "100vw";
		navContainer.style.height = "180px";
	}
	
	
	
	
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