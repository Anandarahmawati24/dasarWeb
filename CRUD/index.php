<?php
include 'koneksi.php';
$barangList = getAllBarang();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Utama - Toko Tas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f9f9f9;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .button-container {
            margin-bottom: 10px;
        }
        .button {
            padding: 8px 15px;
            color: white;
            background-color: #4CAF50;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            margin-right: 5px;
        }
        .button-danger {
            background-color: #f44336;
        }
        .button:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>
<h1>Daftar Barang</h1>
<div class="button-container">
    <a href="tambah.php" class="button">Tambah Barang</a>
</div>
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Produk</th>
            <th>Kategori</th>
            <th>Brand</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $i=1?>
        <?php foreach ($barangList as $barang): ?>
        <tr>
            <td><?=$i; ?></td>
            <td><?= $barang['nama_produk']; ?></td>
            <td><?= $barang['kategori']; ?></td>
            <td><?= $barang['brand']; ?></td>
            <td><?= $barang['harga']; ?></td>
            <td><?= $barang['stok']; ?></td>
            <td>
                <a href="edit.php?id=<?= $barang['id_produk']; ?>" class="button">Edit</a>
                <a href="hapus.php?id=<?= $barang['id_produk']; ?>" class="button button-danger" onclick="return confirm('Anda yakin ingin menghapus barang ini?');">Hapus</a>
            </td>
        </tr>
        <?php $i++;?>
        <?php endforeach; ?>
    </tbody>
</table>
</body>
</html>