xquery version "3.1";

declare variable $nombre external;
declare variable $precio external;

let $documento := doc("C:/xampp/htdocs/criptomonedas/xml/criptomonedas.xml")
return
    if (exists($documento/database/Criptomonedas/Criptomoneda[Nombre = $nombre])) then
        (
        for $criptomoneda in $documento/database/Criptomonedas/Criptomoneda
        where $criptomoneda/Nombre = $nombre
        return
            (
            replace value of node $criptomoneda/Precio with $precio
            )
        )
