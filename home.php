<?php
 ob_start();
 session_start();
 require_once 'dbconnect.php';

 // select loggedin users detail
 $res=mysqli_query($conn, "SELECT * FROM users WHERE userId=".$_SESSION['user']);
 $userRow=mysqli_fetch_array($res);

if (!$userRow) {
  $_SESSION["userName"] = "Guest";
} 



// Create connection
$conn = mysqli_connect($servername, $username, $password);

$db_found = mysqli_select_db($conn, $username);



$SQL = "SELECT * FROM surveys";
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
  <title>Home</title>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="style.css">
<style>

#create-form {
  display: none;
  padding-bottom: 40px;
}

#create-button {
  margin: 5px 0 15px 0;
}

</style>

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
     
 

        <h2>Surveys</h2>

<form action='display.php' method='post'>
<ul class="list-group">
<?php

foreach ($surveys as $outer) {

    echo "<li class='list-group-item'> 
  <button class='btn btn-default btn-block survey-link' type='submit' name='survey' value='" . $outer["ID"] . "'>" . $outer["Question"] . "</button>
  </li>";
 
} 


?>
</ul>
</form>



        




<div id="create-form">
    <form method="post" name="create-form" action="dbcreate.php" autocomplete="off"> <!-- PHP add form functionality here -->
    <hr style="clear: both"/>
        <div class="form-group" id="survey-title">
          <div class="input-group">
            <span class="input-group-addon"><span class="glyphicon glyphicon-tag"></span></span>
            <input type="text" name="survey-title" class="form-control" value="Enter a name for your survey" onClick="this.select()" maxlength="40" />
          </div> <!-- /input-group -->
        </div> <!-- /form-group -->

<div class="form-group" id="survey-title">
          <div class="input-group">
            <span class="input-group-addon"><span class="glyphicon glyphicon-question-sign"></span></span>
            <input type="text" name="opt-1" class="form-control" value="Enter the first voting option" onClick="this.select()" maxlength="40" />
          </div> <!-- /input-group -->
        </div> <!-- /form-group -->


<div class="form-group" id="survey-title">
          <div class="input-group">
            <span class="input-group-addon"><span class="glyphicon glyphicon-question-sign"></span></span>
            <input type="text" name="opt-2" class="form-control" value="Enter the second voting option" onClick="this.select()" maxlength="40" />
          </div> <!-- /input-group -->
        </div> <!-- /form-group -->

 
<div class="form-group" id="survey-title">
          <div class="input-group">
            <span class="input-group-addon"><span class="glyphicon glyphicon-question-sign"></span></span>
            <input type="text" name="opt-3" class="form-control" value="Enter the third voting option" onClick="this.select()" maxlength="40" />
          </div> <!-- /input-group -->
        </div> <!-- /form-group -->        
        
   
<input type="submit" class="btn btn-success pull-right" id="submit" value="Submit">
   
           
           
       
    </form>
  </div> <!-- /login-form -->



  <div class="btn btn-primary pull-right" id="create-button">
  Create New Survey
  </div>

<hr style="clear: both"/>
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





			var optCounter = 3;
      var buttonState = false;

      $("#create-button").click(function() {
        if (buttonState) {
          $("#create-form").slideUp();
          buttonState = !buttonState;
        } else {
          $("#create-form").slideDown();
          buttonState = !buttonState;  }
      })
      
      
  
})


</script>
  </body>
</html>
<?php ob_end_flush(); ?>












