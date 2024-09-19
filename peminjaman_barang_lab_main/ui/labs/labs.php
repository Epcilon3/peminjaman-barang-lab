<?php 
include '../../config/config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Ruangan</title>
</head>
<body>
    <h2>Daftar Ruangan Labs</h2>
    <nav>
        <button><a href="form_tambah_labs.php">[+] Tambah Labs Baru</a></button>
    </nav>
    <br>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Ruangan</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $sql = "SELECT * FROM labs";
                
                $query = mysqli_query($conn, $sql);

                while ($labs = mysqli_fetch_array($query)) {
                    echo "<tr>";
                    
                    echo "<td>".$labs['id']."</td>";
                    echo "<td>".$labs['nama_ruang']."</td>";

                    echo "<td>";
                    echo " <a href='form_edit_labs.php?id= ".$labs['id']."'>Edit</a> | ";
                    echo " <a href='../../controller/labs/hapus_labs.php?id= ".$labs['id']."'>Hapus</a> | ";
                    echo "</td>";

                    echo "</tr>";
                }

            ?>
        </tbody>
    </table>
    <p>Total Ruangan:<?php echo mysqli_num_rows($query) ?></p>
    <?php if(isset($_GET['status'])): ?>
    <p>
        <?php
            if($_GET['status'] == 'sukses'){
                echo "Data Ruangan Berhasil Ditambahkan";
            } else {
                echo "Tambah Data Ruangan Gagal";
            }
        ?>
    </p>
    <?php endif;  ?>

</body>
</html>


