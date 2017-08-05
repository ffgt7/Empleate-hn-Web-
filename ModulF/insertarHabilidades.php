<?php
ob_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>
<html>
<HEAD>
    <script src="../js/sweetalert-dev.js"></script>
    <link href="../css/sweetalert.css" rel="stylesheet" type="text/css"/>
    <script src="../js/sweetalert.min.js"></script>
</HEAD>
<body >
   <?php
    include("../lib/config.php");
	if(!isset($_POST['aplicacion_Habi']))
	{
		require("../lib/permisosG.php");
		return;
	}
	$habilidad=$_POST['aplicacion_Habi'];
	$aplicacion=$_REQUEST['aplicacion'];
	$nivel=$_POST['nivel'];
	

	if(empty($habilidad))
	{
	   echo '<script>
				swal({
					title: "Información!",
					 text: " Debe seleccionar una habilidad.",
					type: "error",
					confirmButtonText: "Aceptar"
				},
				function(){
				    window.history.go(-1);
				    window.location.href="habilidades.php";
				});
			</script>';
	}
	elseif(empty($aplicacion))
	{
		echo '<script>
				swal({
					title: "Información!",
					 text: " Debe seleccionar una Aplicación.",
					type: "error",
					confirmButtonText: "Aceptar"
				},
				function(){
				    window.history.go(-1);
				    window.location.href="habilidades.php";
				});
			</script>';
             	
             	
	}
	elseif(empty($nivel))
	{
		echo '<script>
				swal({
					title: "Información!",
					 text: " Debe seleccionar un nivel.",
					type: "error",
					confirmButtonText: "Aceptar"
				},
				function(){
				    window.history.go(-1);
				    window.location.href="habilidades.php";
				});
			</script>';
	}
    else{
		session_start();
		$User=$_SESSION['cod_usuario'];

		include("../lib/conexion.php");
		
		$verifi="select cod_curriHabi from curriHabilidades where fk_aplicacion=? and fk_userEmpleo=?";
		$result=$conexion->prepare($verifi);
		$result->execute(array($aplicacion,$User));
		$n=$result->rowCount();
		
		if($n==1)
		{
		    	echo'<script type="text/javascript">
					swal({
					title: "Error",
  					text: "Ya Agregó esta Aplicación",
  					type: "error",
					},
					function(){
						window.location.replace("';echo $rutaPrin."ModulF/habilidades.php";echo'");
					});
             	</script>';
		}
		else
		{
		    $insert="insert into curriHabilidades(fk_aplicacion,fk_habilidad,fk_nivelHabi,fk_userEmpleo) values(?,?,?,?)";
		    $result2=$conexion->prepare($insert);
		    $result2->execute(array($aplicacion,$habilidad,$nivel,$User));
		    
		    if(isset($result2))
		    {
    			echo'<script type="text/javascript">
    					swal({
    					title: "Información",
      					text: "Habilidad Registrada con exito.",
      					type: "info",
    					},
    					function(){
    					    window.location.replace("';echo $rutaPrin."ModulF/habilidades.php";echo'");
    					});
                 	</script>';
		    }
		
		}

	
	}
ob_end_flush();	
    //header("Location:../ModulC/curriculum.php");
?> 
</body>	
</html>
