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
    <title>Admin Portal | Gujarat Police</title>
    
    <link rel="icon" href="img\weblogo1.ico" type="image/icon">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    
    <style>
        :root {
            --primary: #1e40af;
            --primary-light: #3b82f6;
            --primary-dark: #1e3a8a;
            --secondary: #0f172a;
            --text-muted: #64748b;
            --bg-light: #f8fafc;
            --white: #ffffff;
            --error: #ef4444;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Outfit', sans-serif;
        }

        body {
            background-color: var(--bg-light);
            color: var(--secondary);
            min-height: 100vh;
            display: flex;
        }

        /* Split Screen Layout */
        .login-container {
            display: flex;
            width: 100%;
            min-height: 100vh;
        }

        /* Left Side: Branding / Showcase */
        .login-banner {
            flex: 1;
            background: linear-gradient(135deg, rgba(30, 64, 175, 0.95) 0%, rgba(15, 23, 42, 0.95) 100%), 
                        url('https://images.unsplash.com/photo-1555820585-c5ae44394b79?auto=format&fit=crop&q=80');
            background-size: cover;
            background-position: center;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 4rem;
            color: var(--white);
            position: relative;
            overflow: hidden;
        }

        .login-banner::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: linear-gradient(to bottom, transparent, rgba(0,0,0,0.4));
            z-index: 1;
        }

        .banner-content {
            position: relative;
            z-index: 2;
        }

        .branded-logo {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            margin-bottom: 2rem;
            animation: fadeInDown 1s ease;
        }

        .branded-logo img {
            width: 80px;
            height: 80px;
            background: var(--white);
            border-radius: 50%;
            padding: 10px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }

        .branded-logo h1 {
            font-size: 2.5rem;
            font-weight: 800;
            letter-spacing: -1px;
            line-height: 1.1;
        }

        .banner-text h2 {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            line-height: 1.1;
            animation: fadeInUp 1s ease 0.2s both;
        }

        .banner-text p {
            font-size: 1.25rem;
            color: #cbd5e1;
            max-width: 480px;
            line-height: 1.6;
            animation: fadeInUp 1s ease 0.4s both;
        }

        /* Right Side: Form */
        .login-form-wrapper {
            flex: 0 0 550px;
            background: var(--white);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 3rem;
            position: relative;
            box-shadow: -20px 0 50px rgba(0,0,0,0.05);
            z-index: 10;
        }

        .form-inner {
            width: 100%;
            max-width: 400px;
            animation: fadeInRight 0.8s ease;
        }

        .form-header {
            margin-bottom: 3rem;
        }

        .form-header h3 {
            font-size: 2rem;
            font-weight: 700;
            color: var(--secondary);
            margin-bottom: 0.5rem;
        }

        .form-header p {
            color: var(--text-muted);
            font-size: 1.1rem;
        }

        /* Inputs */
        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-group label {
            display: block;
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--secondary);
            margin-bottom: 0.5rem;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-wrapper i {
            position: absolute;
            left: 1rem;
            color: var(--text-muted);
            font-size: 1.1rem;
            transition: color 0.3s ease;
        }

        .form-control {
            width: 100%;
            padding: 1rem 1rem 1rem 3rem;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 1rem;
            color: var(--secondary);
            background: var(--bg-light);
            transition: all 0.3s ease;
            outline: none;
        }

        /* Select styling adjustment */
        select.form-control {
            appearance: none;
            cursor: pointer;
            padding-left: 1rem; /* no icon for select here */
        }
        
        .select-wrapper::after {
            content: '\f107';
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
            position: absolute;
            right: 1.2rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            pointer-events: none;
        }

        .form-control:focus {
            border-color: var(--primary-light);
            background: var(--white);
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
        }

        .form-control:focus + i, .form-control:focus ~ i {
            color: var(--primary);
        }

        /* Button */
        .btn-login {
            width: 100%;
            padding: 1.1rem;
            background: var(--primary);
            color: var(--white);
            border: none;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 1rem;
            box-shadow: 0 10px 20px rgba(30, 64, 175, 0.2);
        }

        .btn-login:hover {
            background: var(--primary-dark);
            box-shadow: 0 15px 25px rgba(30, 64, 175, 0.3);
            transform: translateY(-2px);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        /* Links */
        .forgot-link {
            display: block;
            text-align: center;
            margin-top: 1.5rem;
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .forgot-link:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        /* Animations */
        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeInRight {
            from { opacity: 0; transform: translateX(30px); }
            to { opacity: 1; transform: translateX(0); }
        }

        /* Responsive */
        @media (max-width: 991px) {
            .login-container {
                flex-direction: column;
            }
            .login-banner {
                flex: none;
                padding: 3rem 2rem;
                height: auto;
            }
            .login-form-wrapper {
                flex: 1;
                width: 100%;
                box-shadow: none;
                border-radius: 30px 30px 0 0;
                margin-top: -30px;
                padding: 3rem 2rem;
            }
            .banner-text h2 {
                font-size: 2.5rem;
            }
        }
    </style>
</head>

<body>

    <div class="login-container">
        <!-- Left Showcase Side -->
        <div class="login-banner">
            <div class="banner-content">
                <div class="branded-logo">
                    <img src="img/user.png" alt="Gujarat Police">
                    <h1>Gujarat<br>Police</h1>
                </div>
            </div>
            
            <div class="banner-content banner-text">
                <h2>Secure Admin<br>Portal Access.</h2>
                <p>Manage First Information Reports (FIRs), applications, missing person reports, and more through our secure centralized system tailored for specialized officers.</p>
            </div>
            
            <div class="banner-content" style="opacity: 0.7; font-size: 0.9rem;">
                <p>&copy; <?php echo date("Y"); ?> Gujarat Police. All rights reserved.</p>
            </div>
        </div>

        <!-- Right Form Side -->
        <div class="login-form-wrapper">
            <div class="form-inner">
                <div class="form-header">
                    <h3>Welcome Back</h3>
                    <p>Please log in to your account.</p>
                </div>

                <form action="#" method="post">
                    
                    <div class="form-group">
                        <label for="username">Username</label>
                        <div class="input-wrapper">
                            <i class="fas fa-portrait"></i>
                            <input type="text" id="username" class="form-control" name="username" placeholder="Enter your username" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="pass">Password</label>
                        <div class="input-wrapper">
                            <i class="fas fa-lock"></i>
                            <input type="password" id="pass" class="form-control" name="pass" placeholder="••••••••" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="category">Designation <span style="color: var(--error);">*</span></label>
                        <div class="input-wrapper select-wrapper">
                            <select id="category" class="form-control" required name="category" style="padding-left: 1.2rem;">
                                <option value="" disabled selected>Select your designation</option>
                                <option value="Police Station Officer">Police Station Officer</option>
                                <option value="Investigation Officer">Investigation Officer</option>
                            </select>
                        </div>
                    </div>

                    <button type="submit" name="login" class="btn-login">
                        Sign In <i class="fas fa-arrow-right" style="margin-left: 8px;"></i>
                    </button>
                    
                </form>

                <a href="forgot.php" class="forgot-link">Forgot password?</a>
            </div>
        </div>
    </div>

    <!-- Scripts for Alerts if needed -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php
    if ($err == true) {
        echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Authentication Failed',
            text: 'Please verify your Username, Password, and Designation.',
            confirmButtonColor: '#1e40af'
        })
        </script>";
    }
    ?>
</body>
</html>