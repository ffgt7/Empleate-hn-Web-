<?php session_start(); 

$w=new Llenado_Select();?>
<script src="../js/vegas/jquery.vegas.min.js"></script>
<script src="../js/jquery.easing.min.js"></script>
<script src="../js/source/jquery.fancybox.js"></script>
<script src="../js/jquery.isotope.js"></script>
<script src="../js/appear.min.js"></script>
<script src="../js/animations.min.js"></script>
<script src="../js/custom3.js"></script>
<script src="../js/tool.js"></script>
<link href="../css/style-blue.css" rel="stylesheet" />
<link href="../css/font-awesome.css" rel="stylesheet" />
<link href="../css/tool.css" rel="stylesheet"/>

	<div class="navbar navbar-inverse navbar-fixed-top scroll-me" id="menu-section" >
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="../index.php" ><i class="fa fa-home"></i></a>
		</div>
		<div class="navbar-collapse collapse">
	
			<ul class="nav navbar-nav navbar-right">
				<li><a href="../ModulK/verArticulos.php">ASESORIA</a></li>
				<li><a href="empresas.php">EMPRESAS</a></li>
				<li><a href="#">QUIENES SOMOS</a></li>
				<?php
				if(isset($_SESSION['usuario'])){ ?>
				<?php
				}else{
				?>
					<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">REGISTRATE<span class="caret"></span></a>
					<ul class="dropdown-menu">
					<li><a class="list-group-item-info" href="../ModulF/registro_empresas.php">EMPRESA</a></li>
					<li><a class="list-group-item-info" href="../ModulF/registro_usuarios.php">USUARIO</a></li>
					</ul>
				</li>
				<?php
				}if(isset($_SESSION['usuario'])){
					if(isset($_SESSION['cod_usuario'])){
						$cod=$_SESSION["cod_usuario"];
						$sql="select img_perfil from usuarios_empleo where cod_empleo=$cod";
						$r=$w->llenarSelect($sql);
						foreach($r as $a){					
						}
						?><li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img style="height:25px; width:25px;" class="img img-circle" src="../Imagenes_Users/<?php echo $a['img_perfil'] ?>" /> <?php $cc=strtoupper($_SESSION['usuario']); echo $cc ?><span class="caret"></span></a>
						<ul class="dropdown-menu"><?php
					}
					if(isset($_SESSION['cod_usuarioE'])){
						$cod=$_SESSION["cod_usuarioE"];
						$sql="select imagen from usuarios_empre where cod_usuario=$cod";
						$r=$w->llenarSelect($sql);
						foreach($r as $a){					
						}
						?><li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img style="height:25px; width:25px;" class="img img-circle" src="../Imagenes_Empre/<?php echo $a['imagen'] ?>" /> <?php $cc=strtoupper($_SESSION['usuario']); echo $cc ?><span class="caret"></span></a>
						<ul class="dropdown-menu"><?php
					}
					if(isset($_SESSION['cod_usuario'])){
						?><li><a class="list-group-item-info" href="perfil_usuario.php">PERFIL</a></li><?php
					}
					if(isset($_SESSION['cod_usuarioE'])){
						?><li><a class="list-group-item-info" href="perfil_empresa.php">PERFIL</a></li><?php
					}
					?>
					
					<li><a class="list-group-item-info" href="../ModulE/cerrarSesion.php">CERRAR SESION</a></li>
					</ul>
				</li>
				
				<?php
			
				}else
				{
				
				?>
					<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">INICIAR SESION<span class="caret"></span></a>
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
