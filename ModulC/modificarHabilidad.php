<?php
	require('../lib/Llenado_Select.php');
	$res=new Llenado_Select();
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
            $.post("../ModulF/aplicacion.php", { cod_habilidad: cod_habilidad }, function(data){
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
	$cod=$_GET["cod"];
	$sql50="select cod_curriHabi, nivel, fk_nivelHabi from curriHabilidades join habilidades on cod_habilidad=fk_habilidad join aplicaciones on cod_aplicacion=fk_aplicacion
	join nivelidiom on cod_nivel=fk_nivelHabi where cod_curriHabi=$cod";
	$array=$res->llenarSelect($sql50);
	foreach($array as $hab){}
?>
</br></br></br>

<div class="container">

  <form class="well form-horizontal" action="ActualizarrHabilidades.php" method="post" enctype="multipart/form-data" id="form_Habilidades" name="formulario">
    <fieldset>
		<input  name="cod" id="cod" placeholder="" class="form-control" value="<?php echo $hab['cod_curriHabi'] ?>" type=hidden>
      <div class="form-group">
        <label class="text col-md-4 control-label"> <h3><span class="label label-info">Habilidades Técnicas </span></h3></label>
      </div></br>
			
		<?php if($hab['nivel']=="Básico")
			{	?>
			
          <div class="form-group">
            <label class="text col-md-4 control-label"> Nivel </label>
            <div class="col-md-4 selectContainer">
              <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-flag"></i></span>
                <select name="nivel" class="form-control selectpicker" id="nivel">
                  <option value="<?php echo $hab['fk_nivelHabi'] ?>"><?php echo $hab['nivel'] ?></option>
                  <?php
					$sql='select * from nivelidiom where cod_nivel!=1 and cod_nivel!=2';
					$nivel=$res->llenarSelect($sql);
					foreach ($nivel as $niv) {
					echo '<option value="'.$niv['0'].'">'.$niv['1'].'</option>';
					}?>
                </select>
              </div>
            </div>
          </div>
			
		<?php }
			elseif($hab['nivel']=="Intermedio")
			{ ?>
				
			<div class="form-group">
            <label class="text col-md-4 control-label"> Nivel </label>
            <div class="col-md-4 selectContainer">
              <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-flag"></i></span>
                <select name="nivel" class="form-control selectpicker" id="nivel">
                  <option value="<?php echo $hab['fk_nivelHabi'] ?>"><?php echo $hab['nivel'] ?></option>
                  <?php
					$sql='select * from nivelidiom where cod_nivel!=1 and cod_nivel!=2 and cod_nivel!=3';
					$nivel=$res->llenarSelect($sql);
					foreach ($nivel as $niv) {
					echo '<option value="'.$niv['0'].'">'.$niv['1'].'</option>';
					}?>
                </select>
              </div>
            </div>
          </div>
				
		<?php	}
			else
			{ ?>
			
			
			<div class="container">
			<div class="row text-center header animate-in" data-anim-type="fade-in-up">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class='services-wrapper' style="padding-top:150px">
						<input  name="nivel" id="nivel"  value="<?php echo $hab['fk_nivelHabi'] ?>" type=hidden>
						<h2><i class="fa fa-warning fa-2x"></i>Ya no puedes mejorar mas en esta habilidad</h2>
					</div>
				</div>
			</div>
		</div>
				
		<?php } ?>
			
          <!-- Button -->
          <div class="form-group">
            <label class="col-md-4 control-label"></label>
            <div class="col-md-4">
            <button type="submit" name="registrarse2" class="btn btn-warning btn-block" >Guardar <span class="glyphicon glyphicon-floppy-saved"></span></button>
            <a class="btn btn-danger btn-block" href="perfil_usuario.php#team">Cancelar <span class="glyphicon glyphicon-floppy-remove"></span></a>

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