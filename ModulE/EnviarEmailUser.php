<?php
ob_start();  
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function EnviarEmailUser($email_user,$nomb_user){

	//Recibir todos los parámetros del formulario
	$para = $email_user;
	$asunto = "Bienvenido a Empleate-HN";
	$mensaje = '<!DOCTYPE html>
				<html lang="es">
				<head>

				<meta charset="utf-8">
				<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

				<style>
				body, html {
					height: 100%;
					margin: 0;
				}

				.hero-image {
				  background-image: url("http://www.iosxtreme.com/wp-content/uploads/2015/08/Glacier_Point_at_Sunset_Yosemite_NP_CA_US_-_Diliff.jpg");
				  height: 80%;
				  background-position: center;
				  background-repeat: no-repeat;
				  background-size: cover;
				  position: relative;
				}

				.hero-text {
				  text-align: center;
				  position: absolute;
				  top: 50%;
				  left: 50%;
				  transform: translate(-50%, -50%);
				  color: white;
				}

				.hero-text button {
				  border: none;
				  outline: 0;
				  display: inline-block;
				  padding: 10px 25px;
				  color: black;
				  background-color: #ddd;
				  text-align: center;
				  cursor: pointer;
				}

				.hero-text button:hover {
				  background-color: #555;
				  color: white;
				}
				</style>

				</head>
				<body>

				<div class="hero-image">
				  <div class="hero-text">
					<h1 style="font-size:50px">Bienvenido a Empleate-HN.</h1>

					<h3>Gracias '.$nomb_user.' por registrarte en Empleate-HN.</h3>
					<div class="container-fluid text-center">
						<h3>¿Qué es Empleate-HN?</h3>
						<p>La página Empleate-HN es una página que le facilita la búsqueda de empleo en todo el país, las empresas que se encuentran registradas en esta página web se encargan de subir propuestas de empleo, y esta página se encarga de mostrar estas propuestas.</p>
					</div>

					<div class="container-fluid text-center">
						<h3>¿Cuál es el objetivo de Empleate-HN?</h3>
						<p>El objetivo es mostrar las ofertas de empleo o las vacantes que las diferentes empresas suben a nuestra página web, y que las personas desempleadas de nuestro país puedan optar por ese empleo, todo estos sin que la persona desempleada se mueva y tengan gasto económicos.</p>
					</div>

					<button src="http://empleate-hn.accesocatracho.com/">Ir a pagina web</button>
				  </div>
				</div>

				</body>
				</html>';
	$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
    $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    
    if(mail($para,$asunto,$mensaje,$cabeceras))
    {
        $c=1;
    }
    
}
ob_end_flush();	
?>
