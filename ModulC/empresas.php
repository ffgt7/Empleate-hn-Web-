<!DOCTYPE html>
<html>
<head>
    <title>Empresas</title>
    <?php require("../lib/movil.php"); ?>
    <link rel="stylesheet" href="../css/w3.css">
        
    <style>
        #nombreE{
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>

</head>

<body>
<?php
  require("nav.php");
  require("../lib/conexion.php");
// require "../lib/Llenado_Select.php";
  $res=new Llenado_Select();
  $sql="SELECT cod_usuario,descripcion,email,imagen,nomb_empre,nomb_usuario,num_tel,pass,web_site,respuesta,rubros.rubro,Preg_Segur
  FROM usuarios_empre JOIN rubros on cod_rubro=fk_rubro JOIN preg_segur on cod_preg=Pregunt_Seguri";
  $array_propuestas=$res->llenarSelect($sql);
  $sql2="SELECT DISTINCT rubros.rubro FROM usuarios_empre JOIN rubros on cod_rubro=fk_rubro";
  $rr=$res->llenarSelect($sql2);
  $sql4="SELECT count(rubros.rubro) FROM usuarios_empre JOIN rubros on cod_rubro=fk_rubro";
	$rrrr=$conexion->prepare($sql4);
	$rrrr->execute();
	$nnn=$rrrr->fetch(PDO::FETCH_ASSOC);
	$nnnn=implode($nnn);
?>
<div class="w3-sidenav w3-white w3-animate-left w3-card-3" style="display:none; padding-top:50px;" id="mySidenav">
  <a href="javascript:void(0)" onclick="w3_close()"
  class="w3-btn w3-gray w3-closenav w3-large">Cerrar &times;</a>
  <div class="caegories">
   <ul class="list-group">
    <li class="list-group-item"><a href="#" data-filter="*"><center>TODAS LAS CATEGORIAS <span class="badge w3-blue-gray"><?php echo $nnnn ?></span></center></a></li>
    <?php foreach($rr as $element): 
		$rubro=$element["rubro"];
		$sql3="select count(*) as num from usuarios_empre join rubros on cod_rubro=fk_rubro where rubro='$rubro'";
		$rrr=$conexion->prepare($sql3);
		$rrr->execute();
		$n=$rrr->fetch(PDO::FETCH_ASSOC);
		$nn=implode($n);
		$rubros=substr($element['rubro'], 1, 3);
		$rub=explode(" ", $element['rubro']);
	?>
      <li class="list-group-item"><a title="<?php echo $element['rubro'] ?>" href="#" data-filter=".<?php echo $rubros ?>" ><?php echo $rub[0]/*." ".$rub[1]*/ ?>
		<span class="badge w3-blue"><?php echo $nn ?></span></a></li>
    <?php endforeach; ?>
    </ul>
  </div>
</div>


<section id="work" >
	<div class="container">
		<div class="row text-center header animate-in" data-anim-type="fade-in-up">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
			          <!--  <span class="w3-opennav w3-xlarge" onclick="w3_open()">&#9776;</span>  -->
			        </div>
			        <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
			            <h3><span class="w3-opennav w3-xlarge" onclick="w3_open()">&#9776;</span> EMPRESAS</h3>
			        </div>
			        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
			        </div>
			</div>
		</div>
    <div class="row text-center animate-in" data-anim-type="fade-in-up" id="work-div">
<?php foreach($array_propuestas as $elemento): $rubro=substr($elemento['rubro'], 1, 3);?>
			<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 <?php echo $rubro ?>">
				<div class="work-wrapper">

				<a class="fancybox-media" title="Image Title Goes Here" href="verEmpresa.php?cod=<?php echo $elemento["cod_usuario"] ?>">

				<img style="width:100%; height:200px;" src="../Imagenes_Empre/<?php echo $elemento["imagen"] ?>" class="img-responsive img-rounded" alt="" />
				</a>

				<h4 id="nombreE"><?php echo $elemento["nomb_empre"] ?></h4>
				</div>
			</div>
<?php endforeach; ?>
		</div>
  </div>
</section>





<script>
function w3_open() {
    document.getElementById("mySidenav").style.display = "block";
}
function w3_close() {
    document.getElementById("mySidenav").style.display = "none";
}
</script>
<?php
	require("../footer.php");
?>
</body>
<style>
	@media (min-width: 768px){
		.sidebar-nav .navbar .navbar-collapse{
			padding: 0;
			max-height: none;
		}
		.sidebar-nav .navbar ul{
			float: none;
			display: block;
		}
		.sidebar-nav .navbar li{
			float: none;
			display: block;
		}
		.sidebar-nav .navbar li a{
			padding-top: 12px;
			padding-bottom: 12px;
		}
	}
</style>
<!-- Mirrored from www.w3schools.com/w3css/tryit.asp?filename=tryw3css_sidenav_over by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 06 Jan 2017 17:41:28 GMT -->
</html>
