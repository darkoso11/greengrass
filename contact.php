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
    $mail->Host = 'svgt199.serverneubox.com.mx';
    $mail->SMTPAuth = true;                             
    $mail->Username = 'contact@santiagosyntheticgrass.com';             
    $mail->Password = '15QXebM3&*PY6y*v8Yw!';           
    $mail->SMTPSecure = 'tls';                         
    $mail->Port = 465; //PUERTO CORREO
    $mail->CharSet = 'UTF-8';

    $mail->setFrom('contact@santiagosyntheticgrass.com', 'Santiago Synthetic Grass');
    
    // SUSTITUIR POR VALOR DEL INPUT DONDE SE INTRODUCE EL CORREO
    $mail->addAddress('contact@santiagosyntheticgrass.com');

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
    $mail->Host = 'svgt199.serverneubox.com.mx';
    $mail->SMTPAuth = true;                             
    $mail->Username = 'contact@santiagosyntheticgrass.com';             
    $mail->Password = '15QXebM3&*PY6y*v8Yw!';           
    $mail->SMTPSecure = 'tls';                         
    $mail->Port = 465; //PUERTO CORREO
    $mail->CharSet = 'UTF-8';

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
