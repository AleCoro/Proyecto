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

function editarAlumno(alumno) {
    $("#formularioEditarAlumnoModal").modal("show");

    $('#edit_id').val(alumno.id_usuario);
    $('#edit_usuario').val(alumno.usuario);
    $('#edit_nombre').val(alumno.nombre);
    $('#edit_apellidos').val(alumno.apellidos);
    $('#edit_direccion').val(alumno.direccion);
    $('#edit_telefono').val(alumno.telefono);
    $('#edit_email').val(alumno.email);
    $('#edit_fecha_nacimiento').val(alumno.fecha_nacimiento);

}

function editarProfesor(profesor) {
    $("#formularioEditarProfesorModal").modal("show");

    $('#edit_id').val(profesor.id_usuario);
    $('#edit_usuario').val(profesor.usuario);
    $('#edit_nombre').val(profesor.nombre);
    $('#edit_apellidos').val(profesor.apellidos);
    $('#edit_direccion').val(profesor.direccion);
    $('#edit_telefono').val(profesor.telefono);
    $('#edit_email').val(profesor.email);
    $('#edit_fecha_nacimiento').val(profesor.fecha_nacimiento);

}

function editarArea(area) {
    $("#formularioEditarAreaModal").modal("show");

    $('#edit_id').val(area.id_area);
    $('#edit_nombre').val(area.nombre_area);
    $('#edit_descripcion').val(area.descripcion_area);

}

function editarAsignatura(asignatura) {
    $("#formularioEditarAsignaturaModal").modal("show");

    $('#edit_id').val(asignatura.id_asignatura);
    $('#edit_nombre').val(asignatura.nombre_asignatura);
    $('#edit_descripcion').val(asignatura.descripcion_asignatura);

}

function editarPost(post) {
    $("#formularioEditarPostModal").modal("show");

    // $('#edit_id').val(alumno.id_usuario);
    // $('#edit_usuario').val(alumno.usuario);
    // $('#edit_nombre').val(alumno.nombre);
    // $('#edit_apellidos').val(alumno.apellidos);
    // $('#edit_direccion').val(alumno.direccion);
    // $('#edit_telefono').val(alumno.telefono);
    // $('#edit_email').val(alumno.email);
    // $('#edit_fecha_nacimiento').val(alumno.fecha_nacimiento);

}

function CargarEditor() {
    // ClassicEditor.create(document.querySelector('#editor'))
    // .then(editor => {
    //     const maxLength = 500; // Establece el límite de caracteres

    //     editor.model.document.on('change:data', () => {
    //         const texto = editor.getData().replace(/<[^>]*>/g, ''); // Elimina etiquetas HTML para contar solo el texto
    //         const caracteresActuales = texto.length;

    //         if (caracteresActuales > maxLength) {
    //             const textoRecortado = texto.substring(0, maxLength);
    //             editor.setData(textoRecortado);
    //         }
    //     });
    // })
    // .catch(error => {
    //     console.error(error);
    // });

    ClassicEditor
    .create(document.querySelector('#editor'))
    .then(editor => {
        const maxLength = 500; // Establece el límite de caracteres

        editor.model.document.on('change:data', () => {
            const texto = editor.getData().replace(/<[^>]*>/g, ''); // Elimina etiquetas HTML para contar solo el texto
            const caracteresActuales = texto.length;

            if (caracteresActuales > maxLength) {
                const textoRecortado = texto.substring(0, maxLength);
                editor.setData(textoRecortado);
            }
        });
    })
    .catch(error => {
        console.error(error);
    });
}
