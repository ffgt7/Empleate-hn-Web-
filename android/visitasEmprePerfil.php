<?php
    require "../lib/conexion.php";
    include "../lib/Llenado_Select.php";
    $w=new Llenado_Select();

    $cod = $_GET['cod'];
    $sql="select nomb_user as nombre, img_perfil as imagen,num_visitas as numVisitas, fecha 
          from contadorempre join usuarios_empleo on contadorempre.cod_visitante = usuarios_empleo.cod_empleo 
          where contadorempre.cod_perfil = (select cod_usuario 
                                            from usuarios_empre where nomb_usuario='$cod')";
    $array=$w->llenarSelect($sql);
    $json = array("items" => $array);
    $items=json_encode($json);
    echo $items;
