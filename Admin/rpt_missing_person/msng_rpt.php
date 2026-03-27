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

    $qry = "SELECT *,rpt.pincode as pin FROM `report_missing_person_table` rpt LEFT OUTER JOIN user_master um on um.user_id = rpt.user_id LEFT OUTER JOIN religion_table rt on rt.religion_id = rpt.religion_id LEFT OUTER JOIN document_table dt on dt.document_id = rpt.document_id LEFT OUTER JOIN police_station_table pst on pst.police_station_id = rpt.police_station_id where rpt.Report_Missing_Person_id = $rno;";
    $result = mysqli_query($con, $qry);
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            // user data
        // $userid = $_SESSION["userid"];
        $uFirstname = $row['user_fname'];
        $uFatherName = $row['user_mname'];
        $usurname = $row['user_lname'];
        $PermanentAddress = $row['address'];
        $Emailaddress = $row['user_email'];
        $MobileNumber = $row['contact_no'];
        $LandlineNo = "";

        $MissingPersonFirstname = $row['first_name'];
        $MissingPersonFathername = $row['middle_name'];
        $MissingPersonSurname = $row['surname'];
        $DateOfBirth = $row['dob'];
        $Gender = $row['gender'];
        $Missingdate = $row['missing_date'];
        $MissingTime = $row['missing_time'];
        $Religion = $row['religion_name'];
        $Caste = $row['caste'];
        $Category = $row['category'];
        $Occupation = $row['occupation'];
        $Height = $row['height(cm)'];
        $Weight = $row['weight(kgs)'];
        $MissingPersonDescription = $row['missing_person_description'];
        // $Country = $row['Country'];
        // $State = $row['State'];
    
      
        $PlaceOfMissingPinCode = $row['pin'];
    
        $PlaceOfMissingArea = $row['area'];
       
        $PoliceStation = $row['ps_name'];
        $BriefDescription = $row['brief_description'];
        $DocumentType = $row['doc_type'];
        // print_r( $row );
        // $UploadDocument = $row['Upload_Document'];
        }
    }

    // Update Actions 
    // 

    if (isset($_POST['actionn'])) {
        // echo "OK";
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $action_tkn = $_POST['takeaction'];
            // echo "cdcmlm";
            $rno = $_GET["rno"];
            // $action_tknBY = $_POST['action_by'];
            $remark = $_POST['action_remark'];
            
            // echo "callled";
            $qry = "UPDATE `report_missing_person_table` SET `action_taken` = '".$action_tkn."', `Remarks_act` = '".$remark."', `action_takenBY` = '".$_SESSION["user"] ." (PSO)' WHERE `Report_Missing_Person_id` = ".$rno.";";
            $res = mysqli_query($con,$qry);
       
            if($res > 0)
            {
                $done = true;
                // echo "update";
                $_GET['rno'] = null;
                
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
    <title>Missing Person Investigation | Police Admin</title>

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

        .action-card {
            background: linear-gradient(135deg, rgba(8, 145, 178, 0.1) 0%, rgba(2, 132, 199, 0.1) 100%);
            border: 1px solid var(--border-light);
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
                            <h1 class="m-0">Missing Person Investigation</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="../index.php">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="../rpt_missing_person.php">Missing Reports</a></li>
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
                            <h1>Case #<?php echo $rno; ?>: <?php echo $MissingPersonFirstname . " " . $MissingPersonSurname; ?></h1>
                            <p>Missing since <?php echo date('M d, Y', strtotime($Missingdate)); ?> | Filed by <?php echo $uFirstname . " " . $usurname; ?></p>
                        </div>
                        <div class="text-right">
                            <button onclick="window.print()" class="btn btn-outline-info mr-2">
                                <i class="fas fa-print mr-2"></i>Print Dossier
                            </button>
                            <a href="../rpt_missing_person.php" class="btn btn-secondary">
                                <i class="fas fa-arrow-left mr-2"></i>Back to List
                            </a>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Missing Person Identity -->
                        <div class="col-lg-12">
                            <div class="detail-card">
                                <h3 class="section-title"><i class="fas fa-id-card"></i> Person Identity & Physicality</h3>
                                <div class="row">
                                    <div class="col-md-3 info-group">
                                        <label class="info-label">Full Name</label>
                                        <div class="info-value"><?php echo $MissingPersonFirstname . " " . $MissingPersonFathername . " " . $MissingPersonSurname; ?></div>
                                    </div>
                                    <div class="col-md-3 info-group">
                                        <label class="info-label">Gender</label>
                                        <div class="info-value"><?php echo $Gender; ?></div>
                                    </div>
                                    <div class="col-md-3 info-group">
                                        <label class="info-label">Date of Birth</label>
                                        <div class="info-value"><?php echo date('d M Y', strtotime($DateOfBirth)); ?></div>
                                    </div>
                                    <div class="col-md-3 info-group">
                                        <label class="info-label">Religion / Caste</label>
                                        <div class="info-value"><?php echo $Religion . " (" . $Caste . ")"; ?></div>
                                    </div>
                                    
                                    <div class="col-md-2 info-group">
                                        <label class="info-label">Height</label>
                                        <div class="info-value"><?php echo $Height; ?> cm</div>
                                    </div>
                                    <div class="col-md-2 info-group">
                                        <label class="info-label">Weight</label>
                                        <div class="info-value"><?php echo $Weight; ?> kg</div>
                                    </div>
                                    <div class="col-md-3 info-group">
                                        <label class="info-label">Occupation</label>
                                        <div class="info-value"><?php echo $Occupation; ?></div>
                                    </div>
                                    <div class="col-md-5 info-group">
                                        <label class="info-label">Physical Description</label>
                                        <div class="info-value"><?php echo $MissingPersonDescription; ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Incident & Applicant -->
                        <div class="col-lg-8">
                            <div class="detail-card">
                                <h3 class="section-title"><i class="fas fa-clock"></i> Disappearance Details</h3>
                                <div class="row">
                                    <div class="col-md-6 info-group">
                                        <label class="info-label">Last Seen Date & Time</label>
                                        <div class="info-value">
                                            <i class="far fa-calendar-alt mr-2"></i><?php echo date('d M Y', strtotime($Missingdate)); ?> 
                                            <i class="far fa-clock ml-3 mr-2"></i><?php echo $MissingTime; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6 info-group">
                                        <label class="info-label">Police Station Jurisdiction</label>
                                        <div class="info-value"><?php echo $PoliceStation; ?></div>
                                    </div>
                                    <div class="col-12 info-group">
                                        <label class="info-label">Last Known Location / Area</label>
                                        <div class="info-value"><?php echo $PlaceOfMissingArea . ", Ahmedabad, Gujarat"; ?></div>
                                    </div>
                                    <div class="col-12 info-group">
                                        <label class="info-label">Incident Briefing</label>
                                        <div class="info-value" style="min-height: 120px; line-height: 1.6;">
                                            <?php echo nl2br($BriefDescription); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="detail-card">
                                <h3 class="section-title"><i class="fas fa-user-shield"></i> Complainant Information</h3>
                                <div class="row">
                                    <div class="col-md-4 info-group">
                                        <label class="info-label">Name</label>
                                        <div class="info-value"><?php echo $uFirstname . " " . $usurname; ?></div>
                                    </div>
                                    <div class="col-md-4 info-group">
                                        <label class="info-label">Contact</label>
                                        <div class="info-value">+91 <?php echo $MobileNumber; ?></div>
                                    </div>
                                    <div class="col-md-4 info-group">
                                        <label class="info-label">Relation / Document</label>
                                        <div class="info-value"><?php echo $DocumentType; ?></div>
                                    </div>
                                    <div class="col-12 info-group">
                                        <label class="info-label">Address</label>
                                        <div class="info-value"><?php echo $PermanentAddress; ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Active Investigation -->
                        <div class="col-lg-4">
                            <div class="detail-card action-card">
                                <h3 class="section-title"><i class="fas fa-search"></i> Investigative Update</h3>
                                <form action="" method="POST">
                                    <div class="form-group">
                                        <label class="info-label">Investigation Status</label>
                                        <select class="form-control modern-input" name="takeaction" required>
                                            <option value="" disabled selected>Update Status...</option>
                                            <option value="Approved">Verified (Active Search)</option>
                                            <option value="Under Scrutiny">Pending Verification</option>
                                            <option value="Rejected">Rejected/Invalid</option>
                                        </select>
                                    </div>
                                    
                                    <div class="form-group mt-4">
                                        <label class="info-label">Officer's Remarks</label>
                                        <textarea class="form-control modern-input" name="action_remark" 
                                                  placeholder="Detail the search progress or verification steps..." 
                                                  rows="5" required></textarea>
                                    </div>

                                    <div class="form-group mb-0 mt-4">
                                        <label class="info-label">Updating Officer</label>
                                        <div class="info-value" style="background: rgba(0,0,0,0.2);">
                                            <?php echo $_SESSION["user"] . " (PSO)"; ?>
                                        </div>
                                    </div>

                                    <button type="submit" name="actionn" class="btn btn-cyan btn-block mt-4 py-3">
                                        <i class="fas fa-sync-alt mr-2"></i>UPDATE CASE FILE
                                    </button>
                                </form>
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
            title: 'Investigation Updated',
            text: 'Case file has been successfully synchronized.',
            background: '#0f172a',
            color: '#fff',
            confirmButtonColor: '#0891b2'
        }).then(function() {
            window.location = '../rpt_missing_person.php';
        });
    </script>
    <?php endif; ?>
</body>

</html>