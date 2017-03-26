<!DOCTYPE html>
<html lang="en">
<head>
  <title>Product</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html lang="en">
<head>
    <title>Progress Bar</title>
</head>
<body>
<!-- Progress bar holder -->
<div id="progress" style="width:500px;border:1px solid #ccc;"></div>
<!-- Progress information -->
<div id="information" style="width"></div>

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
$des=$_POST["Markets"]; 
$result=mysql_query("SELECT PRODUCT.ProductName,COUNT(PRODUCT.product_id) FROM PRODUCT LEFT JOIN SALE ON PRODUCT.product_id=SALE.product_id LEFT JOIN SALESMAN ON SALE.salesman_id=SALESMAN.salesman_id LEFT JOIN MARKET ON SALESMAN.market_id=MARKET.market_id WHERE MARKET.market_id='".$des."' GROUP BY PRODUCT.product_id  ORDER BY COUNT(PRODUCT.product_id) DESC");
         
  if($result === FALSE) { 
    die(mysql_error()); // TODO: better error handling
}
$products=array();
$counter=array();
while($row = mysql_fetch_array($result))
{	
             array_push($products,$row[0]);
	           array_push($counter,$row[1]);
    //echo $row[0]." ".$row[1]."<br>";
}
$percent=array();
$percent[0]=100;
if(!is_null($des)){
for($i=1;$i<count($products);$i++){
	$percent[$i]=$counter[$i]*100/$counter[0];
	//echo $percent[$i];
}
}
$i=0;
?>

<div class="container">
<center>
  <h2> Sales Informations </h2>
  <br><br>
  <?php for($i=0;$i<count($products);$i++){?>
  <div class="progress">
    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php $i?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $percent[$i]?>%">
      <?php echo $products[$i]." (".$counter[$i]." Times".")" ?>
    </div>
  </div>
  <?php } ?>
</center>
</body>
</html>

  
