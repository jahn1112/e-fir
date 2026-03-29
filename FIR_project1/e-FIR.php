<?php
session_start();
include "DBconfig.php";
//print_r($_SESSION);
$alertmsg = false;
$docalert = false;
if (!isset($_SESSION["login"]) || $_SESSION["login"] == false) {
    // if not login redirect page with message
    echo "<script>
            alert('You Are Not Eligible For This Service , Please Sign in !');
            window.location.href='./index.php';
            </script>";
    exit();
}

//logged user details from database
$uqry = "select user_fname,user_mname,user_lname,user_dob,rt.religion_name,um.contact_no,um.address,um.pincode from user_master um LEFT join religion_table rt on um.religion_id=rt.religion_id where `user_id`= " . $_SESSION["userid"] . ";";
$uinfo = mysqli_query($con, $uqry);
while ($urow = mysqli_fetch_assoc($uinfo)) {
    $ufname = $urow['user_fname'];
    $umname = $urow['user_mname'];
    $ulname = $urow['user_lname'];
    $uDOB = $urow['user_dob'];
    $ureligion = $urow['religion_name'];
    $ucontact = $urow['contact_no'];
    $uaddress = $urow['address'];
    $upincode = $urow['pincode'];
}

if (isset($_POST['submit'])) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $userid = $_SESSION["userid"];
        $occupation = mysqli_real_escape_string($con, $_POST['occupation'] ?? '');
        $Datefrom = mysqli_real_escape_string($con, $_POST['Date_from'] ?? '');
        $Dateto = mysqli_real_escape_string($con, $_POST['Date_to'] ?? '');
        $Timefrom = mysqli_real_escape_string($con, $_POST['Time_from'] ?? '');
        $Timeto = mysqli_real_escape_string($con, $_POST['Time_to'] ?? '');
        $Distancestation = mysqli_real_escape_string($con, $_POST['Distance_station'] ?? '');
        $Occurance_Address = mysqli_real_escape_string($con, $_POST['Occurance_Address'] ?? '');
        $Occurance_pincode = mysqli_real_escape_string($con, $_POST['Occurance_pincode'] ?? '');
        $Policestation = mysqli_real_escape_string($con, $_POST['Police_station'] ?? '');
        $BriefDesc = mysqli_real_escape_string($con, $_POST['Brief_Desc'] ?? '');
        $delayed_reason = mysqli_real_escape_string($con, $_POST['delayed_reason'] ?? '');
        $Typetheft = mysqli_real_escape_string($con, $_POST['radiobtn'] ?? '');

        // Use Dateto/Timeto for From fields if they are missing
        $Datefrom_final = !empty($Datefrom) ? $Datefrom : $Dateto;
        $Timefrom_final = !empty($Timefrom) ? $Timefrom : $Timeto;

        // Handle Delay Upload
        $delay_file_path = "";
        if (isset($_FILES['delayupload']) && $_FILES['delayupload']['error'] == 0) {
            $delay_file_name = $_FILES["delayupload"]["name"];
            $delay_file_tmp = $_FILES["delayupload"]["tmp_name"];
            if (!is_dir("FIR_upload_doc/delayed_reason")) {
                mkdir("FIR_upload_doc/delayed_reason", 0777, true);
            }
            if (move_uploaded_file($delay_file_tmp, "FIR_upload_doc/delayed_reason/" . $delay_file_name)) {
                $delay_file_path = $delay_file_name;
            }
        }

        // 2. Insert into e_fir_master
        $sql = "INSERT INTO `e_fir_master` (`e_fir_id`, `user_id`, `occurrance_area`, `police_station_occurance_place`, `types_of_fir_id`, `file_name`, `occurance_pincode`, `distance_from_ps`, `occurence_of_offence_date_from`, `occurence_of_offence_date_to`, `occurenece_of_offence_time_from`, `occurenece_of_offence_time_to`, `occupation`, `first_info_contents`,`delayed_reason`, `sbmt_date`) VALUES (NULL, '" . $userid . "', '" . $Occurance_Address . "', '" . $Policestation . "', '" . (empty($Typetheft) ? 3 : $Typetheft) . "', '', '" . $Occurance_pincode . "', '" . $Distancestation . "', '" . $Datefrom_final . "', '" . $Dateto . "', '" . $Timefrom_final . "', '" . $Timeto . "', '" . $occupation . "', '" . $BriefDesc . "','" . $delayed_reason . "', current_timestamp());";
        $result = mysqli_query($con, $sql);
        
        if ($result) {
            $firID = mysqli_insert_id($con);
            $final_file = "";

            // 3. Optional Stolen Section
            if ($Typetheft == 1) { // Vehicle
                if (isset($_FILES['vupload']) && $_FILES['vupload']['error'] == 0) {
                    $file_name = $_FILES["vupload"]["name"];
                    $file_tmp = $_FILES["vupload"]["tmp_name"];
                    if (!is_dir("FIR_upload_doc/vehicle_doc")) { mkdir("FIR_upload_doc/vehicle_doc", 0777, true); }
                    move_uploaded_file($file_tmp, "FIR_upload_doc/vehicle_doc/" . $file_name);
                    $final_file = $file_name;

                    $Vehicletype = mysqli_real_escape_string($con, $_POST['Vehicle_Type'] ?? '');
                    $Manufacturename = mysqli_real_escape_string($con, $_POST['Name_manufacture'] ?? '');
                    $Modelname = mysqli_real_escape_string($con, $_POST['Model_name'] ?? '');
                    $Enginenumber = mysqli_real_escape_string($con, $_POST['Engine_number'] ?? '');
                    $Chassisnumber = mysqli_real_escape_string($con, $_POST['Chassis_number'] ?? '');
                    $ApproxPriceVehicle = mysqli_real_escape_string($con, $_POST['Approx_price'] ?? '');
                    $Registernumber = mysqli_real_escape_string($con, $_POST['Register_number'] ?? '');
                    $Vehiclecolor = mysqli_real_escape_string($con, $_POST['Vehicle_color'] ?? '');
                    $ManufacturingYearVehicle = mysqli_real_escape_string($con, $_POST['Manuf_year'] ?? '');
                    $Descriptionvehicle = mysqli_real_escape_string($con, $_POST['Desc_vehicle'] ?? '');

                    $vqry = "INSERT INTO `vehicle_table` (`vehicle_id`, `e_fir_id`, `vehicle_type`, `name_of_manufacture`, `model`, `engine_number`, `chassis_number`, `vehicle_reg_number`, `color`, `manufacturing_year`, `approx_price`, `description_of_vehicle`) VALUES (NULL, '" . $firID . "', '" . $Vehicletype . "', '" . $Manufacturename . "', '" . $Modelname . "', '" . $Enginenumber . "', '" . $Chassisnumber . "', '" . $Registernumber . "', '" . $Vehiclecolor . "', '" . $ManufacturingYearVehicle . "', '" . $ApproxPriceVehicle . "', '" . $Descriptionvehicle . "');";
                    mysqli_query($con, $vqry);
                }
            } elseif ($Typetheft == 2) { // Mobile
                if (isset($_FILES['mobupload']) && $_FILES['mobupload']['error'] == 0) {
                    $file_name = $_FILES["mobupload"]["name"];
                    $file_tmp = $_FILES["mobupload"]["tmp_name"];
                    if (!is_dir("FIR_upload_doc/mobile_doc")) { mkdir("FIR_upload_doc/mobile_doc", 0777, true); }
                    move_uploaded_file($file_tmp, "FIR_upload_doc/mobile_doc/" . $file_name);
                    $final_file = $file_name;

                    $Mobilemodel = mysqli_real_escape_string($con, $_POST['Mobile_model'] ?? '');
                    $Mobilecolor = mysqli_real_escape_string($con, $_POST['Mobile_color'] ?? '');
                    $mobile_number = mysqli_real_escape_string($con, $_POST['mobile_number'] ?? '');
                    $ManufacturingYearMobile = mysqli_real_escape_string($con, $_POST['Manufacturing_year'] ?? '');
                    $IMEInumber = mysqli_real_escape_string($con, $_POST['Imei_number'] ?? '');
                    $Simcard = mysqli_real_escape_string($con, $_POST['Sim'] ?? '');
                    $ApproxPriceMobile = mysqli_real_escape_string($con, $_POST['Price'] ?? '');
                    $Descriptionmobile = mysqli_real_escape_string($con, $_POST['Desc_mobile'] ?? '');

                    $mqry = "INSERT INTO `stolen_mobile_table` (`stolen_mobile_id`, `e_fir_id`, `mobile_number`,  `model`, `imei_number`, `approx_price`, `manufacturing_year`, `service_provider`, `color`, `description_of_mobile`) VALUES (NULL, '" . $firID . "', '" . $mobile_number . "','" . $Mobilemodel . "','" . $IMEInumber . "', '" . $ApproxPriceMobile . "', '" . $ManufacturingYearMobile . "', '" . $Simcard . "', '" . $Mobilecolor . "', '" . $Descriptionmobile . "');";
                    mysqli_query($con, $mqry);
                }
            }
            
            if ($final_file != "") {
                mysqli_query($con, "UPDATE e_fir_master SET file_name = '$final_file' WHERE e_fir_id = $firID");
            }

            echo "<script>alert('Successfully Submitted! Your FIR Reference Number: GJFIR202300" . $firID . "'); window.location.href='index.php';</script>";
        } else {
            echo "<script>alert('Form submission failed: " . mysqli_error($con) . "')</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-FIR Registration | Gujarat Police</title>
    <link rel="icon" href="img\weblogo1.ico" type="image/icon">
    <link rel="stylesheet" href="modern_efir.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>

    <?php include "common/_navbar.php"; ?>


    <div class="main-form-container">
        <div class="page-header">
            <h1>Electronic F.I.R</h1>
            <p>Premium Digital Justice Portal</p>
        </div>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
            
            <!-- Section 1: Personal Details -->
            <div class="form-section">
                <h2 class="section-title"><i class="fas fa-user-shield"></i> Complainant Information</h2>
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
                        <label>Date of Birth</label>
                        <input type="text" value="<?php echo $uDOB; ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label>Occupation <span class="required">*</span></label>
                        <input type="text" name="occupation" placeholder="Your current role" required>
                    </div>
                    <div class="form-group">
                        <label>Mobile Number</label>
                        <input type="text" value="<?php echo $ucontact; ?>" disabled>
                    </div>
                </div>
            </div>

            <!-- Section 2: Incident Details -->
            <div class="form-section">
                <h2 class="section-title"><i class="fas fa-map-marker-alt"></i> Incident Details</h2>
                <div class="form-grid">
                    <div class="form-group">
                        <label>Occurrence Date <span class="required">*</span></label>
                        <input type="date" name="Date_to" required>
                    </div>
                    <div class="form-group">
                        <label>Occurrence Time <span class="required">*</span></label>
                        <input type="time" name="Time_to" required>
                    </div>
                    <div class="form-group">
                        <label>Distance from PS (approx km) <span class="required">*</span></label>
                        <input type="number" name="Distance_station" required>
                    </div>
                    <div class="form-group">
                        <label>Occurrence Pincode <span class="required">*</span></label>
                        <input type="text" name="Occurance_pincode" pattern="\d{6}" maxlength="6" required>
                    </div>
                </div>
                <div class="form-group" style="margin-top: 1.5rem;">
                    <label>Police Station (Jurisdiction) <span class="required">*</span></label>
                    <select name="Police_station" required>
                        <option value="">-Select Branch-</option>
                        <option value="AMRAIWADI POLICE STATION">AMRAIWADI POLICE STATION</option>
                        <option value="ANANDNAGAR POLICE STATION">ANANDNAGAR POLICE STATION</option>
                        <option value="BAPUNAGAR POLICE STATION">BAPUNAGAR POLICE STATION</option>
                        <option value="CHANDKHEDA POLICE STATION">CHANDKHEDA POLICE STATION</option>
                        <option value="DARIYAPUR POLICE STATION">DARIYAPUR POLICE STATION</option>
                        <option value="ELLISBRIDGE POLICE STATION">ELLISBRIDGE POLICE STATION</option>
                        <option value="VATVA POLICE STATION">VATVA POLICE STATION</option>
                        <option value="VEJALPUR POLICE STATION">VEJALPUR POLICE STATION</option>
                        <option value="SOLA POLICE STATION">SOLA POLICE STATION</option>
                        <option value="NAVRANGPURA POLICE STATION">NAVRANGPURA POLICE STATION</option>
                    </select>
                </div>
                <div class="form-group" style="margin-top: 1.5rem;">
                    <label>Brief Description of Offence <span class="required">*</span></label>
                    <textarea name="Brief_Desc" placeholder="Describe what happened in detail..." required></textarea>
                </div>
            </div>

            <!-- Section 3: Delay and Stolen Logic -->
            <div class="form-section">
                <h2 class="section-title"><i class="fas fa-file-upload"></i> Additional Declarations</h2>
                <div class="form-group">
                    <label>Reason for Delay (if any)</label>
                    <textarea name="delayed_reason" placeholder="Explain why the report is being filed after the occurrence..."></textarea>
                </div>
                <div class="form-group" style="margin-top: 1rem;">
                    <label>Upload Supporting Document (Optional)</label>
                    <input type="file" name="delayupload" accept=".pdf,.jpg,.png">
                </div>

                <div style="margin-top: 2.5rem; border-top: 1px solid var(--glass-border); padding-top: 2rem;">
                    <h3 style="color: #f87171; margin-bottom: 1.5rem;"><i class="fas fa-exclamation-triangle"></i> STOLEN ITEM REGISTRY</h3>
                    <p style="font-size: 0.85rem; color: var(--text-muted); margin-bottom: 1rem;">If the offence involve theft of Mobile or Vehicle, select below:</p>
                    
                    <div class="radio-group">
                        <div class="radio-item">
                            <input type="radio" name="radiobtn" value="2" id="mobileRadio" onclick="toggleStolenFields()">
                            <label for="mobileRadio">Mobile Device</label>
                        </div>
                        <div class="radio-item">
                            <input type="radio" name="radiobtn" value="1" id="vehicleRadio" onclick="toggleStolenFields()">
                            <label for="vehicleRadio">Motor Vehicle</label>
                        </div>
                        <div class="radio-item">
                            <input type="radio" name="radiobtn" value="3" id="noneRadio" onclick="toggleStolenFields()" checked>
                            <label for="noneRadio">None / Other</label>
                        </div>
                    </div>
                </div>

                <!-- Hidden Vehicle Details -->
                <div id="vehicle_fields" style="display:none; margin-top: 2rem; border: 1px dashed var(--accent-blue); padding: 1.5rem; border-radius: 12px;">
                    <div class="form-grid">
                        <div class="form-group">
                             <label>Vehicle Type</label>
                             <select name="Vehicle_Type">
                                 <option value="Bike">Bike</option>
                                 <option value="Car">Car</option>
                                 <option value="Truck">Truck</option>
                             </select>
                        </div>
                        <div class="form-group">
                             <label>Engine Number</label>
                             <input type="text" name="Engine_number">
                        </div>
                        <div class="form-group">
                             <label>Vehicle Reg Number</label>
                             <input type="text" name="Register_number">
                        </div>
                        <div class="form-group">
                             <label>Upload Proof of Ownership</label>
                             <input type="file" name="vupload">
                        </div>
                    </div>
                </div>

                <!-- Hidden Mobile Details -->
                <div id="mobile_fields" style="display:none; margin-top: 2rem; border: 1px dashed var(--accent-blue); padding: 1.5rem; border-radius: 12px;">
                    <div class="form-grid">
                        <div class="form-group">
                             <label>IMEI Number</label>
                             <input type="text" name="Imei_number" maxlength="15">
                        </div>
                        <div class="form-group">
                             <label>Mobile Number (SIM)</label>
                             <input type="text" name="mobile_number">
                        </div>
                        <div class="form-group">
                             <label>Approx Price</label>
                             <input type="number" name="Price">
                        </div>
                        <div class="form-group">
                             <label>Upload Invoice/Bill</label>
                             <input type="file" name="mobupload">
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-actions" style="margin-top: 3rem;">
                <button type="submit" name="submit" class="btn-submit">Submit Digital FIR</button>
            </div>
        </form>
    </div>

    <?php include "common/_footer.php"; ?>

    <script>
        function toggleStolenFields() {
            var vFields = document.getElementById("vehicle_fields");
            var mFields = document.getElementById("mobile_fields");
            var vRadio = document.getElementById("vehicleRadio");
            var mRadio = document.getElementById("mobileRadio");

            vFields.style.display = vRadio.checked ? "block" : "none";
            mFields.style.display = mRadio.checked ? "block" : "none";
        }
    </script>
</body>
</html>