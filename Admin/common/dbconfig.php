<?php
// database connection 
try {
    $server = "localhost";
    $username = "root";
    $pass = "";
    $database = "project_info";

    $con = mysqli_connect($server, $username, $pass, $database,3307);
    if (!$con) {
        die("CONNECTION NOT ESTABLISHED.." . mysqli_connect_error());
    }
} catch (\Throwable $th) {
    echo "INTERNAL SERVER ERROR " . mysqli_connect_errno();
}
