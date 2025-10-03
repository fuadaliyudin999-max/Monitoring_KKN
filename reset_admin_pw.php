<?php
// php/reset_admin_pw.php
require_once __DIR__ . '/koneksi.php';

$new_pw = 'admin123'; // password baru
$hashed = password_hash($new_pw, PASSWORD_DEFAULT);

$stmt = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
$email = 'admin@kkn.com';
$stmt->bind_param('ss', $hashed, $email);

if ($stmt->execute()) {
    echo "✅ Password admin berhasil di-reset ke 'admin123'.<br>";
    echo "Hash baru: <pre>$hashed</pre><br>";
    echo "⚠️ Segera hapus file reset_admin_pw.php setelah berhasil login.";
} else {
    echo "❌ Gagal reset: " . $conn->error;
}
