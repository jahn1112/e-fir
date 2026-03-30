<?php

session_start();
//print_r($_SESSION);
$done = false ;
if ($_SESSION["lg"] == false) {
    header("location:..\login.php");
} else {
    $rno = $_GET["rno"];

    if (!isset($rno) || $rno == null) {
        header('location:..\e-app.php');
    } 

    // retrive data from database table
    include '..\common\dbconfig.php';
    // $rno = $_GET['rno'];

    $qry = "SELECT * FROM `e_application_table` e LEFT JOIN user_master u ON e.user_id = u.user_id LEFT JOIN police_station_table as ps ON e.police_station_id = ps.police_station_id WHERE e_application_id = $rno;";
    $result = mysqli_query($con, $qry);
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            // user data
            $firstname = $row['user_fname'];
            $middlename = $row['user_mname'];
            $lastname = $row['user_lname'];
            $uaddress = $row['address'];
            $email = $row['user_email'];
            $mobile = $row['contact_no'];
            $pincode = $row['pincode'];

            $occurence_address = $row['occurance_address'];
            $apptype = $row['application_type'];
            $occurance_date = $row['occurance_date'];
            $occurance_time = $row['occurance_time'];
            $desc = $row['brief_desc'];
            $policestation = $row['ps_name'];
            $sbmt_date = $row['sbmt_date'];
        }
    }

    // Update Actions 
    // 

    if (isset($_POST['actionn'])) {
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $action_tkn = $_POST['takeaction'];
            // echo "cdcmlm";
            $rno = $_GET["rno"];
            // $action_tknBY = $_POST['action_by'];
            $remark = $_POST['action_remark'];
            
            // echo "callled";
            $qry = "UPDATE `e_application_table` SET `action_taken` = '".$action_tkn."', `Remarks_act` = '".$remark."', `action_takenBY` = '".$_SESSION["user"] ." (PSO)' WHERE `e_application_id` = ".$rno.";";
            $res = mysqli_query($con,$qry);
       
            if($res > 0)
            {
                $done = true;
                // echo "update";
                $_GET['rno'] = null;
                if (!isset($rno) || $rno == null) {
                    header('location:..\e-app.php');
                } 
            }
        }
    }
}






?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Application Details | Police Admin</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- CSS Dependencies -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <link rel="stylesheet" href="../css/modern_admin.css">

    <style>
        .detail-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 30px;
            transition: all 0.3s ease;
        }

        .section-title {
            color: var(--accent-cyan);
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            font-size: 1.1rem;
        }

        .section-title i {
            margin-right: 15px;
            font-size: 1.4rem;
        }

        .info-group {
            margin-bottom: 20px;
        }

        .info-label {
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 5px;
            display: block;
        }

        .info-value {
            color: white;
            font-weight: 500;
            font-size: 1.05rem;
            background: rgba(255, 255, 255, 0.05);
            padding: 10px 15px;
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            width: 100%;
            display: block;
        }

        textarea.info-value {
            min-height: 100px;
        }

        .action-card {
            background: linear-gradient(135deg, rgba(8, 145, 178, 0.1) 0%, rgba(2, 132, 199, 0.1) 100%);
            border: 1px solid var(--border-light);
        }

        .form-control:disabled {
            background-color: transparent;
            color: white;
            opacity: 1;
        }

        .badge-status {
            padding: 8px 16px;
            border-radius: 30px;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            font-size: 0.75rem;
        }

        .hero-banner {
            background: linear-gradient(rgba(10, 25, 47, 0.8), rgba(10, 25, 47, 0.8)), 
                        url('../img/police_bg.jpg') no-repeat center center;
            background-size: cover;
            border-radius: 24px;
            padding: 40px;
            margin-bottom: 40px;
            border: 1px solid var(--border-light);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .hero-banner h1 {
            font-weight: 800;
            margin: 0;
            font-size: 2.2rem;
            background: linear-gradient(to right, #fff, var(--accent-cyan));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero-banner p {
            color: rgba(255, 255, 255, 0.7);
            margin: 10px 0 0 0;
            font-size: 1.1rem;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?php include '../common/_navbar.php'; ?>

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Application Investigation</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="../index.php">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="../e-app.php">E-Applications</a></li>
                                <li class="breadcrumb-item active">Investigation</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid">
                    
                    <div class="hero-banner">
                        <div>
                            <?php $year = date('Y', strtotime($sbmt_date ?? 'now')); ?>
                            <h1>Application #GJEAPP<?php echo $year . sprintf('%04d', $rno); ?></h1>
                            <p><?php echo $apptype; ?> - Filed on <?php echo date('M d, Y', strtotime($occurance_date)); ?></p>
                        </div>
                        <div class="text-right">
                            <button onclick="window.print()" class="btn btn-outline-info mr-2">
                                <i class="fas fa-print mr-2"></i>Print Report
                            </button>
                            <a href="../e-app.php" class="btn btn-secondary">
                                <i class="fas fa-arrow-left mr-2"></i>Back to List
                            </a>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Applicant Details -->
                        <div class="col-lg-12">
                            <div class="detail-card">
                                <h3 class="section-title"><i class="fas fa-user-circle"></i> Applicant Profile</h3>
                                <div class="row">
                                    <div class="col-md-4 info-group">
                                        <label class="info-label">Full Name</label>
                                        <div class="info-value"><?php echo $firstname . " " . $middlename . " " . $lastname; ?></div>
                                    </div>
                                    <div class="col-md-4 info-group">
                                        <label class="info-label">Email Address</label>
                                        <div class="info-value"><?php echo $email; ?></div>
                                    </div>
                                    <div class="col-md-4 info-group">
                                        <label class="info-label">Mobile Number</label>
                                        <div class="info-value">+91 <?php echo $mobile; ?></div>
                                    </div>
                                    <div class="col-lg-8 col-md-12 info-group">
                                        <label class="info-label">Permanent Address</label>
                                        <div class="info-value"><?php echo $uaddress; ?></div>
                                    </div>
                                    <div class="col-md-4 info-group">
                                        <label class="info-label">Pincode</label>
                                        <div class="info-value"><?php echo $pincode; ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Incident Details -->
                        <div class="col-lg-8">
                            <div class="detail-card">
                                <h3 class="section-title"><i class="fas fa-exclamation-triangle"></i> Incident Information</h3>
                                <div class="row">
                                    <div class="col-md-6 info-group">
                                        <label class="info-label">Type of Application</label>
                                        <div class="info-value"><?php echo $apptype; ?></div>
                                    </div>
                                    <div class="col-md-6 info-group">
                                        <label class="info-label">Police Station Jurisdiction</label>
                                        <div class="info-value"><?php echo $policestation; ?></div>
                                    </div>
                                    <div class="col-md-6 info-group">
                                        <label class="info-label">Occurrence Date & Time</label>
                                        <div class="info-value">
                                            <i class="far fa-calendar-alt mr-2"></i><?php echo date('d M Y', strtotime($occurance_date)); ?> 
                                            <i class="far fa-clock ml-3 mr-2"></i><?php echo $occurance_time; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6 info-group">
                                        <label class="info-label">Location Status</label>
                                        <div class="info-value">Gujarat, India</div>
                                    </div>
                                    <div class="col-12 info-group">
                                        <label class="info-label">Specific Occurrence Area</label>
                                        <div class="info-value"><?php echo $occurence_address; ?></div>
                                    </div>
                                    <div class="col-12 info-group">
                                        <label class="info-label">Brief Description of Incident</label>
                                        <div class="info-value" style="min-height: 150px; line-height: 1.6;">
                                            <?php echo nl2br($desc); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Investigative Action -->
                        <div class="col-lg-4">
                            <div class="detail-card action-card">
                                <h3 class="section-title"><i class="fas fa-gavel"></i> Investigative Action</h3>
                                <form action="" method="POST">
                                    <div class="form-group">
                                        <label class="info-label">Update Status</label>
                                        <select class="form-control modern-input" name="takeaction" required>
                                            <option value="" disabled selected>Select Action...</option>
                                            <option value="Approved">Approve Application</option>
                                            <option value="Under Scrutiny">Move to Scrutiny</option>
                                            <option value="Rejected">Reject Application</option>
                                        </select>
                                    </div>
                                    
                                    <div class="form-group mt-4">
                                        <label class="info-label">Investigator Remarks</label>
                                        <textarea class="form-control modern-input" name="action_remark" 
                                                  placeholder="Provide detailed investigative remarks..." 
                                                  rows="5" required></textarea>
                                    </div>

                                    <div class="form-group mb-0 mt-4">
                                        <label class="info-label">Action Performed By</label>
                                        <div class="info-value" style="background: rgba(0,0,0,0.2);">
                                            <?php echo $_SESSION["user"] . " (PSO)"; ?>
                                        </div>
                                    </div>

                                    <button type="submit" name="actionn" class="btn btn-cyan btn-block mt-4 py-3">
                                        <i class="fas fa-check-circle mr-2"></i>SUBMIT INVESTIGATION
                                    </button>
                                </form>
                            </div>

                            <div class="detail-card mt-4" style="background: rgba(8, 145, 178, 0.05);">
                                <h3 class="section-title" style="font-size: 0.9rem;"><i class="fas fa-info-circle"></i> Admin Note</h3>
                                <p style="color: rgba(255,255,255,0.6); font-size: 0.85rem; line-height: 1.5;">
                                    Updating the status will immediately notify the citizen and trigger relevant administrative processes. Ensure all remarks are professional and legally compliant.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <?php include '../common/_footer.php'; ?>
    </div>

    <!-- Scripts -->
    <script src="../common/myJS/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../dist/js/adminlte.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?php if($done): ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Action recorded successfully',
            text: 'The application status has been updated.',
            background: '#0f172a',
            color: '#fff',
            confirmButtonColor: '#0891b2'
        }).then(function() {
            window.location = '../e-app.php';
        });
    </script>
    <?php endif; ?>
</body>

</html>