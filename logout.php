<?php 
session_start();

if(!isset($_SESSION['login'])) {
    header("Location: login.php");
    $_SESSION['nothing'] = 'Anda Tidak Dapat Membuka Halaman ini';
}
session_destroy();
session_unset();

echo "<script>
                alert('Logout Berhasil, Terimakasih!');
                window.location.href='index.php';
                </script>";

?>