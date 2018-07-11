<?php
    include('session.php');
    require('encryption1.php');
    $output = NULL;
 	$output2 = NULL;
    $output3 = NULL;

    //Check form

    if (isset($_POST['submit'])) {

 	//Connect to the database
 	$mysqli = new MySQLi('travolla.hm', 'travolla', 'SeaBoat909', 'travolla_main');

	// Lea's hack for local db access 
        //$mysqli = new MySQLi('localhost', 'travolla_main', 'travolla_main', 'travolla_main');

        //Retrieve the string of email and password inputs

        $email=$mysqli->real_escape_string($_POST['email']);
        $password=$mysqli->real_escape_string($_POST['password']);
        
        //Query the email in the database
        $query = $mysqli->query ("SELECT * FROM users WHERE email='$email'");

        if($query->num_rows == 0){
            echo "<script>alert('The email you have entered is invalid');</script>"; 
            //$output = "The email you've entered is invalid";

        }else{
        	while($row = mysqli_fetch_assoc($query)) {
                $db_salt = $row['salt'];
                $db_password = $row['password'];
                //echo $db_password;

            }if(function_exists('hash_equals')){
                $output2 = "it exists";
            }else{
                $output2 = "it doesn't";
            }
            $input = crypt($password, $db_salt); 
			if(hash_equals($db_password, $input)){
				$output = $_SESSION;
				$_SESSION['loggedin'] = TRUE;
				$user_query = $mysqli->query ("SELECT name FROM users WHERE email='$email'");
				while($row = mysqli_fetch_assoc($user_query)) {
					$db_fullname = $row['name'];
					header('Location: destinations.php');
				}
			    $_SESSION['user'] = $db_fullname;
			}else{
				echo "<script>alert('Sorry, your password is incorrect');</script>"; 
			    $output = "Sorry your password is incorrect";
			}         
		  }  
	}

    //print_r($output);
	//echo $output2;
	//echo $output3;

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
	<link rel="stylesheet" type="text/css" href="css\index.css">
    <link rel="stylesheet" type="text/css" href="css\main.css">
    <link href="https://fonts.googleapis.com/css?family=Patua+One" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <script src="js\scroll.js"></script>


</head>

<body onload="displayWindowSize()" onresize="displayWindowSize()">	     
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
            
            <?php
        if(isset($login_session)){
            $box1 = " <li class=\"nav-item\">
            <a class=\"nav-link\" href=\"destinations.php\"> My Destinations</a>
          </li>";
            echo $box1;
        }
        
        
        ?>
            <li class="nav-item">
                <a class="nav-link" href="heatmap.html">  Heat Map </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="about.php">  About </a>
            </li>
        </ul>
      </div>
    <?php
        //if (isset($_SESSION) && //($_SESSION['loggedin'] == TRUE)) {
        if(isset($login_session)){
            $box = " <ul class='nav navbar-nav navbar-right'>
                        <li>
                            <span style='color: white;'>".$_SESSION['user']."</span> <a href='logout1.php'> | Log out</a>
                        </li>
                     </ul>";
            echo $box;
        }
        ?>
    </nav>
    <div class="cover-container" >
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 landing" >
            <h1 id="title"> Welcome to Travolla </h1>
            
            <div class="row">
                
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4" >
                    
                </div>
                
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4" >
                    <form id="homeform" method ="post" action="">
                        
                        <!--Buttons-->
                        <?php
                            if(!isset($login_session)){
                                $box = " <button class='btn btn-lg btn-primary btn-block' onclick=\"location.href='signup.php';\">Sign Up</button> 
                                <button id='loginbutton' class='btn btn-lg btn-primary btn-block' >Log in</button>";
                            }else{
                                $box=" <button class='btn btn-lg btn-primary btn-block' onclick=\"location.href='destinations.php';\" > Get Started </button>";
                            }
                            
                            echo $box;
                        ?>
                        
                        
                        <!--<button class="btn btn-lg btn-primary btn-block" onclick="location.href='logout1.php'">Log out</button>-->
                                                    
                            <!--Login panel that will appear when Login button clicked-->

                            <div id="loginpanel">
                                <label for="inputEmail" class="sr-only">Email address</label>
                                <input type="email" id="inputEmail" class="form-control" placeholder="Email address" name="email" required >

                                <label for="inputPassword" class="sr-only">Password</label>
                                <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" required>
                                <input type="submit" name ="submit">
                                    <!--<img src="css\images\loginarrow.png" alt = "loginarrow">-->
                            </div>
                    </form>
                </div>
                
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4" >
                </div>
                
            </div>
            <a class="ct-btn-scroll ct-js-btn-scroll" href="#container-fluid" style="margin-top: 10%;"><img id="arrow" alt="Arrow Down Icon" src="https://www.solodev.com/assets/anchor/arrow-down.png"></a>
        </div>
    </div>
	  

	<div id="container-fluid" style="width: 70%; margin: auto; background-color: white; margin-top: 5%; text-align: justify;">
	  	<h2 ><br><br> What can you do? </h2>

        <!-- First Feature-->

	  	<div class="row">
    		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6" >
      			<h3> Match with a local guide to take you around </h3>
                
      			<p> Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500, quand un peintre anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n'a pas fait que survivre cinq siècles.</p>
    		</div>
    		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
    			<img src="css\images\bg.jpg" alt = "Welcomepic" style=" width: 85%; margin-bottom: 10%;">
    		</div>
        </div>
        
        <!--Second Feature-->
        <div class="row">
             <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
    			     <img src="css\images\bg.jpg" alt = "Welcomepic" style=" width: 85%; margin-bottom: 10%;">
                </div>
    		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6" >
      			<h3> Match with a local guide to take you around </h3>
               
      			<p> Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500, quand un peintre anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n'a pas fait que survivre cinq siècles.</p>
    		</div>
        </div>
        
        <!--Third Feature-->

        <div class="row">
    		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6" >
      			<h3> Match with a local guide to take you around </h3>
      			<p> Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500, quand un peintre anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n'a pas fait que survivre cinq siècles.</p>
    		</div>
    		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
    			<img src="css\images\bg.jpg" alt = "Welcomepic" style=" width: 85%; margin-bottom: 10%;">
    		</div>
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
                     <!--<img id="team" src="css\images\teamlogo.png" alt = "teamlogo">-->
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
            $('.landing').css('height',screenheight);
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
