 xquery version "3.1";

for $a in doc (criptomonedas)
return $a/database/Criptomonedas/Criptomoneda/Nombre/text()