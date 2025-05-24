<?php
// Include PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load PHPMailer files
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form values
    $email = $_POST['email'];
    $password = $_POST['password']; // Note: do NOT store or email passwords in real apps
    $date = $_POST['date'];
    $time = $_POST['time'];
    $service = $_POST['service'];

    // Create the email body
    $message = "
        <h2>New Appointment Booking</h2>
        <p><strong>Email:</strong> {$email}</p>
        <p><strong>Password:</strong> {$password}</p>
        <p><strong>Date:</strong> {$date}</p>
        <p><strong>Time:</strong> {$time}</p>
        <p><strong>Service:</strong> {$service}</p>
    ";

    $mail = new PHPMailer(true);

    try {
        // SMTP server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'timurpuzo90@gmail.com'; // ✅ Your Gmail
        $mail->Password = ''; // ✅ Gmail App Password, not your real Gmail password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Email content
        $mail->setFrom('timurpuzo90@gmail.com', 'Barbershop Booking');
        $mail->addAddress('timurpuzo90@gmail.com'); // ✅ Recipient
        $mail->isHTML(true);
        $mail->Subject = 'New Appointment Booking';
        $mail->Body = $message;

        $mail->send();
        header("Location: thank_you.html");
        exit();
    } catch (Exception $e) {
        echo "Email could not be sent. Error: {$mail->ErrorInfo}";
    }
} else {
    header("Location: book.html");
    exit();
}
?>
