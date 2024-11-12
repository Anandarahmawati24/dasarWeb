<?php
include 'koneksi.php'; 

$id_produk = $_GET['id'];
$barang = getBarangById($id_produk);
if (isset($_POST['edit'])) {
    editBarang($_POST);
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Barang</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .form-container {
            width: 300px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        .form-group button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }
        .form-group button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<div class="form-container">
    <h2>Edit Barang</h2>
    <form action="" method="POST">
        <input type="hidden" name="id_produk" value="<?= $barang['id_produk']; ?>">

        <div class="form-group">
            <label for="nama_produk">Nama Produk</label>
            <input type="text" id="nama_produk" name="nama_produk" value="<?= $barang['nama_produk']; ?>" required>
        </div>
        <div class="form-group">
            <label for="kategori">Kategori</label>
            <input type="text" id="kategori" name="kategori" value="<?= $barang['kategori']; ?>" required>
        </div>
        <div class="form-group">
            <label for="brand">Brand</label>
            <input type="text" id="brand" name="brand" value="<?= $barang['brand']; ?>" required>
        </div>
        <div class="form-group">
            <label for="harga">Harga</label>
            <input type="text" id="harga" name="harga" value="<?= $barang['harga']; ?>" required>
        </div>
        <div class="form-group">
            <label for="stok">Stok</label>
            <input type="number" id="stok" name="stok" value="<?= $barang['stok']; ?>" required>
        </div>
        <div class="form-group">
            <button type="submit" name="edit">Simpan Perubahan</button>
        </div>
    </form>
</div>
</body>
</html>