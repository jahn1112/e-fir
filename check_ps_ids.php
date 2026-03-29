<?php
include 'FIR_project1/DBconfig.php';
$res = mysqli_query($con, "SELECT police_station_id FROM police_station_table");
echo "Available Police Station IDs:\n";
while($row = mysqli_fetch_assoc($res)) {
    echo $row['police_station_id'] . "\n";
}
?>
