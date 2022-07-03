<?php
session_start();
require "koneksi.php";
if(!isset($_SESSION['login'])){
	header('Location: login.php');
    exit;
}
$id = $_GET["id"];
if(hapus($id)){
	echo "<script>alert('DATA BERHASIL DI HAPUS');document.location.href='index.php';</script>";
}else{
	echo "<script>alert('DATA GAGAL DI HAPUS');document.location.href='index.php';</script>";
}

?>