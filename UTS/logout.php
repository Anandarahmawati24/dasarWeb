<?php
session_start(); // Memulai sesi

// Menghancurkan semua data sesi
session_destroy();

// Mengarahkan pengguna ke halaman login
header("Location: login.php");
exit; // Pastikan tidak ada kode lain yang dieksekusi setelah pengalihan
?>

<!DOCTYPE html>
<html>
<form action="logout.php" method="POST" style="display:inline;">
    <button type="submit">Logout</button>
</form>
</html>