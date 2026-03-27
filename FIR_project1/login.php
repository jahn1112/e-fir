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
    <title>Sign in / Sign up</title>
    <!-- website logo -->
    <link rel="icon" href="img\weblogo1.ico" type="image/icon">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="form_theme.css">
</head>
<body> 


    
           
<div class="modal-content" style="max-width: 500px; margin: 4rem auto;">
<span class="close-form"> &nbsp;</span>

    <div class="form-box">
        <img src="img/user.png" class="user-img">
        <p style="text-align: center;"><small>Please identify yourself</small></p>

        <div class="text-center">
            <div>
                <div class="form-body">
                    <p style="text-align: center;"> <b> Sign in to start your session </b></p>
                    <form action="#" method="POST">
                        <input type="text" name="username" placeholder="Username" required> <br>
                        <input type="password" name="password" placeholder="Password" required>
                    
                    <div id="log" style="margin-right: 10.7em;">
                        
                        <button type="submit" name="login" value="login">Login</button>
                        <button type="reset">Reset</button>
                       
                    
                    </div>
                    </form>
                    <div class="login-links">
                        
                        <a href="register.php" style="float: left; text-decoration: none;">Register</a>
                        <a href="password.php" style="float: right; text-decoration: none;">Forgot Password</a>
                    </div>
                </div>
            </div>
        </div>


    </div>




</div>


<!-- sweet alert cdn path -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
// error message
if ($errmsg == true) {

    echo "<script>
    Swal.fire(
        'Login Failed!',
        'Username & Password do not match, or user is not registered.',
        'error')
    </script>";
}
?>

    <section class="footer">

        <div class="footer-links">
            <h4><a href="PDF/T_And_C.pdf" target="_blank" class="term">Terms & Conditions</a></h4>
            <h4><a href="PDF/F_And_Q.pdf" target="_blank" class="faq">FAQ</a></h4>
            <h4><a href="PDF/P_And_p.pdf" target="_blank" class="pp">Privacy Policy</a></h4>
            <h4><a href="feedback.php" target="" class="feed">Feedback</a></h4>
        </div>
        <!-- <h4><a href="#.php">Visitors : 1674785</a></h4> -->


        <div class="follow">
            <h6>Follow Us</h6>
        </div>

        <div class="icons" id="ir">
            <a href="https://www.facebook.com/dgpgujaratofficial/" target="_blank">
                <h3 class="face"><i class="fab fa-facebook-f"></i> Facebook</h3>
            </a>
            <a href="https://www.instagram.com/gujaratpolice_/" target="_blank">
                <h3 class="face2"><i class="fab fa-instagram"></i> Instagram </h3>
            </a>
            <a href="https://twitter.com/GujaratPolice" target="_blank">
                <h3 class="face3"><i class="fab fa-twitter"></i> Twitter </h3>
            </a>


        </div>

    </section>
</body>
</html>