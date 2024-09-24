<?php
session_start(); // Pa
include '../../config/config.php';

if(isset($_GET['id'])) {
    $id_peminjaman = $_GET['id'];

    // Ambil data peminjaman berdasarkan ID
    $sql = "SELECT pinjams.id, items.nama_barang 
            FROM pinjams 
            INNER JOIN items ON pinjams.items_id = items.id 
            WHERE pinjams.id = $id_peminjaman";
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
</head>
<body>
    <h2>Form Pengembalian Barang</h2>

    <form action="../../controller/pinjams/pengembalian.php" method="POST">
        <input type="hidden" name="pinjam_id" value="<?php echo $data_peminjaman['id']; ?>">
        
        <label for="nama_barang">Nama Barang:</label>
        <input type="text" name="nama_barang" id="nama_barang" value="<?php echo $data_peminjaman['nama_barang']; ?>" readonly><br>

        <button type="submit" name="submit">Kembalikan</button>
    </form>

    <?php if(isset($_GET['status'])): ?>
    <p>
        <?php
            if($_GET['status'] == 'sukses'){
                echo "Pengembalian Berhasil";
            } else {
                echo "Pengembalian Gagal";
            }
        ?>
    </p>
    <?php endif; ?>
</body>
</html>
