<?php
ob_start();
?>
<link id="theme-style" rel="stylesheet" href="../css/styles-6.css">
<script type="text/javascript" src="../js/main.js"></script>  
<link rel="stylesheet" href="../css/w3.css">
<script src="../js/sweetalert-dev.js"></script>
<link href="../css/sweetalert.css" rel="stylesheet" type="text/css"/>
<script src="../js/sweetalert.min.js"></script>
<link rel="stylesheet" href="../css/pagimacion.css">
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
<?php
	require ("nav.php");
	include "../lib/conexion.php";
	include "responderMensaje.php";
	$host=$_SERVER["HTTP_HOST"];
	$url=$_SERVER["REQUEST_URI"];
	$dire="http://" . $host . $url;
	if(!isset($_SESSION["cod_usuarioE"]))
	{
		echo '<script>
				window.location.href="../lib/permisosE.php'; echo '?url=';echo $dire;echo '"; 
			</script>';
		return;
		
	}
	if(!isset($_GET["cod"]))
	{
		require("../lib/permisosG.php");
		return;
	}
	
	$cod=$_GET["cod"];
	$codp=$_GET['codP'];
	
	$tamano_paginas=1;
	if(isset($_GET["pagina"])){
		if($_GET["pagina"]==1){
			$pagina=1;
			//header("Location:index.php");
		}else{
			$pagina=$_GET["pagina"];
			if($pagina <= 0){
				$pagina = 1;
			}
		}
	}else{
		$pagina=1;
		$sqlm="select DISTINCT cod_envio,apellidos, cod_empleo,email_user,direccion,Fech_regisUser,Fech_Naci,img_perfil,nombres,identidadC,sexo,tel_fijo,tel_movil,depart,nacionalidad,muni
		from usuarios_empleo join departamentos on cod_depart=fk_departamento join nacionalidades on cod_nacion=fk_nacionalida join municipios on cod_muni=fk_municipio join enviocurri on cod_empleo=fk_userDesem
		where cod_empleo=$cod and fk_propuesta=$codp";
	}

	$empezar_desde=($pagina-1)*$tamano_paginas;
	$sql3="select DISTINCT cod_envio,apellidos, cod_empleo,email_user,direccion,Fech_regisUser,Fech_Naci,img_perfil,nombres,identidadC,sexo,tel_fijo,tel_movil,depart,nacionalidad,muni
	from usuarios_empleo join departamentos on cod_depart=fk_departamento join nacionalidades on cod_nacion=fk_nacionalida join municipios on cod_muni=fk_municipio join enviocurri on cod_empleo=fk_userDesem
	where fk_propuesta=$codp";

	$resultado=$conexion->prepare($sql3);
	$resultado->execute(array());
	$num_filas=$resultado->rowCount();
	$total_paginas=ceil($num_filas/$tamano_paginas);
	if($pagina > $total_paginas){
		$pagina = $total_paginas;
	}
	if($pagina < 1){
		$pagina = 1;
	}
	
	$resul2=new Llenado_Select();
	if(isset($sqlm))
	{
		
		$array2=$resul2->llenarSelect($sqlm);
	}
	else
	{
		$sql="select DISTINCT cod_envio,apellidos, cod_empleo,email_user,direccion,Fech_regisUser,Fech_Naci,img_perfil,nombres,identidadC,sexo,tel_fijo,tel_movil,depart,nacionalidad,muni
		from usuarios_empleo join departamentos on cod_depart=fk_departamento join nacionalidades on cod_nacion=fk_nacionalida join municipios on cod_muni=fk_municipio join enviocurri on cod_empleo=fk_userDesem
		where fk_propuesta=$codp LIMIT $empezar_desde,$tamano_paginas";
		$array2=$resul2->llenarSelect($sql);
	}
	
	foreach($array2 as $elemento):
	endforeach;
?>
<section id="team" >
	<div class="container">
		<div class="row text-center header animate-in" data-anim-type="fade-in-up">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<h3 class="text">Curriculo</h3>
				<a class="w3-btn w3-blue" href="javascript:void(0)" onclick="document.getElementById('id01').style.display='block'"><i class="fa fa-envelope"></i> Enviar Mensaje</a>
			</div>
		</div>
<div class="row animate-in" data-anim-type="fade-in-up">
		<div class="wrapper">
        <div class="sidebar-wrapper">
            <div class="profile-container">
                <img class="profile img-circle" src="../Imagenes_Users/<?php echo $elemento['img_perfil'] ?>" alt="" />
                <h1 class="name"><?php echo $elemento['nombres'] ?><br><?php echo $elemento['apellidos'];?></h1>
                <h3 class="tagline"><?php echo $elemento['identidadC'] ?></h3>
            </div><!--//profile-container-->
            
            <div class="contact-container container-block">
                <ul class="list-unstyled contact-list">
                    <li class="email"><i class="fa fa-envelope"></i><a href=""><?php echo $elemento['email_user'] ?></a></li>
                    <li class="phone"><i class="fa fa-phone-square"></i><a href=""><?php echo $elemento['tel_fijo'] ?></a></li>
                    <li class="phone"><i class="fa fa-phone"></i><a href=""><?php echo $elemento['tel_movil'] ?></a></li>
                    <li class="website"><i class="fa fa-calendar"></i><?php echo $elemento['Fech_Naci'] ?></li>
					<li class="github"><i class="fa fa-map"></i><?php echo $elemento['nacionalidad'] ?></li>
					<li class="github"><i class="fa fa-map"></i><?php echo $elemento['depart'] ?></li>
					<li class="github"><i class="fa fa-map"></i><?php echo $elemento['muni'] ?></li>
                    <li class="linkedin"><i class="fa fa-map"></i><?php echo $elemento['direccion'] ?></li>
                </ul>
            </div><!--//contact-container-->
<?php 
	$sql3="select * from educacion where fk_userEdu=$cod";
	$array=$resul2->llenarSelect($sql3); 
?>
            <div class="education-container container-block">
                <h2 class="container-block-title">Educación</h2>
 <?php foreach($array as $element): ?> 
                <div class="item">
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
 <?php endforeach; ?> 
            </div><!--//education-container-->
 <?php 
	$sq="select idioma, nivel from idioma join curri_idioma on idioma.cod_idioma=fk_idioma join nivelidiom on cod_nivel=fk_nivel where fk_userIdioma=$cod";
	$array=$resul2->llenarSelect($sq); 
?>
            <div class="languages-container container-block">
                <h2 class="container-block-title">Lenguajes</h2>
                <ul class="list-unstyled interests-list">
				 <?php foreach($array as $ww): ?>
                    <li><?php echo $ww['idioma']?> (<?php echo $ww['nivel'] ?>)<span class="lang-desc"></span></li>
				 <?php endforeach; ?> 
                </ul>
            </div><!--//interests-->         
        </div><!--//sidebar-wrapper--> 
            
        <div class="main-wrapper">
<?php 
	$sql4="SELECT cod_curri, Nomb_Empre, fech_FinTra, fech_IniTra, Nomb_EscriPuesto, descrip_Funcio,fk_actividad,fk_categ,fk_puesto, 
	puesto, pais, rubro, catego FROM curri_expelabo JOIN puestos ON cod_Puesto = fk_puesto JOIN paises ON 
	cod_pais = fk_pais JOIN rubros ON cod_rubro = fk_actividad JOIN categorias ON cod_catego = fk_categ where fk_userExpeLbo=$cod";
	$array=$resul2->llenarSelect($sql4); 
?>
            <section class="section experiences-section">
                <h2 class="section-title"><i class="fa fa-briefcase"></i>Experiencia Laboral</h2>
 <?php foreach($array as $elemen): ?>
                <div class="item">
                    <div class="meta">
                        <div class="upper-row">
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
 <?php endforeach; ?>
            </section><!--//section-->
  
			<section class="section summary-section">
				<?php 
					$sql5="select * from referencia where fk_userRefe=$cod";
					$array=$resul2->llenarSelect($sql5); 
				?>
					<h2 class="section-title"><i class="fa fa-user"></i>Referencia</h2>
				<?php foreach($array as $el): ?>
						<div class="summary">
							<h5 class="text" style="color: black">Nombres: <?php echo $el['nombreR'] ?></h5>
							<h5 class="text" style="color: black">Apellidos: <?php echo $el['apellidoR'] ?></h5>
							<h5 class="text" style="color: black">Numero de Identidad: <?php echo $el['identidadR'] ?></h5>
							<h5 class="text" style="color: black">Dirección: <?php echo $el['direccionR'] ?></h5>
							<h5 class="text" style="color: black">Telefono: <?php echo $el['telFR'] ?></h5>
							<h5 class="text" style="color: black">Celular: <?php echo $el['telMR'] ?></h5>
							<h5 class="text" style="color: black">Correo: <?php echo $el['correoR'] ?></h5>
							<h5 class="text" style="color: black">Correo Alternativo: <?php echo $el['correolR2'] ?></h5>
						</div><!--//summary-->
				<?php endforeach; ?>
			</section><!--//section-->

<?php 
	$sql5="SELECT cod_curso, Nomb_curso, Nomb_Empre, fech_IniTra,fech_FinTra, pais FROM curri_cursos JOIN 
	paises ON cod_pais = fk_pais where fk_userCursos=$cod";
	$array=$resul2->llenarSelect($sql5); 
?>			
            <section class="section experiences-section">
                <h2 class="section-title"><i class="fa fa-archive"></i>Cursos, Certificados, otros.</h2>
					 <?php foreach($array as $emen): ?>
									<div class="item">
										<div class="meta">
											<div class="upper-row">
												<h3 class="job-title">Nombre del Curso: <?php echo $emen['Nomb_curso'] ?></h3>

												<div class="time">Duracion: <?php echo $emen['fech_IniTra'] ?> &nbsp;&nbsp;-&nbsp;&nbsp; <?php echo $emen['fech_FinTra'] ?></div>
												<br>
												<h3 class="job-title">Por: <?php echo $emen['Nomb_Empre'] ?></h3>
												<br>
												<div class="job-title">País: <?php echo $emen['pais'] ?></div>
											</div><!--//upper-row--> 
										</div><!--//meta-->
										
									</div><!--//item-->    
					 <?php endforeach; ?>
            </section><!--//section-->
            
            <section class="skills-section section">
                <h2 class="section-title"><i class="fa fa-rocket"></i>Skills &amp; Proficiency</h2>
                <div class="skillset">        
                    <div class="item">
                        <h3 class="level-title" style="color: black">Python &amp; Django</h3>
                        <div class="level-bar">
                            <div class="level-bar-inner" data-level="28%">
                            </div>                                      
                        </div><!--//level-bar-->                                 
                    </div><!--//item-->
                    
                    <div class="item">
                        <h3 class="level-title" style="color: black">Javascript &amp; jQuery</h3>
                        <div class="level-bar">
                            <div class="level-bar-inner" data-level="40%">
                            </div>                                      
                        </div><!--//level-bar-->                                 
                    </div><!--//item-->
                    
                    <div class="item">
                        <h3 class="level-title" style="color: black">Angular</h3>
                        <div class="level-bar">
                            <div class="level-bar-inner" data-level="5%">
                            </div>                                      
                        </div><!--//level-bar-->                                 
                    </div><!--//item-->
                    
                    <div class="item">
                        <h3 class="level-title" style="color: black">HTML5 &amp; CSS</h3>
                        <div class="level-bar">
                            <div class="level-bar-inner" data-level="70%">
                            </div>                                      
                        </div><!--//level-bar-->                                 
                    </div><!--//item-->
                    
                    <div class="item">
                        <h3 class="level-title" style="color: black">Ruby on Rails</h3>
                        <div class="level-bar">
                            <div class="level-bar-inner" data-level="1%">
                            </div>                                      
                        </div><!--//level-bar-->                                 
                    </div><!--//item-->
                    
                    <div class="item">
                        <h3 class="level-title" style="color: black">Sketch &amp; Photoshop</h3>
                        <div class="level-bar">
                            <div class="level-bar-inner" data-level="60%">
                            </div>                                      
                        </div><!--//level-bar-->                                 
                    </div><!--//item-->
                    
                </div>  
            </section><!--//skills-section-->
            
        </div><!--//main-body-->
    </div>
	</div>
</div><div id="id01" class="w3-modal" style="z-index:4">
  <div class="w3-modal-content w3-animate-zoom">
    <div class="w3-container w3-padding w3-blue">
       <span onclick="document.getElementById('id01').style.display='none'" class="w3-right w3-xxlarge w3-closebtn"><i class="fa fa-remove"></i></span>
	<form action="responderMensaje.php" method="post" role="form" class="contactForm">
      <h2>Enviar Mensaje</h2>
    </div>
    <div class="w3-panel">
	  <div class="input-group">
		  <input  name="cod" id="cod" class="form-control" value="<?php echo $cod ?>" type=hidden>
		  <input  name="codP" id="codP" class="form-control" value="<?php echo $codp ?>" type=hidden>
	  </div>
      <label style="color:black;">Para</label>
      <input class="w3-input w3-border w3-hover-shadow w3-margin-bottom" value="<?php echo $elemento['nombres'] ?>" name="nombre" type="text" style="color:black;"  disabled>
      <input  name="para" id="para" class="form-control" value="<?php echo $elemento['cod_empleo'] ?>" type=hidden>
      <label style="color:black;">Asunto</label>
      <input class="w3-input w3-border w3-hover-shadow  w3-margin-bottom" placeholder="Escriba su asunto aquí" name="asunto" type="text" style="color:black;">
      <label style="color:black;">Mensaje</label>
	  <textarea class="w3-input w3-border w3-hover-shadow  w3-margin-bottom" name="texto" style="height:150px; color:black;" placeholder="Escriba su mensaje aquí"></textarea>
      <div class="w3-section">
		<a class="w3-btn w3-gray" onclick="document.getElementById('id01').style.display='none'">Cancelar  <i class="fa fa-remove"></i></a>
		<button type="submit" class="w3-btn w3-right w3-blue">Enviar  <i class="fa fa-paper-plane"></i></button> 
		</form>
      </div>    
    </div>
  </div>
</div>
</section>	
<?php	
	$codp=$_GET['codP'];
//	$sql="select DISTINCT cod_envio,apellidos, cod_empleo,email_user,direccion,Fech_regisUser,Fech_Naci,img_perfil,nombres,identidadC,sexo,tel_fijo,tel_movil,depart,nacionalidad,muni
//	from usuarios_empleo join departamentos on cod_depart=fk_departamento join nacionalidades on cod_nacion=fk_nacionalida join municipios on cod_muni=fk_municipio join enviocurri on cod_empleo=fk_userDesem
//	where fk_propuesta=$codp and cod_empleo!=$cod LIMIT $empezar_desde,$tamano_paginas";
//	$resul=new Llenado_Select();
//	$array=$resul->llenarSelect($sql);
	
	if(isset($_GET["codP"]))
	{
		$codP=$_GET["codP"];
		$sql2="update enviocurri set visto=1 where fk_userDesem=?  and fk_propuesta=?";
		$insert= $conexion->prepare($sql2);
		$insert->execute(array($cod,$codP));
	}
	
	
/*	foreach($array as $elementos)
	{
		?>
<section id="team" >
	<div class="container">
		<div class="row text-center header animate-in" data-anim-type="fade-in-up">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<h3 class="text">Curriculo</h3>
				<a class="w3-btn w3-blue" href="javascript:void(0)" onclick="document.getElementById('id01').style.display='block'"><i class="fa fa-envelope"></i> Enviar Mensaje</a>
			</div>
		</div>
<div class="row animate-in" data-anim-type="fade-in-up">
		<div class="wrapper">
        <div class="sidebar-wrapper">
            <div class="profile-container">
                <img class="profile img-circle" src="../Imagenes_Users/<?php echo $elementos['img_perfil'] ?>" alt="" />
                <h1 class="name"><?php echo $elementos['nombres'] ?><br><?php echo $elementos['apellidos']; echo count($array)?></h1>
                <h3 class="tagline"><?php echo $elementos['identidadC'] ?></h3>
            </div><!--//profile-container-->
            
            <div class="contact-container container-block">
                <ul class="list-unstyled contact-list">
                    <li class="email"><i class="fa fa-envelope"></i><a href=""><?php echo $elementos['email_user'] ?></a></li>
                    <li class="phone"><i class="fa fa-phone-square"></i><a href=""><?php echo $elementos['tel_fijo'] ?></a></li>
                    <li class="phone"><i class="fa fa-phone"></i><a href=""><?php echo $elementos['tel_movil'] ?></a></li>
                    <li class="website"><i class="fa fa-calendar"></i><?php echo $elementos['Fech_Naci'] ?></li>
					<li class="github"><i class="fa fa-map"></i><?php echo $elementos['nacionalidad'] ?></li>
					<li class="github"><i class="fa fa-map"></i><?php echo $elementos['depart'] ?></li>
					<li class="github"><i class="fa fa-map"></i><?php echo $elementos['muni'] ?></li>
                    <li class="linkedin"><i class="fa fa-map"></i><?php echo $elementos['direccion'] ?></li>
                </ul>
            </div><!--//contact-container-->

<?php 
	$sql3="select * from educacion where fk_userEdu=$cod";
	$array=$resul->llenarSelect($sql3); 
?>


            <div class="education-container container-block">
                <h2 class="container-block-title">Educación</h2>
 <?php foreach($array as $element): ?> 
                <div class="item">
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
 <?php endforeach; ?> 
            </div><!--//education-container-->
 <?php 
	$sq="select idioma, nivel from idioma join curri_idioma on idioma.cod_idioma=fk_idioma join nivelidiom on cod_nivel=fk_nivel where fk_userIdioma=$cod";
	$array=$resul->llenarSelect($sq); 
?>
            <div class="languages-container container-block">
                <h2 class="container-block-title">Lenguajes</h2>
                <ul class="list-unstyled interests-list">
				 <?php foreach($array as $ww): ?>
                    <li><?php echo $ww['idioma']?> (<?php echo $ww['nivel'] ?>)<span class="lang-desc"></span></li>
				 <?php endforeach; ?> 
                </ul>
            </div><!--//interests-->         
        </div><!--//sidebar-wrapper--> 
            
        <div class="main-wrapper">
<?php 
	$sql4="sELECT cod_curri, Nomb_Empre, fech_FinTra, fech_IniTra, Nomb_EscriPuesto, descrip_Funcio,fk_actividad,fk_categ,fk_puesto, 
	puesto, pais, rubro, catego FROM curri_expelabo JOIN puestos ON cod_Puesto = fk_puesto JOIN paises ON 
	cod_pais = fk_pais JOIN rubros ON cod_rubro = fk_actividad JOIN categorias ON cod_catego = fk_categ where fk_userExpeLbo=$cod";
	$array=$resul->llenarSelect($sql4); 
?>
            <section class="section experiences-section">
                <h2 class="section-title"><i class="fa fa-briefcase"></i>Experiencia Laboral</h2>
 <?php foreach($array as $elemen): ?>
                <div class="item">
                    <div class="meta">
                        <div class="upper-row">
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
 <?php endforeach; ?>
            </section><!--//section-->
  
			<section class="section summary-section">
				<?php 
					$sql5="select * from referencia where fk_userRefe=$cod";
					$array=$resul->llenarSelect($sql5); 
				?>
					<h2 class="section-title"><i class="fa fa-user"></i>Referencia</h2>
				<?php foreach($array as $el): ?>
						<div class="summary">
							<h5 class="text" style="color: black">Nombres: <?php echo $el['nombreR'] ?></h5>
							<h5 class="text" style="color: black">Apellidos: <?php echo $el['apellidoR'] ?></h5>
							<h5 class="text" style="color: black">Numero de Identidad: <?php echo $el['identidadR'] ?></h5>
							<h5 class="text" style="color: black">Dirección: <?php echo $el['direccionR'] ?></h5>
							<h5 class="text" style="color: black">Telefono: <?php echo $el['telFR'] ?></h5>
							<h5 class="text" style="color: black">Celular: <?php echo $el['telMR'] ?></h5>
							<h5 class="text" style="color: black">Correo: <?php echo $el['correoR'] ?></h5>
							<h5 class="text" style="color: black">Correo Alternativo: <?php echo $el['correolR2'] ?></h5>
						</div><!--//summary-->
				<?php endforeach; ?>
			</section><!--//section-->

<?php 
	$sql5="SELECT cod_curso, Nomb_curso, Nomb_Empre, fech_IniTra,fech_FinTra, pais FROM curri_cursos JOIN 
	paises ON cod_pais = fk_pais where fk_userCursos=$cod";
	$array=$resul->llenarSelect($sql5); 
?>			
            <section class="section experiences-section">
                <h2 class="section-title"><i class="fa fa-archive"></i>Cursos, Certificados, otros.</h2>
					 <?php foreach($array as $emen): ?>
									<div class="item">
										<div class="meta">
											<div class="upper-row">
												<h3 class="job-title">Nombre del Curso: <?php echo $emen['Nomb_curso'] ?></h3>

												<div class="time">Duracion: <?php echo $emen['fech_IniTra'] ?> &nbsp;&nbsp;-&nbsp;&nbsp; <?php echo $emen['fech_FinTra'] ?></div>
												<br>
												<h3 class="job-title">Por: <?php echo $emen['Nomb_Empre'] ?></h3>
												<br>
												<div class="job-title">País: <?php echo $emen['pais'] ?></div>
											</div><!--//upper-row--> 
										</div><!--//meta-->
										
									</div><!--//item-->    
					 <?php endforeach; ?>
            </section><!--//section-->
            
            <section class="skills-section section">
                <h2 class="section-title"><i class="fa fa-rocket"></i>Skills &amp; Proficiency</h2>
                <div class="skillset">        
                    <div class="item">
                        <h3 class="level-title" style="color: black">Python &amp; Django</h3>
                        <div class="level-bar">
                            <div class="level-bar-inner" data-level="28%">
                            </div>                                      
                        </div><!--//level-bar-->                                 
                    </div><!--//item-->
                    
                    <div class="item">
                        <h3 class="level-title" style="color: black">Javascript &amp; jQuery</h3>
                        <div class="level-bar">
                            <div class="level-bar-inner" data-level="40%">
                            </div>                                      
                        </div><!--//level-bar-->                                 
                    </div><!--//item-->
                    
                    <div class="item">
                        <h3 class="level-title" style="color: black">Angular</h3>
                        <div class="level-bar">
                            <div class="level-bar-inner" data-level="5%">
                            </div>                                      
                        </div><!--//level-bar-->                                 
                    </div><!--//item-->
                    
                    <div class="item">
                        <h3 class="level-title" style="color: black">HTML5 &amp; CSS</h3>
                        <div class="level-bar">
                            <div class="level-bar-inner" data-level="70%">
                            </div>                                      
                        </div><!--//level-bar-->                                 
                    </div><!--//item-->
                    
                    <div class="item">
                        <h3 class="level-title" style="color: black">Ruby on Rails</h3>
                        <div class="level-bar">
                            <div class="level-bar-inner" data-level="1%">
                            </div>                                      
                        </div><!--//level-bar-->                                 
                    </div><!--//item-->
                    
                    <div class="item">
                        <h3 class="level-title" style="color: black">Sketch &amp; Photoshop</h3>
                        <div class="level-bar">
                            <div class="level-bar-inner" data-level="60%">
                            </div>                                      
                        </div><!--//level-bar-->                                 
                    </div><!--//item-->
                    
                </div>  
            </section><!--//skills-section-->
            
        </div><!--//main-body-->
    </div>
	</div>
</div><div id="id01" class="w3-modal" style="z-index:4">
  <div class="w3-modal-content w3-animate-zoom">
    <div class="w3-container w3-padding w3-blue">
       <span onclick="document.getElementById('id01').style.display='none'" class="w3-right w3-xxlarge w3-closebtn"><i class="fa fa-remove"></i></span>
	<form action="ResponderMensaje.php" method="post" role="form" class="contactForm">
      <h2>Enviar Mensaje</h2>
    </div>
    <div class="w3-panel">
	  <div class="input-group">
		  <input  name="cod" id="cod" class="form-control" value="<?php echo $cod ?>" type=hidden>
	  </div>
      <label style="color:black;">Para</label>
      <input class="w3-input w3-border w3-hover-shadow w3-margin-bottom" value="<?php echo $elementos['nombres'] ?>" name="nombre" type="text" style="color:black;"  disabled>
      <input  name="para" id="para" class="form-control" value="<?php echo $elementos['cod_empleo'] ?>" type=hidden>
      <label style="color:black;">Asunto</label>
      <input class="w3-input w3-border w3-hover-shadow  w3-margin-bottom" placeholder="Escriba su asunto aquí" name="asunto" type="text" style="color:black;">
      <label style="color:black;">Mensaje</label>
	  <textarea class="w3-input w3-border w3-hover-shadow  w3-margin-bottom" name="texto" style="height:150px; color:black;" placeholder="Escriba su mensaje aquí"></textarea>
      <div class="w3-section">
		<a class="w3-btn w3-gray" onclick="document.getElementById('id01').style.display='none'">Cancelar  <i class="fa fa-remove"></i></a>
		<button type="submit" class="w3-btn w3-right w3-blue">Enviar  <i class="fa fa-paper-plane"></i></button> 
		</form>
      </div>    
    </div>
  </div>
</div>
</section>	

<?php

	} */
	?>
	<div class="row text-center header animate-in" data-anim-type="fade-in-up">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<h4 class="text">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Paginas</h4>
				<div class="pagination">
				<?php $paginate_max = 4;
					if($num_filas != 0){
						$nextpage = $pagina + 1;
						$prevpage = $pagina - 1;
						$spmin = ($pagina > $paginate_max) ? ($pagina - $paginate_max) : 1;
						$spmax = ($pagina < ($total_paginas - $paginate_max)) ? ($pagina + $paginate_max) : $total_paginas;
				?><ul id="pagination-digg"><?php
						if($pagina == 1)
						{ 
						 ?>
						<!--	<li class="previous-off"><a style="font-size:15px">&laquo; Anterior</a></li> -->
							<li class="active"><a style="font-size:15px">1</a></li>
					<?php 
						for($i=$spmin; $i<=$spmax; $i++)
						{ 
							if($i != 1)
							{
								if($i < 8)
								{ ?>
								<li><a class="text" href="?cod=<?php echo $cod ?>&codP=<?php echo $codp ?>&pagina=<?php echo $i ?>" style="font-size:15px"><?php echo $i ?></a></li><?php
								}
							}
					?>
					<?php } 
							if($total_paginas > $pagina)
							{ ?>
								<li class="next"><a class="text" href="?cod=<?php echo $cod ?>&codP=<?php echo $codp ?>&pagina=<?php echo $nextpage ?>" style="font-size:15px">&raquo;</a></li>
								<li class="next"><a class="text" href="?cod=<?php echo $cod ?>&codP=<?php echo $codp ?>&pagina=<?php echo $total_paginas ?>" style="font-size:15px">&raquo;&raquo;</a></li><?php
							}
							else
							{ ?>		
								<!-- <li class="next-off">Siguiente &raquo;</li> -->
						<?php
							}
						}
						else
						{ 
						?>
							<li class="previous"><a class="text" href="?cod=<?php echo $cod ?>&codP=<?php echo $codp ?>&pagina=1" style="font-size:15px">&laquo;&laquo;</a></li>
							<li class="previous"><a class="text" href="?cod=<?php echo $cod ?>&codP=<?php echo $codp ?>&pagina=<?php echo $prevpage ?>" style="font-size:15px">&laquo;</a></li><?php
							for($i=$spmin; $i<=$spmax; $i++)
							{
								if($pagina == $i)
								{
							?>		<li class="active"><a style="font-size:15px"><?php echo $i ?></a></li><?php
								}
								else
								{
							?>		<li><a class="text" href="?cod=<?php echo $cod ?>&codP=<?php echo $codp ?>&pagina=<?php echo $i ?>" style="font-size:15px"><?php echo $i ?></a></li><?php
								}
							}
						 	if($total_paginas > $pagina)
							{ ?>
								<li class="next"><a class="text" href="?cod=<?php echo $cod ?>&codP=<?php echo $codp ?>&pagina=<?php echo $nextpage ?>" style="font-size:15px">&raquo;</a></li>
								<li class="next"><a class="text" href="?cod=<?php echo $cod ?>&codP=<?php echo $codp ?>&pagina=<?php echo $total_paginas ?>" style="font-size:15px">&raquo;&raquo;</a></li><?php
							}
						 	else
							{
						?>		<!-- <li class="next-off"><a style="font-size:15px">Sigiente &raquo;</a></li> --><?php	
							}
						}
					?></ul>
				</div><?php 
					} ?>
			</div>
		</div><?php
	require("../footer.php");
    ob_end_flush();
?>
