function itemInfo(id, state, direction) {
	var element = document.getElementById(id);
	if (state == "on"){
		element.style.display = "inline";
	} else {
		element.style.display = "none";
	}
}

var previusSubContainer;
var firstTime = true;
function subItems(id) {
	var element = document.getElementById(id);
	toggleElement(id);
	if (firstTime) {
		previusSubContainer = element;
		firstTime = false;
	} else if (previusSubContainer === element) {
		firstTime = true;
	} else {
		previusSubContainer.classList.toggle("toggle");
		previusSubContainer = element;	
	}
}
function showArmor(id, id2) {
	toggleElement(id);
	toggleElement(id2);
}
function toggleElement(id) {
	document.getElementById(id).classList.toggle("toggle");
}
function setItem(name, subtype, type) {
	var container = document.getElementById(subtype+"-gear");
	
	var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			container.innerHTML = "";
			container.innerHTML = this.responseText;
			updateBag();
		}
	};
	xmlhttp.open("GET", "./php/updateActiveItem.php?name=" + name + "&subtype=" + subtype + "&type=" + type, true);
	xmlhttp.send();
}
function showDeleteMenu(itemName) {
	toggleElement("main");
	toggleElement("delete-screen");
}

function deleteItem(del) {
	toggleElement("main");
	toggleElement("delete-screen");
	if (del == "cancel") {
		console.log("cancel");
	} else if(del == "delete") {
		console.log("delete");
	}
}

function updateBag() {
	var container = document.getElementById("bag");
	container.innerHTML = "";
	
	var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			container.innerHTML = this.responseText;
		}
	};
	xmlhttp.open("GET", "./php/bag.php", true);
	xmlhttp.send();
}
var toggleTopBagView = true;
function scrollToView() {
	if (toggleTopBagView)
		scrollToItem(document.getElementById("bag"));
	else 
		scrollToItem(document.getElementById("header"));
	toggleTopBagView = !toggleTopBagView;
}


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