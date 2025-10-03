<?php
// php/lokasi_kkn/edit.php
include_once __DIR__ . '/../koneksi.php';

$id = intval($_GET['id'] ?? 0);
if ($id <= 0) {
    header("Location: index.php");
    exit;
}

// ambil data awal
$stmt = mysqli_prepare($koneksi, "SELECT * FROM lokasi_kkn WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_assoc($res);
mysqli_stmt_close($stmt);

if (!$data) {
    header("Location: index.php");
    exit;
}

// proses update
if (isset($_POST['update'])) {
    $nama_lokasi    = trim($_POST['nama_lokasi'] ?? '');
    $koordinat_maps = trim($_POST['koordinat_maps'] ?? '');

    $targetDir = __DIR__ . '/../../assets/images/';
    if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);

    $foto1_name = $data['foto1'];
    if (!empty($_FILES['foto1']['name']) && $_FILES['foto1']['error'] === UPLOAD_ERR_OK) {
        $new1 = time() . '_1_' . preg_replace('/[^A-Za-z0-9.\-_]/', '_', basename($_FILES['foto1']['name']));
        if (move_uploaded_file($_FILES['foto1']['tmp_name'], $targetDir . $new1)) {
            // hapus file lama jika ada
            if (!empty($foto1_name) && file_exists($targetDir . $foto1_name)) unlink($targetDir . $foto1_name);
            $foto1_name = $new1;
        }
    }

    $foto2_name = $data['foto2'];
    if (!empty($_FILES['foto2']['name']) && $_FILES['foto2']['error'] === UPLOAD_ERR_OK) {
        $new2 = time() . '_2_' . preg_replace('/[^A-Za-z0-9.\-_]/', '_', basename($_FILES['foto2']['name']));
        if (move_uploaded_file($_FILES['foto2']['tmp_name'], $targetDir . $new2)) {
            if (!empty($foto2_name) && file_exists($targetDir . $foto2_name)) unlink($targetDir . $foto2_name);
            $foto2_name = $new2;
        }
    }

    $stmt = mysqli_prepare($koneksi, "UPDATE lokasi_kkn SET nama_lokasi = ?, koordinat_maps = ?, foto1 = ?, foto2 = ? WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "ssssi", $nama_lokasi, $koordinat_maps, $foto1_name, $foto2_name, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("Location: index.php");
    exit;
}

include_once __DIR__ . '/../../includes/header.php';
include_once __DIR__ . '/../../includes/sidebar.php';
?>
<div class="container mt-4">
    <h2>Edit Lokasi KKN</h2>
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Nama Lokasi</label>
            <input type="text" name="nama_lokasi" class="form-control" value="<?= htmlspecialchars($data['nama_lokasi']) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Koordinat Maps</label>
            <input type="text" name="koordinat_maps" class="form-control" value="<?= htmlspecialchars($data['koordinat_maps']) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Foto 1</label><br>
            <?php if (!empty($data['foto1']) && file_exists(__DIR__ . '/../../assets/images/' . $data['foto1'])): ?>
                <img src="../../assets/images/<?= htmlspecialchars($data['foto1']) ?>" width="120" class="mb-2"><br>
            <?php endif; ?>
            <input type="file" name="foto1" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Foto 2</label><br>
            <?php if (!empty($data['foto2']) && file_exists(__DIR__ . '/../../assets/images/' . $data['foto2'])): ?>
                <img src="../../assets/images/<?= htmlspecialchars($data['foto2']) ?>" width="120" class="mb-2"><br>
            <?php endif; ?>
            <input type="file" name="foto2" class="form-control">
        </div>
        <button type="submit" name="update" class="btn btn-success">Update</button>
        <a href="index.php" class="btn btn-secondary">Batal</a>
    </form>
</div>
<?php include_once __DIR__ . '/../../includes/footer.php'; ?>
