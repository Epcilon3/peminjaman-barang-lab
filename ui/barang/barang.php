<?php
include '../../config/config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Barang</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
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
            padding: 20px;
        }
        .card-header {
            background: linear-gradient(90deg, #17a2b8, #0d6efd);
        }
        .alert {
            margin-top: 20px;
        }
        .table th, .table td {
            text-align: center;
        }
    </style>
</head>
<body>
    

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="text-center text-white mb-4">
            <h5>Admin</h5>
        </div>
        <a href="../../dashboardadmin.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <a href="../barang/barang.php"><i class="fas fa-box"></i> Daftar Barang</a>
        <a href="../labs/labs.php"><i class="fas fa-door-open"></i> Daftar Ruangan</a>
        <a href="../pinjams/admin_rekap_peminjaman.php"><i class="fas fa-book"></i>Rekap Peminjaman</a>
        <a href="../../controller/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>

    <!-- Main Content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12"> <!-- Sesuaikan ukuran kolom -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-header text-white text-center">
                            <h3 class="card-title">Barang</h3>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h5 class="card-title">Daftar Barang</h5>
                                <a href="form_tambah_brg.php" class="btn btn-info">[+] Tambah Barang Baru</a>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="alert alert-dark">
                                        <tr>
                                            <th>ID</th>
                                            <th>Nama Barang</th>
                                            <th>Stock</th>
                                            <th>Ruang</th>
                                            <th>Description</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $sql = "SELECT items.id, items.nama_barang, items.jumlah_pinjam, labs.nama_ruang, items.description FROM items INNER JOIN labs ON items.ruang_id = labs.id";
                                            $query = mysqli_query($conn, $sql);

                                            while ($barang = mysqli_fetch_array($query)) {
                                                echo "<tr>";
                                                echo "<td>".$barang['id']."</td>";
                                                echo "<td>".$barang['nama_barang']."</td>";
                                                echo "<td>".$barang['jumlah_pinjam']."</td>";
                                                echo "<td>".$barang['nama_ruang']."</td>";
                                                echo "<td>".$barang['description']."</td>";
                                                echo "<td>";
                                                echo "<a href='form_edit_brg.php?id=".$barang['id']."' class='btn btn-outline-success btn-sm me-2'>Edit</a>";
                                                echo "<a href='../../controller/barang/hapus_brg.php?id=".$barang['id']."' class='btn btn-danger btn-sm'>Hapus</a>";
                                                echo "</td>";
                                                echo "</tr>";
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <p class="text-end"><strong>Total Barang: <?php echo mysqli_num_rows($query) ?></strong></p>

                            <?php if(isset($_GET['status'])): ?>
                            <div class="alert <?php echo $_GET['status'] == 'sukses' ? 'alert-success' : 'alert-danger'; ?>" role="alert">
                                
                            </div>
                            <?php endif; ?>
                            <?php if (isset($_GET['status']) && $_GET['status'] == 'gagal' && isset($_GET['message'])): ?>
                                <div class="alert alert-danger" role="alert">
                            <?php echo $_GET['message']; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                </div>
                
            </div>
            
        </div>
    </div>
    

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
