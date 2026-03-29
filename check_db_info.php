<?php
include 'FIR_project1/DBconfig.php';
$res = mysqli_query($con, "SELECT police_station_id, police_station_name FROM police_station_table");
echo "Police Stations:\n";
while($row = mysqli_fetch_assoc($res)) {
    print_r($row);
}
$res = mysqli_query($con, "DESC report_missing_person_table");
echo "\nMissing Person Table Schema:\n";
while($row = mysqli_fetch_assoc($res)) {
    print_r($row);
}
?>
