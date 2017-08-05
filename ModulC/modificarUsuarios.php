<?php
ob_start();
?>
<?php
require('../lib/Llenado_Select.php');
$res=new Llenado_Select();
?>
<!doctype html>
<html><head>
<meta charset="utf-8">
<?php require("../lib/movil.php"); ?>
<title>Modificar Usuarios</title>
<script src="../js/jquery.js"></script>
<script src="../js/fileinput.js" type="text/javascript"></script>
<script src="../js/fileinput.min.js" type="text/javascript"></script>
<script src="../js/bootstrap.js"></script>
<script src="../js/bootstrapValidator.js" type="text/javascript"></script>
<script src="../js/registroUser.js" type="text/javascript"></script>
<script src="../js/messages_es.js" type="text/javascript"></script>
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
            url: "../ModulF/Verifi_NombUserEmpleo.php",
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
    $('#Correo_User').blur(function(){

        $('#Veri_Corre').html('<img src="../img/loader.gif" alt="" width="60px" height="60px"/>').fadeOut(1000);

        var Correo_User = $(this).val();
        var dataString = 'Correo_User='+Correo_User;

		//var username = $(this).val();
        //var dataString = JSON.stringify({username:username});

        $.ajax({
            type: "POST",
            url: "../ModulF/Verifi_CorreoUserDesemp.php",
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
            $.post("../ModulF/Municipios.php", { cod_depart: cod_depart }, function(data){
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
	$cod=$_GET["cod"];
	if($_SESSION["cod_usuario"]!=$cod)
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
					window.location.href="perfil_usuario.php"
				});
			 </script>';
		return;
	}
	$sql="select fk_departamento,fk_municipio,fk_nacionalida,identidadC,apellidos,cod_empleo,descrip_userEmpleo,direccion,email_user,Fech_regisUser,img_perfil,
	nombres,nomb_user,pass_empleo,Pos_moto,Pos_vehi,sexo,tel_fijo,tel_movil,Fech_Naci,descrip_userEmpleo,fk_TipoLicen,Tip_Licen,depart,
	muni,nacionalidad from usuarios_empleo join licencias on cod_Licen=fk_TipoLicen join departamentos on cod_depart=fk_departamento join municipios on
	cod_muni=fk_municipio join nacionalidades on cod_nacion=fk_nacionalida where cod_empleo=$cod";
	$array=$res->llenarSelect($sql);
	foreach($array as $elemento):
?>
	<div class="container">
		<form class="well form-horizontal" action="actualizarUsuario.php" method="post"  id="formUser" enctype="multipart/form-data" name="formulario">
	<fieldset>
	<!-- Form Name -->
	<div class="form-group">
<label class="text col-md-4 control-label"> <h3><span class="label label-info">Modificar Datos Usuario</span></h3></label>
</div><br>

	<!-- Text input-->
	<div class="form-group">
  		<label class="text col-md-4 control-label">Nombre de usuario</label>
  		<div class="col-md-4 inputGroupContainer">
  			<div class="input-group">
  				<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
  				<input  name="Nomb_Usuario" id="username" placeholder="Nombre de usuario" class="form-control" value="<?php echo $elemento['nomb_user'] ?>" type="text" >
    		</div>
  		</div>
		<label class="col-md-4"></label>
    	<div id="Info"></div>
   </div>

<div class="input-group">
  <input  name="cod" id="cod" placeholder="Nombre de la propuesta" class="form-control" value="<?php echo $elemento['cod_empleo'] ?>" type=hidden>
</div>

<!-- Text input-->
<div class="form-group">
  	<label class="text col-md-4 control-label">Nombres</label>
  	<div class="col-md-4 inputGroupContainer">
    	<div class="input-group">
        	<span class="input-group-addon"><i class="glyphicon glyphicon-edit"></i></span>
  			<input name="NombUser" placeholder="Introduzca sus nombres" value="<?php echo $elemento['nombres'] ?>" class="form-control"  type="text">
    	</div>
  	</div>
</div>

	<!-- Text input-->
	<div class="form-group">
  		<label class="text col-md-4 control-label">Apellidos</label>
  		<div class="col-md-4 inputGroupContainer">
    		<div class="input-group">
        		<span class="input-group-addon"><i class="glyphicon glyphicon-edit"></i></span>
  				<input name="Apellidos_Usuario" placeholder="Introduzca sus apellidos" value="<?php echo $elemento['apellidos'] ?>" class="form-control"  type="text">
    		</div>
  		</div>
	</div>

	<div class="form-group">
	  <label class="text col-md-4 control-label" >Identidad</label>
		<div class="col-md-4 inputGroupContainer">
		<div class="input-group">
	  <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
	  <input name="identidadC"  placeholder="Número de identidad" class="form-control" value="<?php echo $elemento['identidadC'] ?>" type="text">
		</div>
	  </div>
	</div>

	<!-- Text input-->
	<div class="form-group">
  		<label class="text col-md-4 control-label">Fecha de nacimiento</label>
  		<div class="col-md-4 inputGroupContainer">
    		<div class="input-group">
        		<span class="input-group-addon"><i class="glyphicon glyphicon-edit"></i></span>
  				<input name="Naci_Usuario" placeholder="Introduzca su fecha de nacimiento" class="form-control" value="<?php echo $elemento['Fech_Naci'] ?>" type="date">
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
      				<option value="<?php echo $elemento['fk_nacionalida'] ?>" ><?php echo $elemento['nacionalidad'] ?></option>
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
      				<option value="<?php echo $elemento['sexo'] ?>" ><?php echo $elemento['sexo'] ?></option>
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
      				<option value="<?php echo $elemento['fk_departamento'] ?>" ><?php echo $elemento['depart'] ?></option>
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
     				<option value="<?php echo $elemento['fk_municipio'] ?>" ><?php echo $elemento['muni'] ?></option>
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
        	<textarea class="form-control" name="Direcc_Usuario" placeholder="Ingrese su dirección"><?php echo $elemento['direccion'] ?></textarea>
  </div>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="text col-md-4 control-label">Número de teléfono</label>
   <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-phone-alt"></i></span>
  <input name="TelFijo_Usuario" placeholder="Teléfono fijo" class="form-control" value="<?php echo $elemento['tel_fijo'] ?>" type="text">
    </div>
  </div>
</div>


<!-- Text input-->
<div class="form-group">
  <label class="text col-md-4 control-label">Número de teléfono</label>
   <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
  <input name="TelMovil_Usuario" placeholder="Teléfono móvil" class="form-control" value="<?php echo $elemento['tel_movil'] ?>" type="text">
    </div>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="text col-md-4 control-label">Correo electronico</label>
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
  <input name="Correo_Usuario" id="Correo_User" placeholder="mail@example.com" value="<?php echo $elemento['email_user'] ?>" class="form-control"  type="text">
    </div>
</div>
<div id="Veri_Corre"></div>
</div>

<!-- Select Basic -->
<div class="form-group">
  <label class="text col-md-4 control-label">Posee vehículo?</label>
    <div class="col-md-4 selectContainer">
    	<div class="input-group">
        	<span class="input-group-addon"><i class="glyphicon glyphicon-scale"></i></span>
    		<select name="Vehi_Usuario" class="form-control selectpicker" >
     		<option value="<?php echo $elemento['Pos_vehi'] ?>" ><?php echo $elemento['Pos_vehi'] ?></option>
     		<option>Si</option>
     		<option>No</option>
      		</select>
  		</div>
	</div>
</div>

<div class="form-group">
  <label class="text col-md-4 control-label">Posee motocicleta?</label>
    <div class="col-md-4 selectContainer">
    	<div class="input-group">
        	<span class="input-group-addon"><i class="glyphicon glyphicon-scale"></i></span>
    		<select name="Moto_Usuario" class="form-control selectpicker" >
     		<option value="<?php echo $elemento['Pos_moto'] ?>" ><?php echo $elemento['Pos_moto'] ?></option>
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
     		<option value="<?php echo $elemento['fk_TipoLicen'] ?>" ><?php echo $elemento['Tip_Licen'] ?></option>
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
        <textarea class="form-control" name="Descrip_Usuario" placeholder="Descripción de sus competencias y cualidades"><?php echo $elemento['descrip_userEmpleo'] ?></textarea>
  </div>
  </div>
</div>


<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label"></label>
  <div class="col-md-4">
	<button type="submit" name="registrarse1" class="btn btn-warning btn-block" >Guardar<span class="glyphicon glyphicon-floppy-saved"></span></button>
	<a class="btn btn-danger btn-block" href="perfil_usuario.php">Cancelar <span class="glyphicon glyphicon-floppy-remove"></span></a>
  </div>
</div>

</fieldset>
</form>
<p id="aviso"></p>

</div>
    </div><!-- /.container -->
<?php 	
	endforeach; 
	require("../footer.php");
?>
</body>
</html>
<?php
ob_end_flush();
?>
