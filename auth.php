<?php
// php/auth.php
require_once __DIR__ . '/koneksi.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Session timeout: 30 menit
$timeout_minutes = 30;
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > $timeout_minutes * 60)) {
    session_unset();
    session_destroy();
}
$_SESSION['LAST_ACTIVITY'] = time();

/**
 * Login user berdasarkan email & password
 */
function login_user($email, $password) {
    global $koneksi;

    $sql = "SELECT id, nama, email, password, role FROM users WHERE email = ?";
    $stmt = $koneksi->prepare($sql);
    if (!$stmt) {
        return false;
    }

    $stmt->bind_param('s', $email);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res && $res->num_rows === 1) {
        $row = $res->fetch_assoc();

        // cek password hash
        if (password_verify($password, $row['password'])) {
            // set session user
            $_SESSION['id']    = $row['id'];
            $_SESSION['nama']  = $row['nama'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['role']  = $row['role'];
            $_SESSION['LAST_ACTIVITY'] = time();
            return true;
        }
    }

    return false;
}

/**
 * Wajib login sebelum akses halaman
 */
function require_login() {
    if (!isset($_SESSION['id'])) {
        header("Location: /monitoring-kkn/login.php");
        exit;
    }
}

/**
 * Wajib admin sebelum akses halaman tertentu
 */
function require_admin() {
    if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'admin') {
        header("Location: /monitoring-kkn/php/dashboard.php");
        exit;
    }
}

/**
 * Cek apakah user role-nya admin
 */
function is_admin() {
    return (isset($_SESSION['role']) && $_SESSION['role'] === 'admin');
}
