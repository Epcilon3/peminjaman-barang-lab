<?php
include 'config/config.php';

session_start();
if ($_SESSION['role'] == "") {
    header("Location: index.php?pesan=gagal");
}

// Query untuk menghitung jumlah seluruh siswa
$sql_total_siswa = "SELECT COUNT(*) AS total_siswa FROM user WHERE role = 'siswa';";
$query_total_siswa = mysqli_query($conn, $sql_total_siswa);
$result_total_siswa = mysqli_fetch_assoc($query_total_siswa);
$total_siswa = $result_total_siswa['total_siswa'];

// Query untuk menghitung jumlah seluruh siswa
$sql_total_admin = "SELECT COUNT(*) AS total_admin FROM user WHERE role = 'admin';";
$query_total_admin = mysqli_query($conn, $sql_total_admin);
$result_total_admin = mysqli_fetch_assoc($query_total_admin);
$total_admin = $result_total_admin['total_admin'];

// Query untuk menghitung total siswa yang sedang meminjam barang
$sql_siswa_meminjam = "SELECT COUNT(DISTINCT users_id) AS total_meminjam FROM pinjams WHERE status = 'dipinjam'";
$query_siswa_meminjam = mysqli_query($conn, $sql_siswa_meminjam);
$result_siswa_meminjam = mysqli_fetch_assoc($query_siswa_meminjam);
$total_meminjam = $result_siswa_meminjam['total_meminjam'];

// Query untuk menghitung total siswa yang telah mengembalikan barang
$sql_siswa_mengembalikan = "SELECT COUNT(DISTINCT users_id) AS total_mengembalikan FROM pinjams WHERE status = 'dikembalikan';";
$query_siswa_mengembalikan = mysqli_query($conn, $sql_siswa_mengembalikan);
$result_siswa_mengembalikan = mysqli_fetch_assoc($query_siswa_mengembalikan);
$total_mengembalikan = $result_siswa_mengembalikan['total_mengembalikan'];

// Query untuk menghitung jumlah barang
$sql_total_barang = "SELECT SUM(jumlah_pinjam) AS total_barang FROM items;";
$query_total_barang = mysqli_query($conn, $sql_total_barang);
$result_total_barang = mysqli_fetch_assoc($query_total_barang);
$total_barang = $result_total_barang['total_barang'];

// Query untuk menghitung jumlah ruangan
$sql_total_ruangan = "SELECT COUNT(*) AS total_ruangan FROM labs;";
$query_total_ruangan = mysqli_query($conn, $sql_total_ruangan);
$result_total_ruangan = mysqli_fetch_assoc($query_total_ruangan);
$total_ruangan = $result_total_ruangan['total_ruangan'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card-title {
            font-size: 1.2rem;
            text-transform: uppercase;
            font-weight: bold;
        }
        .card {
            background: linear-gradient(145deg, #ffffff, #e6e6e6);
            box-shadow: 20px 20px 60px #d9d9d9, -20px -20px 60px #ffffff;
            border-radius: 15px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1), 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        .card-body {
            text-align: center;
        }
        .card-text {
            font-size: 2rem;
            font-weight: bold;
        }
        .navbar-brand {
            color: #00aaff !important;
            font-weight: bold;
        }
        .offcanvas-title {
            color: #00aaff;
        }
        .offcanvas-body {
            background-color: #1f2937;
        }
        .dropdown-menu-dark {
            background-color: #1f2937;
            color: white;
        }
        .dropdown-menu-dark a {
            color: #00aaff;
        }
        .welcome-text {
            text-align: center;
            font-size: 2rem;
            font-weight: bold;
            margin: 30px 0;
        }
        h2 {
            margin-top: 20px;
            margin-bottom: 20px;
            text-align: center;
        }
        table {
            margin: auto;
            width: 80%;
            margin-bottom: 40px;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .btn {
            display: block;
            width: 200px;
            margin: 20px auto;
        }
        footer {
            text-align: center;
            margin: 20px 0;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <h2>
                <a class="navbar-brand" href="#">Peminjaman Barang Lab Admin</a>
            </h2>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Lihat Bawah Sini</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link" href="ui/labs/labs.php">Daftar Ruangan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="ui/barang/barang.php">Barang</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="ui/pinjams/admin_rekap_peminjaman.php">Data Pinjam Barang</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="controller/logout.php">Log Out</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <br><br><br>

    <!-- Cards -->
    <div class="container my-5">
        <div class="row text-center">
            <!-- Card 1 -->
            <div class="col-sm-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Jumlah Seluruh Siswa:</h5>
                        <p class="card-text"><?php echo $total_siswa; ?></p>
                    </div>
                </div>
            </div>
            <!-- Card 2 -->
            <div class="col-sm-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Siswa yang sedang Meminjam Barang:</h5>
                        <p class="card-text"><?php echo $total_meminjam; ?></p>
                    </div>
                </div>
            </div>
            <!-- Card 3 -->
            <div class="col-sm-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Siswa yang telah Mengembalikan Barang:</h5>
                        <p class="card-text"><?php echo $total_mengembalikan; ?></p>
                    </div>
                </div>
            </div>
            <!-- Card 4 -->
            <div class="col-sm-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Jumlah Barang:</h5>
                        <p class="card-text"><?php echo $total_barang; ?></p>
                    </div>
                </div>
            </div>
            <!-- Card 5 -->
            <div class="col-sm-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Jumlah Ruangan:</h5>
                        <p class="card-text"><?php echo $total_ruangan; ?></p>
                    </div>
                </div>
            </div>
            <!-- Card 6 -->
            <div class="col-sm-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Jumlah Admin:</h5>
                        <p class="card-text"><?php echo $total_admin; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
