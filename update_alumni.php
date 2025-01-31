<?php
    session_start();

    
    if (!isset($_SESSION['login'])) {
        if ($_SESSION['login'] != true) {
            header("Location: login.php");
            exit;
        }
    }
    $mysqli = new mysqli('localhost', 'root', '', 'uas_alumni');

    $nim = $_GET['nim_mahasiswa'];
    $alumni = $mysqli->query("SELECT * FROM alumni WHERE nim_mahasiswa='$nim'");
    $data = $alumni->fetch_assoc();

    if (isset($_POST['nama_mahasiswa'])) {
        $nama = $_POST['nama_mahasiwa'];
        $tahun = $_POST['tahun_lulus'];
        $pekerjaan = $_POST['pekerjaan_sekarang'];

        $update = $mysqli->query("UPDATE alumni SET nama_mahasiswa='$nama', tahun_lulus='$tahun', pekerjaan_sekarang='$pekerjaan' WHERE nim_mahasiswa='$nim'");

        if($update) {
            $_SESSION['success'] = true;
            $_SESSION['message'] = 'Data Berhasil Diubah';
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
    <title>Edit Alumni</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>
<body>
    <div class ="container">
    <h1 text-align="center" >From Edit Alumni</h1>
    <form method ="POST">
        <div class ="mb-3">
            <label for="nim_mahasiswa" class="form-label">Nim Mahasiswa</label>
            <input type="text" class="form-control" id="nim_mahasiswa" name="nim_mahasiswa" value="<?= $data['nim_mahasiswa']?>" disabled>
        </div> 
        <div class ="mb-3">
            <label for="nama_mahasiswa" class="form-label">Nama Mahasiswa</label>
            <input type="text" class="form-control" id="nama_mahasiswa" name="nama_mahasiswa" value="<?= $data['nama_mahasiswa']?>">
        </div>
        <div class ="mb-3">
            <label for="tahun_lulus" class="form-label">Tahun Lulus</label>
            <input type="number" class="form-control" id="tahun_lulus" name="tahun_lulus" value="<?= $data['tahun_lulus']?>">
        </div>
        <div class ="mb-3">
            <label for="pekerjaan_sekarang" class="form-label">Pekerjaan Sekarang</label>
            <input type="text" class="form-control" id="pekerjaan_sekarang" name="pekerjaan_sekarang" value="<?= $data['pekerjaan_sekarang']?>">
        </div>
        <div class="mt-3">
                <button type="submit" class="btn btn-primary">Sumbit</button>
                <a href="index.php" class="btn btn-warning">Cancel</a>
         </div>
    </form>
    
</body>
</html>