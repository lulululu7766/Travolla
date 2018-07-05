window.onload = function() {
	addButtons()
}

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
	
	var activityCost = document.createElement("div");
	activityCost.className = "card-footer";
	var timeCost = document.createElement("b");
	timeCost.innerText = 3;
	activityCost.appendChild(timeCost);
	cardDiv.appendChild(activityCost);

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
	updateTime();
}

function enableButton(btnName) {
	var buttonList = document.getElementsByClassName("btn btn-primary");
	for (b = 0; b < buttonList.length; b++) {
		if (buttonList[b].innerText === btnName) {
			buttonList[b].disabled = false;
		}
	}
}

function updateTime() {
	var totalTime = 0;
	var timeDiv = document.getElementById("totalTime");
	timeDiv.innerHTML = "<h5>Total Time:</h5>";
	var timeText = document.createElement("p");
	var activityCards = document.getElementsByClassName("card bg-light mb-4");
	for (c = 0; c < activityCards.length; c++) {	
		totalTime += parseInt((activityCards[c].children)[3].innerText);
	}
	timeText.append(totalTime);
	timeDiv.append(timeText)
	console.log(totalTime);
}

function getDays() {
	var days = parseInt(document.getElementById('daysInput').value);
	console.log(days);
	return days;
}

function makeActivitiesDict() {
	var dict = {};
	var activityCards = document.getElementsByClassName("card bg-light mb-4");
	for (c = 0; c < activityCards.length; c++) {
		dict[trim((activityCards[c].children)[0].innerText)] = parseInt((activityCards[c].children)[3].innerText);
		dict["Travel Time " + c] = 1;
	}
	console.log(dict);
	return dict;
}

function getActivities(dict) {
	var activityList = [];
	for (var activity in dict) {
		activityList.push(activity);
	}
	console.log(activityList);
	return activityList;
}

function optimise() {
	// Check if too many activities for number of days
	var activitiesDict = makeActivitiesDict();
	var numDays = getDays();
	var totalTime = 0;
	var avgDay = 0;
	
	for (var actName in activitiesDict) {
		totalTime += activitiesDict[actName];
	}
	
	console.log(totalTime);
	
	avgDay = totalTime / numDays;
	
	if (avgDay > 8) {
		console.log("Days are too long.")
		alert("Days are too long!");
	}
	
	drawTimetable(activitiesDict);
}

function drawTimetable(fullDict) {
	var timetableDiv = document.getElementById('timetableParent');
	timetableDiv.innerHTML = '<h2>Your Timetable</h2><ul id="timetable" class="list-group"></ul>';
	
	var activityDict = fullDict;
	var activityList = getActivities(activityDict);
	var dict = fullDict;
	var timetableList = document.getElementById('timetable');
	var dictLength = 0;
	for (var i in dict) {
		if (dict.hasOwnProperty(i)) {
			dictLength++;
		}
	}
	console.log(dictLength);
	for (i = 0; i < dictLength; i++) {
		var timetableEvent = document.createElement("li");
		timetableEvent.className = "list-group-item";
		var activityName = document.createElement("h5");
		var activityTime = document.createElement("p");
		activityName.innerText = activityList[i];
		var activityTxt = activityList[i];
		activityTime.innerText = dict[activityTxt];
		
		timetableEvent.append(activityName);
		timetableEvent.append(activityTime);
		timetableList.append(timetableEvent);
	}
	
}

function trim(s) { 
  return ( s || '' ).replace( /^\s+|\s+$/g, '' ); 
}