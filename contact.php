<?php
// Menggunakan autoloader dari Composer (sesuaikan path jika folder vendor ada di luar folder Src)
require __DIR__ . '/vendor/autoload.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

$mail->IsSMTP();

$mail->SMTPSecure = 'ssl';

$mail->Host = "smtp.gmail.com"; 
$mail->SMTPDebug = 2;
$mail->Port = 465;
$mail->SMTPAuth = true;

$mail->Timeout = 60;
$mail->SMTPKeepAlive = true; 

$mail->Username = "dwid35895@gmail.com"; 
$mail->Password = getenv('APP_PASSWORD'); 

// Menangkap data dari form HTML
$name = $_POST['name'] ?? 'No Name';
$email = $_POST['email'] ?? 'no-reply@example.com';
$subject = $_POST['subject'] ?? 'No Subject';
$message = $_POST['message'] ?? 'No Message';

$mail->SetFrom("dwid35895@gmail.com", "Website Edumate"); // Email pengirim (harus sesuai autentikasi SMTP)
$mail->AddReplyTo($email, $name); // Agar ketika di-reply langsung ke email pengisi form
$mail->Subject = "Pesan Baru: " . $subject;
$mail->AddAddress("dwid35895@gmail.com", "Admin"); // Email tujuan (Admin)

// Isi pesan email
$mail->MsgHTML("<h3>Pesan Baru dari Website</h3><p><b>Nama:</b> $name</p><p><b>Email:</b> $email</p><p><b>Pesan:</b><br>$message</p>");

try {
    $mail->Send();
    echo "<script>
        alert('Pesan berhasil dikirim');
        window.location.href = 'index.html';
    </script>";
    exit;
    exit;
} catch (Exception $e) {
    echo "<script>
        alert('Gagal mengirim pesan');
        window.location.href = 'index.html';
    </script>";
    exit;
}
?>