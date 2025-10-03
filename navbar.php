<?php
// includes/navbar.php
if (session_status() === PHP_SESSION_NONE) session_start();
?>
<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
  <div class="container-fluid">
    <button class="btn btn-sm btn-outline-light me-2" id="sidebarToggle">☰</button>
    <div class="mx-auto order-0">
      <a class="navbar-brand mx-auto" href="/monitoring-kkn/php/dashboard.php">
        <img src="/monitoring-kkn/assets/images/logo-unsika-1.png" alt="Logo" height="40" style="object-fit:contain;">
        <img src="/monitoring-kkn/assets/images/logo-unsika-2.png" alt="Logo" height="36" style="object-fit:contain;">
        <span class="ms-2 d-none d-md-inline">KKN UNSIKA</span>
      </a>
    </div>

    <div class="d-flex order-lg-2 ms-auto">
      <?php if (isset($_SESSION['nama'])): ?>
        <div class="me-3 d-none d-md-flex align-items-center">
          <small class="text-muted">Halo, <?= htmlspecialchars($_SESSION['nama'], ENT_QUOTES, 'UTF-8') ?></small>
        </div>

        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
          <a class="btn btn-outline-secondary btn-sm me-2" href="/monitoring-kkn/php/user/index.php">User Management</a>
        <?php endif; ?>

        <a class="btn btn-outline-danger btn-sm" href="/monitoring-kkn/php/logout.php">Logout</a>
      <?php else: ?>
        <a class="btn btn-outline-primary btn-sm" href="/monitoring-kkn/login.php">Login</a>
      <?php endif; ?>
    </div>
  </div>
</nav>
