<?php
/*
url             HTTP Method  Operation
/api/books      GET          Get an array of all books
/api/books/:id  GET          Get the book with id of :id
/api/books      POST         Add a new book and return the book with an id attribute added
/api/books/:id  PUT          Update the book with id of :id
/api/books/:id  DELETE       Delete the book with id of :id
*/
//create an ADO connection and open the database
//echo "1";
$conn = new COM("ADODB.Connection");
//echo "2";
$conn->open("PROVIDER=Microsoft.Jet.OLEDB.4.0;Data Source='C:\inetpub\wwwroot\php\mvc\db.mdb'");
//echo "3";

$query = "SELECT * FROM books";
//echo $query;
//execute an SQL statement and return a recordset
$rs = $conn->execute($query);
$num_columns = $rs->Fields->Count();

echo "<table border='1'>
<tr>
<th>ID</th>
<th>cover image</th>
<th>title</th>
<th>author</th>
<th>release date</th>
<th>keywords</th>
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




// This is the API, 2 possibilities: show the app list or show a specific app by id.
// This would normally be pulled from a database but for demo purposes, I will be hardcoding the return values.

function get_book_by_id($id)
{
  $app_info = array();

  // normally this info would be pulled from a database.
  // build JSON array.
  switch ($id){
    case 1:
      $app_info = array("ID" => "1", "cover_image" => "None", "title" => "Hello", "author""="PZ", "release_date""="01/01/1990", "keywords"="kk");
      break;
  }

  return $app_info;
}

function get_book_list()
{
  //normally this info would be pulled from a database.
  //build JSON array

}

$possible_url = array("get_app_list", "get_app");

$value = "An error has occurred";

if (isset($_GET["action"]) && in_array($_GET["action"], $possible_url))
{
  switch ($_GET["action"])
    {
      case "get_app_list":
        $value = get_app_list();
        break;
      case "get_app":
        if (isset($_GET["id"]))
          $value = get_app_by_id($_GET["id"]);
        else
          $value = "Missing argument";
        break;
    }
}

//return JSON array
exit(json_encode($value));










?>