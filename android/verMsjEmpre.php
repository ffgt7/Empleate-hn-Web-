<?php
/**
 * Created by PhpStorm.
 * User: Chris
 * Date: 8/12/2017
 * Time: 4:27 PM
 */
    require "../lib/conexion.php";
    include "../lib/Llenado_Select.php";
    $w=new Llenado_Select();
    $cod=$_GET["cod"];
    $sql5="select CodMensaje, nombres, asunto,texto,de,fk_UsuarioEm,fecha,cod_empleo,nomb_user,nombres,img_perfil, nomb_empre, imagen from mensaje join usuarios_empleo on 
        cod_empleo=de join usuarios_empre on 
        cod_usuario=fk_UsuarioEm where CodMensaje=$cod";
    $array=$w->llenarSelect($sql5);
    $json = array("items" => $array);
    $items=json_encode($json);
    echo $items;
?>