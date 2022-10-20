function consultar(){
    $(document).ready(function() {
    $('#tableBesser').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "serverSideBesser.php",
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

function consultarV(){
    $(document).ready(function() {
    $('#tableVibro').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "serverSideVibro.php",
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
                            "targets": [1, 2],
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

function consultarD(){
    $(document).ready(function() {
    $('#tableDespuntados').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "serverSideDespuntados.php",
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
                            "targets": [1, 2, 3, 4],
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

function consultarmpB(){
    $(document).ready(function() {
    $('#mpBesser').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "SSmpBesser.php",
        // "lengthMenu": [[13, 26], [13, 26]],
        // "order": [4, 'desc'],
        // "destroy": true,
        "searching": true,
        // bSort: false,
        // "paging": false,
        // "searching": false,
        "bDestroy": true,
        "columnDefs":[
                        {
                            "targets": 1,
                            "className": 'dt-body-center' /*alineacion al centro th de tbody de la table*/
                        },
                        {
                          "targets": 1,
                          "render": function ( data, type, row ) {
                          return row[1] +' '+ row[2] ;
                        }
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

function consultarmpV(){
    $(document).ready(function() {
    $('#mpVibro').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "SSmpVibro.php",
        // "lengthMenu": [[13, 26], [13, 26]],
        // "order": [4, 'desc'],
        // "destroy": true,
        "searching": true,
        // bSort: false,
        // "paging": false,
        // "searching": false,
        "bDestroy": true,
        "columnDefs":[
                        {
                            "targets": 1,
                            "className": 'dt-body-center' /*alineacion al centro th de tbody de la table*/
                        },
                        {
                          "targets": 1,
                          "render": function ( data, type, row ) {
                          return row[1] +' '+ row[2] ;
                        }
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