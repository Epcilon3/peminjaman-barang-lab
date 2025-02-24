<?php
include '../config/conn.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $sql = "DELETE FROM buku WHERE BukuID = $id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Buku berhasil dihapus!'); window.location.href='../ui/page/bukuPage.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
