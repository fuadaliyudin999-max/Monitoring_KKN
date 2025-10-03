<?php
// php/koneksi.php
// Konfigurasi koneksi database untuk XAMPP (root tanpa password default)
$DB_HOST = 'localhost';
$DB_USER = 'root';
$DB_PASS = '';
$DB_NAME = 'monitoring_kkn';

// Pakai procedural
$koneksi = mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Set karakter biar aman
mysqli_set_charset($koneksi, "utf8mb4");
?>
