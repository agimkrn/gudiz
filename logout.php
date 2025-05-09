<!-- File logout.php -->
<?php
session_start();  // Memulai sesi

// Menghapus semua data session
session_unset();

// Menghancurkan session
session_destroy();

// Mengarahkan ke halaman login setelah logout
header("Location: ../login.php");
exit();
?>
