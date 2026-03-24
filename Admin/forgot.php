<?php
include "common/dbconfig.php"; // database config file
$done = false ;

if(isset($_POST['sbmt']))
{
    $username = $_POST['fusername'];
    $contact = $_POST['contact'];
    $newpass = $_POST['password'];
    $cpass = $_POST['cpassword'];


    if($newpass == $cpass)
    {
        $qry = "update police_master set `password`='$newpass' WHERE username='$username' and p_contact=$contact";
        $result = mysqli_query($con, $qry);
        // $rowcount = mysqli_num_rows($result); //return no of rows
        if ($result > 0) {
        
            $done = true;
        } else {
            echo "<script>alert('Password Not Recovered...!');</script>";
        }
    }
    else
    {
        echo "<script>alert('Ensure..! Confirm Password must be Same...');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>! Forgot Password !</title>

    <!-- website logo -->
    <link rel="icon" href="img\weblogo1.ico" type="image/icon">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
    <!-- image(logo) -->
    <div class="image mb-2 f">
        <a href="index.php"><img src="img/user.png" class="img-circle elevation-3" alt="User" height="100px"
                width="100px"></a>
    </div>
    <div class="info">
        <h3 class="font-weight-black">Gujarat Police</h3>
    </div>

    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="" class="h1"><b>Recover </b>Password</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">You forgot your password? Here you can easily set a new password.</p>
                <form action="#" method="POST">
<!-- email -->
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Username" name="fusername" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <!-- contact -->
                    <div class="input-group mb-3">

                        <input type="tel" class="form-control" name="contact" maxlength="10" minlength="10"  placeholder="Contact" pattern="[0-9]{10}" required>
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="password" placeholder="New Password"  required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="cpassword" placeholder="Confirm Password"  required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    

                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block" name="sbmt" value="recover">Recover password</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <p class="mt-3 mb-1">
                    <a href="login.php">Login</a>
                </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
if($done ==  true){
echo "
<script>
Swal.fire(
    'Password Updated Successfully!',
    '',
    'success'
  ).then(function() {
    window.location = './login.php';
});
</script>";
}
?>
</body>

</html>