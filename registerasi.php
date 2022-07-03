<?php
  require "koneksi.php";
  if(isset($_POST['submit'])){
  	//var_dump($_POST);
  	if(registrasi($_POST) > 0){
  	     echo "<script>alert('user sukses di daftarkan');</script>";
           header("Location: login.php");
           exit;
  	}else{
  	    echo mysqli_error($koneksi);
  	}
  }
?>
<!Doctype html>
<html lang='id'>
	<head>
		<meta name='viewport' content='width=device-width,initial-scale=1.0,user-scalable=no'>
		<title>Halaman Registrasi</title>
	</head>
	<body>
		<h1>Halaman Registrasi ADMINISTRATOR</h1>
		<form action="" method="post">
			<label>username: </label>
			<br>
			<input type='text' name='user'  id='username' autocomplete="off" required/>
			<br>
			<label >password: </label>
			<br>
			<input type="password" name='pass'  id='pass' autocomplete="off" required/>
			<br>
			<label >konfirmasi password: </label>
			<br>
			<input  type="password" name='cpass'  id='k-pass' autocomplete="off" required/>
			<br>
			<br>
			<button type='submit' name='submit'> Registrasi</button>
		</form>
		<br>
		<a href="login.php">Login</a>
	</body>
</html>