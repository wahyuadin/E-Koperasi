<?php
session_start();
include ('../../config/functions.php');
if (isset($_SESSION['login'])) {
   header('location:../../dashboard.php');
}
$sesi       = $_SESSION['verif']; 
$query      = "SELECT * FROM tb_user WHERE username = '$sesi'";
$result     = mysqli_query($conn, $query);
$row        = $result->fetch_assoc();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';
$mail = new PHPMailer(true);
try {
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = '';                     //SMTP username
    $mail->Password   = '';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;


    //Recipients
    $mail->setFrom('finalproject@kelompok-1.com', 'Final Project');
    $mail->addAddress($row['email'], $row['nama']);     //Add a recipient
    // $mail->addAddress('ellen@example.com');               //Name is optional
    $mail->addReplyTo('finalproject@kelompok-1.com', 'Link Verifikasi Login');
    // $mail->addCC('');
    // $mail->addBCC('bcc@example.com');
     
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Hallo '.$row['nama'].'!';
    $mail->Body    = 'Untuk melanjutkan login, berikut adalah link verifikasi <b>'.'http://localhost/final-project/page/verif.php?p='.$row['param'].'</b>';
    // $mail->Body    = 'Terimakasih! Telah register';
    $mail->AltBody = 'Terimakasih telah register !';
    $mail->send();
    
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    die;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Verifikasi Login</title>
    <link href="../../css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
</head>
<body class="bg-primary">
<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
         <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header"><h3 class="text-center font-weight-light my-4">Verifikasi Login</h3></div>
                            <div class="card-body">
                                
                                <div class="alert alert-primary" role="alert">
                                    <center>Untuk melanjutkan login, kami telah mengirimkan link verifikasi pada alamat email <b><?=$row['email']?></b></center>
                                </div>
                               
                                
                            </div>
                            <div class="card-footer text-center">
                                <div class="small"><a href="../../register.php">Need an account? Sign up!</a></div>
                            </div>
                            <div class="card-footer text-center">
                                <div class="small"><a href="../../lupa-password.php">Forget Password ?</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <div id="layoutAuthentication_footer">
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; NetsinCode 2022</div>
                    <div>
                        <a href="#">Privacy Policy</a>
                        &middot;
                        <a href="#">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../js/scripts.js"></script>
</body>
</html>