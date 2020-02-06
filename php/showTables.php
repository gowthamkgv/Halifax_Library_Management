<head>
<title>
showTables.php
</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<style>
* {box-sizing: border-box;}

body { 
  margin: 0;
opacity:0.5
  font-family: Arial, Helvetica, sans-serif;
}

.container-background{

opacity:2;
}

.header {
  overflow: hidden;
  background-color: #f1f1f1;
  padding: 20px 10px;
}
.btn-group button:not(:last-child) {

}

.btn-group button:hover {
  background-color: #3e8e41;
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
   .button {
         background-color: #1c87c9;
         border: none;
         color: white;
         padding: 40px 40px;
         text-align: center;
         text-decoration: none;
         display: inline-block;
         font-size: 20px;
         margin: 4px 2px;
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

<body><!-- background="lib.png">-->
<div class="Container container-background">
<h2><b><u><font color='#c42170'>List of tables available in the database</font></u></b></h2>

<?php

function prtable($table) {
	print "<table class='table'>";
print "<tbody>";
	while ($a_row = mysqli_fetch_row($table)) {
		print "<tr>";
		foreach ($a_row as $field) print "<td>$field</td>";
		print "</tr>";
	}
	print "</tbody>";
	print "</table>";
}

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

$result = mysqli_query($link, "show tables from $db");



//It will print the result in the form of table 
prtable($result);

//Close the connection
mysqli_close($link);


?>

<form action="print_table.php" method="POST">
<p>
<b>Enter the table name from above list to view records:</b>

<input type="text" name="table">&emsp;(table names are case-sensitive)
<p>
<input type="submit" value="View Table">

</form>
</div>

</body>
</html>

