<?php

session_start();



// Konfigurasi koneksi ke database

$servername = "mysql-141993-0.cloudclusters.net:12570";

$username_db = "admin";

$password_db = "zC2FMinr";

$dbname = "datashell";



// Membuat koneksi ke database

$conn = new mysqli($servername, $username_db, $password_db, $dbname);



// Memeriksa koneksi

if ($conn->connect_error) {

    die("Koneksi gagal: " . $conn->connect_error);

}



if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST["username"];

    $password = $_POST["password"];



    // Hash password menggunakan SHA-256

    $password_hash = hash('sha256', $password);



    // Memeriksa kredensial login

    $sql = "SELECT username, expiry_time FROM users WHERE username = '$username' AND password_hash = '$password_hash'";

    $result = $conn->query($sql);



    if ($result->num_rows == 1) {

        // Login berhasil, simpan username dalam session dan arahkan ke halaman profil

        $_SESSION["username"] = $username;

        header("Location: profil.php");

        exit();

    } else {

        // Login gagal, tampilkan pesan error dan kembali ke halaman login

        echo "Login gagal. Coba lagi.";

        header("Location: index.php");

        exit();

    }

}

?>

