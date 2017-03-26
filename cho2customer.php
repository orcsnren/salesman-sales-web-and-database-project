<!DOCTYPE html>
<html lang="en">
<head>
  <title>Salesman Details</title>
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
<center>
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
$des=$_POST["Customers"]; 
$result=mysql_query("SELECT CONCAT(CUSTOMER.Name,' ',CUSTOMER.Surname) FROM CUSTOMER LEFT JOIN SALE ON CUSTOMER.customer_id=SALE.customer_id LEFT JOIN SALESMAN ON SALE.salesman_id=SALESMAN.salesman_id LEFT JOIN MARKET ON SALESMAN.market_id=MARKET.market_id WHERE CUSTOMER.customer_id='".$des."'");
         
  if($result === FALSE) { 
    die(mysql_error()); // TODO: better error handling
}
while($row = mysql_fetch_array($result))
{	?>
<h2><?php echo $row[0]?></h2><br>
<?php
break;

 
}


$result=mysql_query("SELECT SALE.sale_id,PRODUCT.product_id,PRODUCT.ProductName,PRODUCT.PRICE,SALE.date FROM CUSTOMER LEFT JOIN SALE ON CUSTOMER.customer_id=SALE.customer_id LEFT JOIN PRODUCT ON PRODUCT.product_id=SALE.product_id LEFT JOIN SALESMAN ON SALE.salesman_id=SALESMAN.salesman_id LEFT JOIN MARKET ON SALESMAN.market_id=MARKET.market_id WHERE CUSTOMER.customer_id='".$des."'");
         
  if($result === FALSE) { 
    die(mysql_error()); // TODO: better error handling
}
$products=array();
$counter=array();
echo "<table border='1'>
<tr>
<th> SALE ID </th>
<th> PRODUCT ID </th>
<th> PRODUCT Name </th>
<th> PRICE </th>
<th> DATE </th>
</tr>";
$totalcost=0;
while($row = mysql_fetch_array($result))
{	echo "<tr>";
$totalcost=$totalcost+$row[3];
echo "<td>" . $row[0] . "</td>";
echo "<td>" . $row[1] . "</td>";
echo "<td>" . $row[2] . "</td>";
echo "<td>" . $row[3] . " TL"."</td>";
echo "<td>" . $row[4] . "</td>";
echo "</tr>";
   
}
?>
<br>
<h2>TOTAL COST:<?php echo $totalcost?> TL</h2><br>
<center>