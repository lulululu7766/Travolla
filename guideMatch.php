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
    <?php
    include('header.php');
    ?>
        <div id="main" class="container-fluid" style="padding-top: 5%">
            <div id="guideParent" class="container">
                <h1 id="toptitle">Available Guides in <?php echo $_REQUEST['cityId'] ?></h1>
                <div id="guideList" 
                class="container">
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
                                <a href="mailto:info@travolla.hm?Subject=Hello%20again" target="_top"> info@travolla.hm </a>
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

        <!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
        <script src="./js/guideMatch.js"></script>
    </body>
</html>



