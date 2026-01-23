<?php
// Menggunakan autoloader dari Composer (sesuaikan path jika folder vendor ada di luar folder Src)
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

$mail->IsSMTP();

$mail->SMTPSecure = 'ssl';

$mail->Host = "localhost"; //hostname masing-masing provider email
$mail->SMTPDebug = 2;
$mail->Port = 465;
$mail->SMTPAuth = true;

$mail->Timeout = 60; // timeout pengiriman (dalam detik)
$mail->SMTPKeepAlive = true; 

$mail->Username = "admin@namadomain"; //user email
$mail->Password = "XXXXX"; //password email

// Menangkap data dari form HTML
$name = $_POST['name'] ?? 'No Name';
$email = $_POST['email'] ?? 'no-reply@example.com';
$subject = $_POST['subject'] ?? 'No Subject';
$message = $_POST['message'] ?? 'No Message';

$mail->SetFrom("admin@namadomain", "Website Edumate"); // Email pengirim (harus sesuai autentikasi SMTP)
$mail->AddReplyTo($email, $name); // Agar ketika di-reply langsung ke email pengisi form
$mail->Subject = "Pesan Baru: " . $subject;
$mail->AddAddress("admin@namadomain", "Admin"); // Email tujuan (Admin)

// Isi pesan email
$mail->MsgHTML("<h3>Pesan Baru dari Website</h3><p><b>Nama:</b> $name</p><p><b>Email:</b> $email</p><p><b>Pesan:</b><br>$message</p>");

try {
    $mail->Send();
    echo "Message has been sent";
} catch (Exception $e) {
    echo "Failed to sending message. Mailer Error: {$mail->ErrorInfo}";
}
?>