<?php
    require "../lib/conexion.php";
    require('../lib/Llenado_Select.php');
    $res=new Llenado_Select();

    $cod = $_GET['cod'];

    $sql="SELECT cod_usuario, nomb_usuario,nomb_empre,email,num_tel,web_site,fk_rubro,rubro,descripcion
          FROM usuarios_empre JOIN rubros on cod_rubro=fk_rubro 
          WHERE cod_usuario=(SELECT cod_usuario FROM usuarios_empre WHERE nomb_usuario ='$cod')";
    $rows=$res->llenarSelect($sql);
    $json = array("items" => $rows);
    $items=json_encode($json);
    echo $items;