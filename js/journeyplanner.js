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
var close = document.getElementsByClassName("closable");
for (z = 0; z < close.length; z++) {
	close[i].onclick = function() {
		var div = this.parentElement;
		div.style.display = "none";
  	}
}

// Function to add a new activity.
function addActivity(text) {
	var buttonList = document.getElementsByClassName("btn btn-primary");
	var cardDiv = document.createElement("div");
	cardDiv.className = "card bg-light mb-4";
	cardDiv.setAttribute("style","max-width:100%;");

	var contentDiv = document.createElement("div");
	contentDiv.className = "card-header";
	
	var t = document.createElement("h5");
	t.innerText = text;
	
	var contentText = document.createElement("div");
	contentText.className = "card-body text-dark";
	var description = document.createElement("p");
	description.innerText = "Lorem Ipsum Dipsum";
	contentText.appendChild(description);
	
	contentDiv.appendChild(t);
	cardDiv.appendChild(contentDiv);
	cardDiv.appendChild(contentText);
	document.getElementById("activityList").appendChild(cardDiv);
	
	var closeDiv = document.createElement("div");
	closeDiv.className = "closable";
	closeDiv.setAttribute("style", "padding: 10px; width: 100%; text-align: right;")
	
	var removeButton = document.createElement("button");
	removeButton.className = "btn btn-danger";
	removeButton.innerText = "Remove";
	
	closeDiv.appendChild(removeButton);
	
	cardDiv.appendChild(closeDiv);
	

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