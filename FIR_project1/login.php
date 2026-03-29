<?php
session_start();
$_SESSION['login'] = false;


// $_SESSION['logout']= false;
// Import database connection configuration
include_once "DBconfig.php";


$errmsg = false;


// login logic

if (isset($_POST['login'])) {
  
   if ($_SERVER['REQUEST_METHOD'] == 'POST') {
       // store username & password
       $usernm = mysqli_real_escape_string($con, trim($_POST['username']));
       $password = mysqli_real_escape_string($con, $_POST['password']);


       // fetch from db and verifying..
       $qry = "SELECT * FROM `user_master` WHERE `username` ='" . $usernm . "' and `password` ='" . $password . "'";

       $result = mysqli_query($con, $qry);
       $rowcount = mysqli_num_rows($result); //return no of rows

       if ($rowcount > 0) {

           while ($row = mysqli_fetch_assoc($result)) {


               // category checking


               $_SESSION["userid"] = $row["user_id"];
               $_SESSION['userfname'] = $row['user_fname'];
               $_SESSION['userlname'] = $row['user_lname'];
               $_SESSION['login'] = true;
               header("location:index.php"); exit();

            //    echo "LOGGED in";
               // echo "<script>alert('Please ensure..! Category Not Matched !');</script>";

           }
       } else {
           $errmsg = true;
           // and show alert message
           
       }
   }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img\weblogo1.ico" type="image/icon">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="modern_index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700&display=swap">
</head>
<body>
    <?php include "common/_navbar.php"; ?>

    <div class="main-form-container" style="min-height: 80vh; display: flex; align-items: center; justify-content: center; padding: 2rem 0;">
        <div class="glass-container" style="max-width: 450px; width: 100%; padding: 3rem; text-align: center;">
            <div style="background: rgba(14, 165, 233, 0.1); width: 80px; height: 80px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem;">
                <i class="fas fa-lock" style="font-size: 2rem; color: var(--accent);"></i>
            </div>
            
            <h1 style="color: var(--text-white); font-size: 2rem; margin-bottom: 0.5rem; font-family: 'Outfit', sans-serif;">Welcome Back</h1>
            <p style="color: var(--text-muted); margin-bottom: 2.5rem;">Sign in to the E-FIR Citizen Portal</p>

            <form action="#" method="POST" style="text-align: left;">
                <div class="form-group" style="margin-bottom: 1.5rem;">
                    <label style="display: block; color: var(--text-white); margin-bottom: 0.5rem; font-size: 0.9rem;">Username</label>
                    <div style="position: relative;">
                        <i class="fas fa-user" style="position: absolute; left: 15px; top: 12px; color: var(--accent);"></i>
                        <input type="text" name="username" placeholder="Enter your username" style="width: 100%; padding: 10px 15px 10px 45px; background: rgba(255, 255, 255, 0.05); border: 1px solid var(--glass-border); border-radius: 8px; color: var(--text-white); outline: none;" required>
                    </div>
                </div>

                <div class="form-group" style="margin-bottom: 1rem;">
                    <label style="display: block; color: var(--text-white); margin-bottom: 0.5rem; font-size: 0.9rem;">Password</label>
                    <div style="position: relative;">
                        <i class="fas fa-key" style="position: absolute; left: 15px; top: 12px; color: var(--accent);"></i>
                        <input type="password" name="password" placeholder="Enter your password" style="width: 100%; padding: 10px 15px 10px 45px; background: rgba(255, 255, 255, 0.05); border: 1px solid var(--glass-border); border-radius: 8px; color: var(--text-white); outline: none;" required>
                    </div>
                </div>

                <div style="text-align: right; margin-bottom: 2rem;">
                    <a href="password.php" style="color: var(--accent); text-decoration: none; font-size: 0.85rem;">Forgot Password?</a>
                </div>

                <button type="submit" name="login" value="login" class="btn-submit" style="width: 100%; padding: 12px; font-weight: 600;">Sign In</button>
                
                <div style="margin-top: 2rem; text-align: center; color: var(--text-muted); font-size: 0.9rem;">
                    Don't have an account? <a href="register.php" style="color: var(--accent); text-decoration: none; font-weight: 500;">Create Account</a>
                </div>
            </form>
        </div>
    </div>

    <!-- sweet alert cdn path -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?php
    if ($errmsg == true) {
        echo "<script>
        Swal.fire({
            title: 'Login Failed!',
            text: 'Username & Password do not match, or user is not registered.',
            icon: 'error',
            background: 'rgba(15, 23, 42, 0.95)',
            color: '#f8fafc',
            confirmButtonColor: '#0ea5e9'
        })
        </script>";
    }
    ?>

    <?php include "common/_footer.php"; ?>
</body>
</body>
</html>