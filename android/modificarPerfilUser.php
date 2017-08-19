<?php
    require "../lib/conexion.php";
    require('../lib/Llenado_Select.php');
    $res=new Llenado_Select();

    $cod = $_GET['cod'];

    $sql="select cod_empleo,fk_departamento,fk_municipio,fk_nacionalida,identidadC,apellidos,cod_empleo,descrip_userEmpleo,direccion,
                  email_user,Fech_regisUser,nombres,nomb_user,Pos_moto,Pos_vehi,sexo,tel_fijo,
                  tel_movil,Fech_Naci,descrip_userEmpleo,fk_TipoLicen,Tip_Licen,depart,muni,nacionalidad 
          from usuarios_empleo join licencias on cod_Licen=fk_TipoLicen join departamentos on cod_depart=fk_departamento 
          join municipios on cod_muni=fk_municipio join nacionalidades on cod_nacion=fk_nacionalida 
          where cod_empleo=(SELECT cod_empleo FROM usuarios_empleo WHERE nomb_user ='$cod')";

    $rows=$res->llenarSelect($sql);
    $json = array("items" => $rows);
    $items=json_encode($json);
    echo $items;