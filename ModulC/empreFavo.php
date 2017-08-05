<!DOCTYPE html>
<html>
<title>Favoritos</title>
<?php require("../lib/movil.php"); require("nav.php");?>
<link rel="stylesheet" href="../css/w3.css">


<style>
	.badge
	{
		background-color: #F00000;
	}
	
	#nomb_empre{
    	white-space: nowrap;
    	overflow: hidden;
    	text-overflow: ellipsis;
    }
</style>
<body>
<?php
  
  require("../lib/conexion.php");
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

  $cod=$_SESSION['cod_usuario'];
  $res=new Llenado_Select();
  $sql="SELECT cod_usuario,descripcion,email,imagen,nomb_empre,nomb_usuario,num_tel,pass,web_site,respuesta,rubros.rubro,Preg_Segur
  FROM usuarios_empre JOIN rubros on cod_rubro=fk_rubro JOIN preg_segur on cod_preg=Pregunt_Seguri join favoritos on fk_empre=cod_usuario where fk_usuario=$cod";
  $array_propuestas=$res->llenarSelect($sql);
  $num=count($array_propuestas);
  $sql2="SELECT DISTINCT rubros.rubro FROM usuarios_empre JOIN rubros on cod_rubro=fk_rubro join favoritos on fk_empre=cod_usuario where fk_usuario=$cod";
  $rr=$res->llenarSelect($sql2);
  $sql4="SELECT count(rubros.rubro) FROM usuarios_empre JOIN rubros on cod_rubro=fk_rubro join favoritos on fk_empre=cod_usuario where fk_usuario=$cod";
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
		$sql3="select count(*) as num from usuarios_empre join rubros on cod_rubro=fk_rubro join favoritos on fk_empre=cod_usuario where fk_usuario=$cod and rubro='$rubro'";
		$rrr=$conexion->prepare($sql3);
		$rrr->execute();
		$n=$rrr->fetch(PDO::FETCH_ASSOC);
		$nn=implode($n);
		$rubros=substr($element['rubro'], 1, 3);
		$rub=explode(" ", $element['rubro']);
	?>
      <li class="list-group-item"><a title="<?php echo $element['rubro'] ?>" href="#" data-filter=".<?php echo $rubros ?>" ><?php echo $rub[0]." ".$rub[1] ?>
		<span class="badge w3-blue"><?php echo $nn ?></span></a></i>
    <?php endforeach; ?>
    </ul>
  </div>
</div>

<?php
    if($num==0)
    {
?>  
    <div class="row text-center header animate-in" data-anim-type="fade-in-up">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<div class='services-wrapper' style="padding-top:150px">

								<h2><i class="fa fa-warning fa-2x"></i> Ninguna empresa marcada como favorita</h2>

							</div>
						</div>
					</div>
<?php
    return;
    }
?>
<section id="work" >
	<div class="container">
		<div class="row text-center header animate-in" data-anim-type="fade-in-up">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<h3> <span class="w3-opennav w3-xlarge" onclick="w3_open()">&#9776;</span>EMPRESAS</h3>
     
			</div>
		</div>
    <div class="row text-center animate-in" data-anim-type="fade-in-up" id="work-div">
<?php foreach($array_propuestas as $elemento): $rubro=substr($elemento['rubro'], 1, 3);?>
			<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 <?php echo $rubro ?>">
				<div class="work-wrapper">
					<a class="fancybox-media" title="Ver propuestas publicadas" href="favoUser.php?cod=<?php echo $elemento["cod_usuario"] ?>">
						<img style="width:100%; height:200px;" src="../Imagenes_Empre/<?php echo $elemento["imagen"] ?>" class="img-responsive img-rounded" alt="" />
					</a>
					<h4 id="nomb_empre"><?php echo $elemento["nomb_empre"]; 
					
						$codU=$elemento["cod_usuario"];
						$consul="SELECT distinct count(cod_favo) from favoritos join usuarios_empre on cod_usuario=fk_empre 
						join propuesta on fk_empre=fk_userEmpre where cod_usuario=? and fk_usuario=? and visto=0 and estado=1";
						$resul= $conexion->prepare($consul);
						$resul->execute(array($codU,$cod));
						$num=$resul->fetch(PDO::FETCH_ASSOC);
						$n=implode($num);
						if($n>0)
						{
							echo '<span class="badge">';echo $n;echo'</span>';
						}	
					?></h4>
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