<?php
include 'curl.php';
include 'test.php';
include 'middleware/session.php';
include 'Log_activity/log.php';


$log = new LogActivity();
$api_curl = new gate();
$session = new Checksession();
$query = "SELECT * FROM user'";
$hoho =@mysqli_query($koneksi,$query);
$row = mysqli_fetch_assoc($result);
$id = $_SESSION['id'];
$username = $_SESSION['username'];
if($session->CheckSession()){

if ($_SESSION['credit'] != 0) {
    $post_cc = $_POST['cc'];
    $gate =  $_POST['gate_checker'];
    $results = [];
    $die = [];
    $cc = explode(PHP_EOL, $post_cc);
    foreach ($cc as $key => $d) {
        $isi = str_replace(' ', '', $d);
        $delimeter = "/";
        $anu = explode($delimeter, $d);
        $cc = $anu[0];
        $month = $anu[1];
        $year = substr($anu[2], -4);
        $cvv = $anu[3];
        $bin = $api_curl->bin_curl($cc);
        if ($gate == "gate2") {
            $check = $api_curl->gate_1usd($cc, $month, $year, $cvv, $d,$bin);
            // print_r($check);
        }elseif ($gate == "gate3") {
            $check = $api_curl->gate_no_charge($cc, $month, $year, $cvv, $d,$bin);
        }
        if ($check['status_check']) {
            $a = $row['credit']; -2;
            $query = "UPDATE user SET credit='$a' WHERE id='$id'";
            $sql = "INSERT INTO log_activity (ip, date, history)
            VALUES ('$ip', '$date', '$history')";
            mysqli_query($koneksi,$sql);
            $date = date('Y-m-d H:i:s');
            $ip = $_SERVER['REMOTE_ADDR'];
            $history = "Cre Live digunakan $username";
            $log->InsertHistory($ip,$date,$history,$koneksi);
            array_push($results, $check);
        } else {
            $a = $row['credit']; -1;
            $query = "UPDATE user SET credit='$a' WHERE id='$id'";
            $sql = "INSERT INTO log_activity (ip, date, history)
            VALUES ('$ip', '$date', '$history')";
            mysqli_query($koneksi,$sql);
            $date = date('Y-m-d H:i:s');
            $ip = $_SERVER['REMOTE_ADDR'];
            $history = "Cre Die digunakan $username";
            $log->InsertHistory($ip,$date,$history,$koneksi);
            array_push($die, $check);
        }
    }
    mysqli_query($koneksi, $query);
    $array = ["live" => $results, "die" => $die];
    echo json_encode($array);
}else{
    $array = ["error" => true, "msg" => "Token Tidak cukup"];

    echo json_encode($array);
}

}

