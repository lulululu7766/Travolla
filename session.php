<?php 

	$servername = "travolla.hm";
	$username = "travolla";
	$passworddb = "SeaBoat909";
    	$dbname = "travolla_main";

	// Lea's local DB connection
/*      $servername = "localhost";
	$username = "travolla_main";
	$passworddb = "travolla_main";
  	$dbname = "travolla_main"; */
    //Create connection to the database;
	$mysqli = new MySQLi($servername, $username, $passworddb, $dbname);

	// Check connection
	if ($mysqli->connect_error) {
	    die("Connection failed: " . $mysqli->connect_error);
	} 
	//echo "Connected successfully";

	if (!isset($_SESSION)) {
		session_start();
	}

	if(isset($_SESSION['loggedin'])){
		$user_check = $_SESSION['user'];
		$session_sql = $mysqli->prepare("SELECT name FROM users WHERE name = ?");
			$session_sql->bind_param("s", $user_check);
			$session_sql->execute();
			$session_sql->bind_result($users);
			$session_sql->fetch();
			$login_session = $users;
			$session_sql ->close();
				}


	if(!isset($login_session)){
		mysqli_close($mysqli);
	}
?>
