<?php
  session_start();
  if(isset($_SESSION['login'])){
	header('Location: index.php');
	exit;
  }
  require "koneksi.php";
  if(isset($_POST['login'])){
  	$username = $_POST['user'];
      $password = $_POST['pass'];
      $result = mysqli_query($koneksi,"SELECT * FROM user WHERE username = '$username'"); 
      if(mysqli_num_rows($result) === 1){
          $row = mysqli_fetch_assoc($result);
          if(password_verify($password,$row['password'])){
          $_SESSION["login"] = true;
          header("Location: index.php");
          exit;
          }
      }else{
     echo "<p style='font-weight:bold;color:red;'>username / password salah</p>";
     }
  }
?>
<!Doctype html>
<html lang="id">
	<head>
		<meta name='viewport' content='devive=device-width,initial-scale=1.0,user-scalable=no'>
		<title>Halaman Login</title>
	</head>
	<body>
		<h1>LOGIN ADMINISTRATOR</h1>
		<form action="" method="post">
			<label>Username</label>
			<br>
			<input type='text' name='user'>
			<br>
			<label>Password</label>
			<br>
			<input type='password' name='pass'>
			<br>
			<br>
			<input type='submit' name='login' value='Login'>
		</form>
		<br>
		<br>
		<a href="registerasi.php">Registrasi</a>
	</body>
</html>