<?php
ob_start();
    // error_reporting(E_ALL);
    // ini_set('display_errors', '1');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Historial de visitas</title>
        <?php
            require("../lib/movil.php");
            require("nav.php");
        ?>
        <link href="../css/Media.css" rel="stylesheet" />
        <link rel="stylesheet" href="../css/w3.css">
        <link rel="stylesheet" href="../css/pagimacion.css">
        <style>
            .badge
            {
                background-color: #F00000;
            }
        </style>
    </head>
    <body>
        <?php
            
            $w=new Llenado_Select();
            require("../lib/conexion.php");
            
            $tamano_paginas=4;
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
        	}
            
            
            $host=$_SERVER["HTTP_HOST"];
            $url=$_SERVER["REQUEST_URI"];
            $dire="http://" . $host . $url;

            if(!isset($_SESSION["cod_usuario"]))
            {
                echo '<script>
                    window.location.href="../lib/permisosu.php'; echo '?url=';echo $dire;echo '"; 
                </script>';
                return;
            }
            
            
            $empezar_desde=($pagina-1)*$tamano_paginas;
        $sql3="select imagen, nomb_empre, num_visitas, fecha 
                  from contadorempre join usuarios_empre on contadorempre.cod_visitante = usuarios_empre.cod_usuario 
                  where contadorempre.cod_perfil = '$cod'";
        $resultado=$conexion->prepare($sql3);
        $resultado->execute(array());
        $num_filas=$resultado->rowCount();
            
            
            $cod=htmlentities(addslashes($_SESSION["cod_usuario"]));

            $sql="select imagen, nomb_empre, num_visitas, fecha 
                  from contadorempre join usuarios_empre on contadorempre.cod_visitante = usuarios_empre.cod_usuario 
                  where contadorempre.cod_perfil = '$cod'";

            $resul= $conexion->prepare($sql);

            // $resul->bindValue();

            $resul->execute(array());

            $numViEmp = $resul->rowCount();
            
            $total_paginas=ceil($numViEmp/$tamano_paginas);
        	if($pagina > $total_paginas){
        		$pagina = $total_paginas;
        	}
        	if($pagina < 1){
        		$pagina = 1;
        	}
        	
        // 	$sqlU="update contadorempre set estado=0 where caducidadP <'$dia'";
        // 	$resultado=$conexion->prepare($sqlU);
        // 	$resultado->execute();
        	
        	$sql2="select imagen, nomb_empre, num_visitas, fecha from contadorempre join usuarios_empre on contadorempre.cod_visitante = usuarios_empre.cod_usuario 
        	            where contadorempre.cod_perfil = $cod LIMIT $empezar_desde,$tamano_paginas";

            $array=$w->llenarSelect($sql2);
            
            ?>
            
            <section id="services" >
            <div class="container">
                <div class="row text-center header">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 animate-in" data-anim-type="fade-in-up">
                        <h3 class="text">NUMERO DE VISITAS</h3>
                    </div>
                </div>
                
            <?php
            
            if($numViEmp != 0){
                
                foreach($array as $elementos): 
            ?>
                
                <div class="container">
        			<div class="row text-center header" data-anim-type="fade-in-up" style="padding-bottom: 0px;">
        			    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
        			        
        			    </div>
        				<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                            
                            <div class="services-wrapper" style="padding: 10px; margin-bottom: 10px;">
                                <div class="media">
                                    <div class="media-left">
                                        <img src="../Imagenes_Empre/<?php echo $elementos['imagen'] ?>" class="media-object" style="width:100px; height: 50px;">
                                    </div>
                                    <div class="media-body">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <h4 class="media-heading media-left">Nombre de empresa: <?php echo $elementos['nomb_empre'] ?></h4>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <h5 class="media-heading media-left" style="margin-bottom: 5px;"> Fecha de visita: <?php echo $elementos['fecha'] ?></h5>
                                        </div>
                                    </div>
                                    <div class="media-right" style="padding-right: 40px;">
                                        <h3><spam class="label label-primary"> <?php echo $elementos['num_visitas'] ?></spam></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
        			        
        			    </div>
                    </div>
                </div>
                
                <?php  endforeach; 
                
                    if($num_filas <=4)
                    {
        	        }
        	        else
        	        {
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
        								<li><a class="text" href="?pagina=<?php echo $i ?>" style="font-size:15px"><?php echo $i ?></a></li><?php
        								}
        							}
        					?>
        					<?php }
        							if($total_paginas > $pagina)
        							{ ?>
        								<li class="next"><a class="text" href="?pagina=<?php echo $nextpage ?>" style="font-size:15px">&raquo;</a></li>
        								<li class="next"><a class="text" href="?pagina=<?php echo $total_paginas ?>" style="font-size:15px">&raquo;&raquo;</a></li><?php
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
        							<li class="previous"><a class="text" href="?pagina=1" style="font-size:15px">&laquo;&laquo;</a></li>
        							<li class="previous"><a class="text" href="?pagina=<?php echo $prevpage ?>" style="font-size:15px">&laquo;</a></li><?php
        							for($i=$spmin; $i<=$spmax; $i++)
        							{
        								if($pagina == $i)
        								{
        							?>		<li class="active"><a style="font-size:15px"><?php echo $i ?></a></li><?php
        								}
        								else
        								{
        							?>		<li><a class="text" href="?pagina=<?php echo $i ?>" style="font-size:15px"><?php echo $i ?></a></li><?php
        								}
        							}
        						 	if($total_paginas > $pagina)
        							{ ?>
        								<li class="next"><a class="text" href="?pagina=<?php echo $nextpage ?>" style="font-size:15px">&raquo;</a></li>
        								<li class="next"><a class="text" href="?pagina=<?php echo $total_paginas ?>" style="font-size:15px">&raquo;&raquo;</a></li><?php
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
        		</div>
                <?php
        	        }
        	    ?>   
            </div>
        </section>

        <?php 
                
            }else
            { 
                
        ?>
            
                <div class="container">
            	    <div class="row text-center header" data-anim-type="fade-in-up">
            			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            				    
        					<div class="services-wrapper" style="padding-top:30px">
        						<h2><i class="fa fa-warning fa-2x"></i> No existen historial en estos momentos</h2>
        					</div>
        					
        				</div>
        			</div>
        		</div>
                
        <?php
        
            }
            
        ?>
    </body>
</html>