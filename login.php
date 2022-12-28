<?php 
session_start();
require_once 'config/koneksi.php';
include ('config/functions.php');

$error = "";
$success = "";
if (isset($_SESSION['berhasil'])) {
    $a = $_SESSION['verif'];
    mysqli_query($conn, "UPDATE tb_user SET code = '', param = ''  WHERE username = '$a'");
    $success = $_SESSION['berhasil'];
}

if (isset($_SESSION['reset-pw'])) {
   $success = $_SESSION['reset-pw'];
}


if(isset($_SESSION['login'])) {
    header("Location: dashboard.php");
    exit;
}
if(isset($_SESSION['nothing'])) {
    $error = $_SESSION['nothing'];
}


if(isset($_POST['login'])) {
        unset($_SESSION['pw']);
        unset($_SESSION['verif']);
        unset($_SESSION['berhasil']);
        unset($_SESSION['nothing']);
        unset($_SESSION['reset-pw']);
        unset($_SESSION['pw']);
        $username = stripslashes($_POST['username']);
        //cara sederhana mengamankan dari sql injection
        $username = mysqli_real_escape_string($conn, $username);
         // menghilangkan backshlases
        $password = stripslashes($_POST['password']);
         //cara sederhana mengamankan dari sql injection
        $password = mysqli_real_escape_string($conn, $password);
        // var_dump($username,$password);
    if(!empty(trim($username)) && !empty(trim($password))){
        //select data berdasarkan username dari database
        $query      = "SELECT * FROM tb_user WHERE username = '$username'";
        $result     = mysqli_query($conn, $query);
        $rows       = mysqli_num_rows($result);
        $error      = "Username Atau Password Salah";
        if ($rows != 0) {
            $row = $result->fetch_assoc();
            if(password_verify($password, $row['password'])) {
                if ($row['verif'] == "tidak") {
                    $param = random_str(32);
                    $slug = mysqli_query($conn, "UPDATE tb_user SET param = '$param' WHERE username = '$username'");    
                    $_SESSION['verif'] = $username;
                    header('Location:page/verif.php');
                } elseif ($row['verif'] != "tidak") {
                    if ($row['user'] == 0) {
                        $_SESSION['login'] = $row;
                        echo "<script>
                        alert('Login Berhasil, Selamat Datang! ".$_SESSION['login']['nama']."');
                        window.location.href='dashboard.php';
                        </script>";
                    } else {
                        $_SESSION['login'] = $row;
                        echo "<script>
                        alert('Login Berhasil, Selamat Datang! ".$_SESSION['login']['nama']."');
                        window.location.href='user.php';
                        </script>";
                        
                    }
                }
            }
            
                         
        //jika gagal maka akan menampilkan pesan error
        } else {
            $error =  'Username Atau Password Salah !';
        }
         
    }else {
        $error =  'Data tidak boleh kosong !!';
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
    <title>Halaman Login</title>
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
                            <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                            <div class="card-body">
                                <?php if ($error != "") {?>
                                <div class="alert alert-danger" role="alert">
                                    <center><?=$error?></center>
                                </div>
                                <?php }?>
                                <?php if ($success != "") {?>
                                <div class="alert alert-primary" role="alert">
                                    <center><?=$success?></center>
                                </div>
                                <?php }?>
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label class="small mb-1" for="username">Username</label>
                                        <input class="form-control py-4" name="username" id="username" type="text" placeholder="Masukan username anda" />
                                    </div>
                                    <div class="form-group">
                                        <label class="small mb-1" for="password">Password</label>
                                        <input class="form-control py-4" id="password" name="password" type="password" placeholder="Masukan password" />
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" id="rememberPasswordCheck" type="checkbox" />
                                            <label class="custom-control-label" for="rememberPasswordCheck">Remember password</label>
                                        </div>
                                    </div>
                                    <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                        <button type="submit" name="login" class="btn btn-primary form-control">Login</button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer text-center">
                                <div class="small"><a href="register.php">Need an account? Sign up!</a></div>
                            </div>
                            <div class="card-footer text-center">
                                <div class="small"><a href="lupa-password.php">Forget Password ?</a></div>
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