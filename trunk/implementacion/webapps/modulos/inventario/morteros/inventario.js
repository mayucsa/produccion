function consultarProducto(){
    $(document).ready(function() {
    $('#tProduct').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "serverSideproducto.php",
        "lengthMenu": [[13, 26], [13, 26]],
        // "order": [4, 'desc'],
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

function consultarMP(){
    $(document).ready(function() {
    $('#tMatPrim').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "serverSidemp.php",
        "lengthMenu": [[13, 26], [13, 26]],
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
                          // "data": 'creator',
                          "render": function ( data, type, row ) {
                          return row[1] +' '+ row[2] ;
                        }
                    }
                    ],
                    // [
                    //     {
                    //       "targets": 2,
                    //       "data": 'creator',
                    //       "render": function ( data, type, row ) {
                    //       return data.cantidad +' '+ data.unidad;
                    //     }
                    // ],

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

function consultarQuimico(){
    $(document).ready(function() {
    $('#tQuimico').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "serverSidequimico.php",
        "lengthMenu": [[6], [6]],
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



function mostrarProducto(){
    $.ajax({
        type:"POST",
        url:"ctrl_inventario.php",
        success:function(r){
            // $('#tMatPrima').hide();
            $('#tProducto').html(r);
            $('#tMatPrima').hide();
            $('#tQuimicos').hide();
            $('#tProducto').show();
        }
    });
}

function mostrarMatPrima(){
    $.ajax({
        type:"POST",
        url:"ctrl_inventario2.php",
        success:function(r){
            // $('#tProducto').hide();
            $('#tMatPrima').html(r);
            $('#tProducto').hide();
            $('#tQuimicos').hide();
            $('#tMatPrima').show();
            // document.getElementById('#tProducto').style.display = "hidden";
        }
    });
}

function mostrarQuimicos(){
    $.ajax({
        type:"POST",
        url:"ctrl_inventario3.php",
        success:function(r){
            // $('#tProducto').hide();
            $('#tQuimicos').html(r);
            $('#tProducto').hide();
            $('#tMatPrima').hide();
            $('#tQuimicos').show();
            // document.getElementById('#tProducto').style.display = "hidden";
        }
    });
}