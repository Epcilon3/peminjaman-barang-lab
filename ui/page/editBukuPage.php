<?php
include '../../config/conn.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $sql = "SELECT * FROM buku WHERE BukuID = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "<script>alert('Buku tidak ditemukan!'); window.location.href='barangPage.php';</script>";
        exit();
    }
} else {
    echo "<script>alert('ID tidak valid!'); window.location.href='barangPage.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-5">
        <h1 class="text-center mb-4">Edit Buku</h1>

        <div class="card p-4 shadow-sm">
            <form action="../../controller/editBukuCont.php" method="POST">
                <input type="hidden" name="id" value="<?= $row['BukuID']; ?>">

                <div class="mb-3">
                    <label for="judul" class="form-label">Judul Buku</label>
                    <input type="text" class="form-control" id="judul" name="judul" value="<?= $row['Judul']; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="penulis" class="form-label">Penulis</label>
                    <input type="text" class="form-control" id="penulis" name="penulis" value="<?= $row['Penulis']; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="penerbit" class="form-label">Penerbit</label>
                    <input type="text" class="form-control" id="penerbit" name="penerbit" value="<?= $row['Penerbit']; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="tahunTerbit" class="form-label">Tahun Terbit</label>
                    <input type="number" class="form-control" id="tahunTerbit" name="tahunTerbit" value="<?= $row['TahunTerbit']; ?>" required>
                </div>

                <button type="submit" class="btn btn-primary" name="submit">Simpan Perubahan</button>
                <a href="bukuPage.php" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
