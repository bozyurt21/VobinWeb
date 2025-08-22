<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userEmail = htmlspecialchars($_POST['email']);
    $header    = htmlspecialchars($_POST['header']);
    $content   = htmlspecialchars($_POST['content']);

    // Your email address
    $to = "info@vobin.com.tr";  

    $subject = "New Offer Request: " . $header;
    $message = "
        <h2>New Offer Request</h2>
        <p><strong>Email:</strong> $userEmail</p>
        <p><strong>Offer Header:</strong> $header</p>
        <p><strong>Details:</strong><br>$content</p>
    ";

    // Headers
    $headers  = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: <$userEmail>" . "\r\n";

    if (mail($to, $subject, $message, $headers)) {
        echo "success";
    } else {
        echo "error";
    }
}
?>
