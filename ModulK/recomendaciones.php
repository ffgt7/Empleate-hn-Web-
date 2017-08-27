<?php
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Articulos/Recomendaciones</title>
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
	$sql2="select codBlog,blog,fecha,categoria,cate,FKcreador,userAdmin from blog join cateblog on codCate=categoria join admin on codAdmin=FKcreador where categoria='7' order by fecha DESC";
	$resultado=$conexion->prepare($sql2);
	$resultado->execute(array());
	$num_filas=$resultado->rowCount();
	$total_paginas=ceil($num_filas/$tamano_paginas);
	if($pagina > $total_paginas){
		$pagina = $total_paginas;
	}
	if($pagina < 1){
		$pagina = 1;
	}
	$consulta="select codBlog,blog,fecha,categoria,cate,FKcreador,userAdmin from blog join cateblog on codCate=categoria join admin on codAdmin=FKcreador where categoria='7' order by fecha DESC LIMIT $empezar_desde,$tamano_paginas";
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
	if($num_filas != 0)
	{
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
					<h3 style="color: white;">Recomendaciones</h3>
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
			<?php foreach($resul as $elemento):  ?>
				<div class="services-wrapper">
					<article>
						<p><?php $blog= substr($elemento['blog'],0,1000);	echo $blog ?></p>
						<p>
						<i class="icon-calendar"></i><span >Públicado por: <?php echo $elemento['userAdmin']?></span>
						<i class="icon-calendar"></i><span >Catégoria: <?php echo $elemento['cate']?></span>
						<i class="icon-calendar"></i><span >Fecha de públicación: <?php echo $elemento['fecha']?></span>
						<a href="mostrarArticulos.php?cod=<?php echo $elemento['codBlog']?>" class="pull-right" style="color: deepskyblue;">Leer más... <i class="icon-angle-right"></i></a>
						</p>
						
					</article>
				</div>
			<?php endforeach; ?>	
			</div>
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
					<h3 style="color: white;">Recomendaciones</h3>
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
<?php
ob_end_flush();
?>
