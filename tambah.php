<?php
  session_start();
  require "koneksi.php";
  if(!isset($_SESSION['login'])){
	header('Location: login.php');
	exit;
  }
  if(isset($_POST["tambah"])){
     if(tambah($_POST)>0){
     	echo "<script>alert(\"Data Berhasil Di Tambahkan\");</script>";
     }else{
     	echo "<script>alert(\"Data Gagal Di Tambahkan\");</script>";
     }
  }
?>
<hml>
<head>
<meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
<title>HALAMAN TAMBAH DATA MAHASISWA</title>
</head>
<body>
<a href="index.php">HALAMAN ADMIN</a>
<form action="" method="post" enctype="multipart/form-data">
	<ul>
	<li>
	<lable for="nrp">NRP :</label>
	<input type="text" name="nrp" id="nrp" autocomplete="off"/>
	</li>
	<li>
	<lable for="nama">NAMA :</label>
	<input type="text" name="nama" id="nama" autocomplete="off"/>
	</li>
	<li>
	<lable for="email">Email :</label>
	<input type="text" name="email" id="email"/>
	</li>
	<li>
		<label for="jurusan">Jurusan</label>
		<input type="text" name="jurusan" id="jurusan" autocomplete="off"/>
	</li>
	<li>
	<label for="gambar">gambar</label>
		<input type="file" name="gambar" id="gambar" accept="image/*"/>
	</li>
		<button type="submit" name="tambah">TAMBAHKAN</button>
	</li>
	</ul>
</form>
</body>
</html>