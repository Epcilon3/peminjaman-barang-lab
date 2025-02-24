<?php
include '../config/conn.php';

if (isset($_POST['submit'])) {
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $penerbit = $_POST['penerbit'];
    $tahunTerbit = $_POST['tahunTerbit'];

    $sql = "INSERT INTO buku (Judul, Penulis, Penerbit, TahunTerbit) 
            VALUES ('$judul', '$penulis', '$penerbit', '$tahunTerbit')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Buku berhasil ditambahkan!'); window.location.href='../ui/page/bukuPage.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>