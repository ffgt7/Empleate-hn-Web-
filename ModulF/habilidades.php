<?php
	require('../lib/Llenado_Select.php');
	$res=new Llenado_Select();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<?php require("../lib/movil.php"); ?>
<title>Habilidades Técnicas</title>
<script src="../js/jquery.js"></script>
<script src="../js/bootstrap.js"></script>
<script src="../js/bootstrapValidator.js"></script>
<script src="../js/messages_es.js" type="text/javascript"></script>
<script src="../js/validarHabilidad.js" type="text/javascript"></script>
<link href="../css/bootstrap.css" rel="stylesheet" />
<script type="text/javascript">
$(document).ready(function(){
   $("#aplicacion_Habi").change(function () {
           $("#aplicacion_Habi option:selected").each(function () {
            cod_habilidad = $(this).val();
            $.post("aplicacion.php", { cod_habilidad: cod_habilidad }, function(data){
                $("#aplicacion").html(data);
            });            
        });
   })
});
</script>
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

  <form class="well form-horizontal" action="insertarHabilidades.php" method="post" enctype="multipart/form-data" id="form_Habilidades" name="formulario">
    <fieldset>

      <div class="form-group">
        <label class="text col-md-4 control-label"> <h3><span class="label label-info">Habilidades Técnicas </span></h3></label>
      </div></br>

          <div class="form-group">
            <label class="text col-md-4 control-label"> Habilidades Técnicas: </label>
            <div class="col-md-4 selectContainer">
              <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-flag"></i></span>
                <select name="aplicacion_Habi" class="form-control selectpicker" id="aplicacion_Habi">
                  <option value=" ">Seleccione una Habilidad</option>
                  <?php
                    $sql='select * from habilidades';
                    $habilidad=$res->llenarSelect($sql);
                    foreach ($habilidad as $habi) {
                    echo '<option value="'.$habi['0'].'">'.$habi['1'].'</option>';
                  }?>
                </select>
              </div>
            </div>
          </div>
          
          <div class="form-group"> 
  		    <label class="text col-md-4 control-label">Aplicación</label>
    	    <div class="col-md-4 selectContainer">
    		    <div class="input-group">
        		    <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
    			    <select name="aplicacion" id="aplicacion" class="form-control selectpicker">
     				    <option value=" " >Selecciona una aplicación de la lista</option>
      			    </select>
  		        </div>
	        </div>
        </div>

          <div class="form-group">
            <label class="text col-md-4 control-label"> Nivel </label>
            <div class="col-md-4 selectContainer">
              <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-flag"></i></span>
                <select name="nivel" class="form-control selectpicker" id="nivel">
                  <option value=" ">Seleccione nivel</option>
                  <?php
                    $sql='select * from nivelidiom where cod_nivel!=1';
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