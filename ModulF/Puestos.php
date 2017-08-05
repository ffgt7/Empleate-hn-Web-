<html>
	<script src="../js/sweetalert-dev.js"></script>
	<link href="../css/sweetalert.css" rel="stylesheet" type="text/css"/>
	<script src="../js/sweetalert.min.js"></script>
</html>
<?php
		if(!isset($_POST['cod_cate']))
		{
			require("../lib/permisosG.php");
			return;
		}
		$cod_cate=$_POST['cod_cate'];
		if($cod_cate==""){
			$html .= '<option value=" " >Seleccione un puesto</option>';
		
		}
		include("../lib/conexion.php");
		$sql="select cod_Puesto,puesto from puestos where fk_Catego = $cod_cate";
		$results = $conexion->prepare($sql);
		$results->execute(array());
		$num=$results->rowCount();
	
		if ($num > 0) 
		{
			$html .= '<option value=" " >Seleccione un puesto</option>';
			foreach ($results as $row)
    		{                
        		$html .='<option value="'.$row['cod_Puesto'].'">'.$row['puesto'].'</option>';
    		}
		}
		echo $html;
?>