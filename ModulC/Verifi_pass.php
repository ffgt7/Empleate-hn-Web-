<html>
<?php require("../lib/movil.php"); ?>
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
    session_start();
    $cod = $_SESSION['cod_usuario'];
		$pass =$_REQUEST['pass'];
		$contador= 0;
		$sql="select * from usuarios_empleo where cod_empleo= :cod";
		$resultado= $conexion->prepare($sql);
		$resultado->execute(array(":cod"=>$cod));
		while($numero_registro=$resultado->fetch(PDO::FETCH_ASSOC)){
			if(password_verify($pass,$numero_registro['pass_empleo'])){
				$contador++;
			}
		}
		if($contador>0){
			echo '<div id="Error" style="color:green;">Correcto</div>';
		}else{
				echo '<div id="Success" style="color:red;">(*) La contraseña no coincide</div>';
		}
	}
?>
