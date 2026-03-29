<?php
include 'FIR_project1/DBconfig.php';
$res = mysqli_query($con, "SELECT user_name, user_pass FROM user_master LIMIT 1");
while($row = mysqli_fetch_assoc($res)) {
    echo "USER: " . $row['user_name'] . " | PASS: " . $row['user_pass'] . "\n";
}
