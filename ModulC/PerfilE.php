<script src="../js/dist/sweetalert.min.js"></script>
<script src="../js/tool.js"></script>
<link rel="stylesheet" type="text/css" href="../js/dist/sweetalert.css">
<link rel="stylesheet" href="../css/pagimacion.css">
<link rel="stylesheet" href="../css/w3.css">
<link href="../css/tool.css" rel="stylesheet"/>
<script>
	var openTab = document.getElementById("firstTab");
	openTab.click();
</script>

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

	#nombreP{
		height:2.4em;
		overflow: hidden;
		text-overflow: pre-line;
		max-height: 2.4em;
	}

	#catego{
		height:2.4em;
		overflow: hidden;
		text-overflow: ellipsis;
		max-height: 2.4em;
	}

	#descripcionP{
		height:3.6em;
		overflow: hidden;
		text-overflow: ellipsis;
	}

	#nomb_empre{
		white-space: nowrap;
		height:1.2em;
		overflow: hidden;
		text-overflow: ellipsis;
	}

  #fech_regis{
  	white-space: nowrap;
  	height:1.2em;
		overflow: hidden;
		text-overflow: ellipsis;
	}

</style>
<?php
	include('../lib/config.php');
	require("../lib/permisosE.php");
	include "../lib/conexion.php";
	$resp=new Llenado_Select();
	$cod=$_SESSION["cod_usuarioE"];
	$sql="select cod_usuario, Fech_regis,nomb_empre, imagen from usuarios_empre where cod_usuario=$cod";
	$array=$resp->llenarSelect($sql);

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

<!--SERVICE SECTION START-->
<section id="services" >
	<div class="container">
		<div class="row text-center header">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 animate-in" data-anim-type="fade-in-up">
				<h3>PERFIL</h3>
			</div>
		</div>
		<div class="row animate-in" data-anim-type="fade-in-up">
			<?php foreach($array as $elementos): ?>
			<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
				<div class="services-wrapper">
					<a href="javascript:void(0)" onclick="document.getElementById('id02').style.display='block'"><img class="img-responsive img-rounded" style="width:100%; height:180px;" src="../Imagenes_Empre/<?php echo $elementos['imagen'] ?>"></a>
					<h3 id="nomb_empre"><?php echo $elementos['nomb_empre'] ?></h3>
					<h5 id="fech_regis">Usuario desde: <?php echo $elementos['Fech_regis'] ?></h5>
				</div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
				<div class="services-wrapper">
					<h3><a href="modificarEmpresas.php?cod=<?php echo $elementos['cod_usuario'] ?>"><i class="fa fa-edit fa-2x"></i></a>Modificar Perfil</h3>
					<h3><a href="javascript:void(0)" onclick="document.getElementById('id01').style.display='block'"><i class="fa fa-lock fa-3x"></i></a> Cambiar Contraseña</h3>
					<h3><a href="../ModulK/oTrabajo.php"><i class="fa fa-file fa-2x"></i></a>Crear Propuesta</h3>
				</div>
			</div>
			<?php endforeach; ?>
			<div class="col-xs-12 col-sm-3 col-md-4 col-lg-4">
				<div class="services-wrapper" style="margin-bottom: 15px;">
					<a href="../ModulK/mensajes2.php"><i class="fa fa-envelope fa-2x"></i></a>
					<h3>Mensajes
					<?php
						$cod=$_SESSION["cod_usuarioE"];
						$consul="select count(CodMensaje) from mensaje where fk_UsuarioEm=? and visto=0";
						$resul= $conexion->prepare($consul);
						$resul->execute(array($cod));
						$num=$resul->fetch(PDO::FETCH_ASSOC);
						$n=implode($num);
						if($n>0)
						{
							echo '<span class="badge badge-error" data-toggle="tooltip" data-placement="bottom" title="Mensajes Recibidos">';echo $n;echo'</span>';

						}

					?></h3>

				</div>
			</div>

			<div class="col-xs-12 col-sm-3 col-md-4 col-lg-4">
				<div class="services-wrapper">
				    <h3 style="margin-top: 0px;">
                        <a href="../ModulE/contaVisitasEmpre.php">
                            <i class="fa fa-eye fa-2x"></i>
                        </a>
                        <?php
                            require("../ModulE/prueba.php");
                        ?>
                    </h3>
				</div>
			</div>

		</div>
	</div>
</section>

<!--TEAM SECTION START-->
<section id="team" >
	<div class="container">
		<div class="row text-center header animate-in" data-anim-type="fade-in-up">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<h3 class="text" align="center">&nbsp&nbsp&nbspPropuestas</h3>
			</div>
		</div>
<?php
		if($num_filas==0)
	{
?>
		<div class="container">
			<div class="row text-center header animate-in" data-anim-type="fade-in-up">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				    <a class="w3-btn w3-blue" data-toggle="tooltip" data-placement="bottom" title="Para poder encontrar a la persona que mejor se adapte a sus necesidades" href="<?php echo $rutaPrin."ModulK/oTrabajo.php";echo'"'?>>Crear Propuesta</a>
					<div class='services-wrapper' style="padding-top:30px">
						<h2><i class="fa fa-warning fa-2x"></i> No hay propuestas publicadas</h2>
					</div>
				</div>
			</div>
		</div>
<?php
	return;
	}
?>
		<div class="row animate-in" data-anim-type="fade-in-up" id="result">
			<?php foreach($array_propuestas as $elemento): ?>
				<div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
					<div class="team-wrapper">
						<div class="team-inner" style="background-image: url('../Imagenes_Empre/<?php echo $elementos['imagen'] ?>')" >
							<a href="verPropuestaE.php?cod=<?php echo $elemento['cod_propuesta'] ?>"><i class="fa fa-eye" data-toggle="tooltip" data-placement="top" title="Ver información de la propuesta">
							<?php
								$pro=$elemento['cod_propuesta'];
								$consul="select count(cod_envio) from enviocurri join propuesta on cod_propuesta=fk_propuesta join
								usuarios_empre on cod_usuario=fk_userEmpre where cod_usuario=$cod and fk_propuesta=$pro and visto=0";
								$resul= $conexion->prepare($consul);
								$resul->execute(array());
								$num=$resul->fetch(PDO::FETCH_ASSOC);
								$n=implode($num);
								if($n>0)
								{
									echo '<span class="badge badge-error">';echo $n;echo'</span>';
								}

							?></i></a>

						</div>

						<div class="description">
							</br>

							<h3 class="text" id="nombreP"><?php echo $elemento['nombreP'] ?></h3>
							<h5 id="catego"> <strong> <?php echo $elemento['catego'] ?> </strong></h5>
							<p class="text" id="descripcionP">
								<?php echo $elemento['descripcionP'] ?>
							</p>
							<p class="" style="font-size: 20px margin-top:28px; position:static; padding-left:0px;"><span class="label label-primary">Vence: <?php echo $elemento['caducidadP'] ?></span></p>
							<a href="#" onclick='swal({
									  title: "Desea eliminar la propuesta?",
									  text: "No podra recuperar la propuesta!",
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
										swal("Borrada!", "Su propuesta ha sido eliminada.", "success");
										window.location.href="eliminarPropuesta.php?cod="+<?php echo $elemento['cod_propuesta'] ?>;
									  }
										else
										{
											swal("Cancelado", "Su propuesta esta segura :)", "error");
									  }
									});' data-toggle="tooltip" data-placement="top" title="Eliminar propuesta"><i class="fa fa-close fa-2x" ></i></a>
									&nbsp;
							<a data-toggle="tooltip" data-placement="top" title="Editar propuesta" href="modificarPropuestas.php?cod=<?php echo $elemento['cod_propuesta'] ?>"><i class="fa fa-edit fa-2x"></i></a>


							<!-- BOTON PARA DESACTIVAR LA PROPUESTA  -->
							<a a href="#" onclick='swal({
									  title: "Desea desactivar esta propuesta?",
									  text: "Si la desactiva no se podra mostrar en las en el inicio. ",
									  type: "warning",
									  showCancelButton: true,
									  confirmButtonColor: "#DD6B55",
									  confirmButtonText: "Si, Desactivar!",
									  cancelButtonText: "No, cancelar!",
									  closeOnConfirm: false,
									  closeOnCancel: false
									},
									function(isConfirm)
									{
									  if (isConfirm) {
										swal("Desactivada!", "Su propuesta ha sido desactivada.", "success");
										window.location.href="../ModulE/estado_de_propuesta.php?cod="+<?php echo $elemento['cod_propuesta'] ?>+"&es="+<?php echo '0' ?>;
									  }
										else
										{
											swal("Cancelado", "Su propuesta sigue activa", "error");
									  }
									});' data-toggle="tooltip" data-placement="top" title="Desactivar la propuesta"><i class="fa fa-eye-slash fa-2x" ></i></a>

									<!-- BOTON PARA ACTIVAR LA PROPUESTA  -->
									<a a href="#" onclick='swal({
											  title: "Desea activar esta propuesta?",
											  text: "Si la activa se podra mostrar en las en el inicio.",
											  type: "info",
											  showCancelButton: true,
											  confirmButtonColor: "#DD6B55",
											  confirmButtonText: "Si, Activar!",
											  cancelButtonText: "No, cancelar!",
											  closeOnConfirm: false,
											  closeOnCancel: false
											},
											function(isConfirm)
											{
											  if (isConfirm) {
												swal("Activada!", "Su propuesta ha sido Activada.", "success");
												window.location.href="../ModulE/estado_de_propuesta.php?cod="+<?php echo $elemento['cod_propuesta'] ?>+"&es="+<?php echo '1' ?>;
											  }
												else
												{
													swal("Cancelado", "Su propuesta sigue desactiva.", "error");
											  }
											});' data-toggle="tooltip" data-placement="top" title="Activar de nuevo la propuesta"><i class="fa fa-eye fa-2x" ></i></a>


						</div>
					</div>
				</div>
			<?php endforeach; 
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
<div id="id01" class="w3-modal" style="z-index:4">
  <div class="w3-modal-content w3-animate-zoom">
    <div class="w3-container w3-padding w3-blue">
       <span onclick="document.getElementById('id01').style.display='none'" class="w3-right w3-xxlarge w3-closebtn"><i class="fa fa-remove"></i></span>
      <h2>Cambiar Contraseña</h2>
    </div>
    <div class="w3-panel">
			<form class="" action="actualizarPassE.php" method="post" >
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
<div id="id02" class="w3-modal" style="z-index:4">
	<div class="w3-modal-content w3-animate-zoom">
		<div class="w3-container w3-padding w3-blue">
			 <span onclick="document.getElementById('id02').style.display='none'" class="w3-right w3-xxlarge w3-closebtn"><i class="fa fa-remove"></i></span>
			<h2>Cambiar Imagen de Perfil</h2>
		</div>
		<div class="w3-panel">
			<form class="" action="actualizarImagenE.php" enctype="multipart/form-data" method="post" >
				<fieldset>
						<label style="color:gray">Imagen de perfil</label>
						<input name="imagen_Usuario" ID="Enviarimagen" type="file" size="20" class="file" data-preview-file-type="image" value="" accept='image/*'>
						<script>
						var $input = $("#Enviarimagen");
						$input.fileinput({
							showUpload: false,
						showRemove: false,
					});
					</script>
					<div class="w3-section">
						<div class="form-group">
							<a class="w3-btn w3-grey" onclick="document.getElementById('id02').style.display='none'">Cancelar  <i class="fa fa-remove"></i></a>
							<button type="submit" class="w3-btn w3-right w3-blue">Cambiar  <i class="fa fa-paper-plane"></i></button>
						</div>
		      </div>
				</fieldset>
			</form>
		</div>
	</div>
</div>
