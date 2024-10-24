<?php
session_start();

if (isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}

include 'koneksi_database.php'; 

// Ambil data RT untuk dropdown
$query = "SELECT id_rt, nama_rt FROM Rt";
$stmt = $conn->prepare($query);
$stmt->execute();
$rtOptions = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST["register"])) {
    if (registrasiAdmin($_POST) > 0) {
        echo "
            <script>
                alert('Admin berhasil dibuat');
                window.location.href = 'login.php'; // Arahkan ke halaman login
            </script>
        ";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registrasi Admin Kas Bank Sampah</title>
    <link rel="stylesheet" href="register.css" type="text/css">
</head>

<body style="height: 110vh;">
    <div class="container">
        <div class="register-box">
            <h1 class="login-title">Kas Bank Sampah</h1>
            <h3 class="auth-title">Registrasi Admin</h3>
            <form action="" method="POST">
                <div class="form-group-register">
                    <label for="nama">Nama</label>
                    <input type="text" class="input-register-text" name="nama" placeholder="Masukkan Nama Anda" required />
                </div>
                <div class="form-group-register">
                    <label for="email">Email</label>
                    <input type="email" class="input-register-text" name="email" placeholder="Masukkan Email Anda" required />
                </div>
                <div class="form-group-register">
                    <label for="username">Username</label>
                    <input type="text" class="input-register-text" name="username" placeholder="Masukkan Username Anda" required />
                </div>
                <div class="form-group-register">
                    <label for="password">Password</label>
                    <input type="password" class="input-register-text" name="password" placeholder="Masukkan Password Anda" required />
                </div>
                <div class="form-group-register">
                    <label for="password2">Konfirmasi Password</label>
                    <input type="password" class="input-register-text" name="password2" placeholder="Masukkan Konfirmasi Password Anda" required />
                </div>
                <div class="form-group-register">
                    <label for="id_rt">Pilih RT</label>
                    <select name="id_rt" class="input-register-text" required>
                     <option value="">-- Pilih RT --</option>
                     <?php foreach ($rtOptions as $rt): ?>
                    <option value="<?= htmlspecialchars($rt['id_rt']); ?>"><?= htmlspecialchars($rt['nama_rt']); ?></option>
                    <?php endforeach; ?>
                    </select>
                </div>
                <button class="btn-auth" type="submit" name="register" value="register">
                    Daftar
                </button>
            </form>
            <div style="margin-top: 15px; text-align:center;">
                <p>Sudah punya akun? <a href="login.php">Login</a></p>
            </div>
        </div>
    </div>
</body>
</html>