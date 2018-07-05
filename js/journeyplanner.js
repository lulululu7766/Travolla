function addButtons() {
	var locations = ["DNUI", "Dalian Modern Museum", "Salmon Restaurant", "Wanda Plaza"];
	var btnDiv = document.getElementById('activityButtons');
	var getBtn = document.getElementById('getBtn');
	for (x = 0; x < locations.length; x++) {
		var btn = document.createElement("button");
		btn.className = "btn btn-primary";
		btn.innerText = locations[x];
		btn.onclick = function() {
			addActivity(this.innerText);
		};
		btnDiv.appendChild(btn);
	}
	getBtn.disabled = true;
}

// Click on a close button to hide the current list item
var close = document.getElementsByClassName("close");
for (z = 0; z < close.length; z++) {
	close[i].onclick = function() {
		var div = this.parentElement;
		div.style.display = "none";
  	}
}

// Function to add a new activity.
function addActivity(text) {
	var buttonList = document.getElementsByClassName("btn btn-primary");
	var li = document.createElement("li");
	var t = document.createTextNode(text);
	var txtDiv = document.createElement("div");
	txtDiv.appendChild(t);
	li.appendChild(txtDiv);
	document.getElementById("activityList").appendChild(li);
	
	var span = document.createElement("span");
	var removeButton = document.createElement("button");
	removeButton.className = "btn btn-danger";
	removeButton.innerText = "Remove";
	span.className = "close";
	span.appendChild(removeButton);
	li.appendChild(span);
	li.className = "list-group-item";
	
	for (b = 0; b < buttonList.length; b++) {
		if (buttonList[b].innerText === text) {
			buttonList[b].disabled = true;
		}
	}
	
	for (a = 0; a < close.length; a++) {
		close[a].onclick = function() {
			var div = this.parentElement;
			div.style.display = "none";
			var elementList = this.parentElement.children;
			enableButton(elementList[0].innerText);
			//console.log();
			
		}
	}
}

function enableButton(btnName) {
	var buttonList = document.getElementsByClassName("btn btn-primary");
	for (b = 0; b < buttonList.length; b++) {
		if (buttonList[b].innerText === btnName) {
			buttonList[b].disabled = false;
		}
	}
}