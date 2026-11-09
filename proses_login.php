<?php
session_start();
include 'config/koneksi.php';
if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = md5($_POST['password']);
    $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");
    if (mysqli_num_rows($query) > 0) {
        $_SESSION['user'] = $username;
        if (isset($_POST['remember'])) {
            setcookie('remember_user', $username, time() + 3600, "/");
        } else {
            setcookie('remember_user', '', time() - 3600, "/");
        }
        header("Location: dashboard.php");
        exit;
    } else {
        echo "<script>alert('Username atau Password salah!'); window.location='index.php';</script>";
    }
}
?>