<?php
session_start(); 
include '../../config/config.php';

$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Peminjaman Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet"> <!-- Font Awesome for icons -->
    <script>
        // Fungsi untuk menampilkan popup
        function showAlert(message) {
            alert(message);
        }
    </script>
    <style>
        body {
            display: flex;
            min-height: 100vh;
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .sidebar {
            width: 250px;
            background-color: #343a40;
            padding-top: 20px;
            height: 100vh;
            transition: width 0.2s ease-in-out;
            position: fixed; /* Tetap di posisi */
            top: 0;
            left: 0;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .sidebar a {
            display: flex;
            align-items: center;
            color: white;
            padding: 15px;
            text-decoration: none;
            border-radius: 5px;
            margin: 5px 0;
            transition: background-color 0.3s;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .sidebar i {
            margin-right: 10px;
        }
        .content {
            flex: 1;
            margin-left: 250px; /* Mengimbangi lebar sidebar */
            padding: 20px;
            overflow-y: auto; /* Supaya tabel bisa di-scroll */
        }
        .table-container {
            max-height: 400px; /* Batas tinggi untuk tabel */
            overflow-y: auto; /* Scroll untuk tabel */
        }
        footer {
            text-align: center;
            margin: 20px 0;
            font-size: 0.9em;
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <div>
        <div class="text-center text-white mb-4">
            <h5>Admin</h5>
        </div>
        <a href="../../dashboardadmin.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <a href="../barang/barang.php"><i class="fas fa-box"></i> Daftar Barang</a>
        <a href="../labs/labs.php"><i class="fas fa-door-open"></i> Daftar Ruangan</a>
        <a href="../pinjams/admin_rekap_peminjaman.php"><i class="fas fa-book"></i> Rekap peminjaman</a>
    </div>
    <div>
        <a href="../../controller/logout.php" class="mt-auto"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
</div>

<!-- Main Content -->
<div class="content">
    <h2>Informasi Barang</h2>

    <!-- Tabel Informasi Barang -->
    <div class="table-container">
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
    </div>
    
    <h2>Rekap Peminjaman Barang</h2>
    
    <!-- Filter Tanggal Peminjaman dan Pengembalian -->
    <form method="GET" action="" class="form-inline">
        <div class="form-group mb-2">
            <label for="tgl_pinjam" class="mr-2">Tanggal Pinjam:</label>
            <input type="date" class="form-control" name="tgl_pinjam" id="tgl_pinjam" value="<?php echo isset($_GET['tgl_pinjam']) ? $_GET['tgl_pinjam'] : ''; ?>">
        </div>
        <div class="form-group mx-sm-3 mb-2">
            <label for="tgl_kembali" class="mr-2">Tanggal Kembali:</label>
            <input type="date" class="form-control" name="tgl_kembali" id="tgl_kembali" max="<?php echo date('Y-m-d'); ?>" value="<?php echo isset($_GET['tgl_kembali']) ? $_GET['tgl_kembali'] : ''; ?>">
        </div>
        <button type="submit" class="btn btn-primary mb-2">Filter</button>
    </form>

    <div class="table-container">
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
                </tr>
            </thead>
            <tbody>
            <?php
                // Set default filter untuk tanggal jika tidak ada input
                $filter_pinjam = isset($_GET['tgl_pinjam']) ? $_GET['tgl_pinjam'] : '';
                $filter_kembali = isset($_GET['tgl_kembali']) ? $_GET['tgl_kembali'] : '';

                // Query peminjaman dengan filter tanggal
                $sql_peminjaman = "SELECT pinjams.id, user.nama, items.nama_barang, pinjams.jumlah, pinjams.tgl_peminjaman, pinjams.tgl_pengembalian, pinjams.status 
                                   FROM pinjams 
                                   INNER JOIN user ON pinjams.users_id = user.id 
                                   INNER JOIN items ON pinjams.items_id = items.id
                                   WHERE 1=1"; // Base query

                // Tambahkan filter untuk tanggal peminjaman
                if ($filter_pinjam) {
                    $sql_peminjaman .= " AND pinjams.tgl_peminjaman >= '$filter_pinjam'";
                }

                // Tambahkan filter untuk tanggal pengembalian
                if ($filter_kembali) {
                    $sql_peminjaman .= " AND pinjams.tgl_pengembalian <= '$filter_kembali'";
                }

                $query_peminjaman = mysqli_query($conn, $sql_peminjaman);

                while ($pinjam = mysqli_fetch_array($query_peminjaman)) {
                    echo "<tr>";
                    echo "<td>".$pinjam['id']."</td>";
                    echo "<td>".$pinjam['nama']."</td>";
                    echo "<td>".$pinjam['nama_barang']."</td>";
                    echo "<td>".$pinjam['jumlah']."</td>";
                    echo "<td>".$pinjam['tgl_peminjaman']."</td>";
                    echo "<td>".($pinjam['tgl_pengembalian'] ? $pinjam['tgl_pengembalian'] : "Belum dikembalikan")."</td>";

                    if ($pinjam['status'] == 'dipinjam') {
                        echo "<td><a href='form_pengembalian.php?id=".$pinjam['id']."' class='btn btn-success btn-sm'>Kembalikan</a></td>";
                    } else {
                        echo "<td>Sudah dikembalikan</td>";
                    }
                    
                    echo "</tr>";
                }
            ?>
            </tbody>
        </table>
    </div>

    <?php if (isset($_GET['status']) && $_GET['status'] == 'gagal' && isset($_GET['message'])): ?>
        <script>
            showAlert("<?php echo $_GET['message']; ?>");
        </script>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


