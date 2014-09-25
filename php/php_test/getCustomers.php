<?php
header('Content-Type: text/html; charset=ISO-8859-1');
ini_set('display_errors', 'On');
//create an ADO connection and open the database
$conn = new COM("ADODB.Connection");
$conn->open("PROVIDER=Microsoft.Jet.OLEDB.4.0;Data Source=C:\inetpub\wwwroot\php_test\DB\EmptyDatabase.mdb");

//execute an SQL statement and return a recordset
$rs = $conn->execute("SELECT ContactName, City, Country FROM Customers");
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