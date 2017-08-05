<?php
	require('../lib/Llenado_Select.php');
	$res=new Llenado_Select();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<?php require("../lib/movil.php"); ?>
<title>Registro de empresas</title>
<script src="../js/jquery.js"></script>
<script src="../js/fileinput.js" type="text/javascript"></script>
<script src="../js/fileinput.min.js" type="text/javascript"></script>
<script src="../js/bootstrap.js"></script>
<script src="../js/bootstrapValidator.js" type="text/javascript"></script>
<script src="../js/messages_es.js" type="text/javascript"></script>
<script src="../js/registro_empresas.js" type="text/javascript"></script>
<link href="../css/registro.css" rel="stylesheet" type="text/css"/>
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
            url: "Verifi_NombUserEmpre.php",
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
    $('#correoE').blur(function(){

        $('#VeriCorr').html('<img src="../img/loader.gif" alt="" width="60px" height="60px"/>').fadeOut(1000);

        var correoE = $(this).val();        
        var dataString = 'correoE='+correoE;
		
		//var username = $(this).val();        
        //var dataString = JSON.stringify({username:username});

        $.ajax({
            type: "POST",
            url: "Verifi_CorreoEmpre.php",
            data: dataString,
            success: function(data) {
                $('#VeriCorr').fadeIn(1000).html(data);
            }
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
<br/>
<br/>
<body>
<?php require "navSS.php"; ?>
<div class="container">

    <form class="well form-horizontal" action="Insertar_RegisEmpre.php" method="post"  id="contact_form" enctype="multipart/form-data" name="formulario">
<fieldset>

<!-- Form Name -->
<div class="form-group">
<label class="text col-md-4 control-label"> <h3><span class="label label-info">Registro de empresas</span></h3></label> 
</div><br>


<!-- Text input-->

<div class="form-group">
 	<label class="text col-md-4 control-label">Nombre de usuario</label>  
  	<div class="col-md-4 inputGroupContainer">
  		<div class="input-group">
  			<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
  			<input  name="NombreTextBox" id="username" placeholder="Nombre de usuario" class="form-control"  type="text" >
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


<!-- Select Basic -->
   
<div class="form-group"> 
  <label class="text col-md-4 control-label">Pregunta</label>
    <div class="col-md-4 selectContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
    <select name="pregunta" class="form-control selectpicker" >
      <option value=" " >Seleccione una pregunta de seguridad</option>
       <?php 
		$sql='select * from preg_segur';
		$rows=$res->llenarSelect($sql);
		foreach ($rows as $row) {
		echo '<option value="'.$row['cod_preg'].'">'.$row['Preg_Segur'].'</option>';
	}?>
    </select>
  </div>
</div>
</div>

<!-- Text input-->
      
<div class="form-group">
  <label class="text col-md-4 control-label">Respuesta</label>  
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-check"></i></span>
  <input name="Resp_Segu" placeholder="R=" class="form-control" type="text">
    </div>
  </div>
</div>

<!-- Text input-->
 
<div class="form-group">
  <label class="text col-md-4 control-label">Nombre de la empresa</label>  
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-edit"></i></span>
  <input name="NombEmpresa" placeholder="Nombre de la empresa" class="form-control"  type="text">
    </div>
  </div>
</div>


<div class="form-group">
	<label class="text col-md-4 control-label">Logo de la empresa</label>  
  	<div class="col-md-4 inputGroupContainer">
    	<div class="input-group">
       		<input name="imagen" ID="Enviarimagen" type="file" class="file" data-preview-file-type="image" accept='image/*'>
       			<script>
					var $input = $("#Enviarimagen");
					$input.fileinput({
    					showUpload: false,
						showRemove: false
					});
				</script>
    	</div>
  	</div>
</div>


<!-- Text input-->

<div class="form-group">
  <label class="text col-md-4 control-label">Correo electronico de la empresa</label>  
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
  <input name="Correo" placeholder="mail@example.com" id="correoE" class="form-control"  type="text">
    </div>
</div>
<label class="col-md-4"></label>
    <div id="VeriCorr"></div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="text col-md-4 control-label">Número de teléfono</label>  
   <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-phone-alt"></i></span>
  <input name="Num_Tel" placeholder="Número de teléfono de la empresa" class="form-control" type="text">
    </div>
  </div>
</div>

<!-- Text input-->

<div class="form-group">
  <label class="text col-md-4 control-label">Página web</label>  
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>
  <input name="Pag_web" id="Pag_web" placeholder="WWW" class="form-control"  type="text">
    </div>
</div>
</div>

<div class="form-group"> 
  <label class="text col-md-4 control-label">Actividad de la empresa</label>
    <div class="col-md-4 selectContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-briefcase"></i></span>
    <select name="Rub_Empre" id="Rub_Empre" class="form-control selectpicker" >
      <option value=" " >Seleccione el rubro de su empresa</option>
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
<!-- Text area -->
  
<div class="form-group">
  <label class="text col-md-4 control-label">Descripción</label>
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
        	<textarea class="form-control" rows="3" name="Descrip_Empre" placeholder="Breve descripción de la empresa"></textarea>
  </div>
  </div>
</div>

<!-- Success message -->
<div class="text alert alert-success" role="alert" id="success_message">Registro correcto <i class="glyphicon glyphicon-thumbs-up"></i> Gracias por registrarte.</div>

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
</body>
</html>