<?php
//require('lib/Llenado.php');
?>
<!doctype html>
<style>
@media only screen and (max-width: 1300px)
{
	.btn
	{
		min-width: 100%;
    }
    #filtro, #TxtBusqueda
    {
        min-width: 100%;
    }
}


#nombreP{
    white-space: pre-line;
	height:2.4em;
	overflow: hidden;
	text-overflow: ellipsis;
	max-height: 2.4em;
}

#catego{
	height:2.4em;
	overflow: hidden;
	text-overflow: ellipsis;
	max-height: 2.4em;
}

#descripcionP{
	height: 4.8em;
	overflow: hidden;
	text-overflow: ellipsis;
}

</style>
<script src="js/bootstrapValidator.js" type="text/javascript"></script>
<script src="js/messages_es.js" type="text/javascript"></script>
<script src="js/busqueda.js"></script>
<link rel="stylesheet" href="css/w3.css">
<link rel="stylesheet" href="css/pagimacion.css">
<script type="text/javascript">
$(document).ready(function(){
   $("#Depart_Usuario").change(function () {
           $("#Depart_Usuario option:selected").each(function () {
            cod_depart = $(this).val();
            $.post("ModulF/Municipios.php", { cod_depart: cod_depart }, function(data){
                $("#Muni_Usuario").html(data);
            });
        });
   })
});
</script>



<?php
	function get_propuestas($busqueda,$condicion,$jornadaT,$salMin,$salMax,$departam,$municiB,$generoB,$edadMin,$edadMax,$nombEmpre)
	{
		$resp=new Llenado_Select();
		$sql="";

		if(!empty($busqueda))
		{
			$sql.=" and MATCH(cargoP) AGAINST ('$busqueda' IN BOOLEAN MODE ) or cargoP like '%$busqueda%'";
		}

		if(!empty($nombEmpre))
		{
			$sql.=" and nomb_empre LIKE '%$nombEmpre%'";
		}

		if(!empty($condicion))
		{
			$sql.=" and fk_areaP=$condicion";
		}

		if($jornadaT!="")
		{
			$sql.=" and tipoP='$jornadaT'";
		}

		if(!empty($salMin))
		{
			$sql.=" and salarioP=$salMin";
		}

		if(!empty($salMax))
		{
			$sql.=" and salario2=$salMax";
		}

		if(!empty($edadMin))
		{
			$sql.=" and edad=$edadMin";
		}

		if(!empty($edadMax))
		{
			$sql.=" and edad2=$edadMax";
		}

		if(!empty($generoB))
		{
			$sql.=" and generoP='$generoB'";
		}

		if(!empty($departam))
		{
			$sql.=" and fk_departamento=$departam";
		}

		if(!empty($municiB))
		{
			$sql.=" and fk_municipio=$municiB";
		}

		include("lib/conexion.php");

		$tamano_paginas=4;
		if(isset($_GET["pagina"]))
		{
			if($_GET["pagina"]==1)
			{
				$pagina=1;
			}
			else
			{
				$pagina=$_GET["pagina"];
				if($pagina <= 0)
				{
					$pagina = 1;
				}
			}
		}
		else
		{
			$pagina=1;
		}
		$empezar_desde=($pagina-1)*$tamano_paginas;
		$sql3="select cod_propuesta,nombreP,descripcionP,caducidadP,catego,imagen,nomb_empre from propuesta
		join categorias on cod_catego=fk_areaP join usuarios_empre on cod_usuario=fk_userEmpre
		where vistoP=0 $sql and estado=1 order by caducidadP asc";
		$resultado=$conexion->prepare($sql3);
		$resultado->execute(array());
		$num_filas=$resultado->rowCount();
		$total_paginas=ceil($num_filas/$tamano_paginas);
		if($pagina > $total_paginas)
		{
			$pagina = $total_paginas;
		}
		if($pagina < 1)
		{
			$pagina = 1;
		}
		$sqlf="select cod_propuesta,nombreP,descripcionP,caducidadP,catego,imagen,nomb_empre from propuesta
		join categorias on cod_catego=fk_areaP join usuarios_empre on cod_usuario=fk_userEmpre
		where vistoP=0 $sql and estado=1 order by caducidadP asc LIMIT $empezar_desde,$tamano_paginas";
		$array_propuestas= $conexion->prepare($sqlf);
		$array_propuestas->execute(array());
		$num=$array_propuestas->rowCount();
		$pag=$_SERVER['PHP_SELF'];
		if($num>0)
		{
?>


	<div class='container-fluid col-md-12' style='padding-top:55px'>
		<div class='container-fluid col-md-2'></div>
			<div class='container-fluid col-md-8'>
				<form class='navbar-form' id="busqueda" action='<?php echo $pag ?>' method='post'>
    				<input type='text' name='TextBusqueda' id='TxtBusqueda' class='form-control' data-toggle="tooltip" data-placement="bottom" title="Buscar propuestas por nombre del cargo" value="<?php echo $_POST['TextBusqueda']?>" placeholder="Buscar">
    					<select name='CondiBus' id='filtro' class='form-control'>
    						<?php
								if($_POST['CondiBus']!="")
								{
									$cod=$_POST['CondiBus'];
									$sql2="select catego from categorias where cod_catego=$cod";
									$condiBus=$resp->llenarSelect($sql2);
									echo "<option value='"; echo $_POST['CondiBus']; echo"' >";
									foreach ($condiBus as $condi)
									{
		 								echo $condi['0'];
									}
									echo "</option>";
								}
							?>
      						<option value="">Todas las áreas de trabajo</option>
							<?php
								$sql='select * from categorias';
								$rubro=$resp->llenarSelect($sql);
								foreach ($rubro as $rub)
								{
									echo '<option value="'.$rub['0'].'">'.$rub['1'].'</option>';
								}
							?>
						</select>
					<input type='submit' name='btn_buscar' data-toggle="tooltip" data-placement="bottom" title="Buscar propuesta" value='Buscar' class='btn btn-default' >
  					<button class='btn btn-primary' type='button' data-toggle='collapse' data-target='#collapseExample' aria-expanded='false' aria-controls='collapseExample'>Busqueda avanzada</button>
				<p>
					<div class='collapse' id='collapseExample'>
  						<div class='card card-block'>
  							<div class='services-wrapper col-md-12'>
  								<div class="container col-md-6">
								<p>
									<div class="form-group">
  										<label class="text col-md-12 control-label">Jornada de trabajo</label>
    									<div class="col-md-12 selectContainer">
    										<div class="input-group  ">
									        	<span class="input-group-addon" ><i class="glyphicon glyphicon-time"></i></span>
    											<select name="tipoCont" class="form-control selectpicker" >
    												<?php
														if($_POST['tipoCont']!="")
														{
															echo "<option>";echo $_POST['tipoCont'];echo "</option>";
														}
													?>
      												<option value="">Todos los Horarios</option>
      												<option>Medio tiempo</option>
      												<option>Tiempo completo</option>
      												<option >Horario mixto</option>
    											</select>
  											</div>
										</div>
									</div>
								</p>


								<!-- Select Basic -->
								<p>
									<div class="form-group">
  										<label class="text col-md-12 control-label">Departamento</label>
    									<div class="col-md-12 selectContainer">
    										<div class="input-group">
        										<span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
    											<select name="Depart_Usuario" id="Depart_Usuario" class="form-control" >
     												<?php
														if($_POST['Depart_Usuario']!="")
														{
															$cod=$_POST['Depart_Usuario'];
															$sql2="select depart from departamentos where cod_depart=$cod";
															$departBus=$resp->llenarSelect($sql2);
															echo "<option value='"; echo $_POST['Depart_Usuario']; echo"' >";
															foreach ($departBus as $depart) {
		 														echo $depart['0'];
															}
															echo "</option>";
														}
													?>
      												<option value="">Todos los departamentos</option>
       												<?php
														$sql='select * from departamentos order by depart;';
														$consulta=$resp->llenarSelect($sql);
														foreach ($consulta as $consul) {
															echo '<option value="'.$consul['0'].'">'.$consul['1'].'</option>';
														}
													?>
    											</select>
  											</div>
										</div>
									</div>
								</p>

								<p>
									<!-- Select Basic -->
									<div class="form-group">
  										<label class="text col-md-12 control-label">Municipio</label>
    									<div class="col-md-12 selectContainer">
    										<div class="input-group">
        										<span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
    											<select name="Muni_Usuario" id="Muni_Usuario" class="form-control selectpicker">
    												<?php
														if($_REQUEST['Muni_Usuario']!="")
														{
															$cod=$_REQUEST['Muni_Usuario'];
															$sql2="select muni from municipios where cod_muni=$cod";
															$muniBus=$resp->llenarSelect($sql2);
															echo "<option value='"; echo $_REQUEST['Muni_Usuario']; echo"' >";
															foreach ($muniBus as $muni) {
		 														echo $muni['0'];
															}
															echo "</option>";
														}
													?>
													<option value="">Todos los municipios</option>
      											</select>
  											</div>
										</div>
									</div>
								</p>

								<p>
									<div class="form-group">
  										<label class="text col-md-12 control-label">Salario</label>
    									<div class="col-md-12 inputGroupContainer">
    										<div class="input-group">
        										<span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
  												<input name="salario" id="salario" placeholder="Salario minimo" class="form-control"  type="text" value="<?php echo $_POST['salario']?>">
    										</div>
    									</div>
									</div>
								</p>

								<p>
     								<div class="form-group">
  										<label class="col-md-12 control-label"></label>
    									<div class="col-md-12 inputGroupContainer">
    										<div class="input-group">
        										<span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
  												<input name="salario2" id="salario2" placeholder="Salario máximo" class="form-control"  type="text" value="<?php echo $_POST['salario2']?>">
    										</div>
  										</div>
									</div>
								</p>
								</div>

								<div class="container col-md-6">
									<p>
										<div class="form-group">
  											<label class="text col-md-12 control-label">Género</label>
    										<div class="col-md-12 selectContainer">
    											<div class="input-group  ">
        											<span class="input-group-addon" ><i class="glyphicon glyphicon-option-vertical"></i></span>
    												<select name="genero" class="form-control selectpicker" >
     													<?php
														if($_POST['genero']!="")
														{
															echo "<option>";echo $_POST['genero'];echo "</option>";
														}
													?>
      													<option value="" >Todos los generos</option>
      													<option>Masculino</option>
      													<option>Femenino</option>
														<option>Indistinto</option>
    												</select>
  												</div>
											</div>
										</div>
									</p>

									<p>
										<div class="form-group">
  											<label class="text col-md-12 control-label">Edad</label>
    										<div class="col-md-12 inputGroupContainer">
    											<div class="input-group">
        											<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
  													<input name="edad" id="edad" placeholder="Edad minima requerida" class="form-control"  type="text" value="<?php echo $_POST['edad']?>">
    											</div>
    										</div>
										</div>
									</p>

									<p>
										<div class="form-group">
  											<label class="col-md-12 control-label"></label>
    										<div class="col-md-12 inputGroupContainer">
												<div class="input-group">
        											<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
  													<input name="edad2" id="edad2" placeholder="Edad máxima requerida" class="form-control"  type="text" value="<?php echo $_POST['edad2']?>">
    											</div>
 											 </div>
										</div>
									</p>

									<p>
										<div class="form-group">
  											<label class="text col-md-12 control-label">Nombre de la empresa</label>
    										<div class="col-md-12 inputGroupContainer">
    											<div class="input-group">
        											<span class="input-group-addon"><i class="glyphicon glyphicon-th-large"></i></span>
  													<input name="empre" id="edad" placeholder="Nombre empresa" class="form-control"  type="text" value="<?php echo $_POST['empre']?>">
    											</div>
    										</div>
										</div>
									</p>

								</div>


							</div>
						</div>
					</div>
				</div>

				</p>

		<div class='container'>
			<div class='row text-center header animate-in' data-anim-type='fade-in-up'>
				<div class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>
					<h3 class='text'>Propuestas</h3>
				</div>
			</div>
		</div>
		<div class='container'>
			<div class='row animate-in' data-anim-type='fade-in-up'>
				<?php
					foreach($array_propuestas as $elemento):
				?>
				<div class='col-xs-12 col-sm-4 col-md-3 col-lg-3'>
					<div class='team-wrapper'>
						<div class="team-inner" style="background-image: url('Imagenes_Empre/<?php echo $elemento['imagen'] ?>')" >
							<a href="ModulC/verPropuesta.php?cod=<?php echo $elemento['cod_propuesta'] ?>"><i data-toggle="tooltip" data-placement="bottom" title="Ver detalles de la propuesta" class="fa fa-eye" ></i></a>
						</div>
						<div class='description'>
							<h3 id="nombreP" class='text' data-toggle="tooltip" data-placement="top" title="Nombre de la propuesta">
                                <?php echo $elemento['nombreP']?>
                            </h3>
							<h5 id="catego">
                                <strong>
                                    <?php echo $elemento['catego']?>
                                </strong>
                            </h5>
							<p id="descripcionP" class='text' data-toggle="tooltip" data-placement="top" title="Descripción de la propuesta">
                                <?php echo $elemento['descripcionP']?>
                            </p>
							<p style="font-size: 20px; margin-top: 20px; position: static; padding-left: 0px;">
								<span class='label label-primary' data-toggle="tooltip" data-placement="top" title="Fecha de vencimiento de la propuesta">
                                    Vence:<?php echo $elemento['caducidadP']?>
                                </span>
							</p>
						</div>
					</div>
				</div>

		<?php
			endforeach
		?>
	</div>
</div>
</section>
<div class="row text-center header animate-in" data-anim-type="fade-in-up">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<h4 class="text">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Paginas</h4>
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
								<li><a class="text" href="?pagina=<?php echo $i ?>" style="font-size:15px"><?php echo $i ?></a></li><?php
								}
							}
					?>
					<?php }
							if($total_paginas > $pagina)
							{ ?>
								<li class="next"><a class="text" href="?pagina=<?php echo $nextpage ?>" style="font-size:15px">Siguiente &raquo;</a></li><?php
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
							<li class="previous"><a class="text" href="?pagina=<?php echo $prevpage ?>" style="font-size:15px">&laquo; Anterior</a></li><?php
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
								<li class="next"><a class="text" href="?pagina=<?php echo $nextpage ?>" style="font-size:15px">Siguiente &raquo;</a></li><?php
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
	{
?>
		<div class='container-fluid col-md-12' style='padding-top:55px'>
		<div class='container-fluid col-md-2'></div>
			<div class='container-fluid col-md-8'>
				<form class='navbar-form' id="busqueda" action='<?php echo $pag ?>' method='post'>
    				<input type='text' name='TextBusqueda' id='TxtBusqueda' class='form-control' value="<?php echo $_POST['TextBusqueda']?>" placeholder="Buscar">
    					<select name='CondiBus' id='filtro' class='form-control'>
    						<?php
								if($_POST['CondiBus']!="")
								{
									$cod=$_POST['CondiBus'];
									$sql2="select catego from categorias where cod_catego=$cod";
									$condiBus=$resp->llenarSelect($sql2);
									echo "<option value='"; echo $_POST['CondiBus']; echo"' >";
									foreach ($condiBus as $condi) {
		 								echo $condi['0'];
									}
									echo "</option>";
								}
							?>
      						<option value="">Todas las áreas de trabajo</option>
      					<?php
							$sql='select * from categorias';
							$rubro=$resp->llenarSelect($sql);
		            		foreach ($rubro as $rub) {
								echo '<option value="'.$rub['0'].'">'.$rub['1'].'</option>';
							}
						?>
   					</select>
					<input type='submit' name='btn_buscar' value='Buscar' class='btn btn-default' >
  					<button class='btn btn-primary' type='button' data-toggle='collapse' data-target='#collapseExample' aria-expanded='false' aria-controls='collapseExample'>Busqueda avanzada</button>
				<p>
					<div class='collapse' id='collapseExample'>
  						<div class='card card-block'>
  							<div class='services-wrapper col-md-12'>
  								<div class="container col-md-6">
								<p>
									<div class="form-group">
  										<label class="text col-md-12 control-label">Jornada de trabajo</label>
    									<div class="col-md-12 selectContainer">
    										<div class="input-group  ">
									        	<span class="input-group-addon" ><i class="glyphicon glyphicon-time"></i></span>
    											<select name="tipoCont" class="form-control selectpicker" >
    												<?php
														if($_POST['tipoCont']!="")
														{
															echo "<option>";echo $_POST['tipoCont'];echo "</option>";
														}
													?>
      												<option value="">Todos los Horarios</option>
      												<option>Medio tiempo</option>
      												<option>Tiempo completo</option>
      												<option >Horario mixto</option>
    											</select>
  											</div>
										</div>
									</div>
								</p>


								<!-- Select Basic -->
								<p>
									<div class="form-group">
  										<label class="text col-md-12 control-label">Departamento</label>
    									<div class="col-md-12 selectContainer">
    										<div class="input-group">
        										<span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
    											<select name="Depart_Usuario" id="Depart_Usuario" class="form-control" >
     												<?php
														if($_POST['Depart_Usuario']!="")
														{
															$cod=$_POST['Depart_Usuario'];
															$sql2="select depart from departamentos where cod_depart=$cod";
															$departBus=$resp->llenarSelect($sql2);
															echo "<option value='"; echo $_POST['Depart_Usuario']; echo"' >";
															foreach ($departBus as $depart) {
		 														echo $depart['0'];
															}
															echo "</option>";
														}
													?>
      												<option value="">Todos los departamentos</option>
       												<?php
														$sql='select * from departamentos order by depart;';
														$consulta=$resp->llenarSelect($sql);
														foreach ($consulta as $consul) {
															echo '<option value="'.$consul['0'].'">'.$consul['1'].'</option>';
														}
													?>
    											</select>
  											</div>
										</div>
									</div>
								</p>

								<p>
									<!-- Select Basic -->
									<div class="form-group">
  										<label class="text col-md-12 control-label">Municipio</label>
    									<div class="col-md-12 selectContainer">
    										<div class="input-group">
        										<span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
    											<select name="Muni_Usuario" id="Muni_Usuario" class="form-control selectpicker">
    												<?php
														if($_REQUEST['Muni_Usuario']!="")
														{
															$cod=$_REQUEST['Muni_Usuario'];
															$sql2="select muni from municipios where cod_muni=$cod";
															$muniBus=$resp->llenarSelect($sql2);
															echo "<option value='"; echo $_REQUEST['Muni_Usuario']; echo"' >";
															foreach ($muniBus as $muni) {
		 														echo $muni['0'];
															}
															echo "</option>";
														}
													?>
     												<option value="">Todos los municipios</option>
      											</select>
  											</div>
										</div>
									</div>
								</p>

								<p>
									<div class="form-group">
  										<label class="text col-md-12 control-label">Salario</label>
    									<div class="col-md-12 inputGroupContainer">
    										<div class="input-group">
        										<span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
  												<input name="salario" id="salario" placeholder="Salario minimo" class="form-control"  type="text" value="<?php echo $_POST['salario']?>">
    										</div>
    									</div>
									</div>
								</p>

								<p>
     								<div class="form-group">
  										<label class="col-md-12 control-label"></label>
    									<div class="col-md-12 inputGroupContainer">
    										<div class="input-group">
        										<span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
  												<input name="salario2" id="salario2" placeholder="Salario máximo" class="form-control"  type="text" value="<?php echo $_POST['salario2']?>">
    										</div>
  										</div>
									</div>
								</p>
								</div>

								<div class="container col-md-6">
									<p>
										<div class="form-group">
  											<label class="text col-md-12 control-label">Género</label>
    										<div class="col-md-12 selectContainer">
    											<div class="input-group  ">
        											<span class="input-group-addon" ><i class="glyphicon glyphicon-option-vertical"></i></span>
    												<select name="genero" class="form-control selectpicker" >
     													<?php
														if($_POST['genero']!="")
														{
															echo "<option>";echo $_POST['genero'];echo "</option>";
														}
													?>
      													<option value="" >Todos los generos</option>
      													<option>Masculino</option>
      													<option>Femenino</option>
														<option>Indistinto</option>
    												</select>
  												</div>
											</div>
										</div>
									</p>

									<p>
										<div class="form-group">
  											<label class="text col-md-12 control-label">Edad</label>
    										<div class="col-md-12 inputGroupContainer">
    											<div class="input-group">
        											<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
  													<input name="edad" id="edad" placeholder="Edad minima requerida" class="form-control"  type="text" value="<?php echo $_POST['edad']?>">
    											</div>
    										</div>
										</div>
									</p>

									<p>
										<div class="form-group">
  											<label class="col-md-12 control-label"></label>
    										<div class="col-md-12 inputGroupContainer">
												<div class="input-group">
        											<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
  													<input name="edad2" id="edad2" placeholder="Edad máxima requerida" class="form-control"  type="text" value="<?php echo $_POST['edad2']?>">
    											</div>
 											 </div>
										</div>
									</p>

									<p>
										<div class="form-group">
  											<label class="text col-md-12 control-label">Nombre de la empresa</label>
    										<div class="col-md-12 inputGroupContainer">
    											<div class="input-group">
        											<span class="input-group-addon"><i class="glyphicon glyphicon-th-large"></i></span>
  													<input name="empre" id="edad" placeholder="Nombre empresa" class="form-control"  type="text" value="<?php echo $_POST['empre']?>">
    											</div>
    										</div>
										</div>
									</p>

								</div>


							</div>
						</div>
					</div>
				</div>
				<div class='container-fluid col-md-2'></div>

				</p>


				<div class='container'></div>
					<div class="row text-center header animate-in" data-anim-type="fade-in-up">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<div class='services-wrapper' style="padding-top:150px">

								<h2><i class="fa fa-warning fa-2x"></i> No se encontraron resultados</h2>

							</div>
						</div>
					</div>
				</div>



<?php
	}
}
?>
<?php
	$res=new Llenado_Select();
	 if(isset($_POST['TextBusqueda'])){

		 $buscar=addslashes($_POST['TextBusqueda']);
	 }
	else{
		$buscar="";
		$condi="";
		$jornadaT="";
		$departa="";
		$munici="";
		$salaMin="";
		$salaMax="";
		$genero="";
		$edad="";
		$edad2="";
		$empre="";
	}

	if(isset($_POST['tipoCont'])){
		 $jornadaT=$_POST['tipoCont'];
	 }
	if(isset($_POST['CondiBus'])){
		 $condi=$_POST['CondiBus'];
	 }

	if(isset($_POST['Depart_Usuario'])){
		 $departa=$_POST['Depart_Usuario'];
	 }

	if(isset($_REQUEST['Muni_Usuario'])){
		 $munici=$_REQUEST['Muni_Usuario'];
	 }
	 else
	 {
		 $munici="";
	 }

	if(isset($_POST['salario'])){
		 $salaMin=htmlentities(addslashes($_POST['salario']));
	 }

	if(isset($_POST['salario2'])){
		 $salaMax=htmlentities(addslashes($_POST['salario2']));
	 }

	if(isset($_POST['genero'])){
		 $genero=$_POST['genero'];
	 }

	if(isset($_POST['edad'])){
		 $edad=htmlentities(addslashes($_POST['edad']));
	 }

	if(isset($_POST['edad2'])){
		 $edad2=htmlentities(addslashes($_POST['edad2']));
	 }

	 if(isset($_POST['empre'])){
		 $empre= htmlentities(addslashes($_POST['empre']));
	 }

	$pag=$_SERVER['PHP_SELF'];

	if($buscar!=NULL or $condi!=NULL OR $jornadaT!=NULL OR $departa!=NULL OR $munici!=NULL OR $salaMin!=NULL OR $salaMax!=NULL OR $genero!=NULL OR $edad!=NULL OR $edad2!=NULL OR $empre!=NULL)
	{
		get_propuestas($buscar,$condi,$jornadaT,$salaMin,$salaMax,$departa,$munici,$genero,$edad,$edad2,$empre);
	}
	else{
		?>
		<div class='container-fluid col-md-12' style='padding-top:55px'>
			<div class='container-fluid col-md-2'></div>
			<div class='container-fluid col-md-8'>
				<form class='navbar-form' id="busqueda"action='<?php echo $pag ?>' method='post'>
					<input type='text' name='TextBusqueda' id='TxtBusqueda' class='form-control' data-toggle="tooltip" data-placement="bottom" title="Buscar propuestas por nombre del cargo" class="white-tooltip" placeholder='Buscar'>
    				<select name='CondiBus' id='filtro' class='form-control'>
      					<option value='' >Todas las áreas de trabajo</option>
      					<?php
							$sql='select * from categorias';
							$rubro=$res->llenarSelect($sql);
		            		foreach ($rubro as $rub) {
								echo '<option value="'.$rub['0'].'">'.$rub['1'].'</option>';
							}
						?>
					</select>
					<input type='submit' name='btn_buscar' data-toggle="tooltip" data-placement="bottom" title="Buscar propuesta" value='Buscar' class='btn btn-default'>
					<button class='btn btn-primary' type='button' data-toggle='collapse' data-target='#collapseExample' aria-expanded='false' aria-controls='collapseExample'>Busqueda avanzada</button>
				<p>
					<div class='collapse' id='collapseExample'>
  						<div class='card card-block'>
  							<div class='services-wrapper col-md-12'>
  								<div class="container col-md-6">
								<p>
									<div class="form-group">
  										<label class="text col-md-12 control-label">Jornada de trabajo</label>
    									<div class="col-md-12 selectContainer">
    										<div class="input-group  ">
									        	<span class="input-group-addon" ><i class="glyphicon glyphicon-time"></i></span>
    											<select name="tipoCont" class="form-control selectpicker" >
      												<option value="" >Todos los Horarios</option>
      												<option>Medio tiempo</option>
      												<option>Tiempo completo</option>
      												<option >Horario mixto</option>
    											</select>
  											</div>
										</div>
									</div>
								</p>


								<!-- Select Basic -->
								<p>
									<div class="form-group">
  										<label class="text col-md-12 control-label">Departamento</label>
    									<div class="col-md-12 selectContainer">
    										<div class="input-group">
        										<span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
    											<select name="Depart_Usuario" id="Depart_Usuario" class="form-control selectpicker" >
      												<option value="" >Todos los departamentos</option>
       												<?php
														$sql='select * from departamentos order by depart;';
														$consulta=$res->llenarSelect($sql);
														foreach ($consulta as $consul) {
															echo '<option value="'.$consul['0'].'">'.$consul['1'].'</option>';
														}
													?>
    											</select>
  											</div>
										</div>
									</div>


								</p>

								<p>
									<!-- Select Basic -->
									<div class="form-group">
  										<label class="text col-md-12 control-label">Municipio</label>
    									<div class="col-md-12 selectContainer">
    										<div class="input-group">
        										<span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
    											<select name="Muni_Usuario" id="Muni_Usuario" class="form-control selectpicker">
     												<option value="">Todos los municipios</option>
      											</select>
  											</div>
										</div>
									</div>
								</p>

								<p>
									<div class="form-group">
  										<label class="text col-md-12 control-label">Salario</label>
    									<div class="col-md-12 inputGroupContainer">
    										<div class="input-group">
        										<span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
  												<input name="salario" id="salario" placeholder="Salario minimo" class="form-control"  type="text">
    										</div>
    									</div>
									</div>
								</p>

								<p>
     								<div class="form-group">
  										<label class="col-md-12 control-label"></label>
    									<div class="col-md-12 inputGroupContainer">
    										<div class="input-group">
        										<span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
  												<input name="salario2" id="salario2" placeholder="Salario máximo" class="form-control"  type="text">
    										</div>
  										</div>
									</div>
								</p>
								</div>

								<div class="container col-md-6">
									<p>
										<div class="form-group">
  											<label class="text col-md-12 control-label">Género</label>
    										<div class="col-md-12 selectContainer">
    											<div class="input-group  ">
        											<span class="input-group-addon" ><i class="glyphicon glyphicon-option-vertical"></i></span>
    												<select name="genero" class="form-control selectpicker" >
      													<option value="" >Todos los generos</option>
      													<option>Masculino</option>
      													<option>Femenino</option>
														<option>Indistinto</option>
    												</select>
  												</div>
											</div>
										</div>
									</p>

									<p>
										<div class="form-group">
  											<label class="text col-md-12 control-label">Edad</label>
    										<div class="col-md-12 inputGroupContainer">
    											<div class="input-group">
        											<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
  													<input name="edad" id="edad" placeholder="Edad minima requerida" class="form-control"  type="text">
    											</div>
    										</div>
										</div>
									</p>

									<p>
										<div class="form-group">
  											<label class="col-md-12 control-label"></label>
    										<div class="col-md-12 inputGroupContainer">
												<div class="input-group">
        											<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
  													<input name="edad2" id="edad2" placeholder="Edad máxima requerida" class="form-control"  type="text">
    											</div>
 											 </div>
										</div>
									</p>

									<p>
										<div class="form-group">
  											<label class="text col-md-12 control-label">Nombre de la empresa</label>
    										<div class="col-md-12 inputGroupContainer">
    											<div class="input-group">
        											<span class="input-group-addon"><i class="glyphicon glyphicon-th-large"></i></span>
  													<input name="empre" id="edad" placeholder="Nombre empresa" class="form-control"  type="text">
    											</div>
    										</div>
										</div>
									</p>


								</div>


							</div>
						</div>
					</div>
				</p>
			</div>
		</div>
				<?php
					require("mediaObjectt.php");
				?>

<?php
	}

?>
