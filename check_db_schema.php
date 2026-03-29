<?php
include 'FIR_project1/DBconfig.php';
function check($con, $table) {
    echo "\nTable: $table\n";
    $res = mysqli_query($con, "DESC $table");
    while($row = mysqli_fetch_assoc($res)) {
        printf("%-30s | %-15s | %s | %s | %s\n", $row['Field'], $row['Type'], $row['Null'], $row['Default'], $row['Extra']);
    }
}
check($con, 'e_fir_master');
check($con, 'e_application_table');
