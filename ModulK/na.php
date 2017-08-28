
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
            <ul class="nav navbar-nav navbar-right">
                <li><a href="verArticulos.php">ASESORIA</a></li>
                <li><a href="../ModulC/empresas.php">EMPRESAS</a></li>
                <li><a href="../ModulC/quienesSomos.php">QUIENES SOMOS</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">REGISTRATE<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a class="list-group-item-info" href="../ModulF/registro_empresas.php">EMPRESA</a></li>
                        <li><a class="list-group-item-info" href="../ModulF/registro_usuarios.php">USUARIO</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">INICIAR SESION<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a class="list-group-item-info" href="../ModulE/formulario.php">EMPRESA</a></li>
                        <li><a class="list-group-item-info" href="../ModulC/loginUsuario.php">USUARIO</a></li>
                        <li><a class="list-group-item-info" href="loginAdmin.php">ADMINISTRADOR</a></li>
                    </ul>
                </li>
            </ul>
        </div>

    </div>
</div>
</body>
</html>