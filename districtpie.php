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


$result=mysql_query("SELECT DISTRICT.DistrictName,COUNT(SALE.sale_id) FROM PRODUCT LEFT JOIN SALE ON PRODUCT.product_id=SALE.product_id LEFT JOIN SALESMAN ON SALE.salesman_id=SALESMAN.salesman_id LEFT JOIN MARKET ON SALESMAN.market_id=MARKET.market_id LEFT JOIN CITY ON MARKET.City=CITY.CityName LEFT JOIN DISTRICT ON CITY.distr_id=DISTRICT.distr_id GROUP BY DISTRICT.DistrictName");
         
  if($result === FALSE) { 
    die(mysql_error()); // TODO: better error handling
}
$distr=array();
$counter=array();
while($row = mysql_fetch_array($result))
{	
             array_push($distr,$row[0]);
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
          ['District', 'Products'],
          ['<?php echo $distr[0] ?>',<?php echo $counter[0] ?>],
          ['<?php echo $distr[1] ?>',<?php echo $counter[1] ?>],
		  ['<?php echo $distr[2] ?>',<?php echo $counter[2] ?>],
		  ['<?php echo $distr[3] ?>',<?php echo $counter[3] ?>],
		  ['<?php echo $distr[4] ?>',<?php echo $counter[4] ?>],
		  ['<?php echo $distr[5] ?>',<?php echo $counter[5] ?>],
		  ['<?php echo $distr[6] ?>',<?php echo $counter[6] ?>]
		 
        ]);

        var options = {
          title: 'Sale Distribution for Districts',
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