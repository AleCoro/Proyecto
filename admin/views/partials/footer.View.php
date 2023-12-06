<footer class="main-footer">
  <div class="float-right d-none d-sm-block">
    <b>Version</b> 3.2.0
  </div>
  <strong>Copyright &copy; <?= "Curso " . date("Y") . " - " . (date("Y") + 1) . "&nbsp;&nbsp;&nbsp;&nbsp;"; ?> <a href="http://plataforma2.siges21.com/">DWES 2º DAW</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong> IES La Arboleda
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>

<!-- Cargamos nuestros scripts -->
<script src="views/js/scripts/charts.js"></script>
<script src="views/js/scripts/funciones.js"></script>

<!-- DataTables  & Plugins -->
<script src="views/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="views/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="views/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="views/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="views/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="views/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="views/plugins/jszip/jszip.min.js"></script>
<script src="views/plugins/pdfmake/pdfmake.min.js"></script>
<script src="views/plugins/pdfmake/vfs_fonts.js"></script>
<script src="views/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="views/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="views/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<script>
  $(function() {
    $("#example1").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "buttons": ["excel", "pdf", "print"],
      language: {
        processing: "Procesando...",
        search: "Buscar",
        lengthMenu: "Mostrar _MENU_ elementos",
        info: "Mostrando elementos del _START_ al _END_ de un total de _TOTAL_ elementos",
        infoEmpty: "No se encontraron elementos",
        infoFiltered: "(filtrado de un total de _MAX_ elementos)",
        infoPostFix: "",
        loadingRecords: "Cargando registros...",
        zeroRecords: "No se encontraron elementos",
        emptyTable: "No hay datos disponibles en la tabla",
        paginate: {
          first: "Primero",
          previous: "Anterior",
          next: "Siguiente",
          last: "Último"
        },
        aria: {
          sortAscending: ": activar para ordenar la columna de forma ascendente",
          sortDescending: ": activar para ordenar la columna de forma descendente"
        }
      }

    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });

  $(function() {
    $("#example2").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "buttons": ["excel", "pdf", "print"],
      language: {
        processing: "Procesando...",
        search: "Buscar",
        lengthMenu: "Mostrar _MENU_ elementos",
        info: "Mostrando elementos del _START_ al _END_ de un total de _TOTAL_ elementos",
        infoEmpty: "No se encontraron elementos",
        infoFiltered: "(filtrado de un total de _MAX_ elementos)",
        infoPostFix: "",
        loadingRecords: "Cargando registros...",
        zeroRecords: "No se encontraron elementos",
        emptyTable: "No hay datos disponibles en la tabla",
        paginate: {
          first: "Primero",
          previous: "Anterior",
          next: "Siguiente",
          last: "Último"
        },
        aria: {
          sortAscending: ": activar para ordenar la columna de forma ascendente",
          sortDescending: ": activar para ordenar la columna de forma descendente"
        }
      },
      "columnDefs": [{
        "render": function(data, type, row) {
          if (type === 'display' && data.length > 50) {
            // return data.substr(0, 50) + '<a href="#" class="expand">...Ver más</a>';
            return '<span class="oculto">' + data.substr(0, 50) + '</span>' +
              '<span class="entero" style="display:none;">' + data + '</span>' +
              '<a href="#" class="expandir"> Ver más...</a>';
          }
          return data;
        },
        "targets": [1, 2, 3] // El número de la columna donde está la descripción, empieza desde 0
      }]

    }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');
  });

  // Agregar funcionalidad al botón expandirir
  $('#example2 tbody').on('click', 'a.expandir', function(e) {
    e.preventDefault();
    var $cell = $(this).closest('td');
    var $entero = $cell.find('.entero');
    var $oculto = $cell.find('.oculto');
    var $expandir = $cell.find('.expandir');

    if ($oculto.css('display') !== 'none') {
      $oculto.hide();
      $entero.show();
      $expandir.text('Ver menos');
    } else {
      $oculto.show();
      $entero.hide();
      $expandir.text(' Ver más...');
    }
  });
</script>
</body>

</html>