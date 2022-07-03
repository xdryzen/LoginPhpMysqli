<?php
session_start();
require "koneksi.php";
if(!isset($_SESSION['login'])){
	header('Location: login.php');
	exit;
}
$mahasiswa = query("SELECT * FROM data_mahasiswa");
if(isset($_POST['cari'])){
	$mahasiswa = cari($_POST["ky"]);
}
?>
<!Doctype html>
<html lang="id">
	<head>
		<meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
	</head>
	<body>
		<a href="logout.php">LOGOUT</a>
		<h1>TABEL MAHASISWA</h1>
		<a href="tambah.php">Tambahkan Data Mahasiswa</a>
		<br>
		<br>
		<form action="" method="post">
			<input type="text" name="ky"  size="35" placeholder="masukan katakunci pencarian...." autocomplete="off" autofocus><button type="submit" name="cari">Cari</button>
		</form>
		<br>
		<table border="1px" cellpadding="10px" cellspacing="0" >
			<tr style="background:#00A7FF;">
				<th>
					No.
				</th>
				<th>
					Pengaturan 
                </th>
                <th>
                	NRP
                </th>
                <th>
                	Gambar
                </th>
                <th>
                	Nama
                </th>
                <th>
                	Email
                </th>
                <th>
                	Jurusan 
                </th>
			</tr>
			<?php $nomor=1;?>
			<?php foreach($mahasiswa as $m): ?>
				<tr>
					<td>
						<?=$nomor?>
					</td>
					<td>
						<a href="hapus.php?id=<?=$m['id'];?>" onclick="return confirm('yakin ?')";>Hapus</a> | <a href="ubah.php?id=<?=$m['id'];?>">Ubah</a>
					</td>
					<td>
						<?=$m["nrp"]?>
					</td>
					<td>
						<img src="<?=$m["gambar"]?>" width="50px" height="50px"/>
					</td>
					<td>
						<?=$m["nama"]?>
					</td>
					<td>
						<?=$m["email"]?>
					</td>
					<td>
						<?=$m["jurusan"]?>
					</td>
				</tr>
			<?php $nomor++;?>
			<?php endforeach;?>
		</table>
	</body>
</html>