<?php
session_start(); // Pastikan session sudah dimulai
include '../../config/config.php';

if(!isset($_SESSION['user_id'])){
    header('Location: ../../ui/login.php'); // Redirect ke halaman login jika belum login
    exit();
}

if(isset($_POST['submit'])){
    $user_id = $_SESSION['user_id']; // Diambil dari session login
    $item_id = $_POST['item_id'];
    $jumlah = $_POST['jumlah'];
    
    // Cek jumlah barang yang tersedia
    $sql_check = "SELECT jumlah_pinjam FROM items WHERE id = $item_id";
    $query_check = mysqli_query($conn, $sql_check);
    $barang = mysqli_fetch_assoc($query_check);
    
    if ($barang['jumlah_pinjam'] < $jumlah) {
        // Jika jumlah yang diminta lebih banyak dari yang tersedia
        header('Location: ../../ui/pinjams/rekap_peminjaman.php?status=gagal&message=Jumlah barang tidak cukup');
        exit();
    }

    $tgl_peminjaman = date('Y-m-d');
    $tgl_pengembalian = NULL; // Pengembalian belum dilakukan, jadi NULL
    $status = 'dipinjam';

    // Insert peminjaman
    $sql = "INSERT INTO pinjams (users_id, items_id, jumlah, tgl_peminjaman, tgl_pengembalian, status) 
            VALUES ('$user_id', '$item_id', '$jumlah', '$tgl_peminjaman', NULL, '$status')";

    if(mysqli_query($conn, $sql)){
        // Update jumlah barang yang dipinjam
        $sql_update_item = "UPDATE items SET jumlah_pinjam = jumlah_pinjam - $jumlah WHERE id = $item_id";
        mysqli_query($conn, $sql_update_item);
        header('Location: ../../ui/pinjams/rekap_peminjaman.php?status=sukses');
    } else {
        header('Location: ../../ui/pinjams/rekap_peminjaman.php?status=gagal');
    }
}
?>
