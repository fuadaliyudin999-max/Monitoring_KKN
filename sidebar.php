<?php
// includes/sidebar.php
if (session_status() === PHP_SESSION_NONE) session_start();
?>
<div id="sidebar" class="sidebar p-3">
  <h5 class="text-gold mb-3">Menu</h5>
  <ul class="nav flex-column">
    <li class="nav-item">
      <a class="nav-link" href="/monitoring-kkn/php/dashboard.php">Dashboard</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/monitoring-kkn/php/lokasi_kkn/index.php">Lokasi KKN</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/monitoring-kkn/php/progress/index.php">Progress</a>
    </li>

    <!-- User Management cuma buat admin -->
    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
    <li class="nav-item">
      <a class="nav-link" href="/monitoring-kkn/php/user/index.php">User</a>
    </li>
    <?php endif; ?>
  </ul>
</div>
