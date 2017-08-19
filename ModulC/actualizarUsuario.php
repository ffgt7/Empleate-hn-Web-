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
	if(!isset($_POST['Nomb_Usuario']))
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
	
	$nomb_user=$_POST['Nomb_Usuario'];
	$nombres=$_POST['NombUser'];
	$apellidos=$_POST['Apellidos_Usuario'];
	$fk_nacionalida=$_POST['Nacionalidad_Usuario'];
	$sexo=$_POST['Sexo_Usuario'];
	$fk_departamento=$_POST['Depart_Usuario'];
	$fk_municipio=$_REQUEST['Muni_Usuario'];
	$direccion=$_POST['Direcc_Usuario'];
	$tel_fijo=$_POST['TelFijo_Usuario'];
	$tel_movil=$_POST['TelMovil_Usuario'];
	$Pos_vehi=$_POST['Vehi_Usuario'];
	$Pos_moto=$_POST['Moto_Usuario'];
	$tipLicen=$_POST['TipLicen_Usuario'];
	$fech_Naci=$_POST['Naci_Usuario'];
	$descrip_userEmpleo=$_POST['Descrip_Usuario'];
	$email_user=$_POST['Correo_Usuario'];
	$cod=$_POST["cod"];
	$identidad=$_POST["identidadC"];
	
	$sql=("update usuarios_empleo set nomb_user=?, nombres=?, apellidos=?, fk_nacionalida=?, sexo=?, fk_departamento=?, 
            fk_municipio=?, direccion=?,tel_fijo=?, tel_movil=?, Pos_vehi=?, Pos_moto=?, email_user=?, Fech_Naci=?, 
            fk_TipoLicen=?, descrip_userEmpleo=?,identidadC=? 
           where cod_empleo=?");

	$resultado=$conexion->prepare($sql);
	
	$resultado->execute(array($nomb_user,$nombres,$apellidos,$fk_nacionalida,$sexo,$fk_departamento,$fk_municipio,
        $direccion,$tel_fijo,$tel_movil,$Pos_vehi,$Pos_moto,$email_user,$fech_Naci,$tipLicen,$descrip_userEmpleo,
        $identidad,$cod));

	header("Location:perfil_usuario.php");
ob_end_flush();
?>