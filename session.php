<?php 

	$servername = "localhost";
	$username = "travolla";
	$passworddb = "SeaBoat909";

	// Create connection
	$conn = new mysqli($servername, $username);

	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 
	echo "Connected successfully";
	session_start();

	/*if(isset($_SESSION['loggedin'])){
			$session_sql = $mysqli->prepare("SELECT email FROM User WHERE email = ?");
			$user_check = $_SESSION['user'];
			$session_sql->bind_param("s", $user_check);
			$session_sql->execute();
			$session_sql->bind_result($email);
			$session_sql->fetch();
			$login_session = $email;
			$session_sql ->close();
		}*/

	if(!isset($login_session)){
		mysqli_close($mysqli);
	}
?>
