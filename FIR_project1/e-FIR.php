<?php
session_start();
include "DBconfig.php";
//print_r($_SESSION);
$alertmsg = false;
$docalert = false;
if ($_SESSION["login"] == false) {
    // if not login redirect page with message
    echo "<script>
            alert('You Are Not Eligible For This Service , Please Sign in !');
            window.location.href='./index.php';
            </script>";
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
        if (isset($_FILES['delayupload']) && $_FILES['delayupload']['error'] == 0) {
            $delay_file_name = $_FILES["delayupload"]["name"];
            $delay_file_tmp = $_FILES["delayupload"]["tmp_name"];
            if (!is_dir("FIR_upload_doc/delayed_reason")) {
                mkdir("FIR_upload_doc/delayed_reason", 0777, true);
            }
            move_uploaded_file($delay_file_tmp, "FIR_upload_doc/delayed_reason/" . $delay_file_name);
        }

        // 2. Insert into e_fir_master (Initial record)
        $sql = "INSERT INTO `e_fir_master` (`e_fir_id`, `user_id`, `occurrance_area`, `police_station_occurance_place`, `types_of_fir_id`, `file_name`, `occurance_pincode`, `distance_from_ps`, `occurence_of_offence_date_from`, `occurence_of_offence_date_to`, `occurenece_of_offence_time_from`, `occurenece_of_offence_time_to`, `occupation`, `first_info_contents`,`delayed_reason`, `sbmt_date`) VALUES (NULL, '" . $userid . "', '" . $Occurance_Address . "', '" . $Policestation . "', '" . (empty($Typetheft) ? 3 : $Typetheft) . "', '', '" . $Occurance_pincode . "', '" . $Distancestation . "', '" . $Datefrom_final . "', '" . $Dateto . "', '" . $Timefrom_final . "', '" . $Timeto . "', '" . $occupation . "', '" . $BriefDesc . "','" . $delayed_reason . "', current_timestamp());";
        $result = mysqli_query($con, $sql);
        
        if ($result) {
            $firID = mysqli_insert_id($con);

            // 3. Optional Stolen Section
            if ($Typetheft == 1) { // Vehicle
                if (isset($_FILES['vupload']) && $_FILES['vupload']['error'] == 0) {
                    $file_name = $_FILES["vupload"]["name"];
                    $file_tmp = $_FILES["vupload"]["tmp_name"];
                    if (!is_dir("FIR_upload_doc/vehicle_doc")) { mkdir("FIR_upload_doc/vehicle_doc", 0777, true); }
                    move_uploaded_file($file_tmp, "FIR_upload_doc/vehicle_doc/" . $file_name);
                    
                    // Update main record with filename
                    mysqli_query($con, "UPDATE e_fir_master SET file_name = '$file_name' WHERE e_fir_id = $firID");

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

                    // Update main record with filename
                    mysqli_query($con, "UPDATE e_fir_master SET file_name = '$file_name' WHERE e_fir_id = $firID");

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

            echo "<script>alert('Successfully Submitted! Your FIR Reference Number: GJFIR202300" . $firID . "')</script>";
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>e-FIR</title>
    <!-- website logo -->
    <link rel="icon" href="img\weblogo1.ico" type="image/icon">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="form_theme.css">
    <link rel="stylesheet" href="E-FIR.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;600;700&display=swap">
</head>

<body>


    <section class="header">
        <nav>
            <a href="index.php" class="logo">

            </a>

            <div class="nav-links" class="navLinks">

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


        <h2 class="t" id="align"><b>
                <center>E-FIR</center>
            </b> </h2>

        <div class="app1">
            <div class="">
                <div class="app2">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                        <h3 class="appdet"><u>Complainant/Information</u> </h3><br>

                        <div class="r1">
                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">First Name</label>
                                    <span class="r5">*</span>
                                    <input type="text" style="background: #E4DEDE;" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php
echo $ufname; ?>" disabled>

                                </div>
                            </div>
                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">Father's/Husband's Name</label>
                                    <span class="r5"></span>
                                    <input type="text" style="background: #E4DEDE;" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php
echo $umname; ?>" disabled>
                                </div>

                            </div>
                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">Surname</label>
                                    <span class="r5">*</span>
                                    <input type="text" style="background: #E4DEDE;" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php
echo $ulname; ?>" disabled>
                                </div>
                            </div>
                        </div>
                        
                        <div class="r1">
                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">Date Of Birth</label>
                                    <span class="r5">*</span>
                                    <input type="date" style="background: #E4DEDE;" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" value="><?php echo $uDOB; ?>" disabled>
                                </div>
                            </div>
                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">Religion</label>
                                    <span class="r5">*</span>
                                    <input type="text" style="background: #E4DEDE;" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php
echo $ureligion; ?>" disabled>
                                </div>

                            </div>
                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">Occupation</label>
                                    <span class="r5">*</span>
                                    <input type="text" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" required name="occupation">
                                </div>
                            </div>

                        </div>

                        <div class="r1">
                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">Address</label>
                                    <span class="r5">*</span>
                                    <textarea class="r6" id="textAreaExample1" rows="4"     disabled><?php
echo $uaddress; ?></textarea>
                                </div>
                            </div>
                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">Mobile Number</label>
                                    <span class="r5">*</span>
                                    <input type="number" style="background: #E4DEDE;" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php
echo $ucontact; ?>" disabled>

                                </div>
                            </div>
                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">Pincode</label>
                                    <span class="r5"></span>
                                    <input type="number" style="background: #E4DEDE;" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php
echo $upincode; ?>" disabled>

                                </div>
                            </div>


                        </div>


                        <div class="r1" style="display:none;">
                            <div class="r2">
                                <div class="r3">
                                    <label for="Date From" class="r4">Date From</label>
                                    <span class="r5">*</span>
                                    <input type="date" class="r6" id="Date From" aria-describedby="emailHelp" name="Date_from"  max='2023-01-25'>
                                </div>
                            </div>
                            <div class="r2">
                                <div class="r3">
                                    <label for="Time From" class="r4">Time From</label>
                                    <span class="r5">*</span>
                                    <input type="time" class="r6" id="Time From" aria-describedby="emailHelp" name="Time_from" >
                                </div>
                            </div>
                        </div>
                        <div class="r1">
                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">Date To</label>
                                    <span class="r5">*</span>
                                    <input type="date" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" required name="Date_to" max='2023-01-25'>
                                </div>
                            </div>
                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">Time To</label>
                                    <span class="r5">*</span>
                                    <input type="time" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" required name="Time_to">
                                </div>
                            </div>

                        </div><br>
                        <h3 class="appdet"><u>Place Of Occurence</u> </h3><br>
                        <div class="r1">
                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4"> Distance From PoliceStation
                                        (approx)</label>
                                    <span class="r5">*</span>
                                    <input type="number" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" required name="Distance_station" placeholder="In Kilometer">
                                </div>
                            </div>
                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">Occurance Address</label>
                                    <span class="r5">*</span>
                                    <textarea class="r6" id="textAreaExample" rows="4"  required name="Occurance_Address"></textarea>
                                </div>
                            </div>
                            <div class="r2">
                                <div class="r3">
                                    <label for="Occurance Pincode" class="r4">Occurance Pincode</label>
                                    <span class="r5">*</span>
                                    <input type="text" class="r6" id="Occurance Pincode" aria-describedby="Occurance Pincode" required name="Occurance_pincode" pattern="\d*" maxlength="06" minlength="06">
                                </div>
                            </div>

                        </div>
                        <div class="r1">
                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">Police Station(Occurance Place)</label>
                                    <span class="r5">*</span>
                                    <select class="r6" aria-label="Default select example" name="Police_station" id="select" required>
                                        <option selected>-Select-</option>
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
                            </div>



                            <div class="r2">
                                <div class="r3">


                                    <label for="exampleInputEmail1" class="r4">City/District</label>
                                    <span class="r5">*</span>
                                    <select class="r6" aria-label="Default select example" name="City/District" id="select" required>
                                        <option selected>-Select-</option>
                                        <option value="4">Surat Rural</option>
                                        <option value="5">Surat City</option>
                                        <option value="6">Vadodara Rural</option>
                                        <option value="7">Vadodara City</option>
                                        <option value="2">Ahmedabad City</option>
                                        <option value="3">Ahmedabad Rural</option>
                                    </select>
                                </div>
                            </div>
                        </div><br>


                        <div class="r1">
                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">Brief Description(Maximum 2000
                                        characters)</label>
                                    <span class="r5">*</span>
                                    <textarea class="r6" id="textAreaExample2" rows="4"  required name="Brief_Desc"></textarea>
                                </div>
                            </div>

                        </div>

                        <h3 class="appdet">If Delayed, then Tell the Reason
                        </h3>

                        <div class="r1">
                            <div class="r2">
                                <div class="r3">
                                    <textarea class="r6" id="textAreaExample3" rows="4"  name="delayed_reason"></textarea>
                                </div>
                                <div class="r3" style="margin-left: 20px;">
                                                <label for="exampleInputEmail1" class="r4">Upload Document</label>
                                                
                                                <input type="file" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" name="delayupload" accept="application/pdf , image/png , image/jpeg">
                                                <label id="upldalert" class="r5"><b>Upload only JPG/PDF/PNG formate</b></label>

                                </div>  
                            </div>
                           
                                           
                                      

                        </div>

                        <div>

                            <hr>
                            <div class="stol">


                                <h3 class="appdet" style="color: red;">IF STOLEN</h3>

                                <div class="r111">
                                    <div class="">
                                        <div class="">
                                            <label for="exampleInputEmail1" class="" name="Type_theft">Type of
                                                theft</label>
                                            <span class="r5"></span><br>
                                            <div class="bu11">
                                                <div class="bu22">
                                                    <input class="bu33" type="radio" value="2" name="radiobtn" id="myCheck" onclick="myFunction1()">
                                                    <label class="" for="myCheck" name="Mobile">Mobile</label>
                                                </div>
                                                <div class="bu44">
                                                    <input class="bu33" type="radio" value="1" name="radiobtn" id="myCheckk" onclick="myFunction1()">
                                                    <label class="" for="myCheckk" name="Vehicle">Vehicle</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End  tag -->
                                </div>


                            </div>
                            <hr>

                            <div id="text" style="display:none">
                                <div class="app2">
                                    <h3 class="appdet"><u>Mobile Detalis</u></h3><br>

                                    <div class="r1">
                                        <div class="r2">
                                            <div class="r3">
                                                <label for="exampleInputEmail1" class="r4">Mobile Model</label>
                                                <span class="r5">*</span>
                                                <input type="text" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" name="Mobile_model">
                                            </div>
                                        </div>
                                        <div class="r2">
                                            <div class="r3">
                                                <label for="exampleInputEmail1" class="r4">Mobile Color</label>
                                                <span class="r5">*</span>
                                                <input type="text" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" name="Mobile_color">
                                            </div>

                                        </div>
                                        <div class="r2">
                                            <div class="r3">
                                                <label for="exampleInputEmail1" class="r4">Manufacturing Year</label>
                                                <span class="r5">*</span>
                                                <input type="month" placeholder="YYYY" min="1999" max="2020" name="Manufacturing_year" class="r6">
                                            </div>
                                        </div>
                                        <!-- End  tag -->
                                    </div>

                                    <div class="r1">
                                        <div class="r2">
                                            <div class="r3">
                                                <label for="exampleInputEmail1" class="r4">IMEI Number</label>
                                                <span class="r5">*</span>
                                                <input type="text" class="r6" id="exampleInputEmail1" pattern="\d*" maxlength="15" aria-describedby="emailHelp" name="Imei_number">
                                            </div>
                                        </div>
                                        <div class="r2">
                                            <div class="r3">
                                                <label for="exampleInputEmail1" class="r4">Sim Card Name</label>
                                                <span class="r5">*</span>
                                                <input type="text" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" name="Sim">
                                            </div>
                                        </div>
                                        <div class="r2">
                                            <div class="r3">
                                                <label for="exampleInputEmail1" class="r4">Approx Price</label>
                                                <span class="r5">*</span>
                                                <input type="number" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" name="Price">
                                            </div>
                                        </div>

                                    </div>




                                    <div class="r1">
                                        <div class="r2">
                                            <div class="r3">
                                                <label for="exampleInputEmail1" class="r4">Description of mobile</label>
                                                <span class="r5">*</span>
                                                <input type="text" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" name="Desc_mobile">
                                            </div>
                                        </div>
                                        <div class="r2">
                                            <div class="r3">
                                                <label for="exampleInputEmail1" class="r4">Mobile Number</label>
                                                <span class="r5">*</span>
                                                <input type="text" class="r6" id="exampleInputEmail1" placeholder="95xxxxx23" name="mobile_number" pattern="\d*" maxlength="10" minlength="10">
                                            </div>
                                        </div>
                                        <div class="r2">
                                            <div class="r3">
                                                <label for="exampleInputEmail1" class="r4">Upload Document</label>
                                                <span class="r5">*</span>
                                                <input type="file" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" name="mobupload" accept="application/pdf , image/png , image/jpeg" >
                                                <label id="upldalert" class="r5"><b>Upload only JPG/PDF/PNG formate</b></label>

                                            </div>
                                        </div>


                                    </div>




                                </div>

                                <script>
                                    function myFunction1() {
                                        var checkBoxx = document.getElementById("myCheck"); //mobile
                                        var checkBox = document.getElementById("myCheckk"); //vehicle
                                        var mfield = document.getElementById("exampleInputEmail1");
                                        var textt = document.getElementById("text"); //mobile
                                        var text = document.getElementById("txt"); //vehicle
                                        // mobile logic
                                        if (checkBoxx.checked == true && checkBox.checked == false) {
                                            textt.style.display = "block";

                                        } else {
                                            textt.style.display = "none";
                                        }
                                        //vehicle logic
                                        if (checkBox.checked == true) {
                                            text.style.display = "block";
                                        } else {
                                            text.style.display = "none";
                                        }
                                    }
                                </script>
                            </div>

                            <div id="txt" style="display:none">
                                <div class="app2">


                                    <h3 class="appdet"><u>Vehicle Detalis</u></h3><br>

                                    <div class="r1">
                                        <div class="r2">
                                            <div class="r3">
                                                <label for="exampleInputPassword1" class="r4" name="Vehicle_Type">Vehicle Type</label>
                                                <span class="r5">*</span>
                                                <select class="r6" aria-label="Default select example" required name="Vehicle_Type" id="select">
                                                    <option selected>SELECT</option>
                                                    <option value="Bike">Bike</option>
                                                    <option value="Car">Car</option>
                                                    <option value="Rickshaw">Rickshaw</option>
                                                    <option value="Truck">Truck</option>
                                                    <option value="Other">Other</option>



                                                </select>
                                            </div>
                                        </div>

                                        <div class="r2">
                                            <div class="r3">
                                                <label for="exampleInputEmail1" class="r4">Name Of Manufacture</label>
                                               
                                                <input type="text" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" name="Name_manufacture">
                                            </div>

                                        </div>
                                        <div class="r2">
                                            <div class="r3">
                                                <label for="exampleInputEmail1" class="r4">Model Name</label>
                                                
                                                <input type="text" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" name="Model_name">
                                            </div>
                                        </div>
                                        <!-- End  tag -->
                                    </div>

                                    <div class="r1">
                                        <div class="r2">
                                            <div class="r3">
                                                <label for="exampleInputEmail1" class="r4">Engine Number</label>
                              
                                                <input type="text" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" name="Engine_number"  maxlength="10">
                                            </div>
                                        </div>
                                        <div class="r2">
                                            <div class="r3">
                                                <label for="exampleInputEmail1" class="r4">Chassis Numner</label>
                                         
                                                <input type="text" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" name="Chassis_number"  maxlength="17">
                                            </div>
                                        </div>
                                        <div class="r2">
                                            <div class="r3">
                                                <label for="exampleInputEmail1" class="r4">Approx Price</label>
                                                
                                                <input type="number" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" name="Approx_price">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="r1">
                                        <div class="r2">
                                            <div class="r3">
                                                <label for="exampleInputEmail1" class="r4">Vehicle Register
                                                    Number</label>
                                              
                                                <input type="text" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" name="Register_number">
                                            </div>
                                        </div>
                                        <div class="r2">
                                            <div class="r3">
                                                <label for="exampleInputEmail1" class="r4">Vehicle Color</label>
                                                
                                                <input type="text" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" name="Vehicle_color">
                                            </div>
                                        </div>
                                        <div class="r2">
                                            <div class="r3">
                                                <label for="exampleInputEmail1" class="r4">Manufacturing Year</label>
                                              
                                                <input type="month" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" name="Manuf_year">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="r1">
                                        <div class="r2">
                                            <div class="r3">
                                                <label for="exampleInputEmail1" class="r4">Description of
                                                    Vehicle</label>
                                              
                                                <input type="text" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" name="Desc_vehicle">
                                            </div>
                                        </div>
                                        <div class="r2">
                                            <div class="r3">
                                                <label for="exampleInputEmail1" class="r4">Upload Document</label>
                                                <span class="r5">*</span>

                                                <input type="file" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" name="vupload" accept="application/pdf , image/png , image/jpeg" >
                                            </div>
                                            <label id="upldalert" class="r5"><b>Upload only JPG/PDF/PNG formate</b></label>
                                        </div>


                                    </div>

                                </div>


                                <!-- <script>
                                    function myFunction() {
                                        var checkBox = document.getElementById("myCheckk");
                                        var text = document.getElementById("txt");
                                        if (checkBox.checked == true) {
                                            text.style.display = "block";
                                        } else {
                                            text.style.display = "none";
                                        }
                                    }
                                </script> -->
                            </div>


                        </div>

                        <!-- for police purpose in admin panel -->
                        <!-- <hr style="width: 88.5em;">
                        <hr style="width: 88.5em;">
                        <hr style="width: 88.5em;">
                        <br>

                        <div class="actn">

                            <center>
                                <b>
                                <label class="r5" for="flexCheckChecked">User Please Don't Interface In This Action Taken</label> <br>
                                <label class="r5" for="flexCheckChecked">This Is Only For Police</label>
                                </b>
                            </center>

                        </div><br>

                        <hr style="width: 88.5em;">
                        <hr style="width: 88.5em;">
                        <hr style="width: 88.5em;">

                        <h3 class="appdet"><u>Action Taken :- Since the above information reveals commision of Offence</u>
                        </h3>
                        <div class="">
                            <div class="">
                                <div class="r2">
                                    <div class="r3">
                                        <input class="" type="checkbox" value="" id="flexCheckDefault">
                                        <label class="" for="flexCheckDefault">Regestered the case and took up the investigation</label>
                                    </div>
                                    <div class="">
                                        <input class="" type="checkbox" value="" id="flexCheckChecked" checked>
                                        <label class="" for="flexCheckChecked"> Directed take up the investigation
                                </label>
                                    </div>
                                </div>
                            </div><br>
                            
                        </div>
                        <label for="exampleInputEmail1" class="r4">Rank</label>
                        <span class="r5">*</span><br>

                        <select name="" class="r6" style="width: 20em;">
                    <option value="1">Director-General of police(DGP)</option>
                    <option value="2">Additional Director General Of Police(ADG)</option>
                    <option value="3">Inspector-General Of Police(IGP)</option>
                    <option value="4">Deputy Inspector General Of Police</option>
                    <option value="5">Senior Suprintendent Of Police</option>
                    <option value="6">Suprintendent Of Police</option>
                    <option value="7">Additional Suprintendent Of Police</option>
                    <option value="8">Deputy Suprintendent Of Police (Dy.SP)</option>
                    <option value="9">Inspector</option>
                    <option value="10">Sub-Inspector</option>
                    <option value="11">Assistent Sub-Inspector</option>
                    <option value="12">Head Constable</option>
c                </select><br><br>




                        <div class="">

                            <label class="" for="flexCheckChecked">F.I.R. Read Over To The Complainant/Informant Admitted To be Correctly Recorded And A Copy Given To The Compainant Free Of Cost</label>
                        </div><br>

                        <div class="r1">
                            <div class="r2">
                                <div class="r3">

                                    <label for="exampleInputEmail1" class="r4"> Signature Impression Of The Police</label>
                                    <span class="r5">*</span><br>
                                    <div class="r1">
                                        <div class="r2">
                                            <div class="r3">
                                                <textarea name id col="70" rows="3" class="" s="70" s="3"></textarea>
                                            </div>
                                        </div>
                                        
                                    </div>

                                </div>
                            </div>
                            
                        </div>
                        <div class="r1">
                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">Date</label>
                                    <span class="r5">*</span>
                                    <input type="date" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" required name="Date">
                                </div>
                            </div>
                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">Time</label>
                                    <span class="r5">*</span>
                                    <input type="Time" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" required name="Time">
                                </div>
                            </div>
                            
                        </div> -->

                        <!-- -----------------END Comment------------------ -->

                        <div>
                            <center class="">
                          
                                <button type="submit" class="boot1" name="submit" value="sbmt">Submit</button>
                                <button type="reset" class="boot2">Reset</button>
                                <button type="Cancel" class="boot3"><a href="index.php" style="color: aliceblue; text-decoration: none;">Cancel</button>
                            </center>

                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
        </script>


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


        <script src="script.js">


        </script>
        <!-- for not submit when page refreshed -->
        <script>
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.href);
            }
        </script>



</body>

</html>