<?php
$servername = "travolla.hm";
$username = "travolla";
$passworddb = "SeaBoat909";
$dbname = "travolla_main";
$table = "users";

$cityid =  $_REQUEST['cityId'];

$activitylist = array();

$mysqli = mysqli_connect($servername, $username, $passworddb, $dbname);
// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$activityquery = $mysqli->query("SELECT name, home_city_id FROM $table WHERE user_mode LIKE 'guide' AND home_city_id LIKE $cityid");

while($row = $activityquery->fetch_assoc()){
    $activitylist[] = $row;
}

$jsonexport = array("GUIDES"=> $activitylist);

echo json_encode($jsonexport);

mysqli_close($mysqli);
?>
