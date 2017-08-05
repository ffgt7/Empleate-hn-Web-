<?php
ob_start();
?>
<!doctype html>
<html>
<head>
<?php require("../lib/movil.php"); ?>
<meta charset="utf-8">
<title>Perfil Empresa</title>
</head>

<body>
<?php
	require("busquedaE.php");
	require("../footer.php");
?>
</body>
</html>
<?php
ob_end_flush();
?>