<?php
// includes/header.php
if (session_status() === PHP_SESSION_NONE) session_start();

// load helper functions
include_once __DIR__ . '/functions.php';
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Monitoring KKN</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="/monitoring-kkn/assets/css/style.css?v=1.2" rel="stylesheet">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
</head>
<body>
  <?php include __DIR__ . '/navbar.php'; ?>
  <div class="d-flex">
    <?php include __DIR__ . '/sidebar.php'; ?> <!-- Sidebar cukup sekali di sini -->
    <main class="flex-grow-1 p-3">
