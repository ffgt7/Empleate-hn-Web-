<html>
	<script src="../js/sweetalert-dev.js"></script>
	<link href="../css/sweetalert.css" rel="stylesheet" type="text/css"/>
	<script src="../js/sweetalert.min.js"></script>
</html>
<?php
	sleep(1);
	include("../lib/conexion.php");
	if(!$_REQUEST)
		{
			require("../lib/permisosG.php");
			return;
		}
	if($_REQUEST) {
	
    	$email = htmlentities(addslashes($_REQUEST['correoE']));
		if($email!=""){
			$query = "select cod_usuario from usuarios_empre where email = '".strtolower($email)."'";
    		$results = $conexion->prepare($query);
			$results->execute(array());
			$num=$results->rowCount();
			if($num > 0)
        		echo '<div id="Error" style="color:red;">(*) Correo electronico ya registrado</div>';
    		else
        		echo '<div id="Success" style="color:green;">Disponible</div>';
	}	
		else{
			echo '<div id="Error" style="color:red;">(*) El correo electronico es obligatorio</div>';
		}
	}

?>	