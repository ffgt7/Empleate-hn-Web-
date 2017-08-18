<link id="theme-style" rel="stylesheet" href="../css/styles-6.css">
<script type="text/javascript" src="../js/main.js"></script>
<script src="../js/sweetalert-dev.js"></script>
<link href="../css/sweetalert.css" rel="stylesheet" type="text/css"/>
<script src="../js/sweetalert.min.js"></script>
<style>
	.text{
		color: white;
	}

	.imagen{
		height:200px;
		width:300px;
	}
	.profile{
			height: 120px;
			width: 120px;
		}

	#titulo{
		height:3.6em;
		overflow: hidden;
		text-overflow: pre-line;
		max-height: 3.6em;
	}

	#nombre{
		height:2.4em;
		overflow: hidden;
		text-overflow: pre-line;
		max-height: 3.6em;
	}

</style>
<?php
	require "nav.php";
	$host=$_SERVER["HTTP_HOST"];
	$url=$_SERVER["REQUEST_URI"];
	$dire="http://" . $host . $url;
	if(!isset($_SESSION["cod_usuarioE"]))
	{
		echo '<script>
				window.location.href="../lib/permisosE.php'; echo '?url=';echo $dire;echo '";
			</script>';
		return;
	}
	include "../lib/conexion.php";
	if(!isset($_GET["cod"]))
	{
		require("../lib/permisosG.php");
		return;
	}
	$cod=$_GET["cod"];
	$cod2=$_SESSION['cod_usuarioE'];

	$sql1="select DISTINCT cod_usuario from usuarios_empre join propuesta on cod_usuario=fk_userEmpre join enviocurri on cod_propuesta=fk_propuesta where fk_propuesta=?";
	$array_propuestas= $conexion->prepare($sql1);
	$array_propuestas->execute(array($cod));
	$num=$array_propuestas->fetch(PDO::FETCH_ASSOC);
	$num2=$array_propuestas->rowCount();
	if($num2==0)
	{
		$numcod=0;
		?>
		<div class='container'></div>
			<div class="row text-center header animate-in" data-anim-type="fade-in-up">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class='services-wrapper' style="padding-top:150px">
						<h2><i class="fa fa-warning fa-2x"></i> No hay curriculums</h2>
					</div>
				</div>
			</div>
		</div>
<?php
		return;
	}

	$numCod=implode($num);


	if($numCod!=$cod2)
	{
		echo '<script>
			swal({
			title: "Error!",
			text: "Dede iniciar sesión con el usuario correcto",
			type: "error",
			confirmButtonText: "Aceptar"
			},
			function(){
				window.location.replace("http://empleate-hn.accesocatracho.com/ModulC/perfil_empresa.php");
			});
		 </script>';
		return;
	}

	$sql1="select DISTINCT requisitos,cod_envio,cod_empleo,nombres,img_perfil,concat_ws(',', tituloObtenidoS, tituloObtenidoSecu) as titulo, YEAR(CURDATE())-YEAR(Fech_Naci) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(Fech_Naci,'%m-%d'), 0, -1) AS `EDAD_ACTUAL` from usuarios_empleo left join educacion on cod_empleo=fk_userEdu
	left join curri_expelabo on fk_userExpeLbo=cod_empleo left join curri_idioma on fk_userIdioma=cod_empleo left join enviocurri on fk_userDesem=cod_empleo
	where fk_propuesta=? order by cod_envio desc ";
	$array_propuestas= $conexion->prepare($sql1);
	$array_propuestas->execute(array($cod));
	$num=$array_propuestas->rowCount();

	if($num==0)
	{
?>
		<div class='container'></div>
			<div class="row text-center header animate-in" data-anim-type="fade-in-up">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class='services-wrapper' style="padding-top:150px">
						<h2><i class="fa fa-warning fa-2x"></i> No hay curriculums</h2>
					</div>
				</div>
			</div>
		</div>
<?php
		return;
	}
?>
</br>
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
	  $numArray=count(explode("\n",$elemento['requisitos']));
    ?>
    <div class='col-xs-12 col-sm-4 col-md-3 col-lg-3'>
      <div class='team-wrapper'>
        <div class="team-inner" style="background-image: url('../Imagenes_Users/<?php echo $elemento['img_perfil'] ?>')" >
          <a href="curriBusqueReci.php?cod=<?php echo $elemento['cod_empleo'];?>&codP=<?php echo $cod?>"><?php
				$codDe=$elemento['cod_empleo'];
				$consul="select count(cod_envio) from enviocurri where fk_userDesem=?  and fk_propuesta=? AND VISTO=1";
				$resul= $conexion->prepare($consul);
				$resul->execute(array($codDe,$cod));
				$num=$resul->fetch(PDO::FETCH_ASSOC);
				$n=implode($num);
				if($n==1)
				{
					echo '<span class="badge">Visto</span>';
				}

			?><i class="fa fa-eye" data-toggle="tooltip" data-placement="top" title="Ver Curriculum" >

			</i></a>
        </div>
        <div class='description'>
          <h3 class='text' id='nombre'><?php echo $elemento['nombres']?></h3>
          <h5 id='titulo'> <strong><?php echo $elemento['titulo']?></strong></h5>
		  <?php
			if($numArray>0 and $numArray<=4)
			{
			?>
				<p style='font-size: 20px'><span class='label label-warning'>60% o mas de los requisitos</span></p>
		   <?php
			}
			elseif($numArray>4)
			{
		  ?>	<p style='font-size: 20px'><span class='label label-danger'>Menos del 60% de los requisitos</span></p>
		  <?php
			}
			else
			{
		   ?>
				<p style='font-size: 20px'><span class='label label-success'>Todos los requisitos</span></p>
			<?php
			}
		   ?>
        </div>
      </div>
    </div>

<?php
  endforeach;
  require("../footer.php");
?>
