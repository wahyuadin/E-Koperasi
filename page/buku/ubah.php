<?php 

// menangkap id_buku di url
$id = $_GET['id'];

// menampilkan data db sesuai id_buku
$sql = $conn->query("SELECT * FROM tb_pinjam WHERE id = $id") or die(mysqli_error($conn));
$pecahSql = $sql->fetch_assoc();



if(isset($_POST['ubah'])) {
	$kategori = htmlspecialchars($_POST['kategori']);
	$nama = htmlspecialchars($_POST['nama']);
	$thn = htmlspecialchars($_POST['thn']);
	$harga = htmlspecialchars($_POST['harga']);
	$junit = htmlspecialchars($_POST['junit']);
	

    if(empty($kategori && $nama && $thn && $harga && $junit)) {
        echo "<script>alert('Pastikan anda sudah mengisi semua formulir.');window.location='?p=pinjam&aksi=tambah';</script>";
    }

	$sql = $conn->query("UPDATE tb_pinjam SET kategori = '$kategori', nama = '$pengarang', nama = '$nama', thn = '$thn', harga = '$harga', unit = '$junit' WHERE id_buku = $id_buku") or die(mysqli_error($conn));
	if($sql) {
		echo "<script>alert('Data Berhasil Diubah.');window.location='?p=buku';</script>";
	} else {
		echo "<script>alert('Data Gagal Diubah.');window.location='?p=buku';</script>";
	}
}

?>

<h1 class="mt-4">Ubah Data Pinjaman</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
    <li class="breadcrumb-item active">Ubah Data Pinjaman</li>
</ol>
<div class="card-header mb-5">
	
<form action="" method="post">
    <div class="form-group">
        <label class="small mb-1" for="judul_buku">Kategori</label>
        <input class="form-control" id="judul_buku" name="kategori" type="text" placeholder="Masukan kategori" value="<?=$pecahSql['kategori']?>"/>
    </div>
    <div class="form-group">
        <label class="small mb-1" for="pengarang_buku">Nama Barang</label>
        <input class="form-control" id="pengarang_buku" name="nama" type="text" placeholder="Masukan nama Barang" value="<?=$pecahSql['nama']?>" />
    </div>
    <div class="form-group">
        <label class="small mb-1" for="penerbit_buku">Tahun Rilis</label>
        <input class="form-control" id="penerbit_buku" name="thn" type="text" placeholder="Masukan penerbit buku" value="<?=$pecahSql['tahun']?>" />
    </div>
    <div class="form-group">
        <label class="small mb-1" for="tahun_terbit">Harga Satuan Unit</label>
        <input type="text" class="form-control" name="harga" placeholder="Masukan Harga Satuan Unit" value="<?=$pecahSql['nama']?>">
    </div>
    <div class="form-group">
        <label class="small mb-1" for="isbn">Jumlah Unit</label>
        <input class="form-control" id="isbn" name="junit" type="text" placeholder="Masukan Jumlah Unit" value="<?=$pecahSql['unit']?>"/>
    </div>
    <div class="form-group">
    	<button type="submit" class="btn btn-primary" name="tambah">Tambah Data</button>
    </div>
	</form>
</div>