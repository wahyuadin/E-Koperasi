<?php 
// menampilkan DB buku
$datauser = $conn->query("SELECT * FROM tb_user ORDER BY id_user DESC") or die(mysqli_error($conn));

?>
<h1 class="mt-4">Data User</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
    <li class="breadcrumb-item active">pengajuan admin</li>
</ol>
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table mr-1"></i>
        Data User
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Verifikasi Email</th>
                        <th>Status admin</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    // $datauser->fetch_assoc(); 
                    while ($data = $datauser->fetch_assoc()) {
                        if ($data['user'] == '0') {
                            $user =  "Admin";
                        }else {
                            $user = "User Biasa";
                        }
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $data['nama']; ?></td>
                        <td><?= $data['username']; ?></td>
                        <td><?= $data['email']; ?></td>
                        
                        <td><?= $data['verif']; ?></td>
                        <td><?= $user; ?></td>
                        <td>
                            <a href="?p=request_admin&aksi=ubah&id=<?= $data['id_user']; ?>" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
                            <a href="?p=request_admin&aksi=hapus&id=<?= $data['id_user']; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash" onclick="return confirm('Yakin ?')"></i></a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>