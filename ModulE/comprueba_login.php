<?php
ob_start();
?>
<html>
	<link rel= "stylesheet" type="text/css" href="../js/dist/sweetalert.css">
	<script src= "../js/dist/sweetalert.min.js"></script>
</html>

	<?php
        session_start();
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

			$sql="SELECT * FROM usuarios_empre WHERE nomb_usuario= :login";

			$resultado= $conexion->prepare($sql);

			$resultado->execute(array(":login"=>$login));

			while($numero_registro=$resultado->fetch(PDO::FETCH_ASSOC)){
				if(password_verify($password,$numero_registro['pass'])){
					$contador++;
				}
			}

			if($contador>0){

				//echo "<h1>Adelante!!</h1>";
				session_start();
				$_SESSION["usuario"]=$_POST["login"];

				//$coduser=$_SESSION['cod_user'];
				if(isset($_POST["recordar"])){

					setcookie('sesion_login', $login, time()+(60*60*24*30));

				}

				$user=$_SESSION["usuario"];

				$sql1="select cod_usuario from usuarios_empre where nomb_usuario='$user'";

				$resul= $conexion->prepare($sql1);

				$resul->execute(array());

				$num=$resul->fetch(PDO::FETCH_ASSOC);

				$_SESSION["cod_usuarioE"]=implode($num);
				
				
				if(isset($_POST["urlCod"]) and $_POST["urlCod"]!="")
				{
					
					echo '<script>
						window.location.href="'; echo $_POST["urlCod"];echo '";
           
						</script>';
					return;
				}

				header("location:../ModulC/perfil_empresa.php");

			}else{
				if(isset($_POST["urlCod"]) and $_POST["urlCod"]!="")
				{
					echo '<script>
							swal({
								 title: "Información!",
								  text: " Credenciales incorrectas, intente nuevamente, Gracias.",
								  type: "error",
								  confirmButtonText: "Aceptar"
							},
							function(){
							    window.location.href="'; echo $_POST["urlCod"];echo '";
							});
					 </script>';
					
					return;
				}
				
				echo '<script>
							swal({
								 title: "Información!",
								  text: " Credenciales incorrectas, intente nuevamente, Gracias.",
								  type: "error",
								  confirmButtonText: "Aceptar"
							},
							function(){
							    window.history.go(-1);
							    window.location.href="formulario.php"
							});
					 </script>';

			}

		}catch(Exception $e){
			die("Error: " . $e->getMessage());
		}
ob_end_flush();
?>
