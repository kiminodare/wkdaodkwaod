<?php 
 
$koneksi = mysqli_connect("localhost","root","","cheker_ku");
 
// Check connection
// if (mysqli_connect_errno()){
// 	echo "Koneksi database gagal : " . mysqli_connect_error();
// } else {
//     echo "sukses";
// }

// $sql = "INSERT INTO log_activity (ip, date, history,id_user)
//         VALUES ('118.120.120.112', '29 Maret 2020', 'TESTING','1')";

// if (!mysqli_query($koneksi,"INSERT INTO log_activity (ip, date, history,id_user)
//         VALUES ('118.120.120.112', '29 Maret 2020', 'TESTING','1')")) {
//   echo("Error description: " . mysqli_error($koneksi));
// }

?>