<?php
// Mock the login process for PSO
$con = mysqli_connect("localhost", "root", "", "project_info");

$username = "arpit123";
$pass = "arpit123";
$cat = "Police Station Officer";

$qry = "SELECT * FROM `police_master` WHERE `username` = '$username'";
$result = mysqli_query($con, $qry);
$row = mysqli_fetch_assoc($result);

echo "DB Designation: [" . $row['designation'] . "]\n";
echo "Selected Cat: [" . $cat . "]\n";

if ($pass == $row['password']) {
    echo "Password Match: SUCCESS\n";
    if ($cat == $row['designation']) {
        echo "Category Match: SUCCESS\n";
    } else {
        echo "Category Match: FAILED\n";
    }
} else {
    echo "Password Match: FAILED\n";
}
?>
