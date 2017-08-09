<?php
    require "../lib/conexion.php";
    require('../lib/Llenado_Select.php');
    $res=new Llenado_Select();

    $cod = $_POST['cod'];

    $sql="SELECT cod_usuario,descripcion,email,imagen,nomb_empre,fk_rubro,nomb_usuario,num_tel,pass,Pregunt_Seguri, 
                  web_site,respuesta,rubro,Preg_Segur 
          FROM usuarios_empre JOIN rubros on cod_rubro=fk_rubro JOIN preg_segur on cod_preg=Pregunt_Seguri 
          WHERE cod_usuario=(SELECT cod_usuario FROM usuarios_empre WHERE nomb_usuario ='$cod')";
    $rows=$res->llenarSelect($sql);
    $json = array("items" => $rows);
    $items=json_encode($json);
    echo $items;