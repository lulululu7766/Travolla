<?php
include('session.php');
require('encryption1.php');

$mysqli = new MySQLi('travolla.hm', 'travolla', 'SeaBoat909', 'travolla_main');
$guide_id = "6";
$strsql = "select tourist_id from guides where guide_id = $guide_id";
$query = $mysqli->query($strsql);
//if (isset($_POST['refuse'])) {
//    echo '<script> var con ; con= confirm(\"Are you sure you will refuse the tourist\");
//         if(con==true){
//
//         }
//
//
//</script>';
   // $delete_sql = "delete  from Guides where tourist_id= $tourist_id and guide_id=$guide_id";
//}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Guide</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          crossorigin="anonymous">
    <link rel="shortcut icon" href="css/images/weblogo.png"/>
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/signup.css">
    <link href="https://fonts.googleapis.com/css?family=Patua+One" rel="stylesheet">
    <script src="js/scroll.js"></script>
    <link rel="stylesheet" href="css/guide.css">
    <link rel="stylesheet" href="css/swipebox.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/css/time-axis.css">
    <script src="css/css/jquery-1.7.2.min.js"></script>
    <link rel="stylesheet" href="css/css/base.css">
    <script src="js/guide.js"></script>
</head>
<body onload="displayWindowSize()" onresize="displayWindowSize()">

<nav class="navbar navbar-expand-md fixed-top bg-dark">
    <a class="navbar-brand" href="index.php"><img src="css/images/teamlogo.png"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
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
                <a class="nav-link" href="heatmap.html"> Heat Map </a>
            </li>
        </ul>
    </div>
    <div class="collapse navbar-collapse ">
        <a href="setting.html" name="guide_name">Guide name</a>
        <div class="portraitshead">
            <img src="css/images/tel.svg" alt="">
        </div>
    </div>
</nav>
<div class="news row" id="news">
    <div class="container">
        <h3 style="color: orange;font-size: 30px;">TOURIST ORDER</h3>
        <?php
        $result_set = array();
        while ($row = $query->fetch_assoc()) {
            $result_set[] = $row["tourist_id"];
        }
        if (sizeof($result_set) > 0) {

            foreach ($result_set as $id) {
                //from users table
                $user_from_users_sql = "select * from users  where  user_id=$id";
                $res_users = $mysqli->query($user_from_users_sql);
                $row_user_from_users = mysqli_fetch_array($res_users);
                //from perferences table
                $user_from_pref_sql = "SELECT Shopping,Sports,Hiking,Food,Museums,Natural_Sights,Animal,Local_Events from preferences where users_ident=$id";
                $res_pref = $mysqli->query($user_from_users_sql);
                $row_user_from_perfe = $res_pref->fetch_assoc();
                //from guide table to get  date
                $user_from_guide_sql = "select start_time, stop_time from guides where tourist_id= '$id'";
                $res_guide = $mysqli->query($user_from_guide_sql);
                $row_user_from_guide = mysqli_fetch_array($res_guide);
                ?>
                <form  method="post">
                    <div class="row">
                        <div class="col-md-5 col-sm-6 newsl">
                            <h6 style="color:#000;">Trip Length: </h6><a class="date" style="color:#000;"
                                                                         name="t_date"> <?php echo $row_user_from_guide[start_time]; ?>
                                ----<?php
                                echo $row_user_from_guide[stop_time];
                                ?> </a>
                            <div class="newsrt">
                                <h5 style="display: inline;color:#000;">Client's Name :<h5
                                            style="size: 20px;display: inline;color: black"
                                            name="tourist_name"><?php echo $row_user_from_users[name]; ?></h5>
                                </h5>
                                <div class="row">
                                    <div class="col-md-3 col-sm-3 newsrtl">
                                        <img class="img" src="css/images/sbgb.jpg">
                                    </div>
                                    <div class="col-md-8  col-sm-8 newsrtr ">
                                        <p style="color: black">gender: <i
                                                    style="color: black"><?php echo $row_user_from_users[gender]; ?></i>
                                        </p>
                                        <p style="color: black">Age: <i
                                                    style="color: black"><?php echo $row_user_from_users[gender]; ?></i>
                                        </p>
                                        <p style="color: black">Country:
                                            <i style="color:#000;"><?php $countrt_sql = "select city_name from cities where city_id=$row_user_from_users[home_city_id]";
                                                $result = $mysqli->query($countrt_sql);
                                                $result_arr = mysqli_fetch_array($result);
                                                echo $result_arr[city_name];
                                                ?></i></p>
                                        <p style="color:#000;">Primary Language: <i style="color:#000;"><?php
                                                echo $row_user_from_users[pri_lang];
                                                ?></i></p>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <h4 style="color: black">LABEL</h4>
                            <ul>
                                <?php
                                $preference_array = ["Shopping", "Sports", "Hiking", "Food", "Museums", "Natural Sights", "Achitectural", "Animal", "Local Events"];
                                $i = 0;
                                foreach ($row_user_from_perfe as $value) {
//                                    if ( $row_user_from_perfe[$i]!=0) {
                                        ?>
                                        <li><a href="#"
                                               class="hvr-rectangle-in"> <?php echo $preference_array[$i]; ?>  </a>
                                        </li>
                                        <?php

                                    $i++;

                                }
                                ?>

                                <!--                            <li><a href="#" class="hvr-rectangle-in">Sports</a></li>-->
                                <!--                            <li><a href="#" class="hvr-rectangle-in">Scenic</a></li>-->
                                <!--                            <li><a href="#" class="hvr-rectangle-in">Resort</a></li>-->
                                <!--                            <li><a href="#" class="hvr-rectangle-in">Shore leave </a></li>-->
                                <!--                            <li><a href="#" class="hvr-rectangle-in">Trip</a></li>-->
                            </ul>
                            <div class="clearfix"></div>
                            <div class="newsrt">
                                <h4 style="color: black">YOUR CHOICE</h4>
                                <input class="btn  btn-primary" id="accept" onclick="accept()" name="accept"
                                       type="submit" value="Accept"/>
                                <input class="btn  btn-default" id="refuse" onclick="refuse()" name="refuse"
                                       type="button" value="Refuse"/>
                            </div>

                        </div>
                        <div class="col-md-7 col-sm-6 newsr">
                            <h5 style="color: black">Scheduling Program</h5>
                            <div class="newsrt">
                                <div id="timeline">
                                    <div class="timeline-item">
                                        <div class="timeline-icon">
                                            <img src="css/images/star.svg" alt="">
                                        </div>
                                        <div class="timeline-content">
                                            <h2 style="font-size: 20px">2018-8-20</h2>
                                            <p style="color: black">DNUI</p>
                                            <p style="color: black">DNUI</p>
                                            <p style="color: black">DNUI</p>
                                            <p style="color: black">DNUI</p>


                                        </div>
                                    </div>

                                    <div class="timeline-item">
                                        <div class="timeline-icon">
                                            <img src="css/images/book.svg" alt="">
                                        </div>
                                        <div class="timeline-content right">
                                            <h2 style="font-size: 20px">2018-8-20</h2>
                                            <p style="color: black">DNUI</p>
                                            <p style="color: black">DNUI</p>
                                            <p style="color: black">DNUI</p>
                                            <p style="color: black">DNUI</p>
                                        </div>
                                    </div>

                                </div>
                                <!--<img class="img" src="css/images/news.jpg">-->
                                <div class="clearfix"></div>

                            </div>

                        </div>
                    </div>
                </form>

                <?php
            }
        } else {
            ?>
            <p style="text-align: center;font-size: 30px">Sorry,No tourist reservations are available at the
                moment. </p>
            <?php
        }
        ?>


    </div>
    <div class="clearfix"></div>
</div>


<!--footer-->
<footer class="container-fluid text-center">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 socialm">
            <h3>Social Media</h3>

            <br>

            <a href="http://www.facebook.com"><img src="css/images/facebook.svg" alt="fb"></a>
            <a href="http://www.twitter.com"><img src="css/images/twitter.svg" alt="twitter"></a>
            <a href="http://www.instagram.com"><img src="css/images/instagram.svg" alt="instagram"></a><br>
            <!--<img id="team" src="css\images\teamlogo.png" alt = "teamlogo">-->
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 ">
            <h3>Contact Us</h3>
            <br>
            <div id="contactus">
                <ul>
                    <li>
                        <img src="css/images/tel.svg" alt="tel">
                        <a href="tel:+61123456789">
                            +(61) 123 456 789 </a>
                    </li>
                    <li>
                        <img src="css/images/email.svg" alt="email">
                        <a href="mailto:someone@example.com?Subject=Hello%20again" target="_top">
                            travolla@innstation.com </a>
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
                        <img src="css/images/adress.svg" alt="address"> The University Of Queensland
                    </li>
                    <li> St Lucia, Brisbane, QLD 4067, Australia</li>
                    <li>
                        <img src="css/images/adress.svg" alt="address"> The Dalian Neusoft University of Information
                    </li>
                    <li> Dalian, Liyaoning, China</li>
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
        $('.container-fluid').css('margin-top', "0%");
    };

</script>
</body>
</html>