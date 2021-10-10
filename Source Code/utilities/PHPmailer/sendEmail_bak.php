<?php

// require '/usr/share/php/libphp-phpmailer/autoload.php';
// require '/usr/share/php/libphp-phpmailer/class.smtp.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';
if (isset($_POST['email']) && isset($_POST['code'])) {
    $email = $_POST['email'];
    $message = $_POST['code'];
    $mail = new PHPMailer;


    $mail->isSMTP();
    $mail->Host = 'ssl://smtp.gmail.com';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->SMTPAuth = true;

    $mail->Username = "nideasro@gmail.com";
    $mail->Password = "+y9U:cZbM_9qZ%7;";

    $mail->setFrom('nideasro@gmail.com', 'Designology');
    $mail->addAddress($email);

    $mail->isHTML(true);
    $mail->Subject = 'Codul tau de confirmare';
    $mail->Body = $message;

    if (!$mail->send()) {
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'Message sent!';
        //Section 2: IMAP
        //Uncomment these to save your message in the 'Sent Mail' folder.
        #if (save_mail($mail)) {
        #    echo "Message saved!";
        #}
    }
}
