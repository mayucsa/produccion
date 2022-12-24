function consultarProducto(){
        var table;
        $(document).ready(function() {
        table = $('#tProduct').DataTable( {
            "dom": 'Bfrtip',
            "buttons": [
                 {"extend": 'excel',"text": '<i class="far fa-file-excel"> Exportar en Excel</i>', "title": 'Inventario Morteros'}, 
                 {"extend": 'pdf', "text": '<i class="far fa-file-pdf"> Exportar en PDF</i>', "title": 'Inventario Morteros'}, 
                 {"extend": 'print', "text": '<i class="fas fa-print"> Imprimir</i>', "title": 'Inventario Morteros'},
                 "pageLength",
            ],
            "processing": true,
            "serverSide": true,
            "ajax": "serverSideproducto.php",
            // "lengthMenu": [[15, 30, 50, 100], [15, 30, 50, 100]],
            "pageLength": 50,
            "order": [0, 'asc'],
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
            "buttons": {
                        "pageLength": {
                            '_': "Mostrar %d registros por página.",
                        }
                    },
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

        /*===================================================================*/
        // EVENTOS PARA CRITERIOS DE BUSQUEDA (PRODUCTO Y PRESENTACIÓN)
        /*===================================================================*/

        $("#iptNombre").keyup(function(){
            table.column($(this).data('index')).search(this.value).draw();
            })
        $("#iptPresentacion").keyup(function(){
            table.column($(this).data('index')).search(this.value).draw();
            })

}

function consultarMP(){
//     $(document).ready(function() {
//     $('#tMatPrim').DataTable( {
//         "processing": true,
//         "serverSide": true,
//         "ajax": "serverSidemp.php",
//         "lengthMenu": [[13, 26], [13, 26]],
//         // "order": [4, 'desc'],
//         // "destroy": true,
//         "searching": true,
//         // bSort: false,
//         // "paging": false,
//         // "searching": false,
//         "bDestroy": true,
//         "columnDefs":[
//                         {
//                             "targets": 1,
//                             "className": 'dt-body-center' /*alineacion al centro th de tbody de la table*/
//                         },
//                         {
//                           "targets": 1,
//                           // "data": 'creator',
//                           "render": function ( data, type, row ) {
//                           return row[1] +' '+ row[2] ;
//                         }
//                     }
//                     ],
//                     // [
//                     //     {
//                     //       "targets": 2,
//                     //       "data": 'creator',
//                     //       "render": function ( data, type, row ) {
//                     //       return data.cantidad +' '+ data.unidad;
//                     //     }
//                     // ],

//      "language": {
//          "lengthMenu": "Mostrar _MENU_ registros por página.",
//          "zeroRecords": "No se encontró registro.",
//          "info": "  _START_ de _END_ (_TOTAL_ registros totales).",
//          "infoEmpty": "0 de 0 de 0 registros",
//          "infoFiltered": "(Encontrado de _MAX_ registros)",
//          "search": "Buscar: ",
//          "processing": "Procesando...",
//                   "paginate": {
//              "first": "Primero",
//              "previous": "Anterior",
//              "next": "Siguiente",
//              "last": "Último"
//          }

//      }

//     } );
// } );
        var table;
        $(document).ready(function() {
        table = $('#tMatPrim').DataTable( {
            "dom": 'Bfrtip',
            "buttons": [
                 {"extend": 'excel',"text": '<i class="far fa-file-excel"> Exportar en Excel</i>', "title": 'Inventario Morteros'}, 
                 {"extend": 'pdf', "text": '<i class="far fa-file-pdf"> Exportar en PDF</i>', "title": 'Inventario Morteros'}, 
                 {"extend": 'print', "text": '<i class="fas fa-print"> Imprimir</i>', "title": 'Inventario Morteros'},
                 "pageLength",
            ],
            "processing": true,
            "serverSide": true,
            "ajax": "serverSidemp.php",
            // "lengthMenu": [[15, 30, 50, 100], [15, 30, 50, 100]],
            "pageLength": 50,
            "order": [0, 'asc'],
            // "destroy": true,
            "searching": true,
            // bSort: false,
            // "paging": false,
            // "searching": false,
            "bDestroy": true,
        "columnDefs":[
                        {
                            "targets": [0, 1, 2],
                            "className": 'dt-body-center' /*alineacion al centro th de tbody de la table*/
                        },
                        {
                          "targets": 2,
                          // "data": 'creator',
                          "render": function ( data, type, row ) {
                          return row[2] +' '+ row[3] ;
                        }
                    }
                    ],
         "language": {
            "buttons": {
                        "pageLength": {
                            '_': "Mostrar %d registros por página.",
                        }
                    },
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

        /*===================================================================*/
        // EVENTOS PARA CRITERIOS DE BUSQUEDA (PRODUCTO Y PRESENTACIÓN)
        /*===================================================================*/

        $("#iptCodigo").keyup(function(){
            table.column($(this).data('index')).search(this.value).draw();
            })
        $("#iptNombremp").keyup(function(){
            table.column($(this).data('index')).search(this.value).draw();
            })
}