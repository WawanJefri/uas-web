<?php
session_start();


$mysqli = new mysqli('localhost', 'root', '', 'uas_alumni');


if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}


if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $mysqli->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    
    if ($mysqli->query("INSERT INTO users (email, password) VALUES ('$email', '$hashedPassword')")) {
        
        header("Location: login.php"); 
        exit; 
    } else {
        echo "Error: " . $mysqli->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="position-absolute top-50 start-50 translate-middle w-75">
        <div class="card p-5 bg-light">
            <h1 class="text-center">Pendaftaran</h1>
            <form method="POST">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary">Daftar</button>
            </form>
            <div class="mb-3">
                <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
            </div>
        </div>
    </div>
</body>

</html>