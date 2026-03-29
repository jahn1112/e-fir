<?php
session_start();
if ($_SESSION["lg"] == false) {
    header("location:login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy & Terms | Admin</title>
    
    <link rel="icon" href="img\weblogo1.ico" type="image/icon">
    <!-- Google Font: Outfit & Poppins -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700&display=swap">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Theme foundations -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- Modern Admin Style Overrides -->
    <link rel="stylesheet" href="css/admin_glass.css">

    <style>
        .content-wrapper { background: transparent !important; padding: 20px; }
        .card { border-radius: 15px; overflow: hidden; }
        .tc-content { line-height: 1.8; color: var(--text-white); text-align: justify; }
        .tc-content h4 { color: var(--accent-blue); font-weight: 700; margin-top: 2rem; margin-bottom: 1rem; border-left: 4px solid var(--accent-blue); padding-left: 15px; }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Import all Navbar -->
        <?php include "common/_navbar.php"; ?>

        <!-- Content Wrapper -->
        <div class="content-wrapper p-4">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-10 offset-md-1">
                        <div class="card">
                            <div class="card-header border-0">
                                <h2 class="card-title font-weight-bold" style="font-size: 2rem;">Security Protocols & Privacy Terms</h2>
                            </div>
                            <div class="card-body tc-content">
                                <p>Home Department Govt. of Gujarat has provided Citizen Portal Android Application for the benefit of Citizens to avail online services like Application Registration, Senior Citizen Registration, Missing Person Registration, Stolen Property Registration, No Objection Certificate, etc. and provision for getting the status of their submitted applications online.</p>
                                
                                <p>All the applications submitted on Citizen Portal will be received at respective Police Station through the eGujCop Project. Respective Officer at Police Station will act according to the received application further. When you use Citizen First Mobile application, some information is collected about you for processing your application. We are committed to protecting the security of this information and safeguarding your privacy. At registration, you accepted the terms and conditions and your use of the app signifies your continued acceptance thereof. This Privacy Policy may be revised from time to time and you will be notified of all such changes.</p>

                                <h4>Copyright and Trademarks</h4>
                                <p>Unless otherwise stated, copyright and all intellectual property rights in all material presented on the Site (including but not limited to text, audio, video or graphical images), trademarks and logos appearing on this site are the property of Home Department, Government of Gujarat and are protected under applicable Indian laws. No part of our android app and website should be copied and placed on other websites. Any infringement shall be vigorously defended and pursued to the fullest extent permitted by law.</p>

                                <h4>Limited Permission to Copy</h4>
                                <p>You are permitted to print or download extracts from these pages for your personal non-commercial use only. Any copies of these pages saved to disk or any other storage medium may only be used for subsequent viewing purposes or to print extracts for personal non-commercial use. You may not (whether directly or through the use of any software program) create a database in electronic or structured manual form by regularly or systematically downloading and storing all or any part of the pages from this Site.</p>

                                <h4>Material Submitted by Users</h4>
                                <p>Certain elements of This Site will contain material submitted by users. Home Department, Government of Gujarat accepts no responsibility for the content, accuracy, and conformity to applicable laws of such material.</p>

                                <h4>Disclaimer of Warranties and Liability</h4>
                                <p>Home Department, Government of Gujarat shall not be liable, at any time for damages (including, without limitation, damages for loss of business projects, or loss of profits) arising in contract, tort or otherwise from the use of or inability to use the Site, or any of its contents, or from any action taken (or refrained from being taken) as a result of using the Site or any such contents.</p>

                                <h4>Indian Law</h4>
                                <p>The Agreement shall be governed by the laws of India. The Courts of law in the state of Gujarat shall have exclusive jurisdiction over any disputes arising under this agreement.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Import Footer -->
            <?php include "common/_footer.php"; ?>
        </div><!-- /.content-wrapper -->
    </div><!-- /.wrapper -->

    <!-- jQuery & Bootstrap -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.js"></script>
</body>
</html>