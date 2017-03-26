<!DOCTYPE html>
<html lang="en">
<head>
  <title>A</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>

<?php
$des="Adana";
 $databaseHost = "localhost"; 
 $databaseUser = "root";
 $databasePassword = "mysql";
 $databaseName = "orcunsoner_eren";
        
      $con=mysql_connect($databaseHost ,$databaseUser ,$databasePassword )or die ('Connection Error');
      mysql_select_db("orcunsoner_eren",$con) or die ('Database Error');
	 ?> 


<html>
 <body>
     <form name="frmdropdown" method="post" action="ShowCitySalesInformation.php">
     <center>
            <h2 align="center">Sales Information of the Markets</h2>
<br>
	<form name="frmdropdown" method="post" action="ShowCitySalesInformation.php">
         <strong> Select a City : </strong> 
  <select name="Cities">  
     <?php
         $dd_res=mysql_query("SELECT CityName FROM CITY ");
		
		 echo "<option value </option>";
         while($r=mysql_fetch_row($dd_res))
         { 
			echo $r[0];
               echo "<option value='$r[0]'> $r[0] </option>";
         }
     ?>
	 </select>
     <input type="submit" name="GET" value="GET"/> 
     <br><br>
  
   
 <?php

  if($_SERVER['REQUEST_METHOD'] == "POST")
   $i=0;
  $co++;
  $markets=array();
  $counter=array();

  {
	  $des=$_POST["Cities"]; 
       

		
        $res=mysql_query("SELECT MarketName,COUNT(sale_id) FROM SALE LEFT JOIN SALESMAN ON SALE.salesman_id=SALESMAN.salesman_id LEFT JOIN MARKET ON SALESMAN.market_id=MARKET.market_id WHERE SALESMAN.market_id= ANY(SELECT market_id FROM MARKET WHERE CITY='".$des."') GROUP BY SALESMAN.market_id ORDER BY COUNT(sale_id) DESC");
         
  
    
         
         while($r=mysql_fetch_row($res))
         {     array_push($markets,$r[0]);
	           array_push($counter,$r[1]);
                 //echo $r[0]." ".$r[1]."<br>";
				
               $i++;
		 
        }
    }
$percent=array();
$percent[0]=100;
if(!is_null($des)){
for($i=1;$i<5;$i++){
	$percent[$i]=$counter[$i]*100/$counter[0];
	//echo $percent[$i];
}
}
?>
<?php if(!is_null($des)){?>
<div class="container">
  <h2><?php echo $des ?></h2>
  <br><br>
  <div class="progress">
    <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $percent[0]?>%">
      <?php echo $markets[0]."(".$counter[0]." Products".")" ?>
    </div>
  </div>
  <div class="progress">
    <div class="progress-bar progress-bar-info progress-bar-striped" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $percent[1]?>%">
     <?php echo $markets[1]."(".$counter[1]." Products".")" ?>
    </div>
  </div>
  <div class="progress">
    <div class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $percent[2]?>%">
       <?php echo $markets[2]."(".$counter[2]." Products".")" ?>
    </div>
  </div>
  <div class="progress">
    <div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $percent[3]?>%">
       <?php echo $markets[3]."(".$counter[3]." Products".")" ?>
    </div>
  </div>
  <div class="progress">
    <div class="progress-bar market5 progress-bar-striped" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $percent[4]?>%">
       <?php echo $markets[4]."(".$counter[4]." Products".")" ?>
    </div>
  </div>
</div>


<br><br>
<?php } ?>



  </table>
 </center>
</form>
</body>
</html>

  