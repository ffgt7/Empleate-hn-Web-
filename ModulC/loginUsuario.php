<?php
ob_start();
?>
<!doctype html>
<html>
<head>
<script language="javascript">
$(document).ready(function() {
   
   // Interceptamos el evento submit
    $('#form, #fat, #form1').submit(function() {
  // Enviamos el formulario usando AJAX
        $.ajax({
            type: 'POST',
            url: "compruebaLoginUsuario.php",
            data: $(this).serialize(),
            // Mostramos un mensaje con la respuesta de PHP
            success: function(data) {
                $('#result').html(data);
            }
        })        
        return false;
    }); 
})
// ]]></script>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<?php require("../lib/movil.php"); ?>
<title>Inicia Sesion Usuario</title>
<link href="../css/styleLogin.css" rel="stylesheet" type="text/css">
<script src="../js/jquery.js"></script>
<script src="../js/bootstrap.js"></script>
<script src="../js/bootstrapValidator.js" type="text/javascript"></script>
<script src="../js/validarLogin.js"></script>
<script src="../js/messages_es.js" type="text/javascript"></script>
<script src="../js/vegas/jquery.vegas.min.js"></script>
<script src="../js/jquery.easing.min.js"></script>
<script src="../js/source/jquery.fancybox.js"></script> 
<script src="../js/jquery.isotope.js"></script>
<script src="../js/appear.min.js"></script>
<script src="../js/animations.min.js"></script>
<script src="../js/custom2.js"></script>
<script src="../js/sweetalert-dev.js"></script>
<script src="../js/sweetalert.min.js"></script>
<link href="../css/bootstrap.css" rel="stylesheet" />
<link href="../css/ionicons.css" rel="stylesheet" />
<link href="../css/font-awesome.css" rel="stylesheet" />
<link href="../js/source/jquery.fancybox.css" rel="stylesheet" />
<link href="../css/animations.min.css" rel="stylesheet" />
<link href="../css/style-blue.css" rel="stylesheet" />
<link href="../css/sweetalert.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<?php
	require"na.php";
	$pag=$_SERVER['PHP_SELF'];
?>
<div class="jumbotron">
	<div class="container">
		<div class="row">
		  	<div class="col-sm-4">
				<div class="slider-box-appointment" >
					<div class="header">
						<h3 class="heading font-2 text-center">Iniciar Sesion</h3>
					</div>
					<hr class="hr-2">
					<div class="body">
						<form id="form1" action="compruebaLoginUsuario.php" method="post">
							<div class="form-group">
								<input id="login" class="form-control" placeholder="Nombre de usuario" type="text" name="login">
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Ingrese su contraseña" name="password" type="password">
							</div>
							<div class="form-group">
								<label for="checkbox">Recordar contraseña</label>
								<input type="checkbox" name="recordar" id="recordar" value="1">
							</div>
							<button class="btn btn-primary btn-block" type="submit" value="Enviar">Iniciar sesion</button>
							<a class="btn btn-info btn-block" href="../ModulE/form_registro.php" role="button">¿Olvidaste tu contraseña?</a>
							<input id="urlCod" name="urlCod" class="form-control" value="<?php if(isset($_GET['url2'])){ echo $_GET['url2']; } ?>" type=hidden>
						</form>
					</div>
				</div>
			</div>
			<div id="mensaje"></div>
				<div class="col-sm-8">
				</div>
			</div>
		</div>
	</div>
	</div>
</body>
</html>
