<html>
<?php require("../lib/movil.php"); ?>
	<script src="../js/sweetalert-dev.js"></script>
	<link href="../css/sweetalert.css" rel="stylesheet" type="text/css"/>
	<script src="../js/sweetalert.min.js"></script>
</html>
<?php
		require "../lib/conexion.php";
		require "../lib/Llenado_Select.php";
		$cod=$_POST["cod"];
		$resul=new Llenado_Select();
		
		$cons="select primaria from educacion where cod_educacion=$cod";
		$p=$resul->llenarSelect($cons);
		foreach($p as $x){
		}
		if($x["primaria"]!= "")
		{
		
			if(!isset($_POST["primaria"]))
			{
				require("../lib/permisosG.php");
				return;
			}
			$primaria=$_POST["primaria"];
			$primariaI=$_POST["primariaI"];
			$primariaF=$_POST["primariaF"];
			$secundaria=$_POST["secundaria"];
			$secundariaI=$_POST["secundariaI"];
			$secundariaF=$_POST["secundariaF"];
			$superior=$_POST["superior"];
			$superiorI=$_POST["superiorI"];
			$superiorF=$_POST["superiorF"];
			$tituloSuperior=$_POST["tituloObtenidoS"];
			$carrera=$_POST["carrera"];
			$tituloMedia=$_POST["tituloObtenidoSecu"];
			
		
			$sql=("update educacion set primaria=:miPrimaria, primariI=:miPrimariaI, primariaF=:miPrimariaF, secundaria=:misecundaria, 
			secundariaI=:miSecundariaI, secundariaF=:miSecundariaF, superior=:miSuperior, superiorI=:miSuperiorI, superiorF=:miSuperiorF, 
			tituloObtenidoS=:miTituloObtenidoS, carrera=:miCarrera, tituloObtenidoSecu=:miTituloObtenidoSecu where cod_educacion=:miCod");
		
		$resultado=$conexion->prepare($sql);
		
		$resultado->execute(array("miPrimaria"=>$primaria, "miPrimariaI"=>$primariaI, "miPrimariaF"=>$primariaF, "misecundaria"=>$secundaria,
		"miSecundariaI"=>$secundariaI, "miSecundariaF"=>$secundariaF, "miSuperior"=>$superior, "miSuperiorI"=>$superiorI, 
		"miSuperiorF"=>$superiorF, "miTituloObtenidoS"=>$tituloSuperior,
		"miCarrera"=>$carrera, "miTituloObtenidoSecu"=>$tituloMedia, "miCod"=>$cod)); 
		
		header("Location:../ModulC/perfil_usuario.php"); 
 
		}
		else{
			$superior=$_POST["superior"];
			$superiorI=$_POST["superiorI"];
			$superiorF=$_POST["superiorF"];
			$tituloSuperior=$_POST["tituloObtenidoS"];
			$carrera=$_POST["carrera"];
			
			$sql=("update educacion set superior=:miSuperior, superiorI=:miSuperiorI, superiorF=:miSuperiorF, 
			tituloObtenidoS=:miTituloObtenidoS, carrera=:miCarrera where cod_educacion=:miCod");
		
			$resultado=$conexion->prepare($sql);
			
			$resultado->execute(array("miSuperior"=>$superior, "miSuperiorI"=>$superiorI, 
			"miSuperiorF"=>$superiorF, "miTituloObtenidoS"=>$tituloSuperior,
			"miCarrera"=>$carrera, "miCod"=>$cod)); 
			header("Location:../ModulC/perfil_usuario.php"); 
		}
		
	?>
