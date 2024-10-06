<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="style/style1.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
    <div class="wrapper">
        <div class="form-box login">
            <h2 class="lgn">LOGIN</h2>
            <form action="controller/login.php" method="POST">
                <!--INPUT EMAIL -->
                <div class="input-box">
                    <span class="icon"><ion-icon name="mail-outline"></ion-icon></span>
                    <input type="text" name="username" id="" placeholder="username" required>
                    <label for="">Username</label>
                </div>

                <!--INPUT PASSWORD -->
                <div class="input-box">
                    <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                    <input type="password" name="password" id="" placeholder="password" required>
                    <label for="">Password</label>
                </div>
                <!-- <div class="remember-forgot">
                    <a href="#">Forgot Password?</a>
                </div> -->
                <button name="submit" type="submit" class="btn btn-success">Login</button>
                <!-- <p>Belum Punya Akun ?<a class="link-reg"href="register_view.php">Silahkan Register</a></p> -->
                <div class="login-register">
                <p>Belum Punya Akun ?<a href="register_view.php">Silahkan Register</a></p>
                </div>
            </form>
        </div>
    </div>    




    <!-- <form action="controller/login.php" method="POST">
        <P>LOGIN</P>
            <input type="text" name="username" id="" placeholder="username" required>
            <input type="password" name="password" id="" placeholder="password" required>
            <button name="submit" type="submit">Login</button>
            <p>Belum Punya Akun ?<a href="register_view.php">Silahkan Register</a></p>
    </form> -->
</body>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

</html>
<!-- KODE YANG SUDAH BENAR -->

