<!DOCTYPE html>
<html>
<head>
    <title>Borrar criptomoneda</title>
    <link rel="stylesheet" href="style.css"/>
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
            <a href="../html/form_new_crypto.html">Añade una nueva criptomoneda</a>
            <a href="../html/form_modify_crypto.html">Modifica una criptomoneda</a>
            <a href="../html/form_delete_set.html">Borra una criptomoneda</a>
        </div>
    </div>
    <div class="dropdown">
        <a href="../html/info.html">Preguntas</a>
    </div>
</div>
<h1>Borrar criptomoneda</h1>

<form action="BDconexion.php">
    <label for="set">Selecciona una criptomoneda:</label>
    <select name="nombre">
    <option value="Bitcoin">Bitcoin</option>
        <option value="WorldCoin">WorldCoin</option>
        <option value="IlloJuan">IlloJuan</option>
        <option value="LiteCoin">LiteCoin</option>
    </select>

    <!-- Create a delete button that triggers the confirmation message -->
    <button action="../php/delete.php" method="GET" type="submit" onclick="return confirmDelete()">Borrar</button>

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

    $rutaXq = "../xq/eliminarCrypto.xq";
    $fichero = fopen($rutaXq, "r"); // Abrimos el fichero $rutaXq en modo lectura "r"
    $xq = fread($fichero, filesize($rutaXq)); // Leemos el contenido del fichero y lo guardamos en la variable $xq
    fclose($fichero); // Cerramos el fichero
    
    // create session
    $session = new Session();    
    // open database
    $session->execute("open criptomonedas"); // open y el nombre de la base de datos en el servidor BaseX
    // xquery
    $query = $session->query($xq);
    $query->bind('$nombre', $_GET["nombre"]);
    // execute result
    $result = $query->execute();
    // close query
    $query->close();
    // close session
    $session->close();

    // Show the result
    echo $result;
    
} catch(Exception $e) {

    echo $e->getMessage();

}

?> 