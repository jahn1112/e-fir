<?php
/**
 * System Verification Script
 * Visit this script in your browser to verify that the fixes have been applied.
 */
include "FIR_project1/DBconfig.php";

echo "<h1>System Verification Status</h1>";

$tables_to_check = ['user_master', 'police_master', 'e_application_table', 'e_fir_master'];
$all_ok = true;

foreach ($tables_to_check as $table) {
    echo "<h3>Checking table: `$table`</h3>";
    $res = mysqli_query($con, "SHOW TABLES LIKE '$table'");
    if (mysqli_num_rows($res) > 0) {
        echo "<p style='color: green;'>✓ Table exists.</p>";
        
        if ($table == 'e_application_table') {
            $col_res = mysqli_query($con, "SHOW COLUMNS FROM `$table` LIKE 'file_name'");
            if (mysqli_num_rows($col_res) > 0) {
                echo "<p style='color: green;'>✓ Column 'file_name' exists.</p>";
            } else {
                echo "<p style='color: red;'>✗ Column 'file_name' is MISSING!</p>";
                $all_ok = false;
            }
        }
        
        $count_res = mysqli_query($con, "SELECT COUNT(*) as cnt FROM `$table`");
        $row = mysqli_fetch_assoc($count_res);
        echo "<p>Rows: " . $row['cnt'] . "</p>";
        
    } else {
        echo "<p style='color: red;'>✗ Table DOES NOT EXIST!</p>";
        $all_ok = false;
    }
    echo "<hr>";
}

if ($all_ok) {
    echo "<h2 style='color: green;'>PERFECT! Everything looks correctly set up.</h2>";
    echo "<p>You should now be able to submit applications and register users without errors.</p>";
    echo "<p><a href='FIR_project1/index.php'>Go to Citizen Portal</a></p>";
} else {
    echo "<h2 style='color: red;'>ISSUES FOUND! Please review the errors above.</h2>";
    echo "<p>Make sure you have correctly imported 'project.sql' and run 'FIR_project1/apply_fix.php'.</p>";
}
?>
