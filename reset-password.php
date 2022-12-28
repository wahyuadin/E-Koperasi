<?php
session_start();
include ('config/functions.php');

$error = "";
if (isset($_SESSION['login'])) {
    header('Location:dashboard.php');
}

if (!isset($_SESSION['pw'])) {
    $error = $_SESSION['nothing'];
    header('Location:lupa-password.php');
}

if (isset($_POST['kirim'])) {
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];
    // var_dump($password1, $password2);
    // die;
        if ($password1 == $password2) {
            $sesi     = $_SESSION['pw'];
            $enc      = password_hash($password1, PASSWORD_DEFAULT);
            $query    = mysqli_query($conn, "UPDATE tb_user SET password = '$enc' , code = '' WHERE email = '$sesi'");
            if ($query) {
                $_SESSION['reset-pw'] = "Password Berhasil Di Rubah";
                header('Location:login.php');
            } else {
                $error = "Failed to change your password!";
            }

        }else {
            $error    = "Password Tidak Sama!";
        }

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
    <title>Lupa Password</title>
    <link href="css/styles.css" rel="stylesheet" />
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
                            <div class="card-header"><h3 class="text-center font-weight-light my-4">Form ganti password</h3></div>
                            <div class="card-body">
                                <?php if ($error == "") { ?>
                                <div class="alert alert-primary" role="alert">
                                    <center>Verifikasi OTP berhasil!</center>
                                </div>
                                <?php } ?>
                                <?php if ($error != "") { ?>
                                <div class="alert alert-danger" role="alert">
                                    <center><?=$error?></center>
                                </div>
                                <?php } ?>
                                    <form action="" method="post">
                                        <div class="mt-3">
                                            <label for="">Password Baru</label>
                                            <input class="form-control" type="password" name="password1" placeholder="Password" required>
                                        </div>
                                        <div class="mt-3">
                                            <label for="">Ulangi Password</label>
                                            <input class="form-control" type="password" name="password2" placeholder="Password" required>
                                        </div>
                                        <button class="btn btn-primary mt-3 form-control" name="kirim">Kirim</button>
                                    </form>
                            </div>
                            <div class="card-footer text-center">
                                <div class="small"><a href="login.php">Login?</a></div>
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
    <script src="js/scripts.js"></script>
</body>
</html>