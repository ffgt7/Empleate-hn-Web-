<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 08-07-17
 * Time: 11:39 PM
 */
require "../lib/conexion.php";
include "../lib/Llenado_Select.php";
$w=new Llenado_Select();
$cod=$_GET["cod"];
$sql5="select CodMensaje,asunto,texto,de,fk_UsuarioEm,fecha,nomb_empre,imagen from mensaje join usuarios_empre on
 cod_usuario=fk_UsuarioEm where CodMensaje=$cod";
$array=$w->llenarSelect($sql5);
$json = array("items" => $array);
$items=json_encode($json);
echo $items;
?>