<?php
class Llenado_Select{
	function llenarSelect($query){
		include('conexion.php');
		$stmt=$conexion->query($query);
		$rows = $stmt->fetchAll();
		return($rows);
	}
}
?>