<html>
<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<?php require("../lib/movil.php"); ?>
<meta name="description" content="">
<meta name="author" content="">

<title>Bandeja de mensajes</title>
<script src="../js/jquery.js"></script>
<script src="../js/bootstrap.js"></script>
<link href="../css/registro.css" rel="stylesheet" type="text/css"/>
<script src="../js/bootstrapValidator.js" type="text/javascript"></script>
<script src="../js/validacionE.js" type="text/javascript"></script>
<link href="../css/bootstrap.css" rel="stylesheet" type="text/css"/>
<!-- Bootstrap Core CSS -->
<link href="../css/bootstrap.min.css" rel="stylesheet">

<!-- Custom CSS -->
<link href="../css/1-col-portfolio.css" rel="stylesheet">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

</head>

<body>


<?php
require("navSS.php");
require("../lib/conexion.php");
require('../lib/Llenado.php');
$res=new Llenado_Select();

$codUserE= $_SESSION['cod_usuario'];

$consulta="select CodMensajee,asunto,texto,de,fk_Usuario,imagen, nomb_empre from usuarios_empre join  mensajese on 
cod_usuario=de join usuarios_empleo on cod_empleo=fk_Usuario where fk_Usuario=$codUserE";
$resul=$res->llenarSelect($consulta);

?>
    <!-- Page Content -->
    <div class="container">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Mensajes
                    <small>!!</small>
                </h1>
            </div>
        </div>
        <!-- /.row -->
<?php foreach($resul as $elemen): ?>
        <!-- Project One -->
        <div class="row">
            <div class="col-md-3">
                <a href="#">
                    <img class="img-responsive" style="placehold.it/300x100" src="../Imagenes_Empre/<?php echo $elemen["imagen"] ?>" alt="">
					
                </a>
            </div>
            <div class="col-md-5">
                <h3>De:<?php echo $elemen["nomb_empre"] ?></h3>
			
                <h4>Asunto:<?php echo $elemen["asunto"] ?></h4>
                <p>Mensaje:<?php echo $elemen["texto"] ?></p>
               
            </div>
        </div>
        <!-- /.row -->
<?php endforeach; ?>
        <hr>

        
    </div>
</body>

</html>


