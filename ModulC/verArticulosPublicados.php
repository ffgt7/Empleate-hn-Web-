<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Articulos</title>
<?php require("../lib/movil.php"); ?>
<script src="../js/sweetalert-dev.js"></script>
<link href="../css/sweetalert.css" rel="stylesheet" type="text/css"/>
<script src="../js/sweetalert.min.js"></script>
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
	$sql3="select codBlog,blog,fecha,categoria,cate,FKcreador,userAdmin from blog join cateblog on codCate=categoria join admin on codAdmin=FKcreador order by fecha DESC";
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
	$consulta="select codBlog,blog,fecha,categoria,cate,FKcreador,userAdmin from blog join cateblog on codCate=categoria join admin on codAdmin=FKcreador order by fecha DESC LIMIT $empezar_desde,$tamano_paginas";
	$resul=$res->llenarSelect($consulta);
	if($num_filas != 0)
	{
?>

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
					<h3 style="color: white;">Todos los Artículos</h3>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<?php foreach($resul as $elemento):  ?>
			<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
				<div class="services-wrapper">
					<aside class="right-sidebar">
						<div class="widget">
						<ul class="list-group">
							<li class="list-group-item btn-info"><a class="text btn" href="modificarBlog.php?cod=<?php echo $elemento['codBlog']?>">Modificar<span class="badge w3-blue-gray"></span></a></li>
							<li class="list-group-item btn-info"><a class="text btn" href="#" onclick='swal({
									  title: "Desea eliminar el Artículo?",
									  text: "No podra recuperar el Artículo!",
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
										swal("Borrada!", "Su Artículo ha sido eliminada.", "success");
										window.location.href="eliminarArticulo.php?cod="+<?php echo $elemento['codBlog'] ?>;
									  }
										else
										{
											swal("Cancelado", "Su Artículo esta seguro :)", "error");
									  }
									});' data-toggle="tooltip" data-placement="top" title="Eliminar Artículo"><span class="badge w3-blue"></span>Eliminar</a></li>
						</ul>
						</div>
					</aside>
				</div>
			</div>
			<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
			
				<div class="services-wrapper">
					<article>
						<p><?php $blog= substr($elemento['blog'],0,1000);	echo $blog ?></p>
						<p>
						<i class="icon-calendar"></i><span >Públicado por: <?php echo $elemento['userAdmin']?></span>
						<i class="icon-calendar"></i><span >Catégoria: <?php echo $elemento['cate']?></span>
						<i class="icon-calendar"></i><span >Fecha de públicación: <?php echo $elemento['fecha']?></span>
						<a href="mostrarArticulosAdministrador.php?cod=<?php echo $elemento['codBlog']?>" class="pull-right" style="color: deepskyblue;">Leer más... <i class="icon-angle-right"></i></a>
						</p>
						
					</article>
				</div>
				
			</div>
			<?php endforeach; ?>
			</div>
		</section>
	</div>
</div>
</section>
	<a href="#" class="scrollup"><i class="fa fa-angle-up fa-2x active"></i></a>
</div>
<div class="row text-center header animate-in" data-anim-type="fade-in-up">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<h4 class="textt">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Paginas</h4>
				<div class="pagination">
				<?php $paginate_max = 4;
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
								<li><a class="text" href="?pagina=<?php echo $i ?>" style="font-size:15px"><?php echo $i ?></a></li><?php
								}
							}
					?>
					<?php } 
							if($total_paginas > $pagina)
							{ ?>
								<li class="next"><a class="text" href="?pagina=<?php echo $nextpage ?>" style="font-size:15px">&raquo;</a></li>
								<li class="next"><a class="text" href="?pagina=<?php echo $total_paginas ?>" style="font-size:15px">&raquo;&raquo;</a></li><?php
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
							<li class="previous"><a class="text" href="?pagina=1" style="font-size:15px">&laquo;&laquo;</a></li>
							<li class="previous"><a class="text" href="?pagina=<?php echo $prevpage ?>" style="font-size:15px">&laquo;</a></li><?php
							for($i=$spmin; $i<=$spmax; $i++)
							{
								if($pagina == $i)
								{
							?>		<li class="active"><a style="font-size:15px"><?php echo $i ?></a></li><?php
								}
								else
								{
							?>		<li><a class="text" href="?pagina=<?php echo $i ?>" style="font-size:15px"><?php echo $i ?></a></li><?php
								}
							}
						 	if($total_paginas > $pagina)
							{ ?>
								<li class="next"><a class="text" href="?pagina=<?php echo $nextpage ?>" style="font-size:15px">&raquo;</a></li>
								<li class="next"><a class="text" href="?pagina=<?php echo $total_paginas ?>" style="font-size:15px">&raquo;&raquo;</a></li><?php
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
					<h3 style="color: white;">Todos los Artículos</h3>
				</div>
			</div>
			<div class="col-lg-12">
			<div class="col-lg-12">
			<div class="row text-center header animate-in" data-anim-type="fade-in-up">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class='' style="padding-top:150px">
						<h2><i class="fa fa-warning fa-2x"></i> No hay articulos publicados en este momento</h2>
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