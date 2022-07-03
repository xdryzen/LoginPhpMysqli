<?php
define("HOST","127.0.0.1");
define("USER","root");
define("PASS","1234");
define("DB","phpdasar");
$koneksi = mysqli_connect(HOST,USER,PASS,DB);
function query($q){
	global $koneksi;
	$result = mysqli_query($koneksi,$q);
	$array = [];
	while($row=mysqli_fetch_assoc($result)){
		$array[]=$row;
	}
	return $array;
}
function tambah($data){
	global $koneksi;
	$nrp = htmlspecialchars($data["nrp"]);
    $nama=htmlspecialchars($data["nama"]);
    $email=htmlspecialchars($data["email"]);
    $jurusan=htmlspecialchars($data["jurusan"]);
    $gambar= upload();
    if(!$gambar){
    	return false;
    }
    $query = "INSERT INTO data_mahasiswa (nrp,nama,email,jurusan,gambar) VALUES ('$nrp','$nama','$email','$jurusan','$gambar')";
     mysqli_query($koneksi,$query);
     return mysqli_affected_rows($koneksi);
}
function upload(){
	$namaFile = $_FILES["gambar"]['name'];
	$ukuranFile = $_FILES["gambar"]['size'];
	$error = $_FILES["gambar"]['error'];
	$tmpNama = $_FILES["gambar"]["tmp_name"];
	
	//cek tidak ada gambar yang di upload
	if($error === 4){
		echo "<script>alert('Pilih Gambar Terlebih Dahulu !');</script>";
		return false;
	}
	$ekstensi_file = ["jpg","jpeg","png","gif"];
	$ekstensi_gambar = explode('.',$namaFile);
	$ekstensi_gambar = strtolower(end($ekstensi_gambar));
	if(!in_array($ekstensi_gambar,$ekstensi_file)){
		echo "<script>alert('Ma\'af berkas yang anda upload tidak di izinkan');</script>";
		return false;
	}
	if($ukuranFile > 1000000){
		echo "<script>alert('Ma\'af Ukuran File terlalu Besar');</script>";
		return false;
	}
	$namaFileBaru = uniqid();
	$namaFileBaru .='.';
	$namaFileBaru .= $ekstensi_gambar;
	move_uploaded_file($tmpNama,"img/".$namaFileBaru);
	return "img/".$namaFileBaru;
}
function hapus($id){
	global $koneksi;
	$query = "DELETE FROM data_mahasiswa WHERE id=$id";
	mysqli_query($koneksi,$query);
	return mysqli_affected_rows($koneksi);
}
function ubah($data){
	global $koneksi;
	$nrp = htmlspecialchars($data["nrp"]);
    $nama=htmlspecialchars($data["nama"]);
    $email=htmlspecialchars($data["email"]);
    $jurusan=htmlspecialchars($data["jurusan"]);
    $gambarLama=$data["gambarLama"];
    if($_FILES["gambar"]["error"] === 4){
       $gambar=$gambarLama;
    }else{
       $gambar=upload();
    }
    $id=$data["id"];
    $query = "UPDATE data_mahasiswa SET 
    nrp='$nrp',
    nama='$nama',
    email='$email',
    jurusan='$jurusan',
    gambar='$gambar'
    WHERE id=$id";
     mysqli_query($koneksi,$query);
     return mysqli_affected_rows($koneksi);
}
function cari($ky){
	$query =" SELECT * FROM data_mahasiswa
	WHERE  nama LIKE '%$ky%' OR
     email LIKE '%$ky%'  OR
     nrp LIKE '%$ky%' OR
     jurusan LIKE '%$ky%'
    ";
    return query($query);
}
function registrasi($data){
	global $koneksi;
	
	$username = strtolower(stripslashes($data['user']));
	$password = mysqli_real_escape_string($koneksi,$data['pass']);
	$cpassword = mysqli_real_escape_string($koneksi,$data['cpass']);
	
	//cek username
	$result = mysqli_query($koneksi,"SELECT username  FROM user WHERE username = '$username' ");
	if(mysqli_fetch_assoc($result)){
		echo "<script>alert(\"username yang dipilih sudah terdaftar !\");</script>";
		return false;
	}
	
	
	if($password !== $cpassword){
		echo "<script>alert('konfirmasi password tidak sesuai ! ');</script>";
		return false;
	}
	
	$password = password_hash($password,PASSWORD_DEFAULT);
	
	mysqli_query($koneksi,"INSERT INTO user (username, password) VALUES ('$username','$password')");
	
	return mysqli_affected_rows($koneksi);
}

?>