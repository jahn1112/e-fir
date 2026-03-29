<?php
// add db config file
include 'common/dbconfig.php';


function registration($con)
{
    $qry = "SELECT COUNT(*) as Total_Registraion FROM user_master;";
    $res = mysqli_query($con , $qry);
    if($res)
    {
        while($ress = mysqli_fetch_assoc($res))
        {
            echo $ress['Total_Registraion'];      
        }
    }
}

function e_application($con)
{
    $qry = "SELECT COUNT(*) as total_application FROM e_application_table;";
    $res = mysqli_query($con , $qry);
    if($res)
    {
        while($ress = mysqli_fetch_assoc($res))
        {
            echo $ress['total_application'];      
        }
    }
}

function rpt_missing_person($con)
{
    $qry = "SELECT COUNT(*) as total_report FROM report_missing_person_table;";
    $res = mysqli_query($con , $qry);
    if($res)
    {
        while($ress = mysqli_fetch_assoc($res))
        {
            echo $ress["total_report"];      
        }
    }
}

function E_FIR($con)
{
    $qry = "SELECT COUNT(*) as total_FIRs FROM e_fir_master;";
    $res = mysqli_query($con , $qry);
    if($res)
    {
        while($ress = mysqli_fetch_assoc($res))
        {
            echo $ress["total_FIRs"];      
        }
    }
}



?>