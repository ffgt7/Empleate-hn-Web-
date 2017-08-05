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
<script src="../js/bootstrap.js"></script>
<link href="../css/registro.css" rel="stylesheet" type="text/css"/>
<script src="../js/bootstrapValidator.js" type="text/javascript"></script>
<script src="../js/Curri_ExpeLabo.js" type="text/javascript"></script>
<script src="../js/messages_es.js" type="text/javascript"></script>
<link href="../css/bootstrap.css" rel="stylesheet" type="text/css"/>
<script src="../js/sweetalert-dev.js"></script>
<link href="../css/sweetalert.css" rel="stylesheet" type="text/css"/>
<script src="../js/sweetalert.min.js"></script>
<script type="text/javascript">
	$(document).ready(function (){
	$("#CategoCurri").change(function () {
			$("#CategoCurri option:selected").each(function () {
				cod_cate = $(this).val();
				$.post("../ModulF/Puestos.php", { cod_cate: cod_cate}, function(data){
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

	$cod=$_GET['cod'];
	$cod2=$_SESSION['cod_usuario'];
	include("../lib/conexion.php");
	$sql1="select cod_curri from curri_expelabo where cod_curri=? and fk_userExpeLbo=?";
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
	$sql="SELECT cod_curri, Nomb_Empre, fech_FinTra, fech_IniTra, Nomb_EscriPuesto,descrip_Funcio,fk_actividad,fk_pais,fk_categ,fk_puesto, puesto, pais, rubro, catego FROM curri_expelabo JOIN puestos ON cod_Puesto = fk_puesto JOIN paises ON cod_pais = fk_pais JOIN rubros ON cod_rubro = fk_actividad JOIN categorias ON cod_catego = fk_categ where cod_curri=$cod";
	$array=$res->llenarSelect($sql);
	
?>
	
   <?php foreach($array as $elemento):?>
<br>
<div class="container">

    <form class="well form-horizontal" action="actualizarCurriExpeLabo.php" method="post"  id="form_CurriExLa" enctype="multipart/form-data" name="formulario">
<fieldset>

<!-- Form Name -->
<div class="form-group">
<label class="text col-md-4 control-label"> <h3><span class="label label-info">Modificar Experiencia Laboral</span></h3></label> 
</div><br>
<!-- Text input-->

<div class="form-group">
 	<label class="text col-md-4 control-label">Nombre de la empresa</label>  
  	<div class="col-md-4 inputGroupContainer">
  		<div class="input-group">
  			<span class="input-group-addon"><i class="glyphicon glyphicon-briefcase"></i></span>
  			<input  name="Nomb_Empre" placeholder="Nombre de la empresa" class="form-control" value="<?php echo $elemento['Nomb_Empre'] ?>" type="text" >
    	</div>
  	</div>
</div>

<div class="input-group">
  <input  name="cod" id="cod" placeholder="" class="form-control" value="<?php echo $elemento['cod_curri'] ?>" type=hidden>
    </div>
<!-- Select Basic -->
   
<div class="form-group"> 
  <label class="text col-md-4 control-label">País</label>
    <div class="col-md-4 selectContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-flag"></i></span>
    <select name="pais" class="form-control selectpicker" value="<?php echo $elemento['pais'] ?>" >
      <option value="<?php echo $elemento['fk_pais'] ?>" ><?php echo $elemento['pais'] ?></option>
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
    <select name="Acti_Empre" class="form-control selectpicker"  >
      <option value="<?php echo $elemento['fk_actividad'] ?>" ><?php echo $elemento['rubro'] ?></option>
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
  <input name="PuestCargo" placeholder="Nombre del cargo desempeñado" class="form-control" value="<?php echo $elemento['puesto'] ?>" type="text" >
    </div>
  </div>
</div>

<!-- Select Basic -->
<div class="form-group"> 
  <label class="text col-md-4 control-label">Categoria</label>
    <div class="col-md-4 selectContainer">
    	<div class="input-group">
        	<span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
    		<select name="Categoria" id="CategoCurri" class="form-control selectpicker" value="<?php echo $elemento['cate_Expe'] ?>"  >
      			<option value="<?php echo $elemento['fk_categ'] ?>" ><?php echo $elemento['catego'] ?></option>
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
    		<select name="PustoDesem" id="PustoDesem" class="form-control selectpicker"  >
      			<option value="<?php echo $elemento['fk_puesto'] ?>" ><?php echo $elemento['puesto'] ?></option>
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
        	<textarea class="form-control"  rows="3" contenteditable="false" name="Descrip_Funcio" placeholder="Breve descripción de las principales funciones desempeñadas"><?php echo $elemento['descrip_Funcio'] ?></textarea>
  		</div>
  	</div>
</div>


<div class="form-group">
 	<label class="text col-md-4 control-label">Fecha de inicio y fin</label>
    <div class="col-md-4 inputGroupContainer">
    	<div class="input-group">
        	<span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
        	<input name="Fech_Ini" placeholder="Fecha de inicio trabajo"  class="form-control" value="<?php echo $elemento['fech_IniTra'] ?>" type="date" >
        	<br/>
        	<input name="Fech_Fin" placeholder="Fecha finalización trabajo" class="form-control" value="<?php echo $elemento['fech_FinTra'] ?>" type="date" >
  		</div>
  	</div>
</div>

<!-- Select Basic -->
<div class="form-group"> 
  <label class="text col-md-4 control-label">Beneficios Otorgados</label>
    <div class="col-md-4 selectContainer">
    	<div class="input-group">
        	<span class="input-group-addon"><i class="glyphicon glyphicon-dashboard"></i></span>
    		<select name="Beneficios[]" class="form-control selectpicker" value="<?php echo $elemento['fech_FinTra'] ?>" multiple >
      			<option value=" " >Seleccione los beneficios otorgados</option>
       				<?php 
						$sql='select * from beneficios';
						$beneficios=$res->llenarSelect($sql);
						foreach ($beneficios as $bene) {
							echo '<option value="'.$bene['0'].'">'.$bene['1'].'</option>';
					}?>
					<option value="" >Otros</option>
    		</select>
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

</fieldset>
</form>
<p id="aviso"></p>

</div>
    </div><!-- /.container -->
	<?php endforeach; ?>
</body>
</html>