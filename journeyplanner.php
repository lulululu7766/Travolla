<!doctype html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="./css/bootstrap.css">
        <link rel="shortcut icon" href="css/images/weblogo.png"/>
        <link href="https://fonts.googleapis.com/css?family=Patua+One" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

		<title>Travolla - Optimised Journey Planner</title>
	</head>
	<body>
		<div class="container-fluid">
			<div id="heading" class="container">
				<h2>My Journey</h2>
			</div>
			<!-- Top Journey Planner container -->
			<div id="journeyPlanner" class="container">
				<h4>When are you visiting?</h4>
                <!-- Start / End date pickers -->
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text" id="basic-addon1">Start</span>
					</div>
					<input id="startDate" type="date" name="datePicker">
					<div class="input-group-append">
						<span class="input-group-text" id="basic-addon1">End</span>
					</div>
					<input id="endDate" type="date" name="datePicker">
				</div>
                <!-- Location selection div -->
				<div id="locationDiv">
                    <h4 id="locationH4">No location selected!</h4>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Location
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#" onclick="getActivities(5120)">Dalian, China</a>
                            <a class="dropdown-item" href="#" onclick="getActivities(8120)">Brisbane, Australia</a>
                        </div>
                    </div>
                    <button onclick="drawButtons()" class="getActivitiesBtn btn btn-success" id="getActivitiesBtn">Find Activities!</button>
				</div>

                <!-- Container to display the list of activity buttons -->
				<div id="activityDiv" class="container">
					
				</div>

                <!-- Container to hold the cards of the activities -->
				<div id="cardsDiv" class="container">
					
				</div>
				
				<br>

                <!-- Select the pace -->
				<div class="paceDiv">
					<h4>Day Length</h4>
					<div id="paceBtnDiv" class="btn-group btn-group-toggle" data-toggle="buttons">
						<label class="btn btn-secondary">
							<input type="radio" name="options" id="shortDay" autocomplete="off" checked>Short
						</label>
						<label class="btn btn-secondary active">
							<input type="radio" name="options" id="normalDay" autocomplete="off">Normal
						</label>
						<label class="btn btn-secondary">
							<input type="radio" name="options" id="longDay" autocomplete="off">Long
						</label>
					</div>
					
				</div>
				
				<br> <!-- This is gross I know, but hey it works -->

                <!-- Optimise and reset buttons -->
				<button onclick="optimiseJourney()" class="optimiseBtn btn btn-success" id="optimiseBtn">Optimise Journey!</button>
				<button onclick="resetJourney()" class="resetBtn btn btn-success" id="resetBtn">Reset</button>
				
			</div>
		</div>
		
		<br>

        <!-- Top Container to hold the timetable -->
		<div id="timetableContainer" class="container">
            <h4>Your Timetable</h4>
            <!-- Main container to hold events -->
            <div id="timetableMain" class="container">
            </div>
            <!-- Timetable print button -->
            <button onclick="printTimetable()" class="printBtn btn btn-success" id="printBtn">Print Timetable</button>
        </div>

        <!-- Print template container -->
        <div id="dvContainer" style="display: none;">
            <section style="font-family: 'Open Sans', sans-serif;">
                <h1 style="color: #F47820; margin-top: 10%;font-family: 'Patua One',cursive; text-align: center;">Journey Planner</h1>
                <div style="margin-left: 30%;">
                    <!-- Personal details go here -->
                    <ul style="list-style-type: none;" id="invoiceList">
                    </ul>
                </div>
            </section>
            <section style="font-family: 'Open Sans', sans-serif;">
                <!-- Events go here -->
                <div id="timetableInvoice" style="margin-left: 35%;margin-right: 10%;" class="container">
                </div>
                <h1 style="color: #F47820; margin-top: 5%;font-family: 'Patua One',cursive; text-align: center;">Trip Invoice</h1>
                <div style="margin-left: 10%; margin-right: 10%;">
                    <p>Activity Cost: <span id="activitycost" style="float: right;">$200</span></p>
                    <p>Guide Cost: <span id="guidecost" style="float: right;"> $30/hour </span></p>
                    <p>Day Duration: <span id="duration" style="float: right;">6 hours</span></p>
                    <hr style="width=75%;">
                    <p>Total Cost: <span id="total" style="float: right;"> $380</span></p>
                </div>
                <div style="margin-left: 10%;margin-right: 10%;">
                    <p style=" margin-top: 25%;color:#F47820; font-weight: bold; text-align: center; font-size: 30px; font-family: 'Patua One',cursive;">Thank you for using Travolla and wish you a happy holiday!</p>
                    <img src="css/images/weblogo.png" style="margin-left: 35%; height: 100px;position: absolute;">
                </div>
            </section>
        </div>

        <!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script src="./js/bootstrap.bundle.js"></script>
        <script src="./js/journeyplanner.js"></script>
	</body>
</html>