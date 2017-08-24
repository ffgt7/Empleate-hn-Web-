<?php

 require("../lib/conexion.php");

$password1 = htmlentities(addslashes($_POST['password1']));
$password2 = htmlentities(addslashes($_POST['password2']));
$correo = htmlentities(addslashes($_POST['correoE']));

				//$conexion= new PDO('mysql:host=localhost; dbname=empleo','root','');

				$sql = " SELECT * FROM usuarios_empre WHERE email = :correo ";
				$resultado = $conexion->prepare($sql);
				$resultado->execute(array(':correo'=>$correo));
				
				$num = $resultado->rowCount();

				if ($num > 0){

					$usuario = $resultado->fetch(PDO::FETCH_ASSOC);
					//if(password_verify($idusuario, $usuario['cod_usuario'])){
					if($usuario['email'] === $correo){
						if($password1 === $password2){
							$passwordCrip=password_hash($password1,PASSWORD_DEFAULT);
							$cod_empre =$usuario['cod_usuario'];
							$sql = "UPDATE usuarios_empre SET pass='$passwordCrip' WHERE cod_usuario=".$cod_empre;
							$resultado = $conexion->prepare($sql);
							$resultado->execute(array());
							if($resultado){
								$sql = "DELETE FROM recu_empre WHERE cod_usuario = '$cod_empre'" ;
								$resultado=$conexion->prepare($sql);
								$resultado->execute(array());
								
								$num = $num+1; // La contraseña se actualizó con exito."
                                
							}else{
							
                                $num = $num+2; // Ocurrió un error al actualizar la contraseña, intentelo más tarde."
							}
						}else{
                            $num = $num+3; //Las contraseñas no coinciden."
						}
					}else {
                        $num = $num+4; // El codigo de usuario no es válido."
					}
				}else{
                    $num = $num+5;
                    //$num = 5; //El token no es válido."
				}
				echo $num;
