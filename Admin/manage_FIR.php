<?php
session_start();
//print_r($_SESSION);
include 'common/dbconfig.php';
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
    <title>Manage F.I.R | Admin</title>
    
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

    <style type="text/css">
        #compulsory { color: #ef4444; font-weight: bold; }
        #searchpanel { display: none; }
        .content-wrapper { background: transparent !important; }
    </style>

    <!-- jquery CDN Path -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#srchbtn').click(function() {
                $('#searchpanel').toggle();
            });
        });
    </script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Import all Navbar -->
        <?php include "common/_navbar.php"; ?>

        <!-- Content Wrapper -->
        <div class="content-wrapper p-4">
            <!-- list of records -->
            <div class="container-fluid">
                <div class="row mt-3">
                    <div class="col-md-12 ">
                        <div class="card">
                            <div class="card-header border-0">
                                <h2 class="card-title font-weight-bold" style="font-size: 1.8rem;">List of Complaints</h2>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover" id="myTable">
                                        <thead>
                                            <tr>
                                                <th>Sr.No.</th>
                                                <th>Reference No.</th>
                                                <th>Applicant Name</th>
                                                <th>Type of FIR</th>
                                                <th>Gender</th>
                                                <th>Occupation</th>
                                                <th>Submitted</th>
                                                <th>Occurence From</th>
                                                <th>Occurence To</th>
                                                <th>Status</th>
                                                <th>Handled By</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $typ = $_GET['typ'];
                                            if (isset($typ) && $typ == 'A') {
                                                $qry = "SELECT efm.e_fir_id,efm.sbmt_date,efm.action_taken,efm.action_takenBY,um.gender,efm.occupation,um.user_fname,um.user_lname,typ.fir_type, efm.occurence_of_offence_date_from,efm.occurence_of_offence_date_to from e_fir_master as efm LEFT OUTER JOIN user_master um on efm.user_id=um.user_id LEFT OUTER JOIN types_of_fir_table typ on efm.types_of_fir_id=typ.types_of_FIR_id where efm.action_taken LIKE 'Assign to%';";
                                            } else if (isset($typ) && $typ == 'P') {
                                                $qry = "SELECT efm.e_fir_id,efm.sbmt_date,efm.action_taken,efm.action_takenBY,um.gender,efm.occupation,um.user_fname,um.user_lname,typ.fir_type, efm.occurence_of_offence_date_from,efm.occurence_of_offence_date_to from e_fir_master as efm LEFT OUTER JOIN user_master um on efm.user_id=um.user_id LEFT OUTER JOIN types_of_fir_table typ on efm.types_of_fir_id=typ.types_of_FIR_id where efm.action_taken in ('Pending','Under Scrutiny');";
                                            } else if (isset($typ) && $typ == 'R') {
                                                $qry = "SELECT efm.e_fir_id,efm.sbmt_date,efm.action_taken,efm.action_takenBY,um.gender,efm.occupation,um.user_fname,um.user_lname,typ.fir_type, efm.occurence_of_offence_date_from,efm.occurence_of_offence_date_to from e_fir_master as efm LEFT OUTER JOIN user_master um on efm.user_id=um.user_id LEFT OUTER JOIN types_of_fir_table typ on efm.types_of_fir_id=typ.types_of_FIR_id where efm.action_taken LIKE 'Rejected';";
                                            }

                                            $res = mysqli_query($con, $qry);
                                            $sr = 0;
                                            while ($row = mysqli_fetch_assoc($res)) {
                                                $sr += 1;
                                                $year = date('Y', strtotime($row['sbmt_date'] ?? 'now'));
                                                echo '<tr>
                                                        <td>' . $sr . '</td>
                                                        <td><a href="manage_FIR/FIR_dashboard.php?rno=' . $row['e_fir_id'] . '&type=' . $row['fir_type'] . '" style="color: var(--accent-blue); font-weight: 600;">GJFIR' . $year . sprintf('%04d', $row['e_fir_id']) . '</a></td>
                                                        <td>' . $row['user_fname'] . ' ' . $row['user_lname'] . '</td>
                                                        <td>' . $row['fir_type'] . '</td>
                                                        <td>' . $row['gender'] . '</td>
                                                        <td>' . $row['occupation'] . '</td>
                                                        <td>' . $row['sbmt_date'] . '</td>
                                                        <td>' . $row['occurence_of_offence_date_from'] . '</td>
                                                        <td>' . $row['occurence_of_offence_date_to'] . '</td>
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
                </div>
            </div>

            <!-- Import Footer -->
            <?php include "common/_footer.php"; ?>
        </div><!-- /.content-wrapper -->
    </div><!-- /.wrapper -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="dist/js/adminlte.js"></script>
    <script src="common/time.js"></script>
    <script src="common/date.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
</body>
</html>