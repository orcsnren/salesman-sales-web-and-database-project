<!DOCTYPE html>
<html>
<head>
<?php
$des="Adana";
 $databaseHost = "localhost"; 
 $databaseUser = "root";
 $databasePassword = "mysql";
 $databaseName = "orcunsoner_eren";
        
      $con=mysql_connect($databaseHost ,$databaseUser ,$databasePassword )or die ('Connection Error');
      mysql_select_db("orcunsoner_eren",$con) or die ('Database Error');
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
<h2>SELECT A CITY!</h2><br>
     
     
	 <form name="frmdropdown" method="post" action="MarketSalesInformation.php">
  <select name="Cities">  
     <?php
         $dd_res=mysql_query("SELECT CityName FROM City GROUP BY CityName");
		
		
         while($r=mysql_fetch_row($dd_res))
         { 
			
               echo "<option value='$r[0]'> $r[0] </option>";
         }
     ?>
	 </select>
	 
     <br><br>
	   

<form action="MarketSalesInformation.php" method="post"><br/>
 <button class="button">SELECT</button><br>
 </form>

</form>
	 
	 
	 
	 
	 
	 
	 </center>
</body>
</html>