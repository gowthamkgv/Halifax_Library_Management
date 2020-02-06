<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>
main.php
</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>

<body ><!--background="lib.png">-->


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

<div style="padding-left:20px">
 

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
.btn-group button {
background-color:orange;
display: inline-block;
  padding-top: 50px;
  padding-right: -30px;
  padding-bottom: -100px;
  padding-left: -80px;
}


.btn-group:after {
  content: "";
  clear: both;
  display: table;
}

.btn-group button:not(:last-child) {

}

.btn-group button:hover {
  background-color: #3e8e41;
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
         cursor: pointer;
         }
      </style>

<div class="btn-group" style="width:100%">
 <a href="showTables.php" class="button">Show Tables</a><br>
 <a href="addArticle.php" class="button">Add Article</a><br>
 <a href="addCustomer.php" class="button">Add Customer</a><br>
<a href="addTransaction.php" class="button">Add Transaction</a><br>
 <a href="cancelTransaction.php" class="button">Cancel Transaction</a><br>

</div>
</body>
</html>
