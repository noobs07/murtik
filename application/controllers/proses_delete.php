<!--
Author : Aguzrybudy
Created : Selasa, 19-April-2016
Title : Crud Menggunakan Modal Bootsrap
-->
<?php
	include "koneksi.php";
	$id_diskon=$_GET['id_diskon'];
	$affanuta_admin_web=mysqli_query($koneksi,"Delete FROM affanuta_admin_web WHERE id_diskon='$id_diskon'");
	header('location:index.php');
?>