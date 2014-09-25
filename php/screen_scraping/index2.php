<?php
include_once 'simple_html_dom.php';

echo file_get_html('http://nashville.craigslist.org/search/cto?minAsk=2000&maxAsk=7000&autoMakeModel=bmw&auto_transmission=1&srchType=T')->plaintext;



echo "hello world1<br>";
// Create DOM from URL or file
$html = file_get_html('http://www.yahoo.com/');
//echo $html;
// Find all images 
foreach($html->find('img') as $element) 
       echo $element->src . '<br>';

// Find all links 
foreach($html->find('a') as $element) 
       echo $element->href . '<br>';


$html2 = str_get_html('<div id="hello">Hello</div><div id="world">World</div>');
$html2->find('div', 1)->class = 'bar';
$html2->find('div[id=hello]', 0)->innertext = 'foo';
echo $html2;

echo file_get_html('http://www.google.com/')->plaintext;
?>