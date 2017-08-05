<?php 

    require"../lib/conexion.php";
    
    $nombre=$_POST['nombre'];
    $area=$_POST['area'];
    $cargo=$_POST['cargo'];
    $vacantes=$_POST['vacantes'];
    $horario=$_POST['horario'];
    $ubicacion=$_POST['ubicacion'];
    $depto=$_POST['depto'];
    $muni=$_POST['muni'];
    $smax=$_POST['smax'];
    $smin=$_POST['smin'];
    $experiencia=$_POST['experiencia'];
    $titulo=$_POST['titulo'];
    $idioma=$_POST['idioma'];
    $nivel=$_POST['nivel'];
    $emax=$_POST['emax'];
    $emin=$_POST['emin'];
    $vehiculo=$_POST['vehiculo'];
    $licencia=$_POST['licencia'];
    $descripcion=$_POST['descripcion'];
    $funcion=$_POST['funcion'];
    $objetivo=$_POST['objetivo'];
    
    
    $sql="insert into prueba_kristy(nombre,area,cargo,vacante,horario,ubicacion,depto,municipio,maximo,minimo,experiencia,titulo,idioma,nivel,emax,emin,vehiculo,licencia,
    descripcion,funsiones,objetivos) 
    values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $insert=$conexion->prepare($sql);
        $insert->execute(array($nombre,$area,$cargo,$vacantes,$horario,$ubicacion,$depto,$muni,$smax,$smin,$experiencia,$titulo,$idioma,$nivel,$emax,$emin,$vehiculo,$licencia,$descripcion,
        $funcion,$objetivo));
    