window.onload = function() {
    document.getElementById('getActivitiesBtn').disabled = true;
    document.getElementById('printBtn').disabled = true;
}

var activityDict = {};

var currentActivities = [];

var tripDestination;

// Get list of all activities in area
function getActivities(cityId) {
    // Get activities from DB and add to activityDict
    $.ajax({
        type:"POST",
        url:"./js/helpers/journeyplannerhelper.php?cityid=" + cityId,
        success:function(data) {

            var object = JSON.parse(data);
            for (var i = 0; i < object["ACTIVITIES"].length; i++) {
                var activityName = object["ACTIVITIES"][i]['name'];
                var activityDuration = parseInt(object["ACTIVITIES"][i]['estimated_time']);
                var activitySubtitle = object["ACTIVITIES"][i]['subtitle'];
                var activityDesc = object["ACTIVITIES"][i]['description'];
                var activityCat = object["ACTIVITIES"][i]['category'];
                var activityCost = parseFloat(object["ACTIVITIES"][i]['cost']);
                var activityComment = parseFloat(object["ACTIVITIES"][i]['comment']);

                activityDict[activityName] = [activityDuration, activitySubtitle, activityDesc, activityCat, activityCost, activityComment];
            }
        }
    });
    if (cityId === 5120) {
        document.getElementById('locationH4').innerText = "Dalian, China";
        tripDestination = "Dalian, China";
    } else {
        document.getElementById('locationH4').innerText = "Brisbane, Australia";
        tripDestination = "Brisbane, Australia";
    }

    document.getElementById('getActivitiesBtn').disabled = false;

}

// Draw buttons of all activities
function drawButtons() {
    // Get div to place buttons in
    console.log(activityDict);
    var activityDiv = document.getElementById('activityDiv');

    // Create buttons
    for (var activity in activityDict) {
        var activityBtn = document.createElement('button');
        activityBtn.className = "activityBtn btn btn-secondary";
        activityBtn.innerText = activity;
        activityBtn.onclick = function () {
            addActivity(this.innerText);
        };
        activityDiv.appendChild(activityBtn);
    }
    document.getElementById("getActivitiesBtn").disabled = true;
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
        var cardBreak = document.createElement('br');
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
        cardText.innerText = activityDict[activityName][2];
            // Time
        var cardTimeList = document.createElement('ul');
        cardTimeList.className = "list-group list-group-flush";
        var cardTimeElement = document.createElement('li');
        cardTimeElement.className = "list-group-item";
        cardTimeElement.innerText = "Duration: " + activityDict[activityName][0] + " hours.";
        cardTimeList.appendChild(cardTimeElement);
        // Remove Button
        var buttonDiv = document.createElement('div');
        buttonDiv.className = "card-body";
        var removeBtn = document.createElement('button');
        removeBtn.className = "removeBtn btn btn-danger";
        removeBtn.innerText = "Remove " + activityName;
        removeBtn.onclick = function() {
            removeActivity(this.innerText.substr(7));
        };
        buttonDiv.appendChild(removeBtn);
        // Append all
        cardBody.appendChild(cardTitle);
        cardBody.appendChild(cardText);
        card.appendChild(cardBody);
        card.appendChild(cardTimeList);
        card.appendChild(buttonDiv);
        cardsDiv.appendChild(cardBreak);
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

// Get total number of days from date pickers
function getDays() {
    var start = new Date(document.getElementById('startDate').value);
    var end = new Date(document.getElementById('endDate').value);
    return parseInt((end - start) / (24 * 3600 * 1000));
}

// The big boy.
function optimiseJourney() {
    var optimisable = true;
    var timetableDict = {};
    var timetableTodo = currentActivities;
    var maxLength;

    // Initialise totalTime as 1 hour for each activity
    var totalTime = currentActivities.length;
    for (i = 0; i < currentActivities.length; i++) {
        totalTime += activityDict[currentActivities[i]];
    }
    // Get days
    var totalDays = getDays();
    console.log(totalDays);
    // Get day length
    // Check if there is not enough time in the day
    if (document.getElementById('shortDay').checked) {
        maxLength = 4;
    } else if (document.getElementById('normalDay').checked) {
        maxLength = 6;
    } else if (document.getElementById('longDay').checked) {
        maxLength = 8;
    } else {
        alert("Select a day length!");
        optimisable = false;
    }
    for (i = 0; i < currentActivities.length; i++) {
        if (parseFloat(activityDict[currentActivities[i]][0]) > maxLength - 1) {
            alert("One activity is too long.");
            optimisable = false;
        }
    }
    if (totalDays === 0 || totalDays < 0) {
        alert("Invalid range.");
        optimisable = false;
    }

    if (totalTime / totalDays > maxLength) {
        alert("Too many activities per day.");
        optimisable = false;
    }

    if (isNaN(getDays())) {
        alert("Select correct dates!");
        optimisable = false;
    }

    if (optimisable) {
        var filledTime = 0;
        var day = 0;
        var activitiesPerDay = [];
        while (day <= totalDays && timetableTodo.length > 0) {
            while (filledTime < maxLength) {
                if (timetableTodo.length === 0) {
                    break;
                }
                var activityName = timetableTodo[timetableTodo.length - 1];
                var activityDuration = 1 + parseFloat(activityDict[activityName][0]);
                filledTime += activityDuration;
                if (filledTime <= maxLength) {
                    activitiesPerDay.push("Transit");
                    activitiesPerDay.push(activityName);
                    timetableTodo.pop();
                }
            }
            timetableDict[day] = activitiesPerDay;
            day++;
            filledTime = 0;
            activitiesPerDay = [];
        }
        console.log(timetableDict);
        drawTimetable(timetableDict);
    } else {
        resetJourney();
    }
}

// Draw timetable
function drawTimetable(timetableDict) {
    // Get timetable list
    var timetableList1 = document.getElementById('timetableParent1');
    var timetableList2 = document.getElementById('timetableParent2');
    // Grab activities and durations and append to timetable
    for (var day in timetableDict) {
        var activityList = timetableDict[day];
        var totalTime = 0;
        for (i = 0; i < activityList.length; i++) {
            if (activityList[i] === "Transit") {
                totalTime += 1;
            } else {
                totalTime += parseFloat(activityDict[activityList[i]][0]);
            }
        }
        var dayContainer = document.createElement('div');
        dayContainer.className = "container";

        var dayLabel = document.createElement('h4');
        var currentDay = new Date(document.getElementById('startDate').value);
        currentDay.setDate(currentDay.getDate() + parseInt(day));
        currentDay = currentDay.toLocaleDateString('en-AU');
        dayLabel.innerText = currentDay + ", " + totalTime + " hours.";
        dayContainer.appendChild(dayLabel);
        for (i = 0; i < activityList.length; i++) {
            var activityName = activityList[i];
            var activityDuration;

            var activityContainer = document.createElement('div');
            activityContainer.className = "card";
            var activityHeader = document.createElement('div');
            activityHeader.className = "card-header";
            activityHeader.innerHTML = "<h5>Activity: " + activityName + "</h5>";

            var activityInformation = document.createElement('ul');
            activityInformation.className = "list-group list-group-flush";

            if (activityName !== "Transit") {
                activityDuration = activityDict[activityName][0];
            } else {
                activityDuration = 1;
            }

            var activityTime = document.createElement('li');
            activityTime.className = "list-group-item";
            activityTime.innerText = "Duration: " + activityDuration + " hours.";
            var elementBreak = document.createElement('br');

            activityContainer.appendChild(activityHeader);
            activityInformation.appendChild(activityTime);
            activityContainer.appendChild(activityInformation);
            dayContainer.appendChild(activityContainer);
            dayContainer.appendChild(elementBreak);
        }
        timetableList1.appendChild(dayContainer);
        timetableList2.innerHTML = timetableList1.innerHTML;
    }
    document.getElementById('printBtn').disabled = false;
}

// Reset journey
function resetJourney() {
    currentActivities = [];
    activityDict = {};
    document.getElementById('startDate').value = "";
    document.getElementById('endDate').value = "";
    resetButtons();
    drawActivities();
    document.getElementById('timetableParent1').innerHTML = "";
    document.getElementById('timetableParent2').innerHTML = "";
    document.getElementById('locationH4').innerText = "No location selected!";
}

// Reset status of all buttons
function resetButtons() {
    var buttonList = document.getElementsByClassName('activityBtn btn btn-secondary');
    var printBtn = document.getElementById('printBtn');
    var activityBtn = document.getElementById('getActivitiesBtn');
    var btnList = document.getElementById('activityDiv');
    activityBtn.disabled = true;
    printBtn.disabled = true;
    btnList.innerHTML = "";
    for (i = 0; i < buttonList.length; i++) {
        buttonList[i].disabled = false;
    }

}

// General function to trim trailing whitespace from strings.
function trim(s) {
    return (s || '').replace(/^\s+|\s+$/g, '');
}

// Functionality to print the timetable.
function printTimetable() {
    var invoiceInfo = document.getElementById('invoiceList');
    var nameField = document.createElement('li');
    var locationField = document.createElement('li');
    var dateField = document.createElement('li');

    var startDate = new Date(document.getElementById('startDate').value);
    var endDate = new Date(document.getElementById('endDate').value);

    startDate.setDate(startDate.getDate());
    endDate.setDate(endDate.getDate());
    startDate = startDate.toLocaleDateString('en-AU');
    endDate = endDate.toLocaleDateString('en-AU');

    dateField.innerText = startDate + " to " + endDate;
    nameField.innerText = "John Smith";
    locationField.innerText = tripDestination;

    invoiceInfo.appendChild(nameField);
    invoiceInfo.appendChild(dateField);
    invoiceInfo.appendChild(locationField);

    var divContents = document.getElementById('dvContainer').innerHTML;
    var printWindow = window.open('', 'PRINT', 'height=400,width=800');

    printWindow.document.write('<html><head><title>Journey Planner</title><link rel="stylesheet" href="./css/bootstrap.css">');
    printWindow.document.write('</head><body>');
    printWindow.document.write(divContents);
    printWindow.document.write('</body></html>');
    printWindow.print();
    printWindow.document.close();
}