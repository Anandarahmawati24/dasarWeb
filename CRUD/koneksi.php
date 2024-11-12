<?php
try {
    $conn = new PDO("sqlsrv:server=NANDA\SQLEXPRESS;database=TokoTas");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $error) {
    echo "Connection failed: " . $error->getMessage();
}

function tambahBarang($data) {
    global $conn;  
    $nama_produk = $data['nama_produk'];
    $kategori = $data['kategori'];
    $brand = $data['brand'];
    $harga = $data['harga'];
    $stok = $data['stok'];

   $sql = "INSERT INTO barang (nama_produk, kategori, brand, harga, stok) VALUES (?, ?, ?, ?, ?)";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$nama_produk, $kategori, $brand, $harga, $stok]);
}

function getAllBarang() {
    global $conn;
    $sql = "SELECT * FROM barang";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function editBarang($data) {
    global $conn;
    $id_produk = $data['id_produk'];
    $nama_produk = $data['nama_produk'];
    $kategori = $data['kategori'];
    $brand = $data['brand'];
    $harga = $data['harga'];
    $stok = $data['stok'];

    $stmt = $conn->prepare("UPDATE barang SET nama_produk = ?, kategori = ?, brand = ?, harga = ?, stok = ? WHERE id_produk = ?");
    $stmt->execute([$nama_produk, $kategori, $brand, $harga, $stok, $id_produk]);
}

function getBarangById($id_produk) {
    global $conn;

    $sql = "SELECT * FROM barang WHERE id_produk = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id_produk]);
    
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function deleteBarang($id_produk) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM barang WHERE id_produk = ?");
    $stmt->execute([$id_produk]);

    return $stmt; 
}
?>