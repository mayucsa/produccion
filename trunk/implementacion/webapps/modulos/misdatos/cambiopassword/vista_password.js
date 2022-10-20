function limpiarCampos() {
    $('#inputnueva').val("");
    $('#inputconfirmar').val("");
}
 function validacion() {
    var nueva       = $('#inputnueva').val();
    var confirmar   = $('#inputconfirmar').val();
    var msj = "";

    if (nueva == "") {
        msj += '<li>Nueva contraseña</li>';
    }   
    if (confirmar == "") {
        msj += '<li>Confirmar contraseña</li>';
    }   
    if (msj.length != 0) {
        $('#encabezadoModal').html('Validación de datos');
        $('#cuerpoModal').html('Los siguientes campos son obligatorios:<ul>'+msj+'</ul>');
        $('#modalMensajes').modal('toggle');

    } else{
        comprobacion();
    }
 }

 //  function comprobacion() {
 //    var nueva       = $('#inputnueva').val();
 //    var confirmar   = $('#inputconfirmar').val();
 //    // arr = [];
 //    // var msj = "";

 //    if (nueva !== confirmar ) {
 //        // msj += '<li>La nueva contraseña y su confirmación no coinciden</li>';
 //        $('#encabezadoModal').html('Validación de datos');
 //        $('#cuerpoModal').html('La nueva contraseña y su confirmación no coinciden');
 //        $('#modalMensajes').modal('toggle');
 //    }      
 //    // if (msj.length != 0) {
 //    //     $('#encabezadoModal').html('Validación de datos');
 //    //     $('#cuerpoModal').html('Los siguientes campos son obligatorios:<ul>'+msj+'</ul>');
 //    //     $('#modalMensajes').modal('toggle');

 //    // }
 // }

   function comprobacion() {
    var divInp  = "[data-label]", lbl = "", arr = [], msg = "";

    if ( arr[1] !== arr[2] ) //lbl = "<li>La nueva contraseña y su confirmación no coinciden.</li>"//
        $('#encabezadoModal').html('Validación de datos');
        $('#cuerpoModal').html('<li>La nueva contraseña y su confirmación no coinciden.</li>');
        $('#modalMensajes').modal('toggle');
    else
        actualizacionpassword();
    
 }