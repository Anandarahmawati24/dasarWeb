<?php
session_start(); // Memulai session

// Cek apakah pengguna sudah login
if (isset($_SESSION["login"])) {
    header("Location: index.php"); // Arahkan ke halaman utama jika sudah login
    exit;
}

include 'koneksi_database.php'; // Menginclude file yang berisi koneksi database

if (isset($_POST["login"])) {
    $username = strtolower(trim($_POST["username"])); // Ambil username dari form
    $password = $_POST["password"]; // Ambil password dari form

    // Menggunakan prepared statement dengan PDO untuk mencegah SQL Injection
    $stmt = $conn->prepare("SELECT * FROM admin_rt WHERE username = ?"); // Ganti nama tabel sesuai kebutuhan
    $stmt->execute([$username]);

    // Ambil data pengguna
    $row = $stmt->fetch(PDO::FETCH_ASSOC); // Ambil hasil sebagai array asosiatif

    // Cek apakah ada hasil (fetch() mengembalikan false jika tidak ada hasil)
    if ($row) {
        // Verifikasi password
        if ($row["password"] === $password) { // Ganti ini jika menggunakan hashing
            // Set sesi login
            $_SESSION['login'] = true; // Tandai bahwa pengguna sudah login
            $_SESSION['id_admin'] = $row['id_admin']; // Simpan id_admin pengguna
            $_SESSION['nama'] = $row['nama_adm']; // Simpan nama pengguna
            $_SESSION['username'] = $row['username']; // Simpan username
            $_SESSION['id_rt'] = $row['id_rt']; // Simpan id_rt dari hasil query

            // Redirect ke halaman utama
            header("Location: index.php");
            exit;
        } else {
            $error = "Password salah!"; // Pesan error jika password salah
        }
    } else {
        $error = "Username tidak ditemukan!"; // Pesan error jika username tidak ada
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Sistem Kas Bank Sampah</title>
    <link rel="stylesheet" href="login.css" type="text/css">
</head>
<body>
    <div class="container">
        <h2>Login Sistem Kas Bank Sampah</h2>
        <?php if (isset($error)) : ?>
            <p style="color: red;"><?= htmlspecialchars($error); ?></p> <!-- Menampilkan pesan error -->
        <?php endif; ?>
        <form method="POST" action="">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" name="username" placeholder="Masukkan username anda" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" placeholder="Masukkan password anda" required>
            </div>
            <input type="submit" name="login" value="Login">
        </form>
        <p>Belum memiliki akun? <a href="register.php">Daftar di sini</a></p> <!-- Link ke halaman register -->
    </div>
</body>
</html>