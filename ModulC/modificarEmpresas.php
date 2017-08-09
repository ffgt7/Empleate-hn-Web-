<?php
ob_start();
?>
<?php
	require('../lib/Llenado_Select.php');
	$res=new Llenado_Select();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<?php require("../lib/movil.php"); ?>
<title>Modificar empresas</title>
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
<link rel= "stylesheet" type="text/css" href="../js/dist/sweetalert.css">
<script src= "../js/dist/sweetalert.min.js"></script>
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
            url: "../ModulF/Verifi_NombUserEmpre.php",
            data: dataString,
            success: function(data) {
                $('#Info').fadeIn(1000).html(data);
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
            url: "../ModulF/Verifi_CorreoEmpre.php",
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
<?php
	require "navSS.php";
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
	if(!isset($_GET["cod"]))
	{
		require("../lib/permisosG.php");
		return;
	}
	$cod=$_GET["cod"];
	if($_SESSION["cod_usuarioE"]!=$cod)
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
					window.location.href="perfil_empresa.php"
				});
			 </script>';
		return;
	}
	$sql="SELECT cod_usuario,descripcion,email,imagen,nomb_empre,fk_rubro,nomb_usuario,num_tel,pass,Pregunt_Seguri,web_site,respuesta,rubro,Preg_Segur 
          FROM usuarios_empre JOIN rubros on cod_rubro=fk_rubro JOIN preg_segur on cod_preg=Pregunt_Seguri 
          WHERE cod_usuario=$cod";
	$array=$res->llenarSelect($sql);
	foreach($array as $elemento):
?>
<div class="container">

    <form class="well form-horizontal" action="actualizarEmpresa.php" method="post"  id="contact_form" enctype="multipart/form-data" name="formulario">
<fieldset>

<!-- Form Name -->
<div class="form-group">
	<label class="text col-md-4 control-label"> <h3><span class="label label-info">Modificar Datos Empresa</span></h3></label> 
</div><br>

<!-- Text input-->

<div class="form-group">
 	<label class="text col-md-4 control-label">Nombre de usuario</label>  
  	<div class="col-md-4 inputGroupContainer">
  		<div class="input-group">
  			<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
  			<input  name="NombreTextBox" id="username" placeholder="Nombre de usuario" class="form-control" value="<?php echo $elemento['nomb_usuario'] ?>" type="text" >
    	</div>
  	</div>
	<label class="col-md-4"></label>
    <div id="Info"></div>
</div>

<div class="input-group">
  <input  name="cod" id="cod" placeholder="Nombre de la propuesta" class="form-control" value="<?php echo $elemento['cod_usuario'] ?>" type=hidden>
</div>

<div class="form-group">
  <label class="text col-md-4 control-label">Nombre de la empresa</label>  
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-edit"></i></span>
  <input name="NombEmpresa" placeholder="Nombre de la empresa" class="form-control" value="<?php echo $elemento['nomb_empre'] ?>" type="text">
    </div>
  </div>
</div>


<!-- Text input-->

<div class="form-group">
  <label class="text col-md-4 control-label">Correo electronico de la empresa</label>  
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
  <input name="Correo" placeholder="mail@example.com" id="correoE" class="form-control" value="<?php echo $elemento['email'] ?>" type="text">
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
  <input name="Num_Tel" placeholder="Número de teléfono de la empresa" class="form-control" value="<?php echo $elemento['num_tel'] ?>" type="text">
    </div>
  </div>
</div>

<!-- Text input-->

<div class="form-group">
  <label class="text col-md-4 control-label">Página web</label>  
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>
  <input name="Pag_web" id="Pag_web" placeholder="WWW" class="form-control" value="<?php echo $elemento['web_site'] ?>" type="text">
    </div>
</div>
</div>

<div class="form-group"> 
  <label class="text col-md-4 control-label">Actividad de la empresa</label>
    <div class="col-md-4 selectContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-briefcase"></i></span>
    <select name="Rub_Empre" id="Rub_Empre" class="form-control selectpicker" >
      <option value="<?php echo $elemento['fk_rubro'] ?>" ><?php echo $elemento['rubro'] ?></option>
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
        	<textarea class="form-control" rows="3" name="Descrip_Empre" placeholder="Breve descripción de la empresa"><?php echo $elemento['descripcion'] ?></textarea>
  </div>
  </div>
</div>

<!-- Success message -->
<div class="text alert alert-success" role="alert" id="success_message">Registro correcto <i class="glyphicon glyphicon-thumbs-up"></i> Gracias por registrarte.</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label"></label>
  <div class="col-md-4">
	<button type="submit" name="registrarse1" class="btn btn-warning btn-block" >Guardar<span class="glyphicon glyphicon-floppy-saved"></span></button>
	<a class="btn btn-danger btn-block" href="perfil_empresa.php">Cancelar <span class="glyphicon glyphicon-floppy-remove"></span></a>
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
<?php
ob_end_flush();
?>