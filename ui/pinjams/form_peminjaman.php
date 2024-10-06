<?php
session_start();
include '../../config/config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Peminjaman Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: #eef2f3;
            font-family: Arial, sans-serif;
        }
        h2 {
            margin-top: 20px;
            margin-bottom: 20px;
            text-align: center;
            color: #333;
        }
        .form-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 30px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
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
            color: #333;
        }
    </style>
</head>
<body>
    <!-- <nav class="navbar navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <h2>
                <a class="navbar-brand" href="../../dashboard.php">Peminjaman Barang Lab Siswa</a>
            </h2>
        </div>
    </nav> -->

    <br><br><br><br>

    <div class="container form-container">
        <h2>Form Peminjaman Barang</h2>

        <form action="../../controller/pinjams/peminjaman.php" method="POST">
            <div class="mb-3">
                <label for="item" class="form-label">Pilih Barang:</label>
                <select name="item_id" id="item" class="form-select" required>
                    <?php
                    $sql = "SELECT id, nama_barang FROM items";
                    $query = mysqli_query($conn, $sql);
                    while ($barang = mysqli_fetch_array($query)) {
                        echo "<option value='".$barang['id']."'>".$barang['nama_barang']."</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="jumlah" class="form-label">Jumlah:</label>
                <input type="number" name="jumlah" id="jumlah" class="form-control" required>
            </div>

            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
            <button type="submit" name="submit" class="btn btn-custom btn-lg">Pinjam</button>
        </form>

        <?php if(isset($_GET['status'])): ?>
            <div class="alert alert-<?php echo ($_GET['status'] == 'sukses') ? 'success' : 'danger'; ?>" role="alert">
                <?php
                    echo ($_GET['status'] == 'sukses') ? "Peminjaman Berhasil" : "Peminjaman Gagal";
                ?>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
