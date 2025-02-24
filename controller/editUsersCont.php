<?php
include '../config/conn.php';

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $namalengkap = $_POST['namalengkap'];
    $alamat = $_POST['alamat'];
    $role = $_POST['role'];

   
    if (!empty($_POST['password'])) {
        $password = hash('sha256', $_POST['password']); 
        $sql = "UPDATE user SET 
                Password = '$password', 
                Email = '$email', 
                NamaLengkap = '$namalengkap', 
                Alamat = '$alamat', 
                Role = '$role' 
                WHERE UserID = $id";
    } else {
        $sql = "UPDATE user SET 
                Email = '$email', 
                NamaLengkap = '$namalengkap', 
                Alamat = '$alamat', 
                Role = '$role' 
                WHERE UserID = $id";
    }

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('User berhasil diperbarui!'); window.location.href='../ui/users/usersPage.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
