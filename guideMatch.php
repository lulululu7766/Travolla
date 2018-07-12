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
                <h1 id="toptitle">Available Guides</h1>
                <div id="guideList" class="container">
                </div>
            </div>
        </div>

        <br>
        
        <?php include('footer.php'); ?>

        <!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
        <script src="./js/guideMatch.js"></script>
    </body>
</html>



