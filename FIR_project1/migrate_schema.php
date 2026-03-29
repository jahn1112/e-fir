<?php
include "DBconfig.php";

$queries = [
    "ALTER TABLE report_missing_person_table MODIFY religion_id INT(5) NULL",
    "ALTER TABLE report_missing_person_table MODIFY document_id INT(5) NULL",
    "ALTER TABLE senior_citizen_reg_table MODIFY document_id INT(5) NULL"
];

foreach ($queries as $query) {
    if (mysqli_query($con, $query)) {
        echo "Successfully executed: $query<br>";
    } else {
        echo "Error executing $query: " . mysqli_error($con) . "<br>";
    }
}
?>
