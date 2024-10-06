<?php
session_start(); 
include '../../config/config.php';

// Pastikan user_id ada dalam session
if (!isset($_SESSION['user_id'])) {
    header('Location: ../../ui/index.php'); // Redirect ke halaman login jika belum login
    exit();
}

$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Peminjaman Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script>
        // Fungsi untuk menampilkan popup
        function showAlert(message) {
            alert(message);
        }
    </script>
    <style>
        body {
            background-color: #f8f9fa;
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
                <a class="navbar-brand" href="../../dashboard.php">Peminjaman Barang Lab Siswa</a>
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
                            <a class="nav-link" href="rekap_peminjaman.php">Pinjam Barang</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../controller/logout.php">Log Out</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    
    <br><br><br><br>

    <div class="container">
        <h2>Informasi Barang</h2>

        <!-- Tabel Informasi Barang -->
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID Barang</th>
                    <th>Nama Barang</th>
                    <th>Jumlah Barang Tersedia</th>
                    <th>Deskripsi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Query untuk menampilkan informasi barang
                $sql_barang = "SELECT id, nama_barang, jumlah_pinjam, description FROM items";
                $query_barang = mysqli_query($conn, $sql_barang);

                while ($barang = mysqli_fetch_array($query_barang)) {
                    echo "<tr>";
                    echo "<td>".$barang['id']."</td>";
                    echo "<td>".$barang['nama_barang']."</td>";
                    echo "<td>".$barang['jumlah_pinjam']."</td>";
                    echo "<td>".$barang['description']."</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        
        <h2>Data Peminjaman</h2>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Peminjam</th>
                    <th>Nama Barang</th>
                    <th>Jumlah Barang</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Status</th>
                    <!-- <th>Actions</th> -->
                </tr>
            </thead>
            <tbody>
            <?php
                // Query untuk menampilkan data peminjaman berdasarkan user yang login
                $sql_peminjaman = "SELECT pinjams.id, user.nama, items.nama_barang, pinjams.jumlah, pinjams.tgl_peminjaman, pinjams.tgl_pengembalian, pinjams.status 
                                   FROM pinjams 
                                   INNER JOIN user ON pinjams.users_id = user.id 
                                   INNER JOIN items ON pinjams.items_id = items.id
                                   WHERE pinjams.users_id = '$user_id';"; // Tambahkan kondisi untuk user_id
                $query_peminjaman = mysqli_query($conn, $sql_peminjaman);

                while ($pinjam = mysqli_fetch_array($query_peminjaman)) {
                    echo "<tr>";
                    echo "<td>".$pinjam['id']."</td>";
                    echo "<td>".$pinjam['nama']."</td>";
                    echo "<td>".$pinjam['nama_barang']."</td>";
                    echo "<td>".$pinjam['jumlah']."</td>";
                    echo "<td>".$pinjam['tgl_peminjaman']."</td>";
                    echo "<td>".($pinjam['tgl_pengembalian'] ? $pinjam['tgl_pengembalian'] : "Belum dikembalikan")."</td>";
                    echo "<td>".$pinjam['status']."</td>";
                    
                    // Tombol pengembalian barang
                    // if ($pinjam['status'] == 'dipinjam') {
                    //     echo "<td><a href='form_pengembalian.php?id=".$pinjam['id']."' class='btn btn-success btn-sm'>Kembalikan</a></td>";
                    // } else {
                    //     echo "<td>Sudah dikembalikan</td>";
                    // }
                    
                    echo "</tr>";
                }
            ?>
            </tbody>
        </table>

        <div class="btn">
            <a href="form_peminjaman.php" class="btn btn-primary">Peminjaman</a>
        </div>
        
        <?php if (isset($_GET['status']) && $_GET['status'] == 'gagal' && isset($_GET['message'])): ?>
            <script>
                showAlert("<?php echo $_GET['message']; ?>");
            </script>
        <?php endif; ?>
    </div>

    <footer>
        <p>&copy; 2024 Peminjaman Barang Lab Siswa. SMK 11 NEGERI MALANG.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
