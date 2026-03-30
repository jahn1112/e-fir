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
include '../common/dbconfig.php';
// $rno = $_GET['rno'];

$qry = "SELECT efm.e_fir_id, efm.sbmt_date, efm.occurrance_area,efm.police_station_occurance_place,efm.file_name,efm.occurance_pincode,efm.distance_from_ps,efm.occurence_of_offence_date_from,efm.occurence_of_offence_date_to,efm.occurenece_of_offence_time_from,efm.occurenece_of_offence_time_to,efm.occupation,efm.first_info_contents,efm.delayed_reason,um.address,um.user_fname,um.user_mname,um.user_lname,um.contact_no,um.user_dob,rt.religion_name,um.pincode,smt.mobile_number,smt.model as m_model,smt.imei_number,smt.approx_price as m_price,smt.manufacturing_year as m_manufactureyear,smt.service_provider,smt.color,smt.description_of_mobile,vt.vehicle_type,vt.name_of_manufacture,vt.model,vt.engine_number,vt.chassis_number,upper(vt.vehicle_reg_number) as vehicle_reg_number,vt.color as v_color,vt.manufacturing_year,vt.approx_price,vt.description_of_vehicle,typ.fir_type,rt.religion_name

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
        $sbmt_date = $row['sbmt_date'];
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
    <link rel="icon" href="../img\weblogo1.ico" type="image/icon">
    <!-- Google Font: Outfit & Poppins -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700&display=swap">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Theme foundations -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <!-- Modern Admin Style Overrides -->
    <link rel="stylesheet" href="../css/admin_glass.css">
    <style>
        .detail-card {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid var(--glass-border);
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 25px;
            backdrop-filter: blur(10px);
        }
        .section-title {
            color: var(--accent);
            font-family: 'Outfit', sans-serif;
            font-weight: 700;
            border-bottom: 2px solid var(--accent);
            display: inline-block;
            margin-bottom: 20px;
            padding-bottom: 5px;
        }
        .info-label {
            color: rgba(255,255,255,0.6);
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 5px;
        }
        .info-value {
            color: #fff;
            font-weight: 500;
            font-size: 1.05rem;
            margin-bottom: 15px;
        }
        .form-control:disabled {
            background: rgba(0,0,0,0.2) !important;
            border: 1px solid var(--glass-border);
            color: #fff !important;
            opacity: 0.8;
        }
    </style>




</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Import all Navbar -->
        <?php 
        // Adjust paths for nested directory
        $base_url = "../";
        include "../common/_navbar.php"; 
        ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h1 class="m-0">FIR Investigation Dashboard</h1>
                        <span class="badge badge-info p-2" style="font-size: 1.1rem; background: var(--secondary) !important; border: 1px solid var(--accent);">
                            <?php $year = date('Y', strtotime($sbmt_date ?? 'now')); ?>
                            <i class="fas fa-file-invoice mr-2"></i> GJFIR<?php echo $year . sprintf('%04d', $rno); ?>
                        </span>
                    </div>
                </div>
            </div>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

        <!-- list of records -->

                <div class="card bg-transparent border-0 shadow-none">
                    <div class="card-body p-0">
                        <form action="#" method="POST">
                            <!-- Complainant Details Section -->
                            <div class="detail-card">
                                <h4 class="section-title">Complainant Information</h4>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="info-label">First Name</div>
                                        <input type="text" class="form-control" value="<?php echo $Firstname; ?>" disabled>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="info-label">Father's/Husband's Name</div>
                                        <input type="text" class="form-control" value="<?php echo $FatherName; ?>" disabled>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="info-label">Surname</div>
                                        <input type="text" class="form-control" value="<?php echo $surname; ?>" disabled>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-4">
                                        <div class="info-label">Date Of Birth</div>
                                        <input type="date" class="form-control" value="<?php echo $dob; ?>" disabled>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="info-label">Religion</div>
                                        <input type="text" class="form-control" value="<?php echo $religion; ?>" disabled>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="info-label">Occupation</div>
                                        <input type="text" class="form-control" value="<?php echo $occupation; ?>" disabled>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <div class="info-label">Current Address</div>
                                        <textarea class="form-control" rows="3" disabled><?php echo $address; ?></textarea>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="info-label">Contact Number</div>
                                        <input type="text" class="form-control" value="<?php echo $Mobilenumber; ?>" disabled>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="info-label">Pincode</div>
                                        <input type="text" class="form-control" value="<?php echo $upincode; ?>" disabled>
                                    </div>
                                </div>
                            </div>

                            <!-- Occurrence Details Section -->
                            <div class="detail-card">
                                <h4 class="section-title">Details of Occurrence</h4>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="info-label">Date From</div>
                                        <input type="date" class="form-control" value="<?php echo $Datefrom; ?>" disabled>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="info-label">Time From</div>
                                        <input type="time" class="form-control" value="<?php echo $Timefrom; ?>" disabled>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="info-label">Date To</div>
                                        <input type="date" class="form-control" value="<?php echo $Dateto; ?>" disabled>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="info-label">Time To</div>
                                        <input type="time" class="form-control" value="<?php echo $Timeto; ?>" disabled>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-3">
                                        <div class="info-label">Distance from Police Station</div>
                                        <input type="text" class="form-control" value="<?php echo $Distancestation; ?> KM" disabled>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info-label">Occurrence Address</div>
                                        <textarea class="form-control" rows="2" disabled><?php echo $Occurance_Address; ?></textarea>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="info-label">Police Station</div>
                                        <input type="text" class="form-control" value="<?php echo $Policestation; ?>" disabled>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <div class="info-label">Brief Description of Incident</div>
                                        <div class="p-3 mb-2" style="background: rgba(0,0,0,0.2); border: 1px solid var(--glass-border); border-radius: 8px; color: #fff; min-height: 100px;">
                                            <?php echo nl2br($BriefDesc); ?>
                                        </div>
                                    </div>
                                </div>
                                <?php if(!empty($delayed_reason)): ?>
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <div class="info-label text-warning">Reason for Delay</div>
                                        <div class="p-3" style="background: rgba(180, 83, 9, 0.1); border: 1px solid rgba(180, 83, 9, 0.3); border-radius: 8px; color: #fbbf24;">
                                            <?php echo nl2br($delayed_reason); ?>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>

                            <!-- Specific Evidence (Mobile/Vehicle) -->
                            <?php if ($FIR_type == 'Mobile' || $FIR_type == 'mobile'): ?>
                            <div class="detail-card">
                                <h4 class="section-title">Stolen Mobile Information</h4>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="info-label">Model Name</div>
                                        <input type="text" class="form-control" value="<?php echo $Mobilemodel; ?>" disabled>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="info-label">Color</div>
                                        <input type="text" class="form-control" value="<?php echo $Mobilecolor; ?>" disabled>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="info-label">IMEI Number</div>
                                        <input type="text" class="form-control" value="<?php echo $IMEInumber; ?>" disabled>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-4">
                                        <div class="info-label">Mobile Number</div>
                                        <input type="text" class="form-control" value="<?php echo $mobile_number; ?>" disabled>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="info-label">Service Provider</div>
                                        <input type="text" class="form-control" value="<?php echo $Simcard; ?>" disabled>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="info-label">Approx Price</div>
                                        <input type="text" class="form-control" value="₹<?php echo $ApproxPriceMobile; ?>" disabled>
                                    </div>
                                </div>
                            </div>
                            <?php elseif ($FIR_type == 'Vehicle' || $FIR_type == 'vehicle'): ?>
                            <div class="detail-card">
                                <h4 class="section-title">Stolen Vehicle Information</h4>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="info-label">Vehicle Type</div>
                                        <input type="text" class="form-control" value="<?php echo $Vehicletype; ?>" disabled>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="info-label">Manufacturer Name</div>
                                        <input type="text" class="form-control" value="<?php echo $Manufacturename; ?>" disabled>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="info-label">Model Name</div>
                                        <input type="text" class="form-control" value="<?php echo $Modelname; ?>" disabled>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="info-label">Register Number</div>
                                        <input type="text" class="form-control" value="<?php echo $Registernumber; ?>" disabled style="text-transform: uppercase; font-weight: 700;">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-4">
                                        <div class="info-label">Engine Number</div>
                                        <input type="text" class="form-control" value="<?php echo $Enginenumber; ?>" disabled>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="info-label">Chassis Number</div>
                                        <input type="text" class="form-control" value="<?php echo $Chassisnumber; ?>" disabled>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="info-label">Approx Price</div>
                                        <input type="text" class="form-control" value="₹<?php echo $ApproxPriceVehicle; ?>" disabled>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>

                            <!-- Officer Action Section -->
                            <div class="detail-card" style="border: 2px solid var(--accent); background: rgba(14, 165, 233, 0.05);">
                                <h4 class="section-title">Take Investigative Action</h4>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="info-label">Investigation Status</label>
                                        <select class="form-control" name="takeaction" required style="background: rgba(255,255,255,0.05); color: #fff; border: 1px solid var(--glass-border);">
                                            <option selected value="">- Select Action -</option>
                                            <?php if($_SESSION['cat'] == "Investigation Officer"): ?>
                                                <option value="Approved">Case Competed / Approved</option>
                                            <?php endif; ?>
                                            <option value="Under Scrutiny">Maintain Under Scrutiny</option>
                                            <?php if($_SESSION['cat'] == 'Police Station Officer'): ?>
                                                <option value="Assign to IO">Forward to Investigation Officer</option>
                                            <?php endif; ?>
                                            <option value="Rejected">Reject Case</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="info-label">Acting Officer</label>
                                        <input type="text" class="form-control" value="<?php echo ($_SESSION["user"] . $cat); ?>" disabled>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <label class="info-label">Investigative Remarks</label>
                                        <textarea class="form-control" name="action_remark" rows="3" maxlength="255" placeholder="Document the findings or reasons for this action..." required style="background: rgba(255,255,255,0.05); color: #fff; border: 1px solid var(--glass-border);"></textarea>
                                    </div>
                                </div>
                                <div class="mt-4 text-center">
                                    <button type="submit" class="btn btn-primary px-5 py-2 mr-3" name="actionn" style="background: linear-gradient(135deg, var(--accent), #0ea5e9); border: none; font-weight: 600;">
                                        <i class="fas fa-check-circle mr-2"></i> Submit Investigative Action
                                    </button>
                                    <button type="button" class="btn btn-outline-danger px-5 py-2" onclick="location.href = '../manage_FIR.php?typ=P';">
                                        <i class="fas fa-times-circle mr-2"></i> Cancel
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>





            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Import Footer -->
    <?php include "../common/_footer.php"; ?>
</div>
<!-- ./wrapper -->

    <!-- jQuery & Bootstrap -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.js"></script>
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