<?php
include 'config/config.php';

session_start();
// if (!isset($_SESSION['nama'])) {
//     header ("Location: index.php");
//     exit();
// }
if ($_SESSION['role'] == "") {
    header("Location: index.php?pesan=gagal");
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding-top: 56px;
        }
        .sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            background-color: #343a40;
        }
        .sidebar a {
            color: white;
            padding: 15px;
            display: block;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #007bff;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
        }
        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">Admin Dashboard</span>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar bg-dark">
        <a href="#dashboard">Dashboard</a>
        <a href="#barang">Detail Barang</a>
        <a href="#ruang">Detail Ruang</a>
        <a href="#rekap">Rekap Peminjaman</a>
        <a href="#users">Daftar User</a>
    </div>

    <!-- Content -->
    <div class="content">
        <div id="dashboard">
            <h1>Dashboard</h1>
            <p>Selamat datang di dashboard admin.</p>
        </div>

        <div id="barang">
            <h1>Detail Barang</h1>
            <p>Ini adalah halaman untuk melihat detail barang yang dipinjam.</p>
        </div>

        <div id="ruang">
            <h1>Detail Ruang</h1>
            <p>Ini adalah halaman untuk melihat detail ruang.</p>
        </div>

        <div id="rekap">
            <h1>Rekap Data Peminjaman</h1>
            <p>Ini adalah halaman untuk melihat rekap data peminjaman barang.</p>
        </div>

        <div id="users">
            <h1>Daftar User</h1>
            <p>Ini adalah halaman untuk melihat daftar pengguna.</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
