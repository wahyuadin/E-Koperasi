<?php
session_start();
include ('config/functions.php');
if(!isset($_SESSION['login'])) {
    header("Location: login.php");
    $_SESSION['nothing'] = 'Anda Tidak Dapat Membuka Halaman ini';
}
$id = $_GET['id'];

$sql = $conn->query("UPDATE data SET status = 'Pengajuan Di Tolak' WHERE id = $id") or die(mysqli_error($conn));
if($sql) {
    echo "<script>alert('Data Berhasil Diubah.');window.location='dashboard.php?p=transaksi';</script>";
} else {
    echo "<script>alert('Data Gagal Diubah.');window.location='dashboard.php?p=transaksi';</script>";
}
?>