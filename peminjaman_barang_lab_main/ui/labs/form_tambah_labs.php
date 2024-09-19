<?php 
    include '../../config/config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Tambah Ruangant</title>
</head>
<body>
    <header>Form Tambah Barang Baru</header>
    <form action="../../controller/labs/tambah_labs.php" method="POST">
        <div>
            <label for="nama_ruang">Nama Ruangan :</label>
            <input type="text" name="nama_ruang" id="nama_ruang" required>
        </div>
        <div>
            <input type="submit" value="submit" name="submit">
        </div>
    </form>
</body>
</html>