<?php
ob_start();
function enviarPropuesta($nombreP,$cod){

    require "../lib/conexion.php";
    require"../lib/Llenado_Select.php";
    
    $consulta = "SELECT cod_empleo FROM usuarios_empleo";
    $resul= new Llenado_Select();
    $array=$resul->llenarSelect($consulta);

    foreach($array as $element):

        $codUser =$element['cod_empleo'];

        $rs = "SELECT MAX(cod_propuesta) AS id FROM propuesta";
        $rs = $conexion->prepare($rs);
        $rs->execute(array());
        if($fila2=$rs->fetch(PDO::FETCH_ASSOC)){
            $codPropuesta = trim($fila2['cod_propuesta']);
        }

        $query = "select vehiculoP,generoP,licenciaP,fk_experienciaP,edad,edad2,experien,fk_idioma,idioma,fk_nivelIdiom,nivel from propuesta join experiencia on cod_experi=fk_experienciaP
        join idioma on cod_idioma=fk_idioma join nivelidiom on cod_nivel=fk_nivelIdiom where cod_propuesta= :codPropuesta";
        $results = $conexion->prepare($query);
        $results->bindValue(':codPropuesta', $codPropuesta);
        $results->execute(array(':codPropuesta'=>$codPropuesta));

        $query2="select Pos_moto,Pos_vehi,sexo,fk_TipoLicen,sum(YEAR(fech_FinTra)-YEAR(fech_IniTra) + IF(DATE_FORMAT(fech_FinTra,'%m-%d') > DATE_FORMAT(fech_IniTra,'%m-%d'), 0, -1)) AS `Experiencia`,
        YEAR(CURDATE())-YEAR(Fech_Naci) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(Fech_Naci,'%m-%d'), 0, -1) as edad, fk_idioma,fk_nivel
        from usuarios_empleo join curri_expelabo on fk_userExpeLbo=cod_empleo join curri_idioma on fk_userIdioma=cod_empleo where cod_empleo=? group by fk_idioma,fk_nivel asc";
        $result2=$conexion->prepare($query2);
        $result2->execute(array($codUser));
        foreach($results as $elem);
        foreach($result2 as $elem2);

        $requi[]="";

        if($elem['fk_experienciaP']==7 and $elem2['Experiencia']<5)
        {
            $requi[]="Experiencia laboral necesaria de: ".$elem['experien'];
        }
        elseif($elem2['Experiencia']<=$elem['fk_experienciaP']-1)
        {
            $requi[]="Experiencia laboral necesaria de: ".$elem['experien'];
        }

        if($elem2['edad']<$elem['edad'] or $elem2['edad']>$elem['edad2'])
        {
            $requi[]="Edad requerida de: ".$elem['edad']." a ".$elem['edad2']." años";
        }

        if($elem['fk_idioma']!=$elem2['fk_idioma'])
        {
            $requi[]="Idioma requerido: ".$elem['idioma'];
        }
        if($elem['fk_nivelIdiom']>$elem2['fk_nivel'] and $elem2['fk_nivel']>1 )
        {
            $requi[]="Nivel requerido del idioma: ".$elem['nivel'];
        }

        if($elem['fk_idioma']!=$elem2['fk_idioma'] and $elem2['fk_nivel']==$elem['fk_idioma'])
        {
            $requi[]="Nivel requerido del idioma: ".$elem['nivel'];
        }

        if($elem['generoP']=="Masculino" and $elem2['sexo']=="F")
        {
            $requi[]="Genero: ".$elem['generoP'];
        }

        if($elem['generoP']=="Femenino" and $elem2['sexo']=="M")
        {
            $requi[]="Genero: ".$elem['generoP'];
        }

        if($elem['vehiculoP']=="Moticicleta" and $elem2['Pos_moto']=="No")
        {
            $requi[]=" No posee Motocicleta";
        }

        if($elem['vehiculoP']=="Carro" and $elem2['Pos_vehi']=="No")
        {
            $requi[]=" No posee Carro";
        }

        if($elem2['fk_TipoLicen']==1)
        {
            $requi[]="No posee Licencia de conducir";
        }
        elseif($elem['licenciaP']=="Libiana" and $elem2['fk_TipoLicen']!=2)
        {
            $requi[]="Licencia de conducir: Libiana";
        }
        elseif($elem['licenciaP']=="Pesada" and $elem2['fk_TipoLicen']!=4)
        {
            $requi[]="Licencia de conducir: Pesada";
        }
        elseif($elem['licenciaP']=="Especial" and $elem2['fk_TipoLicen']!=3)
        {
            $requi[]="Licencia de condicir: Especial";
        }

        $requiBase=implode("\n",$requi);
        $insert="insert into enviocurri(fk_propuesta,fk_userDesem,requisitos) values(?,?,?)";
        $result=$conexion->prepare($insert);
        $result->execute(array($codPropuesta,$codUser,$requiBase));
        $continue=1;

        if($continue == 1) {
            if ($requi == "") {

                $rs2 = "SELECT email_user FROM usuarios_empleo where cod_empleo = :codUser";
                $rs2 = $conexion->prepare($rs2);

                $rs2->bindValue(':codUser', $codUser);
                $rs2->execute(array(':codUser'=>$codUser));
                $fila3=$rs2->fetch(PDO::FETCH_ASSOC);
                $email = trim($fila3['email_user']);

                $rs3 = "SELECT nomb_empre FROM usuarios_empre where cod_usuario = :cod";
                $rs3 = $conexion->prepare($rs3);
                $rs3->bindValue(':cod', $cod);
                $rs3->execute(array(':cod'=>$cod));
                $fila4=$rs2->fetch(PDO::FETCH_ASSOC);
                $nombreE = trim($fila4['nomb_empre']);


                //Recibir todos los parámetros del formulario
                $para = $email;
                $asunto = "AVISO";
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
            
                                <h3>La empresa ' . $nombreE . ' registro una nueva propuesta llamada ' . $nombreP . '</h3>
                                <div class="container-fluid text-center">
                                    <p>Tu comples con todos los requisitos que la empresa necesita para ese puesto.</p>
                                    <p>Animate y aplica a la propuesta</p>
                                </div>
            
                                <button src="http://empleate-hn.accesocatracho.com//index.php">Ir a pagina web</button>
                              </div>
                            </div>
            
                            </body>
                            </html>';

                $cabeceras = 'MIME-Version: 1.0' . "\r\n";
                $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

                if (mail($para, $asunto, $mensaje, $cabeceras)) {
                    $c = 1;
                }else{
                    $c = 1;
                }
            }
        }
    endforeach;
}
ob_end_flush();
?>