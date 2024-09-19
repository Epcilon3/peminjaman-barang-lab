<?php 
include '../../config/config.php';

// Ambil daftar barang dan lab untuk ditampilkan di dropdown
$sql_items = "SELECT id, nama_barang FROM items";
$query_items = mysqli_query($conn, $sql_items);

$sql_labs = "SELECT id, nama_ruang FROM labs";
$query_labs = mysqli_query($conn, $sql_labs);

$sql_users = "SELECT id, nama FROM user";
$query_users = mysqli_query($conn, $sql_users);

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Peminjaman Barang</title>
</head>
<body>
    <header>
        <h2>Form Peminjaman Barang</h2>
    </header>
    <form action="../../controller/pinjam/proses_peminjaman.php" method="post">
        
        <div>
            <label for="user_id">User ID :</label>
            <select name="user_id" id="user_id" required>
                <?php while ($user = mysqli_fetch_array($query_users)) { ?>
                    <option value="<?php echo $user['id']; ?>"><?php echo $user['nama']; ?></option>
                <?php } ?>
            </select>
        </div>
        
        <div>
            <label for="item_id">Barang :</label>
            <select name="item_id" id="item_id" required>
                <?php while ($barang = mysqli_fetch_array($query_items)) { ?>
                    <option value="<?php echo $barang['id']; ?>"><?php echo $barang['nama_barang']; ?></option>
                <?php } ?>
            </select>
        </div>
        
        <div>
            <label for="labs_id">Ruangan Lab :</label>
            <select name="labs_id" id="labs_id" required>
                <?php while ($lab = mysqli_fetch_array($query_labs)) { ?>
                    <option value="<?php echo $lab['id']; ?>"><?php echo $lab['nama_ruang']; ?></option>
                <?php } ?>
            </select>
        </div>
        
        <div>
            <label for="jumlah">Jumlah Barang :</label>
            <input type="text" inputmode="number" name="jumlah" id="jumlah" min="1" required>
        </div>
        
        <div>
            <label for="tgl_pinjam">Tanggal Pinjam :</label>
            <input type="date" name="tgl_pinjam" id="tgl_pinjam" required>
        </div>

        <div>
            <label for="tgl_pengembalian">Tanggal Pengembalian :</label>
            <input type="date" name="tgl_pengembalian" id="tgl_pengembalian" required>
        </div>

        <div>
            <input type="submit" value="Pinjam" name="submit">
        </div>
    </form>
</body>
</html>
