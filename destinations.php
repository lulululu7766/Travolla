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
    <link rel="stylesheet" type="text/css" href="css\destinations.css">
    <link href="https://fonts.googleapis.com/css?family=Patua+One" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">


</head>

<body  onload="displayWindowSize()" onresize="displayWindowSize()">	  
    
<?php
    include('header.php');
?>
    
    <div class="container-fluid">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 " >
            <h1 id="toptitle"> My Destinations </h1>
        </div>     

        <div class="row section">
                
                <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2" >
                </div>
                
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8" >
                        
                        <div >
                            <h2 class="header2"> Upcoming Trips </h2><hr>
                            
                            <div class="row">
                              <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 ">
                                <a href="journeyplanner.php">
                                  <div class="card mb-4 box-shadow ">
                                    <img class="card-img-top thumbpic" src="css/images/newtrip.png" alt="Card image cap">
                                    <div class="card-body" style="color: black;">
                                      <p class="card-text">New Trip</p>
                                      <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                          <button type="button" class="btn btn-sm btn-outline-secondary">Add</button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </a>
                              </div>
                                
                              <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                <div class="card mb-4 box-shadow">
                                    <img class="card-img-top thumbpic" src="css/images/dubai.jpg" alt="Card image cap">
                                    <div class="card-body">
                                      <p class="card-text">Dubai Trip</p>
                                      <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                          <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                                          <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                                        </div>
                                        <small class="text-muted">9 mins</small>
                                      </div>
                                    </div>
                                  </div>
                              </div>
                                
                                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                <div class="card mb-4 box-shadow">
                                    <img class="card-img-top thumbpic" src="css/images/paris.jpg" alt="Card image cap">
                                    <div class="card-body">
                                      <p class="card-text">Paris Trip</p>
                                      <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                          <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                                          <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                                        </div>
                                        <small class="text-muted">11/07/2018</small>
                                      </div>
                                    </div>
                                  </div>
                              </div>
                            </div>
                        </div>
                        

                    </div>
        
                <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2" >
                </div>
            </div>  
        
        <div class="row">
                
                <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2" >
                </div>
                
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8" >
                        
                        <div>
                            <h2 class="header2"> Past Trips </h2><hr>
                        </div>
                    
                        <div class="row">
                              <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                <div class="card mb-4 box-shadow">
                                    <img class="card-img-top thumbpic" src="css/images/nc.jpg" alt="Card image cap">
                                    <div class="card-body">
                                      <p class="card-text">New Caledonia Trip</p>
                                      <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                          <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                                        </div>
                                    
                                      </div>
                                    </div>
                                  </div>
                              </div>
                                
                              <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                <div class="card mb-4 box-shadow thumbpic">
                                    <img class="card-img-top" src="css/images/nyc.jpg" alt="Card image cap">
                                    <div class="card-body">
                                      <p class="card-text"> New York Trip </p>
                                      <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                          <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                              </div>
                    </div>
                        

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