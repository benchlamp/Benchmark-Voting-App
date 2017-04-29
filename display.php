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

$survey = strtolower(str_replace(" ", "_", $_POST["survey"]));



?>

<!DOCTYPE html>
<meta name="robots" content="noindex">
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
<meta http-equiv="X-UA-Compatible" content="IE=8;FF=3;OtherUA=4" />
  <title>Survey- <?php echo $_POST["survey"]; ?></title>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="style.css">
  </head>
<body>
  <script src="https://code.jquery.com/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
      <script type="text/javascript" src="http://mbostock.github.com/d3/d3.js?2.1.3"></script>
  <script type="text/javascript" src="http://mbostock.github.com/d3/d3.geom.js?2.1.3"></script>
  <script type="text/javascript" src="http://mbostock.github.com/d3/d3.layout.js?2.1.3"></script>
<div class="container">
  <div class="jumbotron">
    <h1>Benchmark</h1>
      <hr />
    <h4>Investigate. Participate.</h4>
  </div> <!-- /jumbotron -->
    <h5 class="login-details">logged in as <?php echo $_SESSION["userName"]; ?></h5> 
<hr />  
  <!--content in here -->

  <div class="chartContainer"></div>
  <div><ul id="response"></ul></div>
  
  </div> <!-- /container -->
  
    <script>    
var survey = "<?php echo $survey; ?>";
console.log("survey name = " + survey);
  
    $(document).ready(function() {
      $.ajax({
          type: "GET",
          url: "dbretrieve.php",
          data: {"survey": survey},
          success: function(data){
            console.log(data);
            //$("#response").append(data);
            data = JSON.parse(data);
            var results = {};  
            for (var i = 0; i < data.length; i++) {
              //results[data[i].Type] = data[i].Votes;
              $("#response").append("<li>" + data[i].Type + " = " + data[i].Votes + "</li>");
            } 
            
          }
      });     
    })
    
  </script>
  </body>
</html>


<?php ob_end_flush(); ?>





