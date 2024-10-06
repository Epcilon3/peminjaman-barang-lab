<?php 
include '../../config/config.php';

if (isset($_POST['submit'])) {
    $user_id = $_POST['user_id'];
    $item_id = $_POST['item_id'];
    $labs_id = $_POST['labs_id'];
    $jumlah = $_POST['jumlah'];
    $tgl_pinjam = $_POST['tgl_pinjam'];
    $tgl_pengembalian = $_POST['tgl_pengembalian'];
    $status = 'dipinjam'; // Set status awal sebagai "dipinjam"

    // Validasi input
    if ($jumlah <= 0) {
        die("Jumlah barang harus lebih dari 0!");
    }

    // Prepared statement untuk menghindari SQL injection
    $sql = "INSERT INTO pinjam (user_id, item_id, labs_id, jumlah, tgl_pinjam, tgl_pengembalian, status) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    
    // Bind parameter: 'i' untuk integer, 's' untuk string/tanggal
    mysqli_stmt_bind_param($stmt, 'iiiisss', $user_id, $item_id, $labs_id, $jumlah, $tgl_pinjam, $tgl_pengembalian, $status);
    
    // Eksekusi query
    if (mysqli_stmt_execute($stmt)) {
        header('Location: ../../ui/pinjam/peminjaman.php');
        exit();
    } else {
        die("Gagal melakukan peminjaman!");
    }
} else {
    die("Akses tidak diizinkan!");
}
