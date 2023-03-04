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
    $apellido=$_POST["apellido"];
    $correo=$_POST["correo"];
    $telefono=$_POST["telefono"];
    $region=$_POST["region"];
    $asunto=$_POST["asunto"];
    $mensaje=$_POST["mensaje"];
    
    $mail->isSMTP();                                     
    $mail->Host = 'mail.santiagosyntheticgrass.com';
    $mail->SMTPAuth = true;                             
    $mail->Username = 'contact@santiagosyntheticgrass.com';             
    $mail->Password = '0so.santiago.123456789/*';           
    $mail->SMTPSecure = 'tls';                         
    $mail->Port = 587; // 587
    $mail->CharSet = 'UTF-8';

    $mail->setFrom('contact@santiagosyntheticgrass.com', 'Santiago Synthetic Grass');
    
    // SUSTITUIR POR VALOR DEL INPUT DONDE SE INTRODUCE EL CORREO
    $mail->addAddress('contact@santiagosyntheticgrass.com');

    // CON COPIA A...
    $mail->addCC('socialmedia.gatm@gmail.com');

    $mail->isHTML(true);    
    // TITULO CON EL QUE ENVIAMOS EL CORREO
    $mail->Subject = $asunto;
    // CONTENIDO EN HTML
    $mail->Body    = "
        <div style='color:#000;'>
            <ul>
                <li>$asunto</li>
                <li>$nombre</li>
                <li>$apellido</li>
                <li>$correo</li>
                <li>$telefono</li>
                <li>$region</li>
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
    $reply->Host = 'mail.santiagosyntheticgrass.com';
    $reply->SMTPAuth = true;                             
    $reply->Username = 'contact@santiagosyntheticgrass.com';             
    $reply->Password = '0so.santiago.123456789/*';           
    $reply->SMTPSecure = 'tls';                         
    $reply->Port = 587; //587
    $reply->CharSet = 'UTF-8';

    $reply->setFrom('contact@santiagosyntheticgrass.com', 'Santiago Synthetic Grass');
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
