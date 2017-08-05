<html>
<?php require("../lib/movil.php"); ?>
	<script src="../js/sweetalert-dev.js"></script>
	<script src="../js/bootstrapValidator.js" type="text/javascript"></script>
	<script src="../js/validarVideo.js" type="text/javascript"></script>
	<link href="../css/sweetalert.css" rel="stylesheet" type="text/css"/>
	<script src="../js/sweetalert.min.js"></script>
</html>	
<?php
    include("../lib/config.php");
    require("../lib/conexion.php");
	
	if(!isset($_POST["cate"]))
		{
			require("../lib/permisosG.php");
			return;
		}
		session_start();
	
		$cod=$_SESSION["codAdmin"];
	
	
	
		$cate=$_POST["cate"];
		$titulo=$_POST["titulo"];
		$link=$_POST["link"];
		$descripcion=$_POST["descripcion"];
		
		
		if(
		empty($cate))
	 {
	 
		 echo'<script type="text/javascript">
				swal({
				title: "Error",
					text: "El campo categoría es obligatorio",
					type: "error",
				},
				function(){
				    window.history.go(-1);
					window.location.href="video.php";
				});
						</script>';
	
	 }	
	
	elseif(empty($titulo))
	 {
		 
		 
		 echo'<script type="text/javascript">
				swal({
				title: "Error",
					text: "El título es obligatorio",
					type: "error",
				},
				function(){
				    window.history.go(-1);
					window.location.href="video.php";
				});
						</script>';
		
	 }	
		
	elseif(empty($link))
	 {
		 
		 
		 echo'<script type="text/javascript">
				swal({
				title: "Error",
					text: "El  link es obligatorio",
					type: "error",
				},
				function(){
				    window.history.go(-1);
					window.location.href="video.php";
				});
						</script>';
		
	 }		
	elseif(empty($descripcion))
	 {
		 
		 
		 echo'<script type="text/javascript">
				swal({
				title: "Error",
					text: "La descripción del video es obligatoria",
					type: "error",
				},
				function(){
				    window.history.go(-1);
					window.location.href="video.php";
				});
						</script>';
		
	 }			
	else{
		
	
	$insert="insert into videos(FKusuario,FKcategoria,link,descripcion,titulo)
	values(?,?,?,?,?)";
	
	
		$result=$conexion->prepare($insert);
		$result->execute(array($cod,$cate,$link,$descripcion,$titulo));
	echo '<script>
           swal({
              title: "Información!",
               text: "Publicació Exitosa!",
               type: "info",
               confirmButtonText: "Aceptar"
           },
           function(){
            window.location.replace("';echo $rutaPrin."ModulK/video.php";echo'");
           });
        </script>';
		
          
	}    
		
?>