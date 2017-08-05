<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title> Recuperar Contraseña </title>

<script src="../js/jquery.js"></script>
<script src="../js/bootstrap.js"></script>
<script src="../js/bootstrapValidator.js" type="text/javascript"></script>
<script src="../js/validarCorreo.js" type="text/javascript"></script>

<script src="../js/messages_es.js" type="text/javascript"></script>

<script src="../js/vegas/jquery.vegas.min.js"></script>
<script src="../js/jquery.easing.min.js"></script>
<script src="../js/source/jquery.fancybox.js"></script>
<script src="../js/jquery.isotope.js"></script>
<script src="../js/appear.min.js"></script>
<script src="../js/animations.min.js"></script>
<script src="../js/custom2.js"></script>
<link href="../css/bootstrap.css" rel="stylesheet" />
<link href="../css/ionicons.css" rel="stylesheet" />
<link href="../css/font-awesome.css" rel="stylesheet" />
<link href="../js/source/jquery.fancybox.css" rel="stylesheet" />
<link href="../css/animations.min.css" rel="stylesheet" />

<link href="../css/styleLogin.css" rel="stylesheet" type="text/css">
<link href="../css/style-blue.css" rel="stylesheet" />

<!-- <script>
  $(document).ready(function(){
    $("#frmRestablecer").submit(function(event){
      event.preventDefault();
      $.ajax({
        url:'validaremail.php',
        type:'post',
        dataType:'json',
        data:$("#frmRestablecer").serializeArray()
      }).done(function(respuesta){
        $("#mensaje").html(respuesta.mensaje);
        $("#email").val('');
      });
    });
  });
</script> -->

<link rel= "stylesheet" type="text/css" href="../js/dist/sweetalert.css">
<script src= "../js/dist/sweetalert.min.js"></script>

</head>

<body>

<?php

	include("na.php");

?>

<div class="modal modal-body"></div>

<div class="jumbotron" style="background-image: url('img/fondo.jpg')">
		<div class="container">
			<div class="row">
				<div class="col-sm-8">

				</div>
		  		<div class="col-sm-4">
					<div class="slider-box-appointment">
						<div class="header">
							<h3 class="heading font-2 text-center">Recuperar Contraseña</h3>
						</div>
						<hr class="hr-2">
						<div class="body">

						  <form id="frmRestablecer" action="validaremail.php" method="post">

								<div class="form-group">
								  <input class="form-control" placeholder="Correo electrónico" type="email" name="email" id="email">
								</div>
								<button class="btn btn-info btn-block" type="submit" value="Enviar_registro">Comprobar Datos</button>
						  </form>

      				<!-- <div id="mensaje"></div> -->

					  </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
