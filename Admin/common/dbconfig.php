<?php
// database connection 
try {
    $server = getenv('DB_HOST') ?: "127.0.0.1";
    $username = getenv('DB_USER') ?: "root";
    $pass = getenv('DB_PASS') ?: "";
    $database = getenv('DB_NAME') ?: "project_info";

    $con = mysqli_connect($server, $username, $pass, $database);
    if (!$con) {
        die("CONNECTION NOT ESTABLISHED.." . mysqli_connect_error());
    }
}
catch (\Throwable $th) {
    echo "INTERNAL SERVER ERROR " . mysqli_connect_errno();
    exit();
}