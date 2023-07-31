function consultar(){
    $(document).ready(function() {
    $('#tableInveCurado').DataTable( {
        "dom": 'Bfrtip',
        "buttons": [
             {"extend": 'excel',"exportOptions": { columns: [0,1,2,3] }, "text": '<i class="far fa-file-excel"> Exportar en Excel</i>', "title": 'Inventario de cuartos de curado'}, 
             {"extend": 'pdf',"exportOptions": { columns: [0,1,2,3] },  "text": '<i class="far fa-file-pdf"> Exportar en PDF</i>', "title": 'Inventario de cuartos de curado'}, 
             {"extend": 'print',"exportOptions": { columns: [0,1,2,3] },  "text": '<i class="fas fa-print"> Imprimir</i>', "title": 'Inventario de cuartos de curado'},
             "pageLength",
        ],
        "processing": true,
        "serverSide": true,
        "ajax": "serverSideCurado.php",
        // "lengthMenu": [[15, 30, 45], [15, 30, 45]],
        // "order": [5, 'desc'],
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

function consultarmp(){
    $(document).ready(function() {
    $('#tableMprima').DataTable( {
        "dom": 'Bfrtip',
        "buttons": [
             {"extend": 'excel',"exportOptions": { columns: [0,1] }, "text": '<i class="far fa-file-excel"> Exportar en Excel</i>', "title": 'Inventario de materia prima Besser'}, 
             {"extend": 'pdf',"exportOptions": { columns: [0,1] },  "text": '<i class="far fa-file-pdf"> Exportar en PDF</i>', "title": 'Inventario de materia prima Besser'}, 
             {"extend": 'print',"exportOptions": { columns: [0,1] },  "text": '<i class="fas fa-print"> Imprimir</i>', "title": 'Inventario de materia prima Besser'},
             "pageLength",
        ],
        "processing": true,
        "serverSide": true,
        "ajax": "serverSidemp.php",
        // "lengthMenu": [[15, 30, 45], [15, 30, 45]],
        // "order": [5, 'desc'],
        // "destroy": true,
        "searching": true,
        // bSort: false,
        // "paging": false,
        // "searching": false,
        "bDestroy": true,
        "columnDefs":[
                        {
                            "targets": [1],
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