<?php
// Admin/common/dbconfig.php - Enable detailed error reporting for development
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $server = "localhost";
    $username = "root";
    $pass = "";
    $database = "project_info";

    $con = mysqli_connect($server, $username, $pass, $database);
    if (!$con) {
        die("CONNECTION NOT ESTABLISHED.." . mysqli_connect_error());
    }
} catch (\Throwable $th) {
    if (strpos($th->getMessage(), "Unknown database") !== false) {
        die("<h2>Database Error</h2><p>The database 'project_info' was not found. Please import 'project.sql' into your MySQL server.</p>");
    }
    die("<h2>INTERNAL SERVER ERROR</h2><p>" . $th->getMessage() . "</p>");
}
?>
