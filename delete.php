<?php
//koneksi ke database
include "./koneksidb.php";

//mengambil data yang akan dihapus dari parameter URL
$id = $_GET['id'];

//query untuk menghapus data dari tabel users berdasarkan id
$query = "DELETE FROM users WHERE id = '$id'";
mysqli_query($conn, $query);

//menutup koneksi database
mysqli_close($conn);

//redirect kembali ke halaman read
header("location: readuser.php");
exit();
?> 