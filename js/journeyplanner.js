window.onload = function() {
	getActivites()
}

var activityDict = {"DNUI":1, "Dalian Modern Museum":1, "Salmon Restaurant":2, "Wanda Plaza":3};

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

// Draw activities as Bootstrap cards
function drawActivities() {
	// Create Bootstrap for card
	var cardsDiv = document.getElementById('cardsDiv');
	// Clear div
	cardsDiv.innerHTML = "";
	
	for (i = 0; i < currentActivities.length; i++) {
		var activityName = currentActivities[i];
		var activityDuration = activityDict[activityName];
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

// The big boy.
function optimiseJourney() {
	var timetableTodo = currentActivities;
	var maxLength;
	// Initialise totalTime as 1 hour for each activity
	var totalTime = currentActivities.length;
	for (i = 0; i < currentActivities.length; i++) {
		totalTime += activityDict[currentActivities[i]];
	}
	// Get days
	var totalDays = document.getElementById('daysInput').value;
	// Get day length
	// Check if there is not enough time in the day
	if ((document.getElementById('shortDay')).checked) {
		maxLength = 4;	
	} else if ((document.getElementById('normalDay')).checked) {
		maxLength = 6;
	} else {
		maxLength = 8;
	}
	for (i = 0; i < currentActivities.length; i++) {
		if (activityDict[currentActivities[i]] > maxLength - 1) {
			console.log(totalTime);
			alert("One activity is too long.");
		}
	}
	
	var timetableDict = {};
	console.log(totalDays);
	var filledTime = 0;
	var day = 1;
	var activitiesPerDay = [];
	for (i = 0; i < timetableTodo.length; i++) {
		var activityName = timetableTodo[i];
		var activityDuration = 1 + activityDict[activityName];
		if (filledTime + activityDuration <= maxLength) {
			activitiesPerDay.push("Transit");
			activitiesPerDay.push(activityName);
			filledTime += activityDuration;
			timetableDict[i] = activitiesPerDay;
		} else {
			day++;
			activitiesPerDay = [];
			filledTime = 0;
		}
	}
		
	console.log(timetableDict);
	
}

// Reset journey
function resetJourney() {
	currentActivities = [];
	document.getElementById('daysInput').value = 1;
	resetButtons();
	drawActivities();
}

// Enable all buttons
function resetButtons() {
	var buttonList = document.getElementsByClassName('activityBtn btn btn-secondary');
	for (i = 0; i < buttonList.length; i++) {
		buttonList[i].disabled = false;
	}
}

// General function to trim trailing whitespace from strings.
function trim(s) { 
  return ( s || '' ).replace( /^\s+|\s+$/g, '' ); 
}