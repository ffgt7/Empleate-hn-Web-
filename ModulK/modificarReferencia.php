	<!doctype html>
	<html>
	<head>
	<meta charset="utf-8">
	<title>Datos. Referencias</title>
	<?php require("../lib/movil.php"); ?>
	<script src="../js/jquery.js" type="text/javascript">
	</script>
	<script src="../js/bootstrap.js" type="text/javascript">
	</script>
	<link href="../css/bootstrap.css" rel="stylesheet" type="text/css"/>
	<script src="../js/bootstrapValidator.js" type="text/javascript"></script>
	<script src="../js/validacionR.js" type="text/javascript">
	</script>
	<script src="../js/sweetalert-dev.js"></script>
	<link href="../css/sweetalert.css" rel="stylesheet" type="text/css"/>
	<script src="../js/sweetalert.min.js"></script>
	</head>

	<body>
	<?php	
	require("navSS.php");
	//require "../lib/Llenado_Select.php";
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
	$sql1="select cod_referencai from referencia where cod_referencai=? and fk_userRefe=?";
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
					window.location.href="../ModulC/perfil_usuario.php"
				});
			 </script>';
		return;
	}
	$sql="SELECT * from referencia where cod_referencai=$cod";
	$array=$res->llenarSelect($sql);
	
?>
	
   <?php foreach($array as $elemento):?>
   
		<div class="container" width="30%"/>

		<form class="well form-horizontal" action="actualizarReferencia.php" method="POST"  id="contact_form5">

	<fieldset>


	<legend>Curriculum Vitae</legend>


	<div class="form-group">
	<label class="text col-md-4 control-label"> <h3><span class="label label-info">Modificar Referencia</span></h3></label> 
	</div><br>


	<div class="form-group">
	  <label class="col-md-4 control-label">Nombre</label>  
	  <div class="col-md-4 inputGroupContainer">
	  <div class="input-group">
	  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
	  <input  name="nombreR"  placeholder="Primer y segundo nombre" class="form-control" value="<?php echo $elemento['nombreR'] ?>" type="text">
		</div>
	  </div>
	</div>
	
	<div class="input-group">
  <input  name="cod" id="cod" placeholder="" class="form-control" value="<?php echo $elemento['cod_referencai'] ?>" type=hidden>
    </div>
	

	<div class="form-group">
	  <label class="col-md-4 control-label" >Apellido</label> 
		<div class="col-md-4 inputGroupContainer">
		<div class="input-group">
	  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
	  <input name="apellidoR"  placeholder="Primer y segundo apellido" class="form-control" value="<?php echo $elemento['apellidoR'] ?>" type="text">
		</div>
	  </div>
	</div>

	<div class="form-group">
	  <label class="col-md-4 control-label" >Identidad</label> 
		<div class="col-md-4 inputGroupContainer">
		<div class="input-group">
	  <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
	  <input name="identidadR"  placeholder="Número de identidad" class="form-control" value="<?php echo $elemento['identidadR'] ?>" type="text">
		</div>
	  </div>
	</div>


	<div class="form-group">
	  <label class="col-md-4 control-label">Dirección actual</label>  
		<div class="col-md-4 inputGroupContainer">
		<div class="input-group">
			<span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>
	  <input name="direccionR"  placeholder="Dirección exacta" class="form-control" value="<?php echo $elemento['direccionR'] ?>" type="text">
		</div>
	  </div>
	</div>

	  <div class="form-group">
	  <label class="col-md-4 control-label">Teléfono</label>  
		<div class="col-md-4 inputGroupContainer">
		<div class="input-group">
			<span class="input-group-addon"><i class="glyphicon glyphicon-phone-alt"></i></span>
	  <input name="telFR"  placeholder="Teléfono fijo" class="form-control" value="<?php echo $elemento['telFR'] ?>"type="tel">
		</div>
		</div>
	</div>

		<div class="form-group">
	  <label class="col-md-4 control-label"></label>  
		<div class="col-md-4 inputGroupContainer">
		<div class="input-group">
			<span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
	  <input name="telMR"  placeholder="Teléfono movil" class="form-control" value="<?php echo $elemento['telMR'] ?>" type="tel">
		</div>
	  </div>
	</div>

		   <div class="form-group">
	  <label class="col-md-4 control-label">Email</label>  
		<div class="col-md-4 inputGroupContainer">
		
		<div class="input-group">
			<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
	  <input name="correoR" placeholder="Corre electrónico" class="form-control" value="<?php echo $elemento['correoR'] ?>" type="email">
		</div>
		 </div>
	</div>

		<div class="form-group">
	  <label class="col-md-4 control-label"></label>  
		<div class="col-md-4 inputGroupContainer">
		
		<div class="input-group">
			<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
	  <input name="correo2" placeholder="Corre electrónico alternativo" class="form-control" value="<?php echo $elemento['correolR2'] ?>" type="email">
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