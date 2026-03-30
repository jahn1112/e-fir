<?php
include "common/dbconfig.php";

$username = 'admin';
$password = 'admin123';
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
$name = 'Super Admin';
$dob = '1990-01-01';
$contact = '0000000000';
$email = 'admin@gujaratpolice.gov.in';
$designation = 'Administrator';

// Check if user already exists
$check_sql = "SELECT username FROM police_master WHERE username = '$username'";
$check_res = mysqli_query($con, $check_sql);

if (mysqli_num_rows($check_res) > 0) {
    $sql = "UPDATE police_master SET password = '$hashed_password', p_name = '$name', designation = '$designation' WHERE username = '$username'";
    $msg = "Admin account updated successfully.";
} else {
    $sql = "INSERT INTO police_master (p_name, p_dob, p_contact, p_email, username, password, designation) 
            VALUES ('$name', '$dob', '$contact', '$email', '$username', '$hashed_password', '$designation')";
    $msg = "Admin account created successfully.";
}

if (mysqli_query($con, $sql)) {
    echo $msg . "\nUsername: $username\nPassword: $password\nHash Length: " . strlen($hashed_password) . "\n";
} else {
    echo "Error: " . mysqli_error($con) . "\n";
}
?>
