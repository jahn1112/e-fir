<?php
include "dashboard_info.php";
session_start();
//print_r($_SESSION);
$_SESSION["curr_page"] = "home";

if ($_SESSION["lg"] == false) {
    header("location: login.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ADMIN PORTAL</title>

    <link rel="icon" href="img\weblogo1.ico" type="image/icon">
    <!-- Google Font: Outfit & Poppins -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700&display=swap">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Theme foundations -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- Modern Admin Style Overrides -->
    <link rel="stylesheet" href="css/admin_glass.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="img/gujaratpolice.png" alt="GUJARAT_POLICE_logo" height="110"
                width="90"></br>
            <h1>GUJARAT POLICE</h1>
        </div>

        <!-- Import all Navbar -->
        <?php include "common/_navbar.php"; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-0">
                        <div class="col-sm-12">
                            <h1 class="m-0 text-center text-bold "> Dashboard </h1>
                        </div><!-- /.col -->

                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->

                    <!-- welcome msessage box -->
                    <div class="card welcome-box">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="image">
                                    <img src="img/user.png" class="img-circle elevation-2 border" alt="User"
                                        height="60px" width="60px" style="border-color: var(--accent) !important;">
                                </div>
                                <div class="ml-4">
                                    <h4 class="mb-1" style="color: #fff;">Hello, <b>
                                            <?php echo $_SESSION["user"]; ?>
                                        </b></h4>
                                    <p class="mb-0 text-muted" style="letter-spacing: 0.5px;">Welcome to the Gujarat
                                        Police Administrative Portal</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->

                    <!-- small boxes -->
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box" style="background: linear-gradient(135deg, #0ea5e9, #0284c7);">
                                <div class="inner">
                                    <h3>
                                        <?php E_FIR($con)?>
                                    </h3>
                                    <p class="text-bold" style="color: rgba(255,255,255,0.9);">Total FIR's</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-file-invoice"></i>
                                </div>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box" style="background: linear-gradient(135deg, #10b981, #059669);">
                                <div class="inner">
                                    <h3>
                                        <?php rpt_missing_person($con)?>
                                    </h3>
                                    <p class="text-bold" style="color: rgba(255,255,255,0.9);">Missing Reports</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-flag"></i>
                                </div>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box" style="background: linear-gradient(135deg, #f59e0b, #d97706);">
                                <div class="inner">
                                    <h3>
                                        <?php registration($con)?>
                                    </h3>
                                    <p class="text-bold" style="color: rgba(255,255,255,0.9);">User Registrations</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-user-plus"></i>
                                </div>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box" style="background: linear-gradient(135deg, #ef4444, #dc2626);">
                                <div class="inner">
                                    <h3>
                                        <?php e_application($con)?>
                                    </h3>
                                    <p class="text-bold" style="color: rgba(255,255,255,0.9);">E-Applications</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-file-alt"></i>
                                </div>
                            </div>
                        </div>
                        <!-- ./col -->
                    </div>

                    <div class="card"
                        style="background: linear-gradient(135deg, rgba(5, 28, 160, 0.4), rgba(5, 28, 160, 0.1)); border: 1px solid var(--glass-border);">
                        <div class="card-body">
                            <h2 class="text-center font-weight-bold mb-4"
                                style="color: var(--accent); letter-spacing: 2px;">GOVERNMENT OF GUJARAT</h2>
                            <div class="separator mb-4"
                                style="height: 2px; background: linear-gradient(to right, transparent, var(--accent), transparent);">
                            </div>
                            <h3 class="mb-3">Official Administrative Portal</h3>
                            <p class="lead">&nbsp; This site is strictly for official use only. Unauthorized access is
                                prohibited.</p>
                            <div class="alert mt-4"
                                style="background: rgba(239, 68, 68, 0.1); border-left: 4px solid var(--danger); border-radius: 8px;">
                                <p class="mb-0"><b style="color: var(--danger);">EDUCATIONAL DISCLAIMER:</b> This
                                    platform is developed for educational purposes. All digital assets belonging to
                                    Gujarat Police are handled with respect and are not used for commercial gain.</p>
                            </div>
                        </div>
                    </div>

                </div>



            </section>
            <!-- /.Left col -->





        </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Import Footer -->
    <?php include "common/_footer.php"; ?>



    </div>
    <!-- ./wrapper -->

    <!-- jQuery & Bootstrap -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.js"></script>
    <!-- AdminLTE for demo purposes -->
    <!-- <script src="dist/js/demo.js"></script> -->
    <script src="common/date.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <!-- <script src="dist/js/pages/dashboard.js"></script> -->
    <script src="common/time.js"></script>



</body>

</html>