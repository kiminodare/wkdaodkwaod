<?php
$date = date("d-m-y h:i:s");
include 'test.php';
$data ="token=hijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZd78s&credits=90&username=audy123&id_user=1&date=$date";
$ip = getUserIpAddr();
$randstring = generateRandomString();
$encrypt  = "$randstring A/n*!&$&*@#!#*(_$randstring***=".base64_encode($data).'decR1pt'."13!$#!$%^&**4/$randstring";
$check =  check_credential(decrypt($encrypt),$koneksi,$ip);
if ($check == "Valid") {
    echo  insert_data(decrypt($encrypt),$koneksi); 
}else{
    echo $check;
}

function getUserIpAddr(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        //ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        //ip pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
function generateRandomString($length = 10) {
$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZd78sa3-123129302193-01283maskd!@#$(*@!()#*)!@($*@!)$*!@)($#)(*%}{}|';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function decrypt($data)
{
    return base64_decode(substr(substr($data,41),0,-31));
}

function insert_data($string,$koneksi)
{
    parse_str($string,$output);
    $id = $output['id_user'];
    $date = $output['date'];
    $credit = $output['credits'];
    $sql = "UPDATE user SET credit='$credit' WHERE id=$id";
    $result =mysqli_query($koneksi,$sql);

    $sql = "INSERT INTO last_toup (id_user, date,credits)
    VALUES ('$id', '$date','$credit')";
    mysqli_query($koneksi,$sql);
    return "success Top Up" ;
}

function check_credential($data,$koneksi,$ip)
{
    parse_str($data,$output);
    $username = $output['username'];
    $token = $output['token'];
    $query = "SELECT * FROM admin WHERE username='$username' AND token='$token'";
    $result = mysqli_query($koneksi,$query);
    $cek = mysqli_num_rows($result);
    if($cek > 0){
    $row = mysqli_fetch_assoc($result);
    if($row['ip'] == $ip){
        return "Valid";
    }else{
        return $ip ." This  Ip Not Registed";
    }
    }else{
        return "Your Token IS Not valid";
    }
}