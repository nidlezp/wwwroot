<?php
$dbName = $_SERVER["DOCUMENT_ROOT"] . "\php\phpro_menu\db.mdb";
echo ($dbName . "<br>");
if (!file_exists($dbName)) {
    die("Could not find database file.");
}

// create an array to hold the references
$refs = array();

// create and array to hold the list
$list = array();

// the query to fetch the menu data
$sql = "SELECT id, parent_id, name FROM menu_items ORDER BY name";

$conn = new COM("ADODB.Connection");
$conn->open("PROVIDER=Microsoft.Jet.OLEDB.4.0;Data Source=db.mdb");

//echo ("1<br>");

//execute an SQL statement and return a recordset
$rs          = $conn->execute($sql);
$num_columns = $rs->Fields->Count();
//echo ("2<br>");
while (!$rs->EOF) //looping through the recordset (until End Of File)
    {
    // Assign by reference
    $thisref =& $refs[$rs->Fields(0)->value];
    
    // add the the menu parent
    $thisref['menu_parent_id'] = $rs->Fields(1)->value;
    $thisref['menu_item_name'] = $rs->Fields(2)->value;
    
    // if there is no parent id
    if ($rs->Fields(1)->value == 0) {
        $list[$rs->Fields(0)->value] =& $thisref;
    } else {
        $refs[$rs->Fields(1)->value]['children'][$rs->Fields(0)->value] =& $thisref;
    }
    $rs->MoveNext();
}

//close the recordset and the database connection
$rs->Close();
$rs = null;
$conn->Close();
$conn = null;

/**
 *
 * Create a HTML list from an array
 *
 * @param    array    $arr
 * @param    string    $list_type
 * @return    string
 *
 */
function create_list($arr)
{
    $html = "\n<ul>\n";
    foreach ($arr as $key => $v) {
        $html .= '<li>' . $v['menu_item_name'] . "</li>\n";
        if (array_key_exists('children', $v)) {
            $html .= "<li>";
            $html .= create_list($v['children']);
            $html .= "</li>\n";
        } else {
        }
    }
    $html .= "</ul>\n";
    return $html;
}

echo create_list($list);

?>