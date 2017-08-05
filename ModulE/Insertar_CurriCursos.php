<html>
	<script src="../js/sweetalert-dev.js"></script>
	<link href="../css/sweetalert.css" rel="stylesheet" type="text/css"/>
	<script src="../js/sweetalert.min.js"></script>
</html>
<?php
    include("../lib/config.php");
	if(!isset($_POST['NombreCurso']))
	{
		require("../lib/permisosG.php");
		return;
	}
	$nombCurso=$_POST['NombreCurso'];
	$nombEmpre=$_POST['NombreEmpresa'];
	$pais=$_POST['pais'];
	$fechIni=$_POST['Fech_Ini'];
	$fechFin=$_POST['Fech_Fin'];

	if(empty($nombCurso))
	{
		echo'<script type="text/javascript">
					swal({
					title: "Error",
  					text: "El nombre del curso es obligatorio.",
  					type: "error",
					},
					function(){
					    window.history.go(-1);
						window.location.href="Curri_Cursos.php";
					});
             	</script>';
	}
	elseif(strlen($nombCurso)<2)
	{
		echo'<script type="text/javascript">
					swal({
					title: "Error",
  					text: "El nombre del curso debe tener al menos 2 caracteres.",
  					type: "error",
					},
					function(){
					    window.history.go(-1);
						window.location.href="Curri_Cursos.php";
					});
             	</script>';
	}
	elseif(strlen($nombCurso)>50)
	{
		echo'<script type="text/javascript">
					swal({
					title: "Error",
  					text: "El nombre del curso debe tener maximo 50 caracteres.",
  					type: "error",
					},
					function(){
					    window.history.go(-1);
						window.location.href="Curri_Cursos.php";
					});
             	</script>';
	}
	elseif(empty($nombEmpre))
	{
		echo'<script type="text/javascript">
					swal({
					title: "Error",
  					text: "El nombre del curso es obligatorio.",
  					type: "error",
					},
					function(){
					    window.history.go(-1);
						window.location.href="Curri_Cursos.php";
					});
             	</script>';
	}
	elseif(strlen($nombEmpre)<2)
	{
		echo'<script type="text/javascript">
					swal({
					title: "Error",
  					text: "El nombre de la empresa o institución debe tener al menos 2 caracteres.",
  					type: "error",
					},
					function(){
					    window.history.go(-1);
						window.location.href="Curri_Cursos.php";
					});
             	</script>';
	}
	elseif(strlen($nombEmpre)>100)
	{
		echo'<script type="text/javascript">
					swal({
					title: "Error",
  					text: "El nombre de la empresa o institución debe tener maximo 100 caracteres.",
  					type: "error",
					},
					function(){
					    window.history.go(-1);
						window.location.href="Curri_Cursos.php";
					});
             	</script>';
	}
	elseif(empty($pais))
	{
		echo'<script type="text/javascript">
					swal({
					title: "Error",
  					text: "Seleccione un país.",
  					type: "error",
					},
					function(){
					    window.history.go(-1);
						window.location.href="Curri_Cursos.php";
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
					window.location.href="Curri_Cursos.php";
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
					window.location.href="Curri_Cursos.php";
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

		$insert="insert into curri_cursos(Nomb_curso, Nomb_Empre, fk_pais,fech_IniTra,fech_FinTra,fk_userCursos) values(?,?,?,?,?,?)";
		$result=$conexion->prepare($insert);
		$result->execute(array($nombCurso,$nombEmpre,$pais,$fechIni,$fechFin,$User));

		if(isset($result)){
			echo'<script type="text/javascript">
					swal({
					title: "Información",
  					text: "Curso registrado exitosamente.",
  					type: "info",
					},
					function(){
						window.location.replace("';echo $rutaPrin."ModulE/Curri_Cursos.php";echo'");
						
					});
             	</script>';
		}else{
			echo'<script type="text/javascript">
					swal({
					title: "Error",
  					text: "No se ha podido registrar el curso, intente nuevamente.",
  					type: "error",
					},
					function(){
					    window.location.replace("';echo $rutaPrin."ModulE/Curri_Cursos.php";echo'");
					});
             	</script>';
		}
	}
    //header("Location:../ModulC/Curriculum.php");
?>
