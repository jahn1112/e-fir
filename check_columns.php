<?php
include "c:/Users/Asus/Desktop/e-fir/FIR_project1/DBconfig.php";

$query = "DESCRIBE e_application_table";
$result = mysqli_query($con, $query);

if ($result) {
    echo "Columns in e_application_table:\n";
    while ($row = mysqli_fetch_array($result)) {
        echo "- " . $row[0] . "\n";
    }
} else {
    echo "Error describing table: " . mysqli_error($con);
}
?>
