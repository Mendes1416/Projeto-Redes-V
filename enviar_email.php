<?php
// Incluir o arquivo do PHP Mailer

use PHPMailer\PHPMailer\PHPMailer;

require 'caminho/para/phpmailer/PHPMailerAutoload.php';

// Configurações do servidor de e-mail
$mail = new PHPMailer();
$mail->isSMTP();
$mail->Host = 'smtp.example.com';  // Endereço do servidor SMTP
$mail->Port = 587;  // Porta SMTP (normalmente 587 ou 465)
$mail->SMTPAuth = true;
$mail->Username = 'seu_email@example.com';  // Seu e-mail
$mail->Password = 'sua_senha';  // Sua senha de e-mail
$mail->setFrom('seu_email@example.com', 'Seu Nome');  // Seu e-mail e nome

// Destinatário
$mail->addAddress('destinatario@example.com');  // E-mail do destinatário

// Conteúdo do e-mail
$mail->isHTML(true);
$mail->Subject = 'Novo contato através do formulário';
$mail->Body    = 'Nome: ' . $_POST['nome'] . '<br>' .
                 'E-mail: ' . $_POST['email'] . '<br>' .
                 'Mensagem: ' . $_POST['mensagem'];

// Verificar se o e-mail foi enviado com sucesso
if($mail->send()) {
    echo 'E-mail enviado com sucesso!';
} else {
    echo 'Erro ao enviar e-mail: ' . $mail->ErrorInfo;
}
?>
