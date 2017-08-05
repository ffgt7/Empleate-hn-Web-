<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Curriculum. Formación Académica</title>
<?php require("../lib/movil.php"); ?>
<script src="../js/jquery.js"></script>
<script src="../js/bootstrap.js"></script>
<link href="../css/registro.css" rel="stylesheet" type="text/css"/>
<script src="../js/bootstrapValidator.js" type="text/javascript"></script>

<script src="../js/messages_es.js" type="text/javascript"></script>
<link href="../css/bootstrap.css" rel="stylesheet" type="text/css"/>
<style>
	.text{
		color: white;
	}	
</style>

	</head>

	<body>
<?php 
	require "navSS.php"; 
	require "../lib/conexion.php";
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

		<div class="container" width="30%" >

		<form class="well form-horizontal" action="guardarEducacion.php" method="POST"  id="contact_form2">

	<fieldset>


	<legend class="text">Curriculum Vitae</legend>

	<div class="form-group">
	<label class="text col-md-4 control-label"> <h3><span class="label label-info">Formación Académica</span></h3></label> 
	</div><br>
	<?php
		$cod=$_SESSION["cod_usuario"];
		$cons="select primaria from educacion where fk_userEdu=?";
		$p=$conexion->prepare($cons);
		$p->execute(array($cod));
		$num=$p->rowCount();
		if($num==0)
		{
			
	?>
	<script src="../js/validacionE.js" type="text/javascript"></script>
	<div class="form-group">
	  <label class="text col-md-4 control-label">Educación Primaria</label>  
	  <div class="col-md-4 inputGroupContainer">
	  <div class="input-group">
	  <span class="input-group-addon"><i class="glyphicon glyphicon-education"></i></span>
	  <input  name="primaria" id="primaria" placeholder="Nombre del centro educativo" class="form-control"  type="text">
		</div>
	  </div>
	</div>

	<div class="form-group">
	   <label class="col-md-4 control-label"></label> 
	  <div class="col-md-4 inputGroupContainer">
	<div class="input-group">
	  <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
	  <input  name="primariaI" id="primariaI" placeholder="Año de inicio" class="form-control"  type="text">
		</div>
		</div>
	</div>
		<div class="form-group">
	   <label class="col-md-4 control-label"></label> 
	  <div class="col-md-4 inputGroupContainer">
		 <div class="input-group">
	  <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
	  <input  name="primariaF" id="primariaF" placeholder="Año de finalización" class="form-control"  type="text">
		</div>
	</div>
	</div>


	<div class="form-group">
	  <label class="text col-md-4 control-label">Educación Media</label>  
	  <div class="col-md-4 inputGroupContainer">
	  <div class="input-group">
	  <span class="input-group-addon"><i class="glyphicon glyphicon-education"></i></span>
	  <input  name="secundaria" id="secuandaria" placeholder="Nombre del centro educativo" class="form-control"  type="text">
		</div>
		</div>
	</div>
		<div class="form-group">
	  <label class="col-md-4 control-label"></label>  
	  <div class="col-md-4 inputGroupContainer">
		 <div class="input-group">
	  <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
	  <input  name="secundariaI" id="secundariaI" placeholder="Año de inicio" class="form-control"  type="text">
		</div>
		</div>
	</div>
		
		<div class="form-group">
	  <label class="col-md-4 control-label"></label>  
	  <div class="col-md-4 inputGroupContainer">
		 <div class="input-group">
	  <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
	  <input  name="secundariaF" id="secundariaF" placeholder="Año de finalización" class="form-control"  type="text">
		</div>
	  </div>
	</div>

	<div class="form-group">
	  <label class="text col-md-4 control-label">Título</label>  
		<div class="col-md-4 inputGroupContainer">
		<div class="input-group">
			<span class="input-group-addon"><i class="glyphicon glyphicon-education"></i></span>
	  <input name="tituloObtenidoSecu" placeholder="Título Obtenido" class="form-control"  type="text">
		</div>
		</div>
	</div>
	
	<?php			
		}
	?>
	<script src="../js/validaE.js" type="text/javascript"></script>
	<div class="form-group">
	  <label class="text col-md-4 control-label">Educación Superior</label>  
	  <div class="col-md-4 inputGroupContainer">
	   <div class="input-group">
	  <span class="input-group-addon"><i class="glyphicon glyphicon-education"></i></span>
	  <input  name="carrera" id="carrera" placeholder="Nombre de la carrera" class="form-control"  type="text">
		</div>
		</div>
	</div>
		
		
		
		<div class="form-group">
	  <label class="col-md-4 control-label"></label>  
	  <div class="col-md-4 inputGroupContainer">
	  <div class="input-group">
	  <span class="input-group-addon"><i class="glyphicon glyphicon-education"></i></span>
	  <input  name="superior" id="superior" placeholder="Nombre del centro educativo" class="form-control"  type="text">
		</div>
		</div>
	</div>
		
		<div class="form-group">
	  <label class="col-md-4 control-label"></label>  
	  <div class="col-md-4 inputGroupContainer">
		 <div class="input-group">
	  <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
	  <input  name="superiorI" id="superiorI" placeholder="Año de inicio" class="form-control"  type="text">
		</div>
		</div>
	</div>
		
		
		<div class="form-group">
	  <label class="col-md-4 control-label"></label>  
	  <div class="col-md-4 inputGroupContainer">
		 <div class="input-group">
	  <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
	  <input  name="superiorF" id="superiorF" placeholder="Año de finalización" class="form-control"  type="text">
		</div>
	  </div>
	</div>

	<div class="form-group">
	  <label class="text col-md-4 control-label">Título</label>  
		<div class="col-md-4 inputGroupContainer">
		<div class="input-group">
			<span class="input-group-addon"><i class="glyphicon glyphicon-education"></i></span>
	  <input name="tituloObtenidoS" id="tituloObtenidoS" placeholder="Título Obtenido" class="form-control"  type="text">
		</div>
		</div>
	</div>
	
	<div class="form-group">
	  <label class="col-md-4 control-label"></label>
	  <div class="col-md-4">
		<button type="submit" name="registrarse" class="btn btn-warning btn-block" >Guardar <span class="glyphicon glyphicon-send"></span></button>
		<a class="btn btn-danger btn-block" href="../modulC/curriculum.php">Cancelar <span class="glyphicon glyphicon-floppy-remove"></span></a>
	  </div>
	</div>

	
	</fieldset> 

	</form>
	</div>
		</div>
<?php
	require("../footer.php");
?>
</body>
	</html>