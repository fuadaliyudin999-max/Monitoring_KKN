<?php
// php/lokasi_kkn/hapus.php
include_once __DIR__ . '/../koneksi.php';

$id = intval($_GET['id'] ?? 0);
if ($id <= 0) {
    header("Location: index.php");
    exit;
}

// ambil nama file untuk dihapus
$stmt = mysqli_prepare($koneksi, "SELECT foto1, foto2 FROM lokasi_kkn WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($res);
mysqli_stmt_close($stmt);

$targetDir = __DIR__ . '/../../assets/images/';
if ($row) {
    if (!empty($row['foto1']) && file_exists($targetDir . $row['foto1'])) unlink($targetDir . $row['foto1']);
    if (!empty($row['foto2']) && file_exists($targetDir . $row['foto2'])) unlink($targetDir . $row['foto2']);
}

// hapus record
$stmt = mysqli_prepare($koneksi, "DELETE FROM lokasi_kkn WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

header("Location: index.php");
exit;
