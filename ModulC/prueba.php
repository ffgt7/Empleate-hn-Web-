<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>
<!doctype html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <?php require("../lib/movil.php"); ?>
    <link href="../css/Media.css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/w3.css">
    <script src="../js/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../js/dist/sweetalert.css">
</head>
<?php
include('../lib/config.php');
if(!isset($_GET['cod']))
{
    require("../lib/permisosG.php");
    return;
}
require("nav.php");
require("../lib/permisosU.php");
include("../lib/conexion.php");

$cod=$_GET['cod'];
$codUser=$_SESSION["cod_usuario"];
$sqlU="select cod_envio from enviocurri where fk_userDesem=? and fk_propuesta=?";
$results = $conexion->prepare($sqlU);
$results->execute(array($codUser,$cod));
$num=$results->rowCount();
if($num>0)
{
    echo'<script type="text/javascript">
  					swal
            (
              {
      					title: "Error",
        				text: "Ya envió su curriculum en esta propuesta!",
        				type: "error",
					     },
    					function()
              {             window.location.replace("';echo $rutaPrin."index.php";echo'");
    					}
            );
          </script>';
    return;
}

$query = "select vehiculoP,generoP,licenciaP,fk_experienciaP,edad,edad2,experien,fk_idioma,idioma,fk_nivelIdiom,nivel from propuesta join experiencia on cod_experi=fk_experienciaP
    join idioma on cod_idioma=fk_idioma join nivelidiom on cod_nivel=fk_nivelIdiom where cod_propuesta=?";
$results = $conexion->prepare($query);
$results->execute(array($cod));

$query2="select Pos_moto,Pos_vehi,sexo,fk_TipoLicen,sum(YEAR(fech_FinTra)-YEAR(fech_IniTra) + IF(DATE_FORMAT(fech_FinTra,'%m-%d') > DATE_FORMAT(fech_IniTra,'%m-%d'), 0, -1)) AS `Experiencia`,
    YEAR(CURDATE())-YEAR(Fech_Naci) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(Fech_Naci,'%m-%d'), 0, -1) as edad, fk_idioma,fk_nivel
    from usuarios_empleo left join curri_expelabo on fk_userExpeLbo=cod_empleo left join curri_idioma on fk_userIdioma=cod_empleo where cod_empleo=? group by fk_idioma,fk_nivel asc";
$result2=$conexion->prepare($query2);
$result2->execute(array($codUser));
foreach($results as $elem);
foreach($result2 as $elem2);
/*if(!isset($elem2))
{
  echo'<script type="text/javascript">
                swal({
                title: "No cuenta con suficiente información en su curriculum",
                  text: "Para aplicar a una oferta de trabajo debe haber creado su curriculum!",
                  type: "error",
                },
                function(){
                    window.location.replace("';echo $rutaPrin."ModulC/curriculum.php";echo'");
                });
             </script>';
    return;

}*/
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
$insert="insert into enviocurri(fk_propuesta,fk_userDesem,requisitos,requi_nocumple) values(?,?,?,?)";
$result=$conexion->prepare($insert);
$result->execute(array($cod,$codUser,$requiBase,$numArray));
$continue=1;

if($continue==1){
?>  <body onload="document.getElementById('id01').style.display='block'">
<div id="id01" class="w3-modal" style="z-index:4">
    <div class="w3-modal-content w3-animate-zoom">
        <div class="w3-container w3-padding w3-blue">
            <h2>Curriculum enviado</h2>
        </div>

        <div align="center">
            <img src="../img/send.png" style="width:20%">
        </div>

        <div class="w3-container">
            <?php
            if($requi!="")
            {
                ?>		<div align="center">
                <p><h2><span class="label label-danger">No cumple con los siguientes requisitos</span></h2></p>
            </div>
                <?php
                foreach($requi as $ele)
                {
                    ?>
                    <p style="color:black;"><?php echo $ele ?></p>
                    <?php
                }

            }
            ?>	     </div>

        <div class="w3-container w3-teal">
            <a href="../index.php">
                <button class="w3-btn w3-right w3-blue">Aceptar <i class="fa fa-paper-plane"></i></button>
            </a>
        </div>
    </div>
</div>
<?php
}

?>
</body>
