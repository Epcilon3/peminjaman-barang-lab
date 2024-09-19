<?php 
include '../../config/config.php';

if (!isset($_GET['id'])) {
    header('Location: labs.php');
    exit();
}

$id = $_GET['id'];

$sql = "SELECT * FROM labs WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$barang = mysqli_fetch_array($result);

if (mysqli_num_rows($result) < 1) {
    die("Data Tidak Ditemukan!");
}
?>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Edit Daftar Ruangan</title>
</head>
<body>
    <header>
        <h2>Edit Data Ruangan</h2>
    </header>
    <form action="../../controller/labs/edit_labs.php" method="post">
        <input type="hidden" name="id" id="id" value="<?php echo htmlspecialchars($labs['id']); ?>" />
        
        <div>
            <label for="nama_ruang">Nama Ruang :</label>
            <input type="text" name="nama_ruang" id="nama_ruang" value="<?php echo htmlspecialchars($lab['nama_ruang']); ?>" />
        </div>
        <div>
            <input type="submit" value="Simpan" name="submit">
        </div>

    </form>
</body>
</html> -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Edit Daftar Ruangan</title>
</head>
<body>
    <header>
        <h2>Edit Data Ruangan</h2>
    </header>
    <form action="../../controller/labs/edit_labs.php" method="post">
        <input type="hidden" name="id" id="id" value="<?php echo htmlspecialchars($barang['id']); ?>" />
        
        <div>
            <label for="nama_ruang">Nama Ruang :</label>
            <input type="text" name="nama_ruang" id="nama_ruang" value="<?php echo htmlspecialchars($barang['nama_ruang']); ?>" />
        </div>
        <div>
            <input type="submit" value="Simpan" name="submit">
        </div>

    </form>
</body>
</html>
