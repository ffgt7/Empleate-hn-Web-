<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Perfil Administrador</title>
</head>

<body>
<?php
	session_start();
	require "../ModulK/nav.php";
	require("../lib/permisosA.php");
//	require "../lib/Llenado_Select.php";
	
	$cod=$_SESSION["codAdmin"];
	$sql="select codAdmin, userAdmin from admin where codAdmin=$cod";
	$resul=new Llenado_Select();
	$array=$z->llenarSelect($sql);
?>
<?php foreach($array as $elementos): ?>
<?php endforeach; ?>
<section id="services" >
	<div class="container">
		<div class="row text-center header">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 animate-in" data-anim-type="fade-in-up">
				<h3 class="text">PERFIL ADMINISTRADOR</h3>
				<h3 class="text"><?php echo $elementos['userAdmin'] ?></h3>
			</div>
		</div>
		<div class="row animate-in" data-anim-type="fade-in-up">
			<div class="col-xs-0 col-sm-3 col-md-3 col-lg-4">
				<div class="services-wrapper" href="#">
					<h3 class="text"><a href="verArticulosPublicados.php"><i class="fa fa-eye fa-2x"></i></a> Ver Artículos Publicados</h3>
					<h3 class="text"><a href="verVideosPublicados.php"><i class="fa fa-eye fa-2x"></i></a>Ver Videos Publicados</h3>
					
				</div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
				<div class="services-wrapper" href="#">
					<h3 class="text"><a href="../ModulK/blog2.php"><i class="fa fa-file fa-2x"></i></a> Crear Artículo</h3>
					<h3 class="text"><a href="../ModulK/video.php"><i class="fa fa-photo fa-2x"></i></a>Publicar Video</h3>
					<h3 class="text"><a href="javascript:void(0)"
						onclick="document.getElementById('id01').style.display='block'"><i class="fa fa-lock fa-2x"></i></a> Cambiar Contraseña</h3>
				</div>
			</div>
			<div class="col-xs-0 col-sm-3 col-md-3 col-lg-4">
			</div>
		</div>
	</div>
</section>
<div id="id01" class="w3-modal" style="z-index:4">
  <div class="w3-modal-content w3-animate-zoom">
    <div class="w3-container w3-padding w3-blue">
       <span onclick="document.getElementById('id01').style.display='none'" class="w3-right w3-xxlarge w3-closebtn"><i class="fa fa-remove"></i></span>
      <h2>Cambiar Contraseña</h2>
    </div>
    <div class="w3-panel">
			<form class="" action="actualizarPassAdmin.php" method="post" >
			<fieldset>
      <label style="color:gray">Contraseña actual</label>
      <input class="w3-input w3-border w3-hover-shadow w3-margin-bottom" type="password" name="pass" id="pass" style="color:gray">
			<label class="col-md-4"></label>
	    <div style="color:gray" id="Info"></div><hr>
      <label style="color:gray">Contraseña Nueva</label>
      <input class="w3-input w3-border w3-hover-shadow  w3-margin-bottom" type="password" style="color:gray" name="nuevaPass">
      <label style="color:gray">Repetir Contraseña</label>
      <input class="w3-input w3-border w3-hover-shadow  w3-margin-bottom" type="password" style="color:gray" name="confirmarPass">
      <div class="w3-section">
				<div class="form-group">
					<a class="w3-btn w3-grey" onclick="document.getElementById('id01').style.display='none'">Cancel  <i class="fa fa-remove"></i></a>
					<button type="submit" class="w3-btn w3-right w3-blue">Cambiar  <i class="fa fa-paper-plane"></i></button>
				</div>
      </div>
			</fieldset>
			</form>
    </div>
  </div>
</div>
</body>
</html>