<?php
// php/lokasi_kkn/tambah.php
include_once __DIR__ . '/../koneksi.php';

// proses POST sebelum output HTML
if (isset($_POST['simpan'])) {
    $nama_lokasi    = trim($_POST['nama_lokasi'] ?? '');
    $koordinat_maps = trim($_POST['koordinat_maps'] ?? '');

    // folder target fisik
    $targetDir = __DIR__ . '/../../assets/images/';
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    // foto1
    $foto1_name = "";
    if (!empty($_FILES['foto1']['name']) && $_FILES['foto1']['error'] === UPLOAD_ERR_OK) {
        $foto1_name = time() . '_1_' . preg_replace('/[^A-Za-z0-9.\-_]/', '_', basename($_FILES['foto1']['name']));
        move_uploaded_file($_FILES['foto1']['tmp_name'], $targetDir . $foto1_name);
    }

    // foto2
    $foto2_name = "";
    if (!empty($_FILES['foto2']['name']) && $_FILES['foto2']['error'] === UPLOAD_ERR_OK) {
        $foto2_name = time() . '_2_' . preg_replace('/[^A-Za-z0-9.\-_]/', '_', basename($_FILES['foto2']['name']));
        move_uploaded_file($_FILES['foto2']['tmp_name'], $targetDir . $foto2_name);
    }

    // insert dengan prepared statement
    $stmt = mysqli_prepare($koneksi, "INSERT INTO lokasi_kkn (nama_lokasi, koordinat_maps, foto1, foto2) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "ssss", $nama_lokasi, $koordinat_maps, $foto1_name, $foto2_name);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("Location: index.php");
    exit;
}

include_once __DIR__ . '/../../includes/header.php';
include_once __DIR__ . '/../../includes/sidebar.php';
?>
<div class="container mt-4">
    <h2>Tambah Lokasi KKN</h2>
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Nama Lokasi</label>
            <input type="text" name="nama_lokasi" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Koordinat Maps</label>
            <input type="text" name="koordinat_maps" class="form-control" placeholder="contoh: -6.12345, 106.12345" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Foto 1</label>
            <input type="file" name="foto1" class="form-control" accept="image/*">
        </div>
        <div class="mb-3">
            <label class="form-label">Foto 2</label>
            <input type="file" name="foto2" class="form-control" accept="image/*">
        </div>
        <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
        <a href="index.php" class="btn btn-secondary">Batal</a>
    </form>
</div>
<?php include_once __DIR__ . '/../../includes/footer.php'; ?>
