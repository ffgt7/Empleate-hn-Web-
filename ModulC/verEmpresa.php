<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Empresa</title>
<?php require "../lib/movil.php"; ?>
<link rel="stylesheet" href="../css/w3.css">
<!-- HTML5 Shiv and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<style>
	.text{
		color: white;
	}
</style>
</head>

<body>
	
	<?php
	
	require "nav.php";
	//require "../lib/Llenado_Select.php"
	require "../ModulE/visitasEmpre.php";
	$res=new Llenado_Select();
	$host=$_SERVER["HTTP_HOST"];
	$url=$_SERVER["REQUEST_URI"];
	$dir=$host.$url;	
	
	$cod=$_GET["cod"];
	$sql="SELECT cod_usuario,descripcion,email,imagen,nomb_empre,nomb_usuario,num_tel,pass,Pregunt_Seguri,web_site,respuesta,rubro,
	Preg_Segur FROM usuarios_empre JOIN rubros on cod_rubro=fk_rubro JOIN preg_segur on cod_preg=Pregunt_Seguri WHERE cod_usuario=$cod";
	$array=$res->llenarSelect($sql);
?>
	
	<br><br>	

	<?php foreach($array as $elemento): ?>
	
	<!--GRID SECTION START-->
<section id="services" style="padding-top:20px;">
<div class="container">
<div class="row text-center header animate-in" data-anim-type="fade-in-up">
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
<h3 class="text">Datos Generales de la Empresa </h3>
<?php
    $codU=$_SESSION['cod_usuario'];
	include("../lib/conexion.php");
	$sqlU="select cod_favo from favoritos where fk_empre=? and fk_usuario=?";
	$results = $conexion->prepare($sqlU);
	$results->execute(array($cod,$codU));
	$num=$results->rowCount();
	if($num>0)
	{
?>
    
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
				window.location.href="quitarFavo.php?codU="+<?php echo $elemento['cod_usuario']?>;

			}
			else
			{
				swal("Cancelado", "Sigue teniendo esta empresa como favorita", "error");
			}
		});'
>Desmarcar como Favorito</a>
<?php
	}
	else
	{
?>
<i class="fa fa-star-o fa-2x"></i><br>
<a class="w3-btn w3-blue" data-toggle="tooltip" data-placement="bottom" title="Para ser notificado cuando esta empresa publique una nueva propuesta de trabajo" 
href="javascript:void(0)"
onclick=
<?php
	if(!isset($_SESSION["cod_usuario"]))
	{
		$host=$_SERVER["HTTP_HOST"];
		$url=$_SERVER["REQUEST_URI"];
?>
		"window.location.href='../lib/permisosU.php?url=<?php echo "http://" . $host . $url;?>'";
<?PHP
	}
	else
	{
	$codU=$_SESSION['cod_usuario'];
	include("../lib/conexion.php");
	$sqlU="select cod_favo from favoritos where fk_empre=? and fk_usuario=?";
	$results = $conexion->prepare($sqlU);
	$results->execute(array($cod,$codU));
	$num=$results->rowCount();
	if($num>0)
	{
?>
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
				window.location.href="quitarFavo.php?codU="+<?php echo $elemento['cod_usuario']?>;

			}
			else
			{
				swal("Cancelado", "Sigue teniendo esta empresa como favorita", "error");
			}
		});'
<?php
	}
	else
	{
?>		'swal({
		title: "Marcar empresa como favorita",
		text: "¿Desea agregar esta empresa como favorita?",
		type: "info",
		showCancelButton: true,
		confirmButtonText: "Si !",
		cancelButtonText: "No, cancelar!",
		closeOnConfirm: true,
		closeOnCancel: false,
		},
		function(isConfirm)
		{
			if (isConfirm)
			{
				window.location.href="agregarFavo.php?cod="+<?php echo $codU?>+"&codU="+<?php echo $elemento['cod_usuario']?>;

			}
			else
			{
				swal("Cancelado", "No se agrego esta empresa a favoritos", "error");
			}
		});'
<?php
	}
	}
?>>Marcar como Favorito</a>
<?php
	}
?>
</div>
</div>
<section id="work">
<div class="row pad-bottom animate-in" data-anim-type="fade-in-up">
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="work-wrapper">
			<img class="img-responsive" src="../Imagenes_Empre/<?php echo $elemento['imagen'] ?>" style="float: left; height:280px; width:400px"/>
			    <h4 class="text" align="center">Nombre de la Empresa: <?php echo $elemento['nomb_empre'] ?></h4>
				<h4 class="text" align="center">Rubro: <?php echo $elemento['rubro'] ?></h4>
				<h4 class="text" align="center">E-mail: <?php echo $elemento['email'] ?></h4>
				<h4 class="text" align="center">Telefono: <?php echo $elemento['num_tel'] ?></h4>
				<h4 class="text" align="center">Sitio Web: <a href="http://<?php echo $elemento['web_site'] ?>"><?php echo $elemento['web_site'] ?></a></h4>
				<h4 class="text" align="center">Descripción: <?php echo $elemento['descripcion'] ?></h4>
		</div>
</div>
</div>
</section>
</div>
</section>	
<?php endforeach; ?>
</body>
<script src="../js/dist/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="../js/dist/sweetalert.css">
</html>