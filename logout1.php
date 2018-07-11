<?php
    include('session.php');
    $output = NULL;
 	$output2 = NULL;
    //session_start(); 

 	
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
    <link rel="stylesheet" type="text/css" href="css\about.css">
    <link rel="stylesheet" type="text/css" href="css\index.css">
    <link href="https://fonts.googleapis.com/css?family=Patua+One" rel="stylesheet">
    <script src="js\scroll.js"></script>


</head>

<body  onload="displayWindowSize()" onresize="displayWindowSize()">	  
    
    <?php include('header.php'); ?>
    
    <div class="container-fluid">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 " >
            <h1 id="toptitle"> Log out </h1>
            
            <?php
                echo "<h1 style= \" margin-bottom: 2%; margin-top: 5%; font-size: 2em; font-family: 'Patua One',cursive; color:#F47820; text-align: center;\">Thank you " . $_SESSION['user'] ." for using Travolla.</h1>";
                //print_r($_SESSION);
                $output = " <h1 style=\" font-size: 2em; font-family: 'Patua One',cursive; color: #F47820;text-align: center;\"> We hope to see you soon !<h1>";
                $_SESSION['loggedin'] = FALSE;
                //print_r($_SESSION);
                session_destroy();
                $_SESSION = [];
                //echo"session is destroyed";
                //print_r($_SESSION);
                echo $output;
            ?>
            
            <button class='btn btn-lg btn-primary btn-block'onclick="location.href='index.php';" style="margin-left: 30%; width: 40vw; background-color: #F47820; font-weight: bold; border: none; margin-top: 5%;">Return to Home Page</button>
            </div>
        </div>


    <?php include('footer.php'); ?>
    
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