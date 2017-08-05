<html>
<?php require("../lib/movil.php"); ?>
	<script src="../js/sweetalert-dev.js"></script>
	<link href="../css/sweetalert.css" rel="stylesheet" type="text/css"/>
	<script src="../js/sweetalert.min.js"></script>
</html>
<?php
        include("../lib/config.php");
		require("../lib/conexion.php");
		session_start();
	
		$cod=$_SESSION["cod_usuario"];
		

		$cons="select primaria from educacion where fk_userEdu=?";
		$p=$conexion->prepare($cons);
		$p->execute(array($cod));
		$num=$p->rowCount();
		
		
		
		if($num==0)
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

		
		
		
		if(empty($primaria))
	 {
	 
		 echo'<script type="text/javascript">
				swal({
				title: "Error",
					text: "El campo primaria  es obligatorio",
					type: "error",
				},
				function(){
				    window.history.go(-1);
					window.location.href="educacion.php";
				});
						</script>';
	
	 }	
	
	if(empty($primariaI))
	 {
		 
		 
		 echo'<script type="text/javascript">
				swal({
				title: "Error",
					text: "El año de inicio de educacion primaria  es obligatorio",
					type: "error",
				},
				function(){
				    window.history.go(-1);
					window.location.href="educacion.php";
				});
						</script>';
		
	 }	
		 elseif(!is_numeric($primariaI))
 {
	 echo'<script type="text/javascript">
				swal({
				title: "Error",
					text: "Año que inicio su educacion primaria,solo se permiten números!",
					type: "error",
				},
				function(){
				    window.history.go(-1);
					window.location.href="educacion.php";
				});
						</script>';
	
 }
		
		if(empty($primariaF))
	 {
	 
		 echo'<script type="text/javascript">
				swal({
				title: "Error",
					text: "El año de finalización de educacion primaria  es obligatorio",
					type: "error",
				},
				function(){
				    window.history.go(-1);
					window.location.href="educacion.php";
				});
						</script>';
		 
	 }	

		 elseif(!is_numeric($primariaF))
 {
	 echo'<script type="text/javascript">
				swal({
				title: "Error",
					text: "Año que finalizo su educacion primaria,solo se permiten números!",
					type: "error",
				},
				function(){
				    window.history.go(-1);
					window.location.href="educacion.php";
				});
						</script>';
	 
 }
 
				if(empty($secundaria))
	 {
	 
		 echo'<script type="text/javascript">
				swal({
				title: "Error",
					text: "El campo Educación media es obligatorio",
					type: "error",
				},
				function(){
				    window.history.go(-1);
					window.location.href="educacion.php";
				});
						</script>';
		
	 }		 
		
		if(empty($secundariaI))
	 {
	 
		 echo'<script type="text/javascript">
				swal({
				title: "Error",
					text: " El año de inicio de educacion secundaria  es obligatorio",
					type: "error",
				},
				function(){
				    window.history.go(-1);
					window.location.href="educacion.php";
				});
						</script>';
		 
	 }	
		 elseif(!is_numeric($secundariaI))
 {
	 echo'<script type="text/javascript">
				swal({
				title: "Error",
					text: "Año que inicio su educacion secuandaria,solo se permiten números!",
					type: "error",
				},
				function(){
				    window.history.go(-1);
					window.location.href="educacion.php";
				});
						</script>';
	 
 }
		if(empty($secundariaF))
	 {
	 
		 echo'<script type="text/javascript">
				swal({
				title: "Error",
					text: "El año de finalizo de educacion secundaria  es obligatorio",
					type: "error",
				},
				function(){
				    window.history.go(-1);
					window.location.href="educacion.php";
				});
						</script>';
		 
		
	 }	
		 elseif(!is_numeric($secundariaF))
 {
	 echo'<script type="text/javascript">
				swal({
				title: "Error",
					text: "Año que finalizo su educacion secuandaria,solo se permiten números!",
					type: "error",
				},
				function(){
				    window.history.go(-1);
					window.location.href="educacion.php";
				});
						</script>';
			 
 }
 
 
			elseif(!empty($superiorI) and !is_numeric($superiorI))
 {
	 echo'<script type="text/javascript">
				swal({
				title: "Error",
					text: "Año que inicio su educacion superior,solo se permiten números!",
					type: "error",
				},
				function(){
				    window.history.go(-1);
					window.location.href="educacion.php";
				});
						</script>';

			 
 }
 
 
		elseif(!empty($superiorF) and !is_numeric($superiorF))
 {
	 echo'<script type="text/javascript">
				swal({
				title: "Error",
					text: "Año que finalizo su educacion superior,solo se permiten números!",
					type: "error",
				},
				function(){
				    window.history.go(-1);
					window.location.href="educacion.php";
				});
						</script>';
	 
	
 }
 
 
 

 
 elseif($superiorI > $superiorF){

	echo'<script type="text/javascript">
				swal({
				title: "Error",
					text: "La fecha de inicio de su educacion superior tiene que ser menor que la fecha de fin.",
					type: "error",
				},
				function(){
				    window.history.go(-1);
					window.location.href="educacion.php";
				});
						</script>';

}
elseif($primariaI > $primariaF){

	echo'<script type="text/javascript">
				swal({
				title: "Error",
					text: "La fecha de inicio de su educacion primaria tiene que ser menor que la fecha de fin.",
					type: "error",
				},
				function(){
				    window.history.go(-1);
					window.location.href="educacion.php";
				});
						</script>';

}
elseif($secundariaI > $secundariaF){

	echo'<script type="text/javascript">
				swal({
				title: "Error",
					text: "La fecha de inicio de su educacion secundaria tiene que ser menor que la fecha de fin.",
					type: "error",
				},
				function(){
				    window.history.go(-1);
					window.location.href="educacion.php";
				});
						</script>';

}		
else{
	
		if(empty($superiorF) and empty($superiorI))
		{
			$insert="insert into educacion(primaria,primariI,primariaF,secundaria,secundariaI,secundariaF,superior,tituloObtenidoS,
		tituloObtenidoSecu,fk_userEdu)values(?,?,?,?,?,?,?,?,?,?)";
	
	
		$result=$conexion->prepare($insert);
		$result->execute(array($primaria,$primariaI,$primariaF,$secundaria,$secundariaI,$secundariaF,$superior,$tituloSuperior,$tituloMedia,$cod));
		if(isset($result)){
			echo'<script type="text/javascript">
					swal({
					title: "Información",
  					text: "Registro exitoso.",
  					type: "info",
					},
					function(){
					    window.history.go(-1);
						window.location.href="educacion.php";
					});
             	</script>';
		}else{
			echo'<script type="text/javascript">
					swal({
					title: "Error",
  					text: "No se ha podido registrar, intente nuevamente.",
  					type: "error",
					},
					function(){
					    window.history.go(-1);
						window.location.href="educacion.php";
					});
             	</script>';
		}
	}

	
	
		elseif(empty($superiorI))
		{
			$insert="insert into educacion(primaria,primariI,primariaF,secundaria,secundariaI,secundariaF,superior,tituloObtenidoS,
		tituloObtenidoSecu,fk_userEdu)values(?,?,?,?,?,?,?,?,?,?)";
	
	
		$result=$conexion->prepare($insert);
		$result->execute(array($primaria,$primariaI,$primariaF,$secundaria,$secundariaI,$secundariaF,$superior,$tituloSuperior,$tituloMedia,$cod));
	
		if(isset($result)){
			echo'<script type="text/javascript">
					swal({
					title: "Información",
  					text: "Registro exitoso.",
  					type: "info",
					},
					function(){
					    window.history.go(-1);
						window.location.href="educacion.php";
					});
             	</script>';
		}else{
			echo'<script type="text/javascript">
					swal({
					title: "Error",
  					text: "No se ha podido registrar, intente nuevamente.",
  					type: "error",
					},
					function(){
					    window.history.go(-1);
						window.location.href="educacion.php";
					});
             	</script>';
		}
	}
	
	elseif(empty($superiorF))
		{
			$insert="insert into educacion(primaria,primariI,primariaF,secundaria,secundariaI,secundariaF,superior,tituloObtenidoS,
		tituloObtenidoSecu,fk_userEdu)values(?,?,?,?,?,?,?,?,?,?)";
	
	
		$result=$conexion->prepare($insert);
		$result->execute(array($primaria,$primariaI,$primariaF,$secundaria,$secundariaI,$secundariaF,$superior,$tituloSuperior,$tituloMedia,$cod));
		if(isset($result)){
			echo'<script type="text/javascript">
					swal({
					title: "Información",
  					text: "Registro exitoso.",
  					type: "info",
					},
					function(){
					    window.history.go(-1);
						window.location.href="educacion.php";
					});
             	</script>';
		}else{
			echo'<script type="text/javascript">
					swal({
					title: "Error",
  					text: "No se ha podido registrar, intente nuevamente.",
  					type: "error",
					},
					function(){
					    window.history.go(-1);
						window.location.href="educacion.php";
					});
             	</script>';
		}
	}

	else{
		$insert="insert into educacion(primaria,primariI,primariaF,secundaria,secundariaI,secundariaF,superior,superiorI,superiorF,tituloObtenidoS,carrera,
		tituloObtenidoSecu,fk_userEdu)values(?,?,?,?,?,?,?,?,?,?,?,?,?)";
	
	
		$result=$conexion->prepare($insert);
		$result->execute(array($primaria,$primariaI,$primariaF,$secundaria,$secundariaI,$secundariaF,$superior,$superiorI,$superiorF,$tituloSuperior,
		$carrera,$tituloMedia,$cod));
	
		if(isset($result)){
			echo'<script type="text/javascript">
					swal({
					title: "Información",
  					text: "Registro exitoso.",
  					type: "info",
					},
					function(){
					    window.history.go(-1);
						window.location.href="educacion.php";
					});
             	</script>';
		}else{
			echo'<script type="text/javascript">
					swal({
					title: "Error",
  					text: "No se ha podido registrar, intente nuevamente.",
  					type: "error",
					},
					function(){
					    window.history.go(-1);
						window.location.href="educacion.php";
					});
             	</script>';
		}
	}
		
}
		}
		else{
			
			$superior=$_POST["superior"];
			$superiorI=$_POST["superiorI"];
			$superiorF=$_POST["superiorF"];
			$tituloSuperior=$_POST["tituloObtenidoS"];
			$carrera=$_POST["carrera"];
			
	if(empty($superiorI))
 {
	 echo'<script type="text/javascript">
				swal({
				title: "Error",
					text: "El año que inicio su educacion superior es obligatorio!",
					type: "error",
				},
				function(){
				    window.history.go(-1);
					window.location.href="educacion.php";
				});
						</script>';

			 
 }	
elseif(empty($superiorF))
 {
	 echo'<script type="text/javascript">
				swal({
				title: "Error",
					text: "El año que inicio su educacion superior es obligatorio!",
					type: "error",
				},
				function(){
				    window.history.go(-1);
					window.location.href="educacion.php";
				});
						</script>';

			 
 } 
	elseif(!empty($superiorI) and !is_numeric($superiorI))
 {
	 echo'<script type="text/javascript">
				swal({
				title: "Error",
					text: "Año que inicio su educacion superior,solo se permiten números!",
					type: "error",
				},
				function(){
				    window.history.go(-1);
					window.location.href="educacion.php";
				});
						</script>';

			 
 }
 
 
		elseif(!empty($superiorF) and !is_numeric($superiorF))
 {
	 echo'<script type="text/javascript">
				swal({
				title: "Error",
					text: "Año que finalizo su educacion superior,solo se permiten números!",
					type: "error",
				},
				function(){
				    window.history.go(-1);
					window.location.href="educacion.php";
				});
						</script>';
	 
	
 }
 
 
 

 
 elseif($superiorI > $superiorF){

	echo'<script type="text/javascript">
				swal({
				title: "Error",
					text: "La fecha de inicio de su educacion superior tiene que ser menor que la fecha de fin.",
					type: "error",
				},
				function(){
				    window.history.go(-1);
					window.location.href="educacion.php";
				});
						</script>';

}
else{
		$insert="insert into educacion(superior,superiorI,superiorF,tituloObtenidoS,carrera,fk_userEdu)values(?,?,?,?,?,?)";
	
	
		$result=$conexion->prepare($insert);
		$result->execute(array($superior,$superiorI,$superiorF,$tituloSuperior,$carrera,$cod));
	
		if(isset($result)){
			echo'<script type="text/javascript">
					swal({
					title: "Información",
  					text: "Registro exitoso.",
  					type: "info",
					},
					function(){
						window.location.replace("';echo $rutaPrin."ModulK/educacion.php";echo'");
					});
             	</script>';
		}else{
			echo'<script type="text/javascript">
					swal({
					title: "Error",
  					text: "No se ha podido registrar, intente nuevamente.",
  					type: "error",
					},
					function(){
					    window.history.go(-1);
						window.location.href="educacion.php";
					});
             	</script>';
		}
	}
}
	?>
