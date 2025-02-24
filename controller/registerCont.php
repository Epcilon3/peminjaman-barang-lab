<?php
session_start();
include '../config/conn.php';

if (isset($_POST['submit'])) {

    $NamaLengkap = mysqli_real_escape_string($conn, $_POST['NamaLengkap']);
    $Username = mysqli_real_escape_string($conn, $_POST['Username']);
    $Password = hash('sha256', $_POST['Password']); 
    $Email = mysqli_real_escape_string($conn, $_POST['Email']);
    $Alamat = mysqli_real_escape_string($conn, $_POST['Alamat']);
    $Role = 'peminjam'; 

    $sql = "SELECT * FROM user WHERE LOWER(username) = LOWER(?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $Username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('Username sudah terdaftar. Silakan pilih username lain.'); window.history.back();</script>";
    } else {
        $sql = "INSERT INTO user (NamaLengkap, Username, Password, Email, Alamat, Role) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $NamaLengkap, $Username, $Password, $Email, $Alamat, $Role);

        if ($stmt->execute()) {
            $_SESSION['Username'] = $Username; 
            header("Location: ../loginView.php?message=Registrasi Berhasil");
            exit();
        } else {
            echo "<script>alert('Terjadi Kesalahan saat melakukan registrasi.');</script>";
        }
    }
    $stmt->close();
}
$conn->close();
?>
