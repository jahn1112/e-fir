<?php
/**
 * Database Schema Fix Script
 * Visit this script in your browser to add the missing 'file_name' column.
 */
include "DBconfig.php";

echo "<h1>Database Schema Fix</h1>";

// Check if the column already exists
$check_query = "SHOW COLUMNS FROM `e_application_table` LIKE 'file_name'";
$check_result = mysqli_query($con, $check_query);

if (mysqli_num_rows($check_result) > 0) {
    echo "<p style='color: green;'><strong>Column 'file_name' already exists in 'e_application_table'. No fix needed.</strong></p>";
} else {
    // Add the column
    $sql = "ALTER TABLE `e_application_table` ADD COLUMN `file_name` LONGTEXT DEFAULT NULL AFTER `action_takenBY`;";
    
    if (mysqli_query($con, $sql)) {
        echo "<p style='color: green;'><strong>SUCCESS!</strong> The 'file_name' column has been added to 'e_application_table'.</p>";
    } else {
        echo "<p style='color: red;'><strong>ERROR:</strong> Could not add column. " . mysqli_error($con) . "</p>";
    }
}

echo "<hr>";
echo "<p><a href='e-application.php'>Click here to return to the E-Application form and try submitting again.</a></p>";
?>
