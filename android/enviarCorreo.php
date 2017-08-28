<?php

    include("../lib/conexion.php");


    //funcion que genera el li
    function generarToken($idusuario, $nombreUsuario){
        // Se genera una cadena para validar el cambio de contraseña
        $cadena = $idusuario.$nombreUsuario.rand(1,9999999).date('Y/m/d');
        //$token = password_hash($cadena, PASSWORD_DEFAULT);
        $token = sha1($cadena);

        require("../lib/conexion.php");

        //$conexion=new PDO('mysql:host=localhost; dbname=accesoca_empleo','root','efli1995');

        // Se inserta el registro en la tabla
        $sql= "INSERT INTO recu_empre(cod_usuario,nomb_user,token) VALUES(?,?,?)";

        $resultado = $conexion->prepare($sql);
        $resultado->execute(array($idusuario,$nombreUsuario,$token));

        if(isset($resultado)){
            //$passIdUsuario= password_hash($idusuario, PASSWORD_DEFAULT);
            /*$passIdUsuario= sha1($idusuario);
            // Se devuelve el link que se enviara al usuario
            $enlace = 'http://'.$_SERVER["SERVER_NAME"].'/PruebaEmpleo2/ModulE/restablecer_empre.php?cod_usuario='.$passIdUsuario.'&token='.$token;

            //$enlace = 'http://'.$_SERVER["SERVER_NAME"].'/PruebaEmpleo2/ModulE/restablecer.php?cod_usuario='.$passIdUsuario.'&token='.$token;
            */
            return $token;
        }
        else
            return FALSE;
    }

    //ENVIAR EMAIL
    function enviarEmail($email, $link){

        //Librerías para el envío de mail
        require '../lib/PHPMailer/PHPMailerAutoload.php';
        require '../lib/PHPMailer/class.smtp.php';

        //Recibir todos los parámetros del formulario
        $email;
        $asunto = "Recuperar contraseña";
        $mensaje = '<html>
                     <head>
                        <title>Restablece tu contraseña</title>
                     </head>
                     <body>
                       <p>Hemos recibido una petición para restablecer la contraseña de tu cuenta.</p>
                       <p>Si hiciste esta petición, ingresa el token en la aplicacion, si no hiciste esta petición puedes ignorar este correo.</p>
                       <p>
                         <strong>Token para restablecer tu contraseña</strong><br>
                         <h3 style="color:#55d4ff">'.$link.'</h3>
                       </p>
                     </body>
                    </html>';

        //Este bloque es importante
        $mail = new PHPMailer();

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;

        //Nuestra cuenta
        $mail->Username ='efli95.ealc@gmail.com';
        $mail->Password = 'efli1995'; //Su password

        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom('efli95.ealc@gmail.com');        //Direccion de correo remitente
        $mail->addAddress($email);                       // Agregar el destinatario
        //$mail->addReplyTo('efli95.ealc@gmail.com');   //Direccion de correo para respuestas

        $mail->isHTML(true);                             // Habilitar contenido HTML

        //Agregar destinatario
        $mail->Subject = $asunto;
        $mail->Body = $mensaje;

        //Avisar si fue enviado o no y dirigir al index
        $exito = $mail->Send();
            $intentos=1;
        while((!$exito)&&($intentos<5)&&($mail->ErrorInfo!="SMTP Error: Data not accepted")){
            sleep(5);
            $exito = $mail->Send();
            $intentos++;
        }

        if ($mail->ErrorInfo=="SMTP Error: Data not accepted") {
            $exito = true;
        }
        return $exito;
    }
    

    //CUERPO DE LAS MUESTRA
    $email= htmlentities(addslashes($_POST["correoE"]));

    //$respuesta= new stdClass();

    if($email != ""){

        //$conexion=new PDO('mysql:host=localhost; dbname=accesoca_empleo','root','efli1995');

        $consulta ="SELECT * FROM usuarios_empre WHERE email= :email LIMIT 1";

        $resultado= $conexion->prepare($consulta);

        $resultado->bindValue(":email", $email);

        $resultado->execute(array(":email"=>$email));
        
        $num=  $resultado->rowCount();

        if($num > 0){

            $usuario=$resultado->fetch(PDO::FETCH_ASSOC);

            $codigo=$usuario["cod_usuario"];
            $nombre=$usuario["nomb_usuario"];

            $linkTemporal = generarToken($codigo,$nombre);
            if(isset($linkTemporal)){
            
                if(enviarEmail($email, $linkTemporal)){
                    // $respuesta->mensaje
                     $num++;
                }/*else{
                    // $respuesta->mensaje
                    $num +2;
                }*/
            }
            /*
             * si la respuesta es correcta le puede enviar una nueva contraseña o darsela en el
             * momento que solo dure unas pocas horas para que solo entre y cambie la contraseña
             *
             */
        }
        
        echo $num;
         
    }
    
    
    
    
