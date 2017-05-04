<?php

include_once 'dbconnect.php';

echo "dbcreate called <br />";

echo "$_POST length = " . count($_POST) . "<br />";

foreach($_POST as $key => $val) {
  echo $key . " = " . $val . "</br />";
}


// Create connection
$conn = mysqli_connect($servername, $username, $password, $username);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


$Question = $_POST["survey-title"];
$Opt1 = $_POST["opt-1"];
$Opt2 = $_POST["opt-2"];
$Opt3 = $_POST["opt-3"];



$sql = "INSERT INTO surveys (Question, OptionA, OptionB, OptionC)
VALUES ('$Question', '$Opt1', '$Opt2', '$Opt3')";



if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);



?>