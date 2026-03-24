<?php
// hide warning message
error_reporting(E_ERROR | E_PARSE);
// ------------------------------------------
session_start();
$_SESSION['login'] == false;
// Import database connection configuration
include_once "DBconfig.php";







?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <!-- website logo -->
    <link rel="icon" href="img\weblogo1.ico" type="image/icon">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="modern_index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;600;700&display=swap">
    <!-- <script src="https://kit.fontawesome.com/a076d05399.js"></script> -->

    <!-- boostrap -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
</head>

<body>

    <section class="header">


        <nav>
            <a href="index.php" class="logo">

            </a>

            
  
            <div class="nav-links" id="navLinks">

                <ul>
                    <li class="select active"><a href="index.php"><i class="fa fa-home"></i>Home</a></li>
                    <li><a href="Form.php"><i class="fa fa-file"></i>Online Form</a></li>
                    <li><a href="Gallery.php"><i class="fa fa-image"></i>Photo Gallery</a></li>
                    <li><a href="Department.php"><i class="fa fa-star"></i>Know Home Department</a></li>

                    <li><a href="Absconder.php"><i class="fa fa-list"></i>Absconder List</a></li>
                    <li><a href="Contact.php"><i class="fa fa-mobile"></i>Contact Details</a></li>
                    <li><a href="Notice.php"><i class="fa fa-book"></i>Lookout Notice</a></li>
                    
                </ul>
                
            </div>

        </nav>

<script>

</script>

        <!-- log in / log out button -->
        <div>

        </div>

        <div class="boot">

            <?php
if ($_SESSION['login'] == false) {
    echo '
                
                <button type="button" id="bootn" style="color: aliceblue; text-decoration: none; margin-right:"><a href="login.php" style="color: white;"><i class="fa fa-key" style="margin-right: 1em;"></i>Log in/Registration</a></button>
                ';
}
else {
    echo '   <h4 id="wcmsg"> Welcome  ' . $_SESSION['userfname'] . '  ' . $_SESSION['userlname'] . '    </h4>';
    echo '
                <button type="button" id="bootn11" style="color: aliceblue; text-decoration: none;"><a href="logout.php" style="color: white;"><i class="fa fa-user" style="margin-right: 1em;"></i>Log Out</a></button>
                ';
}
?>

        </div>



        <script>
            var modal = document.getElementById("myModal");
            var btn = document.getElementById("bootn");

            var span = document.getElementsByClassName("close")[0];


            btn.onclick = function() {
                modal.style.display = "block";
            }


            span.onclick = function() {
                modal.style.display = "none";
            }


            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        </script>




        <!-- 1. Modern Hero Section -->
        <header class="modern-hero">
            <img src="img/police.png" class="police" alt="Gujarat Police Logo">
            <h1 class="citizen">CITIZEN PORTAL, GUJARAT POLICE</h1>
            <p class="home">(HOME DEPARTMENT, GOVERNMENT OF GUJARAT)</p>
        </header>

        <!-- 2. Modern Services Grid -->
        <section class="modern-services">
            <h2 class="modern-services-header">Our Services</h2>
            <div class="modern-services-grid">
                
                <a href="e-FIR.php" class="modern-service-card">
                    <img src="img/2.png" alt="e-FIR">
                    <p>e-FIR</p>
                </a>

                <a href="e-application.php" class="modern-service-card">
                    <img src="img/Eapplication.png" alt="e-Application">
                    <p>e-Application</p>
                </a>

                <a href="Missing Person.php" class="modern-service-card">
                    <img src="img/ReportMissingPerson.png" alt="Missing Person">
                    <p>Report Missing Person</p>
                </a>

                <a href="Senior Citizen Registration.php" class="modern-service-card">
                    <img src="img/SeniorRegi.png" alt="Senior Citizen">
                    <p>Senior Citizen Registration</p>
                </a>

            </div>
            
            <!-- 3. News & Announcement -->
            <div style="text-align: center;">
                <a href="News.php" class="modern-news-btn">News & Announcements</a>
            </div>
        </section>

        <!-- 4. Virtual Tour -->
        <section class="modern-tour">
            <h2 class="modern-tour-header">Take Our Virtual Tour</h2>
            <div class="modern-tour-grid">
                
                <div class="modern-tour-card">
                    <img src="img/Ahemdabad.jpg" alt="Ahemdabad">
                    <h3>Ahemdabad</h3>
                </div>

                <div class="modern-tour-card">
                    <img src="img/Amreli.jpg" alt="Amreli">
                    <h3>Amreli</h3>
                </div>

                <div class="modern-tour-card">
                    <img src="img/surat.jpg" alt="Surat">
                    <h3>Surat</h3>
                </div>

            </div>
        </section>

        <!-- 5. Modern Partner Logos -->
        <section class="modern-partners-header">Information For The Public</section>
        <div class="modern-partners">
            <a href="https://police.gujarat.gov.in/dgp/default.aspx" target="_blank">
                <img src="img/GujaratPolice.jpg" alt="Gujarat Police">
            </a>
            <a href="https://gujaratindia.gov.in" target="_blank">
                <img src="img/gujarat-india.jpg" alt="Gujarat India">
            </a>
            <a href="https://www.mha.gov.in" target="_blank">
                <img src="img/MHA.jpg" alt="MHA">
            </a>
            <a href="https://www.digitalgujarat.gov.in" target="_blank">
                <img src="img/DigitalGujarat.jpg" alt="Digital Gujarat">
            </a>
            <a href="https://www.nic.in" target="_blank">
                <img src="img/NIC.jpg" alt="NIC">
            </a>
            <a href="https://digitalpolice.gov.in" target="_blank">
                <img src="img/DigitalPolice.jpg" alt="Digital Police">
            </a>
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


    <script src="script.js"></script>



</body>

</html>

</html>