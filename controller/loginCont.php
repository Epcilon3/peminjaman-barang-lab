
<?php
session_start();
include '../config/conn.php';

if (isset($_SESSION['nama'])) {
    header("Location: ../dashboard/.php");
    exit();
}


if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = hash('sha256', $_POST['password']);
    
    $sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";
    // echo $sql;

    $result = mysqli_query($conn, $sql);

    if ($result && $result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
    
       
    
        if ($row['Role'] == "administrator") {
            $_SESSION['Username'] = $row['Username']; 
            $_SESSION['Role'] = "administrator";

            header('Location: ../ui/dashboard/dashAdministrator.php');
        } else if ($row['Role'] == "petugas") {
            $_SESSION['Username'] = $row['Username'];  
            $_SESSION['Role'] = "petugas";

            header('Location: ../ui/dashboard/dashPetugas.php');
        } elseif ($row['Role'] == "peminjam") {
            $_SESSION['Username'] = $row['Username'];  
            $_SESSION['Role'] = "peminjam";

            header('Location: ../ui/dashboard/dashPeminjaman.php');
        } 
        
        else {
            echo "<script>alert('Gagal Login')</script>";
        }
    } else {
        echo "<script>alert('Username atau Password salah, coba lagi.')</script>";
    }
    
}


$conn->close();
?>