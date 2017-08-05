<html>
<?php require("../lib/movil.php"); ?>
	<script src="../js/sweetalert-dev.js"></script>
	<link href="../css/sweetalert.css" rel="stylesheet" type="text/css"/>
	<script src="../js/sweetalert.min.js"></script>
</html>	
<?php


    require("../lib/conexion.php");
	if(!isset($_POST["asunto"]))
		{
			require("../lib/permisosE.php");
			return;
		}
		session_start();
	
		$cod=$_SESSION["cod_usuarioE"];
	
		$asunto=$_POST["asunto"];
		$para=$_POST["paras"];
		$texto=$_POST["texto"];
		
		if(empty($asunto))
	 {
	 
		 echo'<script type="text/javascript">
				swal({
				title: "Error",
					text: "El campo asunto  es obligatorio",
					type: "error",
				},
				function(){
					window.location.href="mensajes2.php";
				});
						</script>';
	
	 }	
	
	elseif(empty($para))
	 {
		 
		 
		 echo'<script type="text/javascript">
				swal({
				title: "Error",
					text: "El destinatario del mensaje es obligatorio",
					type: "error",
				},
				function(){
					window.location.href="mensajes2.php";
				});
						</script>';
		
	 }	
		
	elseif(empty($texto))
	 {
		 
		 
		 echo'<script type="text/javascript">
				swal({
				title: "Error",
					text: "El  mensaje es obligatorio",
					type: "error",
				},
				function(){
					window.location.href="mensajes2.php";
				});
						</script>';
		
	 }		
		
	else{
	
/*	echo $para, $texto, $asunto; */
	
	$insert="insert into mensajese(asunto,texto,fk_usuario,de)
	values(?,?,?,?)";
	
	
		$result=$conexion->prepare($insert);
		$result->execute(array($asunto,$texto,$para,$cod));
		
	echo '<script>
           swal({
              title: "Información!",
               text: "El mensaje se envio exitosamente!",
               type: "info",
               confirmButtonText: "Aceptar"
           },
           function(){
           window.location.href="mensajes2.php"
           });
        </script>'; 
	}
?>