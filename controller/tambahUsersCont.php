<?php
include '../config/conn.php';

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = hash('sha256', $_POST['password']); 
    $email = $_POST['email'];
    $namalengkap = $_POST['namalengkap'];
    $alamat = $_POST['alamat'];
    $role = $_POST['Role'];

   
    $checkQuery = "SELECT * FROM user WHERE Username = '$username'";
    $checkResult = $conn->query($checkQuery);

    if ($checkResult->num_rows > 0) {
        echo "<script>alert('Username sudah digunakan, silakan pilih username lain!'); window.location.href='../ui/page/tambahUsersPage.php';</script>";
    } else {

        $sql = "INSERT INTO user (Username, Password, Email, namaLengkap, Alamat, Role) 
                VALUES ('$username', '$password', '$email', '$namalengkap', '$alamat', '$role')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('User berhasil ditambahkan!'); window.location.href='../ui/users/usersPage.php';</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>

