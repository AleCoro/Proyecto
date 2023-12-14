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

    $('#edit_id').val(alumno.id_usuario);
    $('#edit_usuario').val(alumno.usuario);
    $('#edit_nombre').val(alumno.nombre);
    $('#edit_apellidos').val(alumno.apellidos);
    $('#edit_direccion').val(alumno.direccion);
    $('#edit_telefono').val(alumno.telefono);
    $('#edit_email').val(alumno.email);
    $('#edit_fecha_nacimiento').val(alumno.fecha_nacimiento);

    $("#formularioEditarAlumnoModal").modal("show");

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

    $('#edit_id').val(area.id_area);
    $('#edit_nombre').val(area.nombre_area);
    $('#edit_descripcion').val(area.descripcion_area);

    document.getElementById('edit_previsualizarImg').src = area.portada_area;
    document.getElementById('edit_previsualizarImg').style.display = 'block';

    $("#formularioEditarAreaModal").modal("show");

}

function editarAsignatura(asignatura) {

    $('#edit_id').val(asignatura.id_asignatura);
    $('#edit_nombre').val(asignatura.nombre_asignatura);
    $('#edit_descripcion').val(asignatura.descripcion_asignatura);
    $('#edit_area').val(asignatura.area_academica);

    document.getElementById('edit_previsualizarImg').src = asignatura.portada_asignatura;
    document.getElementById('edit_previsualizarImg').style.display = 'block';

    $("#formularioEditarAsignaturaModal").modal("show");

}

function editarPost(post) {

    $('#edit_id').val(post.id_post);
    $('#edit_titulo').val(post.titulo);
    $('#edit_descripcion').val(post.descripcion);
    // document.getElementById('editor2').setData(post.contenido);
    campoImg = document.getElementById('edit_portada');

    editorElement = document.getElementById('editor2');
    if (editorElement && editorElement.editor) {
        // Si el editor ya existe, agrega el contenido adicional
        editorElement.editor.setData(post.contenido);
    } else {
        // Si no existe, crea uno nuevo y establece el contenido
        ClassicEditor
            .create(editorElement)
            .then(editor => {
                editor.setData(post.contenido);
                editorElement.editor = editor; // Almacena la instancia del editor para usos posteriores
            })
            .catch(error => {
                console.error(error);
                // En caso de error, establecer el contenido en el textarea directamente
                editorElement.value = post.contenido;
            });
    }

    campoImg.src = post.imagen;

    document.getElementById('edit_previsualizarImg').src = post.imagen;
    document.getElementById('edit_previsualizarImg').style.display = 'block';

    $("#formularioEditarPostModal").modal("show");

}

function previsualizarIMG(img, campo) {
    var file = img.files[0];
    if (file) {
        var reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById(campo).src = e.target.result;
            document.getElementById(campo).style.display = 'block';
        }
        reader.readAsDataURL(file);
    }
}

function mostrarIMG(img) {

    var imagenSrc = $(img).attr("src");
    $("#imagenGrande").attr("src", imagenSrc);
    $('#modalImagen').modal('show'); // Muestra el modal con la imagen grande

}

ClassicEditor
    .create(document.querySelector('#editor1'))
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
