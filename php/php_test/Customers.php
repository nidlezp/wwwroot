<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="Site.css">
</head>
<body>
<?php include("Header.php"); ?>
<div id="main">
<h1>Customers</h1>

<?php
ini_set('display_errors', 'On');
try
  {
	//create an ADO connection and open the database
	$conn = new COM("ADODB.Connection");
	$conn->open("PROVIDER=Microsoft.Jet.OLEDB.4.0; Data Source=C:\inetpub\wwwroot\php_test\DB\Northwind.mdb;");
	//$conn->Open("DRIVER={Microsoft Access Driver (*.mdb)};DBQ=C:\TEMP\DB.mdb;");
	  //echo 'If you see this, the number is 1 or below';
  }

//catch exception
catch(Exception $e)
  {
  	echo 'Message: ' .$e->getMessage();
  }

//execute an SQL statement and return a recordset
$rs = $conn->execute("SELECT CompanyName, City, Country FROM Customers");
$num_columns = $rs->Fields->Count();

echo "<table border='1'>";
echo "<tr><th>Name</th><th>City</th><th>Country</th></tr>";
while (!$rs->EOF) //looping through the recordset (until End Of File)
{
echo "<tr>";
for ($i=0; $i < $num_columns; $i++) {
echo "<td>" . $rs->Fields($i)->value . "</td>";
}
echo "</tr>";
$rs->MoveNext();
}
echo "</table>";

//close the recordset and the database connection
$rs->Close();
$rs = null;
$conn->Close();
$conn = null;

?>

<?php include("Footer.php"); ?>

</div>
</body>
</html>