<?php
session_start();
require_once "DBconfig.php";

// Initialize step if not set
if (!isset($_SESSION['reset_step'])) {
    $_SESSION['reset_step'] = 'identify';
}

$error = "";
$success = "";

// STEP 1: Identify
if (isset($_POST['step1_submit'])) {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $email = mysqli_real_escape_string($con, $_POST['email']);

    $query = "SELECT * FROM user_master WHERE username='$username' AND user_email='$email'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['reset_user'] = $username;
        $_SESSION['reset_email'] = $email;
        $_SESSION['reset_step'] = 'challenge';
    } else {
        $error = "Invalid account credentials. Please check your username and email.";
    }
}

// STEP 2: Challenge
if (isset($_POST['step2_submit'])) {
    $dob = mysqli_real_escape_string($con, $_POST['dob']);
    $mobile = mysqli_real_escape_string($con, $_POST['mobile']);
    $username = $_SESSION['reset_user'];

    $query = "SELECT * FROM user_master WHERE username='$username' AND user_dob='$dob' AND contact_no='$mobile'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['reset_step'] = 'reset';
    } else {
        $error = "Verification failed. Incorrect Date of Birth or Mobile Number associated with this account.";
    }
}

// STEP 3: Reset
if (isset($_POST['step3_submit'])) {
    $new_pass = mysqli_real_escape_string($con, $_POST['new_pass']);
    $conf_pass = mysqli_real_escape_string($con, $_POST['conf_pass']);
    $username = $_SESSION['reset_user'];

    if ($new_pass === $conf_pass) {
        $query = "UPDATE user_master SET password='$new_pass' WHERE username='$username'";
        if (mysqli_query($con, $query)) {
            $success = "Your password has been securely updated. You can now login with your new credentials.";
            unset($_SESSION['reset_step']);
            unset($_SESSION['reset_user']);
            unset($_SESSION['reset_email']);
        } else {
            $error = "Unable to update password. System error: " . mysqli_error($con);
        }
    } else {
        $error = "The passwords you entered do not match. Please try again.";
    }
}

// Reset the flow if requested
if (isset($_GET['cancel'])) {
    unset($_SESSION['reset_step']); 
    unset($_SESSION['reset_user']);
    unset($_SESSION['reset_email']);
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restore Password | Gujarat Police</title>
    <link rel="icon" href="img/weblogo1.ico" type="image/icon">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="modern_index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700&display=swap">
    <style>
        .progress-bar {
            display: flex;
            justify-content: space-between;
            margin-bottom: 2.5rem;
            position: relative;
            padding: 0 10%;
        }
        .progress-bar::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 15%;
            right: 15%;
            height: 2px;
            background: rgba(255,255,255,0.1);
            z-index: 1;
        }
        .step {
            width: 40px;
            height: 40px;
            background: rgba(15, 23, 42, 0.8);
            border: 2px solid rgba(255,255,255,0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            z-index: 2;
            transition: all 0.4s ease;
            color: #94a3b8;
        }
        .step.active {
            border-color: var(--accent);
            color: #fff;
            box-shadow: 0 0 15px rgba(14, 165, 233, 0.4);
            transform: scale(1.1);
        }
        .step.done {
            background: var(--accent);
            border-color: var(--accent);
            color: white;
        }
        .alert {
            padding: 1.25rem;
            border-radius: 12px;
            margin-bottom: 2rem;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .alert-error {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.2);
            color: #f87171;
        }
        .alert-success {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.2);
            color: #34d399;
        }
        .step-title {
            text-align: center;
            margin-bottom: 2.5rem;
        }
        .step-title h3 {
            font-size: 1.75rem;
            color: var(--text-white);
            margin-bottom: 0.75rem;
            font-family: 'Outfit', sans-serif;
        }
        .step-title p {
            color: var(--text-muted);
            font-size: 1rem;
        }
    </style>
</head>

<body>
    <?php include "common/_navbar.php"; ?>

    <div class="main-form-container">
        <div class="page-header">
            <h1>Security Shield</h1>
            <p>Advanced Password Restoration Process</p>
        </div>

        <div class="glass-container" style="max-width: 700px; margin: 0 auto; padding: 3rem;">
            <?php 
            $current_step = isset($_SESSION['reset_step']) ? $_SESSION['reset_step'] : 'identify';
            if ($success) {
                echo '<div class="alert alert-success"><i class="fas fa-check-circle"></i> '.$success.'</div>';
            } elseif ($error) {
                echo '<div class="alert alert-error"><i class="fas fa-exclamation-triangle"></i> '.$error.'</div>';
            }
            ?>

            <?php if (!$success): ?>
            <div class="progress-bar">
                <div class="step <?php echo $current_step == 'identify' ? 'active' : ($current_step != 'identify' ? 'done' : ''); ?>">1</div>
                <div class="step <?php echo $current_step == 'challenge' ? 'active' : ($current_step == 'reset' ? 'done' : ''); ?>">2</div>
                <div class="step <?php echo $current_step == 'reset' ? 'active' : ''; ?>">3</div>
            </div>

            <div class="form-content">
                <?php if ($current_step == 'identify'): ?>
                    <div class="step-title">
                        <h3>Identity Check</h3>
                        <p>Locate your electronic dossier by providing your access credentials.</p>
                    </div>
                    <form action="password.php" method="POST">
                        <div class="form-group" style="margin-bottom: 1.5rem;">
                            <label style="display: block; color: var(--text-white); margin-bottom: 0.5rem; font-size: 0.95rem;">Citizen Username</label>
                            <input type="text" name="username" placeholder="Enter your username" style="width: 100%; padding: 12px; background: rgba(15, 23, 42, 0.6); border: 1px solid var(--glass-border); border-radius: 8px; color: var(--text-white); outline: none;" required>
                        </div>
                        <div class="form-group">
                            <label style="display: block; color: var(--text-white); margin-bottom: 0.5rem; font-size: 0.95rem;">Registered Email Address</label>
                            <input type="email" name="email" placeholder="example@police.gov.in" style="width: 100%; padding: 12px; background: rgba(15, 23, 42, 0.6); border: 1px solid var(--glass-border); border-radius: 8px; color: var(--text-white); outline: none;" required>
                        </div>
                        <div class="form-actions" style="margin-top: 3rem; display: flex; gap: 1rem;">
                            <button type="submit" name="step1_submit" class="btn-submit" style="flex: 1; border: none;">Verify Account</button>
                        </div>
                    </form>

                <?php elseif ($current_step == 'challenge'): ?>
                    <div class="step-title">
                        <h3>Security Challenge</h3>
                        <p>Acknowledge ownership by providing your private biometric metadata.</p>
                    </div>
                    <form action="password.php" method="POST">
                        <div class="form-group" style="margin-bottom: 1.5rem;">
                            <label style="display: block; color: var(--text-white); margin-bottom: 0.5rem; font-size: 0.95rem;">Date of Birth</label>
                            <input type="date" name="dob" style="width: 100%; padding: 12px; background: rgba(15, 23, 42, 0.6); border: 1px solid var(--glass-border); border-radius: 8px; color: var(--text-white); outline: none;" required>
                        </div>
                        <div class="form-group">
                            <label style="display: block; color: var(--text-white); margin-bottom: 0.5rem; font-size: 0.95rem;">Registered Mobile Number</label>
                            <input type="text" name="mobile" placeholder="10-digit primary contact" pattern="\d{10}" maxlength="10" style="width: 100%; padding: 12px; background: rgba(15, 23, 42, 0.6); border: 1px solid var(--glass-border); border-radius: 8px; color: var(--text-white); outline: none;" required>
                        </div>
                        <div class="form-actions" style="margin-top: 3rem; display: flex; gap: 1rem;">
                            <a href="?cancel=1" class="btn-reset" style="flex: 1; text-align: center; text-decoration: none; padding: 12px; background: rgba(239, 68, 68, 0.1); color: #ef4444; border: 1px solid rgba(239, 68, 68, 0.2); border-radius: 8px;">Cancel</a>
                            <button type="submit" name="step2_submit" class="btn-submit" style="flex: 1; border: none;">Unlock Access</button>
                        </div>
                    </form>

                <?php elseif ($current_step == 'reset'): ?>
                    <div class="step-title">
                        <h3>Create New Access Key</h3>
                        <p>Establish a secure alphanumeric combination for future authentication.</p>
                    </div>
                    <form action="password.php" method="POST">
                        <div class="form-group" style="margin-bottom: 1.5rem;">
                            <label style="display: block; color: var(--text-white); margin-bottom: 0.5rem; font-size: 0.95rem;">New Secure Password</label>
                            <input type="password" name="new_pass" placeholder="Minimum 8 characters" style="width: 100%; padding: 12px; background: rgba(15, 23, 42, 0.6); border: 1px solid var(--glass-border); border-radius: 8px; color: var(--text-white); outline: none;" required>
                        </div>
                        <div class="form-group">
                            <label style="display: block; color: var(--text-white); margin-bottom: 0.5rem; font-size: 0.95rem;">Confirm Access Key</label>
                            <input type="password" name="conf_pass" placeholder="Re-enter password" style="width: 100%; padding: 12px; background: rgba(15, 23, 42, 0.6); border: 1px solid var(--glass-border); border-radius: 8px; color: var(--text-white); outline: none;" required>
                        </div>
                        <div class="form-actions" style="margin-top: 3rem; display: flex; gap: 1rem;">
                            <button type="submit" name="step3_submit" class="btn-submit" style="flex: 1; border: none;">Initialize Password</button>
                        </div>
                    </form>
                <?php endif; ?>
            </div>
            <?php else: ?>
                <div style="text-align: center; margin-top: 2rem;">
                    <a href="login.php" class="btn-submit" style="display: inline-block; text-decoration: none; border: none; padding: 12px 30px;">Proceed to Portal Login</a>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php include "common/_footer.php"; ?>
</body>
</html>