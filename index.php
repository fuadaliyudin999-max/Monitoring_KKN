<?php
// php/lokasi_kkn/index.php
// Tampilkan daftar lokasi (pakai header/sidebar dari includes)
include_once __DIR__ . '/../../includes/header.php';
include_once __DIR__ . '/../koneksi.php';

$result = mysqli_query($koneksi, "SELECT * FROM lokasi_kkn ORDER BY id DESC");
?>
<div class="container mt-4">
    <h2>Data Lokasi KKN</h2>
    <a href="tambah.php" class="btn btn-primary mb-3">+ Tambah Lokasi</a>

    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Lokasi</th>
                    <th>Koordinat Maps</th>
                    <th>Foto 1</th>
                    <th>Foto 2</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; while ($row = mysqli_fetch_assoc($result)) : ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= htmlspecialchars($row['nama_lokasi']) ?></td>
                    <td><?= htmlspecialchars($row['koordinat_maps']) ?></td>
                    <td>
                        <?php if (!empty($row['foto1']) && file_exists(__DIR__ . '/../../assets/images/' . $row['foto1'])): ?>
                            <img src="../../assets/images/<?= htmlspecialchars($row['foto1']) ?>" width="100" alt="foto1">
                        <?php else: ?>
                            <span class="text-muted small">Tidak ada foto</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if (!empty($row['foto2']) && file_exists(__DIR__ . '/../../assets/images/' . $row['foto2'])): ?>
                            <img src="../../assets/images/<?= htmlspecialchars($row['foto2']) ?>" width="100" alt="foto2">
                        <?php else: ?>
                            <span class="text-muted small">Tidak ada foto</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="hapus.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data?')">Hapus</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>
<?php include_once __DIR__ . '/../../includes/footer.php'; ?>
