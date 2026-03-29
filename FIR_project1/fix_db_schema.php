<?php
include "DBconfig.php";

$sql = "ALTER TABLE `e_application_table` ADD COLUMN `file_name` LONGTEXT DEFAULT NULL AFTER `action_takenBY`;";

if (mysqli_query($con, $sql)) {
    echo "<h1>Success!</h1>";
    echo "<p>The 'file_name' column has been added to 'e_application_table'.</p>";
    echo "<p><a href='e-application.php'>Click here to return to e-Application form.</a></p>";
} else {
    echo "<h1>Error</h1>";
    echo "<p>" . mysqli_error($con) . "</p>";
}
?>
