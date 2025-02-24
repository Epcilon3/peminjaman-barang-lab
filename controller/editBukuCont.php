<?php
include '../config/conn.php';

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $penerbit = $_POST['penerbit'];
    $tahunTerbit = $_POST['tahunTerbit'];

    
    $sql = "UPDATE buku SET 
            Judul = '$judul', 
            Penulis = '$penulis', 
            Penerbit = '$penerbit', 
            TahunTerbit = '$tahunTerbit' 
            WHERE BukuID = $id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Buku berhasil diperbarui!'); window.location.href='../ui/page/bukuPage.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
