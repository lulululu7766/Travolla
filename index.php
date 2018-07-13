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
				$user_query = $mysqli->query ("SELECT name, email, user_mode FROM users WHERE email='$email'");
				while($row = mysqli_fetch_assoc($user_query)) {
                    $db_email = $row['email'];
					$db_fullname = $row['name'];
                    $db_mode = $row['user_mode'];
                    
                     if( $db_mode == "Tourist"){
					   header('Location: destinations.php');
                     }else{
                       header('Location: guidehome.php');
                     }
				}
			    $_SESSION['user'] = $db_fullname;
                $_SESSION['email'] = $db_email;
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
    
<?php
    include('header.php');
?>    
    

    <div class="cover-container" >
        <h1 id="title"> Welcome to Travolla</h1>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 landing" >
         
            <div class="row">
                
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4" >
                    
                </div>
                
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4" >
                    <form id="homeform" method ="post" action="">
                        
                        <!--Buttons-->
                        <?php
                            if( (isset($_SESSION)) && (isset($_SESSION['loggedin'])) &&
                                ($_SESSION['loggedin'] == TRUE) ){
                                
                                $email = $_SESSION['email'];
                                //Query the email in the database
                                $mode_query = $mysqli->query ("SELECT user_mode FROM users WHERE email='$email'");

                                while($row = mysqli_fetch_assoc($mode_query)) {
                                $db_mode = $row['user_mode'];
                                //echo $db_mode;
                                //print_r($_SESSION['email']);
                                    if( $db_mode == "Tourist"){
                                        $box=" <button class='btn btn-lg btn-primary btn-block' onclick=\"location.href='destinations.php';\" > Get Started </button>";
                                       
                                    }else{
                                        $box=" <button class='btn btn-lg btn-primary btn-block' onclick=\"location.href='guidehome.php';\" > Get Started </button>";
                                    }
                                }
                                //echo $box;
                                
                                
                            }else{
                                $box = " <button class='btn btn-lg btn-primary btn-block' onclick=\"location.href='signup.php';\">Sign Up</button> 
                                <button id='loginbutton' class='btn btn-lg btn-primary btn-block' >Log in</button>";
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
                    <a class="ct-btn-scroll ct-js-btn-scroll" href="#container-fluid" style="margin-top: 10%;"><img id="arrow" alt="Arrow Down Icon" src="https://www.solodev.com/assets/anchor/arrow-down.png"></a>
                </div>
                
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4" >
                </div>

                
            </div>

        </div>
    </div>
	  

	<div id="container-fluid" style="width: 70%; margin: auto; background-color: white; margin-top: 5%; text-align: justify;">
	  	<h2 ><br><br> What can you do? </h2>

        <!-- First Feature-->

	  	<div class="row">
    		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6" >
      			<h3> Local Tour Guide Matching </h3>
                
      			<p> So you’ve made it! You’re in a foreign country and are ready to soak in the culture. There are just two problems: you don’t speak the local language, and you have no way to get around. Travolla has your back. We’ll automatically match you up with a local based on your timetable and personal preferences, so that you can not only navigate through your destination more efficiently, but also learn the local culture from those who know it best: locals (again, not middle-aged travel bloggers). </p>
    		</div>
    		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
    			<img src="css\images\guidelocal.jpg" alt = "Welcomepic" style=" width: 100%; margin-bottom: 10%;height: 40vh;">
    		</div>
        </div>
        
        <!--Second Feature-->
        <div class="row">
             <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
    			     <img src="css\images\act.jpg" alt = "Welcomepic" style=" width: 100%; margin-bottom: 10%; height: 40vh;">
                </div>
    		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6" >
      			<h3> Optimised Journey Planner </h3>
               
      			<p>When you’re holidaying in Hawaii, you don’t want to be sitting in your hotel room finding activities and organising transport. You want to be sitting on the beach, getting your tan on. When you’re honeymooning in Paris, you’d rather be eating your way through a baguette than eating away your time finding the best restaurant. Catering to single travellers, students, the elderly, and those with a disability, Travolla devises a travel schedule that is uniquely suited to users’ personal preferences and characteristics. Optimisation algorithms ensure a jam-packed schedule for the energetic and curious, or a laid-back getaway for those looking to escape the pressures of daily life, helping users to experience other cultures in a way that suits them.</p>
    		</div>
        </div>
        
        <!--Third Feature-->

        <div class="row">
    		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6" >
      			<h3> Heatmap - Travolla handles the heat so you don’t have to </h3>
                <p>Don’t like crowds? No problem - Travolla has you covered. Love the vibe of thousands of people all sharing the one moment? We can help you there too. With Travolla’s interactive heatmap, you can view crowd statistics at your destination in real-time. In this way, we can recommend activities based on what’s ACTUALLY popular, and not based on what some middle-aged blogger thinks is ‘hip’.</p>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
    			<img src="css\images\heat.png" alt = "Welcomepic" style=" width: 100%; margin-bottom: 10%;height: 40vh;">
    		</div>
        </div>
	</div>

    <?php include('footer.php') ?>
    
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
