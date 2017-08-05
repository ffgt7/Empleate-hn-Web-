<html>
	<script src="../js/sweetalert-dev.js"></script>
	<link href="../css/sweetalert.css" rel="stylesheet" type="text/css"/>
	<script src="../js/sweetalert.min.js"></script>
</html>
<?php
		if(!isset($_POST['cod_habilidad']))
		{
			require("../lib/permisosG.php");
			return;
		}
		$cod_habilidad=$_POST['cod_habilidad'];
		if($cod_habilidad==""){
			$html .= '<option value="" >Selecciona una aplicación de la lista</option>';
		
		}
		include('../lib/conexion.php');
		$sql=("select cod_aplicacion,nombAplica from aplicaciones WHERE fk_habilidad=? order by nombAplica");
		$results = $conexion->prepare($sql);
		$results->execute(array($cod_habilidad));
		$num=$results->rowCount();
	
		if ($num> 0) {
			$html .= '<option value="" >Selecciona una aplicación de la lista</option>';
    		foreach ($results as $row)
			{            
        		$html .='<option value="'.$row['cod_aplicacion'].'">'.$row['nombAplica'].'</option>';
    		}
		}
		echo $html;
?>