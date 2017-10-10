
var currentState;

var toggleNavigationBar = false;
menuSize();
/**
 * 
 * @param event
 * @returns
 */
window.addEventListener('resize', function(event) {
	menuSize();
});
/**
 * 
 * @param menuElement
 * @returns
 */
function toggleMenu(menuElement) {
	menuElement.classList.toggle("change");

	toggleNavigationBar = !toggleNavigationBar;

	menuSize();
}
/**
 * 
 * @returns
 */
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
var scrollButton = false;
/**
 * Functions that scrolls to a element.
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
 * @param elID
 * @returns
 */
function buttonScroll(elID) {
	scrollButton = true;
	scrollHistory(elID);
}
/**
 * 
 * @param elID
 * @returns
 */
function scrollHistory(elID) {
	currentState = elID;
	scrollToItem(document.getElementById(elID));
	history.pushState(stateObj, elID, "index.html#" + elID);
}


/**
 * THis is a listener that listens if the page is scrolled.
 * Loops through the mains children and uses the a function to detect if thay
 * are in view.
 * 
 * @returns null
 */
window.addEventListener('scroll', function() {
	if(scrollButton == false) {
		 for(var i = 0; i < document.getElementById("main-content").children.length; i++) {
			 isScrolledIntoView(document.getElementById("main-content").children[i]);
		 }
	}
});
/**
 * Function that detekts if an element is sopose to be in wiew.
 * 
 * @param el
 * @returns null
 */
function isScrolledIntoView(el) {
    var elemTop = el.getBoundingClientRect().top;
    if (elemTop <= window.innerHeight/2 && elemTop >= -window.innerHeight/2) {
    	if(currentState != el.id) {
    		scrollHistory(el.id);
    	}
    }
}