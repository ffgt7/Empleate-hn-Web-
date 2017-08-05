<html>
	<script src="../js/sweetalert-dev.js"></script>
	<link href="../css/sweetalert.css" rel="stylesheet" type="text/css"/>
	<script src="../js/sweetalert.min.js"></script>
</html>
<?php
		if(!isset($_POST['cod_depart']))
		{
			require("../lib/permisosG.php");
			return;
		}
		$cod_depart=$_POST['cod_depart'];
		if($cod_depart==""){
			$html .= '<option value="" >Seleccione un municipio</option>';
		
		}
		include('../lib/conexion.php');
		$sql=("select cod_muni,muni from municipios WHERE fk_depart = $cod_depart order by muni");
		$results = $conexion->prepare($sql);
		$results->execute();
		$num=$results->rowCount();
	
		if ($num> 0) {
			$html .= '<option value="" >Seleccione un municipio</option>';
    		foreach ($results as $row)
			{            
        		$html .='<option value="'.$row['cod_muni'].'">'.$row['muni'].'</option>';
    		}
		}
		echo $html;
?>