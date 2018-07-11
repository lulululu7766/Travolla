<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="./css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="css\main.css">
        <link rel="stylesheet" type="text/css" href="css\signup.css">
        <link rel="stylesheet" type="text/css" href="css\index.css">
        <link rel="shortcut icon" href="css/images/weblogo.png"/>
        <link href="https://fonts.googleapis.com/css?family=Patua+One" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

        <title>Travolla - Guides</title>
    </head>
    <body>
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
                        <a class="nav-link" href="heatmap.php">  Heat Map </a>
                    </li>
                </ul>
            </div>
        </nav>
        <div id="main" class="container-fluid" style="padding-top: 5%">
            <div id="guideParent" class="container">
                <h1 id="toptitle">Available Guides in <?php echo $_REQUEST['cityId'] ?></h1>
                <div id="guideList" class="container">

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

    </body>
</html>



