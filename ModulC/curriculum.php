<?php
ob_start();
?>
<!doctype html>
<html>
<head>
<?php require("../lib/movil.php"); ?>
<meta charset="utf-8">
<title>Curriculum</title>

<link id="theme-style" rel="stylesheet" href="../css/styles-6.css">
<link rel="stylesheet" href="../css/w3.css">

<script src="../js/jquery.js"></script>
<script src="../js/fileinput.js" type="text/javascript"></script>
<script src="../js/fileinput.min.js" type="text/javascript"></script>
<script src="../js/bootstrap.js"></script>
<script src="../js/bootstrapValidator.js" type="text/javascript"></script>
<script src="../js/messages_es.js" type="text/javascript"></script>
<script src="../js/vegas/jquery.vegas.min.js"></script>
<script src="../js/jquery.easing.min.js"></script>
<script src="../js/source/jquery.fancybox.js"></script>
<script src="../js/jquery.isotope.js"></script>
<script src="../js/appear.min.js"></script>
<script src="../js/animations.min.js"></script>
<script src="../js/customs.js"></script>
<link href="../css/bootstrap.css" rel="stylesheet" />
<link href="../css/fileinput.css" rel="stylesheet" type="text/css"/>
<link href="../css/fileinput.min.css" rel="stylesheet" type="text/css"/>
<link href="../css/ionicons.css" rel="stylesheet" />
<link href="../css/font-awesome.css" rel="stylesheet" />
<link href="../js/source/jquery.fancybox.css" rel="stylesheet" />
<link href="../css/animations.min.css" rel="stylesheet" />
<link href="../css/style-blue.css" rel="stylesheet" />

<style>
	.text{
		color: white;
	}

	.imagen{
		height:200px;
		width:300px;
	}
</style>

<script>
	var openTab = document.getElementById("firstTab");
	openTab.click();
</script>

</head>
<body>
<?php
	require ("navCurri.php");
	if(!isset($_SESSION["cod_usuario"]))
	{
		$host=$_SERVER["HTTP_HOST"];
		$url=$_SERVER["REQUEST_URI"];
		$dire="http://" . $host . $url;
		echo '<script>
				window.location.href="../lib/permisosu.php'; echo '?url=';echo $dire;echo '";
			</script>';
		return;

	}

?>

<!--SERVICE SECTION START-->
<section id="services" >
	<div class="container">
		<div class="row text-center header">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 animate-in" data-anim-type="fade-in-up">
				<h3>CURRICULUM</h3>
				<center><hr /></center>
				<a href="javascript:void(0)" class="btn btn-info"
					onclick="document.getElementById('id02').style.display='block'">Subir CV Digital</a>
			</div>
		</div>
	</div>

	<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
		<div class="services-wrapper">
			<a href="../ModulK/educacion.php"><i class="ion-document"></i></a>
			<h3>Formacion Academica</h3>
		</div>
	</div>

	<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
		<div class="services-wrapper">
			<a href="../ModulF/Curri_ExperiLaboral.php"><i class="ion-document"></i></a>
			<h3>Experiencia Laboral</h3>
		</div>
	</div>

	<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
		<div class="services-wrapper">
			<a href="../ModulE/Curri_Cursos.php"><i class="ion-document"></i></a>
				<h3>Cursos</h3>
		</div>
	</div>

	<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
		<div class="services-wrapper">
			<a href="../ModulE/Curri_Idiomas.php"><i class="ion-document"></i></a>
				<h3>Idiomas</h3>
		</div>
	</div>

	<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
		<div class="services-wrapper">
			<a href="../ModulK/referencia.php"><i class="ion-document"></i></a>
				<h3>Referencias</h3>
			</div>
	</div>
	
	<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
		<div class="services-wrapper">
			<a href="../ModulF/habilidades.php"><i class="ion-document"></i></a>
				<h3>Habilidades Técnicas</h3>
		</div>
	</div>

		</div>
	</div>

</section>

<div id="id02" class="w3-modal" style="z-index:4">
	<div class="w3-modal-content w3-animate-zoom">
		<div class="w3-container w3-padding w3-blue">
			 <span onclick="document.getElementById('id02').style.display='none'" class="w3-right w3-xxlarge w3-closebtn"><i class="fa fa-remove"></i></span>
			<h2>Subir Curriculum Vitae Digital</h2>
		</div>
		<div class="w3-panel">
			<form class="" action="../ModulE/Insertar_CurriDig.php" enctype="multipart/form-data" method="post" >
				<fieldset>
					<p class="text descripción" style="color:black;">
						Con esta herramienta será capaz de IMPORTAR CV en formato digital, compatible con archivos en formato .doc, .docx, o .pdf con un tamaño menor a 3MB.
					</p>
						<label style="color:gray">Seleccionar Archivo</label>
						<input name="file_Usuario" ID="EnviarArchivo" type="file" size="20" class="file" data-preview-file-type="file" accept='file/*'>
						<script>
  						var $input = $("#EnviarArchivo");
  						$input.fileinput({
  							showUpload: false,
  						showRemove: false,
  					     });
  					</script>
					<div class="w3-section">
						<div class="form-group">
							<a class="w3-btn w3-grey" onclick="document.getElementById('id02').style.display='none'">Cancelar  <i class="fa fa-remove"></i></a>
							<button type="submit" class="w3-btn w3-right w3-blue">Subir<i class="fa fa-paper-plane"></i></button>
						</div>
		      </div>
				</fieldset>
			</form>
		</div>
	</div>
</div>

</br>
</br>
</body>
</html>
<?php
ob_end_flush();
?>
