<?php
include 'koneksi.php'; 
    $id_produk = $_GET['id'];
    
    if (deleteBarang($id_produk)) {
        echo "
            <script>
                alert('Data berhasil dihapus');
                document.location.href = 'index.php';
            </script>";
    } else {
        echo "
            <script>
                alert('Data gagal dihapus');
                document.location.href = 'index.php';
            </script>";
    }
?>