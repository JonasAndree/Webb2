
/**
 * mikaelai@kth.se
 * 
 */



var currentState;

var toggleNavigationBar = false;
menuSize();

var x;
var newX;
var gameContainer = document.getElementById("game-container");
var gameContainerChildren = gameContainer.children;
var diff = 0;
var startPosition = [];
var activeGameElement;
var drag = false;


document.onkeydown = checkKey;

function checkKey(e) {

    e = e || window.event;

    if (e.keyCode == '38') {
        //console.log("up arrow");
    }
    else if (e.keyCode == '40') {
        //console.log("down arrow");
    }
    else if (e.keyCode == '37') {
        for (var i = 0; i < gameContainerChildren.length; i++) {
    		gameContainerChildren[i].style.transition = "0.3s";
        	if(activeGameElement == gameContainerChildren[i]) {
	    		if (i != 0) {
	    			startPosition[i] = parseInt(gameContainerChildren[i - 1].style.left);
	    			if(drag == false) {
	    				activeGameElement.className = "game";
	    				activeGameElement = gameContainerChildren[i - 1];
	    				activeGameElement.className = "game active-game";
	    				gameMouseUp();
	    				break;
	    			}
	    		}
        	}
    	}
    }
    else if (e.keyCode == '39') {
        for (var i = 0; i < gameContainerChildren.length; i++) {
    		gameContainerChildren[i].style.transition = "0.3s";
        	if(activeGameElement == gameContainerChildren[i]) {
	    		if (i != gameContainerChildren.length - 1) {
	    			startPosition[i] = parseInt(gameContainerChildren[i + 1].style.left);
	    			if(drag == false) {
	    				activeGameElement.className = "game";
	    				activeGameElement = gameContainerChildren[i + 1];
	    				activeGameElement.className = "game active-game";
	    				gameMouseUp();
	    				break;
	    			}
	    		}
        	}
    	}
        
    }
    else if (e.keyCode == '9') {
    	toggleMenu(document.getElementById("menu-button"));
    }

}



gameContainer.addEventListener("mousedown", function(event) {
	x = event.clientX;
});
gameContainer.addEventListener("mousemove", function(event) {
	
	if(x > 0) {
		newX = event.clientX;
		modifyGamePosition(newX - x);
		setActiveGameElement();
		drag = true;	
	}
	newX = 0;
});

function setActiveGameElement() {
	for (var i = 0; i < gameContainerChildren.length; i++) {
		var elementPosLeft = gameContainerChildren[i].offsetLeft;
		var elementPosRight = gameContainerChildren[i].offsetRight;
		var halfWindowWidth = window.innerWidth/2;
		if (elementPosLeft < halfWindowWidth  || elementPosRight > halfWindowWidth ) {
			activeGameElement.className = "game";
			activeGameElement = gameContainerChildren[i];
			activeGameElement.className = "game active-game";
		} 
	}
}

function scrollToItemVerticly(element) {
	modifyGamePosition((window.innerWidth/2) - parseInt(activeGameElement.style.left) - 115);
}


gameContainer.addEventListener("mouseup", function() {
	gameMouseUp();
	drag = false;
});

function gameMouseUp() {
	x = 0;
	newX = 0;
	diff = 0;
	setStartPosition();
	scrollToItemVerticly(activeGameElement);
	setStartPosition();
}



function setStartPosition() {
	for (var i = 0; i < gameContainerChildren.length; i++) {
		gameContainerChildren[i].style.transition = "0.3s";
		startPosition[i] = parseInt(gameContainerChildren[i].style.left);
	}
}
/**
 * 
 * @param element
 * @returns
 */
function elementClicked(element) {
	if(drag == false) {
		activeGameElement.className = "game";
		activeGameElement = element;
		activeGameElement.className = "game active-game";
		gameMouseUp();
	}
}

setGamePositions();
function setGamePositions() {
	var margin = 60;
	var width = 220;
	var left = 0;
	for (var i = 0; i < gameContainerChildren.length; i++) {
		left += width + margin;
		gameContainerChildren[i].style.left = left + "px";
		startPosition.push(left);
		if(gameContainerChildren[i].className == "game active-game")
			activeGameElement = gameContainerChildren[i];
	}
	scrollToItemVerticly();
}


function modifyGamePosition(diff) {
	for (var i = 0; i < gameContainerChildren.length; i++) {
		gameContainerChildren[i].style.transition = "0.0s";
		gameContainerChildren[i].style.left = startPosition[i] + diff + "px";
	}
}

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
		document.getElementById("navigation-field").style.width = "100px";
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
	var diff = (element.offsetTop - window.scrollY) / 6;
	
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
 * Function that detects if an element is suppose to be in view.
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
/**
 * 
 * @param el - element
 * @returns
 */
function changeColorScroller(el) {
	var body = document.getElementsByTagName("body")[0];
	document.getElementById(currentNavButton).className = currentNavButtonClass;
	body.classList.remove(currentScrollCollor);
	
	if (el.id == "intro-content") {
		currentNavButton = "nav-intro";
		currentNavButtonClass = "intro-content";
		document.getElementById("nav-intro").className = "white intro-content  active";
		currentScrollCollor = "white";
		body.classList.add("white");
	} else if (el.id == "books-content") {
		currentNavButton = "nav-books";
		currentNavButtonClass = "books-content";
		document.getElementById("nav-books").className = "orange books-content active";
		currentScrollCollor = "orange"; 
		body.classList.add("orange");
	} else if (el.id == "video-games-content") {
		currentNavButton = "nav-video-games";
		currentNavButtonClass = "video-games-content";
		document.getElementById("nav-video-games").className = "blue video-games-content active";
		currentScrollCollor = "blue"; 
		body.classList.add("blue");
	} else if (el.id == "education-content") {
		currentNavButton = "nav-education";
		currentNavButtonClass = "education-content";
		document.getElementById("nav-education").className = "red education-content active";
		currentScrollCollor = "red"; 
		body.classList.add("red");
	} else if (el.id == "about-content")  {
		currentNavButton = "nav-about";
		currentNavButtonClass = "about-content";
		document.getElementById("nav-about").className = "purple about-content active";
		currentScrollCollor = "purple"; 
		body.classList.add("purple");
	}
}

var scrollKTHVisible = false;
var scrollSUVisible


var scrollImageArray = [];

for (var i = 1; i < 60; i++) {
	var image = document.createElement("DIV");
	image.className = "scroll-content";
	image.id = "scroll-id-"+i;
	image.addEventListener("click", animateScroll(document.getElementById("civil-content"), "KTH"));
	
	 if(i < 10) {
		 image.style.backgroundImage = "url(img/KTHScroll/000"+i+".png)";
	} else { 
		image.style.backgroundImage = "url(img/KTHScroll/00"+i+".png)";
	}
	scrollImageArray.push(image);
}
document.getElementById("civil-content").appendChild(scrollImageArray[58]);

console.log(document.getElementById("civil-content"));

function animateScroll(container, scrollType) {
	
	if (scrollKTHVisible == false)
		animateScroll2(container, 1, scrollKTHVisible)
	else 
		animateScroll2(container, 58, scrollKTHVisible)
		
	if (scrollType == "KTH") 
		scrollKTHVisible = !scrollKTHVisible;
	else if (scrollType == "SU")
		scrollSUVisible = !scrollSUVisible;
}
function animateScroll2(container, index, visible) {
	console.log(index);
	var savedIndex = index;
	if (visible == false)
		index++;
	else 
		index--;
	if(index < 1 || index > 58) {
		
	} else if(index < 10) {
		container.removeChild(container.childNodes[1]);
		container.appendChild(scrollImageArray[index]);
		setTimeout(animateScroll2, 20, container, index, visible);
	} else { 
		container.removeChild(container.childNodes[1]);
		container.appendChild(scrollImageArray[index]);
		setTimeout(animateScroll2, 20, container, index, visible);
	}
}


