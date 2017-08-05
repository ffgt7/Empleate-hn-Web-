<?php
ob_start();
?>
<?php
	require('../lib/conexion.php');
	require('../lib/Llenado_Select.php');
	//$res=new Llenado_Select();
	
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php require("../lib/movil.php"); ?>
<meta charset="utf-8">
<body>
<?php 

session_start();

if(!isset($_SESSION['usuario']))
{
	header("location:../index.php");
}

?>
	<div id="wrapper">
<?php 
	require "navba.php";
	$res=new Llenado_Select();
	$cod=$_GET["cod"];
	$sqll="select codBlog,blog,fecha,categoria,cate,FKcreador,userAdmin from blog join cateblog on codCate=categoria join admin on codBlog=$cod";
	$array=$res->llenarSelect($sqll);
	foreach($array as $elemento):
	endforeach;
?>
	
	<div class="container" style="padding-top: 60px;">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<h4 style="color:white;">Publica tu artículo <strong>aquí!</strong></h4>
                
                <div id="sendmessage"></div>
                <div id="errormessage"></div>
				<div class="input-group">
  
	<form action="actualizarBlog.php" method="post">
	<input  name="cod" id="cod" placeholder="" class="form-control" value="<?php echo $elemento['codBlog'] ?>" type=hidden>
	
		 <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
    <select id="cate" name="cate" class="form-control selectpicker" >
      <option value="<?php echo $elemento["categoria"] ?>" ><?php echo $elemento["cate"] ?></option>
       <?php 
		$sql='select * from cateBlog';
		$rows=$res->llenarSelect($sql);
		foreach ($rows as $row) {
		echo '<option value="'.$row['codCate'].'">'.$row['cate'].'</option>';
	}?>
    </select>
  </div>
       <br>
	<div class="form-group">
	<textarea name="editor" id="editor" cols="30" rows="10"><?php echo $elemento["blog"] ?></textarea>
	</div>
	<div class="text-center"> <button class="w3-btn w3-blue" type="submit" id="guardar" name="guardar" >Enviar<span class="glyphicon glyphicon-send"></span></button></div>
	<script type="text/javascript">
		window.onload = function(){
		editor = CKEDITOR.replace("editor");
		CKFinder.setupCKEditor(editor, 'http://empleate-hn.accesocatracho.com/ModulK/ckeditor/ckfinder');
		}
	</script>

	</form>

	</div>
	<div>
				 
	</div>
	</div>
	</div>
	</div>
	
</body>
</html>
<?php
ob_end_flush();	
?>

