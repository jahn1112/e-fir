<?php
session_start();
include "DBconfig.php";
//print_r($_SESSION);
if ($_SESSION["login"] == false) {
    // if not login redirect page with message
    echo "<script>
            alert('You Are Not Eligible For This Service , Please Sign in !');
            window.location.href='./index.php';
            </script>";
}
//logged user details from database
$uqry = "select user_fname,user_mname,user_lname,user_email,user_dob,rt.religion_name,um.contact_no,um.address,um.pincode from user_master um LEFT join religion_table rt on um.religion_id=rt.religion_id where `user_id`= " . $_SESSION["userid"] . ";";
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
// File_Name

if (isset($_POST['sbmt'])) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // echo "called";
        $userid = $_SESSION["userid"];
        // $Firstname = $_POST['First_name'];
        // $FatherName = $_POST['Father_Name'];
        // $Surname = $_POST['Surname'];
        // $PermanentAddress = $_POST['Permanent_Address'];
        // $Emailaddress = $_POST['Email_address'];
        // $MobileNumber = $_POST['Mobile_Number'];
        // $LandlineNo = $_POST['Landline_No'];
        $SCFirstName = $_POST['SC_First_Name'];
        $SCFatherName = $_POST['SC_Father_Name'];
        $SCSurname = $_POST['SC_Surname'];
        $NameofCity = $_POST['name_of_City'];
        $PoliceStation = $_POST['Police_Station'];
        $YearOfRetirement = !empty($_POST['Year_Of_Retirement']) ? (int)$_POST['Year_Of_Retirement'] : 0;
        $RetiredFrom = $_POST['Retired_From'];
        $Health = $_POST['Health'];
        $Family = $_POST['Family'];
        $ResidingWith = $_POST['Residing_With'];
        $NoofChildren = !empty($_POST['No_of_Children']) ? (int)$_POST['No_of_Children'] : 0;
        $SpouseName = $_POST['Spouse_Name'] ?? '';
        $DateOfBirth = $_POST['Date_Of_Birth'] ?? '';
        $WeddingDate = $_POST['Wedding_Date'] ?? '';
        $LastPoliceVisitDate = $_POST['Last_Police_Visit_Date'] ?? '';
        $Relative_ServentDetails = $_POST['Relative_Servent_Details'] ?? '';
        $FileDesk = !empty($_POST['File_Desk']) ? (int)$_POST['File_Desk'] : 0;

        $file_name = "";
        $upload_ok = true;

        if (isset($_FILES['File_Name']) && $_FILES['File_Name']['size'] > 0) {
            $file_name = $_FILES["File_Name"]["name"];
            $file_tmp = $_FILES["File_Name"]["tmp_name"];
            $file_type = $_FILES["File_Name"]["type"];

            $target_dir = "./sc_reg_doc/";
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true);
            }

            if ($file_type == 'application/pdf' || $file_type == 'image/jpeg' || $file_type == 'image/png') {
                $res = move_uploaded_file($file_tmp, $target_dir . $file_name);
                if (!$res) {
                    $upload_ok = false;
                    echo "<script>alert('Failed to move uploaded file.')</script>";
                }
            } else {
                $upload_ok = false;
                echo "<script>alert('Incorrect file format. Only PDF, JPEG, PNG allowed.')</script>";
            }
        }

        if ($upload_ok) {
            $FileDesk_val = !empty($FileDesk) ? (int)$FileDesk : "NULL";

            $sql = "INSERT INTO `senior_citizen_reg_table` 
                    (`sc_reg_id`, `user_id`, `sc_fname`, `sc_mname`, `sc_lname`, `city_id`, `police_station_id`, `year_retirement`, `retired_institute`, `health`, `family`, `residing_with`, `no_of_child`, `spouse_name`, `dob`, `wedding_date`, `lst_plc_visit_date`, `relative_details`, `document_id`, `reg_date_time`, `doc_name`) 
                    VALUES 
                    (NULL, $userid, '$SCFirstName', '$SCFatherName', '$SCSurname', $NameofCity, $PoliceStation, $YearOfRetirement, '$RetiredFrom', '$Health', '$Family', '$ResidingWith', $NoofChildren, '$SpouseName', '$DateOfBirth', '$WeddingDate', '$LastPoliceVisitDate', '$Relative_ServentDetails', $FileDesk_val, current_timestamp(), '$file_name')";

            $result = mysqli_query($con, $sql);
            if ($result) {
                echo "<script>alert('Senior Citizen Registration Successful!')</script>";
            } else {
                echo "<script>alert('Registration Failed. Please try again.')</script>";
            }
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
    <title>Senior Citizen Registration | Gujarat Police</title>
    <link rel="icon" href="img\weblogo1.ico" type="image/icon">
    <link rel="stylesheet" href="modern_efir.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>


    <?php include "common/_navbar.php"; ?>

    <div class="main-form-container">
        <div class="page-header">
            <h1>Senior Citizen Registration</h1>
            <p>Priority Protection & Assistance Program</p>
        </div>

        <div class="glass-container">
            <form action="#" method="POST" enctype="multipart/form-data">
                
                <div class="form-section">
                    <h2 class="section-title"><i class="fas fa-user-circle"></i> Applicant Details</h2>
                    <div class="form-grid">
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" value="<?php echo $ufname; ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label>Father's/Husband's Name</label>
                            <input type="text" value="<?php echo $umname; ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label>Surname</label>
                            <input type="text" value="<?php echo $ulname; ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="email" value="<?php echo $uemail; ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label>Mobile Number</label>
                            <input type="text" value="<?php echo $ucontact; ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label>Permanent Address</label>
                            <textarea disabled style="height: 60px;"><?php echo $uaddress; ?></textarea>
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h2 class="section-title"><i class="fas fa-id-card"></i> Registration Details</h2>
                    <div class="form-grid">
                        <div class="form-group">
                            <label>SC First Name <span class="required">*</span></label>
                            <input type="text" name="SC_First_Name" required>
                        </div>
                        <div class="form-group">
                            <label>SC Father Name</label>
                            <input type="text" name="SC_Father_Name">
                        </div>
                        <div class="form-group">
                            <label>SC Surname <span class="required">*</span></label>
                            <input type="text" name="SC_Surname" required>
                        </div>
                        <div class="form-group">
                            <label>Name of City <span class="required">*</span></label>
                            <select name="name_of_City" required>
                                <option value="" hidden disabled selected>-Select-</option>
                                <option value="2">Ahmedabad City</option>
                                <option value="3">Ahmedabad Rural</option>
                                <option value="8">Surat City</option>
                                <option value="9">Vadodara City</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Police Station <span class="required">*</span></label>
                            <select name="Police_Station" required>
                                <option value="" hidden disabled selected>-Select-</option>
                                <option value="1">Kalupur</option>
                                <option value="2">Bapunagar</option>
                                <option value="10">Vastrapur</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Year of Retirement</label>
                            <input type="number" name="Year_Of_Retirement" min="1950" max="2024">
                        </div>
                        <div class="form-group">
                            <label>Retired From</label>
                            <input type="text" name="Retired_From">
                        </div>
                        <div class="form-group">
                            <label>Health Status</label>
                            <select name="Health">
                                <option value="Good">Good</option>
                                <option value="Bad">Need Special Care</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Family Type</label>
                            <select name="Family">
                                <option value="Joint">Joint Family</option>
                                <option value="Nuclear">Nuclear Family</option>
                                <option value="Single">Living Single</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Residing With</label>
                            <select name="Residing_With">
                                <option value="Alone">Alone</option>
                                <option value="Spouse">With Spouse</option>
                                <option value="Children">With Children</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>No. of Children</label>
                            <input type="number" name="No_of_Children" min="0">
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h2 class="section-title"><i class="fas fa-heart"></i> Spouse & Other Details</h2>
                    <div class="form-grid">
                        <div class="form-group">
                            <label>Spouse Name</label>
                            <input type="text" name="Spouse_Name">
                        </div>
                        <div class="form-group">
                            <label>Spouse DOB</label>
                            <input type="date" name="Date_Of_Birth">
                        </div>
                        <div class="form-group">
                            <label>Wedding Date</label>
                            <input type="date" name="Wedding_Date">
                        </div>
                        <div class="form-group">
                            <label>Last Police Visit (if any)</label>
                            <input type="date" name="Last_Police_Visit_Date">
                        </div>
                        <div class="form-group">
                            <label>Regular Visitors (Servant/Tenant)</label>
                            <select name="Relative_Servent_Details">
                                <option value="" hidden disabled selected>-Select-</option>
                                <option value="None">None</option>
                                <option value="Servent">Servant</option>
                                <option value="Tenant">Tenant</option>
                                <option value="Relative">Relative</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h2 class="section-title"><i class="fas fa-paperclip"></i> Identification Attachment</h2>
                    <div class="form-grid">
                        <div class="form-group">
                            <label>Document Type</label>
                            <select name="File_Desk">
                                <option value="" hidden disabled selected>-Select-</option>
                                <option value="1">Aadhar Card</option>
                                <option value="2">Pan Card</option>
                                <option value="3">Voter ID</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Upload Document</label>
                            <input type="file" name="File_Name" accept=".pdf,.jpg,.png">
                        </div>
                    </div>
                </div>

                <div style="margin-top: 2rem; background: rgba(14, 165, 233, 0.05); padding: 1.5rem; border-radius: 12px; border: 1px solid var(--glass-border);">
                     <h4 style="color: var(--text-white); margin-bottom: 0.5rem;"><i class="fas fa-info-circle"></i> Service Disclaimer</h4>
                     <p style="font-size: 0.8rem; color: var(--text-muted);">
                        The facility of complaint on this site is purely a measure of public service. The information provided will be used for your security and well-being.
                     </p>
                     <div style="margin-top: 1rem;">
                         <input type="checkbox" id="agreeBtn" required>
                         <label for="agreeBtn" style="color: var(--text-white); margin-left: 8px;">I Agree to the Terms</label>
                     </div>
                </div>

                <div class="form-actions" style="margin-top: 3rem;">
                    <button type="submit" name="sbmt" value="sbmt" class="btn-submit">Submit Registration</button>
                    <button type="reset" class="btn-reset">Clear Form</button>
                </div>
            </form>
        </div>
    </div>

    <?php include "common/_footer.php"; ?>
</body>
</html>

</html>