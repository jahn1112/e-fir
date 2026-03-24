<?php

// search form logic
// -------------
$result="aaa";
if (isset($_POST['srch_btn'])) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $fdt = $_POST['fdt'];
        $tdt = $_POST['tdt'];
        $aid = $_POST['a_id'];
        $statuss = $_POST['status'];

        echo 'Application id ->' . $aid . ' </br> date : ' . $fdt . ' To ' . $tdt . '</br> And STATUS IS -> ' . $statuss;
    } else {
        echo '<script>alert("ny thtu");</script>';
    }
} 

?>