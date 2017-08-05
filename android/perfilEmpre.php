<?php
  
    require "../lib/conexion.php";
	include "../lib/Llenado_Select.php";
	$w=new Llenado_Select();
    $cod=$_GET["cod"];
    $sql5="select cod_usuario,nomb_usuario,nomb_empre,email,num_tel,web_site,descripcion,imagen,Fech_regis,favorito,rubro 
            from usuarios_empre join rubros on cod_rubro = fk_rubro 
            where nomb_usuario='$cod'";
	$array=$w->llenarSelect($sql5);
	$json = array("items" => $array);
    $items=json_encode($json);
    echo $items;
