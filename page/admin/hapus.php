<?php 
// menangkap id_buku di url
$id_buku = $_GET['id'];

$conn->query("DELETE FROM tb_user WHERE id_user = $id_buku") or die(mysqli_error($conn));
echo "<script>alert('Data Berhasil Dihapus.');window.location='?p=request_admin';</script>";

?>