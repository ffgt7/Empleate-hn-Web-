<link id="theme-style" rel="stylesheet" href="../css/styles-6.css"> 
<script type="text/javascript" src="../js/main.js"></script>  

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
	require("../lib/permisosE.php");
//	require "../lib/Llenado_Select.php";
	require "../ModulE/visitasEmpre.php";
	
	$cod=$_GET["cod"];
	$sql="select apellidos, cod_empleo,email_user,direccion,Fech_regisUser,Fech_Naci,img_perfil,nombres,identidadC,sexo,tel_fijo,tel_movil,depart,nacionalidad,muni
	from usuarios_empleo join departamentos on cod_depart=fk_departamento join nacionalidades on cod_nacion=fk_nacionalida join municipios on cod_muni=fk_municipio
	where cod_empleo=$cod";
	$resul=new Llenado_Select();
	$array=$resul->llenarSelect($sql);
	
	foreach($array as $elementos):
	endforeach; 
?>
<section id="team" >
	<div class="container">
		<div class="row text-center header animate-in" data-anim-type="fade-in-up">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<h3 class="text">Curriculo</h3>
				<hr />
				
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
                <div style="height:300px; overflow:scroll; overflow-x:hidden;">
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
                </div>
            </section><!--//section-->
  
			<section class="section summary-section">
				<?php 
					$sql5="select * from referencia where fk_userRefe=$cod";
					$array=$resul->llenarSelect($sql5); 
				?>
					<h2 class="section-title"><i class="fa fa-user"></i>Referencia</h2>
					<div style="height:300px; overflow:scroll; overflow-x:hidden;">
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
				    </div>
			</section><!--//section-->

<?php 
	$sql5="SELECT cod_curso, Nomb_curso, Nomb_Empre, fech_IniTra,fech_FinTra, pais FROM curri_cursos JOIN 
	paises ON cod_pais = fk_pais where fk_userCursos=$cod";
	$array=$resul->llenarSelect($sql5); 
?>			
            <section class="section experiences-section">
                <h2 class="section-title"><i class="fa fa-archive"></i>Cursos, Certificados, otros.</h2>
                    <div style="height:230px; overflow:scroll; overflow-x:hidden;">
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
					 </div>
            </section><!--//section-->
 <?php 
	$sql50="select habilidad, nombAplica, nivel from curriHabilidades join habilidades on cod_habilidad=fk_habilidad join aplicaciones on cod_aplicacion=fk_aplicacion
	join nivelidiom on cod_nivel=fk_nivelHabi where fk_userEmpleo=$cod";
	$array=$resul->llenarSelect($sql50); 
?>	           
            <section class="skills-section section">
                <h2 class="section-title"><i class="fa fa-rocket"></i>Habilidades Tecnicas</h2>
                <div style="height:300px; overflow:scroll; overflow-x:hidden;">
<?php foreach($array as $habi): ?>
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
                </div>
            </section><!--//skills-section-->
            
        </div><!--//main-body-->
    </div>
	</div>
</div>
</section>