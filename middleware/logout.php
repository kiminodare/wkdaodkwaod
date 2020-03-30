<?php
session_start();
$_SESSION['is_login'] = false;
header('location:../index.php');