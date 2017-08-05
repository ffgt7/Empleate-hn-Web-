<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<?php require "../lib/movil.php"; ?>
<title>Inicio Sesión como Empresa</title>
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
<link href="../css/bootstrap.css" rel="stylesheet" />
<link href="../css/ionicons.css" rel="stylesheet" />
<link href="../css/font-awesome.css" rel="stylesheet" />
<link href="../js/source/jquery.fancybox.css" rel="stylesheet" />
<link href="../css/animations.min.css" rel="stylesheet" />
<link href="../css/style-blue.css" rel="stylesheet" />

<script src="../js/sweetalert-dev.js"></script>
<link href="../css/sweetalert.css" rel="stylesheet" type="text/css"/>
<script src="../js/sweetalert.min.js"></script>

</head>

<body>
<?php
	require"na.php";
?>
	<div class="jumbotron" style="background-image: url('../img/1.jpg')">
		<div class="container">
			<div class="row">
		  		<div class="col-sm-4">
					<div class="slider-box-appointment" >
						<div class="header">
							<h3 class="heading font-2 text-center">Iniciar Sesión Empresa</h3>
						</div>
						<hr class="hr-2">
						<div class="body">

							<form id="formLogin" action="comprueba_login.php" method="post">
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
								<a class="btn btn-info btn-block" href="form_registro_empre.php" role="button">¿Olvidaste tu contraseña?</a>
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

</body>
</html>
