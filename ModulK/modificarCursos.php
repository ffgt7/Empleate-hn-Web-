<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<?php require("../lib/movil.php"); ?>
		<title>Cursos</title>
		<script src="../js/jquery.js"></script>
		<script src="../js/bootstrap.js"></script>
		<script src="../js/bootstrapValidator.js"></script>
		<script src="../js/validarCurso.js"></script>
		<script src="../js/validarIdioma.js"></script>
		
		<link href="../css/bootstrap.css" rel="stylesheet" />

		
		
	</head>
	
	<body>
<?php
	require "navSS.php";
	require("../lib/permisosU.php");
	$res=new Llenado_Select();
	
	$cod=$_GET['cod'];
	$sql="SELECT cod_curso, Nomb_curso, Nomb_Empre, fech_IniTra,fech_FinTra,fk_pais, pais FROM curri_cursos JOIN 
	paises ON cod_pais = fk_pais";
	$array=$res->llenarSelect($sql);
		
?>
	<br><br><br>
	<?php foreach($array as $elemento):?>
		
		<div class="container">
		
			<div class="col-sm-9">
			
				<form class="well form-horizontal" action="actualizarCursos.php" method="post" id="form_CurriCursos" enctype="multipart/form-data" name="formulario">
					<fieldset>

						<div class="panel panel-info">
					 		<div class="panel-heading">
								<h3 class="panel-title">Cursos, Certificados, otros. </h3>
							</div>
							<div class="panel-body">
							
								
								<div class="form-group">
									<label class="text col-md-4 control-label">Nombre del curso </label>
									<div class="col-md-4 inputGroupContainer">
										<div class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
											<input name="NombreCurso" id="curso" placeholder="Nombre del curso" class="form-control" value="<?php echo $elemento['Nomb_curso'] ?>" type="text">
										</div>
									</div>
									<label class="col-md-4"></label>
									<div id="Info"></div>
								</div>
								
								<div class="input-group">
								<input  name="cod" id="cod" placeholder="" class="form-control" value="<?php echo $elemento['cod_curso'] ?>" type=hidden>
								</div>
								
								<div class="form-group">
									<label class="text col-md-4 control-label">Empresa o Institución </label>
									<div class="col-md-4 inputGroupContainer">
										<div class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
											<input name="NombreEmpresa" id="institucion" placeholder="Nombre de institución" class="form-control" value="<?php echo $elemento['Nomb_Empre'] ?>" type="text">
										</div>
									</div>
									<label class="col-md-4"></label>
									<div id="Info"></div>
								</div>
								
								<div class="form-group">
									<label class="text col-md-4 control-label">País</label>
									<div class="col-md-4 selectContainer">
										<div class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-flag"></i></span>
											<select name="pais" id="pais" class="form-control selectpicker" >
												<option value="<?php echo $elemento['fk_pais'] ?>"><?php echo $elemento['pais'] ?></option>
												<?php 
													$sql='select * from paises';
													$paises=$res->llenarSelect($sql);
													foreach ($paises as $pai) {
													echo '<option value="'.$pai['0'].'">'.$pai['1'].'</option>';
												}?>
											</select>
										</div>
									</div>
								</div>
								
								<div class="form-group">
									<label class="text col-md-4 control-label">Fecha de inicio y fin</label>
									<div class="col-md-4 inputGroupContainer">
										<div class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
											<input name="Fech_Ini" id="Fech_Ini" placeholder"Fecha de inicio curso"  class="form-control" value="<?php echo $elemento['fech_IniTra'] ?>" type="date" >
											<br/>
											<input name="Fech_Fin" id="Fech_Fin" placeholder="Fecha finalización curso" class="form-control" value="<?php echo $elemento['fech_FinTra'] ?>" type="date" >
										</div>
									</div>
								</div>
								
								<!-- Button -->
								<div class="form-group">
								  <label class="col-md-4 control-label"></label>
								  <div class="col-md-4">
									<button type="submit" name="registrarse1" class="btn btn-warning btn-block" >Guardar<span class="glyphicon glyphicon-floppy-saved"></span></button>
									<a class="btn btn-danger btn-block" href="../ModulC/perfil_usuario.php">Cancelar <span class="glyphicon glyphicon-floppy-remove"></span></a>
								  </div>
								</div>
								
							</div>
						</div>
						<?php endforeach; ?>
					</fieldset>
				</form>