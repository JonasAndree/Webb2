
/* I have to look up querySelection */

var boxSize = 165;
var leftMargin = 22;
var minColumnWidth = 10;
document.getElementById("top-header").style.height = (boxSize - minColumnWidth) + "px";

var stateObj;
var state = history.state;
if (state == null) {
	stateObj =  { index: "home" };
	history.pushState(stateObj, "home", "index.php#" + "home");
	setMargins(history.state.index);
} else {
	if (history.state.index != "design" && history.state.index != "showtemperature") {
		stateObj =  { index: history.state.index };
		history.replaceState(stateObj, history.state.index, "index.php#" + history.state.index);
		toggleElement("home");
		toggleElement(history.state.index);
		setMargins(history.state.index);
	} else {
		var state = history.state.index; 
		stateObj =  { index: "home" };
		history.replaceState(stateObj, "home", "index.php#" + "home");
		setMargins("home");
		stateObj =  { index: state };
		history.replaceState(stateObj, state, "index.php#" + state);
		showGraph(state);
		if (state == "showtemperature") {
		} else if (state == "design") {
		}
	}
	
}

window.onhashchange = function(event) {
	location.reload();
	if (history.state.index == "showtemperature") {
		stateObj =  { index: "home" };
		history.pushState(stateObj, "home", "index.php#" + "home");
	}
};

window.onresize = function(event) {
	setMargins(history.state.index);
	fitImage("design");
};

function setMargins(view) {
	console.log("view" + view);
	var width = window.innerWidth - 22 * 2;
	var container = document.getElementById(view);
	var classes = container.getElementsByClassName("square");
	document.getElementById("top-header").style.width = width + "px";
	var n = Math.floor(width / boxSize);
	var nCol = n - 1;
	width -= nCol * minColumnWidth;
	var boxesTotelwidth = n * (boxSize - minColumnWidth);
	var marginTotal = width - boxesTotelwidth;
	var colWidth = marginTotal / nCol;
	var row = 0;
	var rowHeight = colWidth + boxSize;
	
	for (var i = 0; i < classes.length; i++) {
		if (window.innerWidth > 700 ){
			classes[i].style.width = (boxSize - minColumnWidth) + "px";
			classes[i].style.height = (boxSize - minColumnWidth) + "px";
			classes[i].style.marginTop = rowHeight * row + "px";
			classes[i].style.left = (i - (nCol + 1) * row) * (boxSize + colWidth) + leftMargin + "px";
			if (i % n == nCol) {
				row++;
			} 
		} else {
			classes[i].style.width = width + leftMargin + "px";
			classes[i].style.marginTop = ((boxSize - minColumnWidth) + leftMargin) * i + "px";
			classes[i].style.left = leftMargin + "px";
		}
	}
}

function setView(id) {
	if (id != history.state.index) {
		toggleElement(history.state.index);
		toggleElement(id);
		stateObj = { index: id };
		history.pushState(stateObj, id, "index.php#" + id);
		setMargins(history.state.index);
	}
}
function toggleElement(id) {
	document.getElementById(id).classList.toggle("toggle");
}


function flip(element) {
	element.classList.toggle('is-flipped');
}

function showGraph(id) {
	toggleElement("graph");
	toggleElement(id);
	
	if (id == "design") {
		fitImage(id);
	}
	stateObj = { index: id };
	history.pushState(stateObj, id, "index.php#" + id);
}

function fitImage(id) {
	var element = document.getElementById(id);
	
	var imgContainer = element.getElementsByClassName("graph-image-container")[0];
	var img = imgContainer.getElementsByClassName("graph-images")[0];
	
	var wHeight = window.innerWidth;
	var wWidth = window.innerWidth;
	var imgHeight = img.naturalHeight;
	var imgWidth = img.naturalWidth;
	console.log(img.src);
	console.log(imgHeight + " : " + imgWidth);
	
	var imgProp = imgWidth / imgHeight;
	var windowProp = wWidth / wHeight;
	
	if (wWidth < imgWidth && imgProp >= 1) {
		console.log("width");
		var newWRatio = ( wWidth / imgWidth*4/5 );
		console.log("newWRatio" + newWRatio)
		if (newWRatio <= 0.2) {
			console.log("Height");
			img.style.width = wWidth*4/5 + "px";
			img.style.height = "";
		} else {
			console.log("Width");
			img.style.width = "";
			img.style.height = wHeight*2.5/5 + "px";
		}
	} else {
		console.log("width");
		var newWRatio = ( wWidth / imgWidth*4/5 );
		console.log("newWRatio" + newWRatio)
		if (newWRatio <= 0.2) {
			console.log("Width");
			img.style.width = "";
			img.style.height = wHeight*2.5/5 + "px";
		} else {
			console.log("Height");
			img.style.width = wWidth*4/5 + "px";
			img.style.height = "";
		}
	}
	
	
	
	
}


function hideGraph(id) {
	toggleElement("graph");
	toggleElement(id);
	stateObj =  { index: "home" };
	history.pushState(stateObj, "home", "index.php#" + "home");
}
function animateArrow(celcius) {
	var arrow = document.getElementById("arrow");
	arrow.style.transition = ' transform 2s cubic-bezier(0.17, 0.1, 0.45, 1.02)';
	demo(celcius);
}

function sleep(ms) {
	/* If a Promise is passed to an await expression, it waits for the Promise to 
	 * be fulfilled and returns the fulfilled value.
	 */
	return new Promise(resolve => setTimeout(resolve, ms));
}

async function demo(celcius) {
	/*The await expression causes async function 
	 * execution to pause until  a Promise is fulfilled
	 */
	await sleep(300);
	animateArrow2(celcius)
}

function animateArrow2(celcius) {
	var arrow = document.getElementById("arrow");
	var angle = celcius * 3;
    var shadowX = Math.round(Math.sin(angle * (Math.PI / 180)) * 13,2);
    var shadowY = Math.round(Math.cos(angle * (Math.PI / 180)) * 13,2);
    //arrow.style.filter = "drop-shadow(" + shadowX + "px " + shadowY + "px 5px #888 )";
	arrow.style.transform = 'rotate(' + angle + 'deg)';
}