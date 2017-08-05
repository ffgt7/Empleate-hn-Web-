<?php
ob_start(); 
require('../lib/Llenado_Select.php');
$res=new Llenado_Select();
?>
<!doctype html>
<html><head>
<meta charset="utf-8">
<?php require("../lib/movil.php"); ?>
<title>Registro de usuarios</title>
<script src="../js/jquery-1.11.1.js"></script>
<script src="../js/fileinput.js" type="text/javascript">
</script>
<script src="../js/fileinput.min.js" type="text/javascript">
</script>
<script src="../js/bootstrap.js"></script>
<script src="../js/bootstrapValidator.js" type="text/javascript">
</script>
<script src="../js/registroUser.js" type="text/javascript">
</script>
<script src="../js/messages_es.js" type="text/javascript">
</script>
<link href="../css/bootstrap.css" rel="stylesheet" type="text/css"/>
<link href="../css/fileinput.css" rel="stylesheet" type="text/css"/>
<link href="../css/fileinput.min.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript">
$(document).ready(function() {    
    $('#username').blur(function(){

        $('#Info').html('<img src="../img/loader.gif" alt="" width="60px" height="60px"/>').fadeOut(1000);

        var username = $(this).val();        
        var dataString = 'username='+username;
		
		//var username = $(this).val();        
        //var dataString = JSON.stringify({username:username});

        $.ajax({
            type: "POST",
            url: "Verifi_NombUserEmpleo.php",
            data: dataString,
            success: function(data) {
                $('#Info').fadeIn(1).html(data);
            }
        });
    });              
});    
</script>
<script type="text/javascript">
$(document).ready(function() {    
    $('#Correo_User').blur(function(){

        $('#Veri_Corre').html('<img src="../img/loader.gif" alt="" width="60px" height="60px"/>').fadeOut(1000);

        var Correo_User = $(this).val();        
        var dataString = 'Correo_User='+Correo_User;
		
		//var username = $(this).val();        
        //var dataString = JSON.stringify({username:username});

        $.ajax({
            type: "POST",
            url: "Verifi_CorreoUserDesemp.php",
            data: dataString,
            success: function(data) {
                $('#Veri_Corre').fadeIn(1000).html(data);
            }
        });
    });              
});    
</script>
<script type="text/javascript">
$(document).ready(function(){
   $("#Depart_Usuario").change(function () {
           $("#Depart_Usuario option:selected").each(function () {
            cod_depart = $(this).val();
            $.post("Municipios.php", { cod_depart: cod_depart }, function(data){
                $("#Muni_Usuario").html(data);
            });            
        });
   })
});
</script>
<style>
	.text{
		color: white;
	}	
</style>
</head>
<br/>
<br/>
<body>
<?php require "navSS.php"; ?>
	<div class="container">
		<form class="well form-horizontal" action="Insertar_RegisUsuarios.php" method="post"  id="formUser" enctype="multipart/form-data" name="formulario">
	<fieldset>
	<!-- Form Name -->
	<div class="form-group">
		<label class="text col-md-4 control-label"> <h3><span class="label label-info">Registro de usuarios</span></h3></label> 
	</div><br>
	
	
	<!-- Text input-->
	<div class="form-group">
  		<label class="text col-md-4 control-label">Nombre de usuario</label>     					
  		<div class="col-md-4 inputGroupContainer">
  			<div class="input-group">
  				<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
  				<input  name="Nomb_Usuario" id="username" placeholder="Nombre de usuario" class="form-control" type="text" >
    		</div>
  		</div>
		<label class="col-md-4"></label>
    	<div id="Info"></div>
   </div>


<!-- Text input-->
   <div class="form-group">
  		<label class="text col-md-4 control-label" >Contraseña</label> 
    	<div class="col-md-4 inputGroupContainer">
  	  		<div class="input-group">
  				<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
  				<input name="Contrase" placeholder="Contraseña" class="form-control"  type="password" >
  			</div>
  		</div>
	</div>

<!-- Text input-->
	<div class="form-group">
  		<label class="text col-md-4 control-label">Confirmar contraseña</label>  
  		<div class="col-md-4 inputGroupContainer">
    		<div class="input-group">
        		<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
  				<input name="Confircontrase" placeholder="Confirmar contraseña" class="form-control"  type="password">
    		</div>
  		</div>
	</div>

<!-- Imagen de perfil-->
	<div class="form-group">
  		<label class="text col-md-4 control-label">Imagen de perfil</label>  
  		<div class="col-md-4 inputGroupContainer">
    		<div class="input-group">
       			<input name="imagen_Usuario" ID="Enviarimagen" type="file" size="20" class="file" data-preview-file-type="image" accept='image/*'>
       			<script>
		   			var $input = $("#Enviarimagen");
		   			$input.fileinput({
    					showUpload: false,
						showRemove: false,
					});
	  			</script>
	  			
    		</div>
  		</div>
	</div>

	<!-- Text input-->
	<div class="form-group">
  		<label class="text col-md-4 control-label">Nombres</label>  
  		<div class="col-md-4 inputGroupContainer">
    		<div class="input-group">
        		<span class="input-group-addon"><i class="glyphicon glyphicon-edit"></i></span>
  				<input name="NombUser" placeholder="Introduzca sus nombres" class="form-control"  type="text">
    		</div>
  		</div>
	</div>

	<!-- Text input-->
	<div class="form-group">
  		<label class="text col-md-4 control-label">Apellidos</label>  
  		<div class="col-md-4 inputGroupContainer">
    		<div class="input-group">
        		<span class="input-group-addon"><i class="glyphicon glyphicon-edit"></i></span>
  				<input name="Apellidos_Usuario" placeholder="Introduzca sus apellidos" class="form-control"  type="text">
    		</div>
  		</div>
	</div>
	
	<div class="form-group">
	  <label class="text col-md-4 control-label" >Identidad</label> 
		<div class="col-md-4 inputGroupContainer">
		<div class="input-group">
	  <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
	  <input name="identidadC"  placeholder="Número de identidad" class="form-control"  type="text">
		</div>
	  </div>
	</div>
	
	<!-- Text input-->
	<div class="form-group">
  		<label class="text col-md-4 control-label">Fecha de nacimiento</label>  
  		<div class="col-md-4 inputGroupContainer">
    		<div class="input-group">
        		<span class="input-group-addon"><i class="glyphicon glyphicon-edit"></i></span>
  				<input name="Naci_Usuario" placeholder="Introduzca su fecha de nacimiento" class="form-control"  type="date">
    		</div>
  		</div>
	</div>
	
	<!-- Select Basic -->
	<div class="form-group"> 
  		<label class="text col-md-4 control-label">Nacionalidad</label>
    	<div class="col-md-4 selectContainer">
    		<div class="input-group">
        		<span class="input-group-addon"><i class="glyphicon glyphicon-flag"></i></span>
    			<select name="Nacionalidad_Usuario" class="form-control selectpicker" >
      				<option value=" " >Seleccione su nacionalidad</option>
       					<?php 
							$sql='select * from nacionalidades order by nacionalidad;';
							$nacionalidad=$res->llenarSelect($sql);
							foreach ($nacionalidad as $nacio) {
								echo '<option value="'.$nacio['0'].'">'.$nacio['nacionalidad'].'</option>';
						}?>
    			</select>
  			</div>
		</div>
	</div>

	<!-- Select Basic -->
	<div class="form-group"> 
  		<label class="text col-md-4 control-label">Sexo</label>
    	<div class="col-md-4 selectContainer">
    		<div class="input-group">
        		<span class="input-group-addon"><i class="glyphicon glyphicon-option-vertical"></i></span>
    			<select name="Sexo_Usuario" class="form-control selectpicker" >
      				<option value=" " >Seleccione su sexo</option>
					<option value="F" >Femenino</option>
       				<option value="M" >Masculino</option>
					<option value="O" >Otros</option>	
    			</select>
  			</div>
		</div>
	</div>

	<!-- Select Basic -->
	<div class="form-group"> 
  		<label class="text col-md-4 control-label">Departamento de residencia</label>
    	<div class="col-md-4 selectContainer">
    		<div class="input-group">
        		<span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
    			<select name="Depart_Usuario" id="Depart_Usuario" class="form-control selectpicker" >
      				<option value=" " >Seleccione un departamento</option>
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

	<!-- Select Basic -->
	<div class="form-group"> 
  		<label class="text col-md-4 control-label">Municipio de residencia</label>
    	<div class="col-md-4 selectContainer">
    		<div class="input-group">
        		<span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
    			<select name="Muni_Usuario" id="Muni_Usuario" class="form-control selectpicker">
     				<option value=" " >Seleccione un municipio</option>
      			</select>
  		    </div>
	    </div>
    </div>

<!-- Text area -->
<div class="form-group">
  <label class="text col-md-4 control-label">Dirección</label>
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
        	<textarea class="form-control" name="Direcc_Usuario" placeholder="Ingrese su dirección"></textarea>
  </div>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="text col-md-4 control-label">Número de teléfono</label>  
   <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-phone-alt"></i></span>
  <input name="TelFijo_Usuario" placeholder="Teléfono fijo" class="form-control" type="text">
    </div>
  </div>
</div>


<!-- Text input-->
<div class="form-group">
  <label class="text col-md-4 control-label">Número de teléfono</label>  
   <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
  <input name="TelMovil_Usuario" placeholder="Teléfono móvil" class="form-control" type="text">
    </div>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="text col-md-4 control-label">Correo electronico</label>  
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
  <input name="Correo_Usuario" id="Correo_User" placeholder="mail@example.com" class="form-control"  type="text">
    </div>
</div>
<div id="Veri_Corre"></div>
</div>

<!-- Select Basic -->
<div class="form-group"> 
  <label class="text col-md-4 control-label">¿Posee vehículo?</label>
    <div class="col-md-4 selectContainer">
    	<div class="input-group">
        	<span class="input-group-addon"><i class="glyphicon glyphicon-scale"></i></span>
    		<select name="Vehi_Usuario" class="form-control selectpicker" >
     		<option value=" " >Seleccione una respuesta</option>
     		<option>Si</option>
     		<option>No</option>
      		</select>
  		</div>
	</div>
</div>

<div class="form-group"> 
  <label class="text col-md-4 control-label">¿Posee motocicleta?</label>
    <div class="col-md-4 selectContainer">
    	<div class="input-group">
        	<span class="input-group-addon"><i class="glyphicon glyphicon-scale"></i></span>
    		<select name="Moto_Usuario" class="form-control selectpicker" >
     		<option value=" " >Seleccione una respuesta</option>
     		<option>Si</option>
     		<option>No</option>
      		</select>
  		</div>
	</div>
</div>


<div class="form-group"> 
  <label class="text col-md-4 control-label">Tipo de licencia:</label>
    <div class="col-md-4 selectContainer">
    	<div class="input-group">
        	<span class="input-group-addon"><i class="glyphicon glyphicon-option-vertical"></i></span>
        	<input name="TipLicen_Usuario" value="" type=hidden>
    		<select name="TipLicen_Usuario" id="Tip_Licen" class="form-control selectpicker">
     		<option value=" " >Seleccione una opción</option>
			<?php 
						$sql='select * from licencias;';
						$Licencia=$res->llenarSelect($sql);
						foreach ($Licencia as $licen) {
							echo '<option value="'.$licen['0'].'">'.$licen['1'].'</option>';
					}?>
      		</select>
  		</div>
	</div>
</div>
<!-- Text area -->
<div class="form-group">
  <label class="text col-md-4 control-label">Descripción</label>
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
        <textarea class="form-control" name="Descrip_Usuario" placeholder="Descripción de sus competencias y cualidades"></textarea>
  </div>
  </div>
</div>


<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label"></label>
  <div class="col-md-4">
    <button type="submit" name="registrarse" class="btn btn-warning btn-block" >Registrarse <span class="glyphicon glyphicon-send"></span></button>
	<a class="btn btn-danger btn-block" href="../index.php">Cancelar <span class="glyphicon glyphicon-floppy-remove"></span></a>
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
</body>
</html>
<?php
    ob_end_flush();	
?>