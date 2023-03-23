<?php
use PHPMailer\PHPMailer\PHPMailer;

// use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';


$_SESSION['successMsg'] = 'Message Sent!';
$_SESSION['invalidMsg'] = "Invalid Captcha, Please Try Again!";


//Setting Email Content
$user_name = $_POST['name'];
$user_phone = $_POST['phone'];
$user_email = $_POST['email'];
$user_message = $_POST['message'];

$email_subject = "New Form Submission from " . $user_name;
$email_body = "<hr>
            <b> JUSTFOURFUN WEBSITE</b><hr>
            <b> Nama    :</b> <br>$user_name<br><br><hr>
            <b> No. HP  :</b> <br>$user_phone<br><br><hr>
            <b> Email   :</b> <br>$user_email<br><br><hr>
            <b> Pesan   :</b> <br>$user_message<br><br><hr>
        ";

//Google reCaptcha Validation
$secretKey = "6LdazHMkAAAAAAhOtMdYENQv46Aohar1WmesR0d4";
$responseKey = $_POST['g-recaptcha-response'];
$userIP = $_SERVER['REMOTE_ADDR'];

$url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$userIP";

$response = file_get_contents($url);
$response = json_decode($response);


if ($response->success) {
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'kuriklina@gmail.com'; // FROM EMAIL ---> asal
    $mail->Password = 'rcpsjlysurvlzyid'; //app password for kuriklina@gmail.com
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;


    $mail->setFrom('kuriklina@gmail.com');

    $mail->addAddress('play.justfourfun@gmail.com'); // TO EMAIL ---> tujuan

    $mail->isHTML(true);

    $mail->Subject = $email_subject;
    $mail->Body = $email_body;

    $mail->send();

    echo $_SESSION['successMsg'];
} else {
    echo $_SESSION['invalidMsg'];
}


?>