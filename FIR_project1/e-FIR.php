<?php
session_start();
include "DBconfig.php";

if (!isset($_SESSION["login"]) || $_SESSION["login"] == false) {
    echo "<script>
            alert('You Are Not Eligible For This Service, Please Sign in!');
            window.location.href='./index.php';
            </script>";
    exit();
}

// Logged user details from database
$uqry = "select user_fname,user_mname,user_lname,user_dob,rt.religion_name,um.contact_no,um.address,um.pincode from user_master um LEFT join religion_table rt on um.religion_id=rt.religion_id where `user_id`= " . $_SESSION["userid"] . ";";
$uinfo = mysqli_query($con, $uqry);
if ($row = mysqli_fetch_assoc($uinfo)) {
    $ufname = $row['user_fname'];
    $umname = $row['user_mname'];
    $ulname = $row['user_lname'];
    $uDOB = $row['user_dob'];
    $ureligion = $row['religion_name'];
    $ucontact = $row['contact_no'];
    $uaddress = $row['address'];
    $upincode = $row['pincode'];
}

if (isset($_POST['submit'])) {
    $userid = $_SESSION["userid"];
    $occupation = mysqli_real_escape_string($con, $_POST['occupation'] ?? '');
    $Dateto = mysqli_real_escape_string($con, $_POST['Date_to'] ?? '');
    $Timeto = mysqli_real_escape_string($con, $_POST['Time_to'] ?? '');
    $Distancestation = mysqli_real_escape_string($con, $_POST['Distance_station'] ?? '');
    $Occurance_Address = mysqli_real_escape_string($con, $_POST['Occurance_Address'] ?? '');
    $Occurance_pincode = mysqli_real_escape_string($con, $_POST['Occurance_pincode'] ?? '');
    $Policestation = mysqli_real_escape_string($con, $_POST['Police_station'] ?? '');
    $BriefDesc = mysqli_real_escape_string($con, $_POST['Brief_Desc'] ?? '');
    $delayed_reason = mysqli_real_escape_string($con, $_POST['delayed_reason'] ?? '');
    $Typetheft = mysqli_real_escape_string($con, $_POST['radiobtn'] ?? '0');

    // Handle Delay Upload
    $new_delay_file = "";
    if (isset($_FILES['delayupload']) && $_FILES['delayupload']['error'] == 0) {
        $delay_file_name = $_FILES["delayupload"]["name"];
        $delay_file_tmp = $_FILES["delayupload"]["tmp_name"];
        if (!is_dir("FIR_upload_doc/delayed_reason")) {
            mkdir("FIR_upload_doc/delayed_reason", 0777, true);
        }
        $ext = pathinfo($delay_file_name, PATHINFO_EXTENSION);
        $new_delay_file = "delay_" . time() . "_" . rand(100, 999) . "." . $ext;
        move_uploaded_file($delay_file_tmp, "FIR_upload_doc/delayed_reason/" . $new_delay_file);
    }

    // Insert into e_fir_master
    $sql = "INSERT INTO `e_fir_master` (`user_id`, `occurrance_area`, `police_station_occurance_place`, `types_of_fir_id`, `file_name`, `occurance_pincode`, `distance_from_ps`, `occurence_of_offence_date_from`, `occurence_of_offence_date_to`, `occurenece_of_offence_time_from`, `occurenece_of_offence_time_to`, `occupation`, `first_info_contents`,`delayed_reason`, `sbmt_date`) VALUES ('$userid', '$Occurance_Address', '$Policestation', '" . ($Typetheft == '0' ? 3 : $Typetheft) . "', '', '$Occurance_pincode', '$Distancestation', '$Dateto', '$Dateto', '$Timeto', '$Timeto', '$occupation', '$BriefDesc', '$delayed_reason', current_timestamp())";
    
    if (mysqli_query($con, $sql)) {
        $firID = mysqli_insert_id($con);

        if ($Typetheft == '1') { // Vehicle
            if (isset($_FILES['vupload']) && $_FILES['vupload']['error'] == 0) {
                $file_name = $_FILES["vupload"]["name"];
                $file_tmp = $_FILES["vupload"]["tmp_name"];
                $ext = pathinfo($file_name, PATHINFO_EXTENSION);
                $new_v_file = "vehicle_" . time() . "_" . rand(100, 999) . "." . $ext;
                move_uploaded_file($file_tmp, "FIR_upload_doc/vehicle_doc/" . $new_v_file);
                mysqli_query($con, "UPDATE e_fir_master SET file_name = '$new_v_file' WHERE e_fir_id = $firID");

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

                $vqry = "INSERT INTO `vehicle_table` (`e_fir_id`, `vehicle_type`, `name_of_manufacture`, `model`, `engine_number`, `chassis_number`, `vehicle_reg_number`, `color`, `manufacturing_year`, `approx_price`, `description_of_vehicle`) VALUES ('$firID', '$Vehicletype', '$Manufacturename', '$Modelname', '$Enginenumber', '$Chassisnumber', '$Registernumber', '$Vehiclecolor', '$ManufacturingYearVehicle', '$ApproxPriceVehicle', '$Descriptionvehicle')";
                mysqli_query($con, $vqry);
            }
        } elseif ($Typetheft == '2') { // Mobile
            if (isset($_FILES['mobupload']) && $_FILES['mobupload']['error'] == 0) {
                $file_name = $_FILES["mobupload"]["name"];
                $file_tmp = $_FILES["mobupload"]["tmp_name"];
                $ext = pathinfo($file_name, PATHINFO_EXTENSION);
                $new_m_file = "mobile_" . time() . "_" . rand(100, 999) . "." . $ext;
                move_uploaded_file($file_tmp, "FIR_upload_doc/mobile_doc/" . $new_m_file);
                mysqli_query($con, "UPDATE e_fir_master SET file_name = '$new_m_file' WHERE e_fir_id = $firID");

                $Mobilemodel = mysqli_real_escape_string($con, $_POST['Mobile_model'] ?? '');
                $Mobilecolor = mysqli_real_escape_string($con, $_POST['Mobile_color'] ?? '');
                $mobile_number = mysqli_real_escape_string($con, $_POST['mobile_number'] ?? '');
                $ManufacturingYearMobile = mysqli_real_escape_string($con, $_POST['Manufacturing_year'] ?? '');
                $IMEInumber = mysqli_real_escape_string($con, $_POST['Imei_number'] ?? '');
                $Simcard = mysqli_real_escape_string($con, $_POST['Sim'] ?? '');
                $ApproxPriceMobile = mysqli_real_escape_string($con, $_POST['Price'] ?? '');
                $Descriptionmobile = mysqli_real_escape_string($con, $_POST['Desc_mobile'] ?? '');

                $mqry = "INSERT INTO `stolen_mobile_table` (`e_fir_id`, `mobile_number`, `model`, `imei_number`, `approx_price`, `manufacturing_year`, `service_provider`, `color`, `description_of_mobile`) VALUES ('$firID', '$mobile_number', '$Mobilemodel', '$IMEInumber', '$ApproxPriceMobile', '$ManufacturingYearMobile', '$Simcard', '$Mobilecolor', '$Descriptionmobile')";
                mysqli_query($con, $mqry);
            }
        }
        echo "<script>alert('Successfully Submitted! Your FIR Reference Number: GJFIR" . date('Y') . sprintf('%04d', $firID) . "'); window.location.href='tracking.php';</script>";
    } else {
        echo "<script>alert('Submission Error: " . mysqli_error($con) . "');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-FIR Portal | Gujarat Police</title>
    <link rel="icon" href="img/weblogo1.ico" type="image/icon">
    <link rel="stylesheet" href="modern_efir.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    <?php include "common/_navbar.php"; ?>

    <div class="main-form-container">
        <div class="page-header">
            <h1>E-FIR Portal</h1>
            <p>Digital First Information Report Filing</p>
        </div>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
            
            <!-- Complainant Section -->
            <div class="form-section">
                <h2 class="section-title"><i class="fas fa-user-shield"></i> Complainant Information</h2>
                <div class="form-grid">
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" value="<?php echo $ufname; ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label>Father's Name</label>
                        <input type="text" value="<?php echo $umname; ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label>Surname</label>
                        <input type="text" value="<?php echo $ulname; ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label>Date Of Birth</label>
                        <input type="text" value="<?php echo $uDOB; ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label>Religion</label>
                        <input type="text" value="<?php echo $ureligion; ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label>Occupation <span class="required">*</span></label>
                        <input type="text" name="occupation" placeholder="Professional Detail" required>
                    </div>
                    <div class="form-group">
                        <label>Contact Number</label>
                        <input type="text" value="<?php echo $ucontact; ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label>Pincode</label>
                        <input type="text" value="<?php echo $upincode; ?>" disabled>
                    </div>
                    <div class="form-group" style="grid-column: span 2;">
                        <label>Permanent Address</label>
                        <textarea disabled><?php echo $uaddress; ?></textarea>
                    </div>
                </div>
            </div>

            <!-- Occurrence Section -->
            <div class="form-section">
                <h2 class="section-title"><i class="fas fa-map-marker-alt"></i> Occurrence of Offence</h2>
                <div class="form-grid">
                    <div class="form-group">
                        <label>Date <span class="required">*</span></label>
                        <input type="date" name="Date_to" required>
                    </div>
                    <div class="form-group">
                        <label>Time <span class="required">*</span></label>
                        <input type="time" name="Time_to" required>
                    </div>
                    <div class="form-group">
                        <label>Distance from PS (KM) <span class="required">*</span></label>
                        <input type="number" name="Distance_station" required>
                    </div>
                    <div class="form-group">
                        <label>Occurrence Pincode <span class="required">*</span></label>
                        <input type="text" name="Occurance_pincode" pattern="\d{6}" maxlength="6" required>
                    </div>
                    <div class="form-group">
                        <label>Police Station (Occurrence Place) <span class="required">*</span></label>
                        <select name="Police_station" required>
                            <option value="" disabled selected>-Select Station-</option>
                            <option value="AMRAIWADI POLICE STATION">AMRAIWADI POLICE STATION</option>
                            <option value="ANANDNAGAR POLICE STATION">ANANDNAGAR POLICE STATION</option>
                            <option value="BAPUNAGAR POLICE STATION">BAPUNAGAR POLICE STATION</option>
                            <option value="CHANDKHEDA POLICE STATION">CHANDKHEDA POLICE STATION</option>
                            <option value="DARIYAPUR POLICE STATION">DARIYAPUR POLICE STATION</option>
                            <option value="ELLISBRIDGE POLICE STATION">ELLISBRIDGE POLICE STATION</option>
                            <option value="GAYAKVAD HAVELI POLICE STATION">GAYAKVAD HAVELI POLICE STATION</option>
                            <option value="GHATLODIYA POLICE STATION">GHATLODIYA POLICE STATION</option>
                            <option value="GOMTIPUR POLICE STATION">GOMTIPUR POLICE STATION</option>
                            <option value="GUJARAT UNIVERSITY POLICE STATION">GUJARAT UNIVERSITY POLICE STATION</option>
                            <option value="ISHNPUR POLICE STATION">ISHNPUR POLICE STATION</option>
                            <option value="KAGDAPATH">KAGDAPATH</option>
                            <option value="KARANJ POLICE STATION">KARANJ POLICE STATION</option>
                            <option value="KHADIYA POLICE STATION">KHADIYA POLICE STATION</option>
                            <option value="KHOKHRA POLICE STATION">KHOKHRA POLICE STATION</option>
                            <option value="MADHVPURA POLICE STATION">MADHVPURA POLICE STATION</option>
                            <option value="MANINAGAR POLICE STATION">MANINAGAR POLICE STATION</option>
                            <option value="MEGHANI NAGAR POLICE">MEGHANI NAGAR POLICE STATION</option>
                            <option value="NARANPURA POLICE STATION">NARANPURA POLICE STATION</option>
                            <option value="NARODA POLICE STATION">NARODA POLICE STATION</option>
                            <option value="NAVRANGPURA POLICE STATION">NAVRANGPURA POLICE STATION</option>
                            <option value="ODHAV POLICE STATION">ODHAV POLICE STATION</option>
                            <option value="RAKHIYAL POLICE STATION">RAKHIYAL POLICE STATION</option>
                            <option value="RAMOL POLICE STATION">RAMOL POLICE STATION</option>
                            <option value="RANIP POLICE STATION">RANIP POLICE STATION</option>
                            <option value="SABARMATI POLICE STATION">SABARMATI POLICE STATION</option>
                            <option value="SARDARNAGAR POLICE STATION">SARDARNAGAR POLICE STATION</option>
                            <option value="SATELLITE POLICE STATION">SATELLITE POLICE STATION</option>
                            <option value="SHAHERKOTDA POLICE STATION">SHAHERKOTDA POLICE STATION</option>
                            <option value="SHAHIBAUG POLICE STATION">SHAHIBAUG POLICE STATION</option>
                            <option value="SHAHPUR POLICE STATION">SHAHPUR POLICE STATION</option>
                            <option value="SOLA POLICE STATION">SOLA POLICE STATION</option>
                            <option value="VASTRAPUR POLICE STATION">VASTRAPUR POLICE STATION</option>
                            <option value="VATVA POLICE STATION">VATVA POLICE STATION</option>
                            <option value="VATVA-GIDC">VATVA-GIDC</option>
                            <option value="VEJALPUR POLICE STATION">VEJALPUR POLICE STATION</option>
                        </select>
                    </div>
                    <div class="form-group" style="grid-column: span 2;">
                        <label>Occurrence Address <span class="required">*</span></label>
                        <textarea name="Occurance_Address" placeholder="Specific location detail..." required></textarea>
                    </div>
                </div>
            </div>

            <!-- Narrative Section -->
            <div class="form-section">
                <h2 class="section-title"><i class="fas fa-edit"></i> Complaint Narrative</h2>
                <div class="form-group">
                    <label>Brief Description (Max 2000 characters) <span class="required">*</span></label>
                    <textarea name="Brief_Desc" maxlength="2000" placeholder="State facts clearly..." required></textarea>
                </div>
                <div class="form-group" style="margin-top: 1.5rem;">
                    <label>If Delayed, Reason</label>
                    <textarea name="delayed_reason" placeholder="Explain the delay (if any)..."></textarea>
                </div>
                <div class="form-group" style="margin-top: 1.5rem;">
                    <label>Attach Evidence (PDF/JPG/PNG)</label>
                    <div class="file-upload-wrapper">
                        <input type="file" name="delayupload" accept=".pdf,.png,.jpg,.jpeg">
                    </div>
                </div>
            </div>

            <!-- Theft Category Selection -->
            <div class="form-section disclaimer-section">
                 <h2 class="section-title" style="color: #ef4444; border-color: #ef4444;"><i class="fas fa-exclamation-triangle"></i> Theft Selection</h2>
                 <p style="margin-bottom: 1.5rem; font-size: 0.9rem;">Please select if the incident involves theft of a Mobile or Vehicle.</p>
                 <div class="radio-group">
                    <label class="radio-item">
                        <input type="radio" name="radiobtn" value="0" checked onclick="toggleStolen(0)">
                        <span>None / General</span>
                    </label>
                    <label class="radio-item">
                        <input type="radio" name="radiobtn" value="2" onclick="toggleStolen(2)">
                        <span>Mobile Phone</span>
                    </label>
                    <label class="radio-item">
                        <input type="radio" name="radiobtn" value="1" onclick="toggleStolen(1)">
                        <span>Vehicle</span>
                    </label>
                 </div>
            </div>

            <!-- Mobile Details (Dynamic) -->
            <div id="div_mobile" style="display:none">
                <div class="form-section">
                    <h2 class="section-title"><i class="fas fa-mobile-alt"></i> Mobile Phone Particulars</h2>
                    <div class="form-grid">
                        <div class="form-group">
                            <label>Model Name <span class="required">*</span></label>
                            <input type="text" name="Mobile_model">
                        </div>
                        <div class="form-group">
                            <label>IMEI Number <span class="required">*</span></label>
                            <input type="text" name="Imei_number" pattern="\d{15}" maxlength="15">
                        </div>
                        <div class="form-group">
                            <label>Provider (SIM) <span class="required">*</span></label>
                            <input type="text" name="Sim">
                        </div>
                        <div class="form-group">
                            <label>Bill/Box Upload <span class="required">*</span></label>
                            <input type="file" name="mobupload" accept=".pdf,.png,.jpg,.jpeg">
                        </div>
                        <div class="form-group" style="grid-column: span 2;">
                            <label>Other Details (Color, Year, Price, etc.)</label>
                            <textarea name="Desc_mobile"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Vehicle Details (Dynamic) -->
            <div id="div_vehicle" style="display:none">
                <div class="form-section">
                    <h2 class="section-title"><i class="fas fa-car"></i> Vehicle Particulars</h2>
                    <div class="form-grid">
                        <div class="form-group">
                            <label>Vehicle Type <span class="required">*</span></label>
                            <select name="Vehicle_Type">
                                <option value="">-Select Type-</option>
                                <option value="Bike">Bike</option>
                                <option value="Car">Car</option>
                                <option value="Rickshaw">Rickshaw</option>
                                <option value="Truck">Truck</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Reg. Number <span class="required">*</span></label>
                            <input type="text" name="Register_number">
                        </div>
                        <div class="form-group">
                            <label>Engine Number <span class="required">*</span></label>
                            <input type="text" name="Engine_number">
                        </div>
                        <div class="form-group">
                            <label>Chassis Number <span class="required">*</span></label>
                            <input type="text" name="Chassis_number">
                        </div>
                        <div class="form-group">
                            <label>Document Upload (RC/Insurance) <span class="required">*</span></label>
                            <input type="file" name="vupload" accept=".pdf,.png,.jpg,.jpeg">
                        </div>
                        <div class="form-group" style="grid-column: span 2;">
                            <label>Other Details (Manufacture, Model, Color, Value)</label>
                            <textarea name="Desc_vehicle"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-section disclaimer-section">
                <h2 class="section-title"><i class="fas fa-gavel"></i> Declaration</h2>
                <div class="disclaimer-text">
                    <p>I solemnly affirm that the information given above is true. I am aware that knowingly providing false information to the police is a crime.</p>
                    <div class="agreement-checkbox">
                        <input type="checkbox" id="declare" required>
                        <label for="declare">I Agree to the Terms & Conditions</label>
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" name="submit" class="btn-submit">Submit E-FIR</button>
                <a href="index.php" class="btn-cancel">Cancel</a>
            </div>
        </form>
    </div>

    <script>
        function toggleStolen(type) {
            document.getElementById('div_mobile').style.display = (type === 2) ? 'block' : 'none';
            document.getElementById('div_vehicle').style.display = (type === 1) ? 'block' : 'none';
        }
    </script>
    
    <?php include "common/_footer.php"; ?>
</body>
</html>