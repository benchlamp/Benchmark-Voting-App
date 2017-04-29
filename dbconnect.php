<?php

//dbconnect



$servername = "10.16.16.1";

$username = "bench-hu1-u-109501";

$password = "nDfMr^hnK";




// Create connection

$conn = mysqli_connect($servername, $username, $password);


$db_found = mysqli_select_db($conn, $username);



//if ($conn) { echo "connection successful!";}

//if ($db_found) { echo "database connection successful!"; }




if (!$conn) {
   
   die("Connection failed : " . mysqli_error());

}






if (!$db_found) {
   
   die("Database connection failed : " . mysqli_error());

}

?>