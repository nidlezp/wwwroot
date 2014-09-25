<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="Site.css">
</head>
<body>
<div id="main">
<h1>Create Customers</h1>

<?php

ini_set('display_errors', 'On');
try
  {
//create an ADO connection and open the database
$conn=new COM("ADODB.Connection");
$conn->open("PROVIDER=Microsoft.Jet.OLEDB.4.0;Data Source=C:\inetpub\wwwroot\php_test\DB\EmptyDatabase.mdb");
$conn->execute("CREATE TABLE Customers (CustomerID INT IDENTITY,CustomerName NVARCHAR(255),ContactName NVARCHAR(255),Address NVARCHAR(255),City NVARCHAR(255),PostalCode NVARCHAR(255),Country NVARCHAR(255))");
$conn->close();
$conn=null;
  }

//catch exception
catch(Exception $e)
  {
  	echo 'Message: ' .$e->getMessage();
  }








?>

<?php include("Footer.php"); ?>

</div>
</body>
</html>