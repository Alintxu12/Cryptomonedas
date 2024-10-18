xquery version "3.0";


	 
declare variable $nombre external := $nombre;
declare variable $precio external := $precio;


let $newCrypto :=
    <Criptomoneda id="{generate-id()}" released="true">
        <Nombre>{$nombre}</Nombre>
        <Precio>{$precio}</Precio>
    </Criptomoneda>

return
    insert nodes $newCrypto into doc ("C:/xampp/htdocs/criptomonedas/xml/criptomonedas.xml")/database/Criptomonedas