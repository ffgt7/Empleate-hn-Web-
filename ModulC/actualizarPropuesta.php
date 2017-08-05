<?php
ob_start();
?>
<html>
<?php 
    require "../lib/movil.php"; 
    include("../lib/config.php");
?>
	<script src="../js/sweetalert-dev.js"></script>
	<link href="../css/sweetalert.css" rel="stylesheet" type="text/css"/>
	<script src="../js/sweetalert.min.js"></script>
</html>
<?php
	
	require "../lib/conexion.php";
	if(!isset($_POST["nombre"]))
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
	$nombreP=$_POST["nombre"];
	$area=$_POST["area"];
	$cargo=$_POST["cargo"];
	$vacantes=$_POST["vacantes"];
	$tipo=$_POST["tipoCont"];
	$ubicacion=$_POST["departamentoV"];
	$departamento=$_POST["Depart_Usuario"];
	$municipio=$_POST["Muni_Usuario"];
	$salario=$_POST["salario"];
	$salario2=$_POST["salario2"];
	$caducidad=$_POST["caducidad"];
	$experienciaLab=$_POST["experienciaLab"];
	$titulo=$_POST["titulo"];
	$idioma=$_POST["idioma"];
	$nivel=$_POST["nivel"];
	$genero=$_POST["genero"];
	$edad=$_POST["edad"];
	$edad2=$_POST["edad2"];
	$vehiculo=$_POST["vehiculo"];
	$licencia=$_POST["tipoLicen"];
	$descripcion=$_POST["descripcion"];
	$descripcion2=$_POST["descripcion2"];
	$descripcion3=$_POST["descripcion3"];
	$cod=$_POST["cod"];
	
	
	
	$sql=("update propuesta set nombreP=?,tipoP=?,fk_experienciaP=?,generoP=?,edad=?,salarioP=?,vehiculoP=?,licenciaP=?,departamentoP=?,caducidadP=?,tituloP=?,descripcionP=?,vacantesP=?,fk_areaP=?,cargoP=?,edad2=?,
	salario2=?,descripcion2=?,descripcion3=?,fk_departamento=?,fk_municipio=?,fk_idioma=?,fk_nivelIdiom=? where cod_propuesta=?");
	
	$resultado=$conexion->prepare($sql);
	
	$resultado->execute(array($nombreP,$tipo,$experienciaLab,$genero,$edad,nvl($salario),$vehiculo,$licencia,$ubicacion,$caducidad,$titulo,$descripcion,$vacantes,$area,$cargo,$edad2,nvl($salario2),$descripcion2,$descripcion3,$departamento,$municipio,$idioma,$nivel,$cod)); 
	
	header("Location:perfil_empresa.php");  
	
	function nvl($valor){
			if($valor == "")
				return 0;
			else
				return $valor;
			
		}
ob_end_flush();	
?>
