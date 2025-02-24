<?php
include '../../config/conn.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="bg-light">

    <div class="container mt-5">
        <h1 class="text-center mb-4">Tambah Users</h1>

        <!-- Pembatas untuk form menggunakan card -->
        <div class="card p-4 shadow-sm">
            <form action="../../controller/tambahUsersCont.php" method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

                <div class="mb-3">
                    <label for="namalengkap" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" id="namalengkap" name="namalengkap" required>
                </div>
                
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" required>
                </div>
                
                <div class="mb-3">
                    <label for="namalengkap" class="form-label">Role</label>
                    <select name="Role" class="form-select" required>
                        <!-- <option value="administrator">Admin</option> -->
                        <option value="" input disabled >Bisa Dipilih</option>
                        <option value="petugas" >Petugas</option>
                        <option value="admin" >Admin</option>
                        <!-- <option value="peminjam">Peminjam</option> -->
                    </select>
                </div>
                



                <button type="submit" class="btn btn-primary" name="submit">Tambah User</button>
                <a href="usersPage.php" class="btn btn-secondary">Kembali ke Daftar Users</a>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
