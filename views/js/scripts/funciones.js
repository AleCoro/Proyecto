function getXMLHTTPRequest() {
    var obj = false;
    try {
        obj = new XMLHttpRequest();
    } catch (err1) {
        try {
            obj = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (err2) {
            try {
                obj = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (err3) {
                obj = false;
            }
        }
    }
    return obj;
}

var xmlhttp = getXMLHTTPRequest();

function cargarAsignaturas() {
    var areaAcademica = document.getElementById("areaAcademica");
    var asignaturas = document.getElementById("asignaturas");

    var area = areaAcademica.value;
    asignaturas.innerHTML = '';

    if (area !== "") {
        var url = "views/js/consultas/cuadrosCombinados.php?area=" + area;
        xmlhttp.open("GET", url);
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState === 4) {
                if (xmlhttp.status === 200) {
                    var datos = JSON.parse(xmlhttp.responseText);

                    var opcion = document.createElement("option");
                    opcion.value = "";
                    opcion.textContent = "Selecciona";
                    asignaturas.appendChild(opcion);

                    datos.forEach(dato => {
                        var opcion = document.createElement("option");
                        opcion.value = dato.id_asignatura;
                        opcion.textContent = dato.nombre_asignatura;
                        asignaturas.appendChild(opcion);
                    });

                } else {
                    alert(xmlhttp.statusText);
                }
            }
        };
        xmlhttp.send(null);
    }
}
