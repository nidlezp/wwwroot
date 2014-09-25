<?php
$dbName = $_SERVER["DOCUMENT_ROOT"] . "\php\phpro_app\db.mdb";
echo ($dbName . "<br>");
if (!file_exists($dbName)) {
    die("Could not find database file.");
}

$conn = new COM("ADODB.Connection");
$conn->open("PROVIDER=Microsoft.Jet.OLEDB.4.0;Data Source=".$dbName);
?>