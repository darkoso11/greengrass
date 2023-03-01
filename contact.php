<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

$mail = new PHPMailer(true);     
$reply = new PHPMailer(true);

try { 
    // SUSTITUIR EN $_POST[" -- AQUI --"] EL NOMBRE (id) DEL INPUT DONDE SE INTRODUCEN LOS SIGUIENTES DATOS
    $nombre=$_POST["nombre"];
    $correo=$_POST["correo"];
    $telefono=$_POST["telefono"];
    $region=$_POST["region"];
    $mensaje=$_POST["mensaje"];
    
    $mail->isSMTP();                                     
    $mail->Host = 'SERVIDOR_SMTP_CORREO';
    $mail->SMTPAuth = true;                             
    $mail->Username = 'USUARIO_CORREO';             
    $mail->Password = 'CONTRASEÑA_CORREO';           
    $mail->SMTPSecure = 'tls';                         
    $mail->Port = 000; //PUERTO CORREO
    $mail->CharSet = 'UTF-8';

    $mail->setFrom('CORREO_EMPRESA', 'TITULO CORREO');
    
    // SUSTITUIR POR VALOR DEL INPUT DONDE SE INTRODUCE EL CORREO
    $mail->addAddress('CORREO_EMPRESA');

    // CON COPIA A...
    //$mail->addCC('');

    $mail->isHTML(true);    
    // TITULO CON EL QUE ENVIAMOS EL CORREO
    $mail->Subject = /* $asunto */'';
    // CONTENIDO EN HTML
    $mail->Body    = "
        <div style='color:#000;'>
            <ul>
                <li>$asunto</li>
                <li>$nombre</li>
                <li>$correo</li>
                <li>$telefono</li>
                <li>$mensaje</li>
            </ul>
        </div>
    ";
    
    $mail->send();
    echo "
    <script type='text/javascript'>
        alert('Su mensaje se ha enviado satisfactoriamente.');
        window.location = window.origin;
    </script>
    ";
    
} 
catch (Exception $e) {
    echo "
    <script type='text/javascript'>
        alert('No se pudo enviar el mensaje.');
        window.location = window.origin;
    </script>
    ";
    
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}

try { 
    // AUTORESPUESTA

    $reply->isSMTP();                                     
    $mail->Host = 'SERVIDOR_SMTP_CORREO';
    $mail->SMTPAuth = true;                             
    $mail->Username = 'USUARIO_CORREO';             
    $mail->Password = 'CONTRASEÑA_CORREO';           
    $mail->SMTPSecure = 'tls';                         
    $mail->Port = 000; //PUERTO CORREO
    $mail->CharSet = 'UTF-8';

    $reply->setFrom('CORREO_EMPRESA', 'NOMBRE CORREO');
    $reply->addAddress($correo);
    $reply->isHTML(true);    
    $reply->Subject = 'Confirmación de envió de mensaje';

    $reply->Body    = "Gracias por ponerte en contacto, en breve nos comunicaremos contigo";
    $reply->send();
    
} 
catch (Exception $e) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}

?>
