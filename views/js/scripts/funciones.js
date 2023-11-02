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

function cargarAsignaturas(profesor) {
    var areaAcademica = document.getElementById("areaAcademica");
    var asignaturas = document.getElementById("asignaturas");

    var area = areaAcademica.value;
    asignaturas.innerHTML = '';

    if (area == "") { area = "%"; }

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

                if (profesor) {
                    if (profesor !== true) {
                        // alert(profesor);
                        // var optionToSelect = asignaturas.querySelector('option[value=' + profesor + ']');
                        // optionToSelect.selected = true;
                    }
                    cargarProfesores(profesor);
                }
            } else {
                alert(xmlhttp.statusText);
            }
        }
    };
    xmlhttp.send(null);
}

function cargarProfesores(asignatura) {
    var areaAcademica = document.getElementById("areaAcademica");

    var area = areaAcademica.value;

    if (area == "") { area = "%"; }
    if (asignatura == true) { asignatura = "%"; }

    var url = "views/js/consultas/cargarProfesores.php?area=" + area + "&asignatura=" + asignatura;
    xmlhttp.open("GET", url);
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4) {
            if (xmlhttp.status === 200) {

                // Saco los cards
                var cards = document.querySelectorAll('[id^="card_"]');

                // Recorre los cards y los oculto
                cards.forEach(card => {
                    card.classList.remove("d-flex");
                    card.classList.add("d-none");
                });

                profesores = JSON.parse(xmlhttp.responseText);

                profesores.forEach(profesor => {
                    // alert(profesor.id_usuario);
                    card_profesor = document.getElementById("card_" + profesor.id_usuario);
                    card_profesor.classList.remove("d-none");
                    card_profesor.classList.add("d-flex");
                });

            } else {
                alert(xmlhttp.statusText);
            }
        }
    };
    xmlhttp.send(null);
}
