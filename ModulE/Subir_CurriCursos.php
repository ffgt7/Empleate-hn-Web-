<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Curriculum Digital</title>
	<script src="../js/jquery.js"></script>
	<script src="../js/bootstrap.js"></script>
	<script src="../js/bootstrapValidator.js" type="text/javascript"></script>
	<script src="../js/validarCurri.js" type="text/javascript"></script>

	<script src="../js/messages_es.js" type="text/javascript"></script>

	<script src="../js/fileinput.js" type="text/javascript"></script>
	<script src="../js/fileinput.min.js" type="text/javascript"></script>

	<link href="../css/fileinput.css" rel="stylesheet" type="text/css"/>
	<link href="../css/fileinput.min.css" rel="stylesheet" type="text/css"/>
	<link href="../css/bootstrap.css" rel="stylesheet" type="text/css"/>

</head>
<body>
	<?php
	require("../lib/scriptss.php");
	require('../lib/Llenado_Select.php');
	require("navSS.php");
	require("../lib/permisosU.php");
	?>
		<br>
		<br>
		<br>

		<div class="container">

				<form class="well form-horizontal" action="Insertar_CurriDig.php" method="post" id="form_CurriDig" enctype="multipart/form-data" name="formulario">
					<fieldset>

						<!-- Form Name -->
						<div class="form-group">
							<label class="text col-md-4 control-label label-info"><h3>Curriculum Digital</h3></label>
						</div><br>


						<!-- Text input-->
						<div class="form-group">
							<label class="text col-md-4 control-label"><h4>
									Importar Curriculum
							</h4></label>
								</br>
							<label class="text col-md-4 control-label">
								<p class="text descripción">
									Con esta herramienta será capaz de IMPORTAR CV en formato digital, compatible con archivos en formato .doc, .docx, o .pdf con un tamaño menor a 3MB.
								</p>
							</label>
								</br>
						</div>

								<!-- Imagen de perfil-->
								<div class="form-group">
									<label class="text col-md-4 control-label">Seleccionar archivo</label>
									<div class="col-md-4 inputGroupContainer">
										<div class="input-group">
											<input name="file_Usuario" ID="EnviarArchivo" type="file" size="20" class="file" data-preview-file-type="file" accept='file/*'>
											<script>
												var $input = $("#EnviarArchivo");
												$input.fileinput({
													showUpload: false,
													showRemove: false,
												});
											</script>

										</div>
									</div>
								</div>

								<!-- Button -->
								<div class="form-group">
								  <label class="col-md-4 control-label"></label>
								  <div class="col-md-4">
									<button type="submit" name="registrarse" class="btn btn-warning btn-block" >Subir <span class="glyphicon glyphicon-send"></span></button>
									<a class="btn btn-danger btn-block" href="../modulC/Curriculum.php">Cancelar <span class="glyphicon glyphicon-floppy-remove"></span></a>
								  </div>
								</div>

				</fieldset>
			</form>

	</div>
</body>
</html>
