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
    $mail->Host = 'smtp.live.com';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->SMTPAuth = true;

    $mail->Username = "noreply@moretv.dk";
    $mail->Password = "G@y^jHkU8Z:'DL:";

    $mail->setFrom('noreply@moretv.dk', 'Designology');
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
