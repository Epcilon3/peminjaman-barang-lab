<?php
session_start(); // Pa
include '../../config/config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Peminjaman Barang</title>
</head>
<body>
    <h2>Form Peminjaman Barang</h2>

    <form action="../../controller/pinjams/peminjaman.php" method="POST">
        <label for="item">Pilih Barang:</label>
        <select name="item_id" id="item">
            <?php
            $sql = "SELECT id, nama_barang FROM items";
            $query = mysqli_query($conn, $sql);
            while ($barang = mysqli_fetch_array($query)) {
                echo "<option value='".$barang['id']."'>".$barang['nama_barang']."</option>";
            }
            ?>
        </select><br>

        <label for="jumlah">Jumlah:</label>
        <input type="number" name="jumlah" id="jumlah" required><br>

        <!-- <label for="tgl_peminjaman">Tanggal Pinjam</label> -->
        <!-- <input inputmode="date" type="text" name="tgl_peminjaman" id="tgl_peminjaman" requiered><br> --> 

        <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
        <button type="submit" name="submit">Pinjam</button>
    </form>

    <?php if(isset($_GET['status'])): ?>
    <p>
        <?php
            if($_GET['status'] == 'sukses'){
                echo "Peminjaman Berhasil";
            } else {
                echo "Peminjaman Gagal";
            }
        ?>
    </p>
    <?php endif; ?>
</body>
</html>
