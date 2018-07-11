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

<nav class="navbar navbar-expand-md fixed-top bg-dark">
    <a class="navbar-brand" href="index.php"><img src="css/images/teamlogo.png"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">Home </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="about.php">  About </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="heatmphpap.">  Heat Map </a>
            </li>
            <?php
            if ((isset($_SESSION) && ($_SESSION['loggedin'] == TRUE))) {
                $box = '<li class="nav-item">
                            <a class="nav-link" href="destinations.php"> My Destinations</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="journeyplanner.php"> Journey Planner</a>
                        </li>
                        ';
            }else{
                $box =  '';
            }
            echo $box;
            ?>
        </ul>
    </div>

    <?php

    if (!(isset($_SESSION) && ($_SESSION['loggedin'] == TRUE))) {
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
