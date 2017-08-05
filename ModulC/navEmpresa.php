<?php //require("../lib/scriptss.php");
	$s=new Llenado_Select();
	session_start(); 
	header('Cache-Control: no cache');//para evitar reenvio de formulario
	session_cache_limiter('private_no_expire');//para evitar reenvio de formulario
?>
<script src="../js/jquery.js"></script>
<script src="../js/fileinput.js" type="text/javascript"></script>
<script src="../js/fileinput.min.js" type="text/javascript"></script>
<script src="../js/bootstrap.js"></script>
<script src="../js/bootstrapValidator.js" type="text/javascript"></script>
<script src="../js/tool.js"></script>
<script src="../js/messages_es.js" type="text/javascript"></script>
<script src="../js/validacionPass.js" type="text/javascript"></script>
<script src="../js/vegas/jquery.vegas.min.js"></script>
<script src="../js/jquery.easing.min.js"></script>
<script src="../js/source/jquery.fancybox.js"></script>
<script src="../js/jquery.isotope.js"></script>
<script src="../js/appear.min.js"></script>
<script src="../js/animations.min.js"></script>
<script src="../js/customs.js"></script>
<link href="../css/bootstrap.css" rel="stylesheet" />
<link href="../css/fileinput.css" rel="stylesheet" type="text/css"/>
<link href="../css/fileinput.min.css" rel="stylesheet" type="text/css"/>
<link href="../css/ionicons.css" rel="stylesheet" />
<link href="../css/font-awesome.css" rel="stylesheet" />
<link href="../js/source/jquery.fancybox.css" rel="stylesheet" />
<link href="../css/animations.min.css" rel="stylesheet" />
<link href="../css/style-blue.css" rel="stylesheet" />
<link href="../css/tool.css" rel="stylesheet"/>
<style>
	.badge
	{
		background-color: #F00000;
	}
	li{
			font-family: segoe script; 
			font-size: 12px;
		}
</style>

<div class="navbar navbar-inverse navbar-fixed-top scroll-me" id="menu-section" >
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="../index.php">EMPLEATEHN</a>
		</div>
		
		<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li><a href="#services">PERFIL</a></li>
				<li><a href="#team">PROPUESTAS<span class="badge" data-toggle="tooltip" data-placement="bottom" title="Curriculum recibidos"><?php 
					require("../lib/permisosE.php");
					$cod2=$_SESSION["cod_usuarioE"];
					include "../lib/conexion.php";
					$consul="SELECT count(cod_usuario) from propuesta join usuarios_empre on cod_usuario=fk_userEmpre 
					join enviocurri on fk_propuesta=cod_propuesta where cod_usuario=$cod2 and visto=0 and estado=1";
					$resul= $conexion->prepare($consul);
					$resul->execute(array());
					$num=$resul->fetch(PDO::FETCH_ASSOC);
					$n=implode($num);
					if($n>0)
					{
						echo $n;
					}
				?></span></a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="../ModulK/verArticulos.php">ASESORIA</a></li>
				<li><a href="empresas.php">EMPRESAS</a></li>
				<li><a href="quienesSomos.php">QUIENES SOMOS</a></li>
				<?php
					if(isset($_SESSION['usuario']))
					{ 
				?>
				<?php
					}
					else
					{
				?>
				<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">REGISTRATE<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a class="list-group-item-info" href="../ModulF/registro_empresas.php">EMPRESA</a></li>
						<li><a class="list-group-item-info" href="../ModulF/registro_usuarios.php">USUARIO</a></li>
					</ul>
				</li>
				<?php
					}
				
					if(isset($_SESSION["cod_usuarioE"]))
					{
						if(isset($_SESSION['cod_usuarioE']))
						{
							$cod=$_SESSION["cod_usuarioE"];
							$sql="select imagen from usuarios_empre where cod_usuario=$cod";
							$r=$s->llenarSelect($sql);
							foreach($r as $a)
							{
								
							}
				?>
					<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img style="height:25px; width:25px;" class="img img-circle" src="../Imagenes_Empre/<?php echo $a['imagen'] ?>" /> <?php $cc=strtoupper($_SESSION['usuario']); echo $cc ?><span class="caret"></span></a>
						<ul class="dropdown-menu"><?php
					}
				?>
							<li><a class="list-group-item-info" href="perfil_empresa.php">PERFIL</a></li>
							<li><a class="list-group-item-info" href="../ModulE/cerrarSesion.php">CERRAR SESIÓN</a></li>
						</ul>
				</li>
				<?php
					//Acción que se ejecutaria en caso de que no estes logueado
					}
					else
					{
				?>
					<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">INICIAR SESION<span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a class="list-group-item-info" href="../ModulE/formulario.php">EMPRESA</a></li>
							<li><a class="list-group-item-info" href="loginUsuario.php">USUARIO</a></li>
							<li><a class="list-group-item-info" href="../ModulK/loginAdmin.php">ADMINISTRADOR</a></li>
						</ul>
					</li>
				<?php
					}
				?>
			</ul>
		</div>
	</div>
</div>