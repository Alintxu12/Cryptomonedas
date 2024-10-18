xquery version "3.1";

declare variable $nombre external;

let $documento := doc("C:/xampp/htdocs/criptomonedas/xml/criptomonedas.xml")
return
    if (exists($documento/database/Criptomonedas/Criptomoneda[Nombre = $nombre])) then
        (
        for $criptomoneda in $documento/database/Criptomonedas/Criptomoneda
        where $criptomoneda/Nombre = $nombre
        return
            (
           delete node $documento//Criptomoneda[Nombre = $nombre]
            )
        )
