<?php
function array_to_xml( $data, &$xml_data ) {
    foreach( $data as $key => $value ) {
        if( is_array($value) ) {
            if( is_numeric($key) ){
                $key = 'item'.$key;
            }
            $subnode = $xml_data->addChild($key);
            array_to_xml($value, $subnode);
        } else {
            $xml_data->addChild("$key",htmlspecialchars("$value"));
        }
     }
}

$characters = array( 
    array( 
        "name" => "Peter Parker", "email" => "peterparker@mail.com", ), 
    array( 
        "name" => "Clark Kent", "email" => "clarkkent@mail.com", ), 
    array( 
        "name" => "Harry Potter", "email" => "harrypotter@mail.com", 
        )
 );
 
 array_push($characters, array("name" => "Bruce Wayne", "email" => "brucewayne@mail.com",));

$xml = new SimpleXMLElement('<characters/>');
array_walk_recursive($characters, array ($xml, 'addChild'));
print $xml->asXML("characters.xml");

