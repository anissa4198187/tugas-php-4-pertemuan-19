<?php

//inisiasi data pada database 
$namaserver = "localhost";
$username = "root";
$password = "";
$namadb = "arkatamastore";

//perintah untuk menghubungkan php ke dalam suatu database
$conn = new mysqli($namaserver, $username, $password, $namadb);

//peringatan apabila koneksi gagal
if (!$conn){
    echo "koneksi failed";
}

?>