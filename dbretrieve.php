<?php


$servername = "10.16.16.1";
$username = "bench-hu1-u-109501";
$password = "nDfMr^hnK";

$survey = "subsurv_" . $_GET["survey"];

// Create connection
$conn = mysqli_connect($servername, $username, $password);

$db_found = mysqli_select_db($conn, $username);



$SQL = "SELECT * FROM " . $survey;
$result = mysqli_query($conn, $SQL);


$json_data= array(); // create a new array


while ( $db_field = mysqli_fetch_assoc($result) ) {

  array_push($json_data, $db_field);

}

$json_data = json_encode($json_data);
 
echo $json_data;

?>