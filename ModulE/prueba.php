<?php

require("../lib/conexion.php");

$codUser = htmlentities(addslashes($_SESSION["cod_usuarioE"]));

$sql3="SELECT SUM(num_visitas) FROM contadorempre WHERE cod_perfil = '$codUser'";

$resultado3=$conexion->prepare($sql3);

$resultado3->execute(array());

$fila2=$resultado3->fetch(PDO::FETCH_ASSOC);

if($fila2['SUM(num_visitas)']!="")
{
  $num_visitas=$fila2['SUM(num_visitas)'];
}
else
{
  $num_visitas=0;
}

echo 'Visitas a tu perfíl 
    <spam class="badge badge-error"  style="align: right;">
        '. $num_visitas.'
    </spam>';
?>
