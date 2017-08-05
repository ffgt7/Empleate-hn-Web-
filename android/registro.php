<?php
    require "../lib/conexion.php";
    $nombre=$_POST['username'];
    $email=$_POST['email'];
    $contra=$_POST['password'];
    $resp=$_POST['resp'];
    $nombEmpre=$_POST['nombEmpre'];
    $descrip=$_POST['descrip'];
    $pag=$_POST['pag'];
    $tel=$_POST['tel'];
    $pregunta=$_POST["pregunta"];
    $rubro=$_POST["Rub_Empre"];
    if(isset($_POST['foto']))
    {
        $imagen=$_POST['foto'];
    }
    
    
   if($imagen!="")
   {
       $nombreI=uniqid()."."."png";
       $ruta=$_SERVER['DOCUMENT_ROOT'].'/Imagenes_Android/';
	    $path = "$ruta$nombreI";
	    file_put_contents($path,base64_decode($imagen));
	    
	    $sql="insert into prueba(nombre,correo,contra,descrip,nombEmpre,pag,resp,tel,imagen,pregunta,actividad) values(?,?,?,?,?,?,?,?,?,?,?)";
        $insert=$conexion->prepare($sql);
        $insert->execute(array($nombre,$email,$contra,$descrip,$nombEmpre,$pag,$resp,$tel,$nombreI,$pregunta,$rubro));
   }
    else
    {
        
        $sql="insert into prueba(nombre,correo,contra,descrip,nombEmpre,pag,resp,tel,pregunta,actividad) values(?,?,?,?,?,?,?,?,?,?)";
        $insert=$conexion->prepare($sql);
        $insert->execute(array($nombre,$email,$contra,$descrip,$nombEmpre,$pag,$resp,$tel,$pregunta,$rubro));
    }
   
   