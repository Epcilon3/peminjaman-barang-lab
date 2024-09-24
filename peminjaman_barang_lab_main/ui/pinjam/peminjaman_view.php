<?php
session_start();
include '../../config/config.php';


$user_id = $_SESSION['user_id'];

// Ambil data peminjaman berdasarkan user_id yang login
$sql = "SELECT p.*, i.nama_barang, l.nama_ruang 
        FROM pinjam p 
        JOIN items i ON p.item_id = i.id
        JOIN labs l ON p.labs_id = l.id
        WHERE p.user_id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, 'i', $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Peminjaman</title>
</head>
<body>
    <h2>Data Peminjaman Barang</h2>
    
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Barang</th>
                <th>Ruangan Lab</th>
                <th>Jumlah</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Pengembalian</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['nama_barang']; ?></td>
                    <td><?php echo $row['nama_ruang']; ?></td>
                    <td><?php echo $row['jumlah']; ?></td>
                    <td><?php echo $row['tgl_pinjam']; ?></td>
                    <td><?php echo $row['tgl_pengembalian']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
