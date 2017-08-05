<?php
ob_start();
?>
<html>
<?php require("../lib/movil.php"); ?>
	<script src="../js/sweetalert-dev.js"></script>
	<link href="../css/sweetalert.css" rel="stylesheet" type="text/css"/>
	<script src="../js/sweetalert.min.js"></script>
</html>
<?php
		include("../lib/config.php");	
		require("../lib/conexion.php");
		
		
		if(!isset($_POST["nombreR"]))
		{
			require("../lib/permisosG.php");
			return;
		}
		
		$nombre=$_POST["nombreR"];
		$apellido=$_POST["apellidoR"];
		$identidad=$_POST["identidadR"];
		$direccion=$_POST["direccionR"];
		$telF=$_POST["telFR"];
		$telM=$_POST["telMR"];
		$correo=$_POST["correoR"];
		$correo2=$_POST["correo2"];
			
			
			
				if(empty($nombre))
	 {
	 
		 echo'<script type="text/javascript">
					swal({
					title: "Error",
  					text: "El nombre es obligatorio",
  					type: "error",
					},
					function(){
					    window.history.go(-1);
						window.location.href="referencia.php";
					});
             	</script>';
		 
	 }

					if(empty($apellido))
	 {
	 
		 echo'<script type="text/javascript">
					swal({
					title: "Error",
  					text: "El apellido es obligatorio",
  					type: "error",
					},
					function(){
					    window.history.go(-1);
						window.location.href="referencia.php";
					});
             	</script>';
		 
	 }	
			if(empty($identidad))
		 {
		 
			 echo'<script type="text/javascript">
					swal({
					title: "Error",
  					text: "El número de identidad  es obligatorio",
  					type: "error",
					},
					function(){
					    window.history.go(-1);
						window.location.href="referencia.php";
					});
             	</script>';
			
		 }	
			 elseif(!is_numeric($identidad))
	 {
		 echo'<script type="text/javascript">
					swal({
					title: "Error",
  					text: "Número de identidad,solo se permiten números!",
  					type: "error",
					},
					function(){
					    window.history.go(-1);
						window.location.href="referencia.php";
					});
             	</script>';
		
	 }
	 
	 if(empty($direccion))
	 {
	 
		 echo'<script type="text/javascript">
					swal({
					title: "Error",
  					text: "La dirección es obligatorio",
  					type: "error",
					},
					function(){
					    window.history.go(-1);
						window.location.href="referencia.php";
					});
             	</script>';
		 
	 }	
			 elseif(!empty($telM) and !is_numeric($telM))
	 {
		 echo'<script type="text/javascript">
					swal({
					title: "Error",
  					text: "Número de telefono,solo se permiten números!",
  					type: "error",
					},
					function(){
					    window.history.go(-1);
						window.location.href="referencia.php";
					});
             	</script>';
		 
	 }	
			elseif(!empty($telF) and !is_numeric($telF))
	 {
		 echo'<script type="text/javascript">
					swal({
					title: "Error",
  					text: " Número de telefono,solo se permiten números!",
  					type: "error",
					},
					function(){
					    window.history.go(-1);
						window.location.href="referencia.php";
					});
             	</script>';
		
	 }	
			else{
				
				session_start();
	
				$cod=$_SESSION["cod_usuario"];
				
			$insert="insert into referencia(nombreR,apellidoR,identidadR,direccionR,telFR,telMR,correoR,correolR2,fk_userRefe)values(?,?,?,?,?,?,?,?,?)";
		
		
			$result=$conexion->prepare($insert);
			$result->execute(array($nombre,$apellido,$identidad,$direccion,$telF,$telM,$correo,$correo2,$cod));
			
								   
			
			
			
			header("Location:referencia.php");	
		}
ob_end_flush();
		?>