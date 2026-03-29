<?php
// hide warning message
error_reporting(E_ERROR | E_PARSE);
// ------------------------------------------
session_start();
// session_start already called above
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


        <?php include "common/_navbar.php"; ?>




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

        <!-- 2. Dynamic Statistics Section -->
        <section class="modern-stats">
            <div class="stat-card">
                <h2>1M+</h2>
                <p>Citizens Served</p>
            </div>
            <div class="stat-card">
                <h2>24/7</h2>
                <p>Active Surveillance</p>
            </div>
            <div class="stat-card">
                <h2>500+</h2>
                <p>Police Stations</p>
            </div>
            <div class="stat-card">
                <h2>100%</h2>
                <p>Digital Governance</p>
            </div>
        </section>

        <!-- 3. Modern Services Grid -->
        <section class="modern-services">
            <h2 class="modern-services-header">Our Digital Services</h2>
            <div class="modern-services-grid">
                
                <a href="e-FIR.php" class="modern-service-card">
                    <img src="img/2.png" alt="e-FIR">
                    <p>e-FIR Registration</p>
                </a>

                <a href="e-application.php" class="modern-service-card">
                    <img src="img/Eapplication.png" alt="e-Application">
                    <p>Track e-Application</p>
                </a>

                <a href="Missing Person.php" class="modern-service-card">
                    <img src="img/ReportMissingPerson.png" alt="Missing Person">
                    <p>Report Missing Person</p>
                </a>

                <a href="Senior Citizen Registration.php" class="modern-service-card">
                    <img src="img/SeniorRegi.png" alt="Senior Citizen">
                    <p>Senior Citizen Care</p>
                </a>

            </div>
            
            <!-- News & Announcement -->
            <div style="text-align: center; margin-top: 3rem;">
                <a href="News.php" class="modern-news-btn">Latest News & Announcements</a>
            </div>
        </section>

        <!-- 4. Virtual Tour -->
        <section class="modern-tour">
            <h2 class="modern-tour-header">Experience Digital Patrol</h2>
            <div class="modern-tour-grid">
                
                <div class="modern-tour-card">
                    <img src="img/Ahemdabad.jpg" alt="Ahemdabad">
                    <h3>Ahmedabad City</h3>
                </div>

                <div class="modern-tour-card">
                    <img src="img/Amreli.jpg" alt="Amreli">
                    <h3>Amreli District</h3>
                </div>

                <div class="modern-tour-card">
                    <img src="img/surat.jpg" alt="Surat">
                    <h3>Surat Metropolitan</h3>
                </div>

            </div>
        </section>

        <!-- 5. Modern Partner Logos -->
        <section class="modern-partners-header">Official Portals</section>
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



    <?php include "common/_footer.php"; ?>



    <script src="script.js"></script>



</body>

</html>