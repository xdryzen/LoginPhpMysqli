<?php
  session_start();
  if(!isset($_SESSION['login'])){
	header('Location: login.php');
    exit;
  }
  require "koneksi.php";
  $id = $_GET['id'];
  
  $mhs = query("SELECT * FROM  data_mahasiswa WHERE id=$id")[0];
  
  if(isset($_POST["ubah"])){
  	//var_dump($_POST);
     if(ubah($_POST)>0){
     	echo "<script>alert(\"Data Berhasil Di Ubah\");</script>";
     }else{
     	echo "<script>alert(\"Data Gagal Di Ubah\");</script>";
     }
  }
?>
<hml>
<head>
<meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
<title>HALAMAN UBAH DATA MAHASISWA</title>
</head>
<body>
<a href="index.php">HALAMAN ADMIN</a>
<form action="" method="post" enctype="multipart/form-data" >
	<input type="hidden" name="id" value="<?=$mhs['id'];?>" />
	<input type="hidden" name="gambarLama"  value="<?=$mhs['gambar'];?>" />
	<ul>
	<li>
	<lable for="nrp">NRP :</label>
	<input type="text" name="nrp" id="nrp" value="<?=$mhs['nrp'];?>" required/>
	</li>
	<li>
	<lable for="nama">NAMA :</label>
	<input type="text" name="nama" id="nama"  value="<?=$mhs['nama'];?>" required/>
	</li>
	<li>
	<lable for="email">Email :</label>
	<input type="text" name="email" id="email" value="<?=$mhs['email'];?>" required/>
	</li>
	<li>
		<label for="jurusan">Jurusan</label>
		<input type="text" name="jurusan" id="jurusan" value="<?=$mhs['jurusan'];?>" required/>
	</li>
	<li>
	<label for="gambar">gambar</label><br>
	   <img src="<?=$mhs['gambar'];?>" width="50px"><br>
		<input type="file" name="gambar" id="gambar" accept="image/*" />
	</li>
		<button type="submit" name="ubah">TERAPKAN</button>
	</li>
	</ul>
</form>
</body>
</html>