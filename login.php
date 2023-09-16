<?php
session_start();

// Cek apakah pengguna sudah login, jika ya, redirect ke halaman mahasiswa.php
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    header("Location: mahasiswa.php");
    exit;
}

// Cek apakah ada data yang dikirimkan melalui form login
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Username dan password yang valid
    $validUsername = 'admin';
    $validPassword = 'password';

    // Cek apakah username dan password yang dimasukkan sesuai
    if ($username == $validUsername && $password == $validPassword) {
        // Set session dan tandai pengguna sebagai sudah login
        $_SESSION['logged_in'] = true;
        // Redirect ke halaman mahasiswa.php
        header("Location: mahasiswa.php");
        exit();
    } else {
        $error_message = 'Username atau password salah. Silakan coba lagi.';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Aplikasi Data Mahasiswa - Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Aplikasi Data Mahasiswa - Login</h1>

        <?php if (isset($error_message)) { ?>
            <div class="alert alert-danger mt-4"><?php echo $error_message; ?></div>
        <?php } ?>

        <form action="" method="POST" class="mt-4">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
</body>
</html>