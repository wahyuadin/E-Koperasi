<?php
session_start();
include ('../config/functions.php');
if (isset($_SESSION['login'])) {
   header('location:../dashboard.php');
}


$s          = @$_GET['p'];
$code       = rand(3,938776);
$sesi       = $_SESSION['verif']; 
$query      = "SELECT * FROM tb_user WHERE username = '$sesi'";
$result     = mysqli_query($conn, $query);
$row        = $result->fetch_assoc();
if ($s == $row['param']) {
    mysqli_query($conn, "UPDATE tb_user SET verif = 'ya' WHERE username = '$sesi'");
    $_SESSION['berhasil'] = "Verifikasi Email Berhasil, Silahkan Login Kembali Untuk Melanjutkan";
    header("Location:../login.php");
} elseif ($s == "") {
    header ('Location:verif/auth.php');
} else {
    unset($_SESSION['login']);
    unset($_SESSION['berhasil']);
    $_SESSION['nothing'] = 'Anda Tidak Dapat Membuka Halaman ini, Atau Link Kadaluarsa';
    header("Location: ../login.php");
}
?>