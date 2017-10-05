console.log("ROBIN NEJ FÖR I HELL........!!!!!!!!!!!");
console.log("Robin skriv det här!");


var text1 = "BLUB";
var text2 = 'BLUB';
var nummer1 = 23; 
var decNumber = 32.34; 
var boolean1 = false;

console.log(boolean1 + " " + text1 + decNumber);
console.log(nummer1 + decNumber);


function blub() {
	console.log("The blub function!");	
}


function blub2(parm) {
	console.log(parm + text1);
}

blub();
blub2(text2);

var toggleNavigationBar = false;

if (toggleNavigationBar) {
	document.getElementById("navigation-field").style.height = "200px";
	document.getElementById("navigation-field").style.opacity = "1";
} else {
	document.getElementById("navigation-field").style.height = "0px";
	document.getElementById("navigation-field").style.opacity = "0";
}

function toggleMenu(menuElement) {
	console.log("change");
	menuElement.classList.toggle("change");

	toggleNavigationBar = !toggleNavigationBar;
	if (toggleNavigationBar) {
		document.getElementById("navigation-field").style.height = "200px";
		document.getElementById("navigation-field").style.opacity = "1";
	} else {
		document.getElementById("navigation-field").style.height = "0px";
		document.getElementById("navigation-field").style.opacity = "0";
	}
}