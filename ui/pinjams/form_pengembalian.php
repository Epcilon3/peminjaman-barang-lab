<?php
session_start();
include '../../config/config.php';

if (isset($_GET['id'])) {
    $id_peminjaman = $_GET['id'];

    // Ambil data peminjaman berdasarkan ID
    $sql = "SELECT pinjams.id, items.nama_barang, pinjams.jumlah 
            FROM pinjams 
            INNER JOIN items ON pinjams.items_id = items.id
            WHERE pinjams.id = $id_peminjaman;";
    $query = mysqli_query($conn, $sql);
    $data_peminjaman = mysqli_fetch_assoc($query);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pengembalian Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        h2 {
            margin-top: 20px;
            text-align: center;
            color: #343a40;
        }
        .form-container {
            max-width: 500px;
            margin: 50px auto;
            padding: 30px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        .btn-custom {
            background-color: #007bff;
            color: white;
            border: none;
        }
        .btn-custom:hover {
            background-color: #0056b3;
        }
        .alert {
            margin-top: 20px;
        }
        .form-label {
            font-weight: bold;
            color: #343a40;
        }
    </style>
</head>
<body>
    <div class="container form-container">
        <h2>Form Pengembalian Barang</h2>

        <form action="../../controller/pinjams/pengembalian.php" method="POST">
            <input type="hidden" name="pinjam_id" value="<?php echo $data_peminjaman['id']; ?>">
            
            <div class="mb-3">
                <label for="nama_barang" class="form-label">Nama Barang:</label>
                <input type="text" name="nama_barang" id="nama_barang" value="<?php echo $data_peminjaman['nama_barang']; ?>" class="form-control" readonly>
            </div>
            
            <div class="mb-3">
                <label for="jumlah" class="form-label">Jumlah Barang</label>
                <input type="text" name="jumlah" id="jumlah" value="<?php echo $data_peminjaman['jumlah']; ?>" class="form-control" readonly>
            </div>

            <button type="submit" name="submit" class="btn btn-custom btn-lg">Kembalikan</button>
        </form>

        <?php if (isset($_GET['status'])): ?>
            <div class="alert alert-<?php echo ($_GET['status'] == 'sukses') ? 'success' : 'danger'; ?>" role="alert">
                <?php
                    echo ($_GET['status'] == 'sukses') ? "Pengembalian Berhasil" : "Pengembalian Gagal";
                ?>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
