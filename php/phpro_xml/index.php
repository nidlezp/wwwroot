<?php 

    if( ! $xml = simplexml_load_file('address.xml') ) 
    { 
        echo 'unable to load XML file'; 
    } 
    else 
    { 
        foreach( $xml as $user ) 
        { 
            echo 'Firstname: '.$user->firstname.'<br />'; 
            echo 'Surname: '.$user->surname.'<br />'; 
            echo 'Address: '.$user->address.'<br />'; 
            echo 'City: '.$user->city.'<br />'; 
            echo 'Country: '.$user->country.'<br />'; 
            echo 'Email: '.$user->contact->phone.'<br />'; 
            echo 'Email: '.$user->contact->url.'<br />'; 
            echo 'Email: '.$user->contact->email.'<br />';
			echo '<br />'; 
        } 
    } 

?> 




<?php 
$xml_string = '<?xml version="1.0" encoding="iso-8859-1"?> 
<users> 
  <user> 
    <firstname>Sheila</firstname> 
    <surname>Green</surname> 
    <address>2 Good St</address> 
    <city>Campbelltown</city> 
    <country>Australia</country> 
    <contact> 
      <phone>1234 1234</phone> 
      <url>http://example.com</url> 
      <email>pamela@example.com</email> 
    </contact> 
    </user> 
</users>'; 

/*** a new DOM object ***/ 
$dom = new DOMDocument; 

/*** load the XML string ***/ 
$dom->loadXML( $xml_string ); 
$sxe = simplexml_import_dom($dom); 

echo $sxe->user[0]->surname; 
?> 

<?php 

try 
{ 
    /*** a new dom object ***/ 
    $dom = new domDocument; 

    /*** make the output tidy ***/ 
    $dom->formatOutput = true; 

    /*** create the root element ***/ 
    $root = $dom->appendChild($dom->createElement( "user" )); 

    /*** create the simple xml element ***/ 
    $sxe = simplexml_import_dom( $dom ); 

    /*** add a firstname element ***/ 
    $sxe->addChild("firstname", "John"); 

    /*** add a surname element ***/ 
    $sxe->addChild("surname", "Brady"); 

    /*** echo the xml ***/ 
    echo $sxe->asXML()."<br />"; 
} 
catch( Exception $e ) 
{ 
    echo $e->getMessage(); 
} 
?> 

<?php 

try 
{ 
    /*** a new dom object ***/ 
    $dom = new domDocument; 

    /*** make the output tidy ***/ 
    $dom->formatOutput = true; 

    /*** create the root element ***/ 
    $root = $dom->appendChild($dom->createElement( "user" )); 

    /*** create the simple xml element ***/ 
    $sxe = simplexml_import_dom( $dom ); 

    /*** add a firstname element ***/ 
    $sxe->addChild("firstname", "John"); 

    /*** add a surname element ***/ 
    $sxe->addChild("surname", "Brady"); 

    /*** add address element ***/ 
    $sxe->addChild("address", "1 Bunch St"); 

    /*** add the city element ***/ 
    $sxe->addChild("city", "Downtown"); 

    /*** add the country ***/ 
    $sxe->addChild("country", "America"); 

    /*** echo the xml ***/ 
    echo $sxe->asXML()."<br />"; 
} 
catch( Exception $e ) 
{ 
    echo $e->getMessage(); 
} 
?> 

<?php 

try 
{ 
    /*** a new dom object ***/ 
    $dom = new domDocument; 

    /*** make the output tidy ***/ 
    $dom->formatOutput = true; 

    /*** create the root element ***/ 
    $root = $dom->appendChild($dom->createElement( "users" )); 

    /*** create the simple xml element ***/ 
    $sxe = simplexml_import_dom( $dom ); 

    /*** add a user node ***/ 
    $user = $sxe->addchild("user"); 

    /*** add a firstname element ***/ 
    $user->addChild("firstname", "John"); 

    /*** add a surname element ***/ 
    $user->addChild("surname", "Brady"); 

    /*** add address element ***/ 
    $user->addChild("address", "1 Bunch St"); 

    /*** add the city element ***/ 
    $user->addChild("city", "Downtown"); 

    /*** add the country ***/ 
    $user->addChild("country", "America"); 

    $contact = $user->addChild("contact"); 
    $contact->addChild("phone", "4444 4444"); 
    $contact->addChild("url", "http://phpro.org"); 
    $contact->addChild("email", "brady@bunch.example.com"); 

    echo $sxe->asXML()."<br />"; 
} 
catch( Exception $e ) 
{ 
    echo $e->getMessage(); 
} 
?> 

<?php 

try 
{ 
    /*** a new dom object ***/ 
    $dom = new domDocument; 

    /*** make the output tidy ***/ 
    $dom->formatOutput = true; 

    /*** create the root element ***/ 
    $root = $dom->appendChild($dom->createElement( "users" )); 

    /*** create the simple xml element ***/ 
    $sxe = simplexml_import_dom( $dom ); 

    /*** add a user node ***/ 
    $user = $sxe->addchild("user"); 

    /*** add a firstname element ***/ 
    $user->addChild("firstname", "John"); 

    /*** add a surname element ***/ 
    $user->addChild("surname", "Brady"); 

    /*** add address element ***/ 
    $user->addChild("address", "1 Bunch St"); 

    /*** add the city element ***/ 
    $user->addChild("city", "Downtown"); 

    /*** add the country ***/ 
    $user->addChild("country", "America"); 

    /*** add the contact element ***/ 
    $contact = $user->addChild("contact"); 

    /*** add children to the contact element ***/ 
    $contact->addChild("phone", "4444 4444"); 
    $contact->addChild("url", "http://phpro.org"); 
    $contact->addChild("email", "brady@bunch.example.com"); 


    /*** add a second user node ***/ 
    $user = $sxe->addchild("user"); 

    /*** add a firstname element ***/ 
    $user->addChild("firstname", "Jenna"); 

    /*** add a surname element ***/ 
    $user->addChild("surname", "Taylor"); 

    /*** add address element ***/ 
    $user->addChild("address", "The Wrong Way"); 

    /*** add the city element ***/ 
    $user->addChild("city", "Sydney"); 

    /*** add the country ***/ 
    $user->addChild("country", "Australia"); 

    /*** add the contact element ***/ 
    $contact = $user->addChild("contact"); 

    /*** add children to the contact element ***/ 
    $contact->addChild("phone", "1234 1234"); 
    $contact->addChild("url", "http://phpro.org"); 
    $contact->addChild("email", "jenna@taylor.example.com"); 


    /*** show the xml ***/ 
    echo $sxe->asXML(); 
} 
catch( Exception $e ) 
{ 
    echo $e->getMessage(); 
} 
?> 

<?php 

try 
{ 
    /*** a new dom object ***/ 
    $dom = new domDocument; 

    /*** make the output tidy ***/ 
    $dom->formatOutput = true; 

    /*** create the root element ***/ 
    $root = $dom->appendChild($dom->createElement( "users" )); 

    /*** create the simple xml element ***/ 
    $sxe = simplexml_import_dom( $dom ); 

    /*** add a user node ***/ 
    $user = $sxe->addchild("user"); 

    /*** add a firstname element ***/ 
    $user->addChild("firstname", "John"); 

    /*** add a surname element ***/ 
    $user->addChild("surname", "Brady"); 

    /*** add address element ***/ 
    $user->addChild("address", "1 Bunch St"); 

    /*** add the city element ***/ 
    $user->addChild("city", "Downtown"); 

    /*** add the country ***/ 
    $user->addChild("country", "America"); 

    /*** add the contact element ***/ 
    $contact = $user->addChild("contact"); 

    /*** add children to the contact element ***/ 
    $phone = $contact->addChild("phone", "4444 4444"); 

    /*** add an attribute to the phone element ***/ 
    $phone->addAttribute("type", "mobile"); 

    /*** more children for the contact element ***/ 
    $contact->addChild("url", "http://phpro.org"); 
    $contact->addChild("email", "brady@bunch.example.com"); 

    /*** show the xml ***/ 
    echo $sxe->asXML(); 
} 
catch( Exception $e ) 
{ 
    echo $e->getMessage(); 
} 
?> 

<?php 
echo("EEE");
    /*** create a SimpleXML object ***/ 
    if( ! $xml = simplexml_load_file("example.xml") ) 
    { 
        echo "Unable to load XML file"; 
    } 
    else 
    { 
        /*** loop over the elements ***/ 
        foreach( $xml as $element ) 
        { 
            print_r( $element );
			print_r("<br />"); 
        } 

    } 
?> 