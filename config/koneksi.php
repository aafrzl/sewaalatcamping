<?php 
$conn = new mysqli("localhost", "root", "", "sewaalatcamping");

if ($conn->connect_errno) {
  echo "Koneksi Gagal, silahkan coba lihat DB: " . $conn->connect_error;
  exit();
}

?>