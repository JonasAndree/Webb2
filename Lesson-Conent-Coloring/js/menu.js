
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
	if (toggleNavigationBar) {
		document.getElementById("navigation-field").style.transition = "0.3s";
		document.getElementById("navigation-field").style.opacity = "1";
		document.getElementById("navigation-field").style.width = "120px";
		document.getElementById("navigation-field").style.height = "100vh";
	} else {
		document.getElementById("navigation-field").style.transitionDelay = "0.1s";
		document.getElementById("navigation-field").style.opacity = "0";
		document.getElementById("navigation-field").style.width = "0px";
		document.getElementById("navigation-field").style.height = "0px";
	}
}
var scrollButton = false;
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
	changeColorScroller(document.getElementById(elID))
	scrollHistory(elID);
}
/**
 * 
 * @param elID
 * @returns
 */
function scrollHistory(elID) {
	currentState = elID;
	history.pushState(stateObj, elID, "index.html#" + elID);
	scrollToItem(document.getElementById(elID));
}


/**
 * THis is a listener that listens if the page is scrolled. Loops through the
 * mains children and uses the a function to detect if thay are in view.
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
    		var color = window.getComputedStyle( el ,null).getPropertyValue('background-color');
    		changeColorScroller(el);
    	}
    }
}
var currentNavButton = "nav-intro";
var currentNavButtonClass = "intro-content";
var currentScrollCollor;

function changeColorScroller(el) {
	var body = document.getElementsByTagName("body")[0];
	document.getElementById(currentNavButton).className = currentNavButtonClass;
	body.classList.remove(currentScrollCollor);
	
	if (el.id == "intro-content") {
		currentNavButton = "nav-intro";
		currentNavButtonClass = "intro-content";
		document.getElementById("nav-intro").className = "intro-content  active";
		currentScrollCollor = "white";
		body.classList.add("white");
	} else if (el.id == "books-content") {
		currentNavButton = "nav-books";
		currentNavButtonClass = "books-content";
		document.getElementById("nav-books").className = "books-content active";
		currentScrollCollor = "orange"; 
		body.classList.add("orange");
	} else if (el.id == "video-games-content") {
		currentNavButton = "nav-video-games";
		currentNavButtonClass = "video-games-content";
		document.getElementById("nav-video-games").className = "video-games-content active";
		currentScrollCollor = "red"; 
		body.classList.add("red");
	} else if (el.id == "education-content") {
		currentNavButton = "nav-education";
		currentNavButtonClass = "education-content";
		document.getElementById("nav-education").className = "education-content active";
		currentScrollCollor = "blue"; 
		body.classList.add("blue");
	} else if (el.id == "about-content")  {
		currentNavButton = "nav-about";
		currentNavButtonClass = "about-content";
		document.getElementById("nav-about").className = "about-content active";
		currentScrollCollor = "purple"; 
		body.classList.add("purple");
	}
}