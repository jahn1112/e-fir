<?php
session_start();
include '.\common\dbconfig.php';

//print_r($_SESSION);

if ($_SESSION["lg"] == false) {
    header("location:login.php");
}
include "manage_FIR/search.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Senior Citizen</title>
    <!-- website logo -->
    <link rel="icon" href="img\weblogo1.ico" type="image/icon">
    <!-- css -->
    <style type="text/css">
        #compulsory {
            color: red;
            font-weight: bold;
        }

        #searchpanel {
            display: none;
        }
    </style>

    <!-- bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <!-- font-awasome icon -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">

    <!-- datatable css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">

    <!-- css file import -->
    <link rel="stylesheet" href="css\nav1.css">

    <!-- jquery CDN Path -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script>
        // show search panel when clicked
        $(document).ready(function() {
            $('#srchbtn').click(function() {
                $('#searchpanel').toggle();
            });


        });
    </script>


</head>

<body style="background-color:rgb(217, 216, 216);">
    <!-- Image and text -->
    <div class="container-fluid">

        <!-- navbar -->
        <div class="row">
            <div class="col-md-12">
                <nav class="navbar navbar-expand-lg navbar-light bg-light mt-2 d-print-none">
                    <a class="navbar-brand" href="">
                        <img src="img\snr_citizen.png" width="30" height="30" class="d-inline-block align-top" alt="FIR_Service_LOGO">
                        <b>Dashboard - Senior Citizen</b>
                    </a>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="Contact.php">Contact</a>
                            </li>

                            <!-- <li class="nav-item">
                                <a class="nav-link active" aria-current="page" id="srchbtn" href="#"><i class="fa fa-search" aria-hidden="true"></i>
                                    Search by Date</a>
                            </li> -->

                        </ul>
                        <i class="fa fa-clock" aria-hidden="true">&nbsp;</i>
                        <span class="mr-2" id="clock"></span>
                        |
                        <i class="fa fa-calendar ml-3" aria-hidden="true"> &nbsp;</i>
                        <span class=" mr-2" id="Date"></span>

                    </div>
                </nav>
            </div>
        </div>

        <!--  search Panel  -->
        <div class="row mt-2" id="searchpanel">
            <div class="col-md-12">
                <div class=" d-print-none">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-search" aria-hidden="true"></i> &nbsp; <b>Search Records</b>
                        </div>
                        <div class="container-fuild card-body">
                            <form action="manage_FIR.php" method="post">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="aid">Application Id:<span id="compulsory">*</span></label>
                                            <input type="text" id="aid" class="form-control" name="a_id" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="status">Status<span id="compulsory">*</span></label>
                                            <select class="form-control" id="status" name="status" required>
                                                <option selected value="">Select Status</option>
                                                <option value="In Progress">In Progress</option>
                                                <option value="Assign Investing Officer">Assign Investing Officer</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="FromDate">From Date</label>
                                            <input type="date" id="FromDate" class="form-control" name="fdt" ">
                                    </div>
                                </div>
                                <div class=" col-md-6">
                                            <div class="form-group">
                                                <label for="ToDate">To Date</label>
                                                <input type="date" id="ToDate" class="form-control" name="tdt">
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div class="form-group">

                                                <input type="submit" class="btn btn-outline-primary form-control" name="srch_btn" id="srch_btn">
                                            </div>
                                        </div>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- list of records -->
        <div class="row mt-3">
            <div class="col-md-12 ">
                <div class="card">
                    <div class="card-header">
                        <b style="font-size: xx-large;">Records - Senior citizen registration</b>
                    </div>
                    <div class="card-body">

                        <table class="table  table-bordered table-hover" id="myTable">
                            <thead>
                                <tr>
                                    <th scope="col">Sr.No.</th>
                                    <th scope="col">Reference No.</th>
                                    <th scope="col">Applicant Name</th>                               
                                    <th scope="col">Type</th>
                                    <th scope="col">DOB</th>
                                    <th scope="col">City</th>
                                    <th scope="col">Registration Date</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action Taken By</th>



                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                 
                              
 
                                 $qry = "SELECT sc.*,um.user_fname,um.user_lname,um.contact_no,ct.c_name FROM `senior_citizen_reg_table` sc LEFT OUTER JOIN user_master um on sc.user_id=um.user_id LEFT OUTER JOIN city_table ct on ct.city_id=sc.city_id where sc.action_taken in ('Pending','Under Scrutiny',null);";
                                 $res = mysqli_query($con,$qry);
                                 $sr = 0;
                                 while($row = mysqli_fetch_assoc($res))
                                 {
                                     $sr += 1;
                                     echo '<tr>
                                         <th scope="row">' . $sr. '</th>
                                         <td><a href=".\snr_citizen\citizen_info.php?rno='. $row['sc_reg_id']. '">SCREG20230'. $row['sc_reg_id']. '</a></td>
 
                                          <td>' . $row['sc_fname'].' '.$row['sc_lname'].'</td>
                                          <td>Citizen Registration</td>
                                          <td>'. $row['dob']. '</td>
                                          <td>'. $row['c_name']. '</td>
                                          <td>'. $row['reg_date_time']. '</td>
                                          <td>'. $row['action_taken']. '</td>
                                          <td>'. $row['action_takenBY']. '</td>
                                        </tr>';
                                 }
 
                                 



                                // for ($i = 0; $i <= 100; $i++) {
                                //     echo '<tr>
                                //         <th scope="row">' . $i + 1 . '</th>
                                //         <td>Mark</td>
                                //         <td>snr citizen registration</td>
                                //         <td>rajkot</td>
                                //         <td><a href=".\snr_citizen\citizen_info.php?rno=878997">878337</a></td>
                                //         <td>12/12/2022</td>
                                //         <td>12/12/1871</td>
                                //         <td>In Progress</td>
                                //       </tr>';
                                // }

                                ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>

        <!-- footer div  -->
        <div class="mt-2 mb-1">
            <footer>
                <div class="text-center p-3" style="background-color:#8d9f8d;">
                    <strong>Copyright &copy; Home Department | 2022-2023<a href="https://gujhome.gujarat.gov.in/portal/webHP?requestType=ApplicationRH&actionVal=privacyTerms&screenId=115">
                            All Rights Reserved</a>.</strong>
                    All rights reserved.
                    <div class="float-right d-none d-sm-inline-block">

                    </div>
                </div>
            </footer>
        </div>

    </div>
    </div>


    <!-- toggole js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <script src="common/time.js"></script>
    <script src="common/date.js"></script>


    <!-- datatable js/jquery file -->
    <script src="common\myJS\jquery.min.js"></script>
    <script type="text/javascript" charset="utf8" src="common\myJS\jquery.datatables.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>


</body>

</html>