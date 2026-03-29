<?php
include 'FIR_project1/DBconfig.php';
$res = mysqli_query($con, "DESC user_master");
while($row = mysqli_fetch_assoc($res)) {
    printf("%-30s | %-15s | %s | %s | %s\n", $row['Field'], $row['Type'], $row['Null'], $row['Default'], $row['Extra']);
}
echo "---\n";
$res = mysqli_query($con, "SELECT * FROM user_master LIMIT 1");
while($row = mysqli_fetch_assoc($res)) {
    print_r($row);
}
