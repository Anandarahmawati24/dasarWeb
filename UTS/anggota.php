<?php
session_start(); // Memulai session
if (!isset($_SESSION["login"])) {
    header("Location: login.php"); // Arahkan ke halaman login 
    exit;
}
include 'koneksi_database.php'; 

// Proses menambah anggota
if (isset($_POST['tambah'])) {
    tambahAnggota($_POST);
}

// Proses mengedit anggota
if (isset($_POST['edit'])) {
    $id_anggota = $_POST['id_anggota'] ?? null; 
    if ($id_anggota) {
        editAnggota($_POST); 
    } else {
        throw new InvalidArgumentException("ID Anggota tidak ditemukan.");
    }
}

// Proses menghapus anggota
if (isset($_POST['hapus'])) {
    $id_anggota = $_POST['id_anggota'] ?? null; 
    if ($id_anggota) {
        hapusAnggota($id_anggota);
    } else {
        throw new InvalidArgumentException("ID tidak boleh kosong.");
    }
}

// Mengambil data anggota
$anggotaList = getAllAnggota();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Anggota - Kas Bank Sampah</title>
    <link rel="stylesheet" href="anggota.css" type="text/css">
</head>
<body>
    <button id="toggle-button" onclick="toggleSidebar()">☰</button>
    <div class="sidebar" id="sidebar">
        <h2>Menu</h2>
        <ul>
            <li><a href="index.php">Home Page</a></li>
            <li><a href="pembayaran.php">Pembayaran</a></li>
            <li><a href="akun.php">Akun</a></li>
        </ul>
        <form action="logout.php" method="POST" style="margin-top: 20px;">
            <button type="submit" name="logout" id="button2">Logout</button>
        </form>
    </div>
    <div class="container" id="container">
        <h1>Data Anggota</h1>
        <button onclick="toggleTambahForm()">Tambah Anggota</button>
        <div id="tambahForm" style="display:none;">
            <h2>Tambah Anggota</h2>
            <form method="POST" action="">
                <div class="form-group">
                    <label for="nama">Nama:</label>
                    <input type="text" name="nama" required>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat:</label>
                    <input type="text" name="alamat" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="id_rt">ID RT:</label>
                    <input type="text" name="id_rt" required>
                </div>
                <input type="submit" name="tambah" value="+">
            </form>
        </div>
            <h2>Daftar Anggota</h2>
        <div id="editForm" style="display:none;">
            <h2>Edit Anggota</h2>
            <form method="POST" action="">
            <input type="hidden" name="id_anggota" id="edit-id" required>
        <div class="form-group">
            <label for="edit-nama">Nama:</label>
            <input type="text" name="nama" id="edit-nama" required>
        </div>
        <div class="form-group">
            <label for="edit-alamat">Alamat:</label>
            <input type="text" name="alamat" id="edit-alamat" required>
        </div>
        <div class="form-group">
            <label for="edit-email">Email:</label>
            <input type="email" name="email" id="edit-email" required>
        </div>
        <div class="form-group">
            <label for="edit-id_rt">ID RT:</label>
            <input type="text" name="id_rt" id="edit-id_rt" required>
        </div>
        <input type="submit" name="edit" value="Update Anggota">
        <button type="button" name="batal" onclick="closeEditForm()">Batal</button>
    </form>
</div>
<table>
    <thead>
        <tr>
            <th>ID Anggota</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Email</th>
            <th>ID RT</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($anggotaList as $anggota): ?>
            <tr>
                <td><?= htmlspecialchars($anggota['id_anggota'] ?? ''); ?></td>
                <td><?= htmlspecialchars($anggota['nama'] ?? ''); ?></td>
                <td><?= htmlspecialchars($anggota['alamat'] ?? ''); ?></td>
                <td><?= htmlspecialchars($anggota['email'] ?? ''); ?></td>
                <td><?= htmlspecialchars($anggota['id_rt'] ?? ''); ?></td>
                <td>
                    <button onclick="openEditForm('<?= htmlspecialchars($anggota['id_anggota']); ?>', '<?= htmlspecialchars($anggota['nama']); ?>', '<?= htmlspecialchars($anggota['alamat']); ?>', '<?= htmlspecialchars($anggota['email']); ?>', '<?= htmlspecialchars($anggota['id_rt']); ?>')">Edit</button>
                    <form method="POST" action="" style="display:inline;">
                        <input type="hidden" name="id_anggota" value="<?= htmlspecialchars($anggota['id_anggota'] ?? ''); ?>">
                        <input type="submit" name="hapus" value="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus anggota ini?');">
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
    </div>
    <script>
        function toggleTambahForm() {
            var form = document.getElementById('tambahForm');
            form.style.display = form.style.display === 'none' ? 'block' : 'none'; // Toggle display
        }
        function openEditForm(id_anggota, nama, alamat, email, id_rt) {
            document.getElementById('edit-id').value = id_anggota; // Isi ID anggota
            document.getElementById('edit-nama').value = nama;
            document.getElementById('edit-alamat').value = alamat;
            document.getElementById('edit-email').value = email;
            document.getElementById('edit-id_rt').value = id_rt;
            document.getElementById('editForm').style.display = 'block'; // Tampilkan form edit
        }
        function closeEditForm() {
            document.getElementById('editForm').style.display = 'none';
        }
    </script>
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