<html>
<?php require "../lib/movil.php"; ?>
	<link rel= "stylesheet" type="text/css" href="../js/dist/sweetalert.css">
	<script src= "../js/dist/sweetalert.min.js"></script>
</html>

<?php
    include("../lib/config.php");
	if(!isset($_FILES['file_Usuario']['name']))
	{
		require("../lib/permisosG.php");
		return;
	}
	$nombreFile=$_FILES['file_Usuario']['name'];
	$tipoFile=$_FILES['file_Usuario']['type'];
	$tamFile=$_FILES['file_Usuario']['size'];
	if($tamFile!=""){
		if($tamFile<=3145728 and $tamFile>=1){
			if($tipoFile=="application/docx" || $tipoFile=="application/pdf" || $tipoFile=="application/doc"){
				$ruta=$_SERVER['DOCUMENT_ROOT'].'/PruebaEmpleo/tem_curri/';
				move_uploaded_file($_FILES['file_Usuario']['tmp_name'],$ruta.$nombreFile);

				include("../lib/conexion.php");

				session_start();
				$User=$_SESSION['cod_usuario'];

				$insert="insert into curri_digital(curri_digital,fk_userCurri) values(?,?)";
				$result=$conexion->prepare($insert);
				$result->execute(array($nombreFile,$User));

				header("Location:../ModulC/Curriculum.php");

			}
			else{
				echo'<script type="text/javascript">
						swal({
						title: "Error",
  						text: "Solo se admiten archivos en los formatos docx/doc/pdf!",
  						type: "error",
						},
						function(){
						    window.history.go(-1);
							window.location.href="../ModulC/Curriculum.php";
						});
             		</script>';
			}
		}
		else{
			echo'<script type="text/javascript">
					swal({
					title: "Error",
  					text: "Tamaño del archivo demasiado grande!, debe de ser menor o igual de 3MB.",
  					type: "error",
					},
					function(){
					    window.history.go(-1);
						window.location.href="../ModulC/Curriculum.php";
					});
           		 </script>';
		}
	}

?>
