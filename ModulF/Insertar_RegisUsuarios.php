<?php
    ob_start();  
?>
<html>
	<script src="../js/sweetalert-dev.js"></script>
	<link href="../css/sweetalert.css" rel="stylesheet" type="text/css"/>
	<script src="../js/sweetalert.min.js"></script>
</html>
<?php
	include('../lib/config.php');
	if(!isset($_POST['Nomb_Usuario']))
		{
			require("../lib/permisosG.php");
			return;
		}
	
	if(isset($_FILES['imagen_Usuario'] ['name']))
	{
		$nombreImg=$_FILES['imagen_Usuario'] ['name'];
	}

	if(isset($_FILES['imagen_Usuario'] ['type']))
	{
		$tipoImg=$_FILES['imagen_Usuario'] ['type'];
	}
	if(isset($_FILES['imagen_Usuario'] ['size']))
	{
		$tamImg=$_FILES['imagen_Usuario'] ['size'];
	}
	
	
	
	if(isset($tamImg) and $tamImg!=""){
		if($tamImg<=4000000 and $tamImg>=1){
			if($tipoImg=="image/jpg" || $tipoImg=="image/jpeg" || $tipoImg=="image/png" || $tipoImg=="image/gif"){
				$ruta=$_SERVER['DOCUMENT_ROOT'].'/Empleate-hn-Web-/Imagenes_Users/';
				$nombre=uniqid().$nombreImg;
				move_uploaded_file($_FILES['imagen_Usuario']['tmp_name'],$ruta.$nombre);
			}
			else{
				echo'<script type="text/javascript">
						swal({
						title: "Error",
  						text: "Solo se admiten imagenes en los formatos jpg/jpeg/png/gif!",
  						type: "error",
						},
						function(){
						    window.history.go(-1);
							window.location.href="registro_usuarios.php";
						});
             		</script>';
				}
			}
			else{
				echo'<script type="text/javascript">
						swal({
						title: "Error",
  						text: "Tamaño de la imagen demasiado grande!",
  						type: "error",
						},
						function(){
						    window.history.go(-1);
							window.location.href="registro_usuarios.php";
						});
             		 </script>';
			}
		}

	$nomb_user=htmlentities(addslashes($_POST['Nomb_Usuario']));
	$pass_empleo=$_POST['Contrase'];
	$contraEncrip=password_hash($pass_empleo, PASSWORD_DEFAULT);
	$confirPass=$_POST['Confircontrase'];
	$nombres=$_POST['NombUser'];
	$apellidos=$_POST['Apellidos_Usuario'];
	$fk_nacionalida=$_POST['Nacionalidad_Usuario'];
	$sexo=$_POST['Sexo_Usuario'];
	$fk_departamento=$_POST['Depart_Usuario'];
	$fk_municipio=$_REQUEST['Muni_Usuario'];
	$direccion=$_POST['Direcc_Usuario'];
	$tel_fijo=$_POST['TelFijo_Usuario'];
	$tel_movil=$_POST['TelMovil_Usuario'];
	$Pos_vehi=$_POST['Vehi_Usuario'];
	$Pos_moto=$_POST['Moto_Usuario'];
	$tipLicen=$_POST['TipLicen_Usuario'];
	$fech_Naci=$_POST['Naci_Usuario'];
	$descrip_userEmpleo=$_POST['Descrip_Usuario'];
	$email_user=$_POST['Correo_Usuario'];
	$identidad=$_POST["identidadC"];
	
	//imagen android
	if(isset($_POST['foto']))
    {
        $imagen=$_POST['foto'];
        $nombre=uniqid()."."."png";
        $ruta=$_SERVER['DOCUMENT_ROOT'].'/Empleate-hn-Web-/Imagenes_Users/';
	    $path = "$ruta$nombre";
	   file_put_contents($path,base64_decode($imagen));
    }

	


	if(empty($nomb_user))
 {
 
	 echo'<script type="text/javascript">
	 		swal({
			title: "Error",
  			text: "El nombre de usuario es obligatorio!",
  			type: "error",
			},
			function(){
			    window.history.go(-1);
				window.location.href="registro_usuarios.php";
			});
          </script>';
 }
elseif(strlen($nomb_user)>15)
 {
	  echo'<script type="text/javascript">
	  			swal({
				title: "Error",
  				text: "El nombre de usuario debe tener maximo 15 caracteres!",
  				type: "error",
				},
				function(){
				    window.history.go(-1);
					window.location.href="registro_usuarios.php";
				});
             </script>';
 }
elseif(empty($pass_empleo))
 {
	 echo'<script type="text/javascript">
	 		swal({
				title: "Error",
  				text: "La contraseña es obligatoria!",
  				type: "error",
				},
				function(){
				    window.history.go(-1);
					window.location.href="registro_usuarios.php";
				});
             </script>';
	 
 }
 elseif(strlen($pass_empleo) < 8 )
 {
	 echo'<script type="text/javascript">
	 		swal({
				title: "Error",
  				text: "La contraseña debe tener al menos 8 caracteres!",
  				type: "error",
				},
				function(){
				    window.history.go(-1);
					window.location.href="registro_usuarios.php";
				});
             </script>';
 }

elseif(empty($confirPass))
 {
	 echo'<script type="text/javascript">
	 		swal({
				title: "Error",
  				text: "Confirme su contraseña!",
  				type: "error",
				},
				function(){
				    window.history.go(-1);
					window.location.href="registro_usuarios.php";
				});
            </script>';
 }
 elseif(strlen($confirPass) < 8 )
 {
	  echo'<script type="text/javascript">
	  		swal({
				title: "Error",
  				text: "La contraseña debe tener al menos 8 caracteres!",
  				type: "error",
				},
				function(){
				    window.history.go(-1);
					window.location.href="registro_usuarios.php";
				});
            </script>';
 }
elseif($pass_empleo!=$confirPass)
 {
	 echo'<script type="text/javascript">
	 		swal({
				title: "Error",
  				text: "La contraseña y su confirmación no son las mismas!",
  				type: "error",
				},
				function(){
				    window.history.go(-1);
					window.location.href="registro_usuarios.php";
				});
             </script>';
 }
elseif(empty($nombres))
 {
	 echo'<script type="text/javascript">
	 		swal({
				title: "Error",
  				text: "Ingrese sus nombres!",
  				type: "error",
				},
				function(){
				    window.history.go(-1);
					window.location.href="registro_usuarios.php";
				});
             </script>';
 }
 elseif(strlen($nombres)<3)
 {
	 echo'<script type="text/javascript">
	 		swal({
				title: "Error",
  				text: "Sus nombres deben tener al menos 3 caracteres!",
  				type: "error",
				},
				function(){
				    window.history.go(-1);
					window.location.href="registro_usuarios.php";
				});
             </script>';
 }
 elseif(strlen($nombres)>100)
 {
	 echo'<script type="text/javascript">
	 			swal({
				title: "Error",
  				text: "Sus nombres deben tener Maximo 100 caracteres!",
  				type: "error",
				},
				function(){
				    window.history.go(-1);
					window.location.href="registro_usuarios.php";
				});
             </script>';
 }
 elseif(empty($apellidos))
 {
	 echo'<script type="text/javascript">
	 			swal({
				title: "Error",
  				text: "Ingrese sus apellidos!",
  				type: "error",
				},
				function(){
				    window.history.go(-1);
					window.location.href="registro_usuarios.php";
				});
             </script>';
 }
 elseif(strlen($apellidos)<3)
 {
	 echo'<script type="text/javascript">
	 			swal({
				title: "Error",
  				text: "Ingrese minimo 3 caracteres para sus apellidos!",
  				type: "error",
				},
				function(){
				    window.history.go(-1);
					window.location.href="registro_usuarios.php";
				});
             </script>';
 }
 elseif(strlen($apellidos)>85)
 {
	 echo'<script type="text/javascript">
	 		swal({
				title: "Error",
  				text: "Maximo 85 caracteres para sus apellidos!",
  				type: "error",
				},
				function(){
				    window.history.go(-1);
					window.location.href="registro_usuarios.php";
				});
             </script>';
 }
 elseif(strlen($identidad)!=13)
 {
	 echo'<script type="text/javascript">
	 			swal({
				title: "Error",
  				text: "Su numero de identidad debe tener 13 caracteres!",
  				type: "error",
				},
				function(){
				    window.history.go(-1);
					window.location.href="registro_usuarios.php";
				});
             </script>';
 }
elseif(empty($fk_nacionalida))
 {
	 echo'<script type="text/javascript">
	 		 swal({
				title: "Error",
  				text: "Debe seleccionar su nacionalidad!",
  				type: "error",
				},
				function(){
				    window.history.go(-1);
					window.location.href="registro_usuarios.php";
				});
             </script>';
 }
 elseif(empty($sexo))
 {
	 echo'<script type="text/javascript">
	 		 swal({
				title: "Error",
  				text: "Debe seleccionar su sexo!",
  				type: "error",
				},
				function(){
				    window.history.go(-1);
					window.location.href="registro_usuarios.php";
				});
             </script>';
 }
 elseif(empty($fk_departamento))
 {
	 echo'<script type="text/javascript">
	 		 swal({
				title: "Error",
  				text: "Debe seleccionar un departamento!",
  				type: "error",
				},
				function(){
				    window.history.go(-1);
					window.location.href="registro_usuarios.php";
				});
             </script>';
 }
 elseif(empty($fk_municipio))
 {
	 echo'<script type="text/javascript">
	 		 swal({
				title: "Error",
  				text: "Debe seleccionar un municipio!",
  				type: "error",
				},
				function(){
				    window.history.go(-1);
					window.location.href="registro_usuarios.php";
				});
             </script>';
 }
 elseif(empty($direccion))
 {
	 echo'<script type="text/javascript">
	 		 swal({
				title: "Error",
  				text: "Su dirección es obligatoria!",
  				type: "error",
				},
				function(){
				    window.history.go(-1);
					window.location.href="registro_usuarios.php";
				});
             </script>';
 }
 elseif(strlen($direccion)<10)
 {
	 echo'<script type="text/javascript">
	 		 swal({
				title: "Error",
  				text: "La direccion debe tener al menos 10 caracteres!",
  				type: "error",
				},
				function(){
				    window.history.go(-1);
					window.location.href="registro_usuarios.php";
				});
             </script>';
 }
 elseif(strlen($direccion)>255)
 {
	 echo'<script type="text/javascript">
	 		 swal({
				title: "Error",
  				text: "La direccion debe tener un máximo de 255 caracteres!",
  				type: "error",
				},
				function(){
				    window.history.go(-1);
					window.location.href="registro_usuarios.php";
				});
             </script>';
 }
 
 elseif(!is_numeric($tel_movil))
 {
	 echo'<script type="text/javascript">
	 		 swal({
				title: "Error",
  				text: "El número de telefono solo permite números!",
  				type: "error",
				},
				function(){
				    window.history.go(-1);
					window.location.href="registro_usuarios.php";
				});
             </script>';
 }
 elseif(strlen($tel_movil)<8)
 {
	 echo'<script type="text/javascript">
	 		 swal({
				title: "Error",
  				text: "El número de telefono debe tener al menos 8 caracteres!",
  				type: "error",
				},
				function(){
				    window.history.go(-1);
					window.location.href="registro_usuarios.php";
				});
             </script>';
 }
elseif(strlen($tel_movil)>15)
 {
	  echo'<script type="text/javascript">
	  		 swal({
				title: "Error",
  				text: "El número de telefono debe tener maximo 15 caracteres!",
  				type: "error",
				},
				function(){
				    window.history.go(-1);
					window.location.href="registro_usuarios.php";
				});
             </script>';
 }
 elseif(empty($tel_movil))
 {
	 echo'<script type="text/javascript">
	 		 swal({
				title: "Error",
  				text: "Su teléfono móvil es obligatorio!",
  				type: "error",
				},
				function(){
				    window.history.go(-1);
					window.location.href="registro_usuarios.php";
				});
             </script>';
 }
 
 elseif(!empty($tel_fijo)){
	  if(!is_numeric($tel_fijo))
 {
	 echo'<script type="text/javascript">
	 		 swal({
				title: "Error",
  				text: "Solo se permiten números!",
  				type: "error",
				},
				function(){
				    window.history.go(-1);
					window.location.href="registro_usuarios.php";
				});
             </script>';
 }
 elseif(strlen($tel_fijo)<8)
 {
	 echo'<script type="text/javascript">
	 		 swal({
				title: "Error",
  				text: "El número de telefono debe tener al menos 8 caracteres!",
  				type: "error",
				},
				function(){
				    window.history.go(-1);
					window.location.href="registro_usuarios.php";
				});
             </script>';
 }
elseif(strlen($tel_fijo)>15)
 {
	  echo'<script type="text/javascript">
	  	  	swal({
				title: "Error",
  				text: "El número de telefono debe tener maximo 15 caracteres!",
  				type: "error",
				},
				function(){
				    window.history.go(-1);
					window.location.href="registro_usuarios.php";
			});
          </script>';
	}	
	 $exit=1;
 }
 if(isset($exit) or !isset($exit))
 {
	if(!preg_match("/^[_.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+.)+[a-zA-Z]{2,6}$/i", $email_user))
 {
	 echo'<script type="text/javascript">
	 		 swal({
				title: "Error",
  				text: "Introduzca un correo electronico valido!",
  				type: "error",
				},
				function(){
				    window.history.go(-1);
					window.location.href="registro_usuarios.php";
				});
             </script>';
 }
 elseif(empty($Pos_vehi))
 {
	 echo'<script type="text/javascript">
	 		 swal({
				title: "Error",
  				text: "Debe especificar si posee vehículo!",
  				type: "error",
				},
				function(){
				    window.history.go(-1);
					window.location.href="registro_usuarios.php";
				});
             </script>';
 }
 elseif(empty($Pos_moto))
 {
	 echo'<script type="text/javascript">
	 		 swal({
				title: "Error",
  				text: "Debe especificar si posee motocicleta!",
  				type: "error",
				},
				function(){
				    window.history.go(-1);
					window.location.href="registro_usuarios.php";
				});
             </script>';
 }
 
elseif(strlen($descrip_userEmpleo)<10)
 {
	 echo'<script type="text/javascript">
	 		 swal({
				title: "Error",
  				text: "La descripción debe tener al menos 10 caracteres!",
  				type: "error",
				},
				function(){
				    window.history.go(-1);
					window.location.href="registro_usuarios.php";
				});
             </script>';
 }
 elseif(strlen($descrip_userEmpleo)>500)
 {
	 echo'<script type="text/javascript">
	 		 swal({
				title: "Error",
  				text: "La descripción debe tener maximo 500 caracteres!",
  				type: "error",
				},
				function(){
				    window.history.go(-1);
					window.location.href="registro_usuarios.php";
				});
             </script>';
 }
 elseif(empty($descrip_userEmpleo))
 {
	 echo'<script type="text/javascript">
	 		 swal({
				title: "Error",
  				text: "La descripción es obligario!",
  				type: "error",
				},
				function(){
				    window.history.go(-1);
					window.location.href="registro_usuarios.php";
				});
             </script>';
 }
else{
	include("../lib/conexion.php");
    $query = "select * from usuarios_empleo where nomb_user = '".strtolower($nomb_user)."'";
	$results = $conexion->prepare($query);
	$results->execute(array());
	$num=$results->rowCount();

    if($num > 0){
		echo'<script type="text/javascript">
			 swal({
				title: "Error",
  				text: "(*) Usuario ya existente!",
  				type: "error",
				},
				function(){
				    window.history.go(-1);
					window.location.href="registro_usuarios.php";
				});
             </script>';
	}
    else{
	
	if(isset($_FILES['imagen_Usuario'] ['name']) and $_FILES['imagen_Usuario'] ['name']!="")
	{
		$insert="insert into usuarios_empleo(nomb_user,pass_empleo,img_perfil,nombres,apellidos,fk_nacionalida,sexo,fk_departamento,fk_municipio,direccion,tel_fijo,tel_movil,Pos_vehi,Pos_moto,descrip_userEmpleo,email_user,Fech_Naci,fk_TipoLicen,identidadC) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
		$result=$conexion->prepare($insert);
		$result->execute(array($nomb_user,$contraEncrip,$nombre,$nombres,$apellidos,$fk_nacionalida,$sexo,$fk_departamento,$fk_municipio,$direccion,$tel_fijo,$tel_movil,$Pos_vehi,$Pos_moto,$descrip_userEmpleo,$email_user,$fech_Naci,$tipLicen,$identidad));
	}	
	elseif(isset($_POST['foto']))
	{
		$insert="insert into usuarios_empleo(nomb_user,pass_empleo,img_perfil,nombres,apellidos,fk_nacionalida,sexo,fk_departamento,fk_municipio,direccion,tel_fijo,tel_movil,Pos_vehi,Pos_moto,descrip_userEmpleo,email_user,Fech_Naci,fk_TipoLicen,identidadC) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
		$result=$conexion->prepare($insert);
		$result->execute(array($nomb_user,$contraEncrip,$nombre,$nombres,$apellidos,$fk_nacionalida,$sexo,$fk_departamento,$fk_municipio,$direccion,$tel_fijo,$tel_movil,$Pos_vehi,$Pos_moto,$descrip_userEmpleo,$email_user,$fech_Naci,$tipLicen,$identidad));
	}
	else{
		$insert="insert into usuarios_empleo(nomb_user,pass_empleo,nombres,apellidos,fk_nacionalida,sexo,fk_departamento,fk_municipio,direccion,tel_fijo,tel_movil,Pos_vehi,Pos_moto,descrip_userEmpleo,email_user,Fech_Naci,fk_TipoLicen,identidadC) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
		$result=$conexion->prepare($insert);
		$result->execute(array($nomb_user,$contraEncrip,$nombres,$apellidos,$fk_nacionalida,$sexo,$fk_departamento,$fk_municipio,$direccion,$tel_fijo,$tel_movil,$Pos_vehi,$Pos_moto,$descrip_userEmpleo,$email_user,$fech_Naci,$tipLicen,$identidad));
	}
	if(isset($result)){
		
		require("../ModulE/EnviarEmailUser.php");
		enviarEmailUser($email_user,$nomb_user);
		
		if($c==1){
		    
				echo '<script>
					 	swal({
							title: "Información!",
			 			    text: " Un correo ha sido enviado a su cuenta de email para confirmar que se registro exitosamente.",
							type: "info",
							confirmButtonText: "Aceptar",
						},
						function(){
						   window.location.replace("';echo $rutaPrin."ModulC/loginUsuario.php";echo'");
						    
						});
					 </script>';
			}else{
			    
				echo '<script>
					 	swal({
							title: "Error!",
							text: "No se a podido enviar el correo electronico a su cuenta,para confirmar sus datos.",
							type: "errot",
							confirmButtonText: "Aceptar",
						},
						function(){
						   window.location.replace("';echo $rutaPrin."ModulC/loginUsuario.php";echo'");
				
						});
					 </script>';
			}
		}	
	
	
	}
}	
 }
    ob_end_flush();	
?>