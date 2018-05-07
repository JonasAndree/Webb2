var active = "none";
var display = false;
var subtypes = ["Head", "Chest", "Arms", "Leggs", "Cape", "Primary", "Secundary", "Heavy"];

function selectItems(subtype, hide) {
	var posTopItems = window.innerHeight * 0.15 + 8; 
	var detaTopItems = window.innerHeight * 0.15; 
	var leftItems = window.innerWidth * 0.32; 
	var rightItems = window.innerWidth * 0.76;
	
	var container = document.getElementById("subitems-container");
	container.innerHTML = "";

	for(var i = 0; i < subtypes.length; i++) {
		if (subtype  == subtypes[i]) {
			if (i < 5) {
				container.style.top = posTopItems + i * detaTopItems + "px";
				container.style.left = leftItems + "px";
			} else {
				container.style.top = posTopItems + (i-5) * detaTopItems + "px";
				container.style.left = rightItems + "px";
			}
		}
	}
	
	if(active != subtype || !display){
		container.style.display = "block";
		display = true;
	} else if (hide){
		container.style.display = "none";
		display = false;
	}
	active = subtype;
	
	var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			container.innerHTML = this.responseText;
		}
	};
	xmlhttp.open("GET", "getItems.php?q=" + subtype, true);
	xmlhttp.send();
}

function setItems(itemName, subtype) {
	container = document.getElementById(subtype.toLowerCase()+"-socket");
	container.innerHTML = "";
	var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			container.innerHTML = this.responseText;
			selectItems(subtype, false);
			updateStats();
		}
	};
	xmlhttp.open("GET", "setItems.php?q=" + itemName, true);
	xmlhttp.send();
}


function showItemInfo(itemInfo, onOff) {
	var item = document.getElementById(itemInfo);
	if (onOff == "on")
		item.style.display = "block";
	else 
		item.style.display = "none";
}
function updateStats() {
	var container = document.getElementById("stats-container");
	container.innerHTML = "";
	
	var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			container.innerHTML = this.responseText;
		}
	};
	xmlhttp.open("GET", "./setStats.php", true);
	xmlhttp.send();
}


