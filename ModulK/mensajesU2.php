<!DOCTYPE html>
<html>
<title>Mensajes Usuario</title>
<meta charset="UTF-8">
<?php require("../lib/movil.php"); ?>
<script src="../js/jquery.js"></script>
<script src="../js/bootstrap.js"></script>
<script src="../js/bootstrap-select.min.js"></script>
<script src="../js/vegas/jquery.vegas.min.js"></script>
<script src="../js/jquery.easing.min.js"></script>
<script src="../js/source/jquery.fancybox.js"></script>
<script src="../js/jquery.isotope.js"></script>
<script src="../js/appear.min.js"></script>
<script src="../js/animations.min.js"></script>
<script src="../js/customs.js"></script>
<script src="../js/tool.js"></script>
<script src="../js/bootstrapValidator.js" type="text/javascript"></script>
<script src="../js/validacionMU.js" type="text/javascript"></script>
<link href="../css/bootstrap.css" rel="stylesheet" />
<link href="../css/ionicons.css" rel="stylesheet" />
<link href="../js/source/jquery.fancybox.css" rel="stylesheet" />
<link href="../css/animations.min.css" rel="stylesheet" />
<link href="../css/style-blue.css" rel="stylesheet" />
<link href="../css/tool.css" rel="stylesheet"/>
<script src="../js/dist/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="../js/dist/sweetalert.css">
<link rel="stylesheet" href="../css/w3.css">
<link rel="stylesheet" href="../css/font-awesome.min.css">
<link rel="stylesheet" href="../css/bootstrap-select.min.css">
<script>
    var mostrarValor = function(x){
            document.getElementById('paras').value=x;
            }
</script>
<style>
html,body,h1,h2,h3,h4,h5 {font-family: "RobotoDraft", "Roboto", sans-serif;}
.w3-sidenav a {padding:16px;}

textarea{
	resize: none;
}
</style>
<body>
<?php 
	
	require("../lib/conexion.php");
	require('../lib/Llenado.php');
	$res=new Llenado_Select();
	session_start();
	if(!isset($_SESSION["cod_usuario"]))
	{
		$host=$_SERVER["HTTP_HOST"];
		$url=$_SERVER["REQUEST_URI"];
		$dire="http://" . $host . $url;
		echo '<script>
				window.location.href="../lib/permisosu.php'; echo '?url=';echo $dire;echo '"; 
			</script>';
		return;	
	}
	$codUserE= $_SESSION['cod_usuario'];
	$conteo="select COUNT(*) as num from mensajese where fk_Usuario=$codUserE";
	$r=$res->llenarSelect($conteo);
	foreach($r as $t){}
	$conteo2="select COUNT(*) as num from mensaje where de=$codUserE";
	$rr=$res->llenarSelect($conteo2);
	foreach($rr as $tt){}
	$consulta="select CodMensajee,asunto,texto,de,fk_Usuario,imagen,fecha,nomb_empre,nomb_usuario,cod_usuario from usuarios_empre join  mensajese on 
	cod_usuario=de join usuarios_empleo on cod_empleo=fk_Usuario where fk_Usuario=$codUserE";
	$resul=$res->llenarSelect($consulta);
	$consulta2="select CodMensaje,asunto,texto,de,fk_UsuarioEm,fecha,nomb_empre,imagen from mensaje join usuarios_empre on cod_usuario=fk_UsuarioEm where de=$codUserE";
	$resull=$res->llenarSelect($consulta2);
?>
<!-- Side Navigation -->
<nav class="w3-sidenav w3-collapse w3-gray w3-animate-left w3-card-2" style="z-index:3;width:320px;" id="mySidenav">
  <a href="../ModulC/perfil_usuario.php" class="w3-gray w3-btn w3-hover-black w3-large" >Perfil <i class="fa fa-home"></i></a>
  <a href="javascript:void(0)" onclick="w3_close()" title="Close Sidemenu" 
  class="w3-red w3-btn w3-hover-black w3-hide-large w3-closenav w3-large">Cerrar <i class="fa fa-remove"></i></a>
  <a href="javascript:void(0)" class="w3-teal w3-btn w3-hover-white w3-left-align" onclick="document.getElementById('id01').style.display='block'">Nuevo Mensaje <i class="w3-padding-left fa fa-pencil"></i></a>
  <div class="w3-accordion">
    <a id="myBtn" onclick="myFunc('Demo1')" class="w3-indigo w3-btn w3-hover-white w3-left-align" href="javascript:void(0)"><i class="fa fa-inbox w3-padding-right"></i>Recibidos (<?php echo $t["num"]; ?>)<i class="w3-padding-left fa fa-caret-down"></i></a>
    <div id="Demo1" class="w3-accordion-content w3-animate-left">
	<?php foreach($resul as $elemen): ?>	
      <a href="javascript:void(0)" class="w3-btn test w3-light-blue w3-hover-white" onclick="openMail('<?php echo $elemen["CodMensajee"] ?>');w3_close();" id="firstTab">
        <div class="w3-container">
          <img class="w3-round w3-margin-right" src="../Imagenes_Empre/<?php echo $elemen["imagen"] ?>" style="width:15%;"><span class="w3-opacity w3-large"><?php echo $elemen["nomb_empre"] ?></span>
        </div>
      </a>
	<?php endforeach; ?>  
    </div>
  </div>
	<a id="mySend" onclick="document.getElementById('id02').style.display='block'" class="w3-indigo
	w3-btn w3-hover-white w3-left-align" href="javascript:void(0)"><i class="fa fa-send w3-padding-right"></i>Enviados (<?php echo $tt["num"]; ?>)</a>
</nav>
<!-- Modal para ver los mensajes enviados -->
<div id="id02" class="w3-modal" style="z-index:4">
	<div class="w3-modal-content w3-animate-zoom">
		<div class="w3-container w3-padding w3-blue">
			 <span onclick="document.getElementById('id02').style.display='none'" class="w3-right w3-xxlarge w3-closebtn"><i class="fa fa-remove"></i></span>
			<h2>Mensajes Enviados</h2>
		</div>
		<div class="w3-panel">
		<?php foreach($resull as $el):  ?>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding-top:20px;">
				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
					<img class="w3-round  w3-animate-top" src="../Imagenes_Empre/<?php echo $el["imagen"] ?>" style="width:100%">
					<h5 style="color:black;">Enviado a: <?php echo $el["nomb_empre"] ?>, <?php echo $el["fecha"] ?></h5>
					<h5 style="color:black;">Asunto: <?php echo $el["asunto"] ?></h5>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
					<h5 style="color:black;"><?php echo $el["texto"] ?></h5>
				</div>
				<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
					<a class="w3-btn w3-red" onclick='swal({
											  title: "Desea eliminar el mensaje?",
											  text: "No podra recuperar el mensaje!",
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
												swal("Borrado!", "Su mensaje ha sido eliminado.", "success");
												window.location.href="../ModulC/eliminarMensajeEnviado.php?cod="+<?php echo $el["CodMensaje"] ?>;
											  }
												else
												{
													swal("Cancelado", "Su mensaje esta seguro :)", "error");
											  }
											});'>Eliminar</a>
				</div>
			</div>
		<?php endforeach ?>
		</div>
	</div>
</div>

<!-- Modal that pops up when you click on "New Message" -->
<div id="id01" class="w3-modal" style="z-index:4">
  <div class="w3-modal-content w3-animate-zoom">
    <div class="w3-container w3-padding w3-cyan">
       <span onclick="document.getElementById('id01').style.display='none'" class="w3-right w3-xxlarge w3-closebtn"><i class="fa fa-remove"></i></span>
	<form action="guardarMensaje.php" method="post" role="form" class="contactForm">
      <h2>Enviar Mensaje</h2>
    </div>
    <div class="w3-panel">
    <div class="col-md-12">
        <div class="col-md-6">
          <p style="color:black;">Para</p>
    	  <select name="select" class="form-control selectpicker" onchange="mostrarValor(this.value);" data-live-search="true">
      <option value=" " >Nombre de la Empresa</option>
       <?php 
		$sql='select * from usuarios_empre';
		$rows=$res->llenarSelect($sql);
		foreach ($rows as $row) {
		echo '<option value="'.$row['cod_usuario'].'">'.$row['nomb_empre'].'</option>';
	}?>
    </select>
    <input  name="paras" id="paras" placeholder="" class="form-control" value="" type=hidden>
          <p style="color:black;">Asunto</p>
          <input class="w3-input w3-border w3-hover-shadow  w3-margin-bottom" name="asunto" type="text" placeholder="Asunto del mensaje" style="color:black;">
        </div>
        <div class="col-md-6">
            <textarea class="w3-input w3-border w3-hover-shadow  w3-margin-bottom" name="texto"  style="height:170px; color:black;" placeholder="Escriba su mensaje aquí"></textarea>
        </div>
    </div>
      <div class="w3-section">
		<a class="w3-btn w3-gray" onclick="document.getElementById('id01').style.display='none'">Cancelar  <i class="fa fa-remove"></i></a>
		<button type="submit" class="w3-btn w3-right w3-blue">Enviar  <i class="fa fa-paper-plane"></i></button> 
		</form>
      </div>    
    </div>
  </div>
</div>

<!-- Overlay effect when opening the side navigation on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="Close Sidemenu" id="myOverlay"></div>

<!-- Page content -->
<div class="w3-main " style="margin-left:320px;">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<i class="fa fa-bars w3-opennav w3-hide-large w3-xlarge w3-margin-left w3-margin-top" onclick="w3_open()"></i>
		<a href="javascript:void(0)" class="w3-hide-large w3-green w3-btn w3-right w3-margin-top w3-margin-right" onclick="document.getElementById('id01').style.display='block'"><i class="fa fa-pencil"></i></a>
	</div>
	<?php 
		foreach($resul as $elemen): 
		$codUsuario=$elemen["cod_usuario"];	
		$nombUsuario=$elemen["nomb_usuario"];	
	/*	$sql="select nomb_usuario from usuarios_empre join mensaje on fk_UsuarioEm=cod_usuario where CodMensaje=$cc";
		$rrr=$conexion->prepare($sql);
		$rrr->execute(array());
		$nom=$rrr->fetch(PDO::FETCH_ASSOC);
		$nomb=$nom["nomb_usuario"];*/
		
	?>
	<div id="<?php echo $elemen["CodMensajee"] ?>" class="w3-container person">
	    <?php
	        $up="update mensajese set visto=1 where CodMensajee=? and fk_usuario=?";
	        $upR=$conexion->prepare($up);
	        $upR->execute(array($elemen["CodMensajee"],$codUserE));
	    ?>
		<section id="work">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding-right:30px">
				<div class="row animate-in"><br>
					<input  name="nomb" id="nomb" placeholder="" class="form-control" value="<?php echo $elemen["nomb_empre"] ?>" type=hidden>
					<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
						<img class="w3-round  w3-animate-top" src="../Imagenes_Empre/<?php echo $elemen["imagen"] ?>" style="width:100%">
						<h5 class="w3-opacity">Asunto: <?php echo $elemen["asunto"] ?></h5>
						<h4 style="color:white"><i class="fa fa-clock-o"></i> De <?php echo $elemen["nomb_empre"] ?>, <?php echo $elemen["fecha"] ?>.</h4>
					
					
						<a  href="#" onclick='swal({
											  title: "Desea eliminar el mensaje?",
											  text: "No podra recuperar el mensaje!",
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
												swal("Borrado!", "Su mensaje ha sido eliminado.", "success");
												window.location.href="eliminarMensaje.php?cod="+<?php echo $elemen["CodMensajee"] ?>;
											  }
												else
												{
													swal("Cancelado", "Su mensaje esta seguro :)", "error");
											  }
											});' class="w3-btn w3-light-grey">Eliminar<i class="w3-padding-left fa fa-close"></i></a> <a href="javascript:void(0)" class="w3-btn w3-light-grey" onclick="document.getElementById('id03').style.display='block'">Responder<i class="w3-padding-left fa fa-arrow-right"></i></a>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-8 col-lg-8">
						<hr>
						<p><?php echo $elemen["texto"] ?></p>
						<p>De, <br><?php echo $elemen["nomb_empre"] ?></p>
				  </div>
				</div>
			</div>
		</section>
	</div>


	<div id="id03" class="w3-modal" style="z-index:4">
	  <div class="w3-modal-content w3-animate-zoom">
		<div class="w3-container w3-padding w3-blue">
		   <span onclick="document.getElementById('id03').style.display='none'" class="w3-right w3-xxlarge w3-closebtn"><i class="fa fa-remove"></i></span>
		<form action="guardarMensaje.php" method="post" role="form" class="contactForm">
		  <h2>Enviar Mensaje</h2>
		</div>
		<div class="w3-panel">
		  <label>Para</label>
		  <?php/*
			$sql="select cod_usuario,nomb_usuario from usuarios_empre where nomb_usuario='$nomb'";
			$usuarios_empre=$res->llenarSelect($sql);
			foreach ($usuarios_empre as $usu) {
				$co=$usu['cod_usuario'];
				$usua=$usu['nomb_usuario'];
			}	*/	
		  ?>
		  
		
		  
		  
		  <input name="para" id="para" class="w3-input w3-border w3-hover-shadow w3-margin-bottom" style="color:black;" readonly="readonly"
			value=" <?php echo $codUsuario ?>" type=hidden
			>
			<input name="" id="para" class="w3-input w3-border w3-hover-shadow w3-margin-bottom" style="color:black;" readonly="readonly"
			value="<?php echo $nombUsuario ?>" >
			
			
		  <label>Asunto</label>
		  <input class="w3-input w3-border w3-hover-shadow  w3-margin-bottom" name="asunto" type="text" placeholder="Asunto del mensaje" style="color:black;" >
		  <textarea class="w3-input w3-border w3-hover-shadow  w3-margin-bottom" name="texto" style="height:150px; color:black;" placeholder="Escriba su mensaje aquí"></textarea>
		  <div class="w3-section">
			
			<a class="w3-btn w3-gray" onclick="document.getElementById('id03').style.display='none'">Cancelar  <i class="fa fa-remove"></i></a>
			<button type="submit" class="w3-btn w3-right w3-blue">Enviar  <i class="fa fa-paper-plane"></i></button> 
			</form>
		  </div>    
		</div>
	  </div>
	</div>
	<?php endforeach; ?> 
</div>

<script>
var openInbox = document.getElementById("myBtn");
openInbox.click();

function w3_open() {
    document.getElementById("mySidenav").style.display = "block";
    document.getElementById("myOverlay").style.display = "block";
}
function w3_close() {
    document.getElementById("mySidenav").style.display = "none";
    document.getElementById("myOverlay").style.display = "none";
}

function myFunc(id) {
    var x = document.getElementById(id);
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show"; 
        x.previousElementSibling.className += " w3-blue";
    } else { 
        x.className = x.className.replace(" w3-show", "");
        x.previousElementSibling.className = 
        x.previousElementSibling.className.replace(" w3-blue", "");
    }
}

openMail("<?php echo $elemen["CodMensajee"] ?>")
function openMail(personName) {
  var i;
  var x = document.getElementsByClassName("person");
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";
  }
  x = document.getElementsByClassName("test");
  for (i = 0; i < x.length; i++) {
     x[i].className = x[i].className.replace(" w3-light-grey", "");
  }
  document.getElementById(personName).style.display = "block";
  event.currentTarget.className += " w3-light-grey";
}
</script>

<script>
var openTab = document.getElementById("firstTab");
openTab.click();
</script>


</body>

<!-- Mirrored from www.w3schools.com/w3css/tryit.asp?filename=tryw3css_templates_mail&stacked=h by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 06 Jan 2017 15:49:53 GMT -->
</html> 
