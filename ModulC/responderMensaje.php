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
		$codi=$_POST["cod"];
		$codP=$_POST["codP"];
		$asunto=$_POST["asunto"];
		$para=$_POST["para"];
		$texto=$_POST["texto"];
		
		
	
	$insert="insert into mensajese(asunto,texto,fk_usuario,de)
	values(?,?,?,?)";
	
	
		$result=$conexion->prepare($insert);
		$result->execute(array($asunto,$texto,$para,$cod));
		
	

?>
        <script>
           swal({
              title: "Información!",
               text: "El mensaje se envio exitosamente!",
               type: "info",
               confirmButtonText: "Aceptar"
           },
           function(){
               window.history.go(-1);
               window.location.href="curriBusqueReci.php?cod=<?php echo $codi ?>&codP=<?php echo $codP ?>"
           });
        </script>
		
