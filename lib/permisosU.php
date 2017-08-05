<?php
	include('../lib/config.php');
	if(!isset($_SESSION["cod_usuario"]))
	{
		if(isset($_GET['url']))
		{
			$dir=$_GET['url'];
			echo '<script>
				window.location.replace("';echo $rutaPrin."ModulC/loginUsuario.php";echo '?url2=';echo $dir;echo '")
			</script>';
			return;
		}
		header("location:../ModulC/loginUsuario.php");
	}
	
?>	