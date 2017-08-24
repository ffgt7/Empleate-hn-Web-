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
	if(!isset($_POST["NombreTextBox"]))
		{
			require("../lib/permisosG.php");
			return;
		}

	if(isset($_FILES['imagen']['name']))
	{
		$nombreImg=$_FILES['imagen']['name'];
	}

	if(isset($_FILES['imagen']['type']))
	{
		$tipoImg=$_FILES['imagen']['type'];
	}

	if(isset($_FILES['imagen']['size']))
	{
		$tamImg=$_FILES['imagen']['size'];
	}

	if(isset($tamImg) and $tamImg!=""){
		if($tamImg<=4000000 and $tamImg>=1){
			if($tipoImg=="image/jpg" || $tipoImg=="image/jpeg" || $tipoImg=="image/png" || $tipoImg=="image/gif"){
			$ruta=$_SERVER['DOCUMENT_ROOT'].'/Empleate-hn-Web-/Imagenes_Empre/';
			$nombre=uniqid().$nombreImg;
			move_uploaded_file($_FILES['imagen']['tmp_name'],$ruta.$nombre);
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
						window.location.href="registro_empresas.php";
					});
             	</script>';
		}

		}else{
			echo'<script type="text/javascript">
					swal({
					title: "Error",
  					text: "Tamaño de la imagen demasiado grande!",
  					type: "error",
					},
					function(){
					    window.history.go(-1);
						window.location.href="registro_empresas.php";
					});
             	</script>';
		}
	}

	$nombUser=htmlentities(addslashes($_POST["NombreTextBox"]));
	$contra=$_POST["Contrase"];
	$contraEncrip=password_hash($contra, PASSWORD_DEFAULT);
	$confirContra=$_POST["Confircontrase"];
	$pregunta=$_POST["pregunta"];
	$resPregunSegur=$_POST["Resp_Segu"];
	$nombEmpre=$_POST["NombEmpresa"];
	$email=htmlentities(addslashes($_POST["Correo"]));
	$tel=$_POST["Num_Tel"];
	$pagWeb=$_POST["Pag_web"];
	$rubro=$_POST["Rub_Empre"];
	$descripcion=$_POST["Descrip_Empre"];
	
	//imagen android
	if(isset($_POST['foto']))
    {
        $imagen=$_POST['foto'];
        $nombre=uniqid()."."."png";
        $ruta=$_SERVER['DOCUMENT_ROOT'].'/Empleate-hn-Web-/Imagenes_Empre/';
	    $path = "$ruta$nombre";
	   file_put_contents($path,base64_decode($imagen));
    }


	if(empty($nombUser))
 {

	 echo'<script>
	 		swal({
				title: "Error",
  				text: "El nombre de usuario es obligatorio!",
  				type: "error",
				},
			function(){
			    window.history.go(-1);
				window.location.href="registro_empresas.php";
			});
             </script>';
 }
elseif(strlen($nombUser)>15)
 {
	  echo'<script type="text/javascript">
	  		swal({
				title: "Error",
  				text: "Maximo 15 caracteres!",
  				type: "error",
				},
			function(){
			    window.history.go(-1);
				window.location.href="registro_empresas.php";
			});
           </script>';
 }
elseif(empty($contra))
 {
	 echo'<script type="text/javascript">
	 		swal({
				title: "Error",
  				text: "La contraseña es obligatoria!",
  				type: "error",
				},
			function(){
			    window.history.go(-1);
				window.location.href="registro_empresas.php";
			});
           </script>';

 }
 elseif(strlen($contra) < 8 )
 {
	 echo'<script type="text/javascript">
	 		swal({
				title: "Error",
  				text: "La contraseña debe tener al menos 8 caracteres!",
  				type: "error",
				},
			function(){
			    window.history.go(-1);
				window.location.href="registro_empresas.php";
			});
            </script>';
 }

elseif(empty($confirContra))
 {
	 echo'<script type="text/javascript">
	 		swal({
				title: "Error",
  				text: "Confirme su contraseña!",
  				type: "error",
				},
			function(){
			    window.history.go(-1);
				window.location.href="registro_empresas.php";
			});
            </script>';
 }
 elseif(strlen($confirContra) < 8 )
 {
	  echo'<script type="text/javascript">
	  		swal({
				title: "Error",
  				text: "La contraseña debe tener al menos 8 caracteres!",
  				type: "error",
				},
			function(){
			    window.history.go(-1);
				window.location.href="registro_empresas.php";
			});
            </script>';
 }
elseif($contra!=$confirContra)
 {
	 echo'<script type="text/javascript">
	 		swal({
				title: "Error",
  				text: " La contraseña y su confirmación no son las mismas!",
  				type: "error",
				},
			function(){
			    window.history.go(-1);
				window.location.href="registro_empresas.php";
			});
            </script>';
 }
elseif(empty($pregunta))
 {
	 echo'<script type="text/javascript">
	 		swal({
				title: "Error",
  				text: " Seleccione una pregunta de seguridad!",
  				type: "error",
				},
			function(){
			    window.history.go(-1);
				window.location.href="registro_empresas.php";
			});
            </script>';
 }
elseif(empty($resPregunSegur))
 {
	 echo'<script type="text/javascript">
	 		swal({
				title: "Error",
  				text: " Debe contestar la pregunta de seguridad!",
  				type: "error",
				},
			function(){
			    window.history.go(-1);
				window.location.href="registro_empresas.php";
			});
            </script>';
 }
elseif(strlen($resPregunSegur) < 2 )
 {
	 echo'<script type="text/javascript">
	 		swal({
				title: "Error",
  				text: " Su respuesta debe tener al menos 2 caracteres!",
  				type: "error",
				},
			function(){
			    window.history.go(-1);
				window.location.href="registro_empresas.php";
			});
            </script>';
 }
elseif(strlen($resPregunSegur)>60)
 {
	 echo'<script type="text/javascript">
	 		swal({
				title: "Error",
  				text: " Su respuesta debe tener Maximo 60 caracteres!",
  				type: "error",
				},
			function(){
			    window.history.go(-1);
				window.location.href="registro_empresas.php";
			});
            </script>';
 }
elseif(empty($nombEmpre))
 {
	 echo'<script type="text/javascript">
	 		swal({
				title: "Error",
  				text: " El nombre de la empresa es obligatorio!",
  				type: "error",
				},
			function(){
			    window.history.go(-1);
				window.location.href="registro_empresas.php";
			});
            </script>';
 }
elseif(strlen($nombEmpre)<1){

	echo'<script type="text/javascript">
			swal({
				title: "Error",
  				text: " El nombre de la empresa debe tener minimo un caracter!",
  				type: "error",
				},
			function(){
			    window.history.go(-1);
				window.location.href="registro_empresas.php";
			});
            </script>';
}
elseif(strlen($nombEmpre)>150){

	echo'<script type="text/javascript">
			swal({
				title: "Error",
  				text: " El nombre de la empresa debe tener maximo 150 caracteres!",
  				type: "error",
				},
			function(){
			    window.history.go(-1);
				window.location.href="registro_empresas.php";
			});
            </script>';
}

 elseif(!preg_match("/^[_.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+.)+[a-zA-Z]{2,6}$/i", $email))
 {
	 echo'<script type="text/javascript">
	 		swal({
				title: "Error",
  				text: "Introduzca un correo electronico valido!",
  				type: "error",
				},
			function(){
			    window.history.go(-1);
				window.location.href="registro_empresas.php";
			});
            </script>';
 }
 elseif(empty($tel))
 {
	 echo'<script type="text/javascript">
	 		swal({
				title: "Error",
  				text: "El número de teléfono es obligatorio!",
  				type: "error",
				},
			function(){
			    window.history.go(-1);
				window.location.href="registro_empresas.php";
			});
            </script>';
 }
 elseif(!is_numeric($tel))
 {
	 echo'<script type="text/javascript">
	 		swal({
				title: "Error",
  				text: "Solo se permiten números!",
  				type: "error",
				},
			function(){
			    window.history.go(-1);
				window.location.href="registro_empresas.php";
			});
            </script>';
 }
 elseif(strlen($tel)<8)
 {
	 echo'<script type="text/javascript">
	 		swal({
				title: "Error",
  				text: "El número de telefono debe tener al menos 8 caracteres!",
  				type: "error",
				},
			function(){
			    window.history.go(-1);
				window.location.href="registro_empresas.php";
			});
           	</script>';
 }
elseif(strlen($tel)>15)
 {
	  echo'<script type="text/javascript">
	  		swal({
				title: "Error",
  				text: "El número de telefono debe tener maximo 15 caracteres!",
  				type: "error",
				},
			function(){
			    window.history.go(-1);
				window.location.href="registro_empresas.php";
			});
            </script>';
 }
elseif(strlen($descripcion)<10)
 {
	 echo'<script type="text/javascript">
	 		swal({
				title: "Error",
  				text: "En la descripción ingrese minimo 10 caracteres!",
  				type: "error",
				},
			function(){
			    window.history.go(-1);
				window.location.href="registro_empresas.php";
			});
            </script>';
 }
elseif(strlen($descripcion)>300)
 {
	  echo'<script type="text/javascript">
	  		swal({
				title: "Error",
  				text: "En la descripción ingrese máximo 300 caracteres!",
  				type: "error",
				},
			function(){
			    window.history.go(-1);
				window.location.href="registro_empresas.php";
			});
            </script>';
 }
elseif(empty($descripcion))
 {
	 echo'<script type="text/javascript">
	 		swal({
				title: "Error",
  				text: "La descripcion es obligatoria!",
  				type: "error",
				},
			function(){
			    window.history.go(-1);
				window.location.href="registro_empresas.php";
			});
            </script>';
 }
else {
	include("../lib/conexion.php");
    $query = "select * from usuarios_empre where nomb_usuario = '".strtolower($nombUser)."'";
	$results = $conexion->prepare($query);
	$results->execute(array());
	$num=$results->rowCount();
	$query2 = "select * from usuarios_empre where email = '".strtolower($email)."'";
	$results2 = $conexion->prepare($query2);
	$results2->execute(array());
	$num2=$results2->rowCount();
    if($num > 0){
		echo'<script type="text/javascript">
				swal({
				title: "Error",
  				text: "(*) Usuario ya existente!",
  				type: "error",
				},
			function(){
			    window.history.go(-1);
				window.location.href="registro_empresas.php";
			});
            </script>';

	}
	elseif($num2 > 0){
		echo'<script type="text/javascript">
				swal({
				title: "Error",
  				text: "(*) Correo electronico ya existente!",
  				type: "error",
				},
			function(){
			    window.history.go(-1);
				window.location.href="registro_empresas.php";
			});
            </script>';
	}
    else{

			if(isset($_FILES['imagen'] ['name']) and $_FILES['imagen'] ['name']!="")
			{
				$insert="insert into usuarios_empre(nomb_usuario,pass,Pregunt_Seguri,respuesta,nomb_empre,email,num_tel,web_site,fk_rubro,descripcion,imagen) values(?,?,?,?,?,?,?,?,?,?,?)";
				$result=$conexion->prepare($insert);
				$result->execute(array($nombUser,$contraEncrip,$pregunta,$resPregunSegur,$nombEmpre,$email,$tel,$pagWeb,$rubro,$descripcion,$nombre));

			}
			elseif(isset($_POST['foto']))
			{
				$insert="insert into usuarios_empre(nomb_usuario,pass,Pregunt_Seguri,respuesta,nomb_empre,email,num_tel,web_site,fk_rubro,descripcion,imagen) values(?,?,?,?,?,?,?,?,?,?,?)";
				$result=$conexion->prepare($insert);
				$result->execute(array($nombUser,$contraEncrip,$pregunta,$resPregunSegur,$nombEmpre,$email,$tel,$pagWeb,$rubro,$descripcion,$nombre));

			}
			else{
				$insert="insert into usuarios_empre(nomb_usuario,pass,Pregunt_Seguri,respuesta,nomb_empre,email,num_tel,web_site,fk_rubro,descripcion) values(?,?,?,?,?,?,?,?,?,?)";
				$result=$conexion->prepare($insert);
				$result->execute(array($nombUser,$contraEncrip,$pregunta,$resPregunSegur,$nombEmpre,$email,$tel,$pagWeb,$rubro,$descripcion));

			}

			if(isset($result)){

				require("../ModulE/EnviarEmailEmpre.php");
                EnviarEmailEMpre($email,$nombUser,$nombEmpre);

				if($c=1){
				        
						echo '<script>
							 	swal({
									title: "Información!",
					 			    text: " Un correo ha sido enviado a su cuenta de email para confirmar que se registro exitosamente.",
									type: "info",
									confirmButtonText: "Aceptar",
								},
								function(){
									window.location.replace("';echo $rutaPrin."ModulE/formulario.php";echo'");

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
								    window.location.replace("';echo $rutaPrin."ModulE/formulario.php";echo'");

								});
							 </script>';
					}
				}

	}
}
 ob_end_flush();	
?>
