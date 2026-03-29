<?php
session_start();
//print_r($_SESSION);
$_SESSION["curr_page"] = "Contact";
if ($_SESSION["lg"] == false) {
    header("location:login.php");
}

if(isset($_POST["submit"]))

{
    echo "<script>alert('Thank You for Contact Us! You will be in touch with our team soon.');</script>";

    sleep(1);
    echo "<script> window.location = 'index.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact Support | Admin</title>

    <link rel="icon" href="img\weblogo1.ico" type="image/icon">
    <!-- Google Font: Outfit & Poppins -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700&display=swap">
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
            <img class="animation__shake" src="img/gujaratpolice.png" alt="GUJARAT_POLICE_logo" height="110" width="90">
            <h1 class="mt-3 font-weight-bold" style="color: var(--primary);">GUJARAT POLICE</h1>
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
                                <div class="card-header border-0">
                                    <h3 class="card-title text-bold"><i class="fas fa-envelope mr-2"></i> Contact for Inquiry</h3>
                                </div>
                                <div class="card-body text-left">
                                    <form action="#" method="POST">
                                        <div class="form-group mb-3">
                                            <label for="inputName">Full Name</label>
                                            <input type="text" name="inputName" class="form-control" style="background: rgba(255,255,255,0.05); border: 1px solid var(--glass-border); color: #fff;" required />
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="inputEmail">Official Email Address</label>
                                            <input type="email" name="inputEmail" class="form-control" style="background: rgba(255,255,255,0.05); border: 1px solid var(--glass-border); color: #fff;" required />
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="inputSubject">Subject of Inquiry</label>
                                            <input type="text" name="inputSubject" class="form-control" style="background: rgba(255,255,255,0.05); border: 1px solid var(--glass-border); color: #fff;" required />
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="inputMessage">Detailed Message</label>
                                            <textarea name="inputMessage" class="form-control" rows="4" style="background: rgba(255,255,255,0.05); border: 1px solid var(--glass-border); color: #fff;"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary px-4 py-2" name="submit" style="background: linear-gradient(135deg, var(--accent), #0ea5e9); border: none; font-weight: 600;">
                                                <i class="fas fa-paper-plane mr-2"></i> Send Inquiry
                                            </button>
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

    <!-- jQuery & Bootstrap -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.js"></script>
</body>

</html>