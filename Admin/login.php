<?php
session_start();
$_SESSION["lg"] = false;
$err = false;
include "common/dbconfig.php"; // database config file


if (isset($_POST['login'])) {

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // store username & password
        $username = $_POST['username'];
        $pass = $_POST['pass'];
        $cat = $_POST['category'];

        // fetch from db and verifying..
        $qry = "SELECT * FROM `police_master` WHERE `username` = '$username' AND `password` = '$pass'";
        $result = mysqli_query($con, $qry);
        $rowcount = mysqli_num_rows($result); //return no of rows

        if ($rowcount > 0) {

            while ($row = mysqli_fetch_assoc($result)) {


                // category checking
                if ($cat == $row['designation']) {

                    $_SESSION["cat"] = $_POST["category"];
                    $_SESSION['user'] = $row['p_name'];
                    $_SESSION['lg'] = true;
                    header("location:index.php");

                } else {
                    echo "<script>alert('Please ensure..! Category Not Matched !');</script>";
                }
            }
        } else {
            $err = true;
            // and show alert message
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Log In</title>

    <!-- website logo -->
    <link rel="icon" href="img\weblogo1.ico" type="image/icon">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">

</head>

<body class="hold-transition login-page">

    <!-- image (logo) -->
    <div class="image mb-2 f">
        <a href="index.php"><img src="img/user.png" class="img-circle elevation-3" alt="User" height="100px" width="100px"></a>
    </div>
    <div class="info">
        <h3 class="font-weight-black">Gujarat Police</h3>
    </div>
    <!-- login box -->
    <div class="login-box shadow-lg">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="#" class="h1"><b>Login </b>Portal</a>
            </div>
            <div class="card-body">
                <h5 class="login-box-msg">Sign in to start your session</h5>
                <!-- form start -->
                <form action="#" method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="username" placeholder="Username" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="pass" placeholder="Password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col">
                            <div class="form-group">
                                <label>Category?<span style="color:red;"> *</span></label>
                                <select class="form-control" style="width: 100%;" required name="category">
                                    <option value="">Select Category</option>
                                    <option value="Police Station Officer">Police Station Officer</option>
                                    <option value="Investigation Officer">Investigation Officer</option>

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <!-- /.col -->
                        <div class="col-12">
                            <button type="submit" name="login" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <p class="mb-1">
                    <a href="forgot.php">Forgot password?</a>
                </p>

            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?php
    // error message
    if ($err == true) {

        echo "<script>
        Swal.fire(
            'Invalide Credentials..!',
            'Please ensure Username & Password',
            'error')
        </script>";
    }
    ?>
</body>

</html>