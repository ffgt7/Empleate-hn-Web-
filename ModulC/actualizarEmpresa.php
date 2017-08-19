<?php
ob_start();
?>
<html>
<?php require "../lib/movil.php"; ?>
	<script src="../js/sweetalert-dev.js"></script>
	<link href="../css/sweetalert.css" rel="stylesheet" type="text/css"/>
	<script src="../js/sweetalert.min.js"></script>
</html>
<?php
	require "../lib/conexion.php";
	include("../lib/config.php");
	if(!isset($_POST["NombreTextBox"]))
	{
		echo'<script type="text/javascript">
					swal({
					title: "Error",
  					text: "No se puede acceder a esta sección",
  					type: "error",
					},
					function(){
						window.location.replace("';echo $rutaPrin."index.php";echo'");
					});
             	</script>';
				return;
	}

	$nombUser=$_POST["NombreTextBox"];
	$nombEmpre=$_POST["NombEmpresa"];
	$email=$_POST["Correo"];
	$tel=$_POST["Num_Tel"];
	$pagWeb=$_POST["Pag_web"];
	$rubro=$_POST["Rub_Empre"];
	$descripcion=$_POST["Descrip_Empre"];
	$cod=$_POST["cod"];

	$sql=("update usuarios_empre set nomb_usuario=:miUsuario, nomb_empre=:miNombreEmpresa, email=:miEmail, 
            num_tel=:miNum, web_site=:miWeb, fk_rubro=:miRubro, descripcion=:miDescripcion 
           where cod_usuario=:miCod");

	$resultado=$conexion->prepare($sql);
	
	$resultado->execute(array("miCod"=>$cod, "miUsuario"=>$nombUser, "miNombreEmpresa"=>$nombEmpre, "miEmail"=>$email,
        "miNum"=>$tel, "miWeb"=>$pagWeb, "miRubro"=>$rubro, "miDescripcion"=>$descripcion));

	header("Location:perfil_empresa.php");
ob_end_flush();	
?>