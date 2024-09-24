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
</head>
<body>
        <nav class="navbar navbar-dark bg-dark fixed-top">
          <div class="container-fluid">
            <h2>
              <a class="navbar-brand" href="#">Peminjaman Barang Lab Siswa</a>
            </h2>
            <button
              class="navbar-toggler"
              type="button"
              data-bs-toggle="offcanvas"
              data-bs-target="#offcanvasDarkNavbar"
              aria-controls="offcanvasDarkNavbar"
              aria-label="Toggle navigation"
            >
              <span class="navbar-toggler-icon"></span>
            </button>
            <div
              class="offcanvas offcanvas-end text-bg-dark"
              tabindex="-1"
              id="offcanvasDarkNavbar"
              aria-labelledby="offcanvasDarkNavbarLabel"
            >
              <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">
                  Lihat Bawah Sini
                </h5>
                <button
                  type="button"
                  class="btn-close btn-close-white"
                  data-bs-dismiss="offcanvas"
                  aria-label="Close"
                ></button>
              </div>
              <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                  <!-- <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#"
                      >Home</a
                    >
                  </li> -->
                  <!-- <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link btn btn-primary btn-lg" href="#">Link</a>
                  </li> -->
                  <li class="nav-item dropdown">
                    <a
                      class="nav-link dropdown-toggle"
                      href="#"
                      role="button"
                      data-bs-toggle="dropdown"
                      aria-expanded="false"
                    >
                      Menu
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark">
                      <!-- <li><a class="dropdown-item" href="ui/pinjam/prosespeminjaman.php">Pinjam Barang</a></li> -->
                      <li><a class="dropdown-item" href="ui/pinjams/rekap_peminjaman.php">Pinjam Barang</a></li>
                      <li>
                        <a class="dropdown-item" href="#">Another action</a>
                      </li>
                      <!-- <li>
                        <hr class="dropdown-divider" />
                      </li> -->
                      <!-- <li>
                        <a class="dropdown-item" href="#"
                          >Something else here</a
                        >
                      </li>
                      <li>
                        <a class="dropdown-item" href="#"
                          >Something else here</a
                        >
                      </li> -->
                    </ul>
                  </li>
                </ul>
                <!-- <form class="d-flex mt-3" role="search">
                  <input
                    class="form-control me-2"
                    type="search"
                    placeholder="Search"
                    aria-label="Search"
                  />
                  <button class="btn btn-success" type="submit">Search</button>
                </form> -->
              </div>
            </div>
          </div>
        </nav> <br><br><br>
        <!-- Untuk Bagian Card -->
        <div class="row center">
          <div class="col-sm-3 mb-3 mb-sm-0">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Jumlah Barang yang Pernah Dipinjam:</h5>
                <p class="card-text fw-bold"><?php echo $total_peminjaman; ?></p>
                <a href="#" class="btn btn-primary">Go</a>
              </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Jumlah Barang yang Belum Dikembalikan: </h5>
                <p class="card-text fs-26 fw-bold"><?php echo $total_belum_dikembalikan; ?></p>
                <a href="#" class="btn btn-primary">Go</a>
              </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Total Jumlah Barang yang Tersedia: </h5>
                <p class="card-text fs-26 fw-bold"><?php echo $total_barang; ?></p>
                <a href="#" class="btn btn-primary">Go</a>
              </div>
            </div>
          </div>
        </div>
        <!-- Untuk Bagian Akhir Card -->

    <div class="mt-5">
        <form action="controller/logout.php" method="POST">
            <h1>Selamat Datang, <?php echo $_SESSION['nama']; ?>!</h1>
            <button type="submit" class="btn btn-promary">Logout</button>
        </form>
    </div>

    <!-- js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
