<?php
	include('../lib/config.php');
	echo'<script type="text/javascript">
		swal({
			title: "Error",
  			text: "No se puede acceder a esta sección",
  			type: "error",
			},
			function(){
				window.location.replace("';echo $rutaPrin."index.php";echo'");
			});
             </script>';	
?>