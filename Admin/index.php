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
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- CSS only -->
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">

    <!-- Tempusdominus Bootstrap 4.6.2 final-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <!-- <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css"> -->
    <!-- Daterange picker -->
    <!-- <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css"> -->
    <!-- summernote -->
    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="img/gujaratpolice.png" alt="GUJARAT_POLICE_logo" height="110" width="90"></br>
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
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="image">
                                    <img src="img/user.png" class="img-circle elevation-0 mt-1" alt="User" height="50px" width="50px">
                                </div>

                                <h4 class="mt-3"> &nbsp;&nbsp;&nbsp;Welcome Mr/Mrs&nbsp; <b><?php echo $_SESSION["user"]; ?></b></h4>

                            </div>
                        </div>

                    </div>
                    <!-- /.card -->

                    <!-- small boxes -->
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3> <?php E_FIR($con)?> </h3>

                                    <p class="text-bold text-dark">Total FIR's</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-document"></i>
                                </div>
                                
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3> <?php rpt_missing_person($con)?> </sup></h3>

                                    <p class="text-bold text-dark">Missing Reports</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-ios-flag-outline"></i>
                                </div>
                                
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3> <?php registration($con)?> </h3>

                                    <p class="text-bold text-dark">User Registrations</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                        
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3> <?php e_application($con)?> </h3>

                                    <p class="text-bold text-dark">E - Applications</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-document-text"></i>
                                </div>
                             
                            </div>
                        </div>
                        <!-- ./col -->
                    </div>

                    <div class="row mt-3 py-2">
                        <div class="col">
                            <div class="alert alert-info" role="alert" style="background-color: rgba(5, 28, 160, 0.836); ">
                                <h2 class="alert-heading text-center text-bold">Goverment of Gujarat !</h2>
                                <hr>
                                <h2>Welcome to Admin Portal</h2>
                                <p> &nbsp; This site is only for official work and No use other purposes .</p>
                                <hr>
                                <p class="mb-0"><b style="color: red;">NOTE : </b>This site is created for educational
                                    purpose only, we do not intend to violate any law. We will not use any property of
                                    Gujarat Police for commercial or professional purposes. We will be careful about
                                    this.</p>
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

    <!-- Bootstrap 4 -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
    <!-- <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script> -->
    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>


    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/37520468b2.js" crossorigin="anonymous"></script>

    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.js"></script>
    <!-- AdminLTE for demo purposes -->
    <!-- <script src="dist/js/demo.js"></script> -->
    <script src="common\date.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <!-- <script src="dist/js/pages/dashboard.js"></script> -->
    <script src="common\time.js"></script>



</body>

</html>