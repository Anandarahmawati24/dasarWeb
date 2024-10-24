<?php
try {
    $conn = new PDO("sqlsrv:server=NANDA\SQLEXPRESS;database=KasBank_Sampah");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $error) {
    echo "Connection failed: " . $error->getMessage();
}

// Mencegah redeclare fungsi
if (!function_exists('sqlsrv_query')) {
    function sqlsrv_query($query, $params = [])
    {
        global $conn;
        $stmt = $conn->prepare($query);
        $stmt->execute($params);  
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

// Fungsi lainnya 
function tambahAnggota($data) {
    global $conn;
    $nama = $data['nama'];
    $alamat = $data['alamat'];
    $email = $data['email'];  
    $id_rt = $data['id_rt'];

    $stmt = $conn->prepare("INSERT INTO anggota (nama, alamat, email, id_rt) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nama, $alamat, $email, $id_rt]);
}

function editAnggota($data) {
    global $conn;
    
    // Periksa jika kunci ada
    if (!isset($data['id_anggota'])) {
        throw new InvalidArgumentException("ID Anggota tidak ditemukan.");
    }

    $id_anggota = $data['id_anggota'];
    $nama = $data['nama'];
    $alamat = $data['alamat'];
    $email = $data['email'];
    $id_rt = $data['id_rt'];

    $stmt = $conn->prepare("UPDATE anggota SET nama = ?, alamat = ?, email = ?, id_rt = ? WHERE id_anggota = ?");
    $stmt->execute([$nama, $alamat, $email, $id_rt, $id_anggota]);
}

function hapusAnggota($id) {
    global $conn;

    // Pastikan ID tidak kosong
    if (empty($id)) {
        throw new InvalidArgumentException("ID tidak boleh kosong.");
    }

    // Periksa apakah ada pembayaran terkait
    $stmt = $conn->prepare("SELECT COUNT(*) FROM pembayaran WHERE id_anggota = ?");
    $stmt->execute([$id]);
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        echo "<script>alert('Tidak bisa menghapus anggota yang memiliki pembayaran terkait!');</script>";
        return false; // Gagal menghapus
    }

    // Hapus anggota jika tidak ada pembayaran terkait
    $stmt = $conn->prepare("DELETE FROM anggota WHERE id_anggota = ?");
    return $stmt->execute([$id]);
}


function registrasiAdmin($data){
    global $conn;
    // Mengambil data dari form dan menghindari XSS
    $username = strtolower(trim($data["username"]));
    $password = $data["password"];
    $nama_adm = htmlspecialchars($data["nama"]); // Mengambil nama admin
    $email = htmlspecialchars($data["email"]);
    $id_rt = $data["id_rt"]; // Ambil id_rt langsung dari form

    // Cek apakah username sudah terdaftar
    $query = "SELECT username FROM admin_rt WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$username]);

    if ($stmt->fetch()) {
        echo "<script>alert('Username sudah terdaftar!');</script>";
        return false;
    }

    // Menyimpan data admin ke database
    $query = "INSERT INTO admin_rt (username, password, nama_adm, email, id_rt) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    
    // Gunakan plain password seperti yang diinginkan
    if ($stmt->execute([$username, $password, $nama_adm, $email, $id_rt])) {
        return $stmt->rowCount();
    } else {
        $errorInfo = $stmt->errorInfo();
        echo "<script>alert('Terjadi kesalahan: " . $errorInfo[2] . "');</script>";
        return false;
    }
}
function getAllPembayaran() {
    global $conn;

    $query = "
        SELECT p.id_pembayaran, p.bulan, p.tahun, p.tanggal_bayar, p.jumlah_bayar, a.nama, r.nama_rt 
        FROM pembayaran p 
        JOIN anggota a ON p.id_anggota = a.id_anggota
        JOIN rt r ON a.id_rt = r.id_rt"; // Menyertakan tabel RT
    $stmt = $conn->prepare($query);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function getAllAnggota() {
    global $conn;

    $query = "SELECT id_anggota, nama, alamat, email, id_rt FROM anggota"; // Pastikan id_anggota juga diambil
    $stmt = $conn->prepare($query);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Fungsi untuk menambah pembayaran
function tambahPembayaran($data) {
    global $conn;

    $id_anggota = $data['id_anggota'];
    $bulan = $data['bulan'];
    $tahun = $data['tahun'];
    $tanggal_bayar = $data['tanggal_bayar'];
    $jumlah_bayar = $data['jumlah_bayar'];

    // Query SQL untuk menambah data pembayaran
    $stmt = $conn->prepare("INSERT INTO pembayaran (id_anggota, bulan, tahun, tanggal_bayar, jumlah_bayar) VALUES (?, ?, ?, ?, ?)");

    // Eksekusi query
    if ($stmt->execute([$id_anggota, $bulan, $tahun, $tanggal_bayar, $jumlah_bayar])) {
        echo "<script>alert('Pembayaran berhasil ditambahkan!');</script>";
    } else {
        echo "<script>alert('Gagal menambahkan pembayaran.');</script>";
    }
}

// Fungsi untuk mengedit pembayaran
function editbayar($data) {
    global $conn;

    $id_pembayaran = $data['id_pembayaran'];
    $id_anggota = $data['id_anggota'];
    $bulan = $data['bulan'];
    $tahun = $data['tahun'];
    $tanggal_bayar = $data['tanggal_bayar'];
    $jumlah_bayar = $data['jumlah_bayar'];

    // Query SQL untuk update data pembayaran
    $stmt = $conn->prepare("UPDATE pembayaran SET id_anggota = ?, bulan = ?, tahun = ?, tanggal_bayar = ?, jumlah_bayar = ? WHERE id_pembayaran = ?");

    // Eksekusi query
    if ($stmt->execute([$id_anggota, $bulan, $tahun, $tanggal_bayar, $jumlah_bayar, $id_pembayaran])) {
        echo "<script>alert('Pembayaran berhasil diupdate!');</script>";
    } else {
        echo "<script>alert('Gagal mengupdate pembayaran.');</script>";
    }
}

function hapusPembayaran($id_pembayaran) {
    global $conn;

    // Pastikan ID tidak kosong
    if (empty($id_pembayaran)) {
        throw new InvalidArgumentException("ID Pembayaran tidak boleh kosong.");
    }

    // Query untuk menghapus pembayaran berdasarkan ID
    $stmt = $conn->prepare("DELETE FROM pembayaran WHERE id_pembayaran = ?");
    $stmt->execute([$id_pembayaran]);

    return $stmt->rowCount(); // Mengembalikan jumlah baris yang dihapus
}
?>