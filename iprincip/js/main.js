
var boxSize = 170;

window.onresize = function(event) {
	setMargins();
};
setMargins();
function setMargins() {
	var width = window.innerWidth * 0.96;
	var classes = document.getElementsByClassName("square");
	var margin = width / boxSize - Math.floor(width / boxSize);
	
	var n = Math.floor(width / boxSize);
	var nCol = n - 1;
	var boxesTotelwidth = n * 170;
	var marginTotal = width - boxesTotelwidth;
	var colWidth = marginTotal / nCol;
	
	console.log("Number of boxes: " + n);
	console.log("Number of columns: " + nCol);
	console.log("Space ocupied: " + boxesTotelwidth);
	console.log("Width: " + width);
	console.log("Total margin: " + marginTotal);
	console.log("Margin per column: " + colWidth + "\n\n");

	var row = 0;
	var rowHeight = colWidth + boxSize;
	for (var i = 0; i < classes.length; i++) {
		classes[i].style.marginTop = rowHeight * row + "px";
		classes[i].style.left = (i - i*row) * (boxSize + colWidth) + colWidth + "px";
		if (i % n == nCol) {
			row++;
			console.log(row);
		} 
	}
	
}