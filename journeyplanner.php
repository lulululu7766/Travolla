<!doctype html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="./css/bootstrap.css">

		<title>Travello - Optimised Journey Planner</title>
	</head>
	<body>
		<div class="container-fluid">
			<div id="heading" class="container">
				<h2>My Journey</h2>
			</div>
			
			<div id="journeyPlanner" class="container">
				<h4>When are you visiting?</h4>
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

                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Location
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#" onclick="getActivities(5120)">Dalian, China</a>
                        <a class="dropdown-item" href="#" onclick="getActivities(8120)">Brisbane, Australia</a>
                    </div>
                </div>

                <button onclick="drawButtons()" class="getActivitiesBtn btn btn-success" id="activityBtn">Get Activities!</button>
				
				<div id="locationDiv">
					
				</div>
				
				<div id="activityDiv" class="container">
					
				</div>
				
				<div id="cardsDiv" class="container">
					
				</div>
				
				<div id="timeDiv" class="container">
					
				</div>
				
				<br>
				
				<div class="paceDiv">
					<h4>Day Length</h4>
					<div id="paceBtnDiv" class="btn-group btn-group-toggle" data-toggle="buttons">
						<label class="btn btn-secondary active">
							<input type="radio" name="options" id="shortDay" autocomplete="off" checked>Short
						</label>
						<label class="btn btn-secondary">
							<input type="radio" name="options" id="normalDay" autocomplete="off">Normal
						</label>
						<label class="btn btn-secondary">
							<input type="radio" name="options" id="option3" autocomplete="off">Long
						</label>
					</div>
					
				</div>
				
				<br> <!-- This is gross I know, but hey it works -->
				
				<button onclick="optimiseJourney()" class="optimiseBtn btn btn-success" id="optimiseBtn">Optimise Journey!</button>
				<button onclick="resetJourney()" class="optimiseBtn btn btn-success" id="optimiseBtn">Reset</button>
				
			</div>
		</div>
		
		<br>
		
		<div id="timetableParent" class="container">
			<h4>Your Timetable</h4>
		</div>
		
		
		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script src="./js/bootstrap.bundle.js"></script>
        <script src="./js/journeyplanner.js"></script>
	</body>
</html>