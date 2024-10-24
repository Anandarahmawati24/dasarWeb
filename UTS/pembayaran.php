<?php
session_start(); // Memulai session

// Cek apakah pengguna sudah login
if (!isset($_SESSION["login"])) {
    header("Location: login.php"); // Arahkan ke halaman login jika belum login
    exit;
}
include 'koneksi_database.php'; 
if (isset($_POST['tambah'])) {
    $data = [
        'id_anggota' => $_POST['id_anggota'],
        'bulan' => $_POST['bulan'],
        'tahun' => $_POST['tahun'],
        'tanggal_bayar' => $_POST['tanggal_bayar'],
        'jumlah_bayar' => $_POST['jumlah_bayar']
    ];
    tambahPembayaran($data); 
}

if (isset($_POST['edit'])) {
    $data = [
        'id_pembayaran' => $_POST['id_pembayaran'],
        'id_anggota' => $_POST['id_anggota'],
        'bulan' => $_POST['bulan'],
        'tahun' => $_POST['tahun'],
        'tanggal_bayar' => $_POST['tanggal_bayar'],
        'jumlah_bayar' => $_POST['jumlah_bayar']
    ];
    editbayar($data); 
}

if (isset($_POST['hapus'])) {
    $id_pembayaran = $_POST['id_pembayaran'] ?? null; 
    if ($id_pembayaran) {
        hapusPembayaran($id_pembayaran); 
    } else {
        throw new InvalidArgumentException("ID tidak boleh kosong.");
    }
}

$pembayaranList = getAllPembayaran();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pembayaran - Kas Bank Sampah</title>
    <link rel="stylesheet" href="pembayaran.css" type="text/css">
</head>
<body>
<button id="toggle-button" onclick="toggleSidebar()">☰</button>
    <div class="sidebar" id="sidebar">
        <h2>Menu</h2>
        <ul>
            <li><a href="index.php">Home Page</a></li>
            <li><a href="anggota.php">Anggota</a></li>
            <li><a href="akun.php">Akun</a></li>
        </ul>
        <form action="" method="POST" style="margin-top: 20px;">
            <button type="submit" name="logout">Logout</button>
        </form>
    </div>
    <div class="container" id="container">
        <h1>Data Pembayaran</h1>
        <button onclick="toggleTambahForm()">Tambah Pembayaran</button>
        <div id="tambahForm" style="display:none;">
            <h2>Tambah Pembayaran</h2>
            <form method="POST" action="">
                <div class="form-group">
                    <label for="id_anggota">ID Anggota:</label>
                    <input type="text" name="id_anggota" required>
                </div>
                <div class="form-group">
                    <label for="bulan">Bulan Bayar:</label>
                    <input type="text" name="bulan" required>
                </div>
                <div class="form-group">
                    <label for="tahun">Tahun Bayar:</label>
                    <input type="text" name="tahun" required>
                </div>
                <div class="form-group">
                    <label for="tanggal_bayar">Tanggal Bayar:</label>
                    <input type="date" name="tanggal_bayar" required>
                </div>
                <div class="form-group">
                    <label for="jumlah_bayar">Jumlah Bayar:</label>
                    <input type="number" name="jumlah_bayar" required>
                </div>
                <input type="submit" name="tambah" value="+">
            </form>
        </div>
        <h2>Daftar Pembayaran</h2>
        <table>
            <thead>
                <tr>
                    <th>ID Pembayaran</th>
                    <th>Nama Anggota</th>
                    <th>RT</th> 
                    <th>Bulan Bayar</th>
                    <th>Tahun Bayar</th>
                    <th>Tanggal Bayar</th>
                    <th>Jumlah Bayar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($pembayaranList as $pembayaran): ?>
                <tr>
                    <td><?= htmlspecialchars($pembayaran['id_pembayaran'] ?? ''); ?></td>
                    <td><?= htmlspecialchars($pembayaran['nama'] ?? ''); ?></td>
                    <td><?= htmlspecialchars($pembayaran['nama_rt'] ?? ''); ?></td>
                    <td><?= htmlspecialchars($pembayaran['bulan'] ?? ''); ?></td>
                    <td><?= htmlspecialchars($pembayaran['tahun'] ?? ''); ?></td>
                    <td><?= htmlspecialchars($pembayaran['tanggal_bayar'] ?? ''); ?></td>
                    <td><?= htmlspecialchars($pembayaran['jumlah_bayar'] ?? ''); ?></td>
                    <td>
                        <button onclick="openEditPaymentForm('<?= htmlspecialchars($pembayaran['id_pembayaran'] ?? ''); ?>', '<?= htmlspecialchars($pembayaran['id_anggota'] ?? ''); ?>', '<?= htmlspecialchars($pembayaran['bulan'] ?? ''); ?>', '<?= htmlspecialchars($pembayaran['tahun'] ?? ''); ?>', '<?= htmlspecialchars($pembayaran['tanggal_bayar'] ?? ''); ?>', '<?= htmlspecialchars($pembayaran['jumlah_bayar'] ?? ''); ?>')">Edit</button>
                        <form method="POST" action="" style="display:inline;">
                            <input type="hidden" name="id_pembayaran" value="<?= htmlspecialchars($pembayaran['id_pembayaran'] ?? ''); ?>">
                            <input type="submit" name="hapus" value="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus pembayaran ini?');">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <div id="editPaymentForm" style="display:none;">
        <h2>Edit Pembayaran</h2>
        <form method="POST" action="">
        <input type="hidden" name="id_pembayaran" id="edit-payment-id" required>
        <div class="form-group">
            <label for="id_anggota">ID Anggota:</label>
            <input type="text" name="id_anggota" id="edit-id_anggota" required>
        </div>
        <div class="form-group">
            <label for="bulan">Bulan Bayar:</label>
            <input type="text" name="bulan" id="edit-bulan" required>
        </div>
        <div class="form-group">
            <label for="tahun">Tahun Bayar:</label>
            <input type="text" name="tahun" id="edit-tahun" required>
        </div>
        <div class="form-group">
            <label for="tanggal_bayar">Tanggal Bayar:</label>
            <input type="date" name="tanggal_bayar" id="edit-tanggal_bayar" required>
        </div>
        <div class="form-group">
            <label for="jumlah_bayar">Jumlah Bayar:</label>
            <input type="number" name="jumlah_bayar" id="edit-jumlah_bayar" required>
        </div>
        <input type="submit" name="edit" value="Update Pembayaran">
        <button type="button" onclick="closeEditPaymentForm()">Batal</button>
    </form>
</div>
        <script>
            function toggleTambahForm() {
                var form = document.getElementById('tambahForm');
                form.style.display = form.style.display === 'none' ? 'block' : 'none'; // Toggle display
            }

            function openEditPaymentForm(id_pembayaran, id_anggota, bulan, tahun, tanggal_bayar, jumlah_bayar) {
                document.getElementById('edit-payment-id').value = id_pembayaran; // Isi ID pembayaran
                document.getElementById('edit-id_anggota').value = id_anggota;
                document.getElementById('edit-bulan').value = bulan;
                document.getElementById('edit-tahun').value = tahun;
                document.getElementById('edit-tanggal_bayar').value = tanggal_bayar;
                document.getElementById('edit-jumlah_bayar').value = jumlah_bayar;
                document.getElementById('editPaymentForm').style.display = 'block'; // Tampilkan form edit
            }

            function closeEditPaymentForm() {
                document.getElementById('editPaymentForm').style.display = 'none'; // Sembunyikan form edit
            }

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