<?php
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Videos</title>
<?php require("../lib/movil.php"); ?>
<link href="../css/jcarousel.css" rel="stylesheet" />
<link href="../css/flexslider.css" rel="stylesheet" />
<link href="../skins/default.css" rel="stylesheet" />
<style>
	.text{
		color: black;
	}
</style>
</head>
<body>
<?php
session_start();
require("../lib/conexion.php");
require('../lib/Llenado.php');
$res=new Llenado_Select();
$tamano_paginas=4;
if(isset($_GET["pagina"])){
	if($_GET["pagina"]==1){
		$pagina=1;
		//header("Location:index.php");
	}else{
		$pagina=$_GET["pagina"];
		if($pagina <= 0){
			$pagina = 1;
		}
	}
}else{
	$pagina=1;
}
$empezar_desde=($pagina-1)*$tamano_paginas;
$sql3="select codVideo,FKcategoria,link,descripcion,titulo,categoria,fecha from videos join catevideos on codCateVideo=FKcategoria where FKcategoria='2'";
$resultado=$conexion->prepare($sql3);
$resultado->execute(array());
$num_filas=$resultado->rowCount();
$total_paginas=ceil($num_filas/$tamano_paginas);
if($pagina > $total_paginas){
	$pagina = $total_paginas;
}
if($pagina < 1){
	$pagina = 1;
}
$consulta="select codVideo,FKcategoria,link,descripcion,titulo,categoria,fecha from videos join catevideos on codCateVideo=FKcategoria where FKcategoria='2' LIMIT $empezar_desde,$tamano_paginas";
$resul=$res->llenarSelect($consulta);
$sql3="select count(*) as num from videos join catevideos on codCateVideo=FKcategoria";
$rrr=$conexion->prepare($sql3);
$rrr->execute();
$n=$rrr->fetch(PDO::FETCH_ASSOC);
$nn=implode($n);
$sql4="select count(*) as num from videos join catevideos on codCateVideo=FKcategoria where FKcategoria='1'";
$rrr=$conexion->prepare($sql4);
$rrr->execute();
$n=$rrr->fetch(PDO::FETCH_ASSOC);
$nnn=implode($n);
$sql5="select count(*) as num from videos join catevideos on codCateVideo=FKcategoria where FKcategoria='2'";
$rrr=$conexion->prepare($sql5);
$rrr->execute();
$n=$rrr->fetch(PDO::FETCH_ASSOC);
$nnnn=implode($n);
if($num_filas != 0)
{
?>



<div id="wrapper">
<?php
	require "navv.php";
?>
	<section id="content" style="padding-top: 60px;">
	<div class="container">
		<div class="row">
		<section id="services" >
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="row text-center header animate-in" data-anim-type="fade-in-up">
					<h3 style="color: white;">Tips</h3>
				</div>
			</div>
			<div class="col-lg-12">
				<div class="col-lg-3">
					<div class="services-wrapper">
						<aside class="right-sidebar">
							<div class="widget">
							<ul class="list-group">
							<li class="list-group-item btn-info"><a class="text btn" href="verVideos.php">Todas Catégorias <span class="badge w3-blue-gray"><?php echo $nn ?></span></a></li>
								<li class="list-group-item btn-info"><a class="text" href="motivacion.php"><span class="badge w3-blue"><?php echo $nnn ?></span> Motivacionales</a></li>
								<li class="list-group-item btn-info"><a class="text" href="tips"><span class="badge w3-blue"><?php echo $nnnn ?></span> Tips</a></li>

							</ul>
							</div>
						</aside>
					</div>
				</div>
				<div class="col-lg-9">
				<?php foreach($resul as $elem):  ?>
					<div class="services-wrapper">
						<div class="post-video">
							<div class="post-heading">
								<h3><?php echo $elem['titulo']?></h3>
							</div>
							<div class="video-container">
							 <?php echo $elem['link']?>
							</div>
						</div>
						<h5>
							<?php echo $elem['descripcion']?>
						</h5>
						<div class="bottom-article">
							<p>
								<i class="icon-calendar"></i><span> Catégoria:<?php echo $elem['categoria']?><span>
								<i class="icon-comments"></i><span>Publicado:<?php echo $elem['fecha']?></span>
							</p>
						</div>
					</div>
				<?php endforeach; ?>
				</div>				
			</div>
			</section>
		</div>
	</div>
	</section>
	
</div>
<a href="#" class="scrollup"><i class="fa fa-angle-up active"></i></a>
<div class="row text-center header animate-in" data-anim-type="fade-in-up">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<h4 class="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Paginas</h4>
				<div class="pagination">
				<?php $paginate_max = 7;
					if($num_filas != 0){
						$nextpage = $pagina + 1;
						$prevpage = $pagina - 1;
						$spmin = ($pagina > $paginate_max) ? ($pagina - $paginate_max) : 1;
						$spmax = ($pagina < ($total_paginas - $paginate_max)) ? ($pagina + $paginate_max) : $total_paginas;
				?><ul id="pagination-digg"><?php
						if($pagina == 1)
						{ 
						 ?>
						<!--	<li class="previous-off"><a style="font-size:15px">&laquo; Anterior</a></li> -->
							<li class="active"><a style="font-size:15px">1</a></li>
					<?php 
						for($i=$spmin; $i<=$spmax; $i++)
						{ 
							if($i != 1)
							{
								if($i < 8)
								{ ?>
								<li><a class="" href="?pagina=<?php echo $i ?>" style="font-size:15px"><?php echo $i ?></a></li><?php
								}
							}
					?>
					<?php } 
							if($total_paginas > $pagina)
							{ ?>
								<li class="next"><a class="" href="?pagina=<?php echo $nextpage ?>" style="font-size:15px">Siguiente &raquo;</a></li><?php
							}
							else
							{ ?>		
								<!-- <li class="next-off">Siguiente &raquo;</li> -->
						<?php
							}
						}
						else
						{ 
						?>
							<li class="previous"><a class="" href="?pagina=<?php echo $prevpage ?>" style="font-size:15px">&laquo; Anterior</a></li><?php
							for($i=$spmin; $i<=$spmax; $i++)
							{
								if($pagina == $i)
								{
							?>		<li class="active"><a style="font-size:15px"><?php echo $i ?></a></li><?php
								}
								else
								{
							?>		<li><a class="" href="?pagina=<?php echo $i ?>" style="font-size:15px"><?php echo $i ?></a></li><?php
								}
							}
						 	if($total_paginas > $pagina)
							{ ?>
								<li class="next"><a class="" href="?pagina=<?php echo $nextpage ?>" style="font-size:15px">Siguiente &raquo;</a></li><?php
							}
						 	else
							{
						?>		<!-- <li class="next-off"><a style="font-size:15px">Sigiente &raquo;</a></li> --><?php	
							}
						}
					?></ul>
				</div><?php 
					} ?>
			</div>
		</div>
<?php 
	}
	else
	{ ?>
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
					<h3 style="color: white;">Tips</h3>
				</div>
			</div>
			<div class="col-lg-12">
			<div class="col-lg-3">
					<div class="services-wrapper">
						<aside class="right-sidebar">
							<div class="widget">
							<ul class="list-group">
							<li class="list-group-item btn-info"><a class="text btn" href="verVideos.php">Todas Catégorias <span class="badge w3-blue-gray"><?php echo $nn ?></span></a></li>
								<li class="list-group-item btn-info"><a class="text" href="motivacion.php"><span class="badge w3-blue"><?php echo $nnn ?></span> Motivacionales</a></li>
								<li class="list-group-item btn-info"><a class="text" href="tips"><span class="badge w3-blue"><?php echo $nnnn ?></span> Tips</a></li>

							</ul>
							</div>
						</aside>
					</div>
				</div>
			<div class="col-lg-9">
			<div class="row text-center header animate-in" data-anim-type="fade-in-up">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class='' style="padding-top:150px">
						<h2><i class="fa fa-warning fa-2x"></i> No hay videos publicados en este momento</h2>
					</div>
				</div>
			</div>	
			</div>
			</div>
		</section>
	</div>
</div>
</section><?php
	}
?>
</body>
</html>
<?php
ob_end_flush();
?>