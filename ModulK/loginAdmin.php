<!doctype html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=euc-jp">

<meta http-equiv="X-UA-Compatible" content="IE=edge">
<?php require("../lib/movil.php"); ?>
<title>Inicia Sesion</title>

<link href="../css/styleLogin.css" rel="stylesheet" type="text/css">
<script src="../js/jquery.js"></script>
<script src="../js/bootstrap.js"></script>
<script src="../js/bootstrapValidator.js" type="text/javascript"></script>

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

</head>

<body>
<?php
	require"../ModulC/na.php";
?>
	<div class="jumbotron">
		<div class="container">
			<div class="row">
		  		<div class="col-sm-4">
					<div class="slider-box-appointment" >
						<div class="header">
							<h3 class="heading font-2 text-center">Iniciar Sesion Administrador</h3>
						</div>
						<hr class="hr-2">
						<div class="body">
						
							<form id="formLogin" action="compruebaLoginAdmin1.php" method="POST">
								<div class="form-group">
									<input id="login" class="form-control" placeholder="Nombre de usuario" type="text" name="login">
								</div>
								<div class="form-group">
									  <input class="form-control" placeholder="Ingrese su contraseña" name="pass" type="password">
								</div>
								
								<button class="btn btn-primary btn-block" type="submit" value="Enviar">Iniciar sesion</button>
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
