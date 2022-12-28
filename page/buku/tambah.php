<?php 
if(isset($_POST['tambah'])) {
    $kategori = htmlspecialchars($_POST['kategori']);
	$nama = htmlspecialchars($_POST['nama']);
	$thn = htmlspecialchars($_POST['thn']);
	$harga = htmlspecialchars($_POST['harga']);
	$junit = htmlspecialchars($_POST['junit']);
    $date = "";
    $status = "";
	
	$sql = $conn->query("INSERT INTO tb_pinjam VALUES (NULL,'$kategori', '$nama', '$thn', '$harga', '$junit','$date','$date','$status')") or die(mysqli_error($conn));
	if($sql) {
		echo "<script>alert('Data Berhasil Ditambahkan.');window.location='?p=pinjam';</script>";
	} else {
		echo "<script>alert('Data Gagal Ditambahkan.')</script>";
	}
}

?>

<h1 class="mt-4">Tambah Data Pinjam</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
    <li class="breadcrumb-item active">Tambah Data Pinjam</li>
</ol>
<div class="card-header mb-5">
	
	<form action="" method="post">
    <div class="form-group">
        <label class="small mb-1" for="judul_buku">Kategori</label>
        <input class="form-control" id="judul_buku" name="kategori" type="text" placeholder="Masukan kategori"/>
    </div>
    <div class="form-group">
        <label class="small mb-1" for="pengarang_buku">Nama Barang</label>
        <input class="form-control" id="pengarang_buku" name="nama" type="text" placeholder="Masukan nama Barang"/>
    </div>
    <div class="form-group">
        <label class="small mb-1" for="penerbit_buku">Tahun Rilis</label>
        <input class="form-control" id="penerbit_buku" name="thn" type="text" placeholder="Masukan penerbit buku"/>
    </div>
    <div class="form-group">
        <label class="small mb-1" for="tahun_terbit">Harga Satuan Unit</label>
        <input type="text" class="form-control" name="harga" placeholder="Masukan Harga Satuan Unit">
    </div>
    <div class="form-group">
        <label class="small mb-1" for="isbn">Jumlah Unit</label>
        <input class="form-control" id="isbn" name="junit" type="text" placeholder="Masukan Jumlah Unit"/>
    </div>
    <div class="form-group">
    	<button type="submit" class="btn btn-primary" name="tambah">Tambah Data</button>
    </div>
	</form>
</div>