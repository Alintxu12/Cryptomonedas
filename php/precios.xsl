<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    
    <xsl:output method="html" omit-xml-declaration="yes" indent="yes"/>

    <xsl:template match="/">
        <html>
            <head>
                <title>Precios criptomonedas</title>
                <meta charset="utf-8" />
                <link rel="stylesheet" href="../html/style.css"/>
                <style>
                    /* Estilos CSS para hacer que los resultados se vean más grandes */
                    h2 {
                        font-size: 24px; /* Tamaño de fuente más grande */
                        font-weight: bold; /* Texto en negrita */
                        margin-bottom: 10px; /* Espacio inferior entre elementos */
                    }
                    table {
                        width: 100%;
                        border-collapse: collapse;
                    }
                    th, td {
                        padding: 8px;
                        text-align: left;
                        border-bottom: 1px solid #ddd;
                    }
                    tr:hover {
                        background-color: #f5f5f5;
                    }
                </style>
            </head>

            <body>
                <a id="top"></a>
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
                            <a href="../html/form_delete_crypto.html">Borra una criptomoneda</a>
                        </div>
                    </div>
                    <div class="dropdown">
                        <a href="../html/info.html">Preguntas</a>
                    </div>
                </div>
                <h1>Precios de las criptomonedas</h1>
                <table>
                    <tr>
                        <th>NOMBRE</th>
                        <th>PRECIO</th>
                        <th>IMAGEN</th>
                    </tr>
                    <xsl:for-each select="//Criptomoneda">
                        <tr>
                            <td><xsl:value-of select="Nombre"/></td>
                            <td><xsl:value-of select="Precio"/></td>
                            <td><img><xsl:attribute name="src">
                               <xsl:value-of select="imagen" />
                                </xsl:attribute>
                            </img>
                            </td>
                        </tr>
                    </xsl:for-each>
                </table>
                <footer>
                    <p>LMS Reto Final <a href="#top"> Back to top</a></p>
                </footer>
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
    </xsl:template>
    
</xsl:stylesheet>
