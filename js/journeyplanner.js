window.onload = function() {
	getActivites()
}

var activityDict = {"DNUI":2, "Dalian Modern Museum":3, "Salmon Restaurant":2, "Wanda Plaza":4};

var currentActivities = [];

// Get list of all activities in area
function getActivites() {
	// Get activites from DB and add to activityDict
	drawButtons(activityDict);
}

// Draw buttons of all activities
function drawButtons(activityList) {
	// Get div to place buttons in
	var activityDiv = document.getElementById('activityDiv');
	
	// Create buttons
	for (var activity in activityDict) {
		var activityBtn = document.createElement('button');
		activityBtn.className = "activityBtn btn btn-secondary";
		activityBtn.innerText = activity;
		activityBtn.onclick = function() {
			addActivity(this.innerText);
		}
		activityDiv.appendChild(activityBtn);
	}
}

// Add activity
function addActivity(activityName) {
	// Add to current activities
	currentActivities.push(activityName);
	deactivateButton(activityName);
	drawActivities();
}

// Remove activity
function removeActivity(activityName) {
	var activityIndex = currentActivities.indexOf(activityName);
	console.log(activityIndex);
	if (activityIndex !== -1) {
    	currentActivities.splice(activityIndex, 1);
	}
	activateButton(activityName);
	drawActivities();
}

function drawActivities() {
	// Create Bootstrap for card
	var cardsDiv = document.getElementById('cardsDiv');
	// Clear div
	cardsDiv.innerHTML = "";
	
	for (i = 0; i < currentActivities.length; i++) {
		var activityName = currentActivities[i];
		var activityDuration = activityDict[activityName];
		console.log("Name: " + activityName + ", Duration: " + activityDuration);
		// Create new card
		var card = document.createElement('div');
		card.className = "card md-3";
		
		// Image (TODO)
		// Card body
		var cardBody = document.createElement('div');
		cardBody.className = "card-body";
		// Title
		var cardTitle = document.createElement('h4');
		cardTitle.className = "card-title";
		cardTitle.innerText = activityName;
		// Text
		var cardText = document.createElement('p');
		cardText.className = "card-text";
		cardText.innerText = "Text that describes this activity."
		// Time
		var cardTimeList = document.createElement('ul');
		cardTimeList.className = "list-group list-group-flush";
		var cardTimeElement = document.createElement('li');
		cardTimeElement.className = "list-group-item";
		cardTimeElement.innerText = "Duration: " + activityDuration + " hours.";
		cardTimeList.appendChild(cardTimeElement);
		// Remove Button
		var removeBtn = document.createElement('button');
		removeBtn.className = "removeBtn btn btn-danger";
		removeBtn.innerText = "Remove " + activityName;
		removeBtn.onclick = function() {
			removeActivity(this.innerText.substr(7));
		}
		// Append all
		cardBody.appendChild(cardTitle);
		cardBody.appendChild(cardText);
		cardBody.appendChild(cardTimeList);
		cardBody.appendChild(removeBtn);
		card.appendChild(cardBody);
		cardsDiv.append(card);
	}
	
	
}

// Activate activity button
function activateButton(activityName) {
	var buttonList = document.getElementsByClassName('activityBtn btn btn-secondary');
	for (i = 0; i < buttonList.length; i++) {
		if (buttonList[i].innerText === activityName) {
			buttonList[i].disabled = false;
		}
	}
}

// Deactivate activity button
function deactivateButton(activityName) {
	var buttonList = document.getElementsByClassName('activityBtn btn btn-secondary');
	for (i = 0; i < buttonList.length; i++) {
		if (buttonList[i].innerText === activityName) {
			buttonList[i].disabled = true;
		}
	}
}

function trim(s) { 
  return ( s || '' ).replace( /^\s+|\s+$/g, '' ); 
}

/**
// Add activity buttons
function addButtons() {
	var locationDiv = document.getElementById('locationDiv');
	var locationText = document.createElement('h4');
	locationText.innerText = "Events near *location*";
	locationDiv.appendChild(locationText);
	var locations = ["DNUI", "Dalian Modern Museum", "Salmon Restaurant", "Wanda Plaza"];
	var btnDiv = document.getElementById('activityDiv');
	for (x = 0; x < locations.length; x++) {
		var btn = document.createElement("button");
		btn.className = "btn btn-primary";
		btn.innerText = locations[x];
		btn.onclick = function() {
			addActivity(this.innerText);
		};
		btnDiv.appendChild(btn);
	}
}
**/

/**
// Function to add a new activity.
function addActivity(text) {
	var buttonList = document.getElementsByClassName("btn btn-primary");
	var cardDiv = document.createElement("div");
	var activityDiv = document.getElementById("cardsDiv");
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
	activityDiv.appendChild(cardDiv);
	
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
	var timeDiv = document.getElementById("timeDiv");
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


**/