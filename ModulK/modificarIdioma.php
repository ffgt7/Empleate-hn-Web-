<?php
	//require('../lib/Llenado_Select.php');
	$res=new Llenado_Select();
?>
<!doctype html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
	
	<?php require("../lib/movil.php"); ?>
	<title>Cursos</title>
	<script src="../js/jquery.js"></script>
	<script src="../js/bootstrap.js"></script>
	<script src="../js/bootstrapValidator.js"></script>
	<script src="../js/validarCurso.js"></script>
	<script src="../js/validarIdioma.js"></script>
	<link href="../css/bootstrap.css" rel="stylesheet" />
	<script src="../js/sweetalert-dev.js"></script>
	<link href="../css/sweetalert.css" rel="stylesheet" type="text/css"/>
	<script src="../js/sweetalert.min.js"></script> 
</head>	
<body>
<?php	
	require "navSS.php";
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
	$datos=new Llenado_Select();
	$cod=$_GET['cod'];
	$cod2=$_SESSION['cod_usuario'];
	include("../lib/conexion.php");
	$sql1="select cod_idioma from curri_idioma where cod_idioma=? and fk_userIdioma=?";
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
	$sql="SELECT * from curri_idioma where cod_idioma=$cod";
	$array=$datos->llenarSelect($sql);
?>
	
	<?php foreach($array as $elemento):?>
		
		<div class="container">
		
			<div class="col-sm-9">




<form class="well form-horizontal" action="actualizarIdiomas.php" method="post" id="form_CurriIdioma" enctype="multipart/form-data" name="formulario">
					<fieldset>
						
						<div class="panel panel-info">
					 		<div class="panel-heading">
								<h3 class="panel-title"> Idiomas. </h3>
							</div>
							<div class="panel-body">
							
								<div class="form-group">
									<label class="text col-md-4 control-label"> Idioma </label>
									<div class="col-md-4 selectContainer">
										<div class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-flag"></i></span>
											<select name="idioma" class="form-control selectpicker" value="<?php echo $elemento['cod_idioma'] ?>">
												<option value=" "><?php echo $elemento['idioma'] ?></option>
												<?php 
													$sql='select * from idioma';
													$idiomas=$res->llenarSelect($sql);
													foreach ($idiomas as $idi) {
													echo '<option value="'.$idi['0'].'">'.$idi['1'].'</option>';
												}?>
											</select>
										</div>
									</div>
								</div>
								<div class="input-group">
								<input  name="cod" id="cod" placeholder="" class="form-control" value="<?php echo $elemento['cod_idioma'] ?>" type=hidden>
								</div>
								
								
								<div class="form-group">
									<label class="text col-md-4 control-label"> Nivel </label>
									<div class="col-md-4 selectContainer">
										<div class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-flag"></i></span>
											<select name="nivel" class="form-control selectpicker" value="<?php echo $elemento['nivel'] ?>">
												<option value=" ">value="<?php echo $elemento['nivel'] ?>"</option>
												<?php 
													$sql='select * from nivel';
													$nivel=$res->llenarSelect($sql);
													foreach ($nivel as $niv) {
													echo '<option value="'.$niv['0'].'">'.$niv['1'].'</option>';
												}?>
											</select>
										</div>
									</div>
								</div>
								
								<!-- Button -->
								<div class="form-group">
								  <label class="col-md-4 control-label"></label>
								  <div class="col-md-4">
									<button type="submit" name="registrarse2" class="btn btn-warning btn-block" >Guardar <span class="glyphicon glyphicon-floppy-saved"></span></button>
									<a class="btn btn-danger btn-block" href="../ModulC/perfil_usuario.php">Cancelar <span class="glyphicon glyphicon-floppy-remove"></span></a>
								  </div>
								</div>
								
							</div>
						</div>	
						<?php endforeach; ?>
					</fieldset>
				</form>
				