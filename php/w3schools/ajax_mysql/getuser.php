<?php
ini_set('display_errors', 'On');
$q = intval($_GET['q']);

//create an ADO connection and open the database
$conn = new COM("ADODB.Connection");
$conn->open("PROVIDER=Microsoft.Jet.OLEDB.4.0;Data Source=C:\inetpub\wwwroot\php\w3schools\ajax_mysql\db.mdb");

$query = "SELECT * FROM users WHERE id = ".$q;
echo $query;
//execute an SQL statement and return a recordset
$rs = $conn->execute($query);
$num_columns = $rs->Fields->Count();

echo "<table border='1'>
<tr>
<th>ID</th>
<th>Firstname</th>
<th>Lastname</th>
<th>Age</th>
<th>Hometown</th>
<th>Job</th>
</tr>";

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