<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require '../../vendor/autoload.php';

// Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    try {
        // Server settings
        // Enable verbose debug output
        //Send using SMTP
        $mail->isSMTP();
        // Set the SMTP server to send through
        $mail->Host = 'smtp.gmail.com';
        // Enable SMTP authentication
        $mail->SMTPAuth = true;
        // SMTP username
        $mail->Username = 'zielinskikarol13@gmail.com';
        // SMTP password
        $mail->Password = 'fprj dktq sgwk qzva';
        // Enable implicit TLS encryption
        $mail->SMTPSecure = 'tls';
        // TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('from@example.com', 'Mailer');
        $mail->addAddress('zielinskikarol13@gmail.com', 'Karol ZIELINSKI'); //Add a recipient

        // Content
        // Set email format to HTML
        $mail->isHTML(true);
        $mail->Subject = 'Nouveau message du formulaire de contact';
        $mail->Body = "Nom : $nom<br>Email : $email<br>Message : $message";
        $mail->AltBody = "Nom : $nom\nEmail : $email\nMessage : $message";

        $mail->send();
        echo 'Message has been sent';
        header("Location: /P5-OCR/?contact_success=true");
        exit;
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}