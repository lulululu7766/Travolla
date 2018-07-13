<?php
    include('session.php');
    require('encryption1.php');
    $output = NULL;
 	$output2 = NULL;
    //session_start(); 

    //Connect to the database
    $mysqli = new MySQLi('travolla.hm', 'travolla', 'SeaBoat909', 'travolla_main');
    //$mysqli = new MySQLi('localhost', 'travolla_main', 'travolla_main', 'travolla_main');   
    
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
    <link rel="stylesheet" type="text/css" href="css\index.css">
    <link rel="stylesheet" type="text/css" href="css\about.css">
    <link href="https://fonts.googleapis.com/css?family=Patua+One" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <!-- Vendor libraries -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/jquery.validate.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.payment/1.2.3/jquery.payment.min.js"></script>


</head>

<body  onload="displayWindowSize()" onresize="displayWindowSize()">	  
    
    <?php include('header.php') ?>
    
    <div class="container-fluid">
        <h1 id="toptitle"> Epayment </h1>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 " >

        </div> 
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2" >
                </div>
                
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8" >
                    <h2>Trip Invoice</h2>
                    <div>
                        <p>Activity Cost <span id="activitycost"> $200 </span></p>
                        <p>Guide Cost <span id="guidecost" > $30/hour </span></p>
                        <p>Day Duration <span id="duration"> 6 hours </span></p>
                        <hr>
                        <p style="font-weight: bold;">Total Cost <span id="total"> $380 </span></p>
                    </div>
                </div>
                
                <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2" >
                </div>
            </div>
            
    <div class="row pay" style="margin-top: 3%;">
        <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2" >
                </div>
        
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
        
            <h2>Payment Details</h2>

            <!-- CREDIT CARD FORM STARTS HERE -->
            <div class="panel panel-default credit-card-box">
                <div class="panel-body">
                    <form role="form" id="payment-form">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label for="cardNumber">Card Number</label>
                                    <div class="input-group">
                                        <input 
                                            type="tel"
                                            class="form-control"
                                            name="cardNumber"
                                            placeholder="Valid Card Number"
                                            autocomplete="cc-number"
                                            required
                                        />
                                    </div>
                                </div>                            
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                                <div class="form-group">
                                    <label for="cardExpiry">Expiration Date</label>
                                    <input 
                                        type="tel" 
                                        class="form-control" 
                                        name="cardExpiry"
                                        placeholder="MM / YY"
                                        autocomplete="cc-exp"
                                        required 
                                    />
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 pull-right">
                                <div class="form-group">
                                    <label for="cardCVC">CVC Code</label>
                                    <input                                             type="tel" 
                                        class="form-control"
                                        name="cardCVC"
                                        placeholder="CVC"
                                        autocomplete="cc-csc"
                                        required
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <!--Redirections-->
                                <?php
                                    if(!isset($_SESSION)){
                                        echo "<script type='text/javascript'>alert('Please log in before payment.');window.location.href = \"index.php\";</script>"; 
                                        $box = " <button class=\"subscribe btn btn-success btn-lg btn-block\" onclick=\"location.href='index.php'\" type=\"button\">Pay Now</button>" ;
                                    }else{
                                        $box=" <button class=\"subscribe btn btn-success btn-lg btn-block\" onclick=\"location.href='successful_pay.php'\" type=\"button\">Pay Now</button>";
                                    }
                                    echo $box;
                                ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>            
            <!-- CREDIT CARD FORM ENDS HERE -->
  
            </div>  
            <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2" >
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