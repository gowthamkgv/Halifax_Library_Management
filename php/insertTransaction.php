<html>
<head><title></title>

<link href="C:\Users\HI\Desktop\html\form.css" type="text/css" rel="stylesheet" />
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<style>
* {box-sizing: border-box;}

body { 
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.header {
  overflow: hidden;
  background-color: #f1f1f1;
  padding: 20px 10px;
}

.header a {
  float: left;
  color: black;
  text-align: center;
  padding: 12px;
  text-decoration: none;
  font-size: 18px; 
  line-height: 25px;
  border-radius: 4px;
}

.header a.logo {
  font-size: 25px;
  font-weight: bold;
}

.header a:hover {
  background-color: dodgerblue;
  color: black;
}

.header a.active {
  background-color: dodger;
  color: black;
}

.header-right {
  float: right;
}

@media screen and (max-width: 500px) {
  .header a {
    float: none;
    display: block;
    text-align: left;
  }
  
  .header-right {
    float: none;
  }
}
</style>
</head>
<body>
<div class="header">
  <img src="lib.png" alt="sry" width="62" height="62">
  <a  class="logo" >Halifax Central Libraries</a>
  <div class="header-right">
    <a class="active" href="main.php">Home</a>
    <a href="Contact.html">Contact</a>
    <a href="about.html">About</a>
  </div>
</div>	
<br><br><a href="main.php">Back to Main Page</a>

	<?php

	require("/home/course/u42/public_html/final/php/dbguest.php");

	$link = mysqli_connect($host, $user, $pass);
	if (!$link) die("Couldn't connect to MySQL");

	mysqli_select_db($link, $db)
	or die("Couldn't open $db: ".mysqli_error($link));


// Entry Details

	$itemid = $_POST['itemid'];
	$quantity = $_POST['quantity'];
	$cusid = $_POST['cusid'];
	
//Putting Item ID and Quantity into Arrays
	$itemids = explode(",", $itemid);
	$quantities = explode(",", $quantity);

	$chck = True;

//Checking if all Items Exist, or else End.
	for ($i =0; $i<count($itemids);$i++)
	{
		$itemidInside = $itemids[$i];

		$checkItems = "SELECT * FROM ITEM WHERE _id = '".$itemidInside."'";
		$run_check = mysqli_query($link, $checkItems);
		if (!mysqli_num_rows($run_check)) {
			$chck = False;
			
		}
	}

	if (count($itemids)!= count($quantities))
	{
		echo "<br>";
		echo "<h1> Number of Items and Prices Do Not Match, Try Again.</h1>";
		$chck = False;
	}
           
	echo  "<br>  Customer ID: ";
	echo $cusid;
	echo "<br>";

	function discountCode($cusid, $link){

		$discountCodeQuery = "SELECT SUM(totalpurchaseprice) AS TOTAL_PRICE FROM TRANS_ACTION WHERE customerID = '{$cusid}' AND transactiondate > DATE_SUB(NOW(),INTERVAL 5 YEAR)";

		$discountCodeExecution = mysqli_query($link, $discountCodeQuery);
		$row = mysqli_fetch_assoc($discountCodeExecution);
		$sum = $row['TOTAL_PRICE'];

		global $discountcode;
		if($sum){
			if($sum > 500){
				$discountcode = 5;
			} else if($sum > 400 && $sum <= 500){
				$discountcode = 4;
			} else if($sum > 300 && $sum <= 400){
				$discountcode = 3;
			} else if($sum > 200 && $sum <= 300){
				$discountcode = 2;
			} else if($sum > 100 && $sum <= 200){
				$discountcode = 1;
			}
		} else{
			$sum = 0;
			$discountcode = 0;
			
		}


	}
	

	if ($chck == True){
		discountCode($cusid, $link);

		$total = 0;

		for ($i =0; $i<count($itemids);$i++)
		{

			$priceQuery = "SELECT price FROM ITEM where _id = '".$itemids[$i]."'";
			$runpriceQuery = mysqli_query($link, $priceQuery);
			while ($row = mysqli_fetch_row($runpriceQuery)){
				$priceEachItem = $quantities[$i] * $row[0];

				$total += $priceEachItem;
			}
		}
		$total_price = $total*(1-2.5*$discountcode/100);

		$sqlInsertTransaction = "INSERT into TRANS_ACTION(customerID,transactiondate,totalpurchaseprice) VALUES('$cusid',now(),'$total_price')";
		$resultTransactionInsert = mysqli_query($link, $sqlInsertTransaction);

	//Getting Current Transaction Number
		$transactionNumber = mysqli_insert_id($link);
		echo " <br> Transaction Number : ";
		echo $transactionNumber;

		echo "<br> Discount Code :";
		echo $discountcode;
		$sqlUpdateCustomerDC = mysqli_query($link, "UPDATE TRANS_ACTION SET discountcode = ".$discountcode." WHERE customerID = ".$cusid);



		for ($i =0; $i<count($itemids);$i++)
		{
			$priceQuery = "SELECT price FROM ITEM where _id = '".$itemids[$i]."'";
			$runpriceQuery = mysqli_query($link, $priceQuery);
			$row = mysqli_fetch_row($runpriceQuery);
			$quantity_price = ($quantities[$i] * $row[0])*(1-2.5*$discountcode/100);



			$insertTransItemStatement = "INSERT INTO TRANSACTIONDETAILS (transactionNO, itemId) VALUES (".$transactionNumber.",".$itemids[$i].")";

			$runInsertTransItemStatement = mysqli_query($link,$insertTransItemStatement);

		}

		echo "<br> Total Price :";
		echo $total_price;

		echo "<br> Transaction Success";
	}

	else {

		echo "<br> Input Error. Try Again.";
	}

	mysqli_close($link);


	?>

	

</body>
</html>