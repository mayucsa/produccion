<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Producci&oacute;n</title>

	<link rel="stylesheet" type="text/css" href="includes/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="includes/css/css-login.css">

	<!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
	<script src="includes/js/jquery351.min.js"></script>

	<!-- <script src="includes/js/jquery.min.js"></script> -->
	<script src="includes/bootstrap/js/bootstrap.js"></script>
	<script src="includes/bootstrap/js/bootstrap.min.js"></script>
	<!-- <script src="includes/js/utileria.js"></script> -->
	<script src="index.js"></script>
	<link rel="icon" href="includes/imagenes/favicon.png">
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-4 offset-md-4">
				<form class="box p-4 text-center" onsubmit="return false" method="post" autocomplete="off">
					<h1>Producci&oacute;n</h1>
					<p class="text-muted"> Acceda con su número de empleado</p>
					<label>Usuario</label>
					<input type="text" class="form-control" name="p_usuario" id="p_usuario" placeholder="Número de empleado">
					<label class="mt-4">
						Contraseña 
						<a href="javascript:muestrapass()" id="hidePass">
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
							  <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
							  <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
							</svg>
						</a>
						<a href="javascript:muestrapass()" id="showPass" style="display:none;">
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-slash" viewBox="0 0 16 16">
							  <path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7.028 7.028 0 0 0-2.79.588l.77.771A5.944 5.944 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755-.165.165-.337.328-.517.486l.708.709z"/>
							  <path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829l.822.822zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829z"/>
							  <path d="M3.35 5.47c-.18.16-.353.322-.518.487A13.134 13.134 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7.029 7.029 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12-.708.708z"/>
							</svg>
						</a>
					</label>
					<input type="password" class="form-control" name="p_password" id="p_password" placeholder="Contraseña">
					<!-- <a class="forgot text-muted" href="#">¿Has olvidado su contraseña?</a> -->
					<button class="btn btn-dark mt-4" onclick="iniciarSesion()">
						Acceso
					</button>
					<!-- <button class="btn btn-primary" onclick="iniciarSesion('p_usuario', 'p_password')"> Acceso</button> -->
					<img class="img-fluid" src="includes/imagenes/Mayucsap.png">
				</form>
			</div>
		</div>
	</div>
	<div class="modal fade" id="myLoading" tabindex="-3" data-backdrop="static" data-keyboard="false" style="padding-top:20%; overflow-y:visible;" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div align="center"><img src="includes/imagenes/loading3.gif" width="140px"></div>
		<div id="divtextloading" align="center" style="font-weight:bold; font-size:20px; color:#FFFFFF">Espere un momento...</div>
	</div>

	<div class="modal fade" id="modalMensajes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="padding-top:10%; overflow-y:visible;" >
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header modal-danger">
					<h5 class="modal-title" id="encabezadoModal"></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body" id="cuerpoModal"></div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Aceptar</button>
				</div>
			</div>
		</div>
	</div>
</body>
</html>