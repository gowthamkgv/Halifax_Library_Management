<head>
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


<!------ Include the above in your HEAD tag ---------->
<body background="cool-background (1).png">
<form method="POST">
<div  class="container contact">
	<div class="row">
		<div class="col-md-3">
			<div class="contact-info">
				<img src="https://image.ibb.co/kUASdV/contact-image.png" alt="image"/>
				<h2>Add Article</h2>
				<h4>Fill the form to add new article</h4>
			</div>
		</div>
		<div class="col-md-9">
			<div class="contact-form">
				<div class="form-group">
				  <label class="control-label col-sm-4" for="ArticleTitle">Title of the Article:</label>
				  <div class="col-sm-10">          
					<input type="text" class="form-control" id="ArticleTitle" placeholder="Enter Article Name" name="ArticleTitle">
				  </div>
				</div>
				<div class="form-group">
				  <label class="control-label col-sm-4" for="MagazineID">Magzine ID:</label>
				  <div class="col-sm-10">          
					<input type="text" class="form-control" id="MagazineID" placeholder="Enter Magzine ID" name="MagazineID">
				  </div>
				</div>
				<div class="form-group">
				  <label class="control-label col-sm-4" for="JournalName">Journal Name:</label>
				  <div class="col-sm-10">
					<input type="text" class="form-control" id="JournalName" placeholder="Enter name of Journal" name="JournalName">
				  </div>
				</div>
				<div class="form-group">
				  <label class="control-label col-sm-4" for="VolumeNumber">Volume Number:</label>
				  <div class="col-sm-10">
					<input type="text" class="form-control" id="VolumeNumber" placeholder="Enter volume number" name="VolumeNumber">
				  </div>
				</div>
				<div class="form-group">
				  <label class="control-label col-sm-4" for="Pages">Pages:</label>
				  <div class="col-sm-10">
					<input type="text" class="form-control" id="Pages" placeholder="Enter number of pages" name="Pages">
				  </div>
				</div>
				<div class="form-group">
				  <label class="control-label col-sm-4" for="PublicationYear">Publication year:</label>
				  <div class="col-sm-10">
					<input type="text" class="form-control" id="PublicationYear" placeholder="Enter publication year" name="PublicationYear">
				  </div>
				</div>
				<div class="form-group">
				  <label class="control-label col-sm-4" for="authors">Authors:</label>
				  <div class="col-sm-10">
					<textarea class ="form-control" name="Authors" cols="30" rows=3"></textarea><br>
&nbsp;(Seperate multiple author names by "," ex:(J. K. Rowling,chetan bhagat))<br><p><p>
				  </div>
				</div>
				
				<div class="form-group">        
				  <div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-primary" name="addFunc" >Add Article</button>

				  </div>
				</div>
			</div>
		</div>
	</div>
</div
</form>


<?php
if(isset($_POST['addFunc']))
{
 addArticle();
 }


function addArticle() {

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

$result_name = $_POST['JournalName'];
$result_volno = $_POST['VolumeNumber'];
$result_title = $_POST['ArticleTitle'];
$result_pages = $_POST['Pages'];
$result_year = $_POST['PublicationYear'];
$string_authors=$_POST['Authors'];
$result_magazineID=$_POST['MagazineID'];

$result_authors = explode(",",$string_authors);


$result_magID = mysqli_query($link, "SELECT * from MAGAZINE where _id=$result_magazineID");


if (mysqli_num_rows($result_magID)>0)
{
$result_magazinevolume = mysqli_query($link, "INSERT INTO MAGAZINEVOLUME (Mag_ID,volumeNumber,year) VALUES('$result_magazineID','$result_volno','$result_year')");
$result_article = mysqli_query($link, "INSERT INTO ARTICLE (Magazine_id,volumeNumber,title,pages) VALUES('$result_magazineID','$result_volno','$result_title','$result_pages')");

foreach($result_authors as $authors)
{
   $fnamelname = preg_split("/[\s,]+/",$authors);
   $email =  "$fnamelname[0]".'.'."$fnamelname[1]"."@smu.ca";
  $result_fnamelname = mysqli_query($link, "INSERT INTO AUTHOR (lname,fname,email) VALUES('$fnamelname[1]','$fnamelname[0]','$email')");
}

echo '<span style="color:#008000;text-align:center;">Success!!! Magazine ID Found and added a new Article and Author...</span>';

}

else
{


echo '<span style="color:#FF0000;text-align:center;">Sorry!!! Unable to find the Magazine ID(Check Magazine ID)...</span>';
die;
}

//Close the connection
mysqli_close($link);


}


?>

</body>
</html>