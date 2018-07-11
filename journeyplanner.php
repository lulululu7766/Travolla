<!doctype html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" crossorigin="anonymous">
        <link rel="shortcut icon" href="css/images/weblogo.png"/>
        <link rel="stylesheet" type="text/css" href="css\main.css">
        <link rel="stylesheet" type="text/css" href="css\signup.css">
        <link rel="stylesheet" type="text/css" href="css\index.css">
        <link rel="stylesheet" type="text/css" href="css\journeyplanner.css">
        <link href="https://fonts.googleapis.com/css?family=Patua+One" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

		<title>Travolla - Optimised Journey Planner</title>
	</head>
	<body>
    <?php
    include('header.php');
    ?>

		<div class="container-fluid" style="padding-top: 5%" id="journeyPlannerMaster">
            <h1 id="toptitle">My Journey</h1>
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
                    <h4 id="locationH4">Select your destination!</h4>
                    <div class="input-group mb-3">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Location
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#" onclick="getActivities(5120)">Dalian, China</a>
                                <a class="dropdown-item" href="#" onclick="getActivities(8120)">Brisbane, Australia</a>
                            </div>
                        </div>
                        <button onclick="drawButtons()" class="getActivitiesBtn btn btn-primary" id="getActivitiesBtn">Find Activities!</button>
                    </div>
				</div>

                <!-- Container to display the list of activity buttons -->
                <h5>Activities:</h5>
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
				<button onclick="optimiseJourney()" class="optimiseBtn btn btn-primary" id="optimiseBtn">Optimise Journey!</button>
				<button onclick="resetJourney()" class="resetBtn btn btn-primary" id="resetBtn">Reset</button>
				
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
            <button onclick="printTimetable()" class="printBtn btn btn-primary" id="printBtn">Print Timetable</button>
            <button onclick="guideMatch()" class="printBtn btn btn-primary" id="selectBtn">Select Guide</button>
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
        <br>
        <footer class="container-fluid text-center">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 socialm">
                    <h3>Social Media</h3>

                    <br>

                    <a href = "http://www.facebook.com"><img src="css\images\facebook.svg" alt = "fb"></a>
                    <a href = "http://www.twitter.com"><img src="css\images\twitter.svg" alt = "twitter"></a>
                    <a href = "http://www.instagram.com"><img src="css\images\instagram.svg" alt = "instagram"></a><br>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 ">
                    <h3>Contact Us</h3>
                    <br>
                    <div id="contactus">
                        <ul>
                            <li>
                                <img src="css\images\tel.svg" alt = "tel">
                                <a href="tel:+61123456789">
                                    +(61) 123 456 789 </a>
                            </li>
                            <li>
                                <img src="css\images\email.svg" alt = "email">
                                <a href="mailto:someone@example.com?Subject=Hello%20again" target="_top"> travolla@innstation.com </a>
                            </li>
                            <li>&#9400; Travolla, Designed by innStation, 2018</li>

                        </ul>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <h3>Address</h3>
                    <br>
                    <div id="address">

                        <ul>
                            <li>
                                <img src="css\images\adress.svg" alt = "address"> The University Of Queensland
                            </li>
                            <li> St Lucia, Brisbane, QLD 4067, Australia</li>
                            <li>
                                <img src="css\images\adress.svg" alt = "address"> The Dalian Neusoft University of Information
                            </li>
                            <li> Dalian, Liyaoning, China </li>
                        </ul>

                    </div>
                </div>
            </div>
        </footer>

        <!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
        <script src="./js/journeyplanner.js"></script>
	</body>
</html>