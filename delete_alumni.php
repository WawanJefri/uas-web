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
    $delete = $mysqli->query("DELETE  FROM alumni WHERE nim_mahasiswa='$nim'");

    if($delete) {
        $_SESSION['success'] = true;
        $_SESSION['message'] = 'Data Berhasil Dihapus';
        header("Location: index.php");
        exit();
    }