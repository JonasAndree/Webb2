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
menuSize();
window.addEventListener('resize', function(event) {
	menuSize();
});

function toggleMenu(menuElement) {
	menuElement.classList.toggle("change");

	toggleNavigationBar = !toggleNavigationBar;

	menuSize();
}
function menuSize() {
	var areaWidth = window.innerWidth;
	var elementWidth = document.getElementById("navigation-field-ul").children.length
			* (document.getElementById("navigation-field-ul").lastElementChild.offsetWidth + 2 * 15);
	console.log(areaWidth < elementWidth);
	if (areaWidth < elementWidth) {
		if (toggleNavigationBar) {
			document.getElementById("navigation-field").style.transition = "0.3s";
			document.getElementById("navigation-field").style.opacity = "1";
			document.getElementById("navigation-field").style.width = "130px";
			document.getElementById("navigation-field").style.height = "100vh";
		} else {
			document.getElementById("navigation-field").style.transitionDelay = "0.1s";
			document.getElementById("navigation-field").style.opacity = "0";
			document.getElementById("navigation-field").style.width = "0px";
			document.getElementById("navigation-field").style.height = "0px";
		}
	} else {
		if (toggleNavigationBar) {
			document.getElementById("navigation-field").style.transition = "0.3s";
			document.getElementById("navigation-field").style.opacity = "1";
			document.getElementById("navigation-field").style.width = "100vw";
			document.getElementById("navigation-field").style.height = "180px";
		} else {
			document.getElementById("navigation-field").style.transitionDelay = "0.1s";
			document.getElementById("navigation-field").style.opacity = "0";
			document.getElementById("navigation-field").style.width = "0px";
			document.getElementById("navigation-field").style.height = "0px";
		}
	}
}


var scrollButton;
/**
 * Functions that scrolls to a element.
 * 
 * @param element
 * @returns
 */
function scrollToItem(element) {
	// Detects where the element is compared to the top of the screen.
	var diff = (element.offsetTop - window.scrollY) / 8;
	
	if (Math.abs(diff) > 1) {
		window.scrollTo(0, (window.scrollY + diff));
		clearTimeout(window._TO);
		window._TO = setTimeout(scrollToItem, 10, element);
	} else {
		window.scrollTo(0, element.offsetTop);
		scrollButton = false;
	}
}
var stateObj = { index: "index" };
/**
 * If we need to scroll to an element.
 * 
 * @param elID
 * @returns
 */
function buttonScroll(elID) {
	scrollButton = true;
	//document.getElementById(elID).className = "active";
	//changeColorScroller(document.getElementById(elID))
	scrollToItem(document.getElementById(elID));
	//scrollHistory(elID);
}
