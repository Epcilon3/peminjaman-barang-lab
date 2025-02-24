<?php
include '../../config/conn.php';

$sql = "SELECT * FROM user";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Users</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <a href="../dashboard/dashAdministrator.php">Dahsboard</a>
    <a href="../page/bukuPage.php">Daftar Buku</a>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Daftar Users</h1>

        <a href="tambahUsersPage.php" class="btn btn-outline-secondary mb-2">+</a>


        <table class="table table-bordered table-striped table-hover">
            <thead class="table-light">
                <tr>
                    <th scope="col">UserID</th>
                    <th scope="col">Username</th>
                    <!-- <th scope="col">Password</th> -->
                    <th scope="col">Email</th>
                    <th scope="col">Nama Lengkap</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Role</th>
                    <th scope="col" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["UserID"] . "</td>";
                        echo "<td>" . $row["Username"] . "</td>";
                        // echo "<td>" . $row["Password"] . "</td>";
                        echo "<td>" . $row["Email"] . "</td>";
                        echo "<td>" . $row["NamaLengkap"] . "</td>";
                        echo "<td>" . $row["Alamat"] . "</td>";
                        echo "<td>" . $row["Role"] . "</td>";
                        echo "<td class='text-center'>";
                        echo "<a href='editUsersPage.php?id=" . $row["UserID"] . "' class='btn btn-primary bi bi-pencil-fill'></a> ";
                        echo "<a href='../../controller/hapusUsersCont.php?id=" . $row["UserID"] . "' class='btn btn-danger bi bi-trash-fill' onclick='return confirm(\"Apakah Anda yakin ingin menghapus User ini?\")'></a>";
                        echo "</td>";                        
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' class='text-center'>Data tidak ditemukan</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
