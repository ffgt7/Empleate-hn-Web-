<?php	
	require "../lib/Llenado_Select.php";	
	$res=new Llenado_Select();
	if(!isset($_GET["cod"])){
		require("../lib/permisosG.php");
		return;
	}
	$cod=$_GET["cod"];
	$sql="select fecha,asunto,texto,de,imagen,fk_UsuarioEm from mensaje join usuario_empleo on cod_empleo=de 
	join usuario_empre on cod_usuario=fk_UsuarioEm  where CodMensaje=$cod";
	$array_empresaM=$res->llenarSelect($sql);


?>