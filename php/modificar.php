<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modificar precio criptomoneda</title>
    <link rel="stylesheet" type="text/css" href="../html/style.css"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cinzel|Fauna+One">
    <script src="../js/añadirOpcionSelect.js"></script>
</head>
<body>
<div class="topnav">
    <a class="active" href="index.html">PRINCIPAL</a>
    <div class="dropdown">
        <a href="../php/mostrar.php">PRECIOS</a>
    </div>
    <div class="dropdown">
        <a href="../php/mostrarUsuarios.php">USUARIOS</a>
    </div>
    <div class="dropdown">
        <button class="dropbtn">CRIPTOMONEDAS</button>
        <div class="dropdown-content">
            <a href="../html/form_new_crypto.html">Añade una nueva criptomoneda</a>
            <a href="../html/form_modify_crypto.html">Modifica una criptomoneda</a>
            <a href="../html/form_delete_crypto.html">Borra una criptomoneda</a>

        </div>
    </div>
    <div class="dropdown">
        <a href="info.html">Preguntas</a>
    </div>

</div>
<!-- Title -->
<h2>Modificar precios</h2>
<p>Selecciona la criptomoneda que quieras modificar</p>

<!-- This is a drop-down list to choose the set you want to change the price -->
<form action="../php/BDconexion.php">
    <select name="nombre">
        <option value="Bitcoin">Bitcoin</option>
        <option value="WorldCoin">WorldCoin</option>
        <option value="IlloJuan">IlloJuan</option>
        <option value="LiteCoin">LiteCoin</option>

    </select>
    <hr>

    <input type="number" step="any" style="width: 60px" name="precio" placeholder="€" min="0" required>
    <input type="submit" value="Cambiar precio">
</form>

</body>
</html>

<?php 

require_once("../php/BDConexion.php");

try {

    $rutaXq = "../xq/modificarCrypto.xq";
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
    $query->bind('$nombre', $_GET["nombre"]);
    $query->bind('$precio', $_GET["precio"]);

    // execute result
    $result = $query->execute();
    // close query
    $query->close();
    // close session
    $session->close();
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