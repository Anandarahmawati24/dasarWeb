<?php
try {
    $conn = new PDO("sqlsrv:server=NANDA\SQLEXPRESS;database=KasBank_Sampah");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $error) {
    echo "Connection failed: " . $error->getMessage();
}