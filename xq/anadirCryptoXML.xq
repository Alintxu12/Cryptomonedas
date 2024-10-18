xquery version "3.0";

declare variable $nombre external := $nombre;
declare variable $precio external := $precio;

	 for $a in doc (../xml/criptomonedas.xml)

let $newCrypto :=
    <Criptomoneda id="{generate-id()}" released="true">
        <Nombre>{$nombre}</Nombre>
        <Precio>{$precio}</Precio>
    </Criptomoneda>
    