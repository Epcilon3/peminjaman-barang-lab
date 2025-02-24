<?php
include '../../config/conn.php';

$sql = "SELECT * FROM buku";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Buku</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <a href="../dashboard/dashAdministrator.php">dashboard</a>
    <a href="../users/usersPage.php">Daftar User</a>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Daftar Buku</h1>

        <a href="tambahBukuPage.php" class="btn btn-outline-secondary mb-2">+</a>


        <table class="table table-bordered table-striped table-hover">
            <thead class="table-light">
                <tr>
                    <th scope="col">BukuID</th>
                    <th scope="col">Judul</th>
                    <th scope="col">Penulis</th>
                    <th scope="col">Penerbit</th>
                    <th scope="col">Tahun Terbit</th>
                    <th scope="col" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["BukuID"] . "</td>";
                        echo "<td>" . $row["Judul"] . "</td>";
                        echo "<td>" . $row["Penulis"] . "</td>";
                        echo "<td>" . $row["Penerbit"] . "</td>";
                        echo "<td>" . $row["TahunTerbit"] . "</td>";
                        echo "<td class='text-center'>";
                        echo "<a href='editBukuPage.php?id=" . $row["BukuID"] . "' class='btn btn-primary bi bi-pencil-fill'></a> ";
                        echo "<a href='../../controller/hapusBukuCont.php?id=" . $row["BukuID"] . "' class='btn btn-danger bi bi-trash-fill' onclick='return confirm(\"Apakah Anda yakin ingin menghapus buku ini?\")'></a>";
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
