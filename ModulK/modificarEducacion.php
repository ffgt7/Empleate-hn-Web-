<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Curriculum. Formación Académica</title>
	<?php require("../lib/movil.php"); ?>
	<script src="../js/jquery.js" type="text/javascript">
	</script>
	<script src="../js/bootstrap.js" type="text/javascript">
	</script>
	<link href="../css/bootstrap.css" rel="stylesheet" type="text/css"/>
	<script src="../js/bootstrapValidator.js" type="text/javascript"> </script>
	<script src="../js/sweetalert-dev.js"></script>
	<link href="../css/sweetalert.css" rel="stylesheet" type="text/css"/>
	<script src="../js/sweetalert.min.js"></script>
</head>
<body>
<?php	
	//require "../lib/Llenado_Select.php";
	require "navSS.php"; 
	$res=new Llenado_Select();
	$host=$_SERVER["HTTP_HOST"];
	$url=$_SERVER["REQUEST_URI"];
	$dire="http://" . $host . $url;
	if(!isset($_SESSION["cod_usuario"]))
	{
		echo '<script>
				window.location.href="../lib/permisosU.php'; echo '?url=';echo $dire;echo '"; 
			</script>';
		return;
		
	}
	if(!isset($_GET["cod"]))
	{
		require("../lib/permisosG.php");
		return;
	}
	
	$cod=$_GET['cod'];
	$cod2=$_SESSION['cod_usuario'];
	include("../lib/conexion.php");
	$sql1="select cod_educacion from educacion where cod_educacion=? and fk_userEdu=?";
	$array_propuestas= $conexion->prepare($sql1);
	$array_propuestas->execute(array($cod,$cod2));
	$num=$array_propuestas->rowCount();
	if($num==0)
	{
		echo '<script>
				swal({
					title: "Error!",
					text: "Dede iniciar sesión con el usuario correcto",
					type: "error",
					confirmButtonText: "Aceptar"
				},
				function(){
				    window.history.go(-1);
					window.location.href="../modulC/perfil_usuario.php"
				});
			 </script>';
		return;
	}
	$sql="SELECT * from educacion where cod_educacion=$cod";
	$array=$res->llenarSelect($sql);
	
	?>

<?php foreach($array as $elemento): ?>

		<div class="container" width="30%" >

		<form class="well form-horizontal" action="actualizarEducacion.php" method="POST"  id="contact_form2">

	<fieldset>


	<legend>Curriculum Vitae</legend>

	<div class="form-group">
	<label class="text col-md-4 control-label"> <h3><span class="label label-info">Modificar Formación Académica</span></h3></label> 
	</div><br>
	<?php
		$cons="select primaria from educacion where cod_educacion=$cod";
		$p=$res->llenarSelect($cons);
		foreach($p as $x){
		}
		if($x["primaria"]!= "")
		{

	?>
	<div class="form-group">
	  <label class="col-md-4 control-label">Educación Primaria</label>  
	  <div class="col-md-4 inputGroupContainer">
	  <div class="input-group">
	  <span class="input-group-addon"><i class="glyphicon glyphicon-education"></i></span>
	  <input  name="primaria" id="primaria" placeholder="Nombre del centro educativo" class="form-control" value="<?php echo $elemento['primaria'] ?>" type="text">
		</div>
	  </div>
	</div>
	
<div class="input-group">
  <input  name="cod" id="cod" placeholder="" class="form-control" value="<?php echo $elemento['cod_educacion'] ?>" type=hidden>
    </div>
	
	<div class="form-group">
	   <label class="col-md-4 control-label"></label> 
	  <div class="col-md-4 inputGroupContainer">
	<div class="input-group">
	  <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
	  <input  name="primariaI" id="primariaI" placeholder="Año de inicio" class="form-control" value="<?php echo $elemento['primariI'] ?>" type="text">
		</div>
		</div>
	</div>
		<div class="form-group">
	   <label class="col-md-4 control-label"></label> 
	  <div class="col-md-4 inputGroupContainer">
		 <div class="input-group">
	  <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
	  <input  name="primariaF" id="primariaF" placeholder="Año de finalización" class="form-control" value="<?php echo $elemento['primariaF'] ?>" type="text">
		</div>
	</div>
	</div>


	<div class="form-group">
	  <label class="col-md-4 control-label">Educación Media</label>  
	  <div class="col-md-4 inputGroupContainer">
	  <div class="input-group">
	  <span class="input-group-addon"><i class="glyphicon glyphicon-education"></i></span>
	  <input  name="secundaria" id="secuandaria" placeholder="Nombre del centro educativo" class="form-control"  value="<?php echo $elemento['secundaria'] ?>"type="text">
		</div>
		</div>
	</div>
		<div class="form-group">
	  <label class="col-md-4 control-label"></label>  
	  <div class="col-md-4 inputGroupContainer">
		 <div class="input-group">
	  <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
	  <input  name="secundariaI" id="secundariaI" placeholder="Año de inicio" class="form-control" value="<?php echo $elemento['secundariaI'] ?>"  type="text">
		</div>
		</div>
	</div>
		
		<div class="form-group">
	  <label class="col-md-4 control-label"></label>  
	  <div class="col-md-4 inputGroupContainer">
		 <div class="input-group">
	  <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
	  <input  name="secundariaF" id="secundariaF" placeholder="Año de finalización" class="form-control" value="<?php echo $elemento['secundariaF'] ?>" type="text">
		</div>
	  </div>
	</div>

	<div class="form-group">
	  <label class="col-md-4 control-label">Título</label>  
		<div class="col-md-4 inputGroupContainer">
		<div class="input-group">
			<span class="input-group-addon"><i class="glyphicon glyphicon-education"></i></span>
	  <input name="tituloObtenidoSecu" placeholder="Título Obtenido" class="form-control" value="<?php echo $elemento['tituloObtenidoSecu'] ?>" type="text">
		</div>
		</div>
	</div>
	
	<?php			
		}
	?>
	<input  name="cod" id="cod" placeholder="" class="form-control" value="<?php echo $elemento['cod_educacion'] ?>" type=hidden>
	<div class="form-group">
	  <label class="col-md-4 control-label">Educación Superior</label>  
	  <div class="col-md-4 inputGroupContainer">
	   <div class="input-group">
	  <span class="input-group-addon"><i class="glyphicon glyphicon-education"></i></span>
	  <input  name="carrera" id="carrera" placeholder="Nombre de la carrera" class="form-control" value="<?php echo $elemento['carrera'] ?>" type="text">
		</div>
		</div>
	</div>
		
		
		
		<div class="form-group">
	  <label class="col-md-4 control-label"></label>  
	  <div class="col-md-4 inputGroupContainer">
	  <div class="input-group">
	  <span class="input-group-addon"><i class="glyphicon glyphicon-education"></i></span>
	  <input  name="superior" id="superior" placeholder="Nombre del centro educativo" class="form-control" value="<?php echo $elemento['superior'] ?>" type="text">
		</div>
		</div>
	</div>
		
		<div class="form-group">
	  <label class="col-md-4 control-label"></label>  
	  <div class="col-md-4 inputGroupContainer">
		 <div class="input-group">
	  <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
	  <input  name="superiorI" id="superiorI" placeholder="Año de inicio" class="form-control" value="<?php echo $elemento['superiorI'] ?>" type="text">
		</div>
		</div>
	</div>
		
		
		<div class="form-group">
	  <label class="col-md-4 control-label"></label>  
	  <div class="col-md-4 inputGroupContainer">
		 <div class="input-group">
	  <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
	  <input  name="superiorF" id="superiorF" placeholder="Año de finalización" class="form-control" value="<?php echo $elemento['superiorF'] ?>" type="text">
		</div>
	  </div>
	</div>

	<div class="form-group">
	  <label class="col-md-4 control-label">Título</label>  
		<div class="col-md-4 inputGroupContainer">
		<div class="input-group">
			<span class="input-group-addon"><i class="glyphicon glyphicon-education"></i></span>
	  <input name="tituloObtenidoS" id="tituloObtenidoS" placeholder="Título Obtenido" class="form-control" value="<?php echo $elemento['tituloObtenidoS'] ?>" type="text">
		</div>
		</div>
	</div>
	<div class="form-group">
	  <label class="col-md-4 control-label"></label>
	  <div class="col-md-4">
		<button type="submit" name="registrarse1" class="btn btn-warning btn-block" >Guardar<span class="glyphicon glyphicon-floppy-saved"></span></button>
		<a class="btn btn-danger btn-block" href="../ModulC/perfil_usuario.php">Cancelar <span class="glyphicon glyphicon-floppy-remove"></span></a>
	  </div>
	</div>

	</fieldset> 

	</form>
	</div>
		</div>
		<?php endforeach; ?>
	</body>
	</html>