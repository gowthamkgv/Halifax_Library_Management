<html>
<head>
<title>Add Customer</title>
<link href="C:\Users\HI\Desktop\html\form.css" type="text/css" rel="stylesheet" />
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>


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

<div class="header">
  <img src="lib.png" alt="sry" width="62" height="62">
  <a  class="logo" >Halifax Central Libraries</a>
  <div class="header-right">
    <a class="active" href="main.php">Home</a>
    <a href="Contact.html">Contact</a>
    <a href="about.html">About</a>
  </div>
</div>

<body background="cool-background (1).png">
<form method="POST">

<div class="container contact">
	<div class="row">
		<div class="col-md-3">
			<div class="contact-info">
				<img src="https://image.ibb.co/kUASdV/contact-image.png" alt="image"/>
				<h2>Add Customer</h2>
				<h4>Fill the form to add new Customer</h4>
			</div>
		</div>
		<div class="col-md-9">
			<div class="contact-form">
				<div class="form-group">
				  <label class="control-label col-sm-4" for="fname">First Name:</label>
				  <div class="col-sm-10">          
					<input type="text" class="form-control" id="firstName" placeholder="Enter First Name" name="firstName">
				  </div>
				</div>
				<div class="form-group">
				  <label class="control-label col-sm-4" for="lastName">Last Name:</label>
				  <div class="col-sm-10">          
					<input type="text" class="form-control" id="lastName" placeholder="Enter Last Name" name="lastName">
				  </div>
				</div>
				<div class="form-group">
				  <label class="control-label col-sm-4" for="phoneNumber">Phone Number:</label>
				  <div class="col-sm-10">
					<input type="text" class="form-control" id="phoneNumber" placeholder="Enter phone number" name="phoneNumber">
				  </div>
				</div>
				
				<div class="form-group">
				  <label class="control-label col-sm-4" for="address">Mailing Address:</label>
				  <div class="col-sm-10">
					<textarea class ="form-control" name="address" cols="30" rows=3"></textarea><br>
				  </div>
				</div>
				<div class="form-group">
				  <label class="control-label col-sm-4" for="yes">Add Same customer:</label>
				  <div class="control-label col-sm-4">
					<input type="checkbox" class="form-control" name="yes" value="yes">If customer exists with same name, Are you okay to add customer ?<br><p><p><p>
				  </div>
				</div>
				
				<div class="form-group">        
				  <div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-primary" name="addFunc">Add new customer</button>
				  </div>
				</div>
			</div>
		</div>
	</div>
</div>
</form>




<?php

if(isset($_POST['addFunc']))
{
 addCustomer();
}


function addCustomer() {

//Import Everything that is in dbguest.php
require("/home/course/u42/public_html/final/php/dbguest.php");

//It will import all variables such as $host , $user, $pass and $db

//mysqli_connect() is to connect the database
$link = mysqli_connect($host, $user, $pass, $db);

//Check the connection. Give error message if any error
if (!$link) die("Couldn't connect to MySQL");


//mysqli_select_db() is used to select the database
mysqli_select_db($link, $db)
        or die("Couldn't open $db: ".mysqli_error($link));

//mysqli_query will execute the query and stores into $result

$result_fname=$_POST['firstName'];
$result_lname=$_POST['lastName'];
$result_phoneNumber=$_POST['phoneNumber'];
$result_address =$_POST['address'];
$check = $_POST['yesNo'];

$result_check = mysqli_query($link,  "select * from CUSTOMER where fname='$_POST[firstName]' and lname='$_POST[lastName]' ");

if ($result_check->num_rows> 0)
{
	if ($_POST['yes']=='yes')
	{
	echo '<span style="color:#008000;text-align:center;"> With Consent : Customer has been added....</span>';
	$result_customer = mysqli_query($link, "INSERT INTO CUSTOMER (lname,fname,address,phoneNumber) VALUES('$result_lname','$result_fname','$result_address','$result_phoneNumber')");
	}
	else
	{
	echo '<span style="color:#FF0000;text-align:center;">Without Consent : Please provide different firstname/lastname.... </span>';
	}
}

else
{
$result_customer = mysqli_query($link, "INSERT INTO CUSTOMER (lname,fname,address,phoneNumber) VALUES('$result_lname','$result_fname','$result_address','$result_phoneNumber')");
echo '<span style="color:#008000;text-align:center;">Success!!! Added a new customer...</span>';
}

//Close the connection
mysqli_close($link);

}

?>
</body>
</html>











