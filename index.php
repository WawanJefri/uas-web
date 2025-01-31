<?php
session_start();

if (!isset($_SESSION['login'])) {
    if ($_SESSION['login'] != true) {
        header("Location: login.php");
        exit;
    }
}

$mysqli = new mysqli('localhost', 'root', '', 'uas_alumni');
$result = $mysqli->query("SELECT * FROM alumni");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Alumni</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1 class="text-center">Data Alumni</h1>
        
        <?php if (isset($_SESSION['success']) && $_SESSION['success'] == true) { ?>
            <div class="alert alert-success" role="alert">
                <?= $_SESSION['message'] ?>
            </div>
        <?php } ?>

        <div class="mb-3">
            <a href="create_alumni.php" class="btn btn-primary">Tambah Alumni</a>
            <a href="logout.php" class="btn btn-warning">Logout</a>
        </div>

        <table class="table table-bordered table-hover">
            <tr>
                <th>No</th>
                <th>Nim Mahasiswa</th>
                <th>Nama Mahasiswa</th>
                <th>Tahun Lulus</th>
                <th>Pekerjaan Sekarang</th>
                <th>Aksi</th>
            </tr>
            <?php
                $no = 1;
                while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row['nim_mahasiswa'] ?></td>
                    <td><?= $row['nama_mahasiswa'] ?></td>
                    <td><?= $row['tahun_lulus'] ?></td>
                    <td><?= $row['pekerjaan_sekarang'] ?></td>
                    <td>
                        <a href="update_alumni.php?nim_mahasiswa=<?= $row['nim_mahasiswa'] ?>" class="btn btn-success">Update</a>
                        <a href="delete_alumni.php?nim_mahasiswa=<?= $row['nim_mahasiswa'] ?>" class="btn btn-danger"
                            onclick="return confirm('Apakah Anda yakin akan menghapus data ini?');">Hapus</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>

<?php

// session_unset();
unset($_SESSION['success']);
unset($_SESSION['message']);

?>