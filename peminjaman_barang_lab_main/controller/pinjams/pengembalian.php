<?php
include '../../config/config.php';

if (isset($_POST['submit'])) {
    $id_peminjaman = $_POST['pinjam_id'];

    // Ambil informasi peminjaman
    $sql_peminjaman = "SELECT items_id, jumlah FROM pinjams WHERE id = $id_peminjaman";
    $query_peminjaman = mysqli_query($conn, $sql_peminjaman);
    $peminjaman = mysqli_fetch_assoc($query_peminjaman);

    $item_id = $peminjaman['items_id'];
    $jumlah = $peminjaman['jumlah'];

    // Update status pengembalian dan tanggal pengembalian
    $tgl_pengembalian = date('Y-m-d');
    $sql_update_pinjams = "UPDATE pinjams SET status = 'dikembalikan', tgl_pengembalian = '$tgl_pengembalian' WHERE id = $id_peminjaman";
    mysqli_query($conn, $sql_update_pinjams);

    // Tambahkan kembali jumlah barang yang dipinjam ke tabel items
    $sql_update_item = "UPDATE items SET jumlah_pinjam = jumlah_pinjam + $jumlah WHERE id = $item_id";
    mysqli_query($conn, $sql_update_item);

    header('Location: ../../ui/pinjams/rekap_peminjaman.php?status=sukses');
}
?>
