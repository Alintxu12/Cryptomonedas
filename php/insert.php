<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Crypto Form</title>
    <link rel="stylesheet" type="text/css" href="../html/style.css"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cinzel|Fauna+One">
    <script src="../js/scriptform1.js" defer></script>
</head>
<body>
    <div class="topnav">
        <a class="active" href="../html/index.html">PRINCIPAL</a>
        <div class="dropdown">
            <a href="../php/mostrar.php">PRECIOS</a>
        </div>
        <div class="dropdown">
            <a href="../php/mostrarUsuarios.php">USUARIOS</a>
        </div>
        <div class="dropdown">
            <button class="dropbtn">CRIPTOMONEDAS</button>
            <div class="dropdown-content">
                <a href="../html/form_new_set.html">Añade una nueva criptomoneda</a>
                <a href="../html/form_modify_crypto.html">Modifica una criptomoneda</a>
                <a href="../html/form_delete_crypto.html">Borra una criptomoneda</a>
            </div>
        </div>
        <div class="dropdown">
            <a href="../html/info.html">Preguntas</a>
        </div>
    </div>

    <form action="../php/insert.php" method="get" onsubmit="return validateForm()">
        <h2>Introduce una nueva criptomoneda</h2>
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" placeholder="Nombre" required/>

        <label for="EUR">Precio:</label>
        <input type="number" id="EUR" name="EUR" min="0" value="0" required>€

        <input type="submit" value="Añadir criptomoneda">
    </form>
<script>
        const backgrounds = [
            'url("../html/cryptos.jpeg")',
            'url("../html/cryptos2.jpg")',
            'url("../html/cryptos3.png")',
        ];

        let currentBackground = 0;

        function changeBackground() {
            currentBackground = (currentBackground + 1) % backgrounds.length;
            document.body.style.backgroundImage = backgrounds[currentBackground];
        }

        setInterval(changeBackground, 10000); // Cambia la imagen cada 7 segundos ya que la transicion de CSS tarda 3 segundos
    </script>
</body>
</html>
<?php 

require_once("../php/BDConexion.php");

try {

    $rutaXq = "../xq/anadirCrypto.xq";
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
    $query->bind('$precio', $_GET["EUR"]);

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