<?php
ob_start();
?>
<!doctype html>
<html>
<head>
    <script language="JavaScript">
    javascript:window.history.forward(1); //Esto es para cuando le pulse al 
    botón de Atrás
    javascript:window.history.back(1); //Esto para cuando le pulse al botón 
    de Adelante
    </script>
    <meta charset="utf-8">
    <title>Perfil Usuario</title>
    <?php require("../lib/movil.php"); ?>
    <link id="theme-style" rel="stylesheet" href="../css/styles-6.css">
    <link rel="stylesheet" href="../css/w3.css">
    
    <script src="../js/jquery.js"></script>
    <script src="../js/fileinput.js" type="text/javascript"></script>
    <script src="../js/fileinput.min.js" type="text/javascript"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="../js/tool.js"></script>
    <script src="../js/bootstrapValidator.js" type="text/javascript"></script>
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
    <style>
    	.text{
    		color: white;
    	}
    
    	.imagen{
    		height:200px;
    		width:300px;
    	}
    	.profile{
    			height: 120px;
    			width: 120px;
    		}
    </style>
    <style>
    	.badge
    	{
    		background-color: #F00000;
    	}
    </style>
    <script>
    	var openTab = document.getElementById("firstTab");
    	openTab.click();
    </script>
    <script type="text/javascript">
    $(document).ready(function() {
        $('#pass').blur(function(){
    
            $('#Info').html('<img src="../img/loader.gif" alt="" width="60px" height="60px"/>').fadeOut(1000);
    
            var pass = $(this).val();
            var dataString = 'pass='+pass;
    
            $.ajax({
                type: "POST",
                url: "Verifi_pass.php",
                data: dataString,
                success: function(data) {
                    $('#Info').fadeIn(1000).html(data);
                }
            });
        });
    });
    </script>
    
    <script>
    $(document).ready(function(){
        $("button").click(function(){
            $("dive").toggle();
        });
    });
    </script>
    <script>
    $(document).ready(function(){
        $("button1").click(function(){
            $("divi").toggle();
        });
    });
    </script>
    <script>
    $(document).ready(function(){
        $("button2").click(function(){
            $("divo").toggle();
        });
    });
    </script>
    <script>
    $(document).ready(function(){
        $("button3").click(function(){
            $("diva").toggle();
        });
    });
    </script>
    
    <style>
    
    #nombre{
    	white-space: nowrap;
    	height:1.2em;
    	overflow: hidden;
    	text-overflow: ellipsis;
    }
    
    #fecha{
    	white-space: nowrap;
    	height:1.2em;
    	overflow: hidden;
    	text-overflow: ellipsis;
    }
    
    #reco{
        white-space: nowrap;
    	overflow: hidden;
    	text-overflow: ellipsis;
    }
    
    </style>

</head>
<body>
<?php
	require "navv.php";
	require("../lib/permisosU.php");
//	require "../lib/Llenado_Select.php";

	$cod=$_SESSION["cod_usuario"];
	$sql="select apellidos, cod_empleo,email_user,direccion,Fech_regisUser,Fech_Naci,img_perfil,nombres,identidadC,sexo,tel_fijo,tel_movil,depart,nacionalidad,muni
	from usuarios_empleo join departamentos on cod_depart=fk_departamento join nacionalidades on cod_nacion=fk_nacionalida join municipios on cod_muni=fk_municipio
	where cod_empleo=$cod";
	$resul=new Llenado_Select();
	$array=$resul->llenarSelect($sql);
?>
<?php foreach($array as $elementos): ?>
<?php endforeach; ?>
<section id="services" >
	<div class="container">
		<div class="row text-center header">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 animate-in" data-anim-type="fade-in-up">
				<h3 class="text">PERFIL</h3>
			</div>
		</div>
		<div class="row animate-in" data-anim-type="fade-in-up">
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
				<div class="services-wrapper">
					<a href="javascript:void(0)" onclick="document.getElementById('id02').style.display='block'"><img class="img-responsive img-rounded" style="width:100%; height:195px;" src="../Imagenes_Users/<?php echo $elementos['img_perfil'] ?>"></a>
					<h3 id="nombre" class="text" style="color: white"><?php echo $elementos['nombres'] ?><br><?php echo $elementos['apellidos'] ?></h3>
					<h4 id="fecha" class="text" style="color: white">Usuario desde <?php echo $elementos['Fech_regisUser'] ?></h4>
				</div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
			    
			    <div class="services-wrapper" style="margin-bottom: 23px;padding-top: 10px;">
                    <h3 style="margin-top: 0px;">
                        <a href="../ModulE/contaVisitasUser.php">
                            <i class="fa fa-eye fa-2x"></i>
                        </a>
                        <?php
                            require("../ModulE/PruebaUser.php");
                        ?>
                    </h3>
                    
					<h3 class="text" style="margin-top: 0px;margin-bottom: 0px;">
					    <a href="empreFavo.php">
					        <i class="fa fa-star fa-2x"></i>
					   </a>
					   Favoritos
					<?php
						//require("../lib/permisosU.php");
						$cod2=$_SESSION["cod_usuario"];
						include "../lib/conexion.php";
						$consul="SELECT count(cod_propuesta) from propuesta join usuarios_empre on cod_usuario=fk_userEmpre
						join favoritos on cod_usuario=fk_empre where fk_usuario=? and estado=1 and visto=0";
						$resul= $conexion->prepare($consul);
						$resul->execute(array($cod2));
						$num=$resul->fetch(PDO::FETCH_ASSOC);
						$n=implode($num);
						if($n>0)
						{
							echo '<span class="badge badge-error" data-toggle="tooltip" data-placement="bottom" title="Propuestas nuevas">';echo $n;echo'</span>';
						}
					?></h3>
				</div>
				<div class="services-wrapper" style="padding-top:10px;">
					<h3 class="text" style="margin-top: 8px;">
					    <a href="../ModulK/mensajesU2.php">
					        <i class="fa fa-envelope fa-5x"></i>
					    </a>
					    Mensajes
					<?php
						$cod=$_SESSION["cod_usuario"];
						$consul="select count(CodMensajee) from mensajese where fk_usuario=? and visto=0";
						$resul= $conexion->prepare($consul);
						$resul->execute(array($cod));
						$num=$resul->fetch(PDO::FETCH_ASSOC);
						$n=implode($num);
						if($n>0)
						{
							echo '<span class="badge badge-error" data-toggle="tooltip" data-placement="bottom" title="Mensajes Recibidos">';echo $n;echo'</span>';

						}

					?>
					</h3>

				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
				<div class="services-wrapper" href="#">
					<h3 class="text"><a href="curriculum.php"><i class="fa fa-file fa-5x"></i></a> Crear Curriculo</h3>
					<h3 class="text"><a href="modificarUsuarios.php?cod=<?php echo $elementos['cod_empleo'] ?>"><i class="fa fa-edit fa-2x"></i></a>Modificar Perfil</h3>
					<h3 class="text"><a href="javascript:void(0)"
						onclick="document.getElementById('id01').style.display='block'"><i class="fa fa-lock fa-5x"></i></a> Cambiar Contraseña</h3>
				</div>
			</div>
		</div>
	</div>
</section>
<section id="team" >
	<div class="container">
		<div class="row text-center header animate-in" data-anim-type="fade-in-up">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<h3 class="text">Curriculo</h3>
			</div>
		</div>
<div class="row animate-in" data-anim-type="fade-in-up">
		<div class="wrapper">
        <div class="sidebar-wrapper">
            <div class="profile-container">
                <img class="profile img-circle" src="../Imagenes_Users/<?php echo $elementos['img_perfil'] ?>" alt="" />
                <h1 class="name"><?php echo $elementos['nombres'] ?><br><?php echo $elementos['apellidos'] ?></h1>
                <h3 class="tagline"><?php echo $elementos['identidadC'] ?></h3>
            </div><!--//profile-container-->

            <div class="contact-container container-block">
                <ul class="list-unstyled contact-list">
                    <li class="email" id="reco"><i class="fa fa-envelope"></i><a href=""><?php echo $elementos['email_user'] ?></a></li>
                    <li class="phone"><i class="fa fa-phone-square"></i><a href=""><?php echo $elementos['tel_fijo'] ?></a></li>
                    <li class="phone"><i class="fa fa-phone"></i><a href=""><?php echo $elementos['tel_movil'] ?></a></li>
                    <li class="website"><i class="fa fa-calendar"></i><?php echo $elementos['Fech_Naci'] ?></li>
					<li class="github" id="reco"><i class="fa fa-map"></i><?php echo $elementos['nacionalidad'] ?></li>
					<li class="github" id="reco"><i class="fa fa-map"></i><?php echo $elementos['depart'] ?></li>
					<li class="github" id="reco"><i class="fa fa-map"></i><?php echo $elementos['muni'] ?></li>
                    <li class="linkedin" id="reco"><i class="fa fa-map"></i><?php echo $elementos['direccion'] ?></li>
                </ul>
            </div><!--//contact-container-->

<?php
	$sql3="select * from educacion where fk_userEdu=$cod";
	$array=$s->llenarSelect($sql3);
?>


            <div class="education-container container-block">
                <h2 class="container-block-title">Educación</h2>
 <?php foreach($array as $element): ?>
                <div class="item">
					<br>
                    <h4 class="degree"><?php echo $element['tituloObtenidoS'] ?></h4>
                    <h5 class="meta"><?php echo $element['superior'] ?></h5>
                    <div class="time"><?php echo $element['superiorI'] ?> - <?php echo $element['superiorF'] ?></div>
                </div><!--//item-->
                <div class="item">
                    <h4 class="degree"><?php echo $element['tituloObtenidoSecu'] ?></h4>
                    <h5 class="meta"><?php echo $element['secundaria'] ?></h5>
                    <div class="time"><?php echo $element['secundariaI'] ?> - <?php echo $element['secundariaF'] ?></div>
                </div><!--//item-->
                <div class="item">
                    <h5 class="meta"><?php echo $element['primaria'] ?></h5>
                    <div class="time"><?php echo $element['primariI'] ?> - <?php echo $element['primariaF'] ?></div>
                </div><!--//item-->
                <a href="../ModulK/modificarEducacion.php?cod=<?php echo $element['cod_educacion'] ?>" class="w3-btn w3-blue-gray"><i class="fa fa-edit"></i> Modificar</a>
 <?php endforeach; ?>
          		<hr>
           		<a href="../ModulK/Educacion.php" class="w3-btn w3-blue"><i class="fa fa-plus"></i> Nuevo</a>
            </div><!--//education-container-->
 <?php
	$sq="select idioma, nivel from idioma join curri_idioma on idioma.cod_idioma=fk_idioma join nivelidiom on cod_nivel=fk_nivel where fk_userIdioma=$cod";
	$array=$s->llenarSelect($sq);
?>
            <div class="languages-container container-block">
                <h2 class="container-block-title">Lenguajes</h2>
                <ul class="list-unstyled interests-list">
				 <?php foreach($array as $ww): ?>
                    <li><?php echo $ww['idioma']?> (<?php echo $ww['nivel'] ?>)<span class="lang-desc"></span></li>
				 <?php endforeach; ?>
              		<hr>
               		<a href="../ModulE/Curri_Idiomas.php" class="w3-btn w3-blue"><i class="fa fa-plus"></i> Nuevo</a>
                </ul>
            </div><!--//interests-->
        </div><!--//sidebar-wrapper-->

        <div class="main-wrapper">
<?php
	$sql4="sELECT cod_curri, Nomb_Empre, fech_FinTra, fech_IniTra, Nomb_EscriPuesto, descrip_Funcio,fk_actividad,fk_categ,fk_puesto,
	puesto, pais, rubro, catego FROM curri_expelabo JOIN puestos ON cod_Puesto = fk_puesto JOIN paises ON
	cod_pais = fk_pais JOIN rubros ON cod_rubro = fk_actividad JOIN categorias ON cod_catego = fk_categ where fk_userExpeLbo=$cod";
	$array=$s->llenarSelect($sql4);
	$resultado=$conexion->prepare($sql4);
	$resultado->execute(array());
	$num_filas=$resultado->rowCount();
	$array1 = array_slice($array, 0, 2);
?>
            <section class="section experiences-section">
                <h2 class="section-title"><i class="fa fa-briefcase"></i>Experiencia Laboral</h2>
				<div>
 <?php foreach($array1 as $elemen): ?>
                <div class="item">
                    <div class="meta">
                        <div class="upper-row">
                           <br>
                            <h3 class="job-title"><?php echo $elemen['Nomb_EscriPuesto'] ?></h3>
                            <div class="time"><?php echo $elemen['fech_IniTra'] ?> &nbsp;&nbsp;-&nbsp;&nbsp; <?php echo $elemen['fech_FinTra'] ?></div>
                        </div><!--//upper-row-->
                        <h5 style="color: black">Nombre de la Empresa: <?php echo $elemen['Nomb_Empre'] ?></h5>
					    <h5 style="color: black">Rubro de la Empresa: <?php echo $elemen['rubro'] ?></h5>
						<h5 style="color: black">Puesto en la Empresa: <?php echo $elemen['Nomb_EscriPuesto'] ?></h5>
						<h5 style="color: black">Area: <?php echo $elemen['puesto'] ?></h5>
						<h5 style="color: black">Funciones que desempeñe: <?php echo $elemen['descrip_Funcio'] ?></h5>
                    </div><!--//meta-->
                </div><!--//item-->
                <a href="../ModulK/modificarExperiLaboral.php?cod=<?php echo $elemen['cod_curri'] ?>" class="w3-btn w3-blue-gray"><i class="fa fa-edit"></i> Modificar</a>
<?php endforeach; ?><br><br><?php 
                if($num_filas > 2 )
                {
                    $array2 = array_slice($array, 2);?>
                    <button1 class="w3-btn">Mostrar Más</button1>
                    <divi style="display:none;">
                    <?php foreach($array1 as $elemen): ?>
                    <div class="item">
                        <div class="meta">
                            <div class="upper-row">
                               <br>
                                <h3 class="job-title"><?php echo $elemen['Nomb_EscriPuesto'] ?></h3>
                                <div class="time"><?php echo $elemen['fech_IniTra'] ?> &nbsp;&nbsp;-&nbsp;&nbsp; <?php echo $elemen['fech_FinTra'] ?></div>
                            </div><!--//upper-row-->
                            <h5 style="color: black">Nombre de la Empresa: <?php echo $elemen['Nomb_Empre'] ?></h5>
    					    <h5 style="color: black">Rubro de la Empresa: <?php echo $elemen['rubro'] ?></h5>
    						<h5 style="color: black">Puesto en la Empresa: <?php echo $elemen['Nomb_EscriPuesto'] ?></h5>
    						<h5 style="color: black">Area: <?php echo $elemen['puesto'] ?></h5>
    						<h5 style="color: black">Funciones que desempeñe: <?php echo $elemen['descrip_Funcio'] ?></h5>
                        </div><!--//meta-->
                    </div><!--//item-->
                    <a href="../ModulK/modificarExperiLaboral.php?cod=<?php echo $elemen['cod_curri'] ?>" class="w3-btn w3-blue-gray"><i class="fa fa-edit"></i> Modificar</a>
    <?php endforeach; ?>
                    </divi><?php
                }?>
				</div>
          		<hr>
           		<a href="../ModulF/Curri_ExperiLaboral.php" class="w3-btn w3-blue"><i class="fa fa-plus"></i> Nuevo</a>
            </section><!--//section-->
			<section class="section summary-section">
<?php
	$sql5="select * from referencia where fk_userRefe=$cod";
	$array=$s->llenarSelect($sql5);
	$resultado=$conexion->prepare($sql5);
	$resultado->execute(array());
	$num_filas=$resultado->rowCount();
	$array1 = array_slice($array, 0, 2);
?>
                <h2 class="section-title"><i class="fa fa-user"></i>Referencia</h2>
				<div>
<?php foreach($array1 as $el): ?>
                <div class="summary">
                  <br>
                   <h5 class="text" style="color: black">Nombres: <?php echo $el['nombreR'] ?></h5>
                   <h5 class="text" style="color: black">Apellidos: <?php echo $el['apellidoR'] ?></h5>
                   <h5 class="text" style="color: black">Numero de Identidad: <?php echo $el['identidadR'] ?></h5>
                   <h5 class="text" style="color: black">Dirección: <?php echo $el['direccionR'] ?></h5>
                   <h5 class="text" style="color: black">Telefono: <?php echo $el['telFR'] ?></h5>
                   <h5 class="text" style="color: black">Celular: <?php echo $el['telMR'] ?></h5>
                   <h5 class="text" style="color: black">Correo: <?php echo $el['correoR'] ?></h5>
                   <h5 class="text" style="color: black">Correo Alternativo: <?php echo $el['correolR2'] ?></h5>
                 </div><!--//summary-->
                <a href="../ModulK/modificarReferencia.php?cod=<?php echo $el['cod_referencai'] ?>" class="w3-btn w3-blue-gray"><i class="fa fa-edit"></i> Modificar</a>
<?php endforeach; ?><br><br><?php 
                if($num_filas > 2 )
                {
                    $array2 = array_slice($array, 2);?>
                <button class="w3-btn">Mostrar Más</button>
                <dive style="display:none;">
                    <?php foreach($array2 as $el): ?>
                                    <div class="summary">
                                      <br>
                                       <h5 class="text" style="color: black">Nombres: <?php echo $el['nombreR'] ?></h5>
                                       <h5 class="text" style="color: black">Apellidos: <?php echo $el['apellidoR'] ?></h5>
                                       <h5 class="text" style="color: black">Numero de Identidad: <?php echo $el['identidadR'] ?></h5>
                                       <h5 class="text" style="color: black">Dirección: <?php echo $el['direccionR'] ?></h5>
                                       <h5 class="text" style="color: black">Telefono: <?php echo $el['telFR'] ?></h5>
                                       <h5 class="text" style="color: black">Celular: <?php echo $el['telMR'] ?></h5>
                                       <h5 class="text" style="color: black">Correo: <?php echo $el['correoR'] ?></h5>
                                       <h5 class="text" style="color: black">Correo Alternativo: <?php echo $el['correolR2'] ?></h5>
                                     </div><!--//summary-->
                                    <a href="../ModulK/modificarReferencia.php?cod=<?php echo $el['cod_referencai'] ?>" class="w3-btn w3-blue-gray"><i class="fa fa-edit"></i> Modificar</a>
                    <?php endforeach; ?>
                </dive><?php
                }?>
				</div>
				
         		 <hr>
          		 <a href="../ModulK/referencia.php" class="w3-btn w3-blue"><i class="fa fa-plus"></i> Nuevo</a>
            </section><!--//section-->

<?php
	$sql15="SELECT cod_curso, Nomb_curso, Nomb_Empre, fech_IniTra,fech_FinTra, pais FROM curri_cursos JOIN
	paises ON cod_pais = fk_pais where fk_userCursos=$cod";
	$array=$s->llenarSelect($sql15);
	$resultado=$conexion->prepare($sql15);
	$resultado->execute(array());
	$num_filas=$resultado->rowCount();
	$array1 = array_slice($array, 0, 2);
?>
            <section class="section experiences-section">
                <h2 class="section-title"><i class="fa fa-archive"></i>Cursos, Certificados, otros.</h2>
				<div>
 <?php foreach($array1 as $emen): ?>
                <div class="item">
                    <div class="meta">
                        <div class="upper-row">
                           <br>
                            <h3 class="job-title">Nombre del Curso: <?php echo $emen['Nomb_curso'] ?></h3>

                            <div class="time">Duracion: <?php echo $emen['fech_IniTra'] ?> &nbsp;&nbsp;-&nbsp;&nbsp; <?php echo $emen['fech_FinTra'] ?></div>
							<br>
							<h3 class="job-title">Por: <?php echo $emen['Nomb_Empre'] ?></h3>
							<br>
							<div class="job-title">País: <?php echo $emen['pais'] ?></div>
                        </div><!--//upper-row-->
                    </div><!--//meta-->

                </div><!--//item-->
                <a href="../ModulK/modificarCursos.php?cod=<?php echo $emen['cod_curso'] ?>" class="w3-btn w3-blue-gray"><i class="fa fa-edit"></i> Modificar</a>
 <?php endforeach; ?><br><br><?php 
                if($num_filas > 2 )
                {
                    $array2 = array_slice($array, 2);?>
                <button2 class="w3-btn">Mostrar Más</button2>
                <divo style="display:none;">
                    <?php foreach($array2 as $emen): ?>
                <div class="item">
                    <div class="meta">
                        <div class="upper-row">
                           <br>
                            <h3 class="job-title">Nombre del Curso: <?php echo $emen['Nomb_curso'] ?></h3>

                            <div class="time">Duracion: <?php echo $emen['fech_IniTra'] ?> &nbsp;&nbsp;-&nbsp;&nbsp; <?php echo $emen['fech_FinTra'] ?></div>
							<br>
							<h3 class="job-title">Por: <?php echo $emen['Nomb_Empre'] ?></h3>
							<br>
							<div class="job-title">País: <?php echo $emen['pais'] ?></div>
                        </div><!--//upper-row-->
                    </div><!--//meta-->

                </div><!--//item-->
                <a href="../ModulK/modificarCursos.php?cod=<?php echo $emen['cod_curso'] ?>" class="w3-btn w3-blue-gray"><i class="fa fa-edit"></i> Modificar</a>
 <?php endforeach; ?>
                </divo><?php
                }?>
				</div>
          		<hr>
           		<a href="../ModulE/Curri_Cursos.php" class="w3-btn w3-blue"><i class="fa fa-plus"></i> Nuevo</a>
            </section><!--//section-->

 <?php 
	$sql50="select habilidad, nombAplica, nivel from curriHabilidades join habilidades on cod_habilidad=fk_habilidad join aplicaciones on cod_aplicacion=fk_aplicacion
	join nivelidiom on cod_nivel=fk_nivelHabi where fk_userEmpleo=$cod";
	$array=$s->llenarSelect($sql50);
	$resultado=$conexion->prepare($sql50);
	$resultado->execute(array());
	$num_filas=$resultado->rowCount();
	$array1 = array_slice($array, 0, 4);
?>	           
            <section class="skills-section section">
                <h2 class="section-title"><i class="fa fa-rocket"></i>Habilidades Tecnicas</h2>
				<div>
<?php foreach($array1 as $habi): ?>
				<h4 class="level-title" style="color: black"><?php echo $habi['nombAplica'] ?></h4>
                <div class="progress">
					<?php if($habi['nivel']=="Básico")
					{ ?>
						<div class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width:25%">                                     
						25% <?php
					}
					elseif($habi['nivel']=="Intermedio")
					{ ?>
						<div class="progress-bar progress-bar-info progress-bar-striped" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:50%">                                     
						50% <?php
					}
					else
					{ ?>
						<div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">                                     
						100% <?php
					}
					?>
					</div><!--//level-bar-->                                 
                </div> 
<?php endforeach; ?><br><br><?php 
                if($num_filas > 2 )
                {
                    $array2 = array_slice($array, 4);?>
                <button3 class="w3-btn">Mostrar Más</button3>
                <diva style="display:none;">
                   <?php foreach($array2 as $habi): ?>
				<h4 class="level-title" style="color: black"><?php echo $habi['nombAplica'] ?></h4>
                <div class="progress">
					<?php if($habi['nivel']=="Básico")
					{ ?>
						<div class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width:25%">                                     
						25% <?php
					}
					elseif($habi['nivel']=="Intermedio")
					{ ?>
						<div class="progress-bar progress-bar-info progress-bar-striped" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:50%">                                     
						50% <?php
					}
					else
					{ ?>
						<div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">                                     
						100% <?php
					}
					?>
					</div><!--//level-bar-->                                 
                </div> 
<?php endforeach; ?>
                </diva><?php
                }?>
				</div>
				<hr>
				<a href="javascript:void(0)" onclick="document.getElementById('id03').style.display='block'" class="w3-btn w3-blue-gray"><i class="fa fa-edit"></i> Modificar</a>
				<a href="../ModulF/habilidades.php" class="w3-btn w3-blue"><i class="fa fa-plus"></i> Nuevo</a>
            </section><!--//skills-section-->

        </div><!--//main-body-->
    </div>
	</div>
</div>
</section>
<div id="id01" class="w3-modal" style="z-index:4">
  <div class="w3-modal-content w3-animate-zoom">
    <div class="w3-container w3-padding w3-blue">
       <span onclick="document.getElementById('id01').style.display='none'" class="w3-right w3-xxlarge w3-closebtn"><i class="fa fa-remove"></i></span>
      <h2>Cambiar Contraseña</h2>
    </div>
    <div class="w3-panel">
			<form class="" action="actualizarPass.php" method="post" >
			<fieldset>
      <label style="color:gray">Contraseña actual</label>
      <input class="w3-input w3-border w3-hover-shadow w3-margin-bottom" type="password" name="pass" id="pass" style="color:gray">
			<label class="col-md-4"></label>
	    <div style="color:gray" id="Info"></div><hr>
      <label style="color:gray">Contraseña Nueva</label>
      <input class="w3-input w3-border w3-hover-shadow  w3-margin-bottom" type="password" style="color:gray" name="nuevaPass">
      <label style="color:gray">Repetir Contraseña</label>
      <input class="w3-input w3-border w3-hover-shadow  w3-margin-bottom" type="password" style="color:gray" name="confirmarPass">
      <div class="w3-section">
				<div class="form-group">
					<a class="w3-btn w3-grey" onclick="document.getElementById('id01').style.display='none'">Cancel  <i class="fa fa-remove"></i></a>
					<button type="submit" class="w3-btn w3-right w3-blue">Cambiar  <i class="fa fa-paper-plane"></i></button>
				</div>
      </div>
			</fieldset>
			</form>
    </div>
  </div>
</div>
<div id="id02" class="w3-modal" style="z-index:4">
	<div class="w3-modal-content w3-animate-zoom">
		<div class="w3-container w3-padding w3-blue">
			 <span onclick="document.getElementById('id02').style.display='none'" class="w3-right w3-xxlarge w3-closebtn"><i class="fa fa-remove"></i></span>
			<h2>Cambiar Imagen de Perfil</h2>
		</div>
		<div class="w3-panel">
			<form class="" action="actualizarImagen.php" enctype="multipart/form-data" method="post" >
				<fieldset>
						<label style="color:gray">Imagen de perfil</label>
						<input name="imagen_Usuario" ID="Enviarimagen" type="file" size="20" class="file" data-preview-file-type="image" value="" accept='image/*'>
						<script>
						var $input = $("#Enviarimagen");
						$input.fileinput({
							showUpload: false,
						showRemove: false,
					});
					</script>
					<div class="w3-section">
						<div class="form-group">
							<a class="w3-btn w3-grey" onclick="document.getElementById('id02').style.display='none'">Cancel  <i class="fa fa-remove"></i></a>
							<button type="submit" class="w3-btn w3-right w3-blue">Cambiar  <i class="fa fa-paper-plane"></i></button>
						</div>
		      </div>
				</fieldset>
			</form>
		</div>
	</div>
</div>

 <?php 
	$sql51="select cod_curriHabi, habilidad, nombAplica, nivel from curriHabilidades join habilidades on cod_habilidad=fk_habilidad join aplicaciones on cod_aplicacion=fk_aplicacion
	join nivelidiom on cod_nivel=fk_nivelHabi where fk_userEmpleo=$cod";
	$array=$s->llenarSelect($sql51); 
?>	

<div id="id03" class="w3-modal" style="z-index:4">
	<div class="w3-modal-content w3-animate-zoom work-wrapper">
		<div class="w3-container w3-padding w3-blue">
			 <span onclick="document.getElementById('id03').style.display='none'" class="w3-right w3-xxlarge w3-closebtn"><i class="fa fa-remove"></i></span>
			<h2>Habilidades Tecnicas</h2>
		</div>
		<div class="w3-panel">
			<div style="height:300px; overflow:scroll;">
				<?php foreach($array as $hab): ?>
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
						<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6" >
							<h3 style="color:black;"><?php echo $hab['nombAplica'] ?></h3>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6" >
							<a class="w3-btn w3-blue" href="modificarHabilidad.php?cod=<?php echo $hab['cod_curriHabi'] ?>">Modificar</a>
						</div>
					</div>
				 <?php endforeach; ?>
			</div>
		</div>
	</div>
</div>

<?php
	require("../footer.php");
?>
</body>
</html>
<?php
ob_end_flush();
?>
