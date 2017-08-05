<?php require("../lib/movil.php"); ?>
<link id="theme-style" rel="stylesheet" href="../css/styles-6.css">
<script src="../js/dist/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="../js/dist/sweetalert.css">
<link rel="stylesheet" href="../css/w3.css">
<link rel="stylesheet" href="../css/pagimacion.css">
<style>
	.text{
		color: white;
	}

	.imagen{
		height:200px;
		width:300px;
	}
	.img{
		height: 163px;
		width: 300px;
	}
	
    /* styles for '...' */
    #descripcion{
      /* hide text if it more than N lines  */ 
    	height: 3.6em;
    
      overflow: hidden;
    
      /* for set '...' in absolute position */
      position: relative;
      /* use this value to count block height */
      line-height: 1.2em;
      /* max-height = line-height (1.2) * lines max number (3) */
    
      /* fix problem when last visible word doesn't adjoin right side  */
      text-align: justify;
      /* place for '...' */
      margin-right: -1em;
      padding-right: 1em;
    }
    /* create the ... */
    #descripcion:before {
      /* points in the end */
      /*content: '...';*/
    
    	text-overflow: ellipsis;
    
      /* absolute position */
      position: absolute;
      /* set position to right bottom corner of block */
      right: 0;
      bottom: 0;
    }
    /* hide ... if we have text, which is less than or equal to max lines */
    #descripcion:after {
      /* points in the end */
      /*content: '';*/
      /* absolute position */
      position: absolute;
      /* set position to right bottom corner of text */
      right: 0;
      /* set width and height */
      width: 1em;
      height: 1em;
      margin-top: 0.2em;
      /* bg color = bg color under block */
      /*background: white;*/
    }
    
    #nomb_empre,#catego{
    	white-space: nowrap;
    	height:1.2em;
    	overflow: hidden;
    	text-overflow: ellipsis;
    }

</style>

<?php
	require "nav.php";
	include "../lib/conexion.php";
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
	$cod=$_GET['cod'];
	$codU=$_SESSION["cod_usuario"];
	$sql="select cod_usuario from usuarios_empre join favoritos where fk_empre=? and fk_usuario=?";
	$array_propuestas2= $conexion->prepare($sql);
    $array_propuestas2->execute(array($cod,$codU));
	$num=$array_propuestas2->rowCount();
	if($num==0)
	{
		echo '<script>
				swal({
					title: "Error!",
					text: "Debe iniciar sesión con el usuario correcto",
					type: "error",
					confirmButtonText: "Aceptar"
				},
				function(){
					window.location.replace("http://empleate-hn.accesocatracho.com/ModulC/perfil_usuario.php");
				});
			 </script>';
		return;
	}
	
	$resp=new Llenado_Select();
	$sql="select cod_usuario, Fech_regis,nomb_empre, imagen from usuarios_empre where cod_usuario=$cod";
	$array=$resp->llenarSelect($sql);

	$tamano_paginas=4;
	if(isset($_GET["pagina"])){
		if($_GET["pagina"]==1){
			$pagina=1;
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
	$sql3="select cod_propuesta,nombreP,descripcionP,caducidadP,catego from propuesta join categorias on cod_catego=fk_areaP where
	fk_userEmpre=$cod and estado=1";
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
	$sql2="select cod_propuesta,nombreP,descripcionP,caducidadP,catego from propuesta join categorias on cod_catego=fk_areaP where
	fk_userEmpre=$cod and estado=1 LIMIT $empezar_desde,$tamano_paginas";
	$array_propuestas=$resp->llenarSelect($sql2);
?>
<section id="team" >
	<div class="container">
	 <?php foreach($array as $elementos): ?>
		<div class="row text-center header animate-in" data-anim-type="fade-in-up">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<h3 class="text">Propuestas</h3>
				<i class="fa fa-star fa-2x"></i><br>
<a class="w3-btn w3-blue" data-toggle="tooltip" data-placement="bottom" title="Dejará de recibir notificaciones de las propuestas nuevas de esta empresa" 
href="javascript:void(0)"
onclick=
		'swal({
		title: "Ya marco esta empresa como favorita",
		text: "¿Desea desmarcarla?",
		type: "error",
		showCancelButton: true,
		confirmButtonText: "Si, desmarcar!",
		cancelButtonText: "No, cancelar!",
		closeOnConfirm: true,
		closeOnCancel: false,
		},
		function(isConfirm)
		{
			if (isConfirm)
			{
				window.location.href="quitarFavo.php?codU="+<?php echo $cod ?>;

			}
			else
			{
				swal("Cancelado", "Sigue teniendo esta empresa como favorita", "error");
			}
		});'
>Desmarcar como Favorito</a>
			</div>
		</div>
<?php
		if($num_filas==0)
	{
?>
		<div class="container">
			<div class="row text-center header animate-in" data-anim-type="fade-in-up">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class='services-wrapper' style="padding-top:30px">
						<h2><i class="fa fa-warning fa-2x"></i> En este momento no hay propuestas publicadas</h2>
					</div>
				</div>
			</div>
		</div> 
<?php
	return;
	}
?>
<div class="row animate-in" data-anim-type="fade-in-up">
	<?php foreach($array_propuestas as $elemento): ?>
		<div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
			<div class="team-wrapper">
				<div class="team-inner" style="background-image: url('../Imagenes_Empre/<?php echo $elementos['imagen'] ?>')" >
					<a href="verPropuestaFavo.php?cod=<?php echo $elemento['cod_propuesta'] ?>">
					<?php 
						$consul="select count(cod_favo) from favoritos where fk_empre=? and fk_usuario=? and visto=1";
						$resul= $conexion->prepare($consul);
						$resul->execute(array($cod,$codU));
						$num=$resul->fetch(PDO::FETCH_ASSOC);
						$n=implode($num);
						if($n==1)
						{
							echo '<span class="badge">Visto</span>';
						}
										
					?><i class="fa fa-eye" data-toggle="tooltip" data-placement="top" title="Ver información de la propuesta" >
					
					</i></a>
				</div>
				
				<div class="description">
					</br>
					<h3 id="nomb_empre" class="text"><?php echo $elemento['nombreP'] ?></h3>
					<h5 id="catego"> <strong> <?php echo $elemento['catego'] ?> </strong></h5>
					<p class="text" id="descripcion">
						<?php echo $elemento['descripcionP'] ?>
					</p>
					<p class="" style="font-size: 20px"><span class="label label-primary">Vence: <?php echo $elemento['caducidadP'] ?></span></p>
				</div>
			</div>
		</div>
	<?php endforeach; ?>
<?php endforeach; ?>

<div class="row text-center header animate-in" data-anim-type="fade-in-up">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<h4 class="text">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Paginas</h4>
		<div class="pagination">
			<?php $paginate_max = 4;
				if($num_filas != 0)
				{
					$nextpage = $pagina + 1;
					$prevpage = $pagina - 1;
					$spmin = ($pagina > $paginate_max) ? ($pagina - $paginate_max) : 1;
					$spmax = ($pagina < ($total_paginas - $paginate_max)) ? ($pagina + $paginate_max) : $total_paginas;
			?><ul id="pagination-digg">
			<?php
				if($pagina == 1)
				{ 
			?>
					<li class="active"><a style="font-size:15px">1</a></li>
					<?php 
						for($i=$spmin; $i<=$spmax; $i++)
						{ 
							if($i != 1)
							{
								if($i < 8)
								{ 
					?>
									<li><a class="text" href="?pagina=<?php echo $i ?>&cod=<?php echo $cod ?>" style="font-size:15px"><?php echo $i ?></a></li><?php
								}
							}
					?>
					<?php } 
							if($total_paginas > $pagina)
							{ ?>
								<li class="next"><a class="text" href="?pagina=<?php echo $nextpage ?>&cod=<?php echo $cod ?>" style="font-size:15px">&raquo;</a></li>
								<li class="next"><a class="text" href="?pagina=<?php echo $total_paginas ?>&cod=<?php echo $cod ?>" style="font-size:15px">&raquo;&raquo;</a></li><?php
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
							<li class="previous"><a class="text" href="?pagina=1&cod=<?php echo $cod ?>" style="font-size:15px">&laquo;&laquo;</a></li>
							<li class="previous"><a class="text" href="?pagina=<?php echo $prevpage ?>&cod=<?php echo $cod ?>" style="font-size:15px">&laquo;</a></li><?php
							for($i=$spmin; $i<=$spmax; $i++)
							{
								if($pagina == $i)
								{
							?>		<li class="active"><a style="font-size:15px"><?php echo $i ?></a></li><?php
								}
								else
								{
							?>		<li><a class="text" href="?pagina=<?php echo $i ?>&cod=<?php echo $cod ?>" style="font-size:15px"><?php echo $i ?></a></li><?php
								}
							}
						 	if($total_paginas > $pagina)
							{ ?>
								<li class="next"><a class="text" href="?pagina=<?php echo $nextpage ?>&cod=<?php echo $cod ?>" style="font-size:15px">&raquo;</a></li>
								<li class="next"><a class="text" href="?pagina=<?php echo $total_paginas ?>&cod=<?php echo $cod ?>" style="font-size:15px">&raquo;&raquo;</a></li><?php
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
	</div>
</section>
