
<!DOCTYPE html>
<html>
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
$des=$_POST["Markets"]; 
?>

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
</head>
<body>
<center>

<h2><?php echo $_POST['Cities'] ?></h2><br>
     
     <center>
	 <strong> Select a Market : </strong>
		<br><br>

	<form name="frmdropdown" method="post" action="Product.php">
  <select name="Markets">  
     <?php
		 $city=$_POST['Cities'];
		
         $dd_res=mysql_query("SELECT market_id,MarketName FROM MARKET WHERE City='".$city."' GROUP BY MarketName ");
		
		
         while($r=mysql_fetch_row($dd_res))
         { 
			
               echo "<option value='$r[0]'> $r[1] </option>";
         }
     ?>
	 </select>
	 
     <br><br>
	   

	  <form action="Product.php" method="post"><br/>
<button class="button">Product</button><br>
</form>
<br>
</form>
	<form name="frmdropdown" method="post" action="Salesman.php">
  <select name="Markets">  
      <?php
		 $city=$_POST['Cities'];
		
         $dd_res=mysql_query("SELECT market_id,MarketName FROM MARKET WHERE City='".$city."' GROUP BY MarketName ");
		
		
         while($r=mysql_fetch_row($dd_res))
         { 
			
               echo "<option value='$r[0]'> $r[1] </option>";
         }
     ?>
	 </select>
	 
     <br><br>
	   

<form action="Salesman.php" method="post"><br/>
 <button class="button">Salesman</button><br>
 </form>

</form>
<br>
	<form name="frmdropdown" method="post" action="ChoSalesman.php">
  <select name="Markets">  
      <?php
		 $city=$_POST['Cities'];
		
         $dd_res=mysql_query("SELECT market_id,MarketName FROM MARKET WHERE City='".$city."' GROUP BY MarketName ");
		
		
         while($r=mysql_fetch_row($dd_res))
         { 
			
               echo "<option value='$r[0]'> $r[1] </option>";
         }
     ?>
	 </select>
	 
     <br><br>
	   

<form action="ChoSalesman.php" method="post"><br/>
 <button class="button">Choose Salesman</button><br>
 </form>

</form>
<br>
<form name="frmdropdown" method="post" action="ChoCus.php">
  <select name="Markets">  
     <?php
		 $city=$_POST['Cities'];
		
         $dd_res=mysql_query("SELECT market_id,MarketName FROM MARKET WHERE City='".$city."' GROUP BY MarketName ");
		
		
         while($r=mysql_fetch_row($dd_res))
         { 
			
               echo "<option value='$r[0]'> $r[1] </option>";
         }
     ?>
	 </select>
	 
     <br><br>
	   

<form action="ChoCus.php" method="post"><br/>
 <button class="button">Invoice Customer</button><br>
 </form>

</form>
 
 
</center>
</body>
</html>