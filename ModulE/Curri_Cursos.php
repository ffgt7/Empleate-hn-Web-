<?php
	require('../lib/Llenado_Select.php');
	$res=new Llenado_Select();
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<?php require("../lib/movil.php"); ?>
		
		<title>Cursos</title>

		<link rel="stylesheet" href="../css/datepicker.css">

		<link href="../css/bootstrap.css" rel="stylesheet"/>

		<link rel="stylesheet" href="../css/bootstrap.min.css" />

		<link rel="stylesheet" href="../css/jquery-ui.css" />

    <script src="../js/jquery.js"></script>

		<script src="../js/bootstrap-datepicker.js"></script>

		<script src="../js/jquery-ui.js"></script>
		<script src="../js/jquery.ui.datepicker-es.js"></script>



    <script src="../js/bootstrap.min.js"></script>
		<script src="../js/bootstrapValidator.js"></script>

		<script src="../js/validarCurso.js"></script>
		<script src="../js/messages_es.js" type="text/javascript"></script>

    <style media="screen">
      #Fech_Ini, #Fech_Fin{
        color: black;
      }
    </style>


</head>

<body>
<?php
	require "navSS.php";
	if(!isset($_SESSION["cod_usuario"]))
	{
		$host=$_SERVER["HTTP_HOST"];
		$url=$_SERVER["REQUEST_URI"];
		$dire="http://" . $host . $url;
		echo '<script>
				window.location.href="../lib/permisosU.php'; echo '?url=';echo $dire;echo '";
			</script>';
		return;
	}
?>
</br></br></br>

<div class="container">
	<form class="well form-horizontal" action="Insertar_CurriCursos.php" method="post" id="form_CurriCursos" enctype="multipart/form-data" name="formulario">
		<fieldset>
			<div class="form-group">
				<label class="text col-md-4 control-label"> <h3><span class="label label-info">Cursos, Certificados.</span></h3></label>
			</div></br>

			<div class="form-group">
				<label class="text col-md-4 control-label">Nombre del curso </label>
					<div class="col-md-4 inputGroupContainer">
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
							<input name="NombreCurso" id="curso" placeholder="Nombre del curso" class="form-control" type="text">
						</div>
					</div>
					<label class="col-md-4"></label>
					<div id="Info"></div>
			</div>

								<div class="form-group">
									<label class="text col-md-4 control-label">Empresa o Institución </label>
									<div class="col-md-4 inputGroupContainer">
										<div class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
											<input name="NombreEmpresa" id="institucion" placeholder="Nombre de institución" class="form-control" type="text">
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
											<select name="pais" id="pais" class="form-control selectpicker">
												<option value=" ">Seleccione un país</option>
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
                    <label class="text col-md-4 control-label">Fecha de inicio</label>
                    <div class="col-md-4 inputGroupContainer">
                      <div class='input-group date'>
                        <span class="input-group-addon">
                          <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                        <input name="Fech_Ini" id="Fech_Ini" placeholder"Fecha de inicio curso"  class="form-control"  type="text">
  											<br/>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="text col-md-4 control-label">Fecha de finalización</label>
                    <div class="col-md-4 inputGroupContainer">
                      <div class='input-group date'>
                        <span class="input-group-addon">
                          <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                        <input name="Fech_Fin" id="Fech_Fin" placeholder"Fecha de finalización del curso" class="form-control"  type="text">
  											<br/>
                      </div>
                    </div>
                  </div>

								<!-- Button -->
								<div class="form-group">
								  <label class="col-md-4 control-label"></label>
								  <div class="col-md-4">
									<button type="submit" name="registrarse1" class="btn btn-warning btn-block" >Guardar<span class="glyphicon glyphicon-floppy-saved"></span></button>
									<a class="btn btn-danger btn-block" href="../ModulC/curriculum.php">Cancelar <span class="glyphicon glyphicon-floppy-remove"></span></a>
								  </div>
								</div>

					</fieldset>
				</form>

		</div>
<?php
	require("../footer.php");
?>

<script type="text/javascript">

		$(function () {
			$("#Fech_Ini").datepicker({
				changeMonth: true,
        changeYear: true,
				yearRange: '1970:2017',
				dateFormat: 'yy/mm/dd',
				onClose: function (selectedDate) {
						$("#Fech_Fin").datepicker("option", "minDate", selectedDate);
				}
			});
			$("#Fech_Fin").datepicker({
				changeMonth: true,
        changeYear: true,
				yearRange: '1970:2017',
				dateFormat: 'yy/mm/dd',
				onClose: function (selectedDate) {
			    $("#Fech_iNI").datepicker("option", "maxDate", selectedDate);
			  }
			});
		});
</script>

	</body>

</html>
