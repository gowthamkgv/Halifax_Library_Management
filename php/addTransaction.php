<!DOCTYPE html>
<html>
<head>
<title>Add Transaction</title>
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
<div class="header">
  <img src="lib.png" alt="sry" width="62" height="62">
  <a  class="logo" >Halifax Central Libraries</a>
  <div class="header-right">
    <a class="active" href="main.php">Home</a>
    <a href="Contact.html">Contact</a>
    <a href="about.html">About</a>
  </div>
</div>
<h2><b><u><font color='#c42170'><center>Adding a new Transaction...</center></font></u></b></h2>

<body background="cool-background (1).png">

	<form action="insertTransaction.php" method="POST">

          <div class="col-md-9">
			<div class="contact-form">
				<div class="form-group">
				  <label class="control-label col-sm-4" for="itemid">Item ID:</label>
				  <div class="col-sm-10">          
					<input type="text" class="form-control" id="itemid" placeholder="Enter Item id" name="itemid">
				  </div>
				</div>
			<div class="contact-form">
				<div class="form-group">
				  <label class="control-label col-sm-4" for="quantity">ITEM Quantity:</label>
				  <div class="col-sm-10">          
					<input type="text" class="form-control" id="quantity" placeholder="Enter Quantity" name="quantity">
				  </div>
				</div>
                              </div>

<br>	
<div class="contact-form">
				<div class="form-group">
				  <label class="control-label col-sm-4" for="Customer_name">CUSTOMER NAME:</label>

<select name="cusid">

	<?php
	require("/home/course/u42/public_html/final/php/dbguest.php");

	$link = mysqli_connect($host, $user, $pass);
	if (!$link) die("Couldn't connect to MySQL");

	mysqli_select_db($link, $db)
	or die("Couldn't open $db: ".mysqli_error($link));

	function prtable($table) {
		while ($a_row = mysqli_fetch_row($table)) {
			print "<option value=\"$a_row[0]\">CID : $a_row[0]</option>";
		}
	}
	$result = mysqli_query($link, "SELECT customer_id FROM CUSTOMER");

	prtable($result);

	mysqli_close($link);
	?>
</select>
<br>
<br>
                      <div class="form-group">        
				  <div class="col-sm-offset-2 col-sm-10">
					<center><button type="submit" class="btn btn-primary" name="submit" "Add Transaction" method="post"  >Add New Transaction</button></center>
				  </div>
				</div>
</div>
</div>
</form>
</body>
</html>






