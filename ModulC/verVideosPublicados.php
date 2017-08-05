<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Videos</title>
<?php require("../lib/movil.php"); ?>
<link href="../css/jcarousel.css" rel="stylesheet" />
<link href="../css/flexslider.css" rel="stylesheet" />
<link href="../skins/default.css" rel="stylesheet" />
<script src="../js/sweetalert-dev.js"></script>
<link href="../css/sweetalert.css" rel="stylesheet" type="text/css"/>
<script src="../js/sweetalert.min.js"></script>
<style>
	.text{
		color: black;
	}
</style>
</head>
<body>
<?php
session_start();
$host=$_SERVER["HTTP_HOST"];
$url=$_SERVER["REQUEST_URI"];
$dire="http://" . $host . $url;
	if(!isset($_SESSION["codAdmin"]))
	{
		
		echo '<script>
				window.location.href="../lib/permisosA.php'; echo '?url=';echo $dire;echo '";
			</script>';
		return;

	}
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
$sql3="select codVideo,FKcategoria,link,descripcion,titulo,fecha,FKusuario,categoria,userAdmin from videos join catevideos on codCateVideo=FKcategoria join admin on codAdmin=FKusuario";
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
$consulta="select codVideo,FKcategoria,link,descripcion,titulo,fecha,FKusuario,categoria,userAdmin from videos join catevideos on codCateVideo=FKcategoria join admin on codAdmin=FKusuario order by fecha DESC LIMIT $empezar_desde,$tamano_paginas";
$resul=$res->llenarSelect($consulta);
if($num_filas != 0)
{
?>



<div id="wrapper">
<?php
	require "navba.php";
?>
<section id="content" style="padding-top: 60px;">
	<div class="container">
		<div class="row">
		<section id="services" >
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="row text-center header animate-in" data-anim-type="fade-in-up">
					<h3 style="color: white;">Todos los Videos</h3>
				</div>
			</div>
			<?php foreach($resul as $elem):  ?>
			<div class="col-lg-12">
				<div class="col-lg-3">
					<div class="services-wrapper">
						<aside class="right-sidebar">
							<div class="widget">
							<ul class="list-group">
								<li class="list-group-item btn-info"><a class="text btn" href="modificarVideo.php?cod=<?php echo $elem['codVideo']?>">Modificar<span class="badge w3-blue-gray"></span></a></li>
								<li class="list-group-item btn-info"><a class="text btn" href="#" onclick='swal({
									  title: "Desea eliminar el Video?",
									  text: "No podra recuperar el Video!",
									  type: "warning",
									  showCancelButton: true,
									  confirmButtonColor: "#DD6B55",
									  confirmButtonText: "Si, Borrar!",
									  cancelButtonText: "No, cancelar!",
									  closeOnConfirm: false,
									  closeOnCancel: false
									},
									function(isConfirm)
									{
									  if (isConfirm) {
										swal("Borrada!", "Su Video ha sido eliminada.", "success");
										window.location.href="eliminarVideo.php?cod="+<?php echo $elem['codVideo']?>;
									  }
										else
										{
											swal("Cancelado", "Su Video esta seguro :)", "error");
									  }
									});' data-toggle="tooltip" data-placement="top" title="Eliminar Video"><span class="badge w3-blue"></span>Eliminar</a></li>
							</ul>
							</div>
						</aside>
					</div>
				</div>
				<div class="col-lg-9">
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
								<i class="icon-calendar"></i><span> Públicado por:<?php echo $elem['userAdmin']?><span>
								<i class="icon-calendar"></i><span> Catégoria:<?php echo $elem['categoria']?><span>
								<i class="icon-comments"></i><span>Fecha de Publicación:<?php echo $elem['fecha']?></span>
							</p>
							
						</div>
					</div>
				
				</div>
			</div>
			<?php endforeach; ?>
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
	require "navba.php";
?>
<section id="content" style="padding-top: 60px;">
<div class="container-fluid">
<div class="row-fluid">
<div class="container">
	<div class="row">
		<section id="services" >
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="row text-center header animate-in" data-anim-type="fade-in-up">
					<h3 style="color: white;">Todos los Videos</h3>
				</div>
			</div>
			<div class="col-lg-12">
			<div class="col-lg-12">
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