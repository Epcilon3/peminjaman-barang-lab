
<?php
session_start();
include '../config/config.php';

// Periksa apakah sesi sudah ada
if (isset($_SESSION['nama'])) {
    header("Location: ../dashboard.php");
    exit();
}

// Proses login
if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    // $password = mysqli_real_escape_string($conn, $_POST['password']);
    $password = hash('sha256', $_POST['password']);
    
    $sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if ($result && $result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
    
        // Tambahkan user_id ke session
        $_SESSION['user_id'] = $row['id'];  // Menyimpan user_id ke dalam session
    
        if ($row['role'] == "siswa") {
            $_SESSION['nama'] = $row['nama'];  // Menggunakan $row['nama'] yang benar
            $_SESSION['role'] = "siswa";
            header('Location: ../dashboard.php');
        } else if ($row['role'] == "admin") {
            $_SESSION['nama'] = $row['nama'];  // Menggunakan $row['nama'] yang benar
            $_SESSION['role'] = "admin";
            header('Location: ../dashboardadmin.php');
        } else {
            echo "<script>alert('Gagal Login')</script>";
        }
    } else {
        echo "<script>alert('Username atau Password salah, coba lagi.')</script>";
    }
    
}



// Jangan lupa untuk menutup koneksi jika diperlukan di bagian akhir script
$conn->close();
?>
