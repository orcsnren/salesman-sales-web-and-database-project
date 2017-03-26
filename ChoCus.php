<!DOCTYPE html>
<html lang="en">
<head>
  <title>Choose Salesman</title>
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
 
</head>
<body>
<!-- Progress bar holder -->
<div id="progress" style="width:500px;border:1px solid #ccc;"></div>
<!-- Progress information -->
<div id="information" style="width"></div>
<style>

.button {
  display: inline-block;
  padding: 15px 25px;
  font-size: 24px;
  cursor: pointer;
  text-align: center;
  text-decoration: none;
  outline: none;
  color: #fff;
  background-color: #4CAF50;
  border: none;
  border-radius: 15px;
  box-shadow: 0 9px #999;
}

.button:hover {background-color: #3e8e41}

.button:active {
  background-color: #3e8e41;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}
</style>
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


?>
<center>
<h2>Customer Details</h2><br>
     
     <center>
	 <strong> Select a Customer : </strong>

	<form name="frmdropdown" method="post" action="Cho2customer.php">
  <select name="Customers">  
     <?php
         $dd_res=mysql_query("SELECT CUSTOMER.customer_id,CONCAT(CUSTOMER.Name,' ',CUSTOMER.Surname) FROM CUSTOMER LEFT JOIN SALE ON CUSTOMER.customer_id=SALE.customer_id LEFT JOIN SALESMAN ON SALE.salesman_id=SALESMAN.salesman_id LEFT JOIN MARKET ON SALESMAN.market_id=MARKET.market_id WHERE MARKET.market_id='".$des."' GROUP BY Customer.customer_id");
		
		
         while($r=mysql_fetch_row($dd_res))
         { 
			
               echo "<option value='$r[0]'> $r[1] </option>";
         }
     ?>
	 </select>
	 
     <br><br>
	   

	  <form action="Cho2customer.php" method="post"><br/>
<button class="button">Show Sale Details</button><br>
</form>
<br>
</form>
</center>
</body>
</html>

  
