<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Subir Videos</title>
<?php require("../lib/movil.php"); ?>
</head>
<body>
<?php 

session_start();
require "../lib/Llenado_Select.php";
if(!isset($_SESSION['usuario']))
{
	header("location:../index.php");
}

?>

<section id="inner-headline">
<?php 
	require "navba.php";
	$cod=$_GET["cod"];
	$res=new Llenado_Select();
	$sqll="select codVideo,FKcategoria,link,descripcion,titulo,fecha,FKusuario,categoria,userAdmin from videos join catevideos on codCateVideo=FKcategoria join admin on codVideo=$cod";
	$array=$res->llenarSelect($sqll);
	foreach($array as $elemento):
	endforeach;
?>

	<div class="container" style="padding-top:150px">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<h4 style="color:white"><center>Publicar Video <strong>!</strong></center></h4>
                
               
                <form action="actualizarVideo.php" method="post" role="form" class="contactForm">
                   <input  name="cod" id="cod" placeholder="" class="form-control" value="<?php echo $elemento['codVideo'] ?>" type=hidden>
     <div class="input-group">
        <span class="input-group-addon"></span>
        <select name="cate" id="cate" class="form-control selectpicker" >
        <option value="<?php echo $elemento['FKcategoria'] ?>" ><?php echo $elemento['categoria'] ?></option>
        <?php 
			$sql='select * from catevideos';
			$cate=$res->llenarSelect($sql);
			foreach ($cate as $usu) {
				echo '<option value="'.$usu['0'].'">'.$usu['1'].'</option>';
		}?>
        </select>
     </div><br>      
                    <div class="form-group">
                        <input type="text" class="form-control" value="<?php echo $elemento['titulo'] ?>" name="titulo" id="titulo" placeholder="Titulo del video:" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                        <div class="validation"></div>
                    </div>
					<div class="form-group">
                        <input type="text" class="form-control" value="" name="link" id="link" placeholder="Link del video:" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                        <div class="validation"></div>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control"  name="descripcion" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Escriba una breve descripcion del video:"><?php echo $elemento['descripcion'] ?></textarea>
                        <div class="validation"></div>
                    </div>
                    
                    <div class="text-center"><button type="submit" name="registrarse" class="w3-btn w3-blue btn-block" >Publicar</button></div>
                </form>
			</div>
		</div>
	
	</section>
</body>
</html>