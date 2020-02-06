<html>
<head>
<title>
cancelTransaction.php
</title>
<link href="E:\XAMPPnew\htdocs\html1\form.css" type="text/css" rel="stylesheet" />
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

<body background="plain.jpg">

<h1><b><font color='#009900'>Cancel An Existing Transaction...</font></b></h1>
<br>
<form method="POST">
&emsp;&emsp;&emsp;Enter the transaction number &emsp;&emsp;
<input type="text" name="transactionNumber">&emsp;*(Removes all the transaction from database)<p>
<br>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<button type="submit" class="btn btn-primary" name="addFunc" method="post">Cancel Transaction</button><p><p><br>
</form>

<?php


if(isset($_POST['addFunc']))
{
 cancelTransaction();
}


function cancelTransaction() {

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

$result_transactionNumber=(int)$_POST['transactionNumber'];
//mysqli_query will execute the query and stores into $result

$result_transactionDate=mysqli_query($link,"SELECT transactiondate FROM TRANS_ACTION where transactionNumber=$result_transactionNumber");
$obj = mysqli_fetch_object($result_transactionDate);
$transdate= $obj->transactiondate;

$transactionDate= date_create($transdate);
$todayDate = date_create(date("Y-m-d")); 

$dtdiff = date_diff($transactionDate,$todayDate);
$datediff = (int)$dtdiff->format("%R%a days");


if ($datediff < 30)
{
echo '<span style="color:#008000;text-align:center;">Success!!! Cancelled the transaction...</span>';
$result_removetransactiondetails=mysqli_query($link,"DELETE FROM TRANSACTIONDETAILS where transactionNo=$result_transactionNumber");
$result_removetransaction=mysqli_query($link,"DELETE FROM TRANS_ACTION where transactionNumber=$result_transactionNumber");
}
else
{
echo '<span style="color:#FF0000;text-align:center;">Sorry!!! Cannot cancel the transaction older than 30 days...</span>';
}

mysqli_close($link);

}


?>


</body>
</html>
