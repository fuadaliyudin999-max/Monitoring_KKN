<?php
// login.php
require_once __DIR__ . '/koneksi.php';
require_once __DIR__ . '/auth.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (filter_var($email, FILTER_VALIDATE_EMAIL) && $password !== '') {
        if (login_user($email, $password)) {
            header("Location: /monitoring-kkn/php/dashboard.php");
            exit;
        } else {
            $error = "Email atau password salah.";
        }
    } else {
        $error = "Masukkan email dan password yang valid.";
    }
}
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Login - Monitoring KKN</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/style.css?v=2.0" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg, #800000, #600000);
      font-family: 'Segoe UI', sans-serif;
    }
    .login-card {
      border: none;
      border-radius: 12px;
      overflow: hidden;
    }
    .login-header {
      background-color: #800000;
      color: #FFD700;
      text-align: center;
      padding: 20px;
    }
    .login-header img {
      height: 60px;
      margin-bottom: 10px;
    }
    .login-card .card-body {
      padding: 2rem;
      background: #fff;
    }
    .btn-login {
      background-color: #800000;
      border: none;
      color: #FFD700;
      font-weight: 600;
    }
    .btn-login:hover {
      background-color: #600000;
      color: #fff;
    }
  </style>
</head>
<body>
  <div class="container d-flex align-items-center justify-content-center" style="min-height:100vh;">
    <div class="col-md-5 col-lg-4">
      <div class="card shadow login-card">
        <div class="login-header">
          <img src="/monitoring-kkn/assets/images/logo-unsika-1.png" alt="UNSIKA Logo">
                    <h4 class="mb-0">Monitoring KKN</h4>
              </div>
        <div class="card-body">
          <?php if($error): ?>
            <div class="alert alert-danger small"><?= e($error) ?></div>
          <?php endif; ?>

          <form method="post" autocomplete="off" novalidate>
            <div class="mb-3">
              <label class="form-label">Email</label>
              <input name="email" type="email" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Password</label>
              <input name="password" type="password" class="form-control" required>
            </div>
            <button class="btn btn-login w-100">Masuk</button>
          </form>

          <div class="text-center mt-3 small text-muted">
          </div>
        </div>
      </div>
      <div class="text-center mt-3 small text-light">© <?= date("Y") ?> UNSIKA - Monitoring KKN</div>
    </div>
  </div>
</body>
</html>
