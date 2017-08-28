<?php
$password1 = htmlentities(addslashes($_POST['password1']));
$password2 = htmlentities(addslashes($_POST['password2']));
$idusuario = htmlentities(addslashes($_POST['idusuario']));
$token = htmlentities(addslashes($_POST['token']));

if($password1 != "" && $password2 != "" && $idusuario != "" && $token != ""){

	?>
		<!DOCTYPE html>
		<html lang="es">

		<head>
			<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<title> Restablecer contraseña </title>
			<script src="../js/jquery.js"></script>
			<script src="../js/bootstrap.js"></script>

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

			<link href="../css/styleLogin.css" rel="stylesheet" type="text/css">
			<link href="../css/style-blue.css" rel="stylesheet" />

			<script src="../js/sweetalert-dev.js"></script>
			<link href="../css/sweetalert.css" rel="stylesheet" type="text/css"/>
			<script src="../js/sweetalert.min.js"></script>


		</head>

		<body>
			<div class="container" role="main">
				<div class="col-md-2"></div>
				<div class="col-md-8" style="padding-top: 20px">
	<?php
                require("../lib/conexion.php");
				//$conexion= new PDO('mysql:host=localhost; dbname=empleo','root','');

				$sql = " SELECT * FROM recu_empleo WHERE token = :token ";
				$resultado = $conexion->prepare($sql);
				$resultado->execute(array(':token'=>$token));

				if ($resultado->rowCount()> 0){

					$usuario = $resultado->fetch(PDO::FETCH_ASSOC);
					//if(password_verify($idusuario, $usuario['cod_usuario'])){
					if(sha1($usuario['cod_usuario']) === $idusuario){
						if($password1 === $password2){
							$passwordCrip=password_hash($password1,PASSWORD_DEFAULT);
							$cod_empleo =$usuario['cod_usuario'];
							$sql = "UPDATE usuarios_empleo SET pass_empleo='$passwordCrip' WHERE cod_empleo=".$cod_empleo;
							$resultado = $conexion->prepare($sql);
							$resultado->execute(array());
							if($resultado){
								$sql = "DELETE FROM recu_empleo WHERE token = '$token'" ;
								$resultado=$conexion->prepare($sql);
								$resultado->execute(array());
?>
				<script>
					swal({
						title: "Información!",
						text: " La contraseña se actualizó con exito.",
						type: "info",
						confirmButtonText: "Aceptar"
					},
					function(){
					    window.history.go(-1);
						window.location.href="../ModulC/LoginUsuario.php";
					});
				</script>
<?php
							}else{
?>
				<script>
					swal({
						title: "Información!",
						text: " Ocurrió un error al actualizar la contraseña, intentelo más tarde.",
						type: "info",
						confirmButtonText: "Aceptar"
					},
					function(){
					    window.history.go(-1);
						window.location.href="../ModulC/LoginUsuario.php";
					});
				</script>
<?php
							}
						}else{
?>
				<script>
					swal({
						title: "Información!",
						text: " Las contraseñas no coinciden.",
						type: "info",
						confirmButtonText: "Aceptar"
					},
					function(){
					    window.history.go(-1);
						window.location.href="../ModulE/restablecer.php";
					});
				</script>
<?php
						}
					}else {
?>
				<script>
					swal({
						title: "Información!",
						text: "  El codigo de usuario no es válido.",
						type: "error",
						confirmButtonText: "Aceptar"
					},
					function(){
					    window.history.go(-1);
						window.location.href="../ModulE/restablecer.php";
					});
				</script>
<?php
					}
				}else{
?>
				<script>
					swal({
						title: "Información!",
						text: "  El token no es válido.",
						type: "error",
						confirmButtonText: "Aceptar"
					},
					function(){
					    window.history.go(-1);
						window.location.href="../ModulE/restablecer.php";
					});
				</script>
<?php
				}
?>
			</div>
			<div class="col-md-2"></div>
		</div>
		<!-- /container -->
	</body>
	</html>
<?php
}else{
	header( 'Location:../ModulE/restablecer.php' );
}
?>
