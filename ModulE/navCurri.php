
<?php require("../lib/scriptss.php"); 
		session_start(); ?>
	<style>
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
				<li><a href="../ModulC/perfil_usuario.php"c>PERFIL</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="#">ASESORIA</a></li>
				<li><a href="../ModulC/empresas.php">EMPRESAS</a></li>
				<li><a href="../ModulC/quienesSomos.php">QUIENES SOMOS</a></li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">REGISTRATE<span class="caret"></span></a>
					<ul class="dropdown-menu">
					<li><a href="../ModulF/registro_empresas.php">EMPRESA</a></li>
					<li><a href="../ModulF/registro_usuarios.php">USUARIO</a></li>
					</ul>
				</li>
				<?php
				//En el if va la variable con la que identificas si estan logueados
					if($_SESSION['usuario'] == true){
				?>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php $cc=strtoupper($_SESSION['usuario']); echo $cc ?><span class="caret"></span></a>
					<ul class="dropdown-menu">
					<li><a class="list-group-item-info" href="cerrarSesion.php">CERRAR SESIÓN</a></li>
					</ul>
				</li>
				<?php
					//Acción que se ejecutaria en caso de que no estes logueado
					}else{
				?>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">INICIAR SESION<span class="caret"></span></a>
					<ul class="dropdown-menu">
					<li><a class="list-group-item-info" href="formulario.php">EMPRESA</a></li>
					<li><a class="list-group-item-info" href="../ModulC/loginUsuario.php">USUARIO</a></li>
					</ul>
				</li>
				<?php
					}
				?>
			</ul>
		</div>

	</div>
</div>
