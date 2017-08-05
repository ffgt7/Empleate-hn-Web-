<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Moderna - Bootstrap 3 flat corporate template</title>
<?php require("../lib/movil.php"); ?>

<style>
	.text{
		color: black;
	}
	.textt{
		color: white;
	}
</style>


</head>
<body>
<?php

require("../lib/conexion.php");
require('../lib/Llenado.php');
$res=new Llenado_Select();

$cod= $_GET['cod'];

$consulta="select * from blog where codBlog=$cod";
$resul=$res->llenarSelect($consulta);

$sql3="select count(*) as num from blog join cateblog on codCate=categoria";
	$rrr=$conexion->prepare($sql3);
	$rrr->execute();
	$n=$rrr->fetch(PDO::FETCH_ASSOC);
	$nn=implode($n);
	$sql4="select count(*) as num from blog join cateblog on codCate=categoria where categoria='6'";
	$rrr=$conexion->prepare($sql4);
	$rrr->execute();
	$n=$rrr->fetch(PDO::FETCH_ASSOC);
	$nnn=implode($n);
	$sql5="select count(*) as num from blog join cateblog on codCate=categoria where categoria='1'";
	$rrr=$conexion->prepare($sql5);
	$rrr->execute();
	$n=$rrr->fetch(PDO::FETCH_ASSOC);
	$nnnn=implode($n);
	$sql6="select count(*) as num from blog join cateblog on codCate=categoria where categoria='2'";
	$rrr=$conexion->prepare($sql6);
	$rrr->execute();
	$n=$rrr->fetch(PDO::FETCH_ASSOC);
	$na=implode($n);
	$sql7="select count(*) as num from blog join cateblog on codCate=categoria where categoria='3'";
	$rrr=$conexion->prepare($sql7);
	$rrr->execute();
	$n=$rrr->fetch(PDO::FETCH_ASSOC);
	$ns=implode($n);
	$sql8="select count(*) as num from blog join cateblog on codCate=categoria where categoria='5'";
	$rrr=$conexion->prepare($sql8);
	$rrr->execute();
	$n=$rrr->fetch(PDO::FETCH_ASSOC);
	$nd=implode($n);
	$sql9="select count(*) as num from blog join cateblog on codCate=categoria where categoria='7'";
	$rrr=$conexion->prepare($sql9);
	$rrr->execute();
	$n=$rrr->fetch(PDO::FETCH_ASSOC);
	$nf=implode($n);
	$sql10="select count(*) as num from blog join cateblog on codCate=categoria where categoria='8'";
	$rrr=$conexion->prepare($sql10);
	$rrr->execute();
	$n=$rrr->fetch(PDO::FETCH_ASSOC);
	$ng=implode($n);
	$sql11="select count(*) as num from blog join cateblog on codCate=categoria where categoria='4'";
	$rrr=$conexion->prepare($sql11);
	$rrr->execute();
	$n=$rrr->fetch(PDO::FETCH_ASSOC);
	$nh=implode($n);



?>





<div id="wrapper">
<?php
	require "navv.php";
?>
<section id="content" style="padding-top: 60px;">
<div class="container-fluid">
<div class="row-fluid">
<div class="container">
	<div class="row">
		<section id="services" >
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="row text-center header animate-in" data-anim-type="fade-in-up">
					<h3 style="color: white;">Artículo Completo</h3>
				</div>
			</div>

<div class="col-lg-12">
<div class="col-lg-3">
				<div class="services-wrapper">
					<aside class="right-sidebar">
						<div class="widget">
						<ul class="list-group">
							<li class="list-group-item btn-info"><a class="text btn" href="verArticulos.php">Todos Catégorias <span class="badge w3-blue-gray"><?php echo $nn ?></span></a></li>
							<li class="list-group-item btn-info"><a class="text" href="estudiantes.php"><span class="badge w3-blue"><?php echo $nnn ?></span> Estudiantes</a></li>
							<li class="list-group-item btn-info"><a class="text" href="capacitaciones.php"><span class="badge w3-blue"><?php echo $nnnn ?></span> Capacitación</a></li>
							<li class="list-group-item btn-info"><a class="text" href="curriculum.php"><span class="badge w3-blue"><?php echo $na ?></span> Curriculum</a></li>
							<li class="list-group-item btn-info"><a class="text" href="empleo.php"><span class="badge w3-blue"><?php echo $ns ?></span> Empleo</a></li>
							<li class="list-group-item btn-info"><a class="text" href="entrevistas.php"><span class="badge w3-blue"><?php echo $nd ?></span> Entrevistas</a></li>
							<li class="list-group-item btn-info"><a class="text" href="recomendaciones.php"><span class="badge w3-blue"><?php echo $nf ?></span> Recomendaciones</a></li>
							<li class="list-group-item btn-info"><a class="text" href="demanda.php"><span class="badge w3-blue"><?php echo $ng ?></span> Demanda Laboral</a></li>
							<li class="list-group-item btn-info"><a class="text" href="empresas.php"><span class="badge w3-blue"><?php echo $nh ?></span> Empresas</a></li>
						</ul>
						</div>
					</aside>
				</div>
			</div>
<div class="col-lg-9">
<?php foreach($resul as $elemen): ?>
					<div class="services-wrapper">
					<article>
					<h3><p><?php echo $elemen["blog"] ?></p></h3>
					</article>
					</div>
					</div>
				</div>
			</div>
			
			</div>
		</section>
	</div>
</section>
</div>
<?php endforeach; ?>
</div>
<a href="#" class="scrollup"><i class="fa fa-angle-up fa-2x active"></i></a>
</body>
</html>