<html>
	<script src="../js/sweetalert-dev.js"></script>
	<link href="../css/sweetalert.css" rel="stylesheet" type="text/css"/>
	<script src="../js/sweetalert.min.js"></script>
</html>
<?php
	if(!isset($_POST['idioma']))
	{
		require("../lib/permisosG.php");
		return;
	}
	$idioma=$_POST['idioma'];
	$nivel=$_POST['nivel'];

	if(empty($idioma))
	{
		echo'<script type="text/javascript">
					swal({
					title: "Error",
  					text: "El nombre del idioma es obligatorio.",
  					type: "error",
					},
					function(){
					    window.history.go(-1);
						window.location.href="Curri_Cursos.php";
					});
             	</script>';
	}
	elseif(empty($nivel))
	{
		echo'<script type="text/javascript">
					swal({
					title: "Error",
  					text: "El nivel es obligatorio.",
  					type: "error",
					},
					function(){
					    window.history.go(-1);
						window.location.href="Curri_Cursos.php";
					});
             	</script>';
	}
    else{
		session_start();
		$User=$_SESSION['cod_usuario'];

		include("../lib/conexion.php");
		$insert="insert into curri_idioma(fk_idioma, fk_nivel,fk_userIdioma) values(?,?,?)";
		$result=$conexion->prepare($insert);
		$result->execute(array($idioma,$nivel,$User));

		if(isset($result)){
			echo'<script type="text/javascript">
					swal({
					title: "Información",
  					text: "Idioma registrado exitosamente.",
  					type: "info",
					},
					function(){
						window.location.replace("';echo $rutaPrin."ModulE/Curri_Idiomas.php";echo'");
					});
             	</script>';
		}else{
			echo'<script type="text/javascript">
					swal({
					title: "Error",
  					text: "No se ha podido registrar este idioma, intente nuevamente.",
  					type: "error",
					},
					function(){
					    window.location.replace("';echo $rutaPrin."ModulE/Curri_Idiomas.php";echo'");
					});
             	</script>';
		}
	}
    //header("Location:../ModulC/curriculum.php");
?>
