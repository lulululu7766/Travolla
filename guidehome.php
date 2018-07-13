<?php
include('session.php');
require('encryption1.php');

$mysqli = new MySQLi('travolla.hm', 'travolla', 'SeaBoat909', 'travolla_main');
$guide_id = "6";
$strsql = "select tourist_id from guides where guide_id = $guide_id";
$query = $mysqli->query($strsql);
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
    <link href="https://fonts.googleapis.com/css?family=Patua+One" rel="stylesheet">
    <script src="js/scroll.js"></script>
    <link rel="stylesheet" href="css/guide.css">
    <script src="js/guide.js"></script>
</head>
<body onload="displayWindowSize()" onresize="displayWindowSize()">
<?php include('header.php'); ?>
<div class="container-fluid" id="guideMain">
    <h1 id="toptitle"> Upcoming Trips </h1>
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
                <div class="container">
                    <div class="row">
                        <div class="col-sm">
                            <div class="card">
                                <div class="card-body" style="text-align: center">
                                    <img class="rounded-circle" src="<?php echo $row_user_from_users['image_path']; ?>" alt="Tourist" width="100" height="100" style="padding: 5px">
                                    <h5 class="card-title"><?php echo $row_user_from_users['name']; ?></h5>
                                    <p class="card-text"><b>Duration: </b><?php echo $row_user_from_guide['start_time']; ?> to <?php echo $row_user_from_guide['stop_time']; ?></p>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <b>Gender: </b><?php echo $row_user_from_users['gender']; ?>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Country: </b><?php $countrt_sql = "select city_name from cities where city_id=$row_user_from_users[home_city_id]";
                                        $result = $mysqli->query($countrt_sql);
                                        $result_arr = mysqli_fetch_array($result);
                                        echo $result_arr['city_name']; ?>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Primary Language: </b><?php echo $row_user_from_users['pri_lang']; ?>
                                    </li>
                                    <li class="list-group-item">
                                        <b><?php echo $row_user_from_users['name']; ?>'s Interests:</b>
                                        <div id="interestContainer" class="container">
                                            <?php
                                            $preference_array = ["Shopping", "Sports", "Hiking", "Food", "Museums", "Natural Sights", "Achitectural", "Animal", "Local Events"];
                                            $i = 0;
                                            for ($i = 0; $i < count($preference_array); $i++) {
                                                echo "<button class='btn btn-primary'> $preference_array[$i] </button>";
                                            }
                                            $i = 0;
                                            ?>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <button onclick="accept()" class="btn btn-success">Accept</button>
                                        <button onclick="refuse()" class="btn btn-danger">Decline</button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div id="timeline">
                                <div class="timeline-item">
                                    <div class="timeline-icon"></div>
                                    <div class="timeline-content">
                                        <h2 style="font-size: 20px"><?php echo $row_user_from_guide['start_time']; ?></h2>
                                        <p>Location 1</p>
                                        <p>Location 2</p>
                                        <p>Location 3</p>
                                    </div>
                                </div>
                                <div class="timeline-item">
                                    <div class="timeline-icon"></div>
                                    <div class="timeline-content right">
                                        <h2 style="font-size: 20px"><?php echo $row_user_from_guide['stop_time']; ?></h2>
                                        <p>Location 1</p>
                                        <p>Location 2</p>
                                        <p>Location 3</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
            }
        } else {
            ?>
            <p style="text-align: center;font-size: 30px">Sorry, there are no tourist reservations available at the
                moment.</p>
            <?php
        }
        ?>
</div>


<!--footer-->
<?php include('footer.php'); ?>

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
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
</body>
</html>