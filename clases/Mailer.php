<?php
//
/**
 * Clase para envio de correo electrónico
 * Autor: Marco Robles
 * Web: https://github.com/mroblesdev
 */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mailer
{
    public function enviarEmail($email, $asunto, $cuerpo)
    {
        require_once './config/config.php';
        require './phpmailer/src/PHPMailer.php';
        require './phpmailer/src/SMTP.php';
        require './phpmailer/src/Exception.php';

        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_OFF;                //Enable verbose debug output
            $mail->isSMTP();
            $mail->Host       = MAIL_HOST;                     //Configure el servidor SMTP para enviar
            $mail->SMTPAuth   = true;                          // Habilita la autenticación SMTP
            $mail->Username   = MAIL_USER;                     //Usuario SMTP
            $mail->Password   = MAIL_PASS;                     //Contraseña SMTP
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Habilitar el cifrado TLS
            $mail->Port       = MAIL_PORT;                     //Puerto TCP al que conectarse, si usa 587 agregar `SMTPSecure = PHPMailer :: ENCRYPTION_STARTTLS`

            //Correo emisor y nombre
            $mail->setFrom(MAIL_USER, 'TepainyBooks');
            //Correo receptor y nombre
            $mail->addAddress($email);

            //Contenido
            $mail->isHTML(true);   //Establecer el formato de correo electrónico en HTML
            $mail->Subject = $asunto; //Titulo del correo

            //Cuerpo del correo
            $mail->Body = utf8_decode($cuerpo);
            $mail->setLanguage('es', '../phpmailer/language/phpmailer.lang.es.php');

            //Enviar correo
            if($mail->send()){
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo "No se pudo enviar el mensaje. Error de envío: {$mail->ErrorInfo}";
            return false;
        }
    }
}
