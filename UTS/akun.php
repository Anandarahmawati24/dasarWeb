<?php
session_start();

// Cek apakah pengguna sudah login
if (!isset($_SESSION["login"])) {
    header("Location: login.php"); // Arahkan ke halaman login jika belum login
    exit;
}

include 'koneksi_database.php'; // Menginclude file yang berisi koneksi database

// Mengambil username dari session
$username = $_SESSION['username'];
$stmt = $conn->prepare("SELECT * FROM admin_rt WHERE username = ?");
$stmt->execute([$username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Cek apakah data pengguna ditemukan
if (!$user) {
    echo "Data akun tidak ditemukan!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akun Pengguna - Kas Bank Sampah</title>
    <link rel="stylesheet" href="akun.css" type="text/css">
</head>
<body>
    <div class="container">
        <h1>Akun Pengguna</h1>
        <p><strong>Nama:</strong> <?= htmlspecialchars($user['nama_adm']); ?></p>
        <p><strong>Username:</strong> <?= htmlspecialchars($user['username']); ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($user['email']); ?></p>
        <p><strong>ID RT:</strong> <?= htmlspecialchars($user['id_rt']); ?></p>
    </div>
    <button id="toggle-button" onclick="toggleSidebar()">☰</button>
    <div class="sidebar" id="sidebar">
        <h2>Menu</h2>
        <ul>
            <li><a href="index.php">Home Page</a></li>
            <li><a href="pembayaran.php">Pembayaran</a></li>
            <li><a href="anggota.php">Anggota</a></li>
        </ul>
        <form action="logout.php" method="POST" style="margin-top: 20px;">
            <button type="submit" name="logout" id="button2">Logout</button>
        </form>
        <script>
    function toggleSidebar() {
                const sidebar = document.getElementById('sidebar');
                const container = document.getElementById('container');
                sidebar.classList.toggle('active'); 
                container.classList.toggle('shift'); 
            }
            </script>
    </div>
</body>
</html>
