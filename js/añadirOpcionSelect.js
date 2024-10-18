document.addEventListener("DOMContentLoaded", function() {
    var selectSet = document.querySelector('select[name="selectCrypto"]');

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4) {
            if (this.status == 200) {
                var xmlDoc = this.responseXML;
                if (xmlDoc) {
                    var nombres = xmlDoc.querySelectorAll("Criptomoneda > Nombre");
                    if (nombres.length > 0) {
                        nombres.forEach(function(nombre) {
                            var option = document.createElement("option");
                            option.text = nombre.textContent;
                            selectCrypto.appendChild(option);
                        });
                        console.log("Criptomonedas cargadas exitosamente.");
                    } else {
                        console.error("No se encontraron elementos 'Nombre' dentro de 'Criptomoneda'.");
                    }
                } else {
                    console.error("No se pudo parsear el documento XML.");
                }
            } else {
                console.error("Error al cargar el archivo XML. Estado: " + this.status);
            }
        }
    };
    xmlhttp.open("GET", "../xml/criptomonedas.xml", true); 
    xmlhttp.send();
    
});
