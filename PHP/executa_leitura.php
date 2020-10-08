<?php 

$var = $_POST["var_php"];



//$doc = new DOMdocument();
//$doc->load('xml/SEM_FORMATACAO.xml');
$file_open = fopen('xml/SEM_FORMATACAO.xml', "r");
$data = fgetcsv($file_open,10000);
$data_txt = str_replace('"', '' , $data[0]); 
// Optei em não usar a biblioteca pra evitar erro com a decodificação do arquivo xml 
//$obj_xml = simplexml_load_string($data_txt);



echo(print_r($data[0]));
?>