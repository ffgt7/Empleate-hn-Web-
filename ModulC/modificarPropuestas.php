<?php
require('../lib/Llenado_Select.php');
$res=new Llenado_Select();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Modificar Oferta</title>
<?php require("../lib/movil.php"); ?>
<script src="../js/jquery.js"></script>
<script src="../js/bootstrap.js"></script>
<link href="../css/registro.css" rel="stylesheet" type="text/css"/>
<script src="../js/bootstrapValidator.js" type="text/javascript"> </script>
<script src="../js/chris.js" type="text/javascript"></script>
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
	require("../lib/permisosE.php");
	$cod=$_GET["cod"];
	$sq="select cod_propuesta, nombreP, tipoP, fk_experienciaP, generoP, edad, salarioP, vehiculoP, licenciaP, departamentoP,
	caducidadP, tituloP, descripcionP, vacantesP, cargoP, edad2, salario2, descripcion2, descripcion3, fk_areaP, 
	fk_departamento, fk_municipio, fk_nivelIdiom, fk_userEmpre, fk_idioma, catego, depart, muni, nivel, nomb_empre, idioma,experien 
	from propuesta join categorias on cod_catego=fk_areaP join departamentos on cod_depart=fk_departamento join municipios on 
	cod_muni=fk_municipio join nivelidiom on cod_nivel=fk_nivelIdiom join usuarios_empre on cod_usuario=fk_userEmpre join
	idioma on cod_idioma=fk_idioma join experiencia on cod_experi=fk_experienciaP where cod_propuesta=$cod";
	$array=$res->llenarSelect($sq);
?>

<?php foreach($array as $elemento): ?>
	<div class="container ">

    <form class="well form-horizontal" action="actualizarPropuesta.php" method="post"  id="contact_form">
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
  <input  name="nombre" id="nombre" placeholder="Nombre de la propuesta" class="form-control" value="<?php echo $elemento["nombreP"] ?>" type="text">
    </div>
  </div>
</div>

<div class="input-group">
  <input  name="cod" id="cod" placeholder="" class="form-control" value="<?php echo $elemento['cod_propuesta'] ?>" type=hidden>
</div>


<div class="form-group"> 
  <label class="text col-md-4 control-label">Área de Trabajo</label>
    <div class="col-md-4 selectContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-briefcase"></i></span>
    <select name="area" id="area" class="form-control selectpicker" >
      <option value="<?php echo $elemento["fk_areaP"] ?>" ><?php echo $elemento["catego"] ?></option>
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


       <div class="form-group">
  <label class="text col-md-4 control-label">Cargo Solicitado</label>  
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-briefcase"></i></span>
  <input name="cargo" id="cargo" placeholder="Cargo a desempeñar" class="form-control" value="<?php echo $elemento["cargoP"] ?>" type="text">
    </div>
  </div>
</div>


       <div class="form-group">
  <label class="text col-md-4 control-label">Vacantes</label>  
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
  <input name="vacantes" id="vacantes" placeholder="Vacantes disponibles" class="form-control" value="<?php echo $elemento["vacantesP"] ?>" type="text">
    </div>
  </div>
</div>


<div class="form-group"> 
  <label class="text col-md-4 control-label">Tipo de Contratación</label>
    <div class="col-md-4 selectContainer">
    <div class="input-group  ">
        <span class="input-group-addon" ><i class="glyphicon glyphicon-time"></i></span>
    <select name="tipoCont" class="form-control selectpicker" >
      <option value="<?php echo $elemento["tipoP"] ?>" ><?php echo $elemento["tipoP"] ?></option>
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
  <input name="departamentoV" id="departamentoV" placeholder="Lugar donde esta la vacante" class="form-control" value="<?php echo $elemento["departamentoP"] ?>" type="text">
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
      				<option value="<?php echo $elemento["fk_departamento"] ?>" ><?php echo $elemento["depart"] ?></option>
       					<?php 
							$sql='select * from departamentos order by depart;';
							$consulta=$res->llenarSelect($sql);
							foreach ($consulta as $consul) {
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
     				<option value="<?php echo $elemento["fk_municipio"] ?>" ><?php echo $elemento["muni"] ?></option>
      			</select>
  		</div>
	</div>
</div>




       <div class="form-group">
  <label class="text col-md-4 control-label">Salario</label>  
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
  <input name="salario" id="salario" placeholder="Salario del minimo" class="form-control" value="<?php echo $elemento["salarioP"] ?>" type="text">
    </div>
    </div>
</div>
    
     <div class="form-group">
  <label class="col-md-4 control-label"></label>  
    <div class="col-md-4 inputGroupContainer">
    
	<div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
  <input name="salario2" id="salario2" placeholder="Salario del máximo" class="form-control" value="<?php echo $elemento["salario2"] ?>" type="text">
    </div>
  </div>
</div>

  <div class="form-group">
  <label class="text col-md-4 control-label">Fecha de Caducidad</label>  
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>
  <input name="caducidad" id="caducidad" placeholder="Fecha de vencimiento de la oferta" class="form-control" value="<?php echo $elemento["caducidadP"] ?>" type="date">
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
      <option value="<?php echo $elemento["fk_experienciaP"] ?>" ><?php echo $elemento["experien"] ?></option>
      <option>Ninguna</option>
      <option>Menos de 1 año</option> 
	  <option>2 años</option> 
	  <option>3 años</option> 
	  <option>4 años</option> 
	  <option>5 años</option> 
	  <option>Mas de 5 años</option> 
    </select>
  </div>
</div>
</div>	



       <div class="form-group">
  <label class="text col-md-4 control-label">Título</label>  
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-file"></i></span>
  <input name="titulo" id="titulo" placeholder="Título requerido para la vacante" class="form-control" value="<?php echo $elemento["tituloP"] ?>" type="text">
    </div>
  </div>
</div>

<div class="form-group">
	<label class="text col-md-4 control-label"> Idioma </label>
	<div class="col-md-4 selectContainer">
		<div class="input-group">
			<span class="input-group-addon"><i class="glyphicon glyphicon-flag"></i></span>
			<select name="idioma" class="form-control selectpicker">
				<option value="<?php echo $elemento["fk_idioma"] ?>"><?php echo $elemento["idioma"] ?></option>
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
				<option value="<?php echo $elemento["fk_nivelIdiom"] ?>"><?php echo $elemento["nivel"] ?></option>
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
      <option value="<?php echo $elemento["generoP"] ?>" ><?php echo $elemento["generoP"] ?></option>
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
  <input name="edad" id="edad" placeholder="Edad minima requerida" class="form-control" value="<?php echo $elemento["edad"] ?>" type="text">
    </div>
    </div>
</div>
    
    
    
    <div class="form-group">
  <label class="col-md-4 control-label"></label>  
    <div class="col-md-4 inputGroupContainer">
	<div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
  <input name="edad2" id="edad2" placeholder="Edad máxima requerida" class="form-control" value="<?php echo $elemento["edad2"] ?>" type="text">
    </div>
  </div>
</div>

    

<div class="form-group"> 
  <label class="text col-md-4 control-label">Vehículo</label>
    <div class="col-md-4 selectContainer">
    <div class="input-group  ">
        <span class="input-group-addon" ><i class="glyphicon glyphicon-road"></i></span>
    <select name="vehiculo" class="form-control selectpicker" >
      <option value="<?php echo $elemento["vehiculoP"] ?>" ><?php echo $elemento["vehiculoP"] ?></option>
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
      <option value="<?php echo $elemento["licenciaP"] ?>" ><?php echo $elemento["licenciaP"] ?></option>
      <option >Indiferente</option>
      <option>Libiana</option>
      <option>Pesado</option>   
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
        	<textarea class="form-control" value="<?php echo $elemento["descripcionP"] ?>" name="descripcion" placeholder="Especificaciones"><?php echo $elemento["descripcionP"] ?></textarea>
  </div>
  </div>
</div>


<div class="form-group">
  <label class="col-md-4 control-label"></label>
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
        	<textarea class="form-control"value="<?php echo $elemento["descripcion2"] ?>" name="descripcion2" placeholder="Funciones a desempeñar en el cargo"><?php echo $elemento["descripcion2"] ?></textarea>
  </div>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label"></label>
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
        	<textarea class="form-control" value="<?php echo $elemento["descripcion3"] ?>" name="descripcion3" placeholder="Objetivos del cargo"><?php echo $elemento["descripcion3"] ?></textarea>
  </div>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label"></label>
  <div class="col-md-4">
    <button type="submit" name="registrarse" class="btn btn-warning btn-block" >Actualizar</button>
	<a class="btn btn-danger btn-block" href="perfil_empresa.php">Cancelar <span class="glyphicon glyphicon-floppy-remove"></span></a>
  </div>

</fieldset>
</form>
</div>
    </div>
  <?php endforeach; ?>
</body>
</html>