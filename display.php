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

$survey = $_POST["survey"];


// Create connection
$conn = mysqli_connect($servername, $username, $password);

$db_found = mysqli_select_db($conn, $username);



$SQL = "SELECT * FROM surveys WHERE Question='$survey'";
$result = mysqli_query($conn, $SQL);

$surveys = array(); // create a new array


while ( $db_field = mysqli_fetch_assoc($result) ) {

  array_push($surveys, $db_field);

}

$json = json_encode($surveys);

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
<style>


.chart-container {
text-align: center;
}

</style>
  </head>
<body>
  <script src="https://code.jquery.com/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="http://d3js.org/d3.v3.min.js" charset="utf-8"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<div class="container">
  <div class="jumbotron">
    <h1>Benchmark</h1>
      <hr />
    <h4>Investigate. Participate.</h4>
  </div> <!-- /jumbotron -->
    <h5 class="login-details">logged in as <?php echo $_SESSION["userName"]; ?></h5> 

  <!--content in here -->

  <h3><?php echo $_POST["survey"]; ?></h3>



  <table class="table table-bordered table-responsive" id="response"></table>
  <div class="chart-container"></div>
  </div> <!-- /container -->
  
    <script>    
var survey = <?php echo $json; ?>;

//console.log("var survey = " + survey);

console.log(survey[0]);  


    $(document).ready(function() {

            
    var w = 300,                       
    h = 300,                          
    r = 150,                          
    color = d3.scale.category20c();     

var vis = d3.select(".chart-container")
        .append("svg:svg")             
        .data([data])                  
            .attr("width", w)           
            .attr("height", h)
        .append("svg:g")               
            .attr("transform", "translate(" + r + "," + r + ")")   

    var arc = d3.svg.arc()              
        .outerRadius(r);

    var pie = d3.layout.pie()          
        .value(function(d) { return d.Votes; });    

    var arcs = vis.selectAll("g.slice")     
        .data(pie)                          
        .enter()                           
            .append("svg:g")                
                .attr("class", "slice");   

        arcs.append("svg:path")
                .attr("fill", function(d, i) { return color(i); } )
                .attr("d", arc)
                                    

        arcs.append("svg:text")                                    
                .attr("transform", function(d) {                   
                
                d.innerRadius = 0;
                d.outerRadius = r;
                return "translate(" + arc.centroid(d) + ")";       
            })
            .attr("text-anchor", "middle")                         
            .text(function(d, i) { return data[i].Type; });      
      

          })
  
    
    
  </script>
  </body>
</html>


<?php ob_end_flush(); ?>





