function consultar(){
    $(document).ready(function() {
    $('#tablaCapturap').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "serverSideproduccion.php",
        "lengthMenu": [[15, 30, 45], [15, 30, 45]],
        "order": [3, 'desc'],
        // "destroy": true,
        "searching": true,
        // bSort: false,
        // "paging": false,
        // "searching": false,
        "bDestroy": true,
        "columnDefs":[
                        {
                            "targets": [1, 2, 3],
                            "className": 'dt-body-center' /*alineacion al centro th de tbody de la table*/
                        }
                    ],

     "language": {
         "lengthMenu": "Mostrar _MENU_ registros por página.",
         "zeroRecords": "No se encontró registro.",
         "info": "  _START_ de _END_ (_TOTAL_ registros totales).",
         "infoEmpty": "0 de 0 de 0 registros",
         "infoFiltered": "(Encontrado de _MAX_ registros)",
         "search": "Buscar: ",
         "processing": "Procesando...",
                  "paginate": {
             "first": "Primero",
             "previous": "Anterior",
             "next": "Siguiente",
             "last": "Último"
         }

     }

    } );
} );
}