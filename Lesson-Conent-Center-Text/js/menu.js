
var currentState;

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

function scrollToItem(item) {
	var diff = (item.offsetTop - window.scrollY) / 8;
	if (Math.abs(diff) > 1) {
		window.scrollTo(0, (window.scrollY + diff));
		clearTimeout(window._TO);
		window._TO = setTimeout(scrollToItem, 30, item);
	} else {
		window.scrollTo(0, item.offsetTop);
		scrollButton = false;
	}
}
var stateObj = { index: "index" };
var scrollButton = false;

function scroll(elID) {
	scrollButton = true;
	currentState = elID;
	history.pushState(stateObj, elID, "index.html#"+elID);
	scrollToItem(document.getElementById(elID));
	
}


function scrollHistory(elID) {
	currentState = elID;
	scrollToItem(document.getElementById(elID));
	history.pushState(stateObj, elID, "index.html#"+elID);
}



window.addEventListener('scroll', function() {
	if(scrollButton == false) {
		 for(var i = 0; i < document.getElementById("main-content").children.length; i++) {
			 isScrolledIntoView(document.getElementById("main-content").children[i]);
		 }
	}
});
function isScrolledIntoView(el) {
    var elemTop = el.getBoundingClientRect().top;
    var elemBottom = el.getBoundingClientRect().bottom;
    if (elemTop <= window.innerHeight/2 && elemTop >= -window.innerHeight/2) {
    	if(currentState != el.id) {
    		scrollHistory(el.id);
    	}
    }
}