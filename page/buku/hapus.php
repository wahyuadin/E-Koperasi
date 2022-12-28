<?php 
// menangkap id_buku di url
$id = $_GET['id'];

$conn->query("DELETE FROM tb_pinjam WHERE id = $id") or die(mysqli_error($conn));
echo "<script>alert('Data Berhasil Dihapus.');window.location='?p=pinjam';</script>";

?>