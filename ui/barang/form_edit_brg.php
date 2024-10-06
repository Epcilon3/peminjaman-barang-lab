<?php 
include '../../config/config.php';

if (!isset($_GET['id'])) {
    header('Location: barang.php');
    exit();
}

$id = $_GET['id'];

$sql = "SELECT * FROM items WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$barang = mysqli_fetch_array($result);

if (mysqli_num_rows($result) < 1) {
    die("Data Tidak Ditemukan!");
}

// Ambil data dari tabel labs
$sqla = "SELECT id, nama_ruang FROM labs";
$result = $conn->query($sqla);

$labs = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $labs[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Edit Barang</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Centering the card in the middle of the page */
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            max-width: 500px;
            width: 100%;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            border-radius: 10px;
        }

        .card-header {
            border-radius: 10px 10px 0 0;
        }

        /* Optional: for smaller screens, the form is fully responsive */
        @media (max-width: 576px) {
            .card {
                padding: 15px;
            }
        }
    </style>
</head>
<body >
    <div class="card">
        <div class="card-header bg-warning text-white text-center">
            <h3 class="card-title">Edit Data Barang</h3>
        </div>
        <div class="card-body">
            <form action="../../controller/barang/edit_brg.php" method="post">
                <input type="hidden" name="id" id="id" value="<?php echo htmlspecialchars($barang['id']); ?>" />

                <div class="mb-3">
                    <label for="nama_barang" class="form-label">Nama Barang:</label>
                    <input type="text" name="nama_barang" id="nama_barang" class="form-control" value="<?php echo htmlspecialchars($barang['nama_barang']); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="jumlah_pinjam" class="form-label">Stock Barang:</label>
                    <input type="number" name="jumlah_pinjam" id="jumlah_pinjam" class="form-control" value="<?php echo htmlspecialchars($barang['jumlah_pinjam']); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="nama_ruang" class="form-label">Nama Ruang:</label>
                    <select id="nama_ruang" name="ruang_id" class="form-select" required>
                        <?php
                        // Tampilkan opsi nama ruang
                        foreach ($labs as $lab) {
                            $selected = ($barang['ruang_id'] == $lab['id']) ? ' selected' : '';
                            echo "<option value=\"" . $lab['id'] . "\"" . $selected . ">" . $lab['nama_ruang'] . "</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi:</label>
                    <textarea name="description" id="description" class="form-control" rows="4" required><?php echo htmlspecialchars($barang['description']); ?></textarea>
                </div>

                <div class="d-grid">
                    <button type="submit" name="submit" value="simpan"class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
