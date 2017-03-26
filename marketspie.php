<html>
 <center>
  <head>
  
  <?php
 
 $databaseHost = "localhost"; 
 $databaseUser = "root";
 $databasePassword = "mysql";
 $databaseName = "orcunsoner_eren";
        
      $con=mysql_connect($databaseHost ,$databaseUser ,$databasePassword )or die ('Connection Error');
      mysql_select_db("orcunsoner_eren",$con) or die ('Database Error');
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$result=mysql_query("SELECT MARKET.MarketName,COUNT(PRODUCT.product_id) FROM PRODUCT LEFT JOIN SALE ON PRODUCT.product_id=SALE.product_id LEFT JOIN SALESMAN ON SALE.salesman_id=SALESMAN.salesman_id LEFT JOIN MARKET ON SALESMAN.market_id=MARKET.market_id GROUP BY MARKET.MarketName;");
         
  if($result === FALSE) { 
    die(mysql_error()); // TODO: better error handling
}
$markets=array();
$counter=array();
while($row = mysql_fetch_array($result))
{	
             array_push($markets,$row[0]);
	           array_push($counter,$row[1]);
    //echo $row[0]." ".$row[1]."<br>";
}

?>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Market', 'Products'],
          ['<?php echo $markets[0] ?>',<?php echo $counter[0] ?>],
          ['<?php echo $markets[1] ?>',<?php echo $counter[1] ?>],
		  ['<?php echo $markets[2] ?>',<?php echo $counter[2] ?>],
		  ['<?php echo $markets[3] ?>',<?php echo $counter[3] ?>],
		  ['<?php echo $markets[4] ?>',<?php echo $counter[4] ?>],
		  ['<?php echo $markets[5] ?>',<?php echo $counter[5] ?>],
		  ['<?php echo $markets[6] ?>',<?php echo $counter[6] ?>],
		  ['<?php echo $markets[7] ?>',<?php echo $counter[7] ?>],
		  ['<?php echo $markets[8] ?>',<?php echo $counter[8] ?>],
		  ['<?php echo $markets[9] ?>',<?php echo $counter[9] ?>]
		 
        ]);

        var options = {
          title: 'Sale Distribution for Markets',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="piechart_3d" style="width: 1100px; height: 700px;"></div>
    </center>
  </body>
</html>