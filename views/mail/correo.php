<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
// require 'vendor/autoload.php';
require '../lib/phpMailer/vendor/autoload.php';


if (isset($_POST['contacto']) && $_POST['contacto'] == true) {
    $name_remitente = strip_tags(htmlspecialchars($_POST['name']));
    $remitente = strip_tags(htmlspecialchars($_POST['email']));
    $m_subject = strip_tags(htmlspecialchars($_POST['subject']));
    $message = strip_tags(htmlspecialchars($_POST['message']));
}

if (isset($_GET['registro']) && $_GET['registro'] == true) {
    $name_destinatario = strip_tags(htmlspecialchars($_GET['usuario']));
    $destinatario = strip_tags(htmlspecialchars($_GET['email']));
}


if (!isset($remitente) && !isset($name_remitente)) {
    $remitente = "alecoro96@gmail.com";
    $name_remitente = "Ale Coro";
}

if (!isset($destinatario) && !isset($name_destinatario)) {
    $destinatario = "alecoro96@gmail.com";
    $name_destinatario = "Ale Coro";
}


try {
    $phpmailer = new PHPMailer();
    $phpmailer->SMTPDebug = SMTP::DEBUG_SERVER;
    $phpmailer->Host = 'sandbox.smtp.mailtrap.io';
    $phpmailer->SMTPAuth = true;
    $phpmailer->Port = 2525;
    $phpmailer->Username = 'f3868c381cfbe3';
    $phpmailer->Password = '8d875b78ae7916';


    //Set PHPMailer to use the sendmail transport
    $phpmailer->isSMTP();
    //Set who the message is to be sent from
    $phpmailer->setFrom($remitente, $name_remitente);
    //Set an alternative reply-to address
    $phpmailer->addReplyTo('replyto@example.com', 'First Last');
    //Set who the message is to be sent to
    $phpmailer->addAddress($destinatario, $name_destinatario);
    //Set the subject line
    $phpmailer->Subject = 'PHPMailer sendmail test';

    //convert HTML into a basic plain-text alternative body
    if (!isset($_POST['destinatario'])) {
        if (isset($_POST['contacto']) && $_POST['contacto'] == true) {
            $htmlContent = file_get_contents('Contacto.html');
            $htmlContent = str_replace('{name}', $name_remitente, $htmlContent);
            $htmlContent = str_replace('{email}', $remitente, $htmlContent);
            $htmlContent = str_replace('{asunto}', $m_subject, $htmlContent);
            $htmlContent = str_replace('{message}', $message, $htmlContent);
            $phpmailer->msgHTML($htmlContent, __DIR__);
        }

        if (isset($_GET['registro']) && $_GET['registro'] == true) {
            $htmlContent = file_get_contents('Bienvenido.html');
            $htmlContent = str_replace('{usuario}', $name_destinatario, $htmlContent);
            $phpmailer->msgHTML($htmlContent, __DIR__);
        }

        // $phpmailer->msgHTML(file_get_contents('Bienvenido.html'), __DIR__);
    } else {
        $phpmailer->msgHTML(file_get_contents('Contacto.php'), __DIR__);
    }

    // Adjuntar la imagen al correo
    $phpmailer->addAttachment('https://www.imagenes-temporales.com/subidas/ver/p2WjJ1/', 'logo');

    //send the message, check for errors
    if (!$phpmailer->send()) {
        echo 'Mailer Error: ' . $phpmailer->ErrorInfo;
    } else {
        echo 'Message sent!';
    }
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$phpmailer->ErrorInfo}";
}
