<?php
 ob_start();
 session_start();
 require_once 'dbconnect.php';

$servername = "10.16.16.1";
$username = "bench-hu1-u-109501";
$password = "nDfMr^hnK";

 // select loggedin users detail
 $res=mysqli_query($conn, "SELECT * FROM users WHERE userId=".$_SESSION['user']);
 $userRow=mysqli_fetch_array($res);

if (!$userRow) {
  $_SESSION["userName"] = "Guest";
} 



// Create connection
$conn = mysqli_connect($servername, $username, $password);

$db_found = mysqli_select_db($conn, $username);



$SQL = "SELECT * FROM survey_index";
$result = mysqli_query($conn, $SQL);

$surveys = array(); // create a new array


while ( $db_field = mysqli_fetch_assoc($result) ) {

  array_push($surveys, $db_field);

}



?>


<!DOCTYPE html>
<meta name="robots" content="noindex">
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>Template Page</title>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="style.css">
  </head>
<body>
  <script src="https://code.jquery.com/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<div class="container">
  <div class="jumbotron">
    <h1>Benchmark</h1>
      <hr />
    <h4>Investigate. Participate.</h4>
  </div> <!-- /jumbotron -->
    <h5 class="login-details">logged in as <?php echo $_SESSION["userName"]; ?></h5> 
<hr />  
<!--content in here -->
     
 

        <h3>Surveys</h3>

<form action='display.php' method='post'>
<ul class="list-group">
<?php

foreach ($surveys as $outer) {

  foreach($outer as $key => $value) {

  if ($key == "survey_name") { 
  $value = ucwords(str_replace("_", " ", $value));
  echo "

<li class='list-group-item'> 
<input class='btn btn-default btn-block survey-link' type='submit' name='survey' value='" . $value . "'>
</li>

                                     "
                                      ;}


  }
} 


?>
</ul>
</form>



        
<?php if ($_SESSION["userName"] == "Guest") {

echo "<p>Please sign in to create new surveys</p>";
echo '<a href="index.php"><span class="glyphicon glyphicon-log-in"></span>&nbsp;Sign In</a>';

} else {
echo '<a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out</a>';

}
?>
  
  </div> <!-- /container -->

<script>

$(document).ready(function() {

  $(".survey-link").click(function(event) {
    console.log(event.target.id);
  })

function surveyTitle(str) {
  str = str.replace(/_/gi, " ");
  var arr = str.split(" "),
  result = [],
  firstLetter,
  remainder;
  
  for (var i = 0; i < arr.length - 1; i++) {
    
    firstLetter = arr[i][0].toUpperCase();
    remainder = arr[i].slice(1);
    result.push(firstLetter + remainder)
   
  }
  
  result = result.join(" ");
  
  
  return result;
}



})


</script>
  </body>
</html>
<?php ob_end_flush(); ?>












