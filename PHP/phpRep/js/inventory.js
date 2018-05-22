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
	element.classList.toggle("toggle");
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

function setItem(name, subtype, type) {
	var container = document.getElementById(subtype+"-gear");
	container.innerHTML = "";
	
	var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			container.innerHTML = this.responseText;
			updateBag();
		}
	};
	xmlhttp.open("GET", "./php/updateActiveItem.php?name=" + name + "&subtype=" + subtype + "&type=" + type, true);
	xmlhttp.send();
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