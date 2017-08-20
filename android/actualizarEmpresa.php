<?php
    require "../lib/conexion.php";

    $nombUser=$_POST["NombreTextBox"];
    $nombEmpre=$_POST["NombEmpresa"];
    $email=$_POST["Correo"];
    $tel=$_POST["Num_Tel"];
    $pagWeb=$_POST["Pag_web"];
    $rubro=$_POST["Rub_Empre"];
    $descripcion=$_POST["Descrip_Empre"];
    $cod=$_POST["cod_usuario"];

    $sql=("update usuarios_empre set nomb_usuario=:miUsuario, nomb_empre=:miNombreEmpresa, email=:miEmail, 
                num_tel=:miNum, web_site=:miWeb, fk_rubro=:miRubro, descripcion=:miDescripcion 
               where cod_usuario=:miCod");

    $resultado=$conexion->prepare($sql);

    $resultado->execute(array("miCod"=>$cod, "miUsuario"=>$nombUser, "miNombreEmpresa"=>$nombEmpre, "miEmail"=>$email,
        "miNum"=>$tel, "miWeb"=>$pagWeb, "miRubro"=>$rubro, "miDescripcion"=>$descripcion));