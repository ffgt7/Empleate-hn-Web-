<?php
//require("../lib/permisosU.php");
$idusuario= $_GET['cod_usuario'];
$token= $_GET['token'];

$conexion= new PDO('mysql:host=localhost; dbname=empleo','root','');

$sql = "SELECT * FROM recu_empleo WHERE token= '$token' ";
$resultado = $conexion->prepare($sql);

$resultado->bindValue( ":token", $token );

$resultado->execute(array(":token"=>$token));

if($resultado->rowCount()>0){
	$usuario=$resultado->fetch(PDO::FETCH_ASSOC);
	//if(password_verify($idusuario,$usuario['cod_usuario']) && password_verify($token,$usuario['token'])){
	if(sha1($usuario["cod_usuario"]) === $idusuario){

?>
		<!DOCTYPE html>
		<html lang="es">

		<head>
			<meta name="author" content="denker">
			<title> Restablecer contraseña </title>
			<link href="../css/styleLogin.css" rel="stylesheet" type="text/css">
			<script src="../js/jquery.js"></script>
			<script src="../js/bootstrap.js"></script>
			<script src="../js/bootstrapValidator.js" type="text/javascript"></script>
			<script src="../js/validar_restablecer.js"></script>
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

			<link rel= "stylesheet" type="text/css" href="../js/dist/sweetalert.css">


			<script src= "../js/dist/sweetalert.min.js"></script>
		</head>

		<body>
			<!-- /container -->

			<div class="jumbotron" style="background-image: url('../img/1.jpg')">
				<div class="container">
					<div class="row">
						<div class="col-md-4"></div>
				  		<div class="col-sm-4">
							<div class="slider-box-appointment">
								<div class="header">
									<h3 class="heading font-2 text-center">Restaurar contraseña</h3>
								</div>
								<hr class="hr-2">
								<div class="body">

									<form id="formLogin" action="cambiarpassword.php" method="post">
										<div class="form-group">
											<input id="password" class="form-control" placeholder="Restaurar contraseña" type="password" name="password1">
										</div>
										<div class="form-group">
											  <input class="form-control" placeholder="Confirmar contraseña " name="password2" type="password">
										</div>
										<input type="hidden" name="token" value="<?php echo $token ?>">
										<input type="hidden" name="idusuario" value="<?php echo $idusuario ?>">
										<button class="btn btn-primary btn-block" type="submit" value="Recuperar contraseña">Restaurar contraseña</button>
									</form>

								</div>
							</div>
						</div>

						<div id="mensaje"></div>

						<div class="col-sm-4">
						</div>
					</div>
				</div>
			</div>

		</body>

		</html>
		<?php
			}else{
				header('Location:../ModulC/LoginUsuario.php');
			}
		}else{
			header('Location:../ModulC/LoginUsuario.php');
		}
		?>
