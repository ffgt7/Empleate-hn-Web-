<?php
require('../lib/Llenado_Select.php');
$res=new Llenado_Select();
?>


<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">

<title>Mensajes</title>
<?php require("../lib/movil.php"); ?>
<meta name="description" content="" />
<meta name="author" content="http://bootstraptaste.com" />
<script src="../js/jquery.js"></script>
<script src="../js/bootstrap.js"></script>
<link href="../css/bootstrap.css" rel="stylesheet" type="text/css"/>
<!-- css -->
<link href="../css/bootstrap.min.css" rel="stylesheet" />
<link href="../css/fancybox/jquery.fancybox.css" rel="stylesheet">
<link href="../css/jcarousel.css" rel="stylesheet" />
<link href="../css/flexslider.css" rel="stylesheet" />
<link href="../css/style.css" rel="stylesheet" />


<!-- Theme skin -->
<link href="skins/default.css" rel="stylesheet" />

</head>
<body>
<?php require("navSS.php"); ?>
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2" style="padding-top:150px">
				<h4 style="color:white"><center>Envia mensaje  <strong>!Te mantenemos en comunicación</strong></center></h4>
                
                <div id="sendmessage"></div>
                <div id="errormessage"></div>
                <form action="guardarMensajeE.php" method="post" role="form" class="contactForm">
                   
     <div class="input-group">
        <span class="input-group-addon"></span>
        <select name="para" id="para" class="form-control selectpicker" >
        <option value=" " >Seleccione una Usuario</option>
        <?php 
			$sql='select * from usuarios_empleo';
			$usuarios_empleo=$res->llenarSelect($sql);
			foreach ($usuarios_empleo as $usu) {
				echo '<option value="'.$usu['0'].'">'.$usu['1'].'</option>';
		}?>
        </select>
     </div><br>      
                    <div class="form-group">
                        <input type="text" class="form-control" name="asunto" id="asunto" placeholder="Asunto:" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                        <div class="validation"></div>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" name="texto" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Escriba su mensaje aquí:"></textarea>
                        <div class="validation"></div>
                    </div>
                    
                    <div class="text-center"><button type="submit" name="registrarse" class="btn btn-info btn-block" >Enviar Mensaje</button></div>
                </form>
			</div>
		</div>
	
	</section>
<!-- javascript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="js/jquery.js"></script>
<script src="js/jquery.easing.1.3.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.fancybox.pack.js"></script>
<script src="js/jquery.fancybox-media.js"></script>
<script src="js/google-code-prettify/prettify.js"></script>
<script src="js/portfolio/jquery.quicksand.js"></script>
<script src="js/portfolio/setting.js"></script>
<script src="js/jquery.flexslider.js"></script>
<script src="https://maps.google.com/maps/api/js?sensor=true"></script>
<script src="js/animate.js"></script>
<script src="js/custom.js"></script>
<script>

</script>
<script src="contactform/contactform.js"></script>

</body>
</html>