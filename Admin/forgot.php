<?php
session_start();
include "common/dbconfig.php";

// Initialize step if not set
if (!isset($_SESSION['admin_reset_step'])) {
    $_SESSION['admin_reset_step'] = 'identify';
}

$error = "";
$success = "";

// STEP 1: Identify
if (isset($_POST['step1_submit'])) {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $email = mysqli_real_escape_string($con, $_POST['email']);

    $query = "SELECT * FROM police_master WHERE username='$username' AND p_email='$email'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['admin_reset_user'] = $username;
        $_SESSION['admin_reset_step'] = 'challenge';
    } else {
        $error = "Administrative record not found for the provided Username and Email.";
    }
}

// STEP 2: Challenge
if (isset($_POST['step2_submit'])) {
    $dob = mysqli_real_escape_string($con, $_POST['dob']);
    $contact = mysqli_real_escape_string($con, $_POST['contact']);
    $username = $_SESSION['admin_reset_user'];

    $query = "SELECT * FROM police_master WHERE username='$username' AND p_dob='$dob' AND p_contact='$contact'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['admin_reset_step'] = 'reset';
    } else {
        $error = "Authorization Failed. The Date of Birth or Contact Number does not match our records.";
    }
}

// STEP 3: Reset
if (isset($_POST['step3_submit'])) {
    $new_pass = mysqli_real_escape_string($con, $_POST['new_pass']);
    $conf_pass = mysqli_real_escape_string($con, $_POST['conf_pass']);
    $username = $_SESSION['admin_reset_user'];

    if ($new_pass === $conf_pass) {
        $query = "UPDATE police_master SET password='$new_pass' WHERE username='$username'";
        if (mysqli_query($con, $query)) {
            $success = "Administrative access credentials updated successfully. You may now login.";
            unset($_SESSION['admin_reset_step']);
            unset($_SESSION['admin_reset_user']);
        } else {
            $error = "System error during credential update: " . mysqli_error($con);
        }
    } else {
        $error = "Confirmation mismatch. Please ensure both password fields are identical.";
    }
}

// Cancel
if (isset($_GET['cancel'])) {
    unset($_SESSION['admin_reset_step']);
    unset($_SESSION['admin_reset_user']);
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Credential Recovery | e-FIR</title>
    <link rel="icon" href="img\weblogo1.ico" type="image/icon">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link rel="stylesheet" href="css/admin_glass.css">
    <style>
        .login-page {
            background: radial-gradient(circle at center, #1e293b, #020617) !important;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-box {
            width: 450px;
        }
        .card-outline.card-primary {
            border-top: 3px solid #0ea5e9 !important;
        }
        .progress-stepper {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 25px;
        }
        .step-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.2);
            transition: all 0.3s ease;
        }
        .step-dot.active {
            background: #0ea5e9;
            box-shadow: 0 0 10px #0ea5e9;
            width: 30px;
            border-radius: 10px;
        }
        .step-dot.done {
            background: #0ea5e9;
        }
        .btn-primary {
            background: #0ea5e9 !important;
            border: none !important;
            font-weight: 700 !important;
            height: 45px;
            border-radius: 8px !important;
        }
        .btn-primary:hover {
            filter: brightness(1.2);
            transform: translateY(-1px);
        }
    </style>
</head>
<body class="hold-transition login-page">

    <div class="login-box">
        <div class="text-center mb-4">
            <img src="img/user.png" class="img-circle elevation-3" alt="User" height="80px" width="80px" style="border: 2px solid #0ea5e9; padding: 5px;">
            <h3 class="mt-3" style="font-weight: 800; letter-spacing: 1px;">GUJARAT POLICE</h3>
            <p class="text-muted">Administrative Access Recovery</p>
        </div>

        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="#" class="h4"><b>Restoration</b> Portal</a>
            </div>
            <div class="card-body">
                
                <?php 
                $current_step = isset($_SESSION['admin_reset_step']) ? $_SESSION['admin_reset_step'] : 'identify';
                if ($error) echo '<div class="alert alert-danger" style="font-size: 0.85rem;"><i class="fas fa-exclamation-circle mr-2"></i> '.$error.'</div>';
                if ($success) echo '<div class="alert alert-success" style="font-size: 0.85rem;"><i class="fas fa-check-circle mr-2"></i> '.$success.'</div>';
                ?>

                <?php if (!$success): ?>
                    <div class="progress-stepper">
                        <div class="step-dot <?php echo $current_step == 'identify' ? 'active' : 'done'; ?>"></div>
                        <div class="step-dot <?php echo $current_step == 'challenge' ? 'active' : ($current_step == 'reset' ? 'done' : ''); ?>"></div>
                        <div class="step-dot <?php echo $current_step == 'reset' ? 'active' : ''; ?>"></div>
                    </div>

                    <?php if ($current_step == 'identify'): ?>
                        <p class="login-box-msg">Step 1: Identify administrative account</p>
                        <form action="forgot.php" method="POST">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Admin Username" name="username" required>
                                <div class="input-group-append">
                                    <div class="input-group-text"><span class="fas fa-user-shield"></span></div>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input type="email" class="form-control" placeholder="Official Email" name="email" required>
                                <div class="input-group-append">
                                    <div class="input-group-text"><span class="fas fa-envelope"></span></div>
                                </div>
                            </div>
                            <button type="submit" name="step1_submit" class="btn btn-primary btn-block">Verify Identity</button>
                        </form>

                    <?php elseif ($current_step == 'challenge'): ?>
                        <p class="login-box-msg">Step 2: Security challenge</p>
                        <form action="forgot.php" method="POST">
                            <div class="form-group mb-3">
                                <label style="font-size: 0.8rem; margin-bottom: 5px;">Officer Date of Birth</label>
                                <div class="input-group">
                                    <input type="date" class="form-control" name="dob" required>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label style="font-size: 0.8rem; margin-bottom: 5px;">Registered Contact Number</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="contact" placeholder="10-digit number" pattern="\d{10}" maxlength="10" required>
                                    <div class="input-group-append">
                                        <div class="input-group-text"><span class="fas fa-phone"></span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <a href="?cancel=1" class="btn btn-outline-light btn-block">Cancel</a>
                                </div>
                                <div class="col-6">
                                    <button type="submit" name="step2_submit" class="btn btn-primary btn-block">Authorize</button>
                                </div>
                            </div>
                        </form>

                    <?php elseif ($current_step == 'reset'): ?>
                        <p class="login-box-msg">Step 3: Secure reset</p>
                        <form action="forgot.php" method="POST">
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" placeholder="New Password" name="new_pass" required>
                                <div class="input-group-append">
                                    <div class="input-group-text"><span class="fas fa-lock"></span></div>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" placeholder="Confirm Password" name="conf_pass" required>
                                <div class="input-group-append">
                                    <div class="input-group-text"><span class="fas fa-lock"></span></div>
                                </div>
                            </div>
                            <button type="submit" name="step3_submit" class="btn btn-primary btn-block">Update Credentials</button>
                        </form>
                    <?php endif; ?>

                <?php else: ?>
                    <div class="text-center mt-4">
                        <a href="login.php" class="btn btn-primary btn-block">Return to Login</a>
                    </div>
                <?php endif; ?>

            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>