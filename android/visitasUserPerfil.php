<?php
    require "../lib/conexion.php";
    include "../lib/Llenado_Select.php";
    $w=new Llenado_Select();

    $cod = $_GET['cod'];
    $sql="select imagen, nomb_empre as nombre, num_visitas as numVisitas, fecha 
          from contadorempre join usuarios_empre on contadorempre.cod_visitante = usuarios_empre.cod_usuario 
          where contadorempre.cod_perfil = (select cod_empleo 
                                            from usuarios_empleo where nomb_user='$cod')";
    $array=$w->llenarSelect($sql);
    $json = array("items" => $array);
    $items=json_encode($json);
    echo $items;