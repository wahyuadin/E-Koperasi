<?php 
// menampilkan judul buku di TB_buku di bagian option pilih buku
$tampilNamaBuku = $conn->query("SELECT * FROM tb_buku ORDER BY id_buku") or die(mysqli_error($conn));

// menampilkan nama anggota & nim di TB_anggota di bagian option pilih anggota
$tampilNamaAnggota = $conn->query("SELECT * FROM tb_anggota ORDER BY nim") or die(mysqli_error($conn));

$sql = $conn->query("SELECT * FROM tb_transaksi INNER JOIN tb_buku
										ON tb_transaksi.id_buku = tb_buku.id_buku INNER JOIN tb_anggota 
										ON tb_transaksi.id_anggota = tb_anggota.id_anggota WHERE status = 'pinjam'
										") or die(mysqli_error($conn));

$joint = "SELECT id_anggota,nama,nim,nama_anggota FROM tb_anggota INNER JOIN tb_user ON tb_user.id_user=tb_anggota.id_anggota";

$result = mysqli_query($conn, $joint);
// $query = $result->fetch_assoc()['id_anggota'];
// $querry = $conn->query("UPDATE * FROM tb_anggota WHERE id_anggota = '$query'");
$assoc = $result->fetch_assoc();
                        

// $sql = $conn->query("SELECT * FROM tb_buku INNER JOIN tb_anggota ON tb_buku.id_buku = tb_anggota.id_anggota") or die(mysqli_error($conn));
$a =  rand(10,4223);

if(isset($_POST['tambah'])) {
    
    $kode_user = htmlspecialchars($_POST['kode_user']);
    $nama_user = htmlspecialchars($_POST['nama_user']);
    $nama_barang = htmlspecialchars($_POST['nama']);
    $tgl_pinjam = htmlspecialchars($_POST['tgl_pinjam']);
    $tgl_kembali = htmlspecialchars($_POST['tgl_kembali']);
    
    $update = "INSERT INTO `data` (`id`, `kode_user`, `nama_user`, `nama_barang`, `tgl_pinjam`, `tgl_kembali`, `status`) 
    VALUES (NULL, '$kode_user', '$nama_user', '$nama_barang', '$tgl_pinjam', '$tgl_kembali', 'Proses');";
    $querry = mysqli_query($conn, $update);
    if($querry == true) {
		echo "<script>alert('Data Berhasil Ditambahkan.');window.location='?p=transaksi';</script>";
	} else {
		echo "<script>alert('Data Gagal Ditambahkan.')</script>";
	}

    
        
    }


?>

<h1 class="mt-4">Tambah Data Transaksi</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
    <li class="breadcrumb-item active">tambah data transaksi</li>
</ol>
<div class="card-header mb-5">
	
	<form action="" method="post">
    <div class="form-group">
        <label for="tgl_pinjam">Kode User</label>
        <input type="text" name = "kode_user" class="form-control" readonly="" value="<?= $a ?>">
    </div>
    <div class="form-group">
        <label for="tgl_pinjam">Nama User</label>
        <select name="nama_user" class="form-control">
        <?php 
            $querry = $conn->query("SELECT * FROM tb_anggota ");
            while ($data = $querry->fetch_assoc()) {
            ?>
            <option value="<?=$data['nama_anggota']?>"><?=$data['nama_anggota']?></option>
            <?php } ?>
        </select>
        <!-- <input type="text" class="form-control" name="nama_user" readonly="" value="<?= $assoc['nama_anggota'] ?>"> -->
    </div>
    <div class="form-group">
        <label class="small mb-1" for="nama_buku">Nama Barang</label>
        <select name="nama" class="form-control">
            <option value="">-- Pilih Salah Satu --</option>
            <?php 
            $querry = $conn->query("SELECT * FROM tb_pinjam ");
            while ($data = $querry->fetch_assoc()) {
            ?>
            <option value="<?=$data['nama']?>"><?=$data['nama']?></option>
            <?php } ?>
        </select>
    </div>
    
    <div class="form-group">
        <label for="tgl_pinjam">Tanggal Pinjam</label>
        <input type="date" name="tgl_pinjam" id="tgl_pinjam" class="form-control">
    </div>
    
    <div class="form-group">
        <label for="tgl_pinjam">Tanggal Kembali</label>
        <input type="date" name="tgl_kembali" id="tgl_pinjam" class="form-control">
    </div>
    
    
    <div class="form-group">
    	<button type="submit" class="btn btn-primary" name="tambah">Tambah Data</button>
    </div>
	</form>
</div>