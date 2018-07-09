
	<?php
		$servername = "travolla.hm";
		$username = "travolla";
		$passworddb = "SeaBoat909";
    	$dbname = "travolla_main";
    	$table = "activities";

    	$cityid =  $_REQUEST['cityid'];

    	$activitylist = array();

		$mysqli = mysqli_connect($servername, $username, $passworddb, $dbname);
		// Check connection
		if ($mysqli->connect_error) {
	    	die("Connection failed: " . $mysqli->connect_error);
		}

		$activityquery = $mysqli->query("SELECT name, estimated_time, subtitle, description, category, cost, comment FROM $table WHERE city_id LIKE $cityid");

		while($row = $activityquery->fetch_assoc()){
			$activitylist[] = $row;
		}

		$jsonexport = array("ACTIVITIES"=> $activitylist);
		
		echo json_encode($jsonexport);

	  	mysqli_close($mysqli);
	?>
