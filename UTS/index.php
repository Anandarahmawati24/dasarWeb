<?php
session_start();

// Cek apakah pengguna sudah login
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

// logout
if (isset($_POST["logout"])) {
    session_destroy();
    header("Location: login.php");
    exit;
}
?><!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sistem Pencatatan Kas Bank Sampah</title>
    <link rel="stylesheet" href="index.css" type="text/css">
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <h2>Menu</h2>
        <ul>
            <li><a href="anggota.php">Anggota</a></li>
            <li><a href="pembayaran.php">Pembayaran</a></li>
            <li><a href="akun.php">Akun</a></li>
        </ul>
        <form action="" method="POST" style="margin-top: 20px;">
            <button type="submit" name="logout">Logout</button>
        </form>
    </div>

    <!-- Konten Utama -->
    <div class="container" id="container">
        <header>
            <button id="toggle-button" onclick="toggleSidebar()">☰</button> <!-- Tombol Toggle Sidebar -->
            <h1>Sistem Pencatatan Kas Bank Sampah</h1>
        </header>

        <main>
        <img src="gambar/homepage2.jpg" alt="Gambar" class="centered-image" />
        <h2>Selamat Datang di Sistem Pencatatan Kas Bank Sampah</h2>
        <p>Website ini merupakan sebuah inovasi untuk pencatatan Kas Bank Sampah yang dibayarkan setiap bulannya kepada masing-masing RT.
        Website ini diharapkan dapat membantu pencatatan kas bank sampah menjadi lebih terorganisir dan bisa diakses dari mana saja.
        Website ini dapat mengelola anggota, dan pembayaran kas anda setiap bulannya.</p>
        </main>
        <footer>
            <p>&copy; 2024 Kas Bank Sampah.</p>
        </footer>
    </div>
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const container = document.getElementById('container');
            sidebar.classList.toggle('active'); 
            container.classList.toggle('shift'); 
        }
    </script>
</body>
</html>