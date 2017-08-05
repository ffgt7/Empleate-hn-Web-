<?php
ob_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>
<html>
<?php require("../lib/movil.php"); ?>
	<script src="../js/sweetalert-dev.js"></script>
	<link href="../css/sweetalert.css" rel="stylesheet" type="text/css"/>
	<script src="../js/sweetalert.min.js"></script>
</html>	

<?php
        include("../lib/config.php");
		$cate = $_POST['cate'];
		$text = $_POST['editor'];
	
		 if(!isset($_POST["editor"]))
		{
			require("../lib/permisosG.php");
			return;
		}
		session_start();
	
		$cod = $_SESSION["codAdmin"];
		
		
		if(empty($cate))
	 {
		 
		 
		 echo'<script type="text/javascript">
				swal({
				title: "Error",
					text: "La categoría es obligatorio",
					type: "error",
				},
				function(){
					window.location.href="blog2.php";
				});
						</script>';
		
	 }
		elseif(empty($text))
	 {
		 
		
		 echo'<script type="text/javascript">
				swal({
				title: "Error",
					text: "El artículo es obligatorio",
					type: "error",
				},
				function(){
					window.location.href="blog2.php";
				});
						</script>';
		
	 }	
	 
	 else
	 {
		require("../lib/conexion.php");
		 $insert="insert into blog(categoria,blog,FKcreador)
	     values(?,?,?)";
	
	
		$result=$conexion->prepare($insert);
		$result->execute(array($cate,$text,$cod));
		
		 echo '<script>
           swal({
              title: "Información!",
               text: "Publicació Exitosa!",
               type: "info",
               confirmButtonText: "Aceptar"
           },
           function(){
           window.location.replace("';echo $rutaPrin."ModulK/blog2.php";echo'");
           });
        </script>';
		
	 
	}
	ob_end_flush();
?>
