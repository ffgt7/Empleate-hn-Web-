<?php
ob_start();
?>
<html>
	<script src="../js/sweetalert-dev.js"></script>
	<link href="../css/sweetalert.css" rel="stylesheet" type="text/css"/>
	<script src="../js/sweetalert.min.js"></script>
</html>
	<?php
	    session_start();
	    include("../lib/config.php");
		if(isset($_SESSION["cod_usuario"]))
		{
			session_destroy();
		}
		elseif(isset($_SESSION["cod_usuarioE"]))
		{
			session_destroy();
		}
		elseif(isset($_SESSION["codAdmin"]))
		{
			session_destroy();
		}
		try{
			if(!isset($_POST["login"]))
			{
				require("../lib/permisosG.php");
				return;
			}
			$login=htmlentities(addslashes($_POST["login"]));
			$password=htmlentities(addslashes($_POST["password"]));
			$contador= 0;
			
			include("../lib/conexion.php");
			
			$sql="select * from usuarios_empleo where nomb_user= :login";
			
			$resultado= $conexion->prepare($sql);
			
			$resultado->execute(array(":login"=>$login));
			
			while($numero_registro=$resultado->fetch(PDO::FETCH_ASSOC)){
				if(password_verify($password,$numero_registro['pass_empleo'])){
					$contador++;
				}
			}
			
			if($contador>0){
				
				//echo "<h1>Adelante!!</h1>";
				session_start();
				$_SESSION["usuario"]=$_POST["login"];

				if(isset($_POST["recordar"])){

					setcookie('sesion_login', $login, time()+(60*60*24*30));

				}
				
				$user=$_SESSION["usuario"];
				
				$sql1="select cod_empleo from usuarios_empleo where nomb_user='$user'";
				
				$resul= $conexion->prepare($sql1);

				$resul->execute(array());
				
				$num=$resul->fetch(PDO::FETCH_ASSOC);
				
				$_SESSION["cod_usuario"]=implode($num);
				
				if(isset($_POST["urlCod"]) and $_POST["urlCod"]!="")
				{
					
					echo '<script>
						window.location.replace("'; echo $_POST["urlCod"];echo '");
						</script>';
					return;
				}
				
				echo '<script>
						window.location.replace("';echo $rutaPrin."ModulC/perfil_usuario.php";echo'");
						</script>';
				
			}else{
				if(isset($_POST["urlCod"]) and $_POST["urlCod"]!="")
				{
					echo '<script>
							swal({
								 title: "Información!",
								  text: " Credenciales incorrectas, intente nuevamente, Gracias.",
								  type: "info",
								  confirmButtonText: "Aceptar"
							},
							function(){
							    window.location.replace("'; echo $_POST["urlCod"];echo '");
							});
					 </script>';
					return;
				}
				echo '<script>
							swal({
								 title: "Información!",
								  text: " Credenciales incorrectas, intente nuevamente, Gracias.",
								  type: "info",
								  confirmButtonText: "Aceptar"
							},
							function(){
							    window.location.replace("';echo $rutaPrin."ModulC/loginUsuario.php";echo'")
							});
					 </script>';
			
			}
			
		}catch(Exception $e){
			die("Error: " . $e->getMessage());
		}
ob_end_flush();
?>
