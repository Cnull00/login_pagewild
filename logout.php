<?php

// Memulai sesi
session_start();

// Menghapus semua data sesi
session_unset();

// Menghapus sesi dari server
session_destroy();

// Mengarahkan kembali ke halaman login
header("Location: index.php");
exit();
?>
