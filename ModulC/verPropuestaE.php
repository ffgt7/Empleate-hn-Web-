<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Propuesta</title>
<?php require "../lib/movil.php"; ?>
<link href="../css/media.css" rel="stylesheet" />
<link rel="stylesheet" href="../css/w3.css">
<script src="../js/sweetalert-dev.js"></script>
<link href="../css/sweetalert.css" rel="stylesheet" type="text/css"/>
<script src="../js/sweetalert.min.js"></script>
<style>
	.text
	{
		color: white;
	}
	img 
	{
		width: 100%;
		height: 100%;
	}
</style>
</head>
<body>
<?php
	require "nav.php";
 // require "../lib/Llenado_Select.php";
	$res=new Llenado_Select();
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
	if(!isset($_GET["cod"]))
	{
		require("../lib/permisosG.php");
		return;
	}
  $cod=$_GET["cod"];
  $cod2=$_SESSION['cod_usuarioE'];
  include("../lib/conexion.php");
  $sql1="select cod_propuesta from propuesta where cod_propuesta=? and fk_userEmpre=?";
  $array_propuestas= $conexion->prepare($sql1);
  $array_propuestas->execute(array($cod,$cod2));
  $num=$array_propuestas->rowCount();
  if($num==0)
	{
		echo '<script>
				swal({
					title: "Error!",
					text: "Dede iniciar sesión con el usuario correcto",
					type: "error",
					confirmButtonText: "Aceptar"
				},
				function(){
					window.location.href="../lib/permisosE.php'; echo '?url=';echo $dire;echo '"
				});
			 </script>';
		return;
	}
  
  $sql="select cod_propuesta,nombreP,tipoP,generoP,edad,salarioP,vehiculoP,licenciaP,departamentoP,
  caducidadP,tituloP,descripcionP,vacantesP,fk_areaP,cargoP,edad2,salario2,descripcion2,descripcion3,fk_departamento,
  fk_municipio,catego,depart,muni,imagen,experien,idioma,nivel from propuesta join categorias on cod_catego=fk_areaP join departamentos on
  cod_depart=fk_departamento join municipios on cod_muni=fk_municipio join usuarios_empre on cod_usuario=fk_userEmpre join experiencia on cod_experi=fk_experienciaP join 
  idioma on cod_idioma=fk_idioma join nivelidiom on cod_nivel=fk_nivelIdiom where cod_propuesta=$cod";
  $array_propuestas=$res->llenarSelect($sql);
  foreach($array_propuestas as $elemento):
?>
  <div class="container">
  <div class="row animate-in" data-anim-type="fade-in-up">
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <header class="w3-display-container w3-content" style="max-width:100%; padding-top:60px;">
          <img class="img-rounded" src="../Imagenes_Empre/<?php echo $elemento['imagen'] ?>" alt="Me" width="100%" height="200">
          <div class="w3-display-middle w3-padding-xlarge  w3-wide w3-text-light-grey w3-center">
            <i class="fa fa-handshake-o fa-5x"></i>
			<a class="btn btn-danger" href="curriReci.php?cod=<?php echo $elemento['cod_propuesta'] ?>">Curriculums recibidos</a>
          </div>
        </header>
        <section id="work" style="padding-top:10px;">
          <div class="work-wrapper">
            <h2 align="center">Datos Generales</h2>
            <h4 class="text" align="center">Nombre de la Oferta: <?php echo $elemento['nombreP'] ?></h4>
        		<h4 class="text" align="center">Área de Trabajo: <?php echo $elemento['catego'] ?></h4>
        		<h4 class="text" align="center">Cargo Solicitado: <?php echo $elemento['cargoP'] ?></h4>
        		<h4 class="text" align="center">Vacantes: <?php echo $elemento['vacantesP'] ?></h4>
        		<h4 class="text" align="center">Tipo de Contratación: <?php echo $elemento['tipoP'] ?></h4>
        		<h4 class="text" align="center">Ubicación: <?php echo $elemento['departamentoP'] ?></h4>
        		<h4 class="text" align="center">Departamento: <?php echo $elemento['depart'] ?></h4>
        		<h4 class="text" align="center">Municipio: <?php echo $elemento['muni'] ?></h4>
        		<h4 class="text" align="center">Salario entre: L.<?php echo $elemento['salarioP'] ?> y L.<?php echo $elemento['salario2'] ?></h4>
        		<h4 class="text" align="center">Fecha de Caducidad: <?php echo $elemento['caducidadP'] ?></h4>
          </div>
        </section>
      </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <section id="work" style="padding-top:60px;">
          <div class="work-wrapper">
            <h2 class="text" align="center">Requisitos de la oferta de trabajo</h2>
        		<h4 class="text" align="center">Experiencia Laboral: <?php echo $elemento['experien'] ?></h4>
        		<h4 class="text" align="center">Título: <?php echo $elemento['tituloP'] ?></h4>
				<h4 class="text" align="center">Idioma: <?php echo $elemento['idioma'] ?> con un nivel de dominio <?php echo $elemento['nivel'] ?></h4>
        		<h4 class="text" align="center">Genero: <?php echo $elemento['generoP'] ?></h4>
        		<h4 class="text" align="center">Edad Requerida entre: <?php echo $elemento['edad'] ?> y <?php echo $elemento['edad2'] ?> años</h4>
        		<h4 class="text" align="center">Vehículo: <?php echo $elemento['vehiculoP'] ?></h4>
        		<h4 class="text" align="center">Tipo de Licencia: <?php echo $elemento['licenciaP'] ?></h4>
          </div>
          <div class="work-wrapper">
            <h2 class="text" align="center">Descripcion de la oferta de trabajo</h2>
            <h4 class="text" align="center">Especificaciones: <?php echo $elemento['descripcionP'] ?></h4>
					<h4 class="text" align="center">Funciones a desempeñar: <?php echo $elemento['descripcion2'] ?></h4>
					<h4 class="text" align="center">Objetivos del cargo: <?php echo $elemento['descripcion3'] ?></h4>
          </div>
        </section>
    </div>
  </div>
</div>
</div>
<?php endforeach; 
	require("../footer.php");
?>
</body>
</html>
