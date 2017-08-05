<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Datos. Referencias</title>
<?php require("../lib/movil.php"); ?>
<script src="../js/jquery.js"></script>
<script src="../js/bootstrap.js"></script>
<link href="../css/registro.css" rel="stylesheet" type="text/css"/>
<script src="../js/bootstrapValidator.js" type="text/javascript"></script>
<script src="../js/validacionR.js" type="text/javascript"></script>
<link href="../css/bootstrap.css" rel="stylesheet" type="text/css"/>
<style>
	.text{
		color: white;
	}	
</style>
</head>

<body>
<?php
	//require('../lib/Llenado_Select.php');
	require "navSS.php";
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
	<form class="well form-horizontal" action="guardarReferencia.php" method="POST"  id="contact_form5">
	<fieldset>
	<legend class="text">Curriculum Vitae</legend>
	<div class="form-group">
		<label class="text col-md-4 control-label"> <h4>Referencia Personal</h4></label> 
	</div><br>

	<div class="form-group">
	  <label class="text col-md-4 control-label">Nombre</label>  
	  <div class="col-md-4 inputGroupContainer">
		<div class="input-group">
			<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
			<input  name="nombreR"  placeholder="Primer y segundo nombre" class="form-control"  type="text">
		</div>
	  </div>
	</div>

	<div class="form-group">
	  <label class="text col-md-4 control-label" >Apellido</label> 
		<div class="col-md-4 inputGroupContainer">
			<div class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
				<input name="apellidoR"  placeholder="Primer y segundo apellido" class="form-control"  type="text">
			</div>
		</div>
	</div>

	<div class="form-group">
		<label class="text col-md-4 control-label" >Identidad</label> 
		<div class="col-md-4 inputGroupContainer">
			<div class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
				<input name="identidadR"  placeholder="Número de identidad" class="form-control"  type="text">
			</div>
		</div>
	</div>

	<div class="form-group">
	  <label class="text col-md-4 control-label">Dirección actual</label>  
		<div class="col-md-4 inputGroupContainer">
		<div class="input-group">
			<span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>
	  <input name="direccionR"  placeholder="Dirección exacta" class="form-control"  type="text">
		</div>
	  </div>
	</div>

	  <div class="form-group">
	  <label class="text col-md-4 control-label">Teléfono</label>  
		<div class="col-md-4 inputGroupContainer">
		<div class="input-group">
			<span class="input-group-addon"><i class="glyphicon glyphicon-phone-alt"></i></span>
	  <input name="telFR"  placeholder="Teléfono fijo" class="form-control"  type="tel">
		</div>
		</div>
	</div>

		<div class="form-group">
	  <label class="col-md-4 control-label"></label>  
		<div class="col-md-4 inputGroupContainer">
		<div class="input-group">
			<span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
	  <input name="telMR"  placeholder="Teléfono movil" class="form-control"  type="tel">
		</div>
	  </div>
	</div>

		   <div class="form-group">
	  <label class="text col-md-4 control-label">Email</label>  
		<div class="col-md-4 inputGroupContainer">
		
		<div class="input-group">
			<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
	  <input name="correoR" placeholder="Corre electrónico" class="form-control"  type="email">
		</div>
		 </div>
	</div>

		<div class="form-group">
	  <label class="col-md-4 control-label"></label>  
		<div class="col-md-4 inputGroupContainer">
		
		<div class="input-group">
			<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
	  <input name="correo2" placeholder="Corre electrónico alternativo" class="form-control"  type="email">
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