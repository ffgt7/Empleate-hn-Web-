.
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Subir Videos</title>
<script src="../js/jquery.js"></script>
<script src="../js/bootstrap.js"></script>
<link href="../css/registro.css" rel="stylesheet" type="text/css"/>
<script src="../js/bootstrapValidator.js" type="text/javascript"> </script>
<script src="../js/validarVideo.js" type="text/javascript"></script>
<script src="../js/messages_es.js" type="text/javascript"></script>
<link href="../css/bootstrap.css" rel="stylesheet" type="text/css"/>
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
	require "navv.php";
	$res=new Llenado_Select();
?>

	<div class="container" style="padding-top:150px">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<h4 style="color:white"><center>Publicar Video <strong>!</strong></center></h4>
                
               
                <form id="formVideo" action="guardarVideo.php" method="post"  class="contactForm">
                   
     <div class="input-group">
        <span class="input-group-addon"></span>
        <select name="cate" id="cate" class="form-control selectpicker" >
        <option value=" " >Seleccione una catégoria</option>
        <?php 
			$sql='select * from catevideos';
			$cate=$res->llenarSelect($sql);
			foreach ($cate as $usu) {
				echo '<option value="'.$usu['0'].'">'.$usu['1'].'</option>';
		}?>
        </select>
     </div><br>      
                    <div class="form-group">
                        <input type="text" class="form-control" name="titulo" id="titulo" placeholder="Titulo del video:" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                        <div class="validation"></div>
                    </div>
					<div class="form-group">
                        <input type="text" class="form-control" name="link" id="link" placeholder="Link del video:" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                        <div class="validation"></div>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" name="descripcion" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Escriba una breve descripcion del video:"></textarea>
                        <div class="validation"></div>
                    </div>
                    
                    <div class="text-center"><button type="submit" name="registrarse" class="w3-btn w3-blue btn-block" >Publicar</button></div>
                </form>
			</div>
		</div>
	
	</section>
</body>
</html>