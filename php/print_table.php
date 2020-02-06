<html>
<head>
<title>
print_table.php
</title>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
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
<body >
<div class="header">
  <img src="lib.png" alt="sry" width="62" height="62">
  <a  class="logo" >Halifax Central Libraries</a>
  <div class="header-right">
    <a class="active" href="main.php">Home</a>
    <a href="Contact.html">Contact</a>
    <a href="about.html">About</a>
  </div>
</div>



<div class="container container-background">
 <a href="showTables.php" class="button">Back to Tables</a><br>
<?php

//It will get value of table which is passed in the textbox 
$table = $_POST["table"];

print("<h2><b><u><font color='#c42170'>$table TABLE CONTENT</font></u></b></h2>");

//Rest is same!!

function prtable($table) {
	print "<table id='data' class='table'>";
print "<thead></thead><tbody>";
	while ($a_row = mysqli_fetch_row($table)) {
		print "<tr>";
		foreach ($a_row as $field) print "<td>$field</td>";
		print "</tr>";
	}
print "</tbody>";
	print "</table>";
}

require("/home/course/u42/public_html/final/php/dbguest.php");
$link = mysqli_connect($host, $user, $pass);
if (!$link) die("Couldn't connect to MySQL");


mysqli_select_db($link, $db)
	or die("Couldn't open $db: ".mysqli_error($link));

$colName = mysqli_query($link, "select column_name from information_schema.columns where table_schema = 'u42' and table_name = '$table'");
$result = mysqli_query($link, "select * from $table");

if (!$result) print("<font color='#FF0000'>Sorry !!! The specified table doesn't present in database</font>");

else {
    $num_rows = mysqli_num_rows($result);
    print "There are $num_rows rows in the table<p>"; 
    prtable($colName);
    prtable($result);
}

mysqli_close($link);

?>

</div>
</body>
</html>


