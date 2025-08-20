<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userEmail = htmlspecialchars($_POST['email']);
    $header    = htmlspecialchars($_POST['header']);
    $content   = htmlspecialchars($_POST['content']);

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'mail.yourdomain.com';  // your İsimtescil mail server
        $mail->SMTPAuth   = true;
        $mail->Username   = 'info@yourdomain.com'; // your email
        $mail->Password   = 'YOUR_EMAIL_PASSWORD'; // your email password
        $mail->SMTPSecure = 'ssl'; 
        $mail->Port       = 465; // usually 465 for SSL, 587 for TLS

        // Sender & recipient
        $mail->setFrom('info@yourdomain.com', 'Website Offers');
        $mail->addAddress('info@yourdomain.com');  // where you want to receive it
        $mail->addReplyTo($userEmail);

        // Content
        $mail->isHTML(true);
        $mail->Subject = "New Offer Request: " . $header;
        $mail->Body    = "
            <h2>New Offer Request</h2>
            <p><strong>Email:</strong> $userEmail</p>
            <p><strong>Offer Header:</strong> $header</p>
            <p><strong>Details:</strong><br>$content</p>
        ";

        $mail->send();
        echo "success";
    } catch (Exception $e) {
        echo "Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
