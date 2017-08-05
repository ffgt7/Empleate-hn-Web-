<?php
	require('../lib/Llenado_Select.php');
	$res=new Llenado_Select();
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<?php require("../lib/movil.php"); ?>
		<title>idiomas</title>

		<script src="../js/jquery.js"></script>
		<script src="../js/bootstrap.js"></script>
		<script src="../js/bootstrapValidator.js"></script>

		<script src="../js/validarIdioma.js"></script>
		<script src="../js/messages_es.js" type="text/javascript"></script>

		<link href="../css/bootstrap.css" rel="stylesheet" />

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

  <form class="well form-horizontal" action="Insertar_CurriIdiomas.php" method="post" id="form_CurriIdioma" enctype="multipart/form-data" name="formulario">
    <fieldset>

      <div class="form-group">
        <label class="text col-md-4 control-label"> <h3><span class="label label-info">Idiomas que domina </span></h3></label>
      </div></br>

          <div class="form-group">
            <label class="text col-md-4 control-label"> Idioma </label>
            <div class="col-md-4 selectContainer">
              <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-flag"></i></span>
                <select name="idioma" class="form-control selectpicker">
                  <option value=" ">Seleccione un idioma</option>
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

          <div class="form-group">
            <label class="text col-md-4 control-label"> Nivel </label>
            <div class="col-md-4 selectContainer">
              <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-flag"></i></span>
                <select name="nivel" class="form-control selectpicker">
                  <option value=" ">Seleccione nivel</option>
                  <?php
                    $sql='select * from nivelidiom';
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
            <a class="btn btn-danger btn-block" href="../ModulC/curriculum.php">Cancelar <span class="glyphicon glyphicon-floppy-remove"></span></a>

            </div>
          </div>

    </fieldset>
  </form>

</div>

<?php
	require("../footer.php");
?>
	</body>

</html>
