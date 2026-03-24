<?php
session_start();
include "DBconfig.php";
//print_r($_SESSION);

if ($_SESSION["login"] == true) {
    // if not login redirect page with message
    echo "<script>
            alert('You Are Not Eligible For This Service , Please Sign in !');
            window.location.href='./index.php';
            </script>";
}



    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {

       $username = $_POST['Username'];
	   $email = $_POST['Email'];
	   $npassword = $_POST['Npassword'];
	   $cpassword =  $_POST['Cpassword'];

	   $sql = 'UPDATE user_master SET `password` = "'.$npassword.'" WHERE `username`="'.$username.'" and `user_email`="'.$email.'"';

        
        $result = mysqli_query($con, $sql);
        if ($result)
        {
            echo "<script>alert('Password Reset Successfully...')</script>";
        }
        else 
        {
            echo 'The record was not inserted successfully because of this error' . mysqli_error($con);
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="password.css">
	<link rel="stylesheet" type="text/css" href="form_theme.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
	<title>Login Form</title>
	<!-- website logo -->
    <link rel="icon" href="img\weblogo1.ico" type="image/icon">
</head>
<body>

	<!-- Login Form -->

	<div class="login-form">
		<div class="form-box">
			<div class="form-top">
				<span class="close-form"> &nbsp;</span>
			</div>
			<ul class="form-details">
				<li class="text-center user-icon">
					<img src="img/forgotpass1.png" class="user-image text-center" alt="User Image">
					<p><h1>Recover your password</h1></p>
					<p><h4>Are you forgot your password?</h4></p>
				</li>
				<div class="text-center">
					<div style="padding: 10px;">
						<div class="form-body">
							
							<form action="#" method="POST">
								<input type="text" name="Username" placeholder="Username" required>
								<input type="email" name="Email" placeholder="E-mail" required>
								<input type="password" name="Npassword" placeholder="New Password" required>
                                <input type="password" name="Cpassword" placeholder="Confirm Password" required>
							
							<div class="btn col-6">
								<center>
								<button type="submit">Recover</button>
								<button type="reset">Reset</button>
								
							</center>
                              
								
                                
							</div>
							</form>
							
						</div>
					</div>
				</div>
				
			</ul>
		</div>
	</div>



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