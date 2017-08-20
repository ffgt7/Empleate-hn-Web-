<?php
	include("../lib/conexion.php");
	$codPro=$_POST['cod'];
    $codUser=$_POST['user'];
	
	$query = "select vehiculoP,generoP,licenciaP,fk_experienciaP,edad,edad2,experien,fk_idioma,idioma,fk_nivelIdiom,nivel from propuesta join experiencia on cod_experi=fk_experienciaP
    join idioma on cod_idioma=fk_idioma join nivelidiom on cod_nivel=fk_nivelIdiom where cod_propuesta=?";
    $results = $conexion->prepare($query);
    $results->execute(array($codPro));

    $query2="select Pos_moto,Pos_vehi,sexo,fk_TipoLicen,sum(YEAR(fech_FinTra)-YEAR(fech_IniTra) + IF(DATE_FORMAT(fech_FinTra,'%m-%d') > DATE_FORMAT(fech_IniTra,'%m-%d'), 0, -1)) AS `Experiencia`,
    YEAR(CURDATE())-YEAR(Fech_Naci) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(Fech_Naci,'%m-%d'), 0, -1) as edad, fk_idioma,fk_nivel
    from usuarios_empleo left join curri_expelabo on fk_userExpeLbo=cod_empleo left join curri_idioma on fk_userIdioma=cod_empleo where cod_empleo=(select cod_empleo from usuarios_empleo where nomb_user=?) group by fk_idioma,fk_nivel,cod_empleo asc";
    $result2=$conexion->prepare($query2);
    $result2->execute(array($codUser));
    foreach($results as $elem);
    foreach($result2 as $elem2);
   
    $requi[]="";


  if($elem['fk_experienciaP']==7 and $elem2['Experiencia']<5)
  {
    $requi[]="Experiencia laboral necesaria de: ".$elem['experien'];
  }
  elseif($elem2['Experiencia']<=$elem['fk_experienciaP']-1 OR $elem2['Experiencia']==NULL)
  {
    $requi[]="Experiencia laboral necesaria de: ".$elem['experien'];	
  }

  if($elem2['edad']<$elem['edad'] or $elem2['edad']>$elem['edad2'])
  {
    $requi[]="Edad requerida de: ".$elem['edad']." a ".$elem['edad2']." años";
  }

  if($elem['fk_idioma']!=$elem2['fk_idioma'])
  {
    $requi[]="Idioma requerido: ".$elem['idioma'];
  }
  if($elem['fk_nivelIdiom']>$elem2['fk_nivel'] and $elem2['fk_nivel']>1 )
  {
    $requi[]="Nivel requerido del idioma: ".$elem['nivel'];
  }

  if($elem['fk_idioma']!=$elem2['fk_idioma'] and $elem2['fk_nivel']==$elem['fk_idioma'])
  {
    $requi[]="Nivel requerido del idioma: ".$elem['nivel'];
  }

  if($elem['generoP']=="Masculino" and $elem2['sexo']=="F")
  {
    $requi[]="Genero: ".$elem['generoP'];
  }

  if($elem['generoP']=="Femenino" and $elem2['sexo']=="M")
  {
    $requi[]="Genero: ".$elem['generoP'];
  }

  if($elem['vehiculoP']=="Moticicleta" and $elem2['Pos_moto']=="No")
  {
    $requi[]=" No posee Motocicleta";
  }

  if($elem['vehiculoP']=="Carro" and $elem2['Pos_vehi']=="No")
  {
    $requi[]=" No posee Carro";
  }

  if($elem2['fk_TipoLicen']==1 and $elem['licenciaP']!="Indiferente")
  {
    $requi[]="No posee Licencia de conducir";
  }
  elseif($elem['licenciaP']=="Libiana" and $elem2['fk_TipoLicen']!=2)
  {
    $requi[]="Licencia de conducir: Libiana";
  }
  elseif($elem['licenciaP']=="Pesada" and $elem2['fk_TipoLicen']!=4)
  {
    $requi[]="Licencia de conducir: Pesada";
  }
  elseif($elem['licenciaP']=="Especial" and $elem2['fk_TipoLicen']!=3)
  {
    $requi[]="Licencia de condicir: Especial";
  }

	$requiBase=implode("\n",$requi); 
	$numArray=count(explode("\n",$requiBase));
	$user="select cod_empleo from usuarios_empleo where nomb_user=?";
	$r=$conexion->prepare($user);
	$r->execute(array($codUser));
	foreach($r as $n);
	
    $insert="insert into enviocurri(fk_propuesta,fk_userDesem,requisitos,requi_nocumple) values(?,?,?,?)";
    $result=$conexion->prepare($insert);
    $result->execute(array($codPro,$n['cod_empleo'],$requiBase,$numArray));
	
	echo $requiBase;
	