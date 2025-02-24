<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body class="bg-light d-flex justify-content-center align-items-center min-vh-100">

    <div class="container bg-info-subtle p-4 rounded shadow-sm" style="max-width: 500px;">
        <h1 class="text-center mb-4">Halaman Register</h1>

        <form action="controller/registerCont.php" method="POST">
            <div class="mb-3">
                <label for="NamaLengkap" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" name="NamaLengkap" id="NamaLengkap" required>
            </div>

            <div class="mb-3">
                <label for="Username" class="form-label">Username</label>
                <input type="text" class="form-control" name="Username" id="Username" required>
            </div>

            <div class="mb-3">
                <label for="Password" class="form-label">Password</label>
                <input type="password" class="form-control" name="Password" id="Password" required>
            </div>

            <div class="mb-3">
                <label for="Email" class="form-label">Email</label>
                <input type="email" class="form-control" name="Email" id="Email" required>
            </div>

            <div class="mb-3">
                <label for="Alamat" class="form-label">Alamat</label>
                <textarea class="form-control" name="Alamat" id="Alamat" required></textarea>
            </div>

            

            <button type="submit" name="submit" class="btn btn-success w-100">Daftar</button>

            <p class="mt-3 text-center">
                <a href="loginView.php" class="text-success">Punya Akun?</a>
            </p>
        </form>
        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0L1eY6z1b7D2xu9OJo5joFSH91RScQJ37A6gktk5xjyhGJX6" crossorigin="anonymous"></script>
</body>
</html>
