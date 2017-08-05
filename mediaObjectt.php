<meta charset="utf-8">
<link href="css/Media.css" rel="stylesheet" />
<link rel="stylesheet" href="css/w3.css">
<link rel="stylesheet" href="css/pagimacion.css">
<style>
.imagen {
	width: 80%;
	height: 180px;
}
@media screen and (min-width: 480px) {
	.imagen {
		width: 100%;
		height: 180px;

	}
}
</style>

<style>
/* styles for '...' */
#descripcion{
  /* hide text if it more than N lines  */
  height: 3.6em;

  overflow: hidden;

  /* for set '...' in absolute position */
  position: relative;
  /* use this value to count block height */
  line-height: 1.2em;
  max-height = line-height (1.2) * lines max number (3) 

  /* fix problem when last visible word doesn't adjoin right side  */
  text-align: justify;
  /* place for '...' */
  margin-right: -1em;
  padding-right: 1em;
}
/* create the ... */
#descripcion:before {
  /* points in the end */
  content: '...';

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
  content: '';
  /* absolute position */
  position: absolute;
  /* set position to right bottom corner of text */
  right: 0;
  /* set width and height */
  width: 1em;
  height: 1em;
  margin-top: 0.2em;
  /*bg color = bg color under block */
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
	$w=new Llenado_Select();
	include"lib/conexion.php";

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

	$dia = date('Y/m/d');
	$empezar_desde=($pagina-1)*$tamano_paginas;
	$sql3="select cod_propuesta,nombreP,descripcionP,caducidadP,catego,imagen,nomb_empre from propuesta join categorias on
	cod_catego=fk_areaP join usuarios_empre on cod_usuario=fk_userEmpre where propuesta.estado = 1 AND  propuesta.caducidadP >= '$dia' order by caducidadP asc";
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

	$sqlU="update propuesta set estado=0 where caducidadP <'$dia'";
	$resultado=$conexion->prepare($sqlU);
	$resultado->execute();

	$sql="select cod_propuesta,nombreP,descripcionP,caducidadP,catego,imagen,nomb_empre from propuesta join categorias on
	cod_catego=fk_areaP join usuarios_empre on cod_usuario=fk_userEmpre where propuesta.estado = 1 AND  propuesta.caducidadP >= '$dia' order by caducidadP asc LIMIT $empezar_desde,$tamano_paginas";
    $array_propuestas=$w->llenarSelect($sql);
	if($num_filas != 0)
	{
?>

<section id="services" >
	<div class="container">
		<div class="row text-center header animate-in" data-anim-type="fade-in-up">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
			          <!--  <span class="w3-opennav w3-xlarge" onclick="w3_open()">&#9776;</span>  -->
			        </div>
			        <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
			            <h3>Propuestas</h3>
			        </div>
			        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
			        </div>
			</div>
		</div>
		<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4" style="padding-right:30px">
			<div class="row animate-in" data-anim-type="fade-in-up">
				<div class="services-wrapper">
					<i class="fa fa-calendar fa-5x"></i>
					<a class="btn btn-danger" href="ModulC/propuestasFinalizar.php">Ver Propuestas</a>
					<h3>Propuestas por Finalizar </h3>
					Aquí se mostraran unicamente las propuestas que le faltan pocos dias para finalizar
				</div>
			</div>
			<div class="row animate-in" data-anim-type="fade-in-up">
				<div class="services-wrapper">
					<i class="fa fa-facebook fa-5x"></i>
					<a class="btn btn-primary" href="https://www.facebook.com/profile.php?id=100016987111019" target="_blank">Visitar</a>
					<h3>facebook/Quiero Chamba!</h3>
					Aquí podras seguirnos en la red social y mantenerte informado de la publicaciones que
					se haran en el sitio y tendras la opcion de compartirlas con tus amigos
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
			<div class="row animate-in" data-anim-type="fade-in-up">
				<?php foreach($array_propuestas as $elemento): ?>
				<div class="services-wrapper" style="padding:0px;margin-bottom: 10px;">
					<div class='propuestas-container' style="margin-top: 0px;">
						<div class='header1'style="padding-bottom: 5px; padding-top: 5px; padding-left: 15px; padding-right: 5px;">
							<h2 data-toggle="tooltip" data-placement="left" title="Nombre de la propuesta"><?php $nom=ucwords(strtolower($elemento['nombreP'])); echo $nom ?></h2>
						</div>
						<div class="w3-container">
						  <div class='w3-half w3-container w3-third' style="padding-left: 0px;padding-right: 0px;">
								<a href='ModulC/verPropuesta.php?cod=<?php echo $elemento['cod_propuesta']?>'>
								  <img style="padding-bottom:20px" class="img-responsive img-rounded w3-left w3-ro w3-margin-right imagen d-flex ml-3" src="Imagenes_Empre/<?php echo $elemento['imagen'] ?>" alt="...">
								</a>
						  </div>
						  <div class="w3-half w3-container w3-third" style="margin-top: 0px; padding-right: 0px;">

								<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="padding-left: 0px; padding-right: 0px;">
									<p id="nomb_empre" style='font-size: 25px'>
										<span  class='label label-primary' data-toggle="tooltip" data-placement="right" title="Nombre de la empresa" style="padding-bottom: 2px; padding-top: 2px; padding-left: 4px; padding-right: 4px;"><?php echo $elemento["nomb_empre"] ?></span>
									</p>
								</div>

								<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="padding-left: 0px; padding-right: 0px; padding-top: 10px;">
									<h5 id="catego" class="media-heading" data-toggle="tooltip" data-placement="left" title="Área de trabajo"><?php echo $elemento["catego"] ?></h5>
								</div>

								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding-left: 0px; padding-right: 0px;" >
									<p style="margin-bottom: 0px;" data-toggle="tooltip" data-placement="left" title="Descripción del cargo solicitado" id="descripcion">
										<?php echo $elemento["descripcionP"] ?>
									</p>
									<a href='ModulC/verPropuesta.php?cod=<?php echo $elemento['cod_propuesta']?>'>Seguir leyendo</a>
								</div>

								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top:10px; position:static; padding-left:0px;">
									<p style='font-size: 20px' ><span class='label label-danger' data-toggle="tooltip" data-placement="bottom" title="Fecha de vencimiento de la propuesta">Vence:<?php echo $elemento['caducidadP']?></span></p>
								</div>

						  </div>

						</div>
					</div>


				</div>
				<?php endforeach; ?>
			</div>
		</div>
        <?php
            if($num_filas <=4)
            {
	        }
	        else
	        {
        ?>
		<div class="row text-center header animate-in" data-anim-type="fade-in-up">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<h4 class="text">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Paginas</h4>
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
	    ?>
	</div>
</section>
<?php
	}
	else
	{ ?>
		<div class="container">
			<div class="row text-center header animate-in" data-anim-type="fade-in-up">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class='services-wrapper' style="padding-top:150px">
						<h2><i class="fa fa-warning fa-2x"></i> No hay propuestas publicadas en este momento <?php echo $dia?></h2>
					</div>
				</div>
			</div>
		</div> <?php
	}
?>
