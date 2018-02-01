// console.log(); prints a string to the webb-browsers console.
console.log("JS working");
window.addEventListener("mousedown", function() {
	document.documentElement.style.setProperty('--bg-color', 'black');
	document.documentElement.style.setProperty('--header-color', 'red');
});
window.addEventListener("mouseup", function() {
	document.documentElement.style.setProperty('--bg-color', 'red');
	document.documentElement.style.setProperty('--header-color', 'black');
});

var slider = document.getElementById("myRange");
slider.max = window.innerHeight;
slider.oninput = function() {
	console.log("slider-working");
	document.documentElement.style.setProperty('--c-height', this.value+"px");
}