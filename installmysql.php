
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Choose </title>
</head>


<?php 

 $servername="localhost";
 $username="root";
 $password="mysql";

 // Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql= "CREATE DATABASE orcunsoner_eren";
$conn->query($sql);
$sql= "USE orcunsoner_eren";
$conn->query($sql);
$sql= "CREATE TABLE DISTRICT(distr_id INT NOT NULL AUTO_INCREMENT,DistrictName VARCHAR(50) NOT NULL,PRIMARY KEY(distr_id)) ENGINE=INNODB";
$conn->query($sql);
$sql= "CREATE TABLE CITY(City_id INT NOT NULL AUTO_INCREMENT,CityName VARCHAR(50) NOT NULL,distr_id INT NOT NULL,PRIMARY KEY(City_id) ) ENGINE=INNODB";
$conn->query($sql);
$sql= "CREATE TABLE MARKET(market_id INT NOT NULL AUTO_INCREMENT,MarketName VARCHAR(50) NOT NULL,City VARCHAR(50) NOT NULL,PRIMARY KEY(Market_id)) ENGINE=INNODB";
$conn->query($sql);
$sql= "CREATE TABLE SALESMAN(salesman_id INT NOT NULL AUTO_INCREMENT,Name VARCHAR(50) NOT NULL,Surname VARCHAR(50) NOT NULL,
market_id INT NOT NULL,PRIMARY KEY(salesman_id)) ENGINE=INNODB;";
$conn->query($sql);
$sql= "CREATE TABLE CUSTOMER(customer_id INT NOT NULL AUTO_INCREMENT,Name VARCHAR(50) NOT NULL,Surname VARCHAR(50) NOT NULL,
PRIMARY KEY(customer_id)) ENGINE=INNODB;";
$conn->query($sql);
$sql= "CREATE TABLE PRODUCT(product_id INT NOT NULL AUTO_INCREMENT,ProductName VARCHAR(50) NOT NULL,PRICE INT NOT NULL,
PRIMARY KEY(product_id)) ENGINE=INNODB;";
$conn->query($sql);
$sql= "CREATE TABLE SALE(sale_id INT NOT NULL AUTO_INCREMENT,product_id INT NOT NULL,customer_id INT NOT NULL,salesman_id INT NOT NULL,date DATE,
PRIMARY KEY(sale_id)) ENGINE=INNODB;";
$conn->query($sql);
			
if (($handle = fopen("install.csv", "r")) !== false) {
    $filesize = filesize("install.csv");
    $firstRow = true;
    $aData = array();
    $cities = array();
    $districts = array();
    $markets = array();
    $randArray=array();
    $products= array();
    $markets = fgetcsv($handle, $filesize, ";");
    $y=1; 
    $productcounter=0;
 
    while (($data = fgetcsv($handle, $filesize, ";")) !== false) {

	 
            for($i = 0;$i < count($data); $i++) {
	
		
		if($y===3){
			if(!is_null($data[$i]) && !empty($data[$i]) ){
			$cities = explode(";",$data[$i]);
                     $sql= "INSERT INTO CITY(CityName,distr_id) VALUES ('$cities[0]','$cities[1]')";
       		     $conn->query($sql);
			  $randArray=array();
			  for($count=0;$count<5;$count++){
			    $rand=rand(0,9);
			    while(in_array($rand,$randArray)){
                              $rand=rand(0,9);
			    }
                             array_push($randArray,$rand);
			    $sql= "INSERT INTO MARKET(MarketName,City) VALUES ('$markets[$rand]','$cities[0]')";
       		            $conn->query($sql);

			  }
			}
		}else if($y===2){
			if(!is_null($data[$i]) && !empty($data[$i]) ){
		   $sql= "INSERT INTO DISTRICT(DistrictName) VALUES ('$data[$i]')";
       		   $conn->query($sql);
			}
		}else if($y===1){
			if(!is_null($data[$i]) && !empty($data[$i]) ){
				$products = explode(";",$data[$i]);
                                $productcounter++;
				$sql= "INSERT INTO PRODUCT(ProductName,PRICE) VALUES ('$products[0]','$products[1]')";
       		     		$conn->query($sql);
			}
		}

            
        }$y++;
		
    }
    fclose($handle);
}
function RandomLine($filename) { 
    $lines = file($filename) ; 
    return $lines[array_rand($lines)] ; 
} 
$i=1;
$y=1;
	for($i=1,$y=0;$i<=1620 || $y<=1215;$i++,$y++){
		$namesurname1 = RandomLine("names.csv"); 
		$namesurname2 = RandomLine("names.csv"); 
		$splits1 = explode(";",$namesurname1);
		$splits2 = explode(";",$namesurname2);
		//echo $splits1[0]." ".$splits1[1]."<br>";
		$sql= "INSERT INTO CUSTOMER(Name,Surname) VALUES ('$splits1[0]','$splits2[1]')";
		$conn->query($sql);
		
		if($y<1215){
		   
	       	   
		   $sql= "INSERT INTO SALESMAN(Name,Surname,market_id) VALUES ('$splits2[0]','$splits1[1]',floor($y/3)+1) ";
		   $conn->query($sql);
			  
		
		}

}


       for($i=1;$i<=1620;$i++){

	$randsale=rand(1,5);
	for($y=0;$y<$randsale;$y++){
		$randProduct=rand(1,$productcounter);
			date_default_timezone_set('Europe/Istanbul');
		//echo $randProduct."<br>";
		$randSalesman=rand(1,1215);	
		//echo $randSalesman."<br>";
		   $min_epoch = strtotime('2016-01-01');
    $max_epoch = strtotime('2016-12-12');

    $rand_epoch = rand($min_epoch, $max_epoch);

	  $date2= date('Y-m-d', $rand_epoch);
		$sql= "INSERT INTO SALE(product_id,customer_id,salesman_id,date) VALUES('$randProduct','$i','$randSalesman','$date2') ";
		if(!$conn->query($sql)){
			
		die('Invalid query: ' . mysql_error());	}

	
	}


       }
?>

</body>
	<br><br>
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
<center>
<h1> Installization is successfull!</h2>
<h3> Make Your Choice!</h3>
<form action="ShowCitySalesInformation.php" method="post"><br/>
 
 <button class="button">A</button>
 
 </form>
 <form action="City.php" method="post"><br/>
 
 <button class="button">B</button>
 
</form>
 <form action="PieChart.php" method="post"><br/>
 
 <button class="button">C</button>
 
 </form>
</center>




</html>