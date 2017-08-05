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

$consulta="select * from blog where codBlog=$cod ";
$resul=$res->llenarSelect($consulta);

?>





<div id="wrapper">
<?php
	require "navv.php";
?>
<?php foreach($resul as $elemen): ?>				
<section id="content">
	<div class="container">
	<div class="row">
		<section id="services" >
			<div class="col-lg-1">
			</div>
			<div class="col-lg-10">
				<div class="services-wrapper">
					<div class="post-heading">
						<h3><p><?php echo $elemen["blog"] ?></p></h3>
						<a href="verArticulos.php" class="pull-right" style="color: deepskyblue;">Atras <- <i class="icon-angle-right"></i></a>
						
					</div>
					<div>
					</div>
				</div>
			</div>
			<div class="col-lg-1">
			</div>
		</section>
	</div>
</section>
<?php endforeach; ?>
</div>
<a href="#" class="scrollup"><i class="fa fa-angle-up active"></i></a>
</body>
</html>