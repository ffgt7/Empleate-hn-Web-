<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Moderna - Bootstrap 3 flat corporate template</title>
<?php require("../lib/movil.php"); ?>
</head>
<body>


<?php

require("../lib/conexion.php");
require('../lib/Llenado.php');
$res=new Llenado_Select();

$cod= $_GET['cod'];

$consulta="select * from blog where codBlog=$cod";
$resul=$res->llenarSelect($consulta);

?>





<div id="wrapper">
<?php
	require "navba.php";
?>
<section>
	<div id="services">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
				<div class="services-wrapper">
					<a href="verArticulosPublicados.php" ><i class="fa fa-caret-left"></i></a>
				</div>
			</div>
			<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
				<h2>Articulo Completo</h2>
			</div>
		</div>
	</div>
</section>
<?php foreach($resul as $elemen): ?>				
<section id="content">
	<div class="container">
	<div class="row">
		<section id="services" >
			<div class="col-xs-0 col-sm-1 col-md-1 col-lg-1">
			</div>
			<div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
				<div class="services-wrapper">
					<div class="post-heading">
						<h3><p><?php echo $elemen["blog"] ?></p></h3>
					</div>
					<div>
					</div>
				</div>
			</div>
			<div class="col-xs-0 col-sm-1 col-md-1 col-lg-1">
			</div>
		</section>
	</div>
</section>
<?php endforeach; ?>
</div>
<a href="#" class="scrollup"><i class="fa fa-angle-up active"></i></a>
</body>
</html>