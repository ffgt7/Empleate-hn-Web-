<?php

	try{
			$base = new PDO("mysql:host=localhost; dbname=prueba" , "root" , "");
			
			$base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			$sql3="select * from USUARIO where USUARIOS= :login AND CORREO= :correo AND PREGUNTA= :pregunta AND RESPUESTA= :respuesta";
			
			$resultado= $base->prepare($sql3);
			
			$login=htmlentities(addslashes($_POST["login"]));
			$correo=htmlentities(addslashes($_POST["correo"]));
			$pregunta=htmlentities(addslashes($_POST["pregunta"]));
			$respuesta=htmlentities(addslashes($_POST["respuesta"]));
		
			$resultado->bindValue(":login", $login);
			$resultado->bindValue(":correo", $correo);
			$resultado->bindValue(":pregunta", $pregunta);
			$resultado->bindValue(":respuesta", $respuesta);
		
			$resultado->execute();
			
			$numero_registro=$resultado->rowCount();
		
			if($numero_registro!=0){
				
				//ENvIAR CORREO SI SE A InGRESADO LOS DATOS CORRECTAMENTE y redireccionar a la pagina de login,
				$asunto = "Este es su contraseña nueva para la pagina QUIERO CHAMBA";
				$contraNueva = "password";
				$headers="MIME-Version: 1.0\r\n";
				$headers.="Content-type: text/html; charset=utf-8\r\n";
				$headers.="From: PRUEBA Efrel <usuario@exemple.com>\r\n";
				
				$exito=mail($correo,$asunto,$contraNueva,$headers);
				
				if($exito){
		        	echo '<div class="alert alert-succecs role="alert"> Recise su correo electronico </div>';
				}else{
					echo '<div class="alert alert-danger" role="alert"> Error ingrese de nuevo los datos </div>';
				}
				
			}else{
				
				//NO SE INGRESARON LOS DATOS CORRECTAMENTE, SE REDIRECCIONA A IND=GRESARLOS DE NUEVO
				
				header("location:form_registro.php");
			}
			
		
		}catch(Exception $e){
			die("Error: " . $e->getMessage());
		}
	
	?>
