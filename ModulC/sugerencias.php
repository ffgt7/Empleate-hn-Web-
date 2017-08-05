<?php
require_once('../lib/conexion.php'); 
require "../lib/Llenado_Select.php";
$w=new Llenado_Select();
if (isset($_REQUEST['q']) && $_REQUEST['q'] !="") 
{
    $busqueda_dinosaurio = strip_tags(addslashes($_REQUEST['q'])); 
} ?>
<div class='buscador_dinamico'><?php 
if (strlen($busqueda_dinosaurio) > 0) 
{
    $sql="SELECT nomb_empre FROM usuarios_empre WHERE nomb_empre LIKE '%$busqueda_dinosaurio%' ";
    $resultado_search = $conexion->prepare($sql);
    $resultado_search->execute(array());
    $row_cnt = $resultado_search->rowCount();
    $array_propuestas=$w->llenarSelect($sql);
    if ($row_cnt==0) { ?>
<span class ='buscador_sin_resultados'> sin resultados </span><?php
    } 
    else 
    {
        foreach($array_propuestas as $elemento) 
        { ?>
        <input type="button" name="<?php echo $elemento['nomb_empre']; ?>" id="boton01" value="<?php echo $elemento['nomb_empre']; ?>">
        </br>
        <?php 
            
        }
    }
} 
?>
</div>