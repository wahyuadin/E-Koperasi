<?php 
require_once 'koneksi.php';

// function upload() {
// 	$namaFoto = $_FILES['foto']['name'];
// 	$ukuranFoto = $_FILES['foto']['size'];
// 	$error = $_FILES['foto']['error'];
// 	$tmpFoto = $_FILES['foto']['tmp_name'];

// 	if($error === 4) {
// 		echo "<script>alert('pilih gambar terlebih dahulu.');</script>";
// 		return false;
// 	}

// 	$fotoValid = ['jpg','jpeg','png'];
// 	$ektensiFoto = explode('.', $namaFoto);
// 	$ektensiFoto = strtolower(end($ektensiFoto));

// 	if(!in_array($ektensiFoto, $fotoValid)) {
// 		echo "<script>alert('yang anda upload bukan gambar.');</script>";
// 		return false;
// 	}

// 	// cek ukuran
// 	if($ukuranFoto > 1000000) {
// 		echo "<script>alert('ukuran gambar terlalu besar.');</script>";
// 		return false;
// 	}

// 	$fileNameBaru = uniqid();
// 	$fileNameBaru .= '.';
// 	$fileNameBaru .= $ektensiFoto;

// 	move_uploaded_file($tmpFoto, '../img/' . $fileNameBaru);
// 	return $fileNameBaru;
// }
function random_str(
    int $length = 64,
    string $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
): string {
    if ($length < 1) {
        throw new \RangeException("Length must be a positive integer");
    }
    $pieces = [];
    $max = mb_strlen($keyspace, '8bit') - 1;
    for ($i = 0; $i < $length; ++$i) {
        $pieces []= $keyspace[random_int(0, $max)];
    }
    return implode('', $pieces);
}





function register($data) {
	global $conn;
	$nama = htmlspecialchars($data['nama']);
	$username = $conn->real_escape_string($_POST['username']);
	$password = $conn->real_escape_string($_POST['password']);
	$password2 = $conn->real_escape_string($_POST['password2']);
	$email = stripslashes($_POST['email']);
	$email = mysqli_real_escape_string($conn, $email);

	// jika username sudah terdaftar
	$a = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username'");
	$b = mysqli_query($conn, "SELECT * FROM tb_user WHERE email = '$email'");

	if(mysqli_num_rows($a) >= 1) {
		echo "<script>alert('Username sudah terdaftar!');window.location='register.php';</script>";
	}
	elseif(mysqli_num_rows($b) >= 1) {
		echo "<script>alert('Email sudah terdaftar!');window.location='register.php';</script>";
	}


	elseif($password != $password2) {
		echo "<script>alert('konfirmasi password salah.');</script>";
		return false;
	}else {
		$password = password_hash($password, PASSWORD_DEFAULT);
		$query = mysqli_query($conn, "INSERT INTO tb_user (username,password,nama,foto,email) VALUES ('$username','$password','$nama','default.jpg','$email')");
		if ($query) {
			
			return $conn->affected_rows;
		}else {
			mysqli_error($conn);
		}

		// $conn->query("INSERT INTO tb_user VALUES (null, '$username', '$password', '$nama', 'default.jpg', $email)") or die(mysqli_error($conn));
		return $conn->affected_rows;
	}

	// if(strlen($username) < 6 ) {
	// 	echo "<script>alert('Password terlalu pendek, maksimal 6 digit');window.location='register.php';</script>";
	// 	return false;
	// }

	// cek gambar
	// $foto = upload();
	// if(!$foto) {
	// 	return false;
	// }

	
}

