
<?php 
include '../../config/config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Cek apakah barang masih dipinjam
    $check_pinjaman = "SELECT * FROM pinjams WHERE items_id = $id AND status = 'dipinjam'";
    $query_pinjaman = mysqli_query($conn, $check_pinjaman);

    // Jika masih ada barang yang dipinjam
    if (mysqli_num_rows($query_pinjaman) > 0) {
        // Redirect kembali ke halaman barang dengan pesan peringatan
        header('Location: ../../ui/barang/barang.php?status=gagal&message=Barang masih ada yang dipinjam, tidak dapat dihapus');
        exit();
    }

    // Jika barang tidak sedang dipinjam, lanjutkan hapus
    $sql = "DELETE FROM items WHERE id=$id";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        header('Location: ../../ui/barang/barang.php?status=sukses');
    } else {
        die("Data Gagal Dihapus");
    }
} else {
    die("Akses Hapus Dilarang !! ");
}
?>
