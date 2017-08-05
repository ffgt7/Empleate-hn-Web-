<?php
require('../lib/Llenado_Select.php');
$res=new Llenado_Select();
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Mensajes</title>
<?php require("../lib/movil.php"); ?>
<meta name="description" content="" />
<meta name="author" content="http://bootstraptaste.com" />
<script src="../js/jquery.js"></script>
<script src="../js/bootstrap.js"></script>
<link href="../css/registro.css" rel="stylesheet" type="text/css"/>
<script src="../js/bootstrapValidator.js" type="text/javascript"></script>
<script src="../js/validacionE.js" type="text/javascript"></script>
<link href="../css/bootstrap.css" rel="stylesheet" type="text/css"/>
<link href="../css/bootstrap.min.css" rel="stylesheet" />
<link href="../css/fancybox/jquery.fancybox.css" rel="stylesheet">
<link href="../css/jcarousel.css" rel="stylesheet" />
<link href="../css/flexslider.css" rel="stylesheet" />
<link href="../css/style.css" rel="stylesheet" />
</head>
<body>
<?php require "navSS.php"; ?>

	<div class="container" style="padding-top:150px">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<h4 style="color:white"><center>Envia mensaje a las empresas <strong>!Te mantenemos en comunicación</strong></center></h4>
                
                <div id="sendmessage">Your message has been sent. Thank you!</div>
                <div id="errormessage"></div>
                <form action="guardarMensaje.php" method="post" role="form" class="contactForm">
                   
     <div class="input-group">
        <span class="input-group-addon"></span>
        <select name="para" id="para" class="form-control selectpicker" >
        <option value=" " >Seleccione una Empresa</option>
        <?php 
			$sql='select * from usuarios_empre';
			$usuarios_empre=$res->llenarSelect($sql);
			foreach ($usuarios_empre as $usu) {
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
</body>
</html>