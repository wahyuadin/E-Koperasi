<?php 
require_once 'function.php';
// menampilkan DB buku
// $ambilTransaksi = $conn->query("SELECT * FROM tb_transaksi WHERE status = 'pinjam'") or die(mysqli_error($conn));

$sql = $conn->query("SELECT * FROM tb_transaksi INNER JOIN tb_buku
										ON tb_transaksi.id_buku = tb_buku.id_buku INNER JOIN tb_anggota 
										ON tb_transaksi.id_anggota = tb_anggota.id_anggota WHERE status = 'pinjam'
										") or die(mysqli_error($conn));

$joint =$conn->query( "SELECT id,id_anggota,nim,nama_anggota,kategori,tgl_pinjam,tgl_kembali,nama, status FROM tb_anggota INNER JOIN tb_pinjam ON tb_pinjam.id=tb_anggota.id_anggota");
$query =$conn->query("SELECT * FROM data");


?>
<!-- <pre>
	<?php var_dump($pecah); ?>
</pre> -->
<h1 class="mt-4">Riwayat Peminjaman</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="">Dashboard</a></li>
    <li class="breadcrumb-item active">Riwayat Transaksi</li>
</ol>
<div class="col-md-6">
    <a href="?p=transaksi&aksi=tambah" class="btn btn-primary mb-3"><i class="fa fa-plus"></i> Ajukan Peminjaman Barang</a>
</div>
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table mr-1"></i>
    Riwayat Transaksi
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode User</th>
                        <th>Nama user</th>
                        <!-- <th>Kategori</th> -->
                        <th>Nama Barang</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Kembali</th>
                        <th>Status</th>
                        <!-- <th>Aksi</th> -->
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $no = 1;
                    while ($pecah = $query->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $pecah['kode_user']; ?></td>
                        <td><?= $pecah['nama_user']; ?></td>
                        <td><?= $pecah['nama_barang']; ?></td>
                        <td><?= $pecah['tgl_pinjam']; ?></td>
                        <td><?= $pecah['tgl_kembali']; ?></td>
                        <td><span class="badge badge-warning"><?= $pecah['status']; ?></span></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <h5>Note</h5>
            <p>Jika pengajuan pada status adalah acc, silahkan hubungi admin dengan <a href="https://api.whatsapp.com/send?phone=6287483718474">Klik Disini</a></p>
        </div>
    </div>
</div>