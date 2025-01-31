<?php
session_start();

if (isset($_COOKIE['remember']) && $_COOKIE['remember'] == 'true') {
    $_SESSION['login'] = true;
}

if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
    header("Location: index.php");
    exit;
}

$mysqli = new mysqli('localhost', 'root', '', 'uas_alumni');

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $mysqli->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    $result = $mysqli->query("SELECT * FROM users WHERE email='$email'");

    if ($result->num_rows == 0) {
        echo "Email tidak terdaftar!";
        exit;
    }

    $user = $result->fetch_assoc();

    if (!password_verify($password, $user['password'])) {
        echo "Password salah!";
        exit;
    }

    if (isset($_POST['remember'])) {
        setcookie('remember', 'true', time() + (86400 * 30)); // 30 hari untuk set cookie
    }
    $_SESSION['login'] = true;
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="position-absolute top-50 start-50 translate-middle w-75">
        <div class="card p-5 bg-light">
            <h1 class="text-center">Login</h1>
            <form method="POST">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password" required>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1" name="remember">
                    <label class="form-check-label" for="exampleCheck1">Remember me</label>
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
        </div>
    </div>
</body>

</html>