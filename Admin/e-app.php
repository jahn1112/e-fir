<?php
session_start();
//print_r($_SESSION);
include '.\common\dbconfig.php';
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
    <title>E-Applications | Admin</title>
    
    <link rel="icon" href="img\weblogo1.ico" type="image/icon">
    <!-- Google Font: Outfit & Poppins -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700&display=swap">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Theme foundations -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- datatable css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
    <!-- Modern Admin Style Overrides -->
    <link rel="stylesheet" href="css/admin_glass.css">

    <style>
        .content-wrapper { background: transparent !important; padding: 20px; }
        .card { border-radius: 15px; overflow: hidden; }
        #searchpanel { display: none; }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <?php include 'common/_navbar.php'; ?>
        
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">E-Application Services</h1>
                        </div>
                    </div>
                </div>
            </div>
            
            <section class="content">
                <div class="container-fluid">

           <!-- search Panel  -->
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
                        <b style="font-size: xx-large;">List of Applications</b>
                    </div>
                    <div class="card-body">

                        <table class="table  table-bordered table-hover" id="myTable">
                            <thead>
                                <tr>
                                    <th scope="col">Sr.No.</th>
                                    <th scope="col">Reference No.</th>
                                    <th scope="col">Applicant Name</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Gender</th>
                                    <th scope="col">Request Date & Time</th>
                                    <th scope="col">DOB</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action taken By</th>


                                </tr>
                            </thead>
                            <tbody>

                                <?php
// for ($i = 0; $i <= 100; $i++) {
//     echo '<tr>
//         <th scope="row">' . $i + 1 . '</th>
//         <td>Mark</td>
//         <td>e-Application</td>
//         <td><a href=".\e-app\e-app_info.php?rno=878997">878337</a></td>
//         <td>12/12/2022</td>
//         <td>In Progress</td>
//       </tr>';
// }



$qry = "SELECT * FROM `e_application_table` e join user_master u WHERE e.user_id = u.user_id and e.action_taken in ('Pending','Under Scrutiny',null);";
$res = mysqli_query($con, $qry);
$sr = 0;
while ($row = mysqli_fetch_assoc($res)) {
    $sr += 1;
    echo '<tr>
                                        <th scope="row">' . $sr . '</th>
                                        <td><a href=".\e-app\e-app_info.php?rno=' . $row['e_application_id'] . '">GJEAPP202300' . $row['e_application_id'] . '</a></td>

                                         <td>' . $row['user_fname'] . ' ' . $row['user_lname'] . '</td>
                                         <td>' . $row['application_type'] . '</td>
                                         <td>' . $row['gender'] . '</td>
                                         <td>' . $row['sbmt_date'] . '</td>
                                         <td>' . $row['user_dob'] . '</td>
                                         <td>' . $row['action_taken'] . '</td>
                                         <td>' . $row['action_takenBY'] . '</td>
                                       </tr>';
}


?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>

            </section>
        </div><!-- /.content-wrapper -->
        
        <?php include 'common/_footer.php'; ?>
    </div><!-- ./wrapper -->

    <!-- jQuery & Bootstrap -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.js"></script>
    <script src="common/time.js"></script>
    <script src="common/date.js"></script>
    <!-- Datatables -->
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
</body>

</html>