<?php
session_start();
//print_r($_SESSION);
$done = false;
if ($_SESSION["lg"] == false) {
    header("location:..\login.php");
}
$rno = $_GET["rno"];
$FIR_type = $_GET["type"];

if ((!isset($rno) || $rno == null) || (!isset($_GET["type"]) || $_GET["type"] == null)) {
    header('location:..\manage_FIR.php');
}

// retrive data from database table
include '..\common\dbconfig.php';
// $rno = $_GET['rno'];

$qry = "SELECT efm.occurrance_area,efm.police_station_occurance_place,efm.file_name,efm.occurance_pincode,efm.distance_from_ps,efm.occurence_of_offence_date_from,efm.occurence_of_offence_date_to,efm.occurenece_of_offence_time_from,efm.occurenece_of_offence_time_to,efm.occupation,efm.first_info_contents,efm.delayed_reason,um.address,um.user_fname,um.user_mname,um.user_lname,um.contact_no,um.user_dob,rt.religion_name,um.pincode,smt.mobile_number,smt.model as m_model,smt.imei_number,smt.approx_price as m_price,smt.manufacturing_year as m_manufactureyear,smt.service_provider,smt.color,smt.description_of_mobile,vt.vehicle_type,vt.name_of_manufacture,vt.model,vt.engine_number,vt.chassis_number,upper(vt.vehicle_reg_number) as vehicle_reg_number,vt.color as v_color,vt.manufacturing_year,vt.approx_price,vt.description_of_vehicle,typ.fir_type,rt.religion_name

from e_fir_master efm 
LEFT OUTER JOIN stolen_mobile_table smt ON efm.e_fir_id = smt.e_fir_id 
LEFT OUTER JOIN vehicle_table vt ON efm.e_fir_id = vt.e_fir_id
LEFT OUTER JOIN user_master um on efm.user_id=um.user_id 
LEFT OUTER JOIN types_of_fir_table typ on efm.types_of_fir_id=typ.types_of_FIR_id
LEFT OUTER JOIN religion_table rt on rt.religion_id=um.religion_id

where efm.e_fir_id = $rno;";
$result = mysqli_query($con, $qry);
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        // user data
        $Firstname = $row['user_fname'];
        $FatherName = $row['user_mname'];
        $surname = $row['user_lname'];
        $dob = $row['user_dob'];
        $religion = $row['religion_name'];
        $occupation = $row['occupation'];
        $address = $row['address'];
        $Mobilenumber = $row['contact_no'];
        $upincode = $row['pincode'];

        // $Whatsappnumber = $row['Whatsapp_number'];


        $Datefrom = $row['occurence_of_offence_date_from'];
        $Dateto = $row['occurence_of_offence_date_to'];
        $Timefrom = $row['occurenece_of_offence_time_from'];
        $Timeto = $row['occurenece_of_offence_time_to'];
        $Distancestation = $row['distance_from_ps'];
        $Occurance_Address = $row['occurrance_area'];
        $Occurance_pincode =  $row['occurance_pincode'];
        $Policestation = $row['police_station_occurance_place'];
        // $CityDistrict = $row['City/district'];
        $BriefDesc = $row['first_info_contents'];
        $delayed_reason = $row['delayed_reason'];
        $Typetheft = $row['fir_type'];

        $Vehicletype = $row['vehicle_type'];
        $Manufacturename = $row['name_of_manufacture'];
        $Modelname = $row['model'];
        $Enginenumber = $row['engine_number'];
        $Chassisnumber = $row['chassis_number'];
        $ApproxPriceVehicle = $row['approx_price'];
        $Registernumber = $row['vehicle_reg_number'];
        $Vehiclecolor = $row['v_color'];
        $ManufacturingYearVehicle = $row['manufacturing_year'];
        $Descriptionvehicle = $row['description_of_vehicle'];
        // $UploadDocument = $row['vupload'];

        // mobile values
        $Mobilemodel = $row['m_model'];
        $Mobilecolor = $row['color'];
        $mobile_number = $row['mobile_number'];
        $ManufacturingYearMobile = $row['m_manufactureyear'];
        $IMEInumber = $row['imei_number'];
        $Simcard = $row['service_provider'];
        $ApproxPriceMobile = $row['m_price'];
        $Descriptionmobile = $row['description_of_mobile'];
        // $Uploaddocument = $row['mobupload'];


    }


    // Update Actions 
    // 
    $cat ;
    if($_SESSION['cat'] == "Police Station Officer" )
    {
        $cat = " (PSO)";
    }
    else
    {
        $cat = " (IO)";

    }

    if (isset($_POST['actionn'])) {
            //  echo "cdcmlm";
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $action_tkn = $_POST['takeaction'];
            $rno = $_GET["rno"];
            // $action_tknBY = $_POST['action_by'];
            $remark = $_POST['action_remark'];
           
            //  echo "callled";
            $qry = "UPDATE `e_fir_master` SET `action_taken` = '".$action_tkn."', `Remarks_act` = '".$remark."', `action_takenBY` = '".$_SESSION["user"]. $cat."' WHERE `e_fir_id` = ".$rno.";";
            $res = mysqli_query($con,$qry);
       
            if($res > 0)
            {
                $done = true;
                // echo "update";
                $_GET['rno'] = null;
                if (!isset($rno) || $rno == null) {
                    header('location:..\manage_FIR.php');
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FIR - Dashboard</title>


    <!-- website logo -->
    <link rel="icon" href="..\img\weblogo1.ico" type="image/icon">


    <!-- css -->
    <link rel="stylesheet" href="..\css\E-FIR.css">

    <style type="text/css">
        #compulsory {
            color: red;
            font-weight: bold;
        }
    </style>

    <!-- bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <!-- font-awasome icon -->
    <link rel="stylesheet" href="..\plugins/fontawesome-free/css/all.min.css">

    <!-- datatable css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">

    <!-- css file import -->
    <link rel="stylesheet" href="..\css\nav1.css">




</head>

<body style="background-color:rgb(217, 216, 216);">
    <!-- Image and text -->
    <div class="container-fluid">

        <!-- navbar -->
        <div class="row">
            <div class="col-md-12">
                <nav class="navbar navbar-expand-lg navbar-light bg-light mt-2 d-print-none">
                    <a class="navbar-brand" href="#">
                        <img src="..\img\fir.png" width="30" height="30" class="d-inline-block align-top" alt="FIR_Service_LOGO">
                        <b>FIR - Services</b>
                    </a>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="..\index.php">Home</a>
                            </li>

                            <!-- <li class="nav-item">
                                <a class="nav-link disabled">Disabled</a>
                            </li> -->
                        </ul>
                        <i class="fa fa-clock" aria-hidden="true">&nbsp;</i>
                        <span class="mr-2" id="clock"></span>
                        |
                        <i class="fa fa-calendar ml-3" aria-hidden="true"> &nbsp;</i>
                        <span class=" mr-2" id="Date"></span>

                    </div>
                </nav>
            </div>
        </div>

        <!-- breadcrumb ex. home > contact  -->

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mt-2">
                <li class="breadcrumb-item"><a href="..\index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="..\manage_FIR.php?typ=P">Manage FIR's</a></li>
                <li class="breadcrumb-item active" aria-current="page">FIR- Dashboard</li>
            </ol>
        </nav>

        <!-- list of records -->

        <div class="row mt-1">
            <div class="col-md-12 ">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6 ">
                            <b style="font-size: xx-large;">List of complaints </b>
                            </div>
                            <div class="col-md-6  text-right" style=" margin-top: 10px;">
                        <h5>FIR Number : <span class="r5"><u><?php echo "GJFIR202300".$rno ;?></u></span></h5>

                            </div>
                        </div>
                        
                    </div>
                    <div class="card-body">
                        <!-- --------------------------------------------------------------------------e -fir form  -->
                        <form action="#" method="POST" >
                            <h3 class="appdet"><u>Complainant/Information</u> </h3><br>

                            <div class="r1">
                                <div class="r2">
                                    <div class="r3">
                                        <label for="exampleInputEmail1" class="r4">First Name</label>
                                        <span class="r5">*</span>
                                        <input type="text" style="background: #E4DEDE;" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php
                                                                                                                                                                echo $Firstname; ?>" disabled>

                                    </div>
                                </div>
                                <div class="r2">
                                    <div class="r3">
                                        <label for="exampleInputEmail1" class="r4">Father's/Husband's Name</label>
                                        <span class="r5"></span>
                                        <input type="text" style="background: #E4DEDE;" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php
                                                                                                                                                                echo $FatherName; ?>" disabled>
                                    </div>

                                </div>
                                <div class="r2">
                                    <div class="r3">
                                        <label for="exampleInputEmail1" class="r4">Surname</label>
                                        <span class="r5">*</span>
                                        <input type="text" style="background: #E4DEDE;" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php
                                                                                                                                                                echo $surname; ?>" disabled>
                                    </div>
                                </div>

                            </div>
                            <div class="r1">
                                <div class="r2">
                                    <div class="r3">
                                        <label for="exampleInputEmail1" class="r4">Date Of Birth</label>
                                        <span class="r5">*</span>
                                        <input type="date" style="background: #E4DEDE;" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php
                                                                                                                                                                echo $dob; ?>" disabled>
                                    </div>
                                </div>
                                <div class="r2">
                                    <div class="r3">
                                        <label for="exampleInputEmail1" class="r4">Religion</label>
                                        <span class="r5">*</span>
                                        <input type="text" style="background: #E4DEDE;" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php
                                                                                                                                                                echo $religion; ?>" disabled>
                                    </div>

                                </div>
                                <div class="r2">
                                    <div class="r3">
                                        <label for="exampleInputEmail1" class="r4">Occupation</label>
                                        <span class="r5">*</span>
                                        <input type="text" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php
                                                                                                                                    echo $occupation; ?>" disabled>
                                    </div>
                                </div>

                            </div>

                            <div class="r1">
                                <div class="r2">
                                    <div class="r3">
                                        <label for="exampleInputEmail1" class="r4">Address</label>
                                        <span class="r5">*</span>
                                        <textarea class="r6" id="textAreaExample1" rows="4" style="height: 45px; width: 400px;     background: #E4DEDE;" disabled><?php
                                                                                                                                                                    echo $address; ?></textarea>
                                    </div>
                                </div>
                                <div class="r2">
                                    <div class="r3">
                                        <label for="exampleInputEmail1" class="r4">Mobile Number</label>
                                        <span class="r5">*</span>
                                        <input type="number" style="background: #E4DEDE;" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php
                                                                                                                                                                    echo $Mobilenumber; ?>" disabled>

                                    </div>
                                </div>
                                <div class="r2">
                                    <div class="r3">
                                        <label for="exampleInputEmail1" class="r4">Pincode</label>
                                        <span class="r5"></span>
                                        <input type="number" style="background: #E4DEDE;" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $upincode; ?>" disabled>

                                    </div>
                                </div>


                            </div>


                            <h3 class="appdet"><u>Date Of Occurence</u></h3><br>
                            <div class="r1">
                                <div class="r2">
                                    <div class="r3">
                                        <label for="Date From" class="r4">Date From</label>
                                        <span class="r5">*</span>
                                        <input type="date" class="r6" id="Date From" style="background: #E4DEDE;" aria-describedby="emailHelp" value="<?php echo $Datefrom; ?>" disabled>

                                    </div>
                                </div>
                                <div class="r2">
                                    <div class="r3">
                                        <label for="Time From" class="r4">Time From</label>
                                        <span class="r5">*</span>
                                        <input type="time" class="r6" id="Time From" style="background: #E4DEDE;" aria-describedby="emailHelp" value="<?php echo $Timefrom; ?>" disabled>
                                    </div>
                                </div>


                            </div>
                            <div class="r1">
                                <div class="r2">
                                    <div class="r3">
                                        <label for="exampleInputEmail1" class="r4">Date To</label>
                                        <span class="r5">*</span>
                                        <input type="date" class="r6" id="exampleInputEmail1" style="background: #E4DEDE;" aria-describedby="emailHelp" value="<?php echo $Dateto; ?>" disabled>
                                    </div>
                                </div>
                                <div class="r2">
                                    <div class="r3">
                                        <label for="exampleInputEmail1" class="r4">Time To</label>
                                        <span class="r5">*</span>
                                        <input type="time" class="r6" id="exampleInputEmail1" style="background: #E4DEDE;" aria-describedby="emailHelp" value="<?php echo $Timeto; ?>" disabled>
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
                                        <input type="number" class="r6" id="exampleInputEmail1" style="background: #E4DEDE;" aria-describedby="emailHelp" value="<?php echo $Distancestation; ?>" disabled>
                                    </div>
                                </div>
                                <div class="r2">
                                    <div class="r3">
                                        <label for="exampleInputEmail1" class="r4">Occurance Address</label>
                                        <span class="r5">*</span>
                                        <textarea class="r6" id="textAreaExample1" style="background: #E4DEDE; 
                                        height:60px; width: 430px;"><?php echo $Occurance_Address ?></textarea>
                                    </div>
                                </div>
                                <div class="r2">
                                    <div class="r3">
                                        <label for="Occurance Pincode" class="r4">Occurance Pincode</label>
                                        <span class="r5">*</span>
                                        <input type="number" class="r6" id="Occurance Pincode" style="background: #E4DEDE; " aria-describedby="Occurance Pincode" value="<?php echo $Occurance_pincode; ?>" disabled>
                                    </div>
                                </div>

                            </div>
                            <div class="r1">
                                <div class="r2">
                                    <div class="r3">
                                        <label for="exampleInputEmail1" class="r4">Police Station(Occurance
                                            Place)</label>
                                        <span class="r5">*</span>
                                        <select class="r6" aria-label="Default select example" style="background: #E4DEDE;">
                                            <option selected><?php echo $Policestation ?></option>


                                        </select>
                                    </div>
                                </div>



                                <div class="r2">
                                    <div class="r3">


                                        <label for="exampleInputEmail1" class="r4">City/District</label>
                                        <span class="r5">*</span>
                                        <select class="r6" aria-label="Default select example" style="background: #E4DEDE;">
                                            <option selected>Ahmedabad City</option>
                                            <!-- <option value="3">Ahmedabad Rural</option> -->
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
                                        <textarea class="r6" id="textAreaExample1" rows="4" style="height: 100px;width: 900px;background: #E4DEDE;" disabled><?php echo $BriefDesc; ?></textarea>
                                    </div>
                                </div>

                            </div>

                            <h3 class="appdet">If Delayed, then Tell the Reason
                            </h3>

                            <div class="r1">
                                <div class="r2">
                                    <div class="r3">
                                        <textarea class="r6" id="textAreaExample1" rows="4" style="height: 150px;width: 900px;background: #E4DEDE;" disabled><?php echo $delayed_reason; ?></textarea>
                                    </div>
                                </div>

                            </div>

                            <div>

                                <!-- <hr style="width: 88.5em;"> -->
                                <div class="stol">

                                </div>
                                <hr style="width: 88.5em;">

                                <?php
                                if ($FIR_type == 'Mobile' || $FIR_type == 'mobile') { ?>

                                    <!-- mobile Form -->
                                    <div id="text">
                                        <div class="app2">
                                            <h3 class="appdet"><u>Mobile Detalis</u></h3><br>

                                            <div class="r1">
                                                <div class="r2">
                                                    <div class="r3">
                                                        <label for="exampleInputEmail1" class="r4">Mobile Model</label>
                                                        <span class="r5">*</span>
                                                        <input type="text" class="r6" id="exampleInputEmail1" style="background: #E4DEDE;" aria-describedby="emailHelp" value="<?php echo $Mobilemodel; ?>" disabled>
                                                    </div>
                                                </div>
                                                <div class="r2">
                                                    <div class="r3">
                                                        <label for="exampleInputEmail1" class="r4">Mobile Color</label>
                                                        <span class="r5">*</span>
                                                        <input type="text" class="r6" id="exampleInputEmail1" style="background: #E4DEDE;" aria-describedby="emailHelp" value="<?php echo $Mobilecolor; ?>" disabled>
                                                    </div>

                                                </div>
                                                <div class="r2">
                                                    <div class="r3">
                                                        <label for="exampleInputEmail1" class="r4">Manufacturing
                                                            Year</label>
                                                        <span class="r5">*</span>
                                                        <input type="month" class="r6" style="background: #E4DEDE;" value="<?php echo $ManufacturingYearMobile; ?>" disabled>
                                                    </div>
                                                </div>
                                                <!-- End  tag -->
                                            </div>

                                            <div class="r1">
                                                <div class="r2">
                                                    <div class="r3">
                                                        <label for="exampleInputEmail1" class="r4">IMEI Number</label>
                                                        <span class="r5">*</span>
                                                        <input type="text" class="r6" id="exampleInputEmail1" style="background: #E4DEDE;" value="<?php echo $IMEInumber; ?>" disabled>
                                                    </div>
                                                </div>
                                                <div class="r2">
                                                    <div class="r3">
                                                        <label for="exampleInputEmail1" class="r4">Sim Card Name</label>
                                                        <span class="r5">*</span>
                                                        <input type="text" class="r6" id="exampleInputEmail1" style="background: #E4DEDE;" value="<?php echo $Simcard; ?>" disabled>
                                                    </div>
                                                </div>
                                                <div class="r2">
                                                    <div class="r3">
                                                        <label for="exampleInputEmail1" class="r4">Approx Price</label>
                                                        <span class="r5">*</span>
                                                        <input type="text" class="r6" id="exampleInputEmail1" style="background: #E4DEDE;" value="<?php echo $ApproxPriceMobile; ?>" disabled>
                                                    </div>
                                                </div>

                                            </div>




                                            <div class="r1">
                                                <div class="r2">
                                                    <div class="r3">
                                                        <label for="exampleInputEmail1" class="r4">Description of
                                                            mobile</label>
                                                        <span class="r5">*</span>
                                                        <input type="text" class="r6" id="exampleInputEmail1" style="background: #E4DEDE;" aria-describedby="emailHelp" name="Desc_mobile" value="<?php echo $Descriptionmobile; ?>" disabled>
                                                    </div>
                                                </div>
                                                <div class="r2">
                                                    <div class="r3">
                                                        <label for="exampleInputEmail1" class="r4">Mobile Number</label>
                                                        <span class="r5">*</span>
                                                        <input type="text" class="r6" id="exampleInputEmail1" style="background: #E4DEDE;" value="<?php echo $mobile_number; ?>" disabled>
                                                    </div>
                                                </div>
                                                <!-- <div class="r2">
                                            <div class="r3">
                                                <label for="exampleInputEmail1" class="r4">Upload Document</label>
                                                <span class="r5">*</span>
                                                <input type="file" class="r6" id="exampleInputEmail1" style="background: #E4DEDE;" aria-describedby="emailHelp" name="mobupload">
                                                <label id="upldalert" class="r5"><b>Upload only JPG/PDF/PNG formate</b></label>

                                            </div>
                                        </div> -->


                                            </div>




                                        </div>


                                    </div>


                                <?php } else if ($FIR_type == 'Vehicle' || $FIR_type == 'vehicle') { ?>
                                    <!-- Vehicle Detalis -->
                                    <div id="txt">
                                        <div class="app2">


                                            <h3 class="appdet"><u>Vehicle Detalis</u></h3><br>

                                            <div class="r1">
                                                <div class="r2">
                                                    <div class="r3">
                                                        <label for="exampleInputPassword1" class="r4" name="Vehicle_Type">Vehicle Type</label>
                                                        <span class="r5">*</span>
                                                        <select class="r6" aria-label="Default select example" style="background: #E4DEDE;" >
                                                            <option selected><?php echo $Vehicletype;?></option>
                                                            

                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="r2">
                                                    <div class="r3">
                                                        <label for="exampleInputEmail1" class="r4">Name Of
                                                            Manufacture</label>
                                                        <span class="r5">*</span>
                                                        <input type="text" class="r6" id="exampleInputEmail1" style="background: #E4DEDE;" value="<?php echo $Manufacturename; ?>" disabled>
                                                    </div>

                                                </div>
                                                <div class="r2">
                                                    <div class="r3">
                                                        <label for="exampleInputEmail1" class="r4">Model Name</label>
                                                        <span class="r5">*</span>
                                                        <input type="text" class="r6" id="exampleInputEmail1" style="background: #E4DEDE;" value="<?php echo $Modelname; ?>" disabled>
                                                    </div>
                                                </div>
                                                <!-- End  tag -->
                                            </div>

                                            <div class="r1">
                                                <div class="r2">
                                                    <div class="r3">
                                                        <label for="exampleInputEmail1" class="r4">Engine Number</label>
                                                        <span class="r5">*</span>
                                                        <input type="text" class="r6" id="exampleInputEmail1" style="background: #E4DEDE;" value="<?php echo $Enginenumber; ?>" disabled>
                                                    </div>
                                                </div>
                                                <div class="r2">
                                                    <div class="r3">
                                                        <label for="exampleInputEmail1" class="r4">Chassis Numner</label>
                                                        <span class="r5">*</span>
                                                        <input type="text" class="r6" id="exampleInputEmail1" style="background: #E4DEDE;" value="<?php echo $Chassisnumber; ?>" disabled>
                                                    </div>
                                                </div>
                                                <div class="r2">
                                                    <div class="r3">
                                                        <label for="exampleInputEmail1" class="r4">Approx Price</label>
                                                        <span class="r5">*</span>
                                                        <input type="number" class="r6" id="exampleInputEmail1" style="background: #E4DEDE;" value="<?php echo $ApproxPriceVehicle; ?>" disabled>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="r1">
                                                <div class="r2">
                                                    <div class="r3">
                                                        <label for="exampleInputEmail1" class="r4">Vehicle Register
                                                            Number</label>
                                                        <span class="r5">*</span>
                                                        <input type="text" class="r6" id="exampleInputEmail1" style="background: #E4DEDE;" value="<?php echo $Registernumber; ?>" disabled>
                                                    </div>
                                                </div>
                                                <div class="r2">
                                                    <div class="r3">
                                                        <label for="exampleInputEmail1" class="r4">Vehicle Color</label>
                                                        <span class="r5">*</span>
                                                        <input type="text" class="r6" id="exampleInputEmail1" style="background: #E4DEDE;" value="<?php echo $Vehiclecolor; ?>" disabled>
                                                    </div>
                                                </div>
                                                <div class="r2">
                                                    <div class="r3">
                                                        <label for="exampleInputEmail1" class="r4">Manufacturing
                                                            Year</label>
                                                        <span class="r5">*</span>
                                                        <input type="month" class="r6" id="exampleInputEmail1" style="background: #E4DEDE;" value="<?php echo $ManufacturingYearVehicle; ?>" disabled>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="r1">
                                                <div class="r2">
                                                    <div class="r3">
                                                        <label for="exampleInputEmail1" class="r4">Description of
                                                            Vehicle</label>
                                                        <span class="r5">*</span>
                                                        <input type="text" class="r6" id="exampleInputEmail1" style="background: #E4DEDE;" value="<?php echo $Descriptionvehicle; ?>" disabled>
                                                    </div>
                                                </div>
                                                <!-- <div class="r2">
                                            <div class="r3">
                                                <label for="exampleInputEmail1" class="r4">Upload Document</label>
                                                <span class="r5">*</span>

                                                <input type="file" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" name="vupload">
                                            </div>
                                        </div> -->


                                            </div>

                                        </div>



                                    </div>
                                <?php } ?>









                            </div>
                            <!-- officer's action  -->
                            <hr>
                            <h2><b>Take a action on application :</b></h2>
                            <div class="container-fluid ">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="exampleInputEmail1" class="form-label">Action Type</label>
                                        <select class="form-control" name="takeaction" required>
                                            <option selected value="">-Select-</option>
                                            <?php 
                                            if($_SESSION['cat'] == "Investigation Officer" )
                                            {
                                                echo '<option value="Approved">Approved</option>';
                                            }
                                           
                                            ?>
                                            
                                            <option value="Under Scrutiny">Under Scrutiny</option>
                                            <?php 
                                            if($_SESSION['cat'] == 'Police Station Officer')
                                            echo '<option value="Assign to IO">Assign to Investigation Officer</option>';

                                            ?>
                                            <option value="Rejected">Reject</option>

                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="actionBY" class="form-label">Action taken BY :</label>
                                        <input type="text" class="form-control" id="actionBY" style="background: #E4DEDE;" aria-describedby="ActionBY" value="<?php echo ($_SESSION["user"] . $cat); ?>" disabled>
                                    </div>
                                </div>
                                <div class="row mt-3 ">
                                    <div class="col-md-8">
                                        <label for="action Remark" class="form-label">Action Remarks :</label>
                                        <div class="mb-2">
                                            <textarea class="form-control" style="width: 100%; height: 60px;" maxlength="50" name="action_remark" placeholder="Remark Action taken by you  " required></textarea>
                                        </div>
                                    </div>
                                    <!-- End row tag -->
                                </div>
                            </div>

                            <center>
                                <div class="m-1">
                                <!-- <button type="submit" class="btn btn-success"  onclick="window.print();">Print</button> -->
                                    <button type="submit" class="btn btn-primary" value="action" name="actionn">Take
                                        Action</button>
                                    <!-- <button type="reset" class="btn btn-secondary "></button> -->
                                    <button type="button" class="btn btn-danger" onclick="location.href = '../manage_FIR.php?typ=P';">Cancel</button>
                                </div>
                            </center>
                        </form>





                        <!-- end form ---------------------------------------------- -->
                    </div>
                </div>
            </div>


        </div>


    </div>
    </div>


    <!-- toggole js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <script src="..\common/time.js"></script>
    <script src="..\common/date.js"></script>


    <!-- datatable js/jquery file -->
    <script src="..\common\myJS\jquery.min.js"></script>
    <script type="text/javascript" charset="utf8" src="..\common\myJS\jquery.datatables.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
if($done ==  true){
echo "
<script>
Swal.fire(
    'Action Taked Successfully!',
    '',
    'success'
  ).then(function() {
    window.location = '../manage_FIR.php?typ=P';
});
</script>";
}
?>

</body>

</html>