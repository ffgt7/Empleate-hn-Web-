<!DOCTYPE html>
<html>
<title>Mensajes Empresa</title>
<meta charset="UTF-8">
<?php require("../lib/movil.php"); ?>
<script src="../js/jquery.js"></script>

<script src="../js/bootstrap.min.js"></script>
<script src="../js/bootstrap-select.min.js"></script>
<script src="../js/vegas/jquery.vegas.min.js"></script>
<script src="../js/jquery.easing.min.js"></script>
<script src="../js/source/jquery.fancybox.js"></script>
<script src="../js/jquery.isotope.js"></script>
<script src="../js/appear.min.js"></script>
<script src="../js/animations.min.js"></script>
<script src="../js/customs.js"></script>
<script src="../js/tool.js"></script>
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
<script type="text/javascript">
$(document).ready(function() {    
    $('#Mensaje').click(function(){
        var username = $(this).val();        
        var dataString = 'username='+username;
		
		//var username = $(this).val();        
        //var dataString = JSON.stringify({username:username});

        $.ajax({
            type: "POST",
            url: "AumentarM.php",
            data: dataString,
			 success: function(data) {
                $('#Info').fadeIn(1000).html(data);
            }
        });
    });              
});    
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
	if(!isset($_SESSION["cod_usuarioE"]))
	{
		$host=$_SERVER["HTTP_HOST"];
		$url=$_SERVER["REQUEST_URI"];
		$dire="http://" . $host . $url;
		echo '<script>
				window.location.href="../lib/permisosE.php'; echo '?url=';echo $dire;echo '"; 
			</script>';
		return;	
	}
	$codUserE= $_SESSION['cod_usuarioE'];
	$conteo="select COUNT(*) as num from mensajese where de=$codUserE";
	$r=$res->llenarSelect($conteo);
	foreach($r as $t){}
	$conteo2="select COUNT(*) as num from mensaje where fk_UsuarioEm=$codUserE";
	$rr=$res->llenarSelect($conteo2);
	foreach($rr as $tt){}
	$consulta="select CodMensajee,asunto,texto,de,fk_Usuario,img_perfil,fecha,nombres,nomb_user from mensajese join usuarios_empleo  on 
	cod_empleo=fk_Usuario where de=$codUserE";
	$resul=$res->llenarSelect($consulta);
	$consulta2="select CodMensaje,asunto,texto,de,fk_UsuarioEm,fecha,cod_empleo,nomb_user,nombres,img_perfil from mensaje join usuarios_empleo on 
	cod_empleo=de where fk_UsuarioEm=$codUserE";
	$resull=$res->llenarSelect($consulta2);
	
?>
<!-- Side Navigation -->
<nav class="w3-sidenav w3-collapse w3-gray w3-animate-left w3-card-2" style="z-index:3;width:320px;" id="mySidenav">
  <a href="../ModulC/perfil_empresa.php" class="w3-gray w3-btn w3-hover-black w3-large" >Perfil <i class="fa fa-home"></i></a>
  <a href="javascript:void(0)" onclick="w3_close()" title="Close Sidemenu" 
  class="w3-red w3-btn w3-hover-black w3-hide-large w3-closenav w3-large">Cerrar <i class="fa fa-remove"></i></a>
  <a href="javascript:void(0)" class="w3-teal w3-btn w3-hover-white w3-left-align" onclick="document.getElementById('id01').style.display='block'">Nuevo Mensaje <i class="w3-padding-left fa fa-pencil"></i></a>
  <div class="w3-accordion">
    <a id="myBtn" onclick="myFunc('Demo1')" class="w3-indigo w3-btn w3-hover-black w3-left-align" href="javascript:void(0)"><i class="fa fa-inbox w3-padding-right"></i>Recibidos (<?php echo $tt["num"]; ?>)<i class="w3-padding-left fa fa-caret-down"></i></a>
    <div id="Demo1" class="w3-accordion-content w3-animate-left">
	
	<?php foreach($resull as $elemen):?>	
      <a href="javascript:void(0)" class="w3-btn test w3-light-blue w3-hover-white" onclick="openMail('<?php echo $elemen["CodMensaje"]?>');w3_close();" value="<?php echo $elemen["CodMensaje"]?>" id="Mensaje">
        <div class="w3-container">
          <img class="w3-round w3-margin-right" src="../Imagenes_Users/<?php echo $elemen["img_perfil"] ?>" style="width:15%;"><span class="w3-opacity w3-large"><?php echo $elemen["nombres"] ?></span>
        </div>
      </a>
	<?php endforeach; ?>  
    </div>
  </div>
  <a id="mySend" onclick="document.getElementById('id02').style.display='block'" class="w3-indigo w3-btn w3-hover-black w3-left-align" href="javascript:void(0)"><i class="fa fa-send w3-padding-right"></i>Enviados (<?php echo $t["num"]; ?>)</a>
</nav>
<!-- Modal para ver los mensajes enviados -->
<div id="id02" class="w3-modal" style="z-index:4">
	<div class="w3-modal-content w3-animate-zoom">
		<div class="w3-container w3-padding w3-blue">
			 <span onclick="document.getElementById('id02').style.display='none'" class="w3-right w3-xxlarge w3-closebtn"><i class="fa fa-remove"></i></span>
			<h2>Mensajes Enviados</h2>
		</div>
		<div class="w3-panel">
		<?php foreach($resul as $el):  ?>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding-top:20px;">
				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
					<img class="w3-round  w3-animate-top" src="../Imagenes_Users/<?php echo $el["img_perfil"] ?>" style="width:100%">
					<h5 style="color:black;">Enviado a: <?php echo $el["nombres"] ?>, <?php echo $el["fecha"] ?></h5>
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
												window.location.href="../ModulC/eliminarMensajeEnviadoE.php?cod="+<?php echo $el["CodMensajee"] ?>;
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
    <div class="w3-container w3-padding w3-blue">
       <span onclick="document.getElementById('id01').style.display='none'" class="w3-right w3-xxlarge w3-closebtn"><i class="fa fa-remove"></i></span>
	<form action="guardarMensajeE.php" method="post" role="form" class="contactForm">
      <h2>Enviar Mensaje</h2>
    </div>
    <div class="w3-panel">
      <div class="col-md-12">
        <div class="col-md-6">
          <p style="color:black;">Para</p>
          <?php $sql="select * from usuarios_empleo";
				$r=$conexion->prepare($sql);
				$r->execute(array());
				$rr=$r->fetchAll();
			?>
			<select name="select" class="form-control selectpicker" onchange="mostrarValor(this.value);" data-live-search="true">
				<option data-tokens  >Nombre del usuario</option>
			<?php	foreach($rr as $d){
			    echo '<option value="'. $d['cod_empleo'].'">'. $d['nomb_user'].'</option>';
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
<?php foreach($resull as $elemen): 
	$codUsuario=$elemen["cod_empleo"];	
	$nombUsuario=$elemen["nomb_user"];	
	/*$sql="select nomb_user from usuarios_empleo join mensaje on fk_UsuarioEm=$codUserE where CodMensaje=$cc";
	$rrr=$res->llenarSelect($sql);
	foreach($rrr as $el){
		$nom=$el["nomb_user"];
	}*/
	?>
<div id="<?php echo $elemen["CodMensaje"] ?>" class="w3-container person">
    <?php
	        $up="update mensaje set visto=1 where CodMensaje=? and fk_UsuarioEm=?";
	        $upR=$conexion->prepare($up);
	        $upR->execute(array($elemen["CodMensaje"],$codUserE));
	    ?>
	<section id="work">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding-right:30px">
				<div class="row animate-in"><br>
					<input  name="nomb" id="nomb" placeholder="" class="form-control" value="<?php echo $elemen["nombres"] ?>" type=hidden>
					<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
					   <img class="w3-round  w3-animate-top" src="../Imagenes_Users/<?php echo $elemen["img_perfil"] ?>" style="width:100%;">
					   <h5 class="w3-opacity">Asunto: <?php echo $elemen["asunto"] ?></h5>
					   <h4><i class="fa fa-clock-o"></i> De <?php echo $elemen["nombres"] ?>, <?php echo $elemen["fecha"] ?>.</h4>
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
													window.location.href="eliminarMensajeE.php?cod="+<?php echo $elemen["CodMensaje"] ?>;
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
					   <p>De, <br><?php echo $elemen["nombres"] ?></p>
					</div>
				</div>
			</div>
		</section>
	</div>
	<div id="id03" class="w3-modal" style="z-index:4">
	  <div class="w3-modal-content w3-animate-zoom">
		<div class="w3-container w3-padding w3-blue">
		   <span onclick="document.getElementById('id03').style.display='none'" class="w3-right w3-xxlarge w3-closebtn"><i class="fa fa-remove"></i></span>
		<form action="guardarMensajeE.php" method="post" role="form" class="contactForm">
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
		  <input name="para" id="para" type=hidden class="w3-input w3-border w3-hover-shadow w3-margin-bottom" style="color:black;" readonly="readonly"
		  value="<?php echo $codUsuario ?>"  >
			
			 <input name="para" id="para" class="w3-input w3-border w3-hover-shadow w3-margin-bottom" style="color:black;" 
		value="<?php echo $nombUsuario ?>" readonly="readonly">
		
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

openMail("<?php echo $elemen["CodMensaje"] ?>")
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
