<?php
	require('../lib/Llenado_Select.php');
	$res=new Llenado_Select();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<?php require("../lib/movil.php"); ?>
<title>Experiencia Laboral</title>
<script src="../js/jquery.js"></script>

<script data-require="jquery@2.1.3" data-semver="2.1.3" src="http://code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>

<script src="../js/bootstrap.js"></script>
<script src="../js/bootstrap-select.js" type="text/javascript">
</script>
<script src="../js/bootstrapValidator.js" type="text/javascript"></script>
<script src="../js/Curri_ExpeLabo.js" type="text/javascript"></script>
<script src="../js/messages_es.js" type="text/javascript"></script>

<script src="../js/moment-2.10.3.js"></script>
<script src="../js/bootstrap-datetimepicker.js"></script>

<link href="../css/bootstrap.css" rel="stylesheet" type="text/css"/>

<link rel="stylesheet" href="../css/bootstrap.min.css" />
<link rel="stylesheet" href="../css/style_FECHA.css" />

<link href="../css/bootstrap-select.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript">
	$(document).ready(function (){
	$("#CategoCurri").change(function () {
			$("#CategoCurri option:selected").each(function () {
				cod_cate = $(this).val();
				$.post("Puestos.php", { cod_cate: cod_cate}, function(data){
					$("#PustoDesem").html(data);
				});
			});
		});
	});
</script>
<style>
	.text{
		color: white;
	}
</style>
</head>
<body>
<br/>
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
<br>
<div class="container">

    <form class="well form-horizontal" action="Insertar_CurriExpeLabo.php" method="post"  id="form_CurriExLa" enctype="multipart/form-data" name="formulario">
<fieldset>

<!-- Form Name -->
<div class="form-group">
<label class="text col-md-4 control-label"> <h3><span class="label label-info">Experiencia Laboral</span></h3></label>
</div><br>

<!-- Text input-->

<div class="form-group">
 	<label class="text col-md-4 control-label">Nombre de la empresa</label>
  	<div class="col-md-4 inputGroupContainer">
  		<div class="input-group">
  			<span class="input-group-addon"><i class="glyphicon glyphicon-briefcase"></i></span>
  			<input  name="Nomb_Empre" placeholder="Nombre de la empresa" class="form-control"  type="text" >
    	</div>
  	</div>
</div>

<!-- Select Basic -->

<div class="form-group">
  <label class="text col-md-4 control-label">País</label>
    <div class="col-md-4 selectContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-flag"></i></span>
    <select name="pais" class="form-control" >
      <option value=" " >Seleccione un país</option>
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

<!-- Select Basic -->
<div class="form-group">
  <label class="text col-md-4 control-label">Actividad de la empresa</label>
    <div class="col-md-4 selectContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-wrench"></i></span>
    <select name="Acti_Empre" class="form-control" >
      <option value=" " >Seleccione una actividad</option>
       <?php
		$sql='select * from rubros order by rubro';
		$rubro=$res->llenarSelect($sql);
		foreach ($rubro as $rub) {
		echo '<option value="'.$rub['0'].'">'.$rub['1'].'</option>';
	}?>
    </select>
  </div>
</div>
</div>



<!-- Text input-->
<div class="form-group">
  <label class="text col-md-4 control-label" >Nombre exacto del puesto o cargo desempeñado</label>
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
  <input name="PuestCargo" placeholder="Nombre del cargo desempeñado" class="form-control"  type="text" >
    </div>
  </div>
</div>

<!-- Select Basic -->
<div class="form-group">
  <label class="text col-md-4 control-label">Categoria</label>
    <div class="col-md-4 selectContainer">
    	<div class="input-group">
        	<span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
    		<select name="Categoria" id="CategoCurri" class="form-control" >
      			<option value=" " >Seleccione una categoria</option>
       				<?php
						$sql='select * from categorias';
						$categoria=$res->llenarSelect($sql);
						foreach ($categoria as $cate) {
							echo '<option value="'.$cate['0'].'">'.$cate['1'].'</option>';
					}?>
    		</select>
    	</div>
	</div>
</div>

<!-- Select Basic -->
<div class="form-group">
  <label class="text col-md-4 control-label">Puesto o cargo desempeñado</label>
    <div class="col-md-4 selectContainer">
    	<div class="input-group">
        	<span class="input-group-addon"><i class="glyphicon glyphicon-dashboard"></i></span>
    		<select name="PustoDesem" id="PustoDesem" class="form-control" >
      			<option value="" >Seleccione un puesto</option>
    		</select>
    	</div>
	</div>
</div>

<!-- Text area -->
<div class="form-group">
 	<label class="text col-md-4 control-label">Descripción de las funciones en el puesto o cargo desempeñado</label>
    <div class="col-md-4 inputGroupContainer">
    	<div class="input-group">
        	<span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
        	<textarea class="form-control" rows="3" contenteditable="false" name="Descrip_Funcio" placeholder="Breve descripción de las principales funciones desempeñadas"></textarea>
  		</div>
  	</div>
</div>

<div class="form-group">
  <label class="text col-md-4 control-label">Fecha de inicio</label>
    <div class="col-md-4 inputGroupContainer">
    	<div class="input-group">
        	<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
  			<input name="Fech_Ini" id="Fech_Ini" placeholder="Fecha de inicio trabajo" class="form-control"  type="text">
    	</div>
  </div>
</div>

<div class="form-group">
  <label class="text col-md-4 control-label">Fecha de finalización</label>
    <div class="col-md-4 inputGroupContainer">
    	<div class="input-group">
        	<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
  			<input name="Fech_Fin" id="Fech_Fin" placeholder="Fecha finalización trabajo" class="form-control"  type="text">
    	</div>
  </div>
</div>


<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label"></label>
  <div class="col-md-4">
    <button type="submit" name="registrarse" class="btn btn-warning btn-block" >Guardar <span class="glyphicon glyphicon-floppy-saved"></span></button>
    <a class="btn btn-danger btn-block" href="../ModulC/curriculum.php">Cancelar <span class="glyphicon glyphicon-floppy-remove"></span></a>
  </div>
 </div>
</fieldset>
</form>
<p id="aviso"></p>
	</div>
 </div><!-- /.container -->
 <?php
	require("../footer.php");
?>


<script type="text/javascript">
    $(function () {
        $('#Fech_Ini').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $('#Fech_Fin').datetimepicker({
            useCurrent: false, //Important! See issue #1075
            format: 'YYYY-MM-DD'
        });
        $("#Fech_Ini").on("dp.change", function (e) {
            $('#Fech_Fin').data("DateTimePicker").minDate(e.date);
        });
        $("#Fech_Fin").on("dp.change", function (e) {
            $('#Fech_Ini').data("DateTimePicker").maxDate(e.date);
        });
    });
</script>


</body>
</html>
