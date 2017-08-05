<?php
  require('../lib/Llenado.php');
  require ("navEmpresa.php");
?>
<!doctype html>
<script src="js/bootstrapValidator.js" type="text/javascript"></script>
<script src="js/messages_es.js" type="text/javascript"></script>
<script src="js/busqueda.js"></script>
<script type="text/javascript">
$(document).ready(function()
{
   $("#Depart_Usuario").change(function ()
   {
     $("#Depart_Usuario option:selected").each(function ()
     {
       cod_depart = $(this).val();
       $.post("../ModulF/Municipios.php", { cod_depart: cod_depart }, function(data)
       {
          $("#Muni_Usuario").html(data);
        });
      });
   })
});
</script>

<style>
@media only screen and (max-width: 1300px)
{
	.btn
	{
		min-width: 100%;
    }
}


#nombre{
	height:2.4em;
	overflow: hidden;
	text-overflow: pre-line;
	max-height: 2.4em;
}

#titulo{
  /*white-space: nowrap; */
	height:2.4em;
	overflow: hidden;
	text-overflow: ellipsis;
	max-height: 2.4em;
}

</style>

<?php
  function get_propuestas($busqueda,$condicion,$vehi,$moto,$licencia,$departam,$municiB,$generoB,$edadU,$idiomaU,$nivelU)
  {
	$resp=new Llenado_Select();
	$sql="";

    if($busqueda!="")
	{
		$sql.=" and MATCH(tituloObtenidoS, tituloObtenidoSecu) AGAINST ( '$busqueda' IN BOOLEAN MODE  ) ";

	}

	if (!empty($condicion))
	{
		$sql.=" and fk_categ=$condicion ";

	}

	if($vehi!="")
	{
		$sql.=" and Pos_vehi='$vehi' ";

	}

	if($moto!="")
	{
		$sql.=" and Pos_moto='$moto'";
	}

	if($licencia!="")
	{
        $sql.=" and fk_TipoLicen=$licencia";
	}

	if($departam!="")
	{
		$sql.=" and fk_departamento=$departam";
	}

	if($municiB!="")
	{
		$sql.=" and fk_municipio=$municiB";
	}

	if($generoB!="")
	{
		$sql.=" and sexo='$generoB'";
	}

	if($edadU!="")
	{
		$sql.=" and YEAR(CURDATE())-YEAR(Fech_Naci) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(Fech_Naci,'%m-%d'), 0, -1)=$edadU";
	}

	if($idiomaU!="")
	{
		$sql.=" and fk_idioma=$idiomaU";
	}

	if($nivelU!="")
	{
		$sql.=" and fk_nivel=$nivelU";
	}

	include("../lib/conexion.php");
	$sql1="select distinct cod_empleo,nombres,img_perfil,concat_ws(' ', tituloObtenidoS, tituloObtenidoSecu) as titulo, YEAR(CURDATE())-YEAR(Fech_Naci) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(Fech_Naci,'%m-%d'), 0, -1) AS `EDAD_ACTUAL` from usuarios_empleo join educacion on cod_empleo=fk_userEdu
	join curri_expelabo on fk_userExpeLbo=cod_empleo join curri_idioma on fk_userIdioma=cod_empleo where activo=1 $sql";
	$array_propuestas= $conexion->prepare($sql1);
	$array_propuestas->execute(array());
	$num=$array_propuestas->rowCount();
	$pag=$_SERVER['PHP_SELF'];
?>
	<div class='container-fluid col-md-12' style='padding-top:55px'>
		<div class='container-fluid col-md-2'></div>
			<div class='container-fluid col-md-8'>
				<form class='navbar-form' id="busqueda" action='<?php echo $pag ?>' method='post'>
    				<input type='text' name='TextBusqueda' data-toggle="tooltip" data-placement="bottom" title="Buscar empleados por título obtenido" placeholder='Buscar Empleado' id='TxtBusqueda' class='form-control' value="<?php echo $_POST['TextBusqueda']?>">
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
      						<option value="">Todas las áreas de experiencia</option>
							<?php
								$sql='select * from categorias';
								$rubro=$resp->llenarSelect($sql);
								foreach ($rubro as $rub) {
									echo '<option value="'.$rub['0'].'">'.$rub['1'].'</option>';
								}
							?>
   					</select>
					<input type='submit' name='btn_buscar' value='Buscar' class='btn btn-default' data-toggle="tooltip" data-placement="bottom" title="Buscar empleado">
  					<button class='btn btn-primary' type='button' data-toggle='collapse' data-target='#collapseExample' aria-expanded='false' aria-controls='collapseExample'>Busqueda avanzada</button>
				<p>
					<div class='collapse' id='collapseExample'>
  						<div class='card card-block'>
  							<div class='services-wrapper col-md-12'>
  								<div class="container col-md-6">
								<p>
									<div class="form-group">
										<label class="text col-md-12 control-label">¿Posee vehículo?</label>
											<div class="col-md-12 selectContainer">
												<div class="input-group">
													<span class="input-group-addon"><i class="glyphicon glyphicon-scale"></i></span>
														<select name="Vehi_Usuario" class="form-control selectpicker" >
															<?php
																if($_POST['Vehi_Usuario']!="")
																{
																	echo "<option>";echo $_POST['Vehi_Usuario'];echo "</option>";
																}
															?>
															<option value="" >Seleccione una respuesta</option>
															<option>Si</option>
															<option>No</option>
														</select>
												</div>
											</div>
									</div>
								</p>


								<!-- Select Basic -->
								<p>
									<div class="form-group">
										  <label class="text col-md-12 control-label">¿Posee motocicleta?</label>
											<div class="col-md-12 selectContainer">
												<div class="input-group">
													<span class="input-group-addon"><i class="glyphicon glyphicon-scale"></i></span>
													<select name="Moto_Usuario" class="form-control selectpicker" >
														<?php
																if($_POST['Moto_Usuario']!="")
																{
																	echo "<option>";echo $_POST['Moto_Usuario'];echo "</option>";
																}
															?>
														<option value="" >Seleccione una respuesta</option>
														<option>Si</option>
														<option>No</option>
													</select>
												</div>
											</div>
									</div>

								</p>

								<p>
									<div class="form-group">
										  <label class="text col-md-12 control-label">Tipo de licencia:</label>
											<div class="col-md-12 selectContainer">
												<div class="input-group">
													<span class="input-group-addon"><i class="glyphicon glyphicon-option-vertical"></i></span>
													<select name="TipLicen_Usuario" id="Tip_Licen" class="form-control selectpicker">
														<?php
															if($_POST['TipLicen_Usuario']!="")
															{
																$cod=$_POST['TipLicen_Usuario'];
																$sql2="select tip_Licen from licencias where cod_Licen=$cod";
																$tipLicen=$resp->llenarSelect($sql2);
																echo "<option value='"; echo $_POST['TipLicen_Usuario']; echo"' >";
																foreach ($tipLicen as $licen) {
																	echo $licen['0'];
																}
																echo "</option>";
															}
														?>
														<option value="">Seleccione una opción</option>
															<?php
																$sql='select * from licencias;';
																$Licencia=$resp->llenarSelect($sql);
																foreach ($Licencia as $licen) {
																	echo '<option value="'.$licen['0'].'">'.$licen['1'].'</option>';
															}?>
													</select>
												</div>
											</div>
										</div>
									</p>

									<!-- Select Basic -->
									<p>
										<div class="form-group">
											<label class="text col-md-12 control-label">Departamento de residencia</label>
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

									<!-- Select Basic -->
									<p>
									<div class="form-group">
  										<label class="text col-md-12 control-label">Municipio de residencia</label>
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
						</div>

								<div class="container col-md-6">
									<p>
									<div class="form-group">
											<label class="text col-md-12 control-label">Género</label>
											<div class="col-md-12 selectContainer">
												<div class="input-group">
													<span class="input-group-addon"><i class="glyphicon glyphicon-option-vertical"></i></span>
													<select name="Sexo_Usuario" class="form-control selectpicker" >
														<?php
															if($_POST['Sexo_Usuario']!="")
															{
																echo "<option>";echo $_POST['Sexo_Usuario'];echo "</option>";
															}
														?>
														<option value="">Todos los géneros</option>
														<option value="F" >Femenino</option>
														<option value="M" >Masculino</option>
														<option value="O" >Otros</option>
													</select>
												</div>
											</div>
										</div>
								</p>

								<p>
									<div class="form-group">
  											<label class="text col-md-12 control-label">Edad</label>
    										<div class="col-md-8 inputGroupContainer">
    											<div class="input-group">
        											<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
  													<input name="edad" id="edad" placeholder="Edad requerida" class="form-control"  type="text" value="<?php echo $_POST['edad']?>">
    											</div>
    										</div>
										</div>
								</p>

								<p>
									<div class="form-group">
										<label class="text col-md-12 control-label">Idioma</label>
										<div class="col-md-8 selectContainer">
											<div class="input-group">
												<span class="input-group-addon"><i class="glyphicon glyphicon-flag"></i></span>
												<select name="idioma" class="form-control selectpicker">
													<?php
														if($_POST['idioma']!="")
														{
															$cod=$_POST['idioma'];
															$sql2="select idioma from idioma where cod_idioma=$cod";
															$idiomaU=$resp->llenarSelect($sql2);
															echo "<option value='"; echo $_POST['idioma']; echo"' >";
															foreach ($idiomaU as $idiom) {
		 														echo $idiom['0'];
															}
															echo "</option>";
														}
													?>
													<option value="">Seleccione un idioma</option>
														<?php
															$sql='select * from idioma';
															$idiomas=$resp->llenarSelect($sql);
															foreach ($idiomas as $idi) {
															echo '<option value="'.$idi['0'].'">'.$idi['1'].'</option>';
														}?>
												</select>
											</div>
										</div>
									</div>
								</p>

									<p>
										<div class="form-group">
											<label class="text col-md-12 control-label">Nivel</label>
											<div class="col-md-12 selectContainer">
												<div class="input-group">
													<span class="input-group-addon"><i class="glyphicon glyphicon-flag"></i></span>
													<select name="nivel" class="form-control selectpicker">
														<?php
															if($_POST['nivel']!="")
															{
																$cod=$_POST['nivel'];
																$sql2="select nivel from nivelidiom where cod_nivel=$cod";
																$nivel=$resp->llenarSelect($sql2);
																echo "<option value='"; echo $_POST['nivel']; echo"' >";
																foreach ($nivel as $niv) {
																	echo $niv['0'];
																}
																echo "</option>";
															}
														?>
														<option value="">Seleccione el nivel</option>
														<?php
															$sql='select * from nivelidiom';
															$nivel=$resp->llenarSelect($sql);
															foreach ($nivel as $niv) {
															echo '<option value="'.$niv['0'].'">'.$niv['1'].'</option>';
														}?>
													</select>
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
		<?php
			if($num==0)
			{?>
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
			return;
			}
		?>

		<div class='container'>
			<div class='row text-center header animate-in' data-anim-type='fade-in-up'>
				<div class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>
					<h3 class='text'>Usuarios</h3>
					<hr />
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
						<div class="team-inner" style="background-image: url('../Imagenes_Users/<?php echo $elemento['img_perfil'] ?>')" >
							<a href="curriBusque.php?cod=<?php echo $elemento['cod_empleo'] ?>"><i class="fa fa-eye" data-toggle="tooltip" data-placement="bottom" title="Ver curriculum"></i></a>
						</div>
						<div class='description'>
							<h3 id="nombre" class='text'><?php echo $elemento['nombres']?></h3>
							<h5 id="titulo"> <strong><?php echo $elemento['titulo']?></strong></h5>
							<p style='font-size: 20px'><span class='label label-primary'>Edad: <?php echo $elemento['EDAD_ACTUAL']?> años</span></p>
						</div>
					</div>
				</div>

		<?php
			endforeach
		?>
	</div>
</div>
</section>

<?php
	}

	$res=new Llenado_Select();
	 if(isset($_POST['TextBusqueda']))
	 {
		 $buscar= addslashes($_POST['TextBusqueda']);
	 }
	else
	{
		$buscar="";
	}

	if(isset($_POST['Vehi_Usuario']))
	{
		 $vehiU=$_POST['Vehi_Usuario'];
	}
	else
	{
		$vehiU="";
	}

	if(isset($_POST['CondiBus']))
	{
		 $condi=$_POST['CondiBus'];
	}
	else
	{
		$condi="";
	}

	if(isset($_POST['Depart_Usuario']))
	{
		 $departa=$_POST['Depart_Usuario'];
	}
	else
	{
		$departa="";
	}

	if(isset($_REQUEST['Muni_Usuario']))
	{
		 $munici=$_REQUEST['Muni_Usuario'];
	}
	else
	{
		$munici="";
	}

	if(isset($_POST['Moto_Usuario']))
	{
		 $motoU=$_POST['Moto_Usuario'];
	}
	else
	{
		$motoU="";
	}

	if(isset($_POST['TipLicen_Usuario']))
	{
		 $tipLicen=$_POST['TipLicen_Usuario'];
	}
	else
	{
		$tipLicen="";
	}

	if(isset($_POST['Sexo_Usuario']))
	{
		 $genero=$_POST['Sexo_Usuario'];
	}
	else
	{
		$genero="";
	}

	if(isset($_POST['edad']))
	{
		$edad=htmlentities(addslashes($_POST['edad']));
	}
	else
	{
		$edad="";
	}

	if(isset($_POST['idioma']))
	{
		$idioma=$_POST['idioma'];
	}
	else
	{
		$idioma="";
	}

	if(isset($_POST['nivel']))
	{
		 $nivel=$_POST['nivel'];
	}
	else
	{
		$nivel="";
	}

	$pag=$_SERVER['PHP_SELF'];

	if($vehiU!=NULL or $buscar!=NULL or $nivel!=NULL or $idioma!=NULL or $edad!=NULL or $genero!=NULL or $tipLicen!=NULL or $motoU!=NULL or $departa!=NULL or $condi!=NULL)
  {
		get_propuestas($buscar,$condi,$vehiU,$motoU,$tipLicen,$departa,$munici,$genero,$edad,$idioma,$nivel);
	}
	else{
?>
	<div class='container-fluid col-md-12' style='padding-top:50px'>
		<div class='container-fluid col-md-2'></div>
			<div class='container-fluid col-md-8'>
				<form class='navbar-form' id="busqueda"action='<?php echo $pag ?>' method='post'>
    			<input type='text' name='TextBusqueda' id='TxtBusqueda' data-toggle="tooltip" data-placement="bottom" title="Buscar empleados por título obtenido" class='form-control' placeholder='Buscar empleado'>
    			<select name='CondiBus' id='filtro' class='form-control'>
      			<option value="" >Todas las áreas de experiencia</option>
      			<?php
							$sql='select * from categorias';
							$rubro=$res->llenarSelect($sql);
		          foreach ($rubro as $rub)
              {
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
										  <label class="text col-md-12 control-label">¿Posee vehículo?</label>
											<div class="col-md-12 selectContainer">
												<div class="input-group">
													<span class="input-group-addon"><i class="glyphicon glyphicon-scale"></i></span>
													<select name="Vehi_Usuario" class="form-control selectpicker" >
													<option value="" >Seleccione una respuesta</option>
													<option>Si</option>
													<option>No</option>
													</select>
												</div>
											</div>
										</div>
									</p>

									<p>
										<div class="form-group">
										  <label class="text col-md-12 control-label">¿Posee motocicleta?</label>
											<div class="col-md-12 selectContainer">
												<div class="input-group">
													<span class="input-group-addon"><i class="glyphicon glyphicon-scale"></i></span>
													<select name="Moto_Usuario" class="form-control selectpicker" >
													<option value="" >Seleccione una respuesta</option>
													<option>Si</option>
													<option>No</option>
													</select>
												</div>
											</div>
										</div>
									</p>

									<p>
										<div class="form-group">
										  <label class="text col-md-12 control-label">Tipo de licencia:</label>
											<div class="col-md-12 selectContainer">
												<div class="input-group">
													<span class="input-group-addon"><i class="glyphicon glyphicon-option-vertical"></i></span>
													<select name="TipLicen_Usuario" id="Tip_Licen" class="form-control selectpicker">
													<option value="" >Todas las opciones</option>
													<?php
																$sql='select * from licencias;';
																$Licencia=$res->llenarSelect($sql);
																foreach ($Licencia as $licen) {
																	echo '<option value="'.$licen['0'].'">'.$licen['1'].'</option>';
															}?>
													</select>
												</div>
											</div>
										</div>
									</p>

									<!-- Select Basic -->
									<p>
										<div class="form-group">
											<label class="text col-md-12 control-label">Departamento de residencia</label>
											<div class="col-md-12 selectContainer">
												<div class="input-group">
													<span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
													<select name="Depart_Usuario" id="Depart_Usuario" class="form-control selectpicker" >
														<option value="">Todos los departamentos</option>
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

									<!-- Select Basic -->
									<p>
										<div class="form-group">
											<label class="text col-md-12 control-label">Municipio de residencia</label>
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

								</div>

								<div class="container col-md-6">
									<p>
										<div class="form-group">
											<label class="text col-md-12 control-label">Género</label>
											<div class="col-md-12 selectContainer">
												<div class="input-group">
													<span class="input-group-addon"><i class="glyphicon glyphicon-option-vertical"></i></span>
													<select name="Sexo_Usuario" class="form-control selectpicker" >
														<option value="">Todos los géneros</option>
														<option value="F" >Femenino</option>
														<option value="M" >Masculino</option>
														<option value="O" >Otros</option>
													</select>
												</div>
											</div>
										</div>
									</p>

									<p>
										<div class="form-group">
  											<label class="text col-md-12 control-label">Edad</label>
    										<div class="col-md-8 inputGroupContainer">
    											<div class="input-group">
        											<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
  													<input name="edad" id="edad" placeholder="Edad requerida" class="form-control"  type="text">
    											</div>
    										</div>
										</div>
									</p>

									<p>
										<div class="form-group">
											<label class="text col-md-12 control-label">Idioma</label>
											<div class="col-md-8 selectContainer">
												<div class="input-group">
													<span class="input-group-addon"><i class="glyphicon glyphicon-flag"></i></span>
													<select name="idioma" class="form-control selectpicker">
														<option value="">Seleccione un idioma</option>
														<?php
															$sql='select * from idioma';
															$idiomas=$res->llenarSelect($sql);
															foreach ($idiomas as $idi) {
															echo '<option value="'.$idi['0'].'">'.$idi['1'].'</option>';
														}?>
													</select>
												</div>
											</div>
										</div>
									</p>

									<p>
										<div class="form-group">
											<label class="text col-md-12 control-label">Nivel</label>
											<div class="col-md-12 selectContainer">
												<div class="input-group">
													<span class="input-group-addon"><i class="glyphicon glyphicon-flag"></i></span>
													<select name="nivel" class="form-control selectpicker">
														<option value="">Seleccione el nivel</option>
														<?php
															$sql='select * from nivelidiom';
															$nivel=$res->llenarSelect($sql);
															foreach ($nivel as $niv) {
															echo '<option value="'.$niv['0'].'">'.$niv['1'].'</option>';
														}?>
													</select>
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
	require("../ModulC/PerfilE.php");
	}

?>
