<?php
    require "../lib/conexion.php";
    require('../lib/Llenado_Select.php');
    $res=new Llenado_Select();

    $cod = $_GET['cod'];

    $sql="select cod_curriHabi,fk_habilidad,fk_aplicacion,fk_nivelHabi,fk_userEmpleo from currihabilidades join aplicacion on cod_Licen=fk_TipoLicen join departamentos on cod_depart=fk_departamento 
          join municipios on cod_muni=fk_municipio join nacionalidades on cod_nacion=fk_nacionalida 
          where cod_empleo=(SELECT cod_empleo FROM usuarios_empleo WHERE nomb_user ='$cod')";

    $rows=$res->llenarSelect($sql);
    $json = array("items" => $rows);
    $items=json_encode($json);
    echo $items;