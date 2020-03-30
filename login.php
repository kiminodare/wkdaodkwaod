<?php 
session_start();
include 'test.php';
include 'Log_activity/log.php';

$username = $_POST['username'];
$password = $_POST['password'];
$query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
$result =@mysqli_query($koneksi,$query);
$cek = mysqli_num_rows($result);
$row = mysqli_fetch_assoc($result);
if($cek > 0){
    $log = new LogActivity();
    $_SESSION['is_login'] = true;
    $_SESSION['credit'] = $row['credit'];
    $_SESSION['username'] = $row['username'];
    $_SESSION['id'] = $row['id'];
    $date = date('Y-m-d H:i:s');
    $ip = $_SERVER['REMOTE_ADDR'];
    $history = "Login Sukses dari $username";
    $log->InsertHistory($ip,$date,$history,$koneksi);
	header("location: /checker.php");
}else{
    header("location: /index.php");
}
?>