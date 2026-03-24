<?php
session_start();
//print_r($_SESSION);
$_SESSION["curr_page"] = "Contact";
if ($_SESSION["lg"] == false) {
    header("location:login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact Us</title>

    <!-- website logo -->
    <link rel="icon" href="img\weblogo1.ico" type="image/icon">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/37520468b2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <!-- <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css"> -->
    <!-- Daterange picker -->
    <!-- <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css"> -->
    <!-- summernote -->
    <!-- <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css"> -->
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
        <?php include "common/_navbar.php" ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Contact us</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right mr-3">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Contact</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">

                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card text-center">
                                <div class="card-header">
                                    Contact for Inquirey
                                </div>
                                <div class="card-body text-left">
                                    <form action="#" method="POST">
                                        <div class="form-group">
                                            <label for="inputName">Name</label>
                                            <input type="text" id="inputName" class="form-control" required />
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail">E-Mail</label>
                                            <input type="email" id="inputEmail" class="form-control" required />
                                        </div>
                                        <div class="form-group">
                                            <label for="inputSubject">Subject</label>
                                            <input type="text" id="inputSubject" class="form-control" required />
                                        </div>
                                        <div class="form-group">
                                            <label for="inputMessage">Message</label>
                                            <textarea id="inputMessage" class="form-control" rows="4"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" class="btn btn-primary" value="Submit">
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-muted">
                                    <i class="fa fa-mobile" aria-hidden="true"></i>
                                    <i class="fa fa-instagram" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->
                </div>

            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Import Footer -->
        <?php include "common/_footer.php"; ?>


    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
    $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Sparkline -->
    <script src="plugins/sparklines/sparkline.js"></script>


    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.js"></script>
    <!-- AdminLTE for demo purposes -->
    <!-- <script src="dist/js/demo.js"></script> -->
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="dist/js/pages/dashboard.js"></script>
</body>

</html>