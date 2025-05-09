<!-- File koneksi.php -->
<?php
$host = 'localhost';
$user = 'root'; // ganti jika user DB kamu beda
$pass = '';     // ganti jika ada password
$db   = 'gudang';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die('Koneksi database gagal: ' . $conn->connect_error);
}
?>
