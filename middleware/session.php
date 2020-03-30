<?php
error_reporting(0);
class Checksession
{
    public function CheckSession()
    {
        session_start();

        $is_login = $_SESSION['is_login'];
        if ($is_login) {
            return true;
        } else {
            header('location: https://wibu-checker.com/');
        }

    }
}
