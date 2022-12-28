<?php 

// menangkap id_buku di url
$id_user = $_GET['id'];
$s = "selected";

// menampilkan data db sesuai id_buku
$sql = $conn->query("SELECT * FROM tb_user WHERE id_user = $id_user") or die(mysqli_error($conn));
$pecahSql = $sql->fetch_assoc();
// var_dump($pecahSql['user']['0']);

// $tahun = $pecahSql['tahun_terbit'];

if(isset($_POST['ubah'])) {
	$username = htmlspecialchars($_POST['username']);
	$email = htmlspecialchars($_POST['email']);
	$nama = htmlspecialchars($_POST['nama']);
	$verif = htmlspecialchars($_POST['user']);
	// var_dump($username,$email,$nama,$verif);
    // die;

	$sql = $conn->query("UPDATE tb_user SET username = '$username', email = '$email', nama = '$nama' , user = '$verif' WHERE id_user = $id_user") or die(mysqli_error($conn));
	if($sql) {
		echo "<script>alert('Data Berhasil Diubah.');window.location='?p=request_admin';</script>";
	} else {
		echo "<script>alert('Data Gagal Diubah.');window.location='?p=request_admin';</script>";
	}
}

?>

<h1 class="mt-4">Ubah Data User</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
    <li class="breadcrumb-item active">Ubah Data User</li>
</ol>
<div class="card-header mb-5">
	
	<form action="" method="post">
    <div class="form-group">
        <label class="small mb-1" for="judul_buku">Username</label>
        <input class="form-control" name="username" type="text" placeholder="Masukan judul buku" value="<?= $pecahSql['username']; ?>" />
    </div>
    <div class="form-group">
        <label class="small mb-1" for="pengarang_buku">Email</label>
        <input class="form-control" id="pengarang_buku" name="email" type="email" value="<?= $pecahSql['email']; ?>" placeholder="Masukan pengarang buku"/>
    </div>
    <div class="form-group">
        <label class="small mb-1" for="penerbit_buku">Nama</label>
        <input class="form-control" id="penerbit_buku" name="nama" type="text" value="<?= $pecahSql['nama']; ?>" placeholder="Masukan penerbit buku"/>
    </div>
   
    <div class="form-group">
        <label class="small mb-1" for="isbn">Verifikasi Email</label>
        <input class="form-control" value="<?= $pecahSql['verif']; ?>" id="isbn" name="verif" type="text" disabled/>
    </div>
    <div class="form-group">
        <label class="small mb-1" for="tahun_terbit">Data User</label>
        <select name="user" id="tahun_terbit" class="form-control">
        	<option>-- Pilih Salah Satu --</option>
        	<option <?php if ($pecahSql['user'] == 0) { echo 'selected'; }?> value="0" >Admin</option>
        	<option <?php if ($pecahSql['user'] == 1) { echo 'selected'; }?> value="1" >User Biasa</option>
        </select>
    </div>
    <div class="form-group">
    	<button type="submit" class="btn btn-primary" name="ubah">Ubah Data</button>
    </div>
	</form>
</div>