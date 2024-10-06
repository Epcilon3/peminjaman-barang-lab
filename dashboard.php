<?php
include 'config/config.php';

session_start();
if ($_SESSION['role'] == "") {
    header("Location: index.php?pesan=gagal");
}

// Pastikan user_id ada dalam session
if (!isset($_SESSION['user_id'])) {
    header('Location: ../../ui/login.php');
    exit();
}

$user_id = $_SESSION['user_id']; // Ambil user_id dari session
$nama_user = $_SESSION['nama_user']; // Ambil nama_user dari session

// Query untuk menghitung jumlah barang yang pernah dipinjam
$sql_total_peminjaman = "SELECT COUNT(*) AS total_peminjaman FROM pinjams WHERE users_id = '$user_id'";
$query_total_peminjaman = mysqli_query($conn, $sql_total_peminjaman);
$result_total_peminjaman = mysqli_fetch_assoc($query_total_peminjaman);
$total_peminjaman = $result_total_peminjaman['total_peminjaman'];

// Query untuk menghitung jumlah barang yang belum dikembalikan
$sql_belum_dikembalikan = "SELECT COUNT(*) AS total_belum_dikembalikan FROM pinjams WHERE users_id = '$user_id' AND status = 'dipinjam'";
$query_belum_dikembalikan = mysqli_query($conn, $sql_belum_dikembalikan);
$result_belum_dikembalikan = mysqli_fetch_assoc($query_belum_dikembalikan);
$total_belum_dikembalikan = $result_belum_dikembalikan['total_belum_dikembalikan'];

// Query untuk menghitung total jumlah barang yang ada
$sql_total_barang = "SELECT SUM(jumlah_pinjam) AS total_barang FROM items";
$query_total_barang = mysqli_query($conn, $sql_total_barang);
$result_total_barang = mysqli_fetch_assoc($query_total_barang);
$total_barang = $result_total_barang['total_barang'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
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
                <a class="navbar-brand" href="#">Peminjaman Barang Lab Siswa</a>
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
                            <a class="nav-link" href="ui/pinjams/rekap_peminjaman.php">Pinjam Barang</a>
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

    <!-- Welcome Text -->
    <div class="welcome-text">
        <form action="controller/logout.php" method="POST">
            <h1>Selamat Datang, <?php echo $_SESSION['nama']; ?>!</h1>
        </form>
    </div>

    <!-- Cards -->
    <div class="container my-5">
        <div class="row text-center">
            <!-- Card 1 -->
            <div class="col-sm-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Jumlah Barang yang Pernah Dipinjam:</h5>
                        <p class="card-text"><?php echo $total_peminjaman; ?></p>
                    </div>
                </div>
            </div>
            <!-- Card 2 -->
            <div class="col-sm-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Jumlah Barang yang Belum Dikembalikan:</h5>
                        <p class="card-text"><?php echo $total_belum_dikembalikan; ?></p>
                    </div>
                </div>
            </div>
            <!-- Card 3 -->
            <div class="col-sm-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Jumlah Barang yang Tersedia:</h5>
                        <p class="card-text"><?php echo $total_barang; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>



