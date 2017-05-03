<?php

include_once 'dbconnect.php';

echo "dbcreate called <br />";

echo "$_POST length = " . count($_POST) . "<br />";

foreach($_POST as $key => $val) {
  echo $key . " = " . $val . "</br />";
}



// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
 // Check connection
 if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
} 



$tablename = "subsurv_" . $_POST["survey-title"];


$sql = "CREATE TABLE "$tablename" (
id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
first_name VARCHAR(30) NOT NULL,
email VARCHAR(70) NOT NULL UNIQUE
)";

if ($conn->query($sql) === TRUE) {
    echo "Table MyGuests created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();

?>