<?php
include 'test.php';
session_start();
include 'Log_activity/log.php';

$username = $_POST['username'];
$password = $_POST['password'];
$query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
$result =@mysqli_query($koneksi,$query);
$cek = mysqli_num_rows($result);
$row = mysqli_fetch_assoc($result);
if($row > 0){
    header("HTTP/1.0 404 Not Found");
} else {
    $log = new LogActivity();
    $sql = "INSERT INTO user (username, password)
    VALUES ('$username', '$password')";
    mysqli_query($koneksi,$sql);
    $date = date('Y-m-d H:i:s');
    $ip = $_SERVER['REMOTE_ADDR'];
    $history = "Orang daftar menggunakan $username";
    $log->InsertHistory($ip,$date,$history,$koneksi);
    header("location:index.php");
}
?>