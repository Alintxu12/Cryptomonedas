<?php

require_once("../php/BDConexion.php");

try {

    $rutaXq = "../xq/nombres.xq";
    $fichero = fopen($rutaXq, "r"); // Abrimos el fichero $rutaXq en modo lectura "r"
    $xq = fread($fichero, filesize($rutaXq)); // Leemos el contenido del fichero y lo guardamos en la variable $xq
    fclose($fichero); // Cerramos el fichero
    
    // create session
   $session = new Session();    
    // open database
    $session->execute("open criptomonedas"); // open y el nombre de la base de datos en el servidor BaseX

    // xquery
    $query = $session->query($xq);


    //bind 
    //$query->bind('$nombre', $_GET["nombre"]);

    // execute result
    $result = $query->execute();
    // close query
    $query->close();
    // close session
    $session->close();

    echo $result;
    //modificar fichero

    // Show the result
    //echo $result;
    
    //$myfile = fopen("result.xml", "w") or die("Unable to open file!");
  
    //fwrite($myfile, $result);
    //fclose($myfile);

   // $xml = new DOMDocument;

    //$xml->load('result.xml');
    
    //$xsl = new DOMDocument;
    
   // $xsl->load('template.xsl');
    
  //  $proc = new XSLTProcessor;
    
   // $proc->importStyleSheet($xsl);
    
    //echo $proc->transformToXML($xml);

} catch(Exception $e) {

    echo $e->getMessage();

}




?>