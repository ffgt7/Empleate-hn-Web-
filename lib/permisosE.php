<?php
	include('../lib/config.php');
	if (!isset($_SESSION["cod_usuarioE"]))
	{
		if(isset($_GET['url']))
		{
			$dir=$_GET['url'];
			echo '<script>
				window.location.replace("';echo $rutaPrin."ModulE/formulario.php";echo '?url2=';echo $dir;echo '")
			</script>';
			return;
		}
		header("location:../ModulE/formulario.php");
		
	}
?>