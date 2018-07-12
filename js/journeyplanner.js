window.onload = function() {
    // Disable the 'Find Activities!' button.
    document.getElementById('getActivitiesBtn').disabled = true;
    // Disable the 'Print Timetable' button.
    document.getElementById('printBtn').disabled = true;
    document.getElementById('selectBtn').disabled = true;
}

// Timetable dictionary storing data as Day : [Array containing activities]
var timetableDict = {};

// Store the activities.
var activityDict = {};

// An array containing the current selected activities.
var currentActivities = [];

// Stores the destination of the traveller.
var tripDestination;

// Get list of all activities in area
function getActivities(cityId) {
    activityDict = {};
    currentActivities = [];
    if (cityId === 5120) {
        document.getElementById('dropdownMenuButton').innerText = "Dalian, China";
        tripDestination = "Dalian, China";
    } else {
        document.getElementById('dropdownMenuButton').innerText = "Brisbane, Australia";
        tripDestination = "Brisbane, Australia";
    }
    destinationId = cityId;
    var buttonDiv = document.getElementById('activityDiv');
    buttonDiv.innerHTML = "";
    // Get activities from DB and add to activityDict
    $.ajax({
        // Using a POST request
        type:"POST",
        // Pass through the cityId parameter
        url:"./js/helpers/journeyplannerhelper.php?cityid=" + cityId,
        success:function(data) {
            // Parse data in JSON format
            var object = JSON.parse(data);
            for (var i = 0; i < object["ACTIVITIES"].length; i++) {
                // Array format: [Name, Duration, Short description, Long description, Category, Cost, Rating]
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
    // Enable the 'Find Activities!' button.
    document.getElementById('getActivitiesBtn').disabled = false;
}

// Draw buttons of all activities
function drawButtons() {
    // Get div to place buttons in
    console.log(activityDict);
    var activityDiv = document.getElementById('activityDiv');
    // Create buttons by iterating over the activity dictionary, using the key as the button text.
    for (var activity in activityDict) {
        var activityBtn = document.createElement('button');
        // BOOTSTRAP Create a BootStrap btn-secondary button.
        activityBtn.className = "activityBtn btn btn-primary";
        activityBtn.innerText = activity;
        activityBtn.onclick = function () {
            addActivity(this.innerText);
        };
        activityDiv.appendChild(activityBtn);
    }
    // Disable the 'Find Activities!' button.
    document.getElementById("getActivitiesBtn").disabled = true;
}

// Add activity
function addActivity(activityName) {
    // Add to current activities
    currentActivities.push(activityName);
    deactivateButton(activityName);
    // Redraw the cards of activities.
    drawActivities();
}

// Remove activity
function removeActivity(activityName) {
    var activityIndex = currentActivities.indexOf(activityName);
    console.log(activityIndex);
    if (activityIndex !== -1) {
        currentActivities.splice(activityIndex, 1);
    }
    // Reactivate that activity's button, and redraw all activities.
    activateButton(activityName);
    drawActivities();
}

// Draw activities as Bootstrap cards
function drawActivities() {
    // Create Bootstrap div to contain cards.
    var cardsDiv = document.getElementById('cardsDiv');
    // Clear div
    cardsDiv.innerHTML = "";
    // Iterate over the currentActivities list and get all data.
    for (i = 0; i < currentActivities.length; i++) {
        var cardBreak = document.createElement('br');
        var activityName = currentActivities[i];
        // BOOTSTRAP Create new Bootstrap card
        var card = document.createElement('div');
        card.className = "card md-3";

        // Image TODO
        // BOOTSTRAP Create the Bootstrap card-body div.
        var cardBody = document.createElement('div');
        cardBody.className = "card-body";
        // BOOTSTRAP Create the Bootstrap card-title h4.
        var cardTitle = document.createElement('h4');
        cardTitle.className = "card-title";
        cardTitle.innerHTML = activityName;
        // BOOTSTRAP Create the Bootstrap card-text p.
        var cardText = document.createElement('p');
        cardText.className = "card-text";
        cardText.innerText = activityDict[activityName][2];
        // BOOTSTRAP Create a Bootstrap list-group containing the duration of the activity.
        var cardTimeList = document.createElement('p');
        cardTimeList.className = "card-text";
        cardTimeList.innerHTML = "Duration: <b>" + activityDict[activityName][0] + "</b> hours.";
        // BOOTSTRAP Append the Bootstrap btn-danger remove button.
        var buttonDiv = document.createElement('div');
        buttonDiv.className = "card-body";
        var removeBtn = document.createElement('button');
        removeBtn.id = activityName;
        removeBtn.className = "removeBtn btn btn-danger";
        removeBtn.innerText = "Remove Activity";
        removeBtn.onclick = function() {
            removeActivity(this.id);
        };
        buttonDiv.appendChild(removeBtn);
        // Append all of these components.
        cardBody.appendChild(cardTitle);
        cardBody.appendChild(cardText);
        cardBody.appendChild(cardTimeList);
        card.appendChild(cardBody);
        card.appendChild(buttonDiv);
        cardsDiv.appendChild(cardBreak);
        cardsDiv.append(card);
    }
}

// Activate activity button
function activateButton(activityName) {
    // Loop through the list of activity buttons and activate the one that matches the specified parameter.
    var buttonList = document.getElementsByClassName('activityBtn btn btn-secondary');
    for (i = 0; i < buttonList.length; i++) {
        if (buttonList[i].innerText === activityName) {
            buttonList[i].disabled = false;
        }
    }
}

// Deactivate activity button
function deactivateButton(activityName) {
    // Loop through the list of activity buttons and deactivate the one that matches the specified parameter.
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
    // Var to allow / disallow optimisation
    var optimisable = true;

    // Create a list of events to add.
    var timetableTodo = currentActivities;
    // Dependent on the user's preferences.
    var maxLength;

    // Initialise totalTime as 1 hour for each activity
    var totalTime = currentActivities.length;
    for (i = 0; i < currentActivities.length; i++) {
        totalTime += activityDict[currentActivities[i]];
    }
    // Get days
    var totalDays = getDays();
    console.log(totalDays);
    // Determine the day length
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
    // Check if there is not enough time in the day
    for (i = 0; i < currentActivities.length; i++) {
        if (parseFloat(activityDict[currentActivities[i]][0]) > maxLength - 1) {
            alert("One activity is too long.");
            optimisable = false;
        }
    }
    // Check if user has selected the same day, or ending before the start.
    if (totalDays === 0 || totalDays < 0) {
        alert("Invalid range.");
        optimisable = false;
    }
    // If average hours is greater than the maxLength, there is too much going on.
    if (totalTime / totalDays > maxLength) {
        alert("Too many activities per day.");
        optimisable = false;
    }
    // If they have select only one or none.
    if (isNaN(getDays())) {
        alert("Select correct dates!");
        optimisable = false;
    }
    // Finally if these conditions are met, begin the optimisation.
    if (optimisable) {
        // Keeps track of how much time has been filled in a day.
        var filledTime = 0;
        // Keeps track of the days.
        var day = 0;
        // Stores the activities each day.
        var activitiesPerDay = [];
        // While the day is less than total days, and the activity list still has items in it.
        while (day < totalDays && timetableTodo.length > 0) {
            while (filledTime < maxLength) {
                // Are there no more items left?
                if (timetableTodo.length === 0) {
                    break;
                }
                // Get the last activity.
                var activityName = timetableTodo[timetableTodo.length - 1];
                filledTime++;
                filledTime += parseFloat(activityDict[activityName][0]);
                // If there is still time left.
                if (filledTime <= maxLength) {
                    activitiesPerDay.push("Transit");
                    activitiesPerDay.push(activityName);
                    // Remove the last element.
                    timetableTodo.pop();
                }
            }
            // Assign Key : Value pairs in the dictionary.
            timetableDict[day] = activitiesPerDay;
            // Increment the day.
            day++;
            // Reset filledTime and activitiesPerDay.
            filledTime = 0;
            activitiesPerDay = [];
        }
        // Draw the timetable.
        drawTimetable(timetableDict);

    } else {
        // If the journey cannot be optimised, reset the form.
        resetJourney();
    }
}

// Draw timetable
function drawTimetable(timetableDict) {
    // Get timetable list
    var timetableMainList = document.getElementById('timetableMain');
    // Get the invoice list
    var timetableInvoiceList = document.getElementById('timetableInvoice');
    // Grab activities and durations and append to timetableMainList
    for (var day in timetableDict) {
        // Get the array of activities
        var activityList = timetableDict[day];
        // Initialise the totalTime elapsed
        var totalTime = 0;
        // Determine the amount to add to the totalTime
        for (i = 0; i < activityList.length; i++) {
            if (activityList[i] === "Transit") {
                // Assume transit only takes 1 hour on average.
                totalTime += 1;
            } else {
                totalTime += parseFloat(activityDict[activityList[i]][0]);
            }
        }
        // BOOTSTRAP Create a new container for each day.
        var dayContainer = document.createElement('div');
        dayContainer.className = "container";
        // BOOTSTRAP Create the day heading.
        var dayLabel = document.createElement('h4');
        // Get the start date of the trip
        var currentDay = new Date(document.getElementById('startDate').value);
        // Add the right number of days to the date
        currentDay.setDate(currentDay.getDate() + parseInt(day));
        // Format it nicely
        currentDay = currentDay.toLocaleDateString('en-AU');
        // Assign the text of the dayLabel
        dayLabel.innerHTML = currentDay + ", <b>" + totalTime + "</b> hours.";
        dayContainer.appendChild(dayLabel);

        // BOOTSTRAP Create day heading for invoice.
        var invoiceDayHeading = document.createElement('h4');
        invoiceDayHeading.innerText = dayLabel.innerText;
        timetableInvoiceList.appendChild(invoiceDayHeading);
        // BOOTSTRAP Create table for holding activity information
        var invoiceDayTable = document.createElement('table');
        var invoiceHeadingRow = document.createElement('tr');
        invoiceHeadingRow.innerHTML = "<th>Activity</th><th>Duration</th>";
        invoiceDayTable.appendChild(invoiceHeadingRow);
        // Loop through the activityList, creating cards or table rows.
        for (i = 0; i < activityList.length; i++) {
            var activityName = activityList[i];
            var activityDuration;
            // BOOTSTRAP Create the card div.
            var activityContainer = document.createElement('div');
            activityContainer.className = "card";
            var activityHeader = document.createElement('div');
            // BOOTSTRAP Create the card-header
            activityHeader.className = "card-header";
            activityHeader.innerHTML = "<h5>Activity: <b>" + activityName + "</b></h5>";
            // BOOTSTRAP Create the list-group to house the activity information.
            var activityInformation = document.createElement('ul');
            activityInformation.className = "list-group list-group-flush";
            // Determine the duration of the activity.
            if (activityName !== "Transit") {
                activityDuration = activityDict[activityName][0];
            } else {
                activityDuration = 1;
            }
            // BOOTSTRAP Create list-group-item to go in activityInformation.
            var activityTime = document.createElement('li');
            activityTime.className = "list-group-item";
            activityTime.innerHTML = "Duration: <b>" + activityDuration + "</b> hours.";
            // Create a break for good measure.
            var elementBreak = document.createElement('br');
            // Append all this stuff.
            activityContainer.appendChild(activityHeader);
            activityInformation.appendChild(activityTime);
            activityContainer.appendChild(activityInformation);
            dayContainer.appendChild(activityContainer);
            dayContainer.appendChild(elementBreak);
            // BOOTSTRAP Create a table row for the invoice.
            var invoiceEventRow = document.createElement('tr');
            invoiceEventRow.innerHTML = "<td>" + activityName + "</td><td>" + activityDuration + "</td>";
            invoiceDayTable.appendChild(invoiceEventRow);
        }
        // Append all the items.
        timetableInvoiceList.appendChild(invoiceDayTable);
        var tableBreak = document.createElement('br');
        timetableInvoiceList.appendChild(tableBreak);
        timetableMainList.appendChild(dayContainer);
    }
    // Enable the printing button.
    document.getElementById('printBtn').disabled = false;
    document.getElementById('selectBtn').disabled = false;
}

// Reset journey
function resetJourney() {
    // Reset all possible data stores.
    currentActivities = [];
    activityDict = {};
    document.getElementById('startDate').value = "";
    document.getElementById('endDate').value = "";
    resetButtons();
    drawActivities();
    document.getElementById('timetableMain').innerHTML = "";
    document.getElementById('timetableInvoice').innerHTML = "";
    document.getElementById('locationH4').innerText = "No location selected!";
}

// Reset status of all buttons
function resetButtons() {
    // Reset the buttons, enable all activity buttons, and disable all buttons that must be disabled.
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
    var activityCost = 0;
    var totalHours = 0;
    for (var day in timetableDict) {
        // Get the array of activities
        var activityList = timetableDict[day];
        // Determine the amount to add to the totalTime
        for (i = 0; i < activityList.length; i++) {
            if (activityList[i] === "Transit") {
                // Assume transit only takes 1 hour on average.
                totalHours += 1;
            } else {
                totalHours += parseFloat(activityDict[activityList[i]][0]);
                activityCost += parseFloat(activityDict[activityList[i]][4]);
            }
        }
    }
    var guideCost = 30 * totalHours;
    console.log(guideCost);
    var totalCost = activityCost + guideCost;
    var activityCostSpan = document.getElementById('activitycost');
    activityCostSpan.innerText = "$" + activityCost;
    var guideCostSpan = document.getElementById('guidecost');
    guideCostSpan.innerText = "$" + guideCost;
    var durationSpan = document.getElementById('duration');
    durationSpan.innerText = totalHours + " hours.";
    var totalCostSpan = document.getElementById('total');
    totalCostSpan.innerText = "$" + totalCost;
    // Get the invoiceList that will contain all the personal details of the customer.
    var invoiceInfo = document.getElementById('invoiceList');
    var locationField = document.createElement('li');
    var dateField = document.createElement('li');

    var startDate = new Date(document.getElementById('startDate').value);
    var endDate = new Date(document.getElementById('endDate').value);

    startDate.setDate(startDate.getDate() + parseInt(1));
    endDate.setDate(endDate.getDate() + parseInt(1));
    startDate = startDate.toLocaleDateString('en-AU');
    endDate = endDate.toLocaleDateString('en-AU');

    dateField.innerText = startDate + " to " + endDate;
    locationField.innerText = tripDestination;
    // Append all the personal information.
    invoiceInfo.appendChild(dateField);
    invoiceInfo.appendChild(locationField);
    // Get the div content.
    var prtContent = document.getElementById('dvContainer');
    // Open the new print window
    var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
    WinPrint.document.write('<html><head><title>Journey Planner</title>');
    WinPrint.document.write('</head><body>');
    WinPrint.document.write(prtContent.innerHTML);
    WinPrint.document.write('</body></html>');
    WinPrint.document.close();
    WinPrint.focus();
    WinPrint.print();
    WinPrint.close();
}

// Goto guide matching
function guideMatch() {
    if (tripDestination === "Dalian, China") {
        var url = "guideMatch.php?cityId=5120";
    } else {
        var url = "guideMatch.php?cityId=8120";
    }

    window.location = url;
}