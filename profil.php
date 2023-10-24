<?php

session_start();



// Memeriksa apakah user sudah login atau belum

if (!isset($_SESSION["username"])) {

    header("Location: index.php");

    exit();

}



// Konfigurasi koneksi ke database

$servername = "";

$username_db = "";

$password_db = "";

$dbname = "";



// Membuat koneksi ke database

$conn = new mysqli($servername, $username_db, $password_db, $dbname);



// Memeriksa koneksi

if ($conn->connect_error) {

    die("Koneksi gagal: " . $conn->connect_error);

}



// Mendapatkan data dari tabel users berdasarkan username

$username = $_SESSION["username"];

$sql = "SELECT username, expiry_time FROM users WHERE username = '$username'";

$result = $conn->query($sql);



if ($result->num_rows > 0) {

    $row = $result->fetch_assoc();

    $username = $row['username'];

    $expiry_time = strtotime($row['expiry_time']);



    // Hitung sisa waktu dari sekarang hingga expiry_time

    $current_time = time();

    $time_left = $expiry_time - $current_time;

    $days_left = floor($time_left / (60 * 60 * 24));

    $hours_left = floor(($time_left % (60 * 60 * 24)) / (60 * 60));

    $minutes_left = floor(($time_left % (60 * 60)) / 60);

    $seconds_left = $time_left % 60;

} else {

    echo "Data user tidak ditemukan.";

}



// Menutup koneksi

$conn->close();

?>



<!DOCTYPE html>

<html>
<head>
    <title>Profil User</title>
    <!-- Tambahkan link ke file CSS Tailwind -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

    <div class="flex items-center justify-center h-screen">
        <div class="bg-white p-8 rounded shadow-md max-w-sm w-full">
            <h1 class="text-2xl font-semibold mb-6">Profil User</h1>
            <p class="mb-4">Username: <?php echo $username; ?></p>
            <p class="mb-4">Waktu Kadaluwarsa: <?php echo date('Y-m-d H:i:s', $expiry_time); ?></p>
            <p class="mb-4">Sisa Waktu: <span id="countdown"></span></p>
            
            <!-- Tambahkan tombol logout -->
            <a href="logout.php" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Logout</a>
		<a href="https://t.me/Nullcyber_X" target="_blank" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Perpanjang</a>
        </div>
    </div>

    <script>
        // Mendapatkan waktu kadaluwarsa dalam detik
        var expiryTime = <?php echo $expiry_time; ?>;

        // Fungsi untuk mengupdate countdown timer
        function updateCountdown() {
            // Mendapatkan waktu sekarang dalam detik
            var currentTime = Math.floor(Date.now() / 1000);

            // Menghitung sisa waktu dalam detik
            var timeLeft = expiryTime - currentTime;

            // Menghitung hari, jam, menit, dan detik yang tersisa
            var days = Math.floor(timeLeft / (60 * 60 * 24));
            var hours = Math.floor((timeLeft % (60 * 60 * 24)) / (60 * 60));
            var minutes = Math.floor((timeLeft % (60 * 60)) / 60);
            var seconds = timeLeft % 60;

            // Menampilkan sisa waktu pada elemen dengan id "countdown"
            document.getElementById("countdown").innerHTML = days + " hari, " + hours + " jam, " + minutes + " menit, " + seconds + " detik";

            // Jika waktu sudah habis, arahkan kembali ke halaman login
            if (timeLeft <= 0) {
                window.location.href = 'logout.php';
            }
        }

        // Memanggil fungsi updateCountdown setiap 1 detik
        setInterval(updateCountdown, 1000);
    </script>

</body></html>

