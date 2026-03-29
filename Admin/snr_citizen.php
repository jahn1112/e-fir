<?php
session_start();
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
    <title>Senior Citizen Registry | Admin</title>
    
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
                            <h1 class="m-0">Senior Citizen Registry</h1>
                        </div>
                    </div>
                </div>
            </div>
            
            <section class="content">
                <div class="container-fluid">

                    <!-- search Panel -->
                    <div class="row mt-2" id="searchpanel">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <i class="fa fa-search"></i> &nbsp; <b>Filter Records</b>
                                </div>
                                <div class="card-body">
                                    <form action="manage_FIR.php" method="post">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Registration ID:</label>
                                                    <input type="text" class="form-control" name="a_id" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <select class="form-control" name="status" required>
                                                        <option selected value="">Select Status</option>
                                                        <option value="In Progress">In Progress</option>
                                                        <option value="Approved">Approved</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12 text-right">
                                                <input type="submit" class="btn btn-primary px-4" name="srch_btn" value="Search">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- list of records -->
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header d-flex align-items-center">
                                    <h3 class="card-title text-bold"><i class="fas fa-user-friends mr-2"></i> Senior Citizen Applications</h3>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered table-hover" id="myTable">
                                        <thead>
                                            <tr>
                                                <th>Sr.No.</th>
                                                <th>Reference No.</th>
                                                <th>Applicant Name</th>                               
                                                <th>Type</th>
                                                <th>DOB</th>
                                                <th>City</th>
                                                <th>Registration Date</th>
                                                <th>Status</th>
                                                <th>Action By</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $qry = "SELECT sc.*,um.user_fname,um.user_lname,um.contact_no,ct.c_name FROM `senior_citizen_reg_table` sc LEFT OUTER JOIN user_master um on sc.user_id=um.user_id LEFT OUTER JOIN city_table ct on ct.city_id=sc.city_id where sc.action_taken in ('Pending','Under Scrutiny',null);";
                                            $res = mysqli_query($con, $qry);
                                            $sr = 0;
                                            while ($row = mysqli_fetch_assoc($res)) {
                                                $sr += 1;
                                                echo '<tr>
                                                     <td>' . $sr . '</td>
                                                     <td class="text-info text-bold"><a href=".\snr_citizen\citizen_info.php?rno=' . $row['sc_reg_id'] . '">SCREG20230' . $row['sc_reg_id'] . '</a></td>
                                                      <td>' . $row['sc_fname'] . ' ' . $row['sc_lname'] . '</td>
                                                      <td>Citizen Registration</td>
                                                      <td>' . $row['dob'] . '</td>
                                                      <td>' . $row['c_name'] . '</td>
                                                      <td>' . $row['reg_date_time'] . '</td>
                                                      <td><span class="badge badge-info">' . ($row['action_taken'] ?? 'New') . '</span></td>
                                                      <td>' . ($row['action_takenBY'] ?? 'Unassigned') . '</td>
                                                </tr>';
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        
        <?php include 'common/_footer.php'; ?>
    </div>

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
            $('#myTable').DataTable({
                "responsive": true,
                "autoWidth": false
            });
        });
    </script>
</body>
</html>