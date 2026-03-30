<?php
include "common/dbconfig.php";

$username = 'admin';
$password = 'admin';
$hashed = password_hash($password, PASSWORD_DEFAULT);
$name = 'Super Admin';
$designation = 'Administrator';

// 1. Delete everything with username 'admin' to clear any confusion
mysqli_query($con, "DELETE FROM police_master WHERE username = 'admin'");

// 2. Insert one fresh account
$sql = "INSERT INTO police_master (p_name, p_dob, p_contact, p_email, username, password, designation) 
        VALUES ('$name', '1990-01-01', '0000000000', 'admin@gujaratpolice.gov.in', '$username', '$hashed', '$designation')";

if (mysqli_query($con, $sql)) {
    echo "SUCCESS: Fresh Admin account created.\n";
    echo "Username: $username\nPassword: $password\nDesignation: $designation\n";
} else {
    echo "ERROR: " . mysqli_error($con) . "\n";
}
?>