<?php
	include('../lib/config.php');
	if(!isset($_SESSION["codAdmin"]))
	{
		if(isset($_GET['url']))
		{
			$dir=$_GET['url'];
			echo '<script>
				window.location.replace("';echo $rutaPrin."ModulK/loginAdmin.php";echo '?url2=';echo $dir;echo '")
			</script>';
			return;
		}
		header("location:../ModulK/loginAdmin.php");
	}
	
?>	