<?php
// php/dashboard.php
require_once __DIR__ . '/cek_login.php';
require_once __DIR__ . '/koneksi.php';
include __DIR__ . '/../includes/header.php';
?>
<div class="container-fluid p-4">
  <h3>Dashboard</h3>
  <div class="row gy-3 mt-2">
    <div class="col-md-3">
      <div class="card shadow-sm spotlight">
        <div class="card-body">
          <h6 class="mb-2">Total Mahasiswa</h6>
          <?php
          $r = $koneksi->query("SELECT COUNT(*) AS tot FROM mahasiswa")->fetch_assoc();
          echo '<h4>'.$r['tot'].'</h4>';
          ?>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card shadow-sm spotlight">
        <div class="card-body">
          <h6 class="mb-2">Total Lokasi</h6>
          <?php
          $r = $koneksi->query("SELECT COUNT(*) AS tot FROM lokasi_kkn")->fetch_assoc();
          echo '<h4>'.$r['tot'].'</h4>';
          ?>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card shadow-sm spotlight">
        <div class="card-body">
          <h6 class="mb-2">Total Progress</h6>
          <?php
          $r = $koneksi->query("SELECT COUNT(*) AS tot FROM progress")->fetch_assoc();
          echo '<h4>'.$r['tot'].'</h4>';
          ?>
        </div>
      </div>
    </div>
  </div>

  <div class="mt-4">
    <div class="card">
      <div class="card-body">
        <h5>Ringkasan Terbaru</h5>
        <table class="table table-sm">
          <thead><tr><th>Tanggal</th><th>Lokasi</th><th>Mahasiswa</th><th>Status</th></tr></thead>
          <tbody>
            <?php
            $sql = "SELECT p.tanggal, l.nama_lokasi, m.nama, p.status FROM progress p
                    LEFT JOIN lokasi_kkn l ON p.lokasi_id=l.id
                    LEFT JOIN mahasiswa m ON p.mahasiswa_id=m.id
                    ORDER BY p.tanggal DESC LIMIT 8";
            $res = $koneksi->query($sql);
            while ($row = $res->fetch_assoc()) {
                echo '<tr>';
                echo '<td>'.e($row['tanggal']).'</td>';
                echo '<td>'.e($row['nama_lokasi']).'</td>';
                echo '<td>'.e($row['nama']).'</td>';
                echo '<td>'.e($row['status']).'</td>';
                echo '</tr>';
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
<?php include __DIR__ . '/../includes/footer.php'; ?>
