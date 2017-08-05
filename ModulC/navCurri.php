
<?php //require("../lib/scriptss.php"); 
		session_start(); 
		require "../lib/Llenado_Select.php";
		$s=new Llenado_Select();
?>
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
				<li><a href="perfil_usuario.php"c>PERFIL</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="../ModulK/verArticulos.php">ASESORIA</a></li>
				<li><a href="empresas.php">EMPRESAS</a></li>
				<li><a href="quienesSomos.php">QUIENES SOMOS</a></li>
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
				}
				//En el if va la variable con la que identificas si estan logueados
				if(isset($_SESSION['usuario'])){
						if(isset($_SESSION['cod_usuario'])){
						$cod=$_SESSION["cod_usuario"];
						$sql="select img_perfil from usuarios_empleo where cod_empleo=$cod";
						$r=$s->llenarSelect($sql);
						foreach($r as $a){					
						}
						?><li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img style="height:25px; width:25px;" class="img img-circle" src="../Imagenes_Users/<?php echo $a['img_perfil'] ?>" /> <?php $cc=strtoupper($_SESSION['usuario']); echo $cc ?><span class="caret"></span></a>
						<ul class="dropdown-menu"><?php
					}
				?>
					<li><a class="list-group-item-info" href="perfil_usuario.php">PERFIL</a></li>
					<li><a class="list-group-item-info" href="../ModulE/cerrarSesion.php">CERRAR SESIÓN</a></li>
					</ul>
				</li>
				<?php
					//Acción que se ejecutaria en caso de que no estes logueado
					}else{
				?>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">INICIAR SESION<span class="caret"></span></a>
					<ul class="dropdown-menu">
					<li><a class="list-group-item-info" href="../ModulE/formulario.php">EMPRESA</a></li>
					<li><a class="list-group-item-info" href="loginUsuario.php">USUARIO</a></li>
					<li><a class="list-group-item-info" href="../ModulK/loginAdmin.php">ADMINISRADOR</a></li>
					</ul>
				</li>
				<?php
					}
				?>
			</ul>
		</div>

	</div>
</div>
