<?php
include('session.php');
$output = NULL;
$output2 = NULL;
//session_start();


//Connect to the database
$mysqli = new MySQLi('travolla.hm', 'travolla', 'SeaBoat909', 'travolla_main');
//$mysqli = new MySQLi('localhost', 'travolla_main', 'travolla_main', 'travolla_main');

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
} else{echo "Connected successfully";}

?>

<nav class="navbar navbar-expand-md fixed-top navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php"><img src="css/images/weblogo.png"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">Home </a>
            </li>
    
            <?php
            if ( (isset($_SESSION)) && (isset($_SESSION['loggedin'])) && 
	         ($_SESSION['loggedin'] == TRUE) ) {
                $email = $_SESSION['email'];
                //Query the email in the database
                $mode_query = $mysqli->query ("SELECT user_mode FROM users WHERE email='$email'");
                
                while($row = mysqli_fetch_assoc($mode_query)) {
                $db_mode = $row['user_mode'];
                //echo $db_mode;
                //print_r($_SESSION['email']);
                    if( $db_mode == "Tourist"){
                        $box = '<li class="nav-item active">
                            <a class="nav-link" href="destinations.php"> My Destinations</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="journeyplanner.php"> Journey Planner</a>
                        </li>
                        ';
                    }else{
                        $box = '<li class="nav-item active">
                            <a class="nav-link" href="guidehome.php"> My Tours</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="journeyplanner.php"> Journey Planner</a>
                        </li>
                        ';
                    }
                }
                echo $box;

            }
            ?>
            
              <li class="nav-item active">
                <a class="nav-link" href="heatmap.php">  Heat Map </a>
            </li>
            
            <li class="nav-item active">
                <a class="nav-link" href="about.php">  About </a>
            </li>
        </ul>
    </div>

    <?php

    //if (!(isset($_SESSION) && ($_SESSION['loggedin'] == TRUE))) {
        if (!( (isset($_SESSION)) && (isset($_SESSION['loggedin'])) && 
	     ($_SESSION['loggedin'] == TRUE) )) {
        //if(!isset($login_session)){
        $box = " <ul class='nav navbar-nav navbar-right'>
                        <li>
                            <a href='index.php'>Log in</a>
                        </li>
                     </ul>";
    }else{
        $box =  " <ul class='nav navbar-nav navbar-right'>
                        <li>
                            <span style='color: white;'>".$_SESSION['user']."</span> <a href='logout1.php'> | Log out</a>
                        </li>
                     </ul>";
    }
    echo $box;
    ?>
</nav>
