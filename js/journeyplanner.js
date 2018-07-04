// Create a "close" button and append it to each list item
var activityList = document.getElementsByTagName("li");
for (i = 0; i < activityList.length; i++) {
  	var span = document.createElement("span");
	var txt = document.createTextNode("\u00D7");
	span.className = "close";
	span.appendChild(txt);
	activityList[i].appendChild(span);
}

// Click on a close button to hide the current list item
var close = document.getElementsByClassName("close");
for (i = 0; i < close.length; i++) {
	close[i].onclick = function() {
		var div = this.parentElement;
		div.style.display = "none";
  	}
}

// Function to add a new activity.
function addActivity(text) {
	var li = document.createElement("li");
	var t = document.createTextNode(text);
	li.appendChild(t);
	document.getElementById("activityList").appendChild(li);
	
	var span = document.createElement("span");
	var removeButton = document.createElement("button");
	removeButton.className = "btn btn-danger";
	removeButton.innerText = "Remove";
	span.className = "close";
	span.appendChild(removeButton);
	li.appendChild(span);
	li.className = "list-group-item";
	
	for (i = 0; i < close.length; i++) {
		close[i].onclick = function() {
			var div = this.parentElement;
			div.style.display = "none";
		}
	}
}