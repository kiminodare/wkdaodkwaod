<?php
    class LogActivity
    {
         
   public function InsertHistory($ip,$date,$history,$koneksi)
    {
        $koneksi = mysqli_connect("localhost","checker_kiminodare","YPs)a+e.aU+z","checker_wibu");
        $sql = "INSERT INTO log_activity (ip, date, history)
        VALUES ('$ip', '$date', '$history')";
        mysqli_query($koneksi, $sql);
    }
    }
   
