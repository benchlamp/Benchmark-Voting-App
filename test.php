<?php


require_once 'dbconnect.php';


// Create connection
$conn = mysqli_connect($servername, $username, $password);

$db_found = mysqli_select_db($conn, $username);



$SQL = "SELECT * FROM surveys WHERE ID=1";
$result = mysqli_query($conn, $SQL);



$surveys= array(); // create a new array


while ( $db_field = mysqli_fetch_assoc($result) ) {

  array_push($surveys, $db_field);

}

foreach($surveys as $outer) {
  echo $outer["Question"];
  echo "<br />";
}



?>