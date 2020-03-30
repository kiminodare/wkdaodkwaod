<?php

/* database connection */

if (ENVIRONMENT == 'development') {
    define('DBUSER', '%localhost-user%');
    define('DBPASS', '%localhost-pass%');
    define('DBHOST', '%localhost-host%');
    define('DBNAME', '%localhost-name%');
} else {
    define('DBUSER', 'checker_kiminodare');
    define('DBPASS', 'YPs)a+e.aU+z');
    define('DBHOST', 'localhost');
    define('DBNAME', 'checker_wibu');
}
define('DB', 'mysql:host=' . DBHOST . ';dbname=' . DBNAME);
