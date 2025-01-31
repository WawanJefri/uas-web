<?php
session_start();

if (!isset($_SESSION['login'])) {
    if ($_SESSION['login'] != true) {
        header("Location: login.php");
        exit;
    }
}

$mysqli = new mysqli('localhost', 'root', '', 'uas_alumni');

if (isset($_POST['nim_mahasiswa']) && isset($_POST['nama_mahasiswa'])) {
    $nim = $_POST['nim_mahasiswa'];
    $nama = $_POST['nama_mahasiswa'];
    $tahun = $_POST['tahun_lulus'];
    $pekerjaan = $_POST['pekerjaan_sekarang'];

    $insert = $mysqli->query("INSERT INTO alumni (nim_mahasiswa, nama_mahasiswa, tahun_lulus, pekerjaan_sekarang) 
                                VALUES('$nim', '$nama', '$tahun', '$pekerjaan')");
    if ($insert) {
        $_SESSION['success'] = true;
        $_SESSION['message'] = 'Data berhasil ditambahkan!';
        header("Location: index.php");
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Alumni</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1 class="text-center">Form Tambah Alumni</h1>
        <form method="POST">
            <div class="mb-3">
                <label for="nim_mahasiswa" class="form-label">Nim Mahasiwa</label>
                <input type="text" class="form-control" id="nim_mahasiswa" name="nim_mahasiswa">
            </div>
            <div class="mb-3">
                <label for="nama_mahasiswa" class="form-label">Nama Mahasiswa</label>
                <input type="text" class="form-control" id="nama_mahasiswa" name="nama_mahasiswa">
            </div>
            <div class="mb-3">
                <label for="tahun_lulus" class="form-label">Tahun Lulus</label>
                <input type="number" class="form-control" id="tahun_lulus" name="tahun_lulus">
            </div>
            <div class="mb-3">
                <label for="pekerjaan_sekarang" class="form-label">Pekerjaan Sekarang</label>
                <input type="text" class="form-control" id="pekerjaan_sekarang" name="pekerjaan_sekarang">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="index.php" class="btn btn-warning">Kembali</a>
        </form>
    </div>
</body>
</html>