<?php
    include('session.php');
    require('encryption1.php');
    $output = NULL;
 	$output2 = NULL;
    session_start(); 

 	if(isset($_POST['submit'])){

 		//Connect to the database
 		$mysqli = new MySQLi('travolla.hm', 'travolla', 'SeaBoat909', 'travolla_main');
        //$mysqli = new MySQLi('localhost', 'travolla_main', 'travolla_main', 'travolla_main');

		//Get the string of the inputs in the form
		$fullname = $mysqli->real_escape_string($_POST['fullname']);
	 	$email = $mysqli->real_escape_string($_POST['email']);
        $gender = $mysqli->real_escape_string($_POST['gender']);        
        $type = $mysqli->real_escape_string($_POST['type']);        
        $activity = $mysqli->real_escape_string($_POST['activity']);        
		$password = $mysqli->real_escape_string($_POST['password']);
        $plang = $mysqli->real_escape_string($_POST['plang']);
		$slang = $mysqli->real_escape_string($_POST['slang']);        
        
		//Query the email string of the input in the database

	  	$query = $mysqli->query("SELECT * FROM users WHERE email = '$email' ");
        
	  	//Check if the email already exists in the database
	  	
		if($query->num_rows != 0) {
	    	$output = "Sorry, this email address is already registered";
  		}else{

  			//Encrypts the password
	    	$encrypted = encryption1($password);
	    	$password = $encrypted["password"];

	    	$salt = $encrypted['salt'];

	    	//Insert the record
	    	$insert = $mysqli->query("INSERT INTO users (email, name, gender, password, salt, pri_lang, sec_lang, activity_level, user_mode) VALUES ('$email','$fullname', '$gender', '$password', '$salt', '$plang', '$slang', '$activity', '$type')");
			if($insert != TRUE){
				$output = "There was a problem <br />";
				$output .= $mysqli->error;
			}else{
        		//Display Welcome to the specific customer + Logout button
        		//header('Location: index.html');
				$output = "You have been successfully registered!";
			}
		}
        
            echo $output;
            echo $output2;
            // Check connection
            if ($mysqli->connect_error) {
                die("Connection failed: " . $mysqli->connect_error);
            } else{echo "Connected successfully";}
            echo $fullname;
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
    <link rel="stylesheet" type="text/css" href="css\signup.css">
    <link href="https://fonts.googleapis.com/css?family=Patua+One" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <script src="js\scroll.js"></script>


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
                <a class="nav-link" href="heatmap.html">  Heat Map </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="about.php">  About </a>
            </li>
        </ul>
      </div>
    </nav>
    
    <div class="container-fluid">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 " >
            <h1 id="toptitle"> Sign Up </h1>
            
            <div class="progress">
            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100" style="width: 35%"></div>
            </div>
            
            <div class="row">
                
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4" >
                </div>
                
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4" >
                    <form id="signupform" method = "post" action="">
                        
                        <div id="pers">
                            <h2> <img src="css/images/downarrow.png" alt="downarrow"> Personal details </h2>
                        </div>
                        
                        <div id="signup1">
                        <label for="inputname" class="sr-only">Full Name</label>
                        <input type="text" id="inputName" class="form-control" placeholder="Full Name" name="fullname"  required autofocus>
                            
                        <div class="form-group" style="margin-bottom: 4%;">
                                  <select id="inputgender" class="form-control" name="gender" >
                                    <option selected>Gender</option>
                                    <option>Female</option>
                                    <option>Male</option>
                                  </select>
                                </div>
                        
                        <label for="inputEmail" class="sr-only">Email address</label>
                        <input type="email" id="inputEmail" class="form-control" placeholder="Email address" name="email" required>

                        <label for="inputPassword" class="sr-only">Password</label>
                        <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" required>
                        
                        <div class="form-group" style="margin-bottom: 4%;">
                          <select id="inputflang" class="form-control" name="plang" >
                            <option selected>First Language</option>
                            <option>English</option>
                            <option>French</option>
                            <option>Chinese</option>
                            <option>...</option>
                          </select>
                        </div>
                        
                        <div class="form-group" style="margin-bottom: 4%;">
                          <select id="inputflang" class="form-control" name="slang" >
                            <option selected>Second Language</option>
                            <option>English</option>
                            <option>French</option>
                            <option>Chinese</option>
                            <option>...</option>
                          </select>
                        </div>
                            
                            <div class="form-group" style="margin-bottom: 4%;">
                              <select id="inputtype" class="form-control" name="type" >
                                <option selected> Type of Account </option>
                                <option>Tourist</option>
                                <option>Guide</option>
                                <option>Both</option>
                              </select>
                            </div>
                    </div>
                        
                        <div id="pref">
                             <h2><img src="css/images/downarrow.png" alt="downarrow"> Preferences </h2>
                        </div>
                        
                            <div id="signup2" >
                                
                                <div class="form-group" style="margin-bottom: 4%;">
                                  <select id="inputactivity" class="form-control" name="activity" >
                                    <option selected>Activity Level</option>
                                    <option>Lazy</option>
                                    <option>Active</option>
                                    <option>Hyperactive</option>
                                  </select>
                                </div>
                             
                              <h3 id="mobility">Mobility</h3> 
                            <img class="mobicons" src="css/images/wheelchair.png" alt="disabled">
                            <img class="mobicons" src="css/images/turtle.png" alt="slow">
                            <img class="mobicons" src="css/images/rabbit.png" alt="fast">
                                
                            <h3>What I like </h3>
                        
                        <div class="row q1">
                            <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2" >
                                <img src="css\images\interest\shopping.jpg" >
                                <div class="subtitle">
                                     <p> Shopping </p>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2" >
                                <img src="css\images\interest\sports.jpg" >
                                <div class="subtitle">
                                     <p> Sports </p>
                                </div>
                            </div>
                            
                             <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2" >
                                <img src="css\images\interest\hike.jpg" >
                                <div class="subtitle">
                                     <p> Hiking </p>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6" >    
                            </div>
                      </div>
                        
                      <div class="row q2">
                          <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2" >
                            <img src="css\images\interest\nature.jpg" >
                            <div class="subtitle">
                                 <p> Nature</p>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2" >
                            <img src="css\images\interest\museum.jpg" >
                            <div class="subtitle">
                                <p> Museums </p>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2" >
                            <img src="css\images\interest\food.jpg" >
                            <div class="subtitle">
                                <p> Food</p>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6" >
                        </div>
                    </div>
                                
                    <div class="row q3">
                        <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2" >
                            <img src="css\images\interest\archi.jpg" >
                            <div class="subtitle">
                                 <p> Architectural </p>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2" >
                            <img src="css\images\interest\animal.jpg" >
                            <div class="subtitle">
                                 <p> Animal </p>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                            <img src="css\images\interest\park.jpg" >
                            <div class="subtitle">
                                 <p> Events </p>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        </div>
                    </div>            
                </div>
            
            
                <input class="btn btn-lg btn-primary btn-block" type="submit" name ="submit" value = " Create">                    
            </form>
        </div>
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4" >
            </div>      
        </div>
            <a class="ct-btn-scroll ct-js-btn-scroll" href="#container-fluid" style="margin-top: 10%;"><img id="arrow" alt="Arrow Down Icon" src="https://www.solodev.com/assets/anchor/arrow-down.png"></a>
        </div>
        <?php
            
        
        ?>
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