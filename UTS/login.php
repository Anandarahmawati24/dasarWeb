<?php
session_start(); // Memulai session

// Cek apakah pengguna sudah login
if (isset($_SESSION["login"])) {
    header("Location: index.php"); 
    exit;
}

include 'koneksi_database.php'; 

if (isset($_POST["login"])) {
    $username = strtolower(trim($_POST["username"])); 
    $password = $_POST["password"]; 

    $stmt = $conn->prepare("SELECT * FROM admin_rt WHERE username = ?"); 
    $stmt->execute([$username]);

    $row = $stmt->fetch(PDO::FETCH_ASSOC); 
    if ($row) {
        // Verifikasi password
        if ($row["password"] === $password) { 
            // Set sesi login
            $_SESSION['login'] = true; 
            $_SESSION['id_admin'] = $row['id_admin']; 
            $_SESSION['nama'] = $row['nama_adm']; 
            $_SESSION['username'] = $row['username']; 
            $_SESSION['id_rt'] = $row['id_rt']; 
            header("Location: index.php");
            exit;
        } else {
            $error = "Password salah!"; 
        }
    } else {
        $error = "Username tidak ditemukan!"; 
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
            <p style="color: red;"><?= htmlspecialchars($error); ?></p> 
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