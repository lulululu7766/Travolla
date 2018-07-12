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
			<!-- Top Journey Planner container -->
			<div id="journeyPlanner" class="container">
                <h1 id="toptitle">My Journey</h1>
                
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2" >
                    </div>
                    
                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8" >

                    <h4>When are you visiting?</h4>
                        <!-- Start / End date pickers -->
                        <div class="container datePicker">
                            <div class="row" style="margin-top: 5%;">
                                <div class="col-sm">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">Start</span>
                                        </div>
                                        <input id="startDate" type="date" name="datePicker">
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">End</span>
                                        </div>
                                        <input id="endDate" type="date" name="datePicker">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2" >
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2" >
                    </div>
                    
                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8" >
                        <!-- Location selection div -->
                        <div id="locationDiv">
                            <h4 id="locationH4">Select your destination!</h4>
                            <div class="input-group mb-3" style="margin-top: 5%;">
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
                    </div>
                    
                    <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2" >
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2" >
                    </div>
                    
                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8" >
                        <!-- Container to display the list of activity buttons -->
                        <h5>Activities:</h5>
                        <div id="activityDiv" class="container">
                            
                        </div>
                    </div>
                    
                    <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2" >
                    </div>
                    
                </div>
                
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2" >
                    </div>
                    
                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8" >
                        <!-- Container to hold the cards of the activities -->
                        <div id="cardsDiv" class="container">

                        </div>
                    </div>
                    
                    <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2" >
                    </div>
                    
                </div>
				
				<br>
                
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2" >
                    </div>
                    
                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8" >
                        <!-- Select the pace -->
                        <div class="paceDiv">
                            <h4>Day Length</h4>
                            <div id="paceBtnDiv" class="btn-group btn-group-toggle" data-toggle="buttons" style="margin-top: 5%;">
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
                    </div>
                    
                    <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2" >
                    </div>
                </div>
				
				<br> <!-- This is gross I know, but hey it works -->
                
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2" >
                    </div>
                    
                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8" >
                        <!-- Optimise and reset buttons -->
                        <button onclick="optimiseJourney()" class="optimiseBtn btn btn-primary" id="optimiseBtn">Optimise Journey!</button>
                        <button onclick="resetJourney()" class="resetBtn btn btn-primary" id="resetBtn">Reset</button>
                        
                        <br>

                        <div id="timetableContainer" class="container">
                            <br><br><br>

                            <h4 >Your Timetable</h4>
                            <!-- Main container to hold events -->
                            <div id="timetableMain" class="container">
                            </div>
                            <!-- Timetable print button -->
                            <button onclick="printTimetable()" class="printBtn btn btn-primary" id="printBtn" style="margin-top: 5%;">Print Timetable</button>
                            <button onclick="guideMatch()" class="printBtn btn btn-primary" id="selectBtn" style="margin-top: 5%;">Select Guide</button>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2" >
                    </div>
                </div>
			</div>
		</div>
		
		<br>
            

                   
                        <!-- Print template container -->
                        <div id="dvContainer" style="display: none;">
                            <section style="font-family: 'Open Sans', sans-serif;">
                                <div style="margin-left: 10%;margin-right: 10%;">
                                    <img src="css/images/weblogo.png" style="margin-left: 40%; height: 100px;">
                                    <p style=" margin-top: 5%;color:#F47820; font-weight: bold; text-align: center; font-size: 30px; font-family: 'Patua One',cursive;">Thank you for using Travolla and wish you a happy holiday!</p>
                                    
                                </div>
                                <h1 style="color: #F47820; margin-top: 10%;font-family: 'Patua One',cursive; text-align: center;">Journey Planner</h1>
                                <div style="margin-left: 30%;">
                                    <!-- Personal details go here -->
                                    <ul style="list-style-type: none;" id="invoiceList">
                                        <li><?php echo $_SESSION['user'];?></li>
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
                                
                            </section>
                        </div>
            
                    
        <br>
        <?php include('footer.php'); ?>

        <!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
        <script src="./js/journeyplanner.js"></script>
	</body>
</html>