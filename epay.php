<?php
    include('session.php');
    require('encryption1.php');
    $output = NULL;
 	$output2 = NULL;
    //session_start(); 

    //Connect to the database
    //$mysqli = new MySQLi('travolla.hm', 'travolla', 'SeaBoat909', 'travolla_main');
    $mysqli = new MySQLi('localhost', 'travolla_main', 'travolla_main', 'travolla_main');   
    
    echo $output;
    echo $output2;

    // Check connection
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    } else{
        echo "Connected successfully";
    }   
?>

<!DOCTYPE html>
<html>
<head>
	<title> Travolla </title>
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="shortcut icon" href="css/images/weblogo.png"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css\main.css">
    <link rel="stylesheet" type="text/css" href="css\epay.css">
    <link href="https://fonts.googleapis.com/css?family=Patua+One" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">


</head>

<body  onload="displayWindowSize()" onresize="displayWindowSize()">	  
    
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
            <a class="nav-link" href="journeyplanner.php"> Journey Planner</a>
          </li>
            <li class="nav-item">
                <a class="nav-link" href="heatmap.html">  Heat Map </a>
            </li>
        </ul>
      </div>
    <?php
        if(!isset($login_session)){
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
    
    <div class="container-fluid">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 " >
            <h1 id="toptitle"> Epayment </h1>
        </div> 
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2" >
                </div>
                
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8" >
                    <h2>Trip Invoice</h2>
                    <div>
                        <p>Activity Cost: <span id="activitycost"> $200 </span></p>
                        <p>Guide Cost: <span id="guidecost" > $30/hour </span></p>
                        <p>Day Duration: <span id="duration"> 6 hours </span></p>
                        <hr>
                        <p>Total Cost: <span id="total"> $380 </span></p>
                    </div>
                </div>
                
                <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2" >
                </div>
    </div>

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
    
    <!--Responsiveness--> 

    <script>
        function displayWindowSize() {
            
            //Retrieve the screen height of the user

            var screenheight = window.innerHeight;
            console.log(screenheight);
            //Adapt the landing container to have the screenheight minus 100px
            $('.container-fluid').css('margin-top',"7%");
        };
    </script>
    
    <!-- Optional JavaScript-->
    
    
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>
</html>