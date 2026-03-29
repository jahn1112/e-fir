<?php
session_start();
include "DBconfig.php";

if (!isset($_SESSION["login"]) || $_SESSION["login"] == false) {
    echo "<script>
            alert('You Are Not Eligible For This Service , Please Sign in !');
            window.location.href='./index.php';
            </script>";
    exit();
}

$uqry = "select user_fname,user_mname,user_email,user_lname,user_dob,rt.religion_name,um.contact_no,um.address,um.pincode from user_master um LEFT join religion_table rt on um.religion_id=rt.religion_id where `user_id`= " . $_SESSION["userid"] . ";";
$uinfo = mysqli_query($con, $uqry);
while ($urow = mysqli_fetch_assoc($uinfo)) {
    $ufname = $urow['user_fname'];
    $umname = $urow['user_mname'];
    $ulname = $urow['user_lname'];
    $uemail = $urow['user_email'];
    $uDOB = $urow['user_dob'];
    $ureligion = $urow['religion_name'];
    $ucontact = $urow['contact_no'];
    $uaddress = $urow['address'];
    $upincode = $urow['pincode'];
}

if (isset($_POST['sbmtt'])) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $userid = $_SESSION["userid"];
        $country = mysqli_real_escape_string($con, $_POST['Country'] ?? '');
        $state = mysqli_real_escape_string($con, $_POST['State'] ?? '');
        $Pincode = mysqli_real_escape_string($con, $_POST['Pin_Code'] ?? '');
        $Citydistrict = mysqli_real_escape_string($con, $_POST['City_District'] ?? '');
        $Occuranceaddress = mysqli_real_escape_string($con, $_POST['Occurance_Address'] ?? '');
        $Applicationdetails = mysqli_real_escape_string($con, $_POST['Application_Details'] ?? '');
        $Policestation = mysqli_real_escape_string($con, $_POST['Police_Station'] ?? '');
        $Occurancedate = mysqli_real_escape_string($con, $_POST['Occurance_Date'] ?? '');
        $Occurancetime = mysqli_real_escape_string($con, $_POST['Occurance_Time'] ?? '');
        $brief = mysqli_real_escape_string($con, $_POST['Brief'] ?? '');
        $document = mysqli_real_escape_string($con, $_POST['Document'] ?? '');

        $file_uploaded = false;
        $file_name_final = "";
        
        if (isset($_FILES['upldfile']) && $_FILES['upldfile']['error'] == 0) {
            $file_name = $_FILES["upldfile"]["name"];
            $file_tmp = $_FILES["upldfile"]["tmp_name"];
            $file_type = $_FILES["upldfile"]["type"];

            if (in_array($file_type, ['application/pdf', 'image/jpeg', 'image/png'])) {
                if (!is_dir("./e_app_doc")) { mkdir("./e_app_doc", 0777, true); }
                if (move_uploaded_file($file_tmp, "./e_app_doc/" . $file_name)) {
                    $file_uploaded = true;
                    $file_name_final = $file_name;
                }
            }
        }

        // Handle submission regardless of file if file is optional, but here we enforce file per legacy logic
        if ($file_uploaded || empty($_FILES['upldfile']['name'])) {
            $sql = "INSERT INTO `e_application_table` (`e_application_id`, `user_id`, `occurance_address`, `pincode`, `police_station_id`, `application_type`, `occurance_date`, `occurance_time`, `brief_desc`, `document_id`,  `sbmt_date`, `file_name`) VALUES (NULL, '" . $userid . "', '" . $Occuranceaddress . "', '" . $Pincode . "', '" . $Policestation . "', '" . $Applicationdetails . "', '" . $Occurancedate . "', '" . $Occurancetime . "', '" . $brief . "', '" . $document . "', current_timestamp(), '$file_name_final');";
            $result = mysqli_query($con, $sql);

            if ($result) {
                $appId = mysqli_insert_id($con);
                echo "<script>alert('e-Application Submitted Successfully! Reference: GJEAPP202300" . $appId . "'); window.location.href='index.php';</script>";
            } else {
                echo "<script>alert('Error: " . mysqli_error($con) . "')</script>";
            }
        } else {
            echo "<script>alert('Please upload a valid document (PDF/JPG/PNG)')</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Application | Gujarat Police</title>
    <link rel="icon" href="img\weblogo1.ico" type="image/icon">
    <link rel="stylesheet" href="modern_efir.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>

    <?php include "common/_navbar.php"; ?>


    <div class="main-form-container">
        <div class="page-header">
            <h1>General Services</h1>
            <p>Non-Emergency E-Application Portal</p>
        </div>

        <form action="#" method="POST" enctype="multipart/form-data">
            
            <div class="form-section">
                <h2 class="section-title"><i class="fas fa-id-card"></i> Applicant Identity</h2>
                <div class="form-grid">
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" value="<?php echo $ufname . ' ' . $ulname; ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="text" value="<?php echo $uemail; ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label>Primary Contact</label>
                        <input type="text" value="<?php echo $ucontact; ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label>Permanent Address</label>
                        <textarea disabled style="height: 60px;"><?php echo $uaddress; ?></textarea>
                    </div>
                </div>
            </div>

            <div class="form-section">
                <h2 class="section-title"><i class="fas fa-bullhorn"></i> Complaint Details</h2>
                <div class="form-grid">
                    <div class="form-group">
                        <label>Application Type <span class="required">*</span></label>
                        <select name="Application_Details" required>
                             <option value="">-Select-</option>
                             <option value="Application">General Application</option>
                             <option value="Information">Public Information</option>
                             <option value="Cyber Crime">Cyber Crime Report</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>City/District <span class="required">*</span></label>
                        <select name="City_District" required>
                             <option value="">-Select-</option>
                             <option value="1">Ahmedabad City</option>
                             <option value="2">Surat City</option>
                             <option value="3">Vadodara City</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Target Police Station <span class="required">*</span></label>
                        <select name="Police_Station" required>
                             <option value="">-Select Branch-</option>
                             <option value="1">Kalupur</option>
                             <option value="2">Bapunagar</option>
                             <option value="10">Vastrapur</option>
                             <option value="15">Adajan (Surat)</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Incident Date <span class="required">*</span></label>
                        <input type="date" name="Occurance_Date" required>
                    </div>
                    <div class="form-group">
                        <label>Occurrence Address <span class="required">*</span></label>
                        <textarea name="Occurance_Address" placeholder="Street, Landmark, City..." required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Brief Narrative <span class="required">*</span></label>
                        <textarea name="Brief" placeholder="Summarize your concern (max 300 chars)" maxlength="300" required></textarea>
                    </div>
                </div>
            </div>

            <div class="form-section">
                <h2 class="section-title"><i class="fas fa-paperclip"></i> Documentation</h2>
                <div class="form-grid">
                    <div class="form-group">
                        <label>Document Identity Type <span class="required">*</span></label>
                        <select name="Document" required>
                             <option value="">-Select-</option>
                             <option value="1">Aadhar Card</option>
                             <option value="2">Pan Card</option>
                             <option value="3">Voter ID</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Upload Secure Copy <span class="required">*</span></label>
                        <input type="file" name="upldfile" accept=".pdf,.jpg,.png" required>
                        <span style="font-size: 0.75rem; color: var(--accent-blue);">Supported: PDF, JPG, PNG only</span>
                    </div>
                </div>

                <div style="margin-top: 2rem; background: rgba(14, 165, 233, 0.05); padding: 1.5rem; border-radius: 12px; border: 1px solid var(--glass-border);">
                     <h4 style="color: var(--text-white); margin-bottom: 0.5rem;"><i class="fas fa-info-circle"></i> Service Disclaimer</h4>
                     <p style="font-size: 0.8rem; color: var(--text-muted);">
                        This facility is a measure of public service and cannot be treated as a First Information Report (FIR) under CrPC. 
                        False reports or misuse of this portal will lead to legal action under relevant laws of India.
                     </p>
                     <div style="margin-top: 1rem;">
                         <input type="checkbox" id="agreeBtn" required>
                         <label for="agreeBtn" style="color: var(--text-white); margin-left: 8px;">I acknowledge and agree to the terms.</label>
                     </div>
                </div>
            </div>

            <div class="form-actions" style="margin-top: 3rem;">
                <button type="submit" name="sbmtt" class="btn-submit">Dispatch Application</button>
            </div>
        </form>
    </div>

    <?php include "common/_footer.php"; ?>
</body>
</html>