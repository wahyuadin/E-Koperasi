<?php 
// menampilkan DB buku
// $ambilBuku = $conn->query("SELECT * FROM tb_buku ORDER BY id_buku DESC") or die(mysqli_error($conn));
$getdata = $conn->query("SELECT * FROM tb_pinjam ORDER BY id DESC") or die(mysqli_error($conn));

?>
<h1 class="mt-4">Data Pinjaman</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="">Dashboard</a></li>
    <li class="breadcrumb-item active">Data Pinjaman</li>
</ol>
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table mr-1"></i>
        Data Pinjaman
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                    <tr>
                        <th>No</th>
                        <th>Kategori</th>
                        <th>Nama Barang</th>
                        <th>Tahun Rilis</th>
                        <th>Harga Satuan Unit</th>
                        <th>Jumlah Unit</th>
                        <!-- <th>Aksi</th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    while ($data = $getdata->fetch_assoc()) {
                    
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $data['kategori']; ?></td>
                        <td><?= $data['nama']; ?></td>
                        <td><?= $data['tahun']; ?></td>
                        <td>Rp <?php echo ( number_format($data['harga'])); ?></td>
                        <td><?= $data['unit']; ?> Unit</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>