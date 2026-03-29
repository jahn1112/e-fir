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
        $qry = "SELECT * FROM `police_master` WHERE `username` = '$username'";
        $result = mysqli_query($con, $qry);
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($pass, $row['password'])) {
                // category checking
                if ($cat == $row['designation']) {
                    $_SESSION["cat"] = $_POST["category"];
                    $_SESSION['user'] = $row['p_name'];
                    $_SESSION['lg'] = true;
                    header("location:index.php");
                } else {
                    echo "<script>alert('Please ensure..! Category Not Matched !');</script>";
                }
            } else {
                $err = true;
            }
        } else {
            $err = true;
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
            --primary: #0ea5e9;
            --primary-light: #38bdf8;
            --primary-dark: #0284c7;
            --secondary: #0f172a;
            --accent-glow: rgba(14, 165, 233, 0.4);
            --glass-bg: rgba(255, 255, 255, 0.05);
            --glass-border: rgba(255, 255, 255, 0.1);
            --text-white: #f8fafc;
            --text-muted: #94a3b8;
            --bg-dark: #020617;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Outfit', 'Poppins', sans-serif;
        }

        body {
            background: #020617 !important;
            color: var(--text-white);
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
            background: linear-gradient(135deg, #0f172a 0%, #020617 100%);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 4.5rem;
            color: var(--text-white);
            position: relative;
            overflow: hidden;
            border-right: 1px solid var(--glass-border);
        }

        .login-banner::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: radial-gradient(circle at top left, var(--accent-glow), transparent 70%);
            z-index: 1;
            opacity: 0.3;
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
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
            border-radius: 50%;
            padding: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            filter: drop-shadow(0 0 10px var(--accent-glow));
        }

        .branded-logo h1 {
            font-size: 2.8rem;
            font-weight: 800;
            letter-spacing: -1px;
            line-height: 1.1;
            background: linear-gradient(to bottom, #fff, #94a3b8);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .banner-text h2 {
            font-size: 3.8rem;
            font-weight: 800;
            margin-bottom: 2rem;
            line-height: 1.1;
            letter-spacing: -2px;
            animation: fadeInUp 1s ease 0.2s both;
            color: #fff;
        }

        .banner-text p {
            font-size: 1.25rem;
            color: var(--text-muted);
            max-width: 480px;
            line-height: 1.6;
            animation: fadeInUp 1s ease 0.4s both;
        }

        /* Right Side: Form */
        .login-form-wrapper {
            flex: 0 0 550px;
            background: rgba(15, 23, 42, 0.4);
            backdrop-filter: blur(25px);
            -webkit-backdrop-filter: blur(25px);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 3rem;
            position: relative;
            border-left: 1px solid var(--glass-border);
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
            font-size: 2.2rem;
            font-weight: 800;
            color: #fff;
            margin-bottom: 0.5rem;
            letter-spacing: -1px;
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
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--text-white);
            margin-bottom: 0.6rem;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-wrapper i {
            position: absolute;
            left: 1.2rem;
            color: var(--primary);
            font-size: 1.1rem;
            transition: all 0.3s ease;
            z-index: 5;
        }

        .form-control {
            width: 100%;
            padding: 1.1rem 1.1rem 1.1rem 3.2rem;
            border: 1px solid var(--glass-border);
            border-radius: 14px;
            font-size: 1rem;
            color: #fff;
            background: rgba(255, 255, 255, 0.03);
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
            border-color: var(--primary);
            background: rgba(255, 255, 255, 0.07);
            box-shadow: 0 0 20px rgba(14, 165, 233, 0.2);
        }

        .form-control:focus + i, .form-control:focus ~ i {
            color: var(--primary-light);
            filter: drop-shadow(0 0 5px var(--accent-glow));
        }

        /* Button */
        .btn-login {
            width: 100%;
            padding: 1.1rem;
            background: var(--primary);
            color: #fff;
            border: none;
            border-radius: 14px;
            font-size: 1.1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            margin-top: 1rem;
            box-shadow: 0 10px 25px rgba(14, 165, 233, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-login:hover {
            background: var(--primary-light);
            box-shadow: 0 15px 30px rgba(14, 165, 233, 0.4);
            transform: translateY(-3px);
            color: #fff;
        }

        .btn-login:active {
            transform: translateY(0);
        }

        /* Links */
        .forgot-link {
            display: block;
            text-align: center;
            margin-top: 2rem;
            color: var(--text-muted);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }

        .forgot-link:hover {
            color: var(--primary);
            text-shadow: 0 0 10px var(--accent-glow);
        }

        /* Back to Home Button */
        .back-home {
            position: absolute;
            top: 2rem;
            right: 2rem;
            z-index: 10;
        }

        .btn-back {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 0.6rem 1.2rem;
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: 12px;
            color: var(--text-white);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .btn-back:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: var(--primary);
            transform: translateX(-5px);
            color: var(--primary);
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
        <div class="login-form-wrapper" style="position: relative;">
            <div class="back-home">
                <a href="../FIR_project1/index.php" class="btn-back">
                    <i class="fas fa-home"></i> Back to Home
                </a>
            </div>
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