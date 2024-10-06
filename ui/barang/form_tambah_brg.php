<?php
    include '../../config/config.php';
    
    // Ambil data dari tabel labs
    $sql = "SELECT id, nama_ruang FROM labs";
    $result = $conn->query($sql);

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
    <title>Form Tambah Barang</title>
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

        .btn-success {
            background-color: #28a745;
        }

        /* Optional: for smaller screens, the form is fully responsive */
        @media (max-width: 576px) {
            .card {
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="card-header bg-primary text-white text-center">
            <h3 class="card-title">Form Tambah Barang Baru</h3>
        </div>
        <div class="card-body">
            <form action="../../controller/barang/tambah_brg.php" method="POST">
                <div class="mb-3">
                    <label for="nama_barang" class="form-label">Nama Barang:</label>
                    <input type="text" name="nama_barang" id="nama_barang" class="form-control" placeholder="Masukkan nama barang" required>
                </div>

                <div class="mb-3">
                    <label for="jumlah_pinjam" class="form-label">Stock Barang:</label>
                    <input type="number" name="jumlah_pinjam" id="jumlah_pinjam" class="form-control" placeholder="Masukkan jumlah stok barang" required>
                </div>

                <div class="mb-3">
                    <label for="nama_ruang" class="form-label">Nama Ruang:</label>
                    <select id="nama_ruang" name="nama_ruang" class="form-select" required>
                        <option value="" disabled selected>Pilih Ruang</option>
                        <?php
                        // Tampilkan opsi nama ruang
                        foreach ($labs as $lab) {
                            echo "<option value=\"" . $lab['id'] . "\">" . $lab['nama_ruang'] . "</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description:</label>
                    <textarea name="description" id="description" class="form-control" rows="4" placeholder="Deskripsi barang" required></textarea>
                </div>

                <div class="d-grid">
                    <button type="submit" name="submit" value="submit" class="btn btn-success btn-block">Tambah Barang</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
