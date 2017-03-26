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
$des=$_POST["Salesman"]; 
$result=mysql_query("SELECT SALESMAN.Name,SALESMAN.Surname FROM PRODUCT LEFT JOIN SALE ON PRODUCT.product_id=SALE.product_id LEFT JOIN SALESMAN ON SALE.salesman_id=SALESMAN.salesman_id LEFT JOIN MARKET ON SALESMAN.market_id=MARKET.market_id WHERE SALESMAN.salesman_id='".$des."'  ");
         
  if($result === FALSE) { 
    die(mysql_error()); // TODO: better error handling
}
while($row = mysql_fetch_array($result))
{	?>
<h2><?php echo $row[0]." ".$row[1]?></h2><br>
<?php
break;

 
}


$result=mysql_query("SELECT SALE.sale_id,PRODUCT.product_id,PRODUCT.ProductName,SALE.customer_id,PRODUCT.PRICE,CUSTOMER.Name,CUSTOMER.Surname,MARKET.market_id,MARKET.MarketName FROM PRODUCT LEFT JOIN SALE ON PRODUCT.product_id=SALE.product_id LEFT JOIN SALESMAN ON SALE.salesman_id=SALESMAN.salesman_id LEFT JOIN MARKET ON SALESMAN.market_id=MARKET.market_id LEFT JOIN CUSTOMER ON PRODUCT.product_id=CUSTOMER.customer_id
 WHERE SALESMAN.salesman_id='".$des."'  ");
         
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
<th> CUSTOMER ID </th>
<th> PRICE </th>
<th> Customer Name </th>
<th> Customer Surname </th>
<th> Market ID </th>
<th> Market Name </th>
</tr>";

while($row = mysql_fetch_array($result))
{	echo "<tr>";
echo "<td>" . $row[0] . "</td>";
echo "<td>" . $row[1] . "</td>";
echo "<td>" . $row[2] . "</td>";
echo "<td>" . $row[3] . "</td>";
echo "<td>" . $row[4] ." TL"."</td>";
echo "<td>" . $row[5]. "</td>";
echo "<td>" . $row[6]. "</td>";
echo "<td>" . $row[7]. "</td>";
echo "<td>" . $row[8]. "</td>";
echo "</tr>";
   
}

?>
<center>