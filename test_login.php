<?php
include "FIR_project1/DBconfig.php";

$test_user = "testuser123";
$test_pass = "testuser123"; // I assume this was the plain text based on the name

$qry = "SELECT * FROM `user_master` WHERE `username` = '$test_user'";
$result = mysqli_query($con, $qry);
$row = mysqli_fetch_assoc($result);

echo "User: " . $row['username'] . "\n";
echo "Hash: " . $row['password'] . "\n";
if (password_verify($test_pass, $row['password'])) {
    echo "VERIFICATION SUCCESSFUL\n";
} else {
    echo "VERIFICATION FAILED\n";
}

$test_admin = "parimal123";
$test_admin_pass = "parimal123"; // I assume this was the plain text

$qry2 = "SELECT * FROM `police_master` WHERE `username` = '$test_admin'";
$result2 = mysqli_query($con, $qry2);
$row2 = mysqli_fetch_assoc($result2);

echo "Admin: " . $row2['username'] . "\n";
echo "Hash: " . $row2['password'] . "\n";
if (password_verify($test_admin_pass, $row2['password'])) {
    echo "VERIFICATION SUCCESSFUL\n";
} else {
    echo "VERIFICATION FAILED\n";
}
?>
