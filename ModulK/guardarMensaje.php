<html>
<?php require("../lib/movil.php"); ?>
	<script src="../js/sweetalert-dev.js"></script>
	<link href="../css/sweetalert.css" rel="stylesheet" type="text/css"/>
	<script src="../js/sweetalert.min.js"></script>
</html>	
<?php
    include("../lib/config.php");
    require("../lib/conexion.php");
	if(!isset($_POST["asunto"]))
		{
			require("../lib/permisosU.php");
			return;
		}
		session_start();
	
		$cod=$_SESSION["cod_usuario"];
	
		$asunto=$_POST["asunto"];
		$texto=$_POST["texto"];
		$para=$_POST["paras"];
		
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
	
	$insert="insert into mensaje(fk_UsuarioEm,asunto,texto,de)
	values(?,?,?,?)";
	
	
		$result=$conexion->prepare($insert);
		$result->execute(array($para,$asunto,$texto,$cod));
	echo '<script>
           swal({
              title: "Información!",
               text: "El mensaje se envio exitosamente!",
               type: "info",
               confirmButtonText: "Aceptar"
           },
           function(){
            window.history.go(-1);
            window.location.href="../ModulK/mensajesU2.php"
           });
        </script>';
	}
?>