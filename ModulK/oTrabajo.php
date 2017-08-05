
<!doctype html>
<html>
<head>
<?php require("../lib/movil.php"); ?>
<meta charset="utf-8">
<title>Publica tu Oferta</title>
<script src="../js/jquery.js"></script>
<script src="../js/bootstrap.js"></script>
<link href="../css/registro.css" rel="stylesheet" type="text/css"/>
<script src="../js/bootstrapValidator.js" type="text/javascript"> </script>
<script src="../js/chris.js" type="text/javascript"></script>
<script src="../js/messages_es.js" type="text/javascript"></script>
<link href="../css/bootstrap.css" rel="stylesheet" type="text/css"/>
<style>
	.text{
		color: white;
	}	
</style>
<script type="text/javascript">
$(document).ready(function(){
   $("#Depart_Usuario").change(function () {
           $("#Depart_Usuario option:selected").each(function () {
            cod_depart = $(this).val();
            $.post("../ModulF/Municipios.php", { cod_depart: cod_depart }, function(data){
                $("#Muni_Usuario").html(data);
            });            
        });
   })
});
</script>
</head>

<body>
<?php 
	require "navSS.php";
	$res=new Llenado_Select();
	$host=$_SERVER["HTTP_HOST"];
	$url=$_SERVER["REQUEST_URI"];
	$dire="http://" . $host . $url;
	if(!isset($_SESSION["cod_usuarioE"]))
	{
		echo '<script>
				window.location.href="../lib/permisosE.php'; echo '?url=';echo $dire;echo '"; 
			  </script>';
		return;	
	}
	?>
	<div class="container ">

    <form class="well form-horizontal" action=" gPropuestas.php" method="post"  id="contact_form">
<fieldset>

<legend>Datos de Propuesta</legend>

<div class="form-group">
	<label class="text col-md-4 control-label"> <h3><span class="label label-info">Datos de Propuesta</span></h3></label> 
</div><br>


<div class="form-group">
  <label class="text col-md-4 control-label">Nombre de la Oferta</label>  
  <div class="col-md-4 inputGroupContainer">
  <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
  <input  name="nombre" id="nombre" placeholder="Nombre de la propuesta" class="form-control"  type="text">
    </div>
  </div>
</div>


<div class="form-group"> 
  <label class="text col-md-4 control-label">Área de Trabajo</label>
    <div class="col-md-4 selectContainer">
		<div class="input-group">
			<span class="input-group-addon"><i class="glyphicon glyphicon-briefcase"></i></span>
			<select name="area" id="area" class="form-control selectpicker" >
				<option value=" " >Seleccione una categoria</option>
				<?php 
					$sql='select * from categorias';
					$categoria=$res->llenarSelect($sql);
					foreach ($categoria as $cate) 
					{
						echo '<option value="'.$cate['0'].'">'.$cate['1'].'</option>';
					}
				?>
			</select>
		</div>
	</div>
</div>


<div class="form-group">
  <label class="text col-md-4 control-label">Cargo Solicitado</label>  
    <div class="col-md-4 inputGroupContainer">
		<div class="input-group">
			<span class="input-group-addon"><i class="glyphicon glyphicon-briefcase"></i></span>
			<input name="cargo" id="cargo" placeholder="Cargo a desempeñar" class="form-control"  type="text">
		</div>
	</div>
</div>


<div class="form-group">
  <label class="text col-md-4 control-label">Vacantes</label>  
    <div class="col-md-4 inputGroupContainer">
		<div class="input-group">
			<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
			<input name="vacantes" id="vacantes" placeholder="Vacantes disponibles" class="form-control"  type="text">
		</div>
	</div>
</div>


<div class="form-group"> 
  <label class="text col-md-4 control-label">Tipo de Contratación</label>
    <div class="col-md-4 selectContainer">
		<div class="input-group  ">
			<span class="input-group-addon" ><i class="glyphicon glyphicon-time"></i></span>
			<select name="tipoCont" class="form-control selectpicker" >
				<option value="" >Horio de trabajo</option>
				<option>Medio tiempo</option>
				<option>Tiempo completo</option>
				<option >Horario mixto</option>
			</select>
		</div>
	</div>
</div>


<div class="form-group">
  <label class="text col-md-4 control-label">Ubicación</label>  
    <div class="col-md-4 inputGroupContainer">
		<div class="input-group">
			<span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>
			<input name="departamentoV" id="departamentoV" placeholder="Lugar donde esta la vacante" class="form-control"  type="text">
		</div>
  </div>
</div>

<!-- Select Basic -->
<div class="form-group"> 
  	<label class="col-md-4 control-label">Departamento</label>
    <div class="col-md-4 selectContainer">
    	<div class="input-group">
        	<span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
    		<select name="Depart_Usuario" id="Depart_Usuario" class="form-control selectpicker" >
      			<option value="" >Seleccione un departamento</option>
       				<?php 
						$sql='select * from departamentos order by depart;';
						$consulta=$res->llenarSelect($sql);
						foreach ($consulta as $consul) 
						{
							echo '<option value="'.$consul['0'].'">'.$consul['1'].'</option>';
						}
					?>
    		</select>
  		</div>
	</div>
</div>


<div class="form-group"> 
	<label class="col-md-4 control-label">Municipio</label>
    <div class="col-md-4 selectContainer">
    	<div class="input-group">
        	<span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
    		<select name="Muni_Usuario" id="Muni_Usuario" class="form-control selectpicker">
     			<option value="" >Seleccione un municipio</option>
      		</select>
  		</div>
	</div>
</div>

<div class="form-group">
  <label class="text col-md-4 control-label">Salario</label>  
   <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
       <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
		<input name="salario" id="salario" placeholder="Salario del minimo" class="form-control"  type="text">
    </div>
   </div>
</div>
    
<div class="form-group">
  <label class="col-md-4 control-label"></label>  
   <div class="col-md-4 inputGroupContainer">
	<div class="input-group">
		<span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
		<input name="salario2" id="salario2" placeholder="Salario del máximo" class="form-control"  type="text">
    </div>
  </div>
</div>

  <div class="form-group">
  <label class="text col-md-4 control-label">Fecha de Caducidad</label>  
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>
  <input name="caducidad" id="caducidad" placeholder="Fecha de vencimiento de la oferta" class="form-control"  type="date">
    </div>
  </div>
</div>
<br>
<br>
<br>

<div class="form-group">
<label class="text col-md-6 control-label">Requisitos de la oferta de trabajo</label> 
</div><br>


<div class="form-group"> 
  <label class="text col-md-4 control-label">Experiencia laboral</label>
    <div class="col-md-4 selectContainer">
		<div class="input-group  ">
			<span class="input-group-addon" ><i class="glyphicon glyphicon-time"></i></span>
			<select name="experienciaLab" id="experiencia" class="form-control selectpicker" >
				<option value="" >Seleccione los Años de Experiencia</option>
				<?php 
					$sql='select * from experiencia';
					$experien=$res->llenarSelect($sql);
					foreach ($experien as $expe) 
					{
						echo '<option value="'.$expe['0'].'">'.$expe['1'].'</option>';
					}
				?>
			</select>
		</div>
	</div>
</div>	



<div class="form-group">
	<label class="text col-md-4 control-label">Título</label>  
    <div class="col-md-4 inputGroupContainer">
		<div class="input-group">
			<span class="input-group-addon"><i class="glyphicon glyphicon-file"></i></span>
			<input name="titulo" id="titulo" placeholder="Título requerido para la vacante" class="form-control"  type="text">
		</div>
	</div>
</div>

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

<div class="form-group"> 
  <label class="text col-md-4 control-label">Género</label>
    <div class="col-md-4 selectContainer">
    <div class="input-group  ">
        <span class="input-group-addon" ><i class="glyphicon glyphicon-time"></i></span>
    <select name="genero" class="form-control selectpicker" >
      <option value=" " >Seleccione un genero</option>
      <option>Masculino</option>
      <option>Femenino</option> 
		<option>Indistinto</option> 
    </select>
  </div>
</div>
</div>	

 <div class="form-group">
  <label class="text col-md-4 control-label">Edad</label>  
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
  <input name="edad" id="edad" placeholder="Edad minima requerida" class="form-control"  type="text">
    </div>
    </div>
</div>
    
    
    
    <div class="form-group">
  <label class="col-md-4 control-label"></label>  
    <div class="col-md-4 inputGroupContainer">
	<div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
  <input name="edad2" id="edad2" placeholder="Edad máxima requerida" class="form-control"  type="text">
    </div>
  </div>
</div>

    

<div class="form-group"> 
  <label class="text col-md-4 control-label">Vehículo</label>
    <div class="col-md-4 selectContainer">
    <div class="input-group  ">
        <span class="input-group-addon" ><i class="glyphicon glyphicon-road"></i></span>
    <select name="vehiculo" class="form-control selectpicker" >
      <option value=" " >Seleccione un vehículo</option>
      <option >Indiferente</option>
      <option>Carro</option>
      <option>Moticicleta</option>
    </select>
  </div>
</div>
</div>
	
<div class="form-group"> 
  <label class="text col-md-4 control-label">Tipo de Licencia</label>
    <div class="col-md-4 selectContainer">
    <div class="input-group  ">
        <span class="input-group-addon" ><i class="glyphicon glyphicon-road"></i></span>
    <select name="tipoLicen" class="form-control selectpicker" >
      <option value="" >Seleccione un tipo</option>
      <option >Indiferente</option>
      <option>Libiana</option>
      <option>Pesada</option>   
      <option>Especial</option>    
    </select>
  </div>
</div>
</div>
	
 
<br>

<div class="form-group">
<label class="text col-md-5 control-label">Descripción de la Oferta de Trabajo</label> 
</div>
<div class="form-group">
  <label class="col-md-4 control-label"></label>
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
        	<textarea class="form-control" name="descripcion" placeholder="Especificaciones"></textarea>
  </div>
  </div>
</div>


<div class="form-group">
  <label class="col-md-4 control-label"></label>
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
        	<textarea class="form-control" name="descripcion2" placeholder="Funciones a desempeñar en el cargo"></textarea>
  </div>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label"></label>
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
        	<textarea class="form-control" name="descripcion3" placeholder="Objetivos del cargo"></textarea>
  </div>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label"></label>
  <div class="col-md-4">
    <button type="submit" class="btn btn-warning btn-block" >Guardar <span class="glyphicon glyphicon-folder-open"></span></button>
	<a class="btn btn-danger btn-block" href="../ModulC/perfil_empresa.php">Cancelar <span class="glyphicon glyphicon-floppy-remove"></span></a>
  </div>
</div>

</fieldset>
</form>
</div>
    </div>
</body>
</html>