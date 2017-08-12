<?php
/**
 * Created by PhpStorm.
 * User: Chris
 * Date: 8/12/2017
 * Time: 4:26 PM
 */
    require "../lib/conexion.php";
    include "../lib/Llenado_Select.php";
    $w=new Llenado_Select();
    $cod=$_GET["cod"];
    $sql5="select CodMensajee,asunto,texto,de,fk_Usuario,img_perfil,fecha,nombres,nomb_user from mensajese join usuarios_empleo  on 
        cod_empleo=fk_Usuario where de=(select cod_usuario from usuarios_empre where
       nomb_usuario='$cod')";
    $array=$w->llenarSelect($sql5);
    $json = array("items" => $array);
    $items=json_encode($json);
    echo $items;
?>