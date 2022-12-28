<?php 
session_start();
require_once 'config/koneksi.php';

if(!isset($_SESSION['login'])) {
    header("Location: login.php");
    $_SESSION['nothing'] = 'Anda Tidak Dapat Membuka Halaman ini';
    exit;
}


if (isset($_POST['kirim'])) {
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $tempat = $_POST['tempat'];
    $ttl = $_POST['ttl'];
    $jk = $_POST['jk'];
    $prodi = $_POST['prodi'];
    $query = mysqli_query($conn, "INSERT INTO tb_anggota (nim,nama_anggota,tempat_lahir,tgl_lahir,jk,prodi) VALUES ('$nim','$nama','$tempat','$ttl','$jk','$prodi')");

    if (!$query) {
        echo "Program Error";
        die;
    }
    
}
$page = @$_GET['p'];
$aksi = @$_GET['aksi'];
$a = $_SESSION['login']['nama'];
$query = mysqli_query($conn, "SELECT * FROM tb_user where nama = '$a'");
$row = $query->fetch_assoc();



?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>
            <?php
            if($page == 'buku') {
                if($aksi == 'tambah') {
                    echo "Tambah Buku";
                } else if($aksi == 'ubah') {
                    echo "Ubah Buku";
                } else {
                    echo "Halaman Buku";
                }
                
            } else if($page == 'anggota') {
                if($aksi == 'tambah') {
                    echo "Tambah Anggota";
                } else if($aksi == 'ubah') {
                    echo "Ubah Anggota";
                } else {
                    echo "Halaman Anggota";
                }
            } else if($page == 'transaksi') {
                if($aksi == 'tambah') {
                    echo "Pinjam Buku";
                } else {
                    echo "Peminjaman Buku";
                }
            }elseif ($page == 'request_admin') {
                echo "Halaman Admin";
            }else {
                echo "Dashboard Admin";
            }
            // if(isset($page)) { 
            //     if($_GET['p'] == 'buku') {
            //         echo "Halaman Buku";
            //     } else if($_GET['p'] == 'anggota') {
            //         echo "Halaman Anggota";
            //     } else if($_GET['p'] == 'transaksi') {
            //         echo "Halaman Transaksi";
            //     }
            // } else {
            //     echo "Dashboard";
            // }
            ?>
        </title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="js/fontawesomeall.min.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="">Koperasi Digital</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <div class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0"></div>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#">Settings</a>
                        <a class="dropdown-item" href="#">Activity Log</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="user.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <?php
                            $a = $_SESSION['login']['username'];
                            $query = mysqli_query($conn, "SELECT * FROM tb_user WHERE username='$a'");
                            $row = $query->fetch_assoc();
                            
                            if ($row['status'] == '1') { ?>
                            <div class="sb-sidenav-menu-heading">Data</div>
                           
                            <a class="nav-link" href="?p=buku">
                                <div class="sb-nav-link-icon"><i class="fa fa-book" aria-hidden="true"></i></div>
                                Data
                            </a>
                            <a class="nav-link" href="?p=transaksi">
                                <div class="sb-nav-link-icon"><i class="fa fa-handshake" aria-hidden="true"></i></div>
                                Data Peminjaman
                            </a>
                            <?php } ?>
                           
                            
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Start Bootstrap
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <marquee behavior="scroll" class="btn btn-dark">Selamat Datang <b><?= $_SESSION['login']['nama']; ?></b> dashboard admin aplikasi E-Koperasi.</marquee>
                    <div class="container-fluid">
                        <!-- <h1 class="mt-4">Static Navigation</h1> -->
                    <?php 

                    if($page == 'buku') {
                        if($aksi == '') {
                            require_once 'page/user/buku.php';
                        } else if($aksi == 'tambah') {
                            require_once 'page/buku/tambah.php';
                        } else if($aksi == 'ubah') {
                            require_once 'page/buku/ubah.php';
                        } else if($aksi == 'hapus') {
                            require_once 'page/buku/.phphapus';
                        }
                    } else if($page == 'anggota') {
                        if($aksi == '') {
                            require_once 'page/anggota/anggota.php';
                        } else if($aksi == 'tambah') {
                            require_once 'page/anggota/tambah.php';
                        } else if($aksi == 'ubah') {
                            require_once 'page/anggota/ubah.php';
                        } else if($aksi == 'hapus') {
                            require_once 'page/anggota/hapus.php';
                        }
                    } else if($page == 'transaksi') {
                        if($aksi == '') {
                            require_once 'page/user/pinjam/pinjam.php';
                        } else if($aksi == 'tambah') {
                            require_once 'page/user/pinjam/tambah.php';
                        } else if($aksi == 'kembali') {
                            require_once 'page/transaksi/kembali.php';
                        } else if($aksi == 'perpanjang') {
                            require_once 'page/transaksi/perpanjang.php';
                        }
                    }else if ($page == 'request_admin'){
                        if ($aksi == '') {
                            require_once 'page/admin/admin.php';
                        }elseif ($aksi == 'ubah') {
                            require_once 'page/admin/ubah.php';
                        }elseif ($aksi == 'hapus') {
                            require_once 'page/admin/hapus.php';
                        }
                    }else { ?>
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <!-- <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li> -->
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    <?php
                    }
                    ?>
                       <!-- ruang -->
                       <div class="p-1">
                        <h4>Selamat Datang <?=$_SESSION['login']['nama']?>!</h4>
                        <?php if ($row['status'] == '1') { ?>
                        <div class="alert alert-primary" role="alert">
                            Form Berhasil di input! Jika ada data yang salah, silahkan hubungi admin.
                        </div>
                        <?php } ?>
                        <?php if ($row['status'] == '0') { ?>
                        <p>Untuk proses peminjaman buku, silahkan isi data diri anda sesuai form di bawah.</p>
                       <form action="user.php" method="post">
                        <div class="form-group">
                            <label for="">Nama</label>
                            <input type="text" name="nama" id="tgl_kembali" class="form-control" placeholder="Masukan Nama" required>
                        </div>
                        <div class="form-group">
                            <label for="">NIK</label>
                            <input type="text" name="nim" id="tgl_kembali" class="form-control" placeholder="Masukan NIK" required>
                        </div>
                        <div class="form-group">
                            <label for="">Tempat Lahir</label>
                            <input type="text" name="tempat" id="tgl_kembali" class="form-control" placeholder="Masukan Tanggal Lahir" required>
                        </div>
                        <div class="form-group">
                            <label for="">Tanggal Lahir</label>
                            <input type="date" name="ttl" id="tgl_kembali" class="form-control"  required>
                        </div>
                        <div class="form-group">
                            <label class="small mb-1">Jenis Kelamin</label>
                            <select name="jk" class="form-control">
                                <option>-- Pilih Salah Satu --</option>
                                <option value="L">Laki-Laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Alamat</label>
                            <input type="text" name="prodi" id="tgl_kembali" class="form-control" placeholder="Masukan Alamat" required>
                        </div>
                        <button class="btn btn-primary" name="kirim">Kirim</button>
                       </form>
                       <?php } ?>
                       </div>
                       <!-- ruang akhir -->
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2020</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script> -->
        <!-- <script src="assets/demo/chart-area-demo.js"></script> -->
        <!-- <script src="assets/demo/chart-bar-demo.js"></script> -->
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
    </body>
</html>
