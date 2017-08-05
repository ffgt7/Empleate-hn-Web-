<?php
ob_start();
?>
<html>
	<script src="../js/sweetalert-dev.js"></script>
	<link href="../css/sweetalert.css" rel="stylesheet" type="text/css"/>
	<script src="../js/sweetalert.min.js"></script>
</html>
<?php
	if(!isset($_POST['Nomb_Empre']))
		{
			require("../lib/permisosG.php");
			return;
		}
	$nombEmpre=$_POST['Nomb_Empre'];
	$pais=$_POST['pais'];
	$actiEmpre=$_POST['Acti_Empre'];
	$puestCargo=$_POST['PuestCargo'];
	$cate=$_POST['Categoria'];
	$puest=$_REQUEST['PustoDesem'];
	$descripFuncio=$_POST['Descrip_Funcio'];
	$fechIni=$_POST['Fech_Ini'];
	$fechFin=$_POST['Fech_Fin'];

	if(empty($nombEmpre))
	{
		echo'<script type="text/javascript">
				swal({
					title: "Error",
  					text: "El nombre de la empresa es obligatorio!",
  					type: "error",
					},
					function(){
					    window.history.go(-1);
						window.location.href="Curri_ExperiLaboral.php";
					});
             </script>';
	}
	elseif(strlen($nombEmpre)<2)
	{
		echo'<script type="text/javascript">
				swal({
					title: "Error",
  					text: "El nombre de la empresa debe tener al menos 2 caracteres!",
  					type: "error",
					},
					function(){
					    window.history.go(-1);
						window.location.href="Curri_ExperiLaboral.php";
					});
             </script>';
	}
	elseif(strlen($nombEmpre)>100)
	{
		echo'<script type="text/javascript">
				swal({
					title: "Error",
  					text: "El nombre de la empresa debe tener maximo 100 caracteres!",
  					type: "error",
					},
					function(){
					    window.history.go(-1);
						window.location.href="Curri_ExperiLaboral.php";
					});
             </script>';
	}
	elseif(empty($pais))
	{
		echo'<script type="text/javascript">
				swal({
					title: "Error",
  					text: "Seleccione un país!",
  					type: "error",
					},
					function(){
					    window.history.go(-1);
						window.location.href="Curri_ExperiLaboral.php";
					});
             </script>';
	}
	elseif(empty($actiEmpre))
	{
		echo'<script type="text/javascript">
				swal({
					title: "Error",
  					text: "Seleccione una actividad!",
  					type: "error",
					},
					function(){
					    window.history.go(-1);
						window.location.href="Curri_ExperiLaboral.php";
					});
             </script>';

	}
    elseif(empty($puestCargo))
	{
		echo'<script type="text/javascript">
				swal({
					title: "Error",
  					text: "El nombre exacto del puesto o cargo desempeñado es obligatorio!",
  					type: "error",
					},
					function(){
					    window.history.go(-1);
						window.location.href="Curri_ExperiLaboral.php";
					});
             </script>';
	}
	elseif(strlen($puestCargo)<3)
	{
		echo'<script type="text/javascript">
				swal({
					title: "Error",
  					text: "El nombre exacto del puesto o cargo desempeñado debe tener al menos 3 caracteres!",
  					type: "error",
					},
					function(){
					    window.history.go(-1);
						window.location.href="Curri_ExperiLaboral.php";
					});
             </script>';
	}
	elseif(strlen($puestCargo)>50)
	{
		echo'<script type="text/javascript">
				swal({
					title: "Error",
  					text: "El nombre exacto del puesto o cargo desempeñado debe tener maximo 50 caracteres!",
  					type: "error",
					},
					function(){
					    window.history.go(-1);
						window.location.href="Curri_ExperiLaboral.php";
					});
             </script>';
	}
    elseif(empty($cate))
	{
		echo'<script type="text/javascript">
				swal({
					title: "Error",
  					text: "Seleccione una categoria!",
  					type: "error",
					},
					function(){
					    window.history.go(-1);
						window.location.href="Curri_ExperiLaboral.php";
					});
             </script>';
	}
    elseif(empty($puest))
	{
		echo'<script type="text/javascript">
				swal({
					title: "Error",
  					text: "Seleccione un puesto!",
  					type: "error",
					},
					function(){
					    window.history.go(-1);
						window.location.href="Curri_ExperiLaboral.php";
					});
             </script>';
	}
    elseif(empty($descripFuncio))
	{
		echo'<script type="text/javascript">
				swal({
					title: "Error",
  					text: "La descripción de las funciones en el puesto o cargo desempeñado es obligatoria!",
  					type: "error",
					},
					function(){
					    window.history.go(-1);
						window.location.href="Curri_ExperiLaboral.php";
					});
             </script>';
	}
	elseif(strlen($descripFuncio)<10)
	{
		echo'<script type="text/javascript">
				swal({
					title: "Error",
  					text: "La descripción de las funciones en el puesto o cargo desempeñado debe tener al menos 10 caracteres!",
  					type: "error",
					},
					function(){
					    window.history.go(-1);
						window.location.href="Curri_ExperiLaboral.php";
					});
             </script>';
	}
	elseif(strlen($descripFuncio)>255)
	{
		echo'<script type="text/javascript">
				swal({
					title: "Error",
  					text: "La descripción de las funciones en el puesto o cargo desempeñado debe tener maximo 255 caracteres!",
  					type: "error",
					},
					function(){
					    window.history.go(-1);
						window.location.href="Curri_ExperiLaboral.php";
					});
             </script>';
	}
    elseif(empty($fechIni))
	{
		echo'<script type="text/javascript">
				swal({
					title: "Error",
  					text: "La fecha de inicio es obligatoria!",
  					type: "error",
					},
					function(){
					    window.history.go(-1);
						window.location.href="Curri_ExperiLaboral.php";
					});
             </script>';
	}
    elseif(empty($fechFin))
	{
		echo'<script type="text/javascript">
				swal({
					title: "Error",
  					text: "La fecha de finalización es obligatoria!",
  					type: "error",
					},
					function(){
					    window.history.go(-1);
						window.location.href="Curri_ExperiLaboral.php";
					});
             </script>';
	}

	elseif($fechIni > $fechFin){

		echo'<script type="text/javascript">
					swal({
					title: "Error",
						text: "La fecha de inicio tiene que ser menor que la fecha de fin.",
						type: "error",
					},
					function(){
					    window.history.go(-1);
						window.location.href="Curri_Cursos.php";
					});
							</script>';

	}
    else{

		include("../lib/conexion.php");
		session_start();
		$User=$_SESSION['cod_usuario'];
		$insert="insert into curri_ExpeLabo(Nomb_Empre,fk_pais,fk_actividad,nomb_EscriPuesto,fk_categ,fk_puesto,descrip_Funcio,fech_IniTra,fech_FinTra,fk_userExpeLbo) values(?,?,?,?,?,?,?,?,?,?)";
		$result=$conexion->prepare($insert);
		$result->execute(array($nombEmpre,$pais,$actiEmpre,$puestCargo,$cate,$puest,$descripFuncio,$fechIni,$fechFin,$User));
		header("Location:Curri_ExperiLaboral.php");

	}
ob_end_flush();
?>
