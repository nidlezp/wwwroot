<?php
include_once 'simple_html_dom.php';

$url = "http://slashdot.org/";
$html = file_get_html($url);

//remove additional spaces
$pat[0] = "/^\s+/";
$pat[1] = "/\s{2,}/";
$pat[2] = "/\s+\$/";
$rep[0] = "";
$rep[1] = " ";
$rep[2] = "";

foreach($html->find('h2') as $heading) { //for each heading
        //find all spans with a inside then echo the found text out
        echo preg_replace($pat, $rep, $heading->find('span a', 0)->plaintext) . "<br>"; 
}
?>