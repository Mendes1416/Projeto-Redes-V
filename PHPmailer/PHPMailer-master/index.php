<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require './src/Exception.php';
require './src/PHPMailer.php';
require './src/SMTP.php';
//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                     //Enable verbose debug output
    $mail->isSMTP();                                           //Send using SMTP
    $mail->Host       = 'sandbox.smtp.mailtrap.io';            //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                 //Enable SMTP authentication
    $mail->Username   = 'fb68f385410214';                     //SMTP username
    $mail->Password   = 'e5406afe5f5321';                     //SMTP password
    $mail->Port       = 2525;                                 //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('ja019627@gmail.com', 'Ranhados_2020');
    $mail->addAddress('a23608@esenviseu.net', 'iogurteAMARELOvsiseu2004');     //Add a recipient
    //$mail->addAddress('ellen@example.com');               //Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //mandar ficheiros
    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Teste da aula de redes';
    $mail->Body    = 'Este é um texto para testar <b>o email</b>';
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'email enviado com sucesso';
} catch (Exception $e) {
    echo "email nao foi enviado. Erros: {$mail->ErrorInfo}";
}