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

function cargarAsignaturas(id_asignatura, id_area) {
    var areaAcademica = document.getElementById("areaAcademica");
    var asignaturas = document.getElementById("asignaturas");

    // Saco el valor de la asignatura y pongo a 0 el campo asignatura
    var id_area = areaAcademica.value;
    asignaturas.innerHTML = '';

    // Si el area esta vacio lo inicio con el valor %
    if (id_area == "" || id_area == "sinArea") { id_area = "%"; }

    // Hago la consulta
    var url = "views/js/consultas/cuadrosCombinados.php?area=" + id_area;
    xmlhttp.open("GET", url);
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4) {
            if (xmlhttp.status === 200) {
                var datos = JSON.parse(xmlhttp.responseText);

                // Creo el primer option
                var opcion = document.createElement("option");
                opcion.value = "SinAsignatura";
                opcion.textContent = "Selecciona";
                asignaturas.appendChild(opcion);

                // Luego recorro el resultado de la consulta y lo transformo en options
                datos.forEach(dato => {
                    var opcion = document.createElement("option");
                    opcion.value = dato.id_asignatura;
                    opcion.textContent = dato.nombre_asignatura;
                    asignaturas.appendChild(opcion);
                });

                if (id_asignatura) {
                    if (id_asignatura !== 'SinAsignatura') {
                        // Si existe id_asignatura lo selecciono
                        var optionToSelect = asignaturas.querySelector('option[value="' + id_asignatura + '"]');
                        optionToSelect.selected = true;
                    }
                    cargarProfesores(id_asignatura);
                }
            } else {
                alert(xmlhttp.statusText);
            }
        }
    };
    xmlhttp.send(null);
}

function cargarProfesores(id_asignatura) {
    
    var areaAcademica = document.getElementById("areaAcademica");
    var area = areaAcademica.value;

    if (area == "") { area = "%"; }
    if (id_asignatura == 'SinAsignatura') { id_asignatura = "%"; }

    var url = "views/js/consultas/cargarProfesores.php?area=" + area + "&asignatura=" + id_asignatura;
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

                //Aqui muestro los necesarios
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

function cargarCalendario(usuario) {
    var Calendar = FullCalendar.Calendar;
    var calendarEl = document.getElementById('calendarioReserva');

    var calendar = new Calendar(calendarEl, {
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        themeSystem: 'bootstrap',
        locale: 'es', // Establece el idioma a español
        firstDay: 1, // Para que empiece en lunes
        events: 'views/js/consultas/datosClasesListar.php?profesor=' + usuario,
        editable: false,
        droppable: false, // Esto es para colocar eventos en el calendario.

        eventClick: function (info) {

            if (info.event.backgroundColor == "#ff0000") {
                async function showSuccessAlert() {
                    await Swal.fire({
                        position: 'top-center',
                        icon: 'error',
                        title: 'Esta clase ya esta reservada',
                        showConfirmButton: false,
                        timer: 1400
                    });
                }
                showSuccessAlert();
            } else if (info.event.backgroundColor == "#A4A4A4") {
                async function showSuccessAlert() {
                    await Swal.fire({
                        position: 'top-center',
                        icon: 'error',
                        title: 'La fecha de esta clase ha expirado',
                        showConfirmButton: false,
                        timer: 1400
                    });
                }
                showSuccessAlert();
            } else {
                //Muestro el titulo
                $('#nombreAsignatura').text(info.event.title).val(info.event.title);
                //Formateo la fecha para mostrarla en el modal
                fecha = new Date(info.event.start);
                hora = fecha.toLocaleTimeString('es-ES', { hour: '2-digit', minute: '2-digit' });
                //Muestro la descripcion
                $('#descripcion').text("¿Desea reservar esta hora para " + info.event.title + " a las " + hora + "?");

                $('#id_asignatura').val(info.event.extendedProps.id_asignatura);
                $('#fecha_clase').val(info.event.start);
                $('#id_imparte').val(info.event.extendedProps.id_imparte);

                $('#modalReserva').modal('show');
            }
        }
    });


    calendar.render();
}

function cargarCalendarioMiPerfil(usuario) {
    var Calendar = FullCalendar.Calendar;
    var calendarEl = document.getElementById('calendarioMiPerfil');

    var calendar = new Calendar(calendarEl, {
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        themeSystem: 'bootstrap',
        locale: 'es', // Establece el idioma a español
        firstDay: 1, // Para que empiece en lunes
        events: 'views/js/consultas/datosClasesListar.php?profesor=' + usuario,
        editable: false,
        droppable: false, // Esto es para colocar eventos en el calendario.

        eventClick: function (info) {

            if (info.event.backgroundColor == "#ff0000") {
                async function showSuccessAlert() {
                    await Swal.fire({
                        position: 'top-center',
                        icon: 'error',
                        title: 'Esta clase ya esta reservada',
                        showConfirmButton: false,
                        timer: 1400
                    });
                }
                showSuccessAlert();
            } else if (info.event.backgroundColor == "#A4A4A4") {
                async function showSuccessAlert() {
                    await Swal.fire({
                        position: 'top-center',
                        icon: 'error',
                        title: 'La fecha de esta clase ha expirado',
                        showConfirmButton: false,
                        timer: 1400
                    });
                }
                showSuccessAlert();
            } else {
                //Muestro el titulo
                $('#nombreAsignatura').text(info.event.title).val(info.event.title);
                //Formateo la fecha para mostrarla en el modal
                fecha = new Date(info.event.start);
                hora = fecha.toLocaleTimeString('es-ES', { hour: '2-digit', minute: '2-digit' });
                fechaEdit = fecha.toISOString().split('T')[0];
                //Muestro la descripcion
                $('#descripcion').text("¿Desea editar la clase de " + info.event.title + " a las " + hora + "?");

                $('#edit_fecha').val(fechaEdit);
                $('#edit_hora').val(hora);
                $('#edit_precio').val(info.event.extendedProps.precio);
                $('#edit_id').val(info.event.extendedProps.id_imparte);

                $('#modaleditarClase').modal('show');
            }
        }
    });


    calendar.render();
}
