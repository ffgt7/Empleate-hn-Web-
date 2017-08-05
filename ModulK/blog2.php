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
<title>Publicar Articulo! </title>
<script src="../js/jquery.js"></script>
<script src="../js/bootstrap.js"></script>
<script src="../js/bootstrapValidator.js" type="text/javascript"> </script>
<script src="../js/messages_es.js" type="text/javascript"></script>
<script src="../js/validarBlog.js" type="text/javascript"></script>
<link href="../css/bootstrap.css" rel="stylesheet" type="text/css"/>
<body>
<?php 

session_start();
$host=$_SERVER["HTTP_HOST"];
$url=$_SERVER["REQUEST_URI"];
$dire="http://" . $host . $url;
	if(!isset($_SESSION["codAdmin"]))
	{
		
		echo '<script>
				window.location.href="../lib/permisosA.php'; echo '?url=';echo $dire;echo '";
			</script>';
		return;

	}

?>
	<div id="wrapper">
<?php 
	require "navv.php";
	$res=new Llenado_Select();
?>
	
	<div class="container" style="padding-top: 60px;">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<h4 style="color:white;">Publica tu artículo <strong>aquí!</strong></h4>
                
                <div id="sendmessage"></div>
                <div id="errormessage"></div>
				
	<form action="guardarBlog.php" method="post" id="formBlog">

	
		 <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
    <select id="cate" name="cate" class="form-control selectpicker" >
      <option value=" " >Seleccione una categoria</option>
       <?php 
		$sql='select * from cateblog';
		$rows=$res->llenarSelect($sql);
		foreach ($rows as $row) {
		echo '<option value="'.$row['codCate'].'">'.$row['cate'].'</option>';
	}?>
    </select>
  </div>
       <br>
	<div class="form-group">
	<textarea name="editor" id="editor" cols="30" rows="10"></textarea>
	</div>
	<div class="text-center"> <button class="w3-btn w3-blue" type="submit" id="guardar" name="guardar" >Enviar<span class="glyphicon glyphicon-send"></span></button></div>
	<script type="text/javascript">
	
	CKEDITOR.replace("editor");
	
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

