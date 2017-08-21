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
	    include("..//lib/config.php");
   		require("../lib/conexion.php");
		if(!isset($_POST["nombre"]))
		{
			require("../lib/permisosG.php");
			return;
		}
		session_start();
	
		if(isset($_POST['cod_android'])){
			$cod=$_POST['cod_android'];
		}else {
			$cod=$_SESSION["cod_usuarioE"];
		}
		
	
		$nombreP=$_POST["nombre"];
		$area=$_POST["area"];
		$cargo=$_POST["cargo"];
		$vacantes=$_POST["vacantes"];
		$tipo=$_POST["tipoCont"];
		$ubicacion=$_POST["departamentoV"];
		$departamento=$_POST["Depart_Usuario"];
		$municipio=$_POST["Muni_Usuario"];
		$salario=$_POST["salario"];
		$salario2=$_POST["salario2"];
		$caducidad=$_POST["caducidad"];
		$experienciaLab=$_POST["experienciaLab"];
		$titulo=$_POST["titulo"];
		$idioma=$_POST["idioma"];
		$nivel=$_POST["nivel"];
		$genero=$_POST["genero"];
		$edad=$_POST["edad"];
		$edad2=$_POST["edad2"];
		$vehiculo=$_POST["vehiculo"];
		$licencia=$_POST["tipoLicen"];
		$descripcion=$_POST["descripcion"];
		$descripcion2=$_POST["descripcion2"];
		$descripcion3=$_POST["descripcion3"];
		

	
	if(empty($nombreP))
 {
 
	 echo'<script type="text/javascript">
					swal({
					title: "Error",
  					text: "El nombre de la propuesta es obligatorio",
  					type: "error",
					},
					function(){
					    window.history.go(-1);
						window.location.replace("http://empleate-hn.accesocatracho.com/ModulK/oTrabajo.php");
					});
             	</script>';
	
 }
elseif(strlen($nombreP)>100)
 {
	  echo'<script type="text/javascript">
					swal({
					title: "Error",
  					text: "Maximo 100 caracteres!",
  					type: "error",
					},
					function(){
					    window.history.go(-1);
						window.location.href="oTrabajo.php";
					});
             	</script>';
	  
 }


elseif(empty($area))
 {
 
	 echo'<script type="text/javascript">
					swal({
					title: "Error",
  					text: "El area de la propuesta es obligatorio",
  					type: "error",
					},
					function(){
					    window.history.go(-1);
						window.location.href="oTrabajo.php";
					});
             	</script>';
	 
 }

 
elseif(empty($cargo))
 {
 
	 echo'<script type="text/javascript">
					swal({
					title: "Error",
  					text: "Especifique el cargo a desempeñar en la empresa",
  					type: "error",
					},
					function(){
					    window.history.go(-1);
						window.location.href="oTrabajo.php";
					});
             	</script>';
	 
 }




  if(!is_numeric($vacantes))
 {
	 echo'<script type="text/javascript">
					swal({
					title: "Error",
  					text: "Solo se permiten números!",
  					type: "error",
					},
					function(){
					    window.history.go(-1);
						window.location.href="oTrabajo.php";
					});
             	</script>';
	 
 }
 

 
if(empty($tipo))
 {
	 echo'<script type="text/javascript">
					swal({
					title: "Error",
  					text: "El tipo de contratación es obligatorio!",
  					type: "error",
					},
					function(){
					    window.history.go(-1);
						window.location.href="oTrabajo.php";
					});
             	</script>';
	 
 }
 
  
  if(!is_numeric($salario) and !empty($salario))
 {
	 echo'<script type="text/javascript">
					swal({
					title: "Error",
  					text: "Salario minimo,solo se permiten números!",
  					type: "error",
					},
					function(){
					    window.history.go(-1);
						window.location.href="oTrabajo.php";
					});
             	</script>';
	 
 }
  elseif(!is_numeric($salario2) and !empty($salario2))
 {
	 echo'<script type="text/javascript">
					swal({
					title: "Error",
  					text: "Solo se permiten números!",
  					type: "error",
					},
					function(){
					    window.history.go(-1);
						window.location.href="oTrabajo.php";
					});
             	</script>';
	 
 }
 

 if(empty($genero))
 {
	 echo'<script type="text/javascript">
					swal({
					title: "Error",
  					text: "Seleccione un genero de preferencia para la vacante!",
  					type: "error",
					},
					function(){
					    window.history.go(-1);
						window.location.href="oTrabajo.php";
					});
             	</script>';
	 
 }
if(empty($edad))
 {
 
	 echo'<script type="text/javascript">
					swal({
					title: "Error",
  					text: " La edad minima requeria para la vacante es obligatoria",
  					type: "error",
					},
					function(){
					    window.history.go(-1);
						window.location.href="oTrabajo.php";
					});
             	</script>';
	 
 }
 elseif(!is_numeric($edad))
 {
	 echo'<script type="text/javascript">
					swal({
					title: "Error",
  					text: "Edad minima: Solo se permiten números!",
  					type: "error",
					},
					function(){
					    window.history.go(-1);
						window.location.href="oTrabajo.php";
					});
             	</script>';
	 
 }
 
 elseif(!is_numeric($edad2))
 {
	 echo'<script type="text/javascript">
					swal({
					title: "Error",
  					text: "Edad maxima: Solo se permiten números!",
  					type: "error",
					},
					function(){
					    window.history.go(-1);
						window.location.href="oTrabajo.php";
					});
             	</script>';
	 
 }
 
 
 if(empty($descripcion))
 {
 
	 echo'<script type="text/javascript">
					swal({
					title: "Error",
  					text: "Las especificaciones de la vacante son obligatorias",
  					type: "error",
					},
					function(){
					    window.history.go(-1);
						window.location.href="oTrabajo.php";
					});
             	</script>';
	 
 }
elseif(strlen($descripcion)<10)
 {
	  echo'<script type="text/javascript">
					swal({
					title: "Error",
  					text: "Las especificaciones de la vacante, no pueden tener menos de 10 caracteres!",
  					type: "error",
					},
					function(){
					    window.history.go(-1);
						window.location.href="oTrabajo.php";
					});
             	</script>';
	  
 }
 elseif(strlen($descripcion)>1000)
 {
	  echo'<script type="text/javascript">
					swal({
					title: "Error",
  					text: "Las especificaciones de la vacante, no pueden tener mas de 1000 caracteres!",
  					type: "error",
					},
					function(){
					    window.history.go(-1);
						window.location.href="oTrabajo.php";
					});
             	</script>';
	  
 }
 
 if(empty($descripcion2))
 {
 
	 echo'<script type="text/javascript">
					swal({
					title: "Error",
  					text: "Las funsiones de la vacante son obligatorias",
  					type: "error",
					},
					function(){
					    window.history.go(-1);
						window.location.href="oTrabajo.php";
					});
             	</script>';
	 
 }
elseif(strlen($descripcion2)<10)
 {
	  echo'<script type="text/javascript">
					swal({
					title: "Error",
  					text: "Las funciones de la vacante, no pueden tener menos de 10 caracteres!",
  					type: "error",
					},
					function(){
					    window.history.go(-1);
						window.location.href="oTrabajo.php";
					});
             	</script>';
	  
 }elseif(strlen($descripcion2)>1000)
 {
	  echo'<script type="text/javascript">
					swal({
					title: "Error",
  					text: "Las funsiones de la vacante, no pueden tener mas de 1000 caracteres!",
  					type: "error",
					},
					function(){
					    window.history.go(-1);
						window.location.href="oTrabajo.php";
					});
             	</script>';
	  
 }
 
 if(empty($descripcion3))
 {
 
	 echo'<script type="text/javascript">
					swal({
					title: "Error",
  					text: "Los objetivos de la vacante son obligatorias",
  					type: "error",
					},
					function(){
					    window.history.go(-1);
						window.location.href="oTrabajo.php";
					});
             	</script>';
	 
 }
elseif(strlen($descripcion3)<10)
 {
	  echo'<script type="text/javascript">
					swal({
					title: "Error",
  					text: "Los objetivos de la vacante, no pueden tener menos de 10 caracteres!",
  					type: "error",
					},6
					function(){
					    window.history.go(-1);
						window.location.href="oTrabajo.php";
					});
             	</script>';
	  
	 
 }elseif(strlen($descripcion3)>1000)
 {
	  echo'<script type="text/javascript">
					swal({
					title: "Error",
  					text: "Los objetivos de la vacante, no pueden tener mas de 1000 caracteres!",
  					type: "error",
					},6
					function(){
					    window.history.go(-1);
						window.location.href="oTrabajo.php";
					});
             	</script>';
	  
	 
 }
 
 if(empty($departamento))
 {
 
	 echo'<script type="text/javascript">
					swal({
					title: "Error",
  					text: "El departamento donde se hubica la vacante es obligatorio",
  					type: "error",
					},
					function(){
					    window.history.go(-1);
						window.location.href="oTrabajo.php";
					});
             	</script>';
	 
 }
  if(empty($municipio))
 {
 
	 echo'<script type="text/javascript">
					swal({
					title: "Error",
  					text: "El municipio donde se hubica la vacante es obligatorio",
  					type: "error",
					},
					function(){
					    window.history.go(-1);
						window.location.href="oTrabajo.php";
					});
             	</script>';
	 
 }
if($edad > $edad2){

	echo'<script type="text/javascript">
				swal({
				title: "Error",
					text: "La fecha de inicio tiene que ser menor que la fecha de fin.",
					type: "error",
				},
				function(){
				    window.history.go(-1);
					window.location.href="Curri_Cursos.php";
				});
						</script>';

}
if($titulo > 100){

	echo'<script type="text/javascript">
				swal({
				title: "Error",
					text: "El titulo obtenido no debe sobrepasar los 100 caracteres y ser mayor de 2",
					type: "error",
				},
				function(){
				    window.history.go(-1);
					window.location.href="oTrabajo.php";
				});
						</script>';

}
elseif($salario > $salario2)
 {
	 echo'<script type="text/javascript">
					swal({
					title: "Error",
  					text: "El salario máxima debe de ser mayor que el salario minimo!",
  					type: "error",
					},
					function(){
					    window.history.go(-1);
						window.location.href="oTrabajo.php";
					});
             	</script>';
	 
 }


 if($edad > $edad2)
 {
	 echo'<script type="text/javascript">
					swal({
					title: "Error",
  					text: "Edad minima debe de ser menor a la edad máxima!",
  					type: "error",
					},
					function(){
					    window.history.go(-1);
						window.location.href="oTrabajo.php";
					});
             	</script>';
	 
 }
 else{
	 
	 if(isset($_POST['cod_android'])) {
		$sql="select cod_usuario from usuarios_empre where nomb_usuario=?";
		$resul=$conexion->prepare($sql);
		$resul->execute(array($cod));
		$row=$resul->fetchAll();
		foreach($row as $codEmpre);
		$insert="insert into propuesta(nombreP,tipoP,fk_experienciaP,generoP,edad,salarioP,vehiculoP,licenciaP,departamentoP,caducidadP,
            	tituloP,descripcionP,vacantesP,fk_areaP,cargoP,edad2,salario2,descripcion2,descripcion3,fk_departamento,fk_municipio,fk_userEmpre,
            	fk_idioma,fk_nivelIdiom)values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
	
		$result=$conexion->prepare($insert);
		$result->execute(array($nombreP,$tipo,$experienciaLab,$genero,$edad,$salario,$vehiculo,$licencia,$ubicacion,$caducidad,$titulo,
	 $descripcion,$vacantes,$area,$cargo,$edad2,$salario2,$descripcion2,$descripcion3,$departamento,$municipio,$codEmpre['0'],$idioma,$nivel));
		} else {
			$insert="insert into propuesta(nombreP,tipoP,fk_experienciaP,generoP,edad,salarioP,vehiculoP,licenciaP,departamentoP,caducidadP,
					tituloP,descripcionP,vacantesP,fk_areaP,cargoP,edad2,salario2,descripcion2,descripcion3,fk_departamento,fk_municipio,fk_userEmpre,
					fk_idioma,fk_nivelIdiom)values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
	
		$result=$conexion->prepare($insert);
		$result->execute(array($nombreP,$tipo,$experienciaLab,$genero,$edad,$salario,$vehiculo,$licencia,$ubicacion,$caducidad,$titulo,
		                        $descripcion,$vacantes,$area,$cargo,$edad2,$salario2,$descripcion2,$descripcion3,$departamento,$municipio,$cod,$idioma,$nivel));
		}
		
		
		
		if(isset($result)){

				require("../ModulE/enviarPropuesta.php");
				enviarPropuesta($nombreP,$cod);

				if($c=1){
				    header("Location:../ModulC/perfil_empresa.php");
				}
		}
}
   ob_end_flush();	
?>
