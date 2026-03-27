<?php
session_start();
$done = false;

//print_r($_SESSION);

if ($_SESSION["lg"] == false) {
    header("location:..\login.php");
}
else {
    $rno = $_GET["rno"];

    if (!isset($rno) || $rno == null) {
        header('location:..\e-app.php');
    }

    // retrive data from database table
    include '..\common\dbconfig.php';
    // $rno = $_GET['rno'];

    $qry = "SELECT * FROM `senior_citizen_reg_table` sct LEFT OUTER JOIN user_master um on sct.user_id=um.user_id LEFT OUTER JOIN city_table ct on ct.city_id=sct.city_id LEFT OUTER JOIN police_station_table pst on pst.police_station_id=sct.police_station_id LEFT OUTER JOIN document_table dt on dt.document_id=sct.document_id where sct.sc_reg_id=$rno;";
    $result = mysqli_query($con, $qry);
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            // form data from database
            $Firstname = $row['sc_fname'];
            $FatherName = $row['sc_mname'];
            $Surname = $row['sc_lname'];
            $UFirstname = $row['user_fname'];
            $UFatherName = $row['user_mname'];
            $USurname = $row['user_lname'];
            $PermanentAddress = $row['address'];
            $Emailaddress = $row['user_email'];
            $MobileNumber = $row['contact_no'];
            $LandlineNo = "";
            $NameofCity = $row['c_name'];
            $PoliceStation = $row['ps_name'];
            $YearOfRetirement = $row['year_retirement'];
            $RetiredFrom = $row['retired_institute'];
            $Health = $row['health'];
            $Family = $row['family'];
            $ResidingWith = $row['residing_with'];
            $NoofChildren = $row['no_of_child'];
            $SpouseName = $row['spouse_name'];
            $DateOfBirth = $row['dob'];
            $WeddingDate = $row['wedding_date'];
            $LastPoliceVisitDate = $row['lst_plc_visit_date'];
            $Relative_ServentDetails = $row['relative_details'];
            $FileDesk = $row['doc_type'];
        // $FileName = $row['File_Name'];
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
            $qry = "UPDATE `senior_citizen_reg_table` SET `action_taken` = '" . $action_tkn . "', `Remarks_act` = '" . $remark . "', `action_takenBY` = '" . $_SESSION["user"] . " (PSO)' WHERE `sc_reg_id` = " . $rno . ";";
            $res = mysqli_query($con, $qry);

            if ($res > 0) {
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Missing Report - Dashboard</title>


    <!-- website logo -->
    <link rel="icon" href="../img/weblogo1.ico" type="image/icon type" />


    <!-- css -->
    <link rel="stylesheet" href="..\css\Senior CitizenRegestration.css">

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
                        <img src="..\img\snr_citizen.png" width="30" height="30" class="d-inline-block align-top" alt="FIR_Service_LOGO">
                        <b>Missing Report - Services</b>
                    </a>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="..\index.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="..\Contact.php">Contact</a>
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
                <li class="breadcrumb-item"><a href="..\snr_citizen.php">Records - Senior citizen registration</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard - Senior Citizen</li>
            </ol>
        </nav>

        <!-- list of records -->

        <div class="row mt-1">
            <div class="col-md-12 ">
                <div class="card">
                    <div class="card-header">
                        <b style="font-size: xx-large;">Details of Senior citizen</b>
                    </div>
                    <div class="card-body">
                        <!-- --------------------------------------------------------------------------e - Application Form  -->
                        <form action="#" method="POST">

                            <h3 class="appdet"><u>Applicant Details</u></h3>


                            <div class="r1">

                                <div class="r2">
                                    <div class="r3">
                                        <label for="exampleInputEmail1" class="r4">First Name</label>
                                        <span class="r5"></span>
                                        <input type="text" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" style="background: #dbe1ebe6;" value="<?php echo $UFirstname; ?>" disabled>
                                    </div>

                                </div>
                                <div class="r2">
                                    <div class="r3">
                                        <label for="exampleInputEmail1" class="r4">Father's/Husband's Name</label>
                                        <span class="r5"></span>
                                        <input type="text" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" style="background: #dbe1ebe6;" value="<?php echo $UFatherName; ?>" disabled>
                                    </div>

                                </div>
                                <div class="r2">
                                    <div class="r3">
                                        <label for="exampleInputEmail1" class="r4">Surname</label>
                                        <span class="r5"></span>
                                        <input type="text" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" style="background: #dbe1ebe6;" value="<?php echo $USurname; ?>" disabled>
                                    </div>
                                </div>

                            </div>


                            <div class="r1">
                                <div class="r2">
                                    <div class="r3">
                                        <label for="exampleInputEmail1" class="r4">Permanent Address</label>
                                        <span class="r5"></span><br>
                                        <input type="text" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" style="background: #dbe1ebe6;" value="<?php echo $PermanentAddress; ?>" disabled>
                                    </div>

                                </div>
                                <div class="r2">
                                    <div class="r3">
                                        <label for="exampleInputEmail1" class="r4">Email address</label>
                                        <span class="r5"></span>
                                        <input type="email" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" style="background: #dbe1ebe6;" value="<?php echo $Emailaddress; ?>" disabled>
                                    </div>

                                </div>
                                <div class="r2">
                                    <div class="r3">
                                        <label for="exampleInputEmail1" class="r4">Mobile Number</label>
                                        <span class="r5"></span>
                                        <input type="number" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" style="background: #dbe1ebe6;" value="<?php echo $MobileNumber; ?>" disabled>
                                    </div>
                                </div>

                            </div>

                            <div class="r1">
                                <div class="r2">
                                    <div class="r3">
                                        <label for="exampleInputEmail1" class="r4">Landline No</label>
                                        <span class="r5"></span>
                                        <input type="number" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" style="background: #dbe1ebe6;" value="<?php echo $LandlineNo; ?>" disabled>
                                        <!-- _(If_available,_prefix_with_STD_Code) -->
                                    </div>

                                </div>



                            </div>


                            <h3 class="appdet"><u>Application Details</u></h3>
                            <div class="r1">

                                <div class="r2">
                                    <div class="r3">
                                        <label for="exampleInputEmail1" class="r4">SC First Name</label>
                                        <span class="r5"></span>
                                        <input type="text" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" style="background: #dbe1ebe6;" value="<?php echo $Firstname; ?>" disabled>
                                    </div>

                                </div>
                                <div class="r2">
                                    <div class="r3">
                                        <label for="exampleInputEmail1" class="r4"> SC Father's/Husband's Name</label>
                                        <span class="r5"></span>
                                        <input type="text" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" style="background: #dbe1ebe6;" value="<?php echo $FatherName; ?>" disabled>
                                    </div>

                                </div>
                                <div class="r2">
                                    <div class="r3">
                                        <label for="exampleInputEmail1" class="r4">SC Surname</label>
                                        <span class="r5"></span>
                                        <input type="text" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" style="background: #dbe1ebe6;" value="<?php echo $Surname; ?>" disabled>
                                    </div>
                                </div>

                            </div>
                            <div class="r1">
                                <div class="r2">
                                    <div class="r3">
                                        <label for="exampleInputEmail1" class="r4">Name of City</label>
                                        <span class="r5">*</span>
                                        <select class="r6" aria-label="Default select example" style="background: #dbe1ebe6;">
                                            <option selected><?php echo $NameofCity; ?></option>



                                        </select>
                                    </div>
                                </div>
                                <div class="r2">
                                    <div class="r3">
                                        <label for="exampleInputEmail1" class="r4">Police Station</label>
                                        <span class="r5">*</span>
                                        <select class="r6" aria-label="Default select example" style="background: #dbe1ebe6;">
                                            <option selected><?php echo $PoliceStation; ?></option>

                                        </select>
                                    </div>
                                </div>


                            </div>
                            <div class="r1">
                                <div class="r2">
                                    <div class="r3">
                                        <label for="exampleInputEmail1" class="r4">Year Of Retirement</label>
                                        <span class="r5"></span>
                                        <select class="r6" aria-label="Default select example" value="<?php echo $YearOfRetirement; ?>" disabled style="background: #dbe1ebe6;">
                                            <option selected>-Select-</option>




                                        </select>

                                    </div>
                                </div>
                                <div class="r2">
                                    <div class="r3">
                                        <label for="exampleInputEmail1" class="r4">Retired From</label>
                                        <span class="r5"></span>
                                        <input type="text" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" style="background: #dbe1ebe6;" value="<?php echo $RetiredFrom; ?>" disabled>
                                    </div>
                                </div>
                                <div class="r2">
                                    <div class="r3">
                                        <label for="exampleInputEmail1" class="r4">Health</label>
                                        <span class="r5"></span>
                                        <select class="r6" aria-label="Default select example" style="background: #dbe1ebe6;">
                                            <option selected><?php echo $Health; ?></option>

                                        </select>

                                    </div>
                                </div>

                            </div>
                            <div class="r1">
                                <div class="r2">
                                    <div class="r3">
                                        <label for="exampleInputEmail1" class="r4">Family</label>
                                        <span class="r5"></span>
                                        <select class="r6" aria-label="Default select example" style="background: #dbe1ebe6;">
                                            <option selected><?php echo $Family; ?></option>

                                        </select>

                                    </div>
                                </div>
                                <div class="r2">
                                    <div class="r3">
                                        <label for="exampleInputEmail1" class="r4">Residing with</label>
                                        <span class="r5"></span>
                                        <select class="r6" aria-label="Default select example" style="background: #dbe1ebe6;">
                                            <option selected><?php echo $ResidingWith; ?></option>

                                        </select>

                                    </div>
                                </div>
                                <div class="r2">
                                    <div class="r3">
                                        <label for="exampleInputEmail1" class="r4">No of Children</label>
                                        <span class="r5"></span>
                                        <input type="text" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" style="background: #dbe1ebe6;" value="<?php echo $NoofChildren; ?>" disabled>
                                    </div>
                                </div>

                            </div>

                            <h3 class="appdet"><u>Spouse Details</u></h3>

                            <div class="r1">
                                <div class="r2">
                                    <div class="r3">
                                        <label for="" class="r4">Spouse Name</label>
                                        <input type="text" class="r6" style="background: #dbe1ebe6;" value="<?php echo $SpouseName; ?>" disabled>

                                    </div>
                                </div>
                                <div class="r2">
                                    <div class="r3">
                                        <label for="" class="r4">Date Of Birth</label>
                                        <input type="date" class="r6" style="background: #dbe1ebe6;" value="<?php echo $DateOfBirth; ?>" disabled>
                                    </div>
                                </div>
                                <div class="r2">
                                    <div class="r3">
                                        <label for="" class="r4">Wedding Date</label>
                                        <input type="date" class="r6" style="background: #dbe1ebe6;" value="<?php echo $WeddingDate; ?>" disabled>
                                    </div>
                                </div>

                            </div>

                            <h3 class="appdet">Other Details</h3>

                            <div class="r1">
                                <div class="r2">
                                    <div class="r3">
                                        <label for="" class="r4">Last Police Visit Date</label>
                                        <input type="date" class="r6" style="background: #dbe1ebe6;" value="<?php echo $LastPoliceVisitDate; ?>" disabled>

                                    </div>
                                </div>

                            </div>
                            <div class="r1">
                                <div class="r2">
                                    <div class="r3">
                                        <label for="exampleInputEmail1" class="r4">Relative_Servent Details</label>
                                        <span class="r5"></span>
                                        <select class="r6" aria-label="Default select example" style="background: #dbe1ebe6;">
                                            <option selected><?php echo $Relative_ServentDetails; ?></option>

                                        </select>

                                    </div>
                                </div>

                            </div>

                            <h3 class="appdet">Attachment Details</h3>

                            <div class="r1">
                                <div class="r2">
                                    <div class="r3">
                                        <label for="" class="r4">File Desk</label>
                                        <span class="r5">*</span>
                                        <select class="r6" aria-label="Default select example" style="background: #dbe1ebe6;" name="File_Desk">
                                            <option value=""><?php echo $FileDesk; ?></option>

                                        </select>
                                    </div>
                                </div>

                                <!-- open document code -->
                                <!-- <div class="r2">
                                            <div class="r3">
                                                <label for="exampleInputPassword1" class="r4">
                                                    <h6>Open Document </h6>
                                                </label>
                                                <span class="r5"></span>
                                                    <a class="r6" href="http://localhost/e-FIR/FIR_project/FIR_upload_doc/mobile_doc/GSRTC_.pdf" target="_blank"> AADHAR.pdf</a>
                                            </div>
                                        </div> -->




                            </div>
                            <hr>
                            <h2>Take a action on application :</h2>
                            <div class="container-fluid ">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="exampleInputEmail1" class="form-label">Action Type</label>
                                        <select class="form-control" name="takeaction" required>
                                            <option selected value="">-Select-</option>
                                            <option value="Approved">Approved</option>
                                            <option value="Under Scrutiny">Under Scrutiny</option>
                                            <option value="Rejected">Reject</option>

                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="actionBY" class="form-label">Action taken BY :</label>
                                        <input type="text" class="form-control" id="actionBY" aria-describedby="ActionBY" value="<?php echo $_SESSION["user"] . " (PSO)"; ?>" style="background: #E4DEDE;"  disabled>
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






                            <center class="">
                                <div class="m-1">
                                    <button type="submit" class="btn btn-primary" value="action" name="actionn">Take Action</button>
                                    <!-- <button type="reset" class="btn btn-secondary "></button> -->
                                    <button type="reset" class="btn btn-danger">Cancel</button>
                                </div>
                            </center>

                        </form>




                    </div>

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
if ($done == true) {
    echo "
<script>
Swal.fire(
    'Action Taked Successfully!',
    '',
    'success'
  ).then(function() {
    window.location = '../snr_citizen.php';
});
</script>";
}
?>


</body>

</html>