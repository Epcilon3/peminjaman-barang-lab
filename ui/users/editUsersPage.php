<?php
include '../../config/conn.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $sql = "SELECT * FROM user WHERE UserID = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "<script>alert('User tidak ditemukan!'); window.location.href='usersPage.php';</script>";
        exit();
    }
} else {
    echo "<script>alert('ID tidak valid!'); window.location.href='usersPage.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-5">
        <h1 class="text-center mb-4">Edit User</h1>

        <div class="card p-4 shadow-sm">
            <form action="../../controller/editUsersCont.php" method="POST">
                <input type="hidden" name="id" value="<?= $row['UserID']; ?>">

                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?= $row['Username']; ?>" readonly>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password (Kosongkan jika tidak ingin mengubah)</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password baru jika ingin mengubah">
                </div>


                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?= $row['Email']; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="namalengkap" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" id="namalengkap" name="namalengkap" value="<?= $row['NamaLengkap']; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $row['Alamat']; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select name="role" class="form-select" required>
                        <option value="petugas" <?= ($row['Role'] == 'petugas') ? 'selected' : ''; ?>>Petugas</option>
                        <option value="admin" <?= ($row['Role'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
                    </select>
                </div>


                <button type="submit" class="btn btn-primary" name="submit">Simpan Perubahan</button>
                <a href="usersPage.php" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
