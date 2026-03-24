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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Missing Report - Dashboard</title>


    <!-- website logo -->
    <link rel="icon" href="../img/weblogo1.ico" type="image/icon type" />


    <!-- css -->
    <link rel="stylesheet" href="..\css\msng_prsn.css">

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
                        <img src="..\img\rpt_prsn.png" width="30" height="30" class="d-inline-block align-top" alt="FIR_Service_LOGO">
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
                <li class="breadcrumb-item"><a href="..\rpt_missing_person.php">Missing reports</a></li>
                <li class="breadcrumb-item active" aria-current="page">Services - Missing Report</li>
            </ol>
        </nav>

        <!-- list of records -->

        <div class="row mt-0">
            <div class="col-md-12 ">
                <div class="card">
                    <div class="card-header">
                        <b style="font-size: xx-large;">Missing Report Details</b>
                    </div>
                    <div class="card-body">
                        <!-- --------------------------------------------------------------------------e - Application Form  -->
                        <!-- <h2 class="text-center "><b>Report Missing Person</b> </h2> -->

                        <form action="#" method="POST">
                            <h3 class="appdet"><u>Applicant Details</u> </h3>

                            <div class="r1">
                                <div class="r2">
                                    <div class="r3">
                                        <label for="exampleInputEmail1" class="r4">First Name</label>
                                        <span class="r5"></span>
                                        <input type="text" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" style="background: #dbe1ebe6;" value="<?php echo $uFirstname;?>" disabled>
                                    </div>

                                </div>
                                <div class="r2">
                                    <div class="r3">
                                        <label for="exampleInputEmail1" class="r4">Father Name</label>
                                        <span class="r5"></span>
                                        <input type="text" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" style="background: #dbe1ebe6;" value="<?php echo $uFatherName;?>" disabled>
                                    </div>

                                </div>
                                <div class="r2">
                                    <div class="r3">
                                        <label for="exampleInputEmail1" class="r4">surname</label>
                                        <span class="r5"></span>
                                        <input type="text" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" style="background: #dbe1ebe6;" value="<?php echo $usurname;?>" disabled>
                                    </div>
                                </div>

                            </div>

                            <div class="r1">
                                <div class="r2">
                                    <div class="r3">
                                        <label for="exampleInputEmail1" class="r4">Permanent Address</label>
                                        <span class="r5"></span>
                                        <input type="text" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" style="background: #dbe1ebe6;" value="<?php echo $PermanentAddress;?>" disabled>
                                    </div>

                                </div>
                                <div class="r2">
                                    <div class="r3">
                                        <label for="exampleInputEmail1" class="r4">Email address</label>
                                        <span class="r5"></span>
                                        <input type="email" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" style="background: #dbe1ebe6;" value="<?php echo $Emailaddress;?>" disabled>
                                    </div>
                                </div>
                                <div class="r2">
                                    <div class="r3">
                                        <label for="exampleInputEmail1" class="r4">Mobile Number</label>
                                        <span class="r5"></span>
                                        <input type="number" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" style="background: #dbe1ebe6;" value="<?php echo $MobileNumber;?>" disabled>
                                    </div>
                                </div>


                            </div>
                            <div class="r1">
                                <div class="r2">
                                    <div class="r3">
                                        <label for="exampleInputEmail1" class="r4">Landline No</label>
                                        <span class="r5"></span>
                                        <input type="number" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" style="background: #dbe1ebe6;" value="<?php echo $LandlineNo;?>" disabled>
                                    </div>

                                </div>

                            </div>
                            <div class="r1">

                            </div>

                            <h3 class="appdet"><u>Missing Person Details</u></h3>
                            <div class="r1">
                                <div class="r2">
                                    <div class="r3">
                                        <label for="exampleInputEmail1" class="r4">Missing Person First name</label>
                                        <span class="r5">*</span>
                                        <input type="text" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" style="background: #dbe1ebe6;" value="<?php echo $MissingPersonFirstname;?>" disabled>
                                    </div>

                                </div>
                                <div class="r2">
                                    <div class="r3">
                                        <label for="exampleInputEmail1" class="r4">Missing Person Father Name</label>
                                        <span class="r5"></span>
                                        <input type="text" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" style="background: #dbe1ebe6;" value="<?php echo $MissingPersonFathername;?>" disabled>
                                    </div>

                                </div>
                                <div class="r2">
                                    <div class="r3">
                                        <label for="exampleInputEmail1" class="r4">Missing Person surname</label>
                                        <span class="r5">*</span>
                                        <input type="text" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" style="background: #dbe1ebe6;" value="<?php echo $MissingPersonSurname;?>" disabled>
                                    </div>
                                </div>

                            </div>
                            <div class="r1">
                                <div class="r2">
                                    <div class="r3">
                                        <label for="exampleInputEmail1" class="r4">Date Of Birth</label>
                                        <span class="r5"></span>
                                        <input type="date" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" style="background: #dbe1ebe6;" value="<?php echo $DateOfBirth;?>" disabled>
                                    </div>
                                </div>


                                <div class="r2">
                                    <div class="r3">
                                        <label for="exampleInputEmail1" class="r4">Gender</label>
                                        <span class="r5">*</span>
                                        <select class="r6" aria-label="Default select example" style="background: #dbe1ebe6;" > 
                                            <option selected> <?php echo $Gender;?></option>
                                            


                                        </select>
                                    </div>
                                </div>
                                <div class="r2">
                                    <div class="r3">
                                        <label for="exampleInputEmail1" class="r4">Missing Person Description</label>
                                        <span class="r5">*</span>
                                        <!-- <input type="text" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" required name="Area"> -->
                                        <textarea name="Missing_Person_Description" class="r6" id="exampleInputEmail1" cols="30" rows="1.5" style="height: 38px;background: #dbe1ebe6;" disabled><?php echo $MissingPersonDescription;?>"</textarea>

                                    </div>
                                </div>
                            </div>



                            <div class="r1">
                                <div class="r2">
                                    <div class="r3">
                                        <label for="exampleInputEmail1" class="r4">Missing Date</label>
                                        <span class="r5">*</span>
                                        <input type="date" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" style="background: #dbe1ebe6;" value="<?php echo $Missingdate;?>" disabled>
                                    </div>
                                </div>
                                <div class="r2">
                                    <div class="r3">
                                        <label for="exampleInputEmail1" class="r4">Missing Time</label>
                                        <span class="r5">*</span>
                                        <input type="text" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" style="background: #dbe1ebe6;" value="<?php echo $MissingTime;?>" disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="r1">
                                <div class="r2">
                                    <div class="r3">
                                        <label for="exampleInputEmail1" class="r4">Religion</label>
                                        <span class="r5">*</span>
                                        <select class="r6" aria-label="Default select example" style="background: #dbe1ebe6;">
                                            <option selected><?php echo $Religion;?></option>



                                        </select>
                                    </div>


                                </div>
                                <div class="r2">
                                    <div class="r3">
                                        <label for="exampleInputEmail1" class="r4">Caste</label>
                                        <span class="r5"></span>
                                        <select class="r6" aria-label="Default select example"  style="background: #dbe1ebe6;">
                                            <option selected><?php echo $Caste;?></option>
                                        </select>
                                    </div>

                                </div>
                                <div class="r2">
                                    <div class="r3">
                                        <label for="exampleInputEmail1" class="r4">Category</label>
                                        <span class="r5"></span>
                                        <select class="r6" aria-label="Default select example"  style="background: #dbe1ebe6;">
                                            <option selected><?php echo $Caste;?></option>


                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="r1">
                                <div class="r2">
                                    <div class="r3">
                                        <label for="exampleInputEmail1" class="r4">Occupation</label>
                                        <span class="r5"></span>
                                        <select class="r6" aria-label="Default select example" style="background: #dbe1ebe6;">
                                            <option selected><?php echo $Occupation;?></option>
                                          




                                        </select>


                                    </div>
                                </div>
                                <div class="r2">
                                    <div class="r3">
                                        <label for="exampleInputEmail1" class="r4">Height</label>
                                        <span class="r5">*</span>
                                        <input type="text" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" style="background: #dbe1ebe6;" value="<?php echo $Height;?>" disabled>
                                    </div>

                                </div>
                                <div class="r2">
                                    <div class="r3">
                                        <label for="exampleInputEmail1" class="r4">Weight</label>
                                        <span class="r5">*</span>
                                        <input type="text" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" style="background: #dbe1ebe6;" value="<?php echo $Weight;?>" disabled>
                                    </div>
                                </div>
                            </div>


                            




                            

                            <h2 class="appdet"><u>Place Of Missing</u></h2>
                            <div class="r1">
                                <div class="r2">
                                    <div class="r3">
                                        <label for="exampleInputEmail1" class="r4">Place Of Missing Country</label>
                                        <span class="r5">*</span>
                                        <select class="r6" aria-label="Default select example" style="background: #dbe1ebe6;">

                                            <option selected >India</option>



                                        </select>

                                    </div>
                                </div>
                                <div class="r2">
                                    <div class="r3">
                                        <label for="exampleInputEmail1" class="r4">Place Of Missing State</label>
                                        <span class="r5">*</span>
                                        <select class="r6" aria-label="Default select example" style="background: #dbe1ebe6;" >
                                            <option selected>Gujarat</option>



                                        </select>


                                    </div>
                                </div>
                                <div class="r2">
                                    <div class="r3">
                                        <label for="exampleInputEmail1" class="r4">Place Of Missing Pin Code</label>
                                        <span class="r5"></span>
                                        <input type="text" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" style="background: #dbe1ebe6;" value="<?php echo $PlaceOfMissingPinCode;?>" disabled>
                                    </div>
                                </div>
                            </div>



                            <div class="r1">
                                <div class="r2">
                                    <div class="r3">
                                        <label for="exampleInputEmail1" class="r4">Place Of Missing City</label>
                                        <span class="r5">*</span>
                                        <select class="r6" aria-label="Default select example" style="background: #dbe1ebe6;">
                                            <option selected>Ahmedabad City</option>
                                            
                                        </select>

                                    </div>

                                </div>
                                <div class="r2">
                                    <div class="r3">
                                        <label for="exampleInputEmail1" class="r4">Place Of Missing Area</label>
                                        <span class="r5">*</span>
                                        <!-- <input type="text" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" required name="Area"> -->
                                        <textarea name="Place_Of_Missing_Area" class="r6" id="exampleInputEmail1" cols="30" rows="1.5" style="height: 38px;background: #dbe1ebe6;" disabled><?php echo $PlaceOfMissingArea;?></textarea>


                                    </div>
                                </div>


                            </div>
                            <h2 class="appdet"><u>Reporting Police Station Details</u></h2>
                            <div class="r1">
                                <div class="r2">
                                    <div class="r3">
                                        <label for="exampleInputEmail1" class="r4">Reporting PS City</label>
                                        <span class="r5">*</span>
                                        <select class="r6" aria-label="Default select example" style="background: #dbe1ebe6;">
                                            <option selected>Ahmedabad City</option>




                                        </select>
                                    </div>
                                </div>
                                <div class="r2">
                                    <div class="r3">
                                        <label for="exampleInputEmail1" class="r4">Police Station</label>
                                        <span class="r5"></span>
                                        <select class="r6" aria-label="Default select example" style="background: #dbe1ebe6;">
                                            <option selected><?php echo $PoliceStation?></option>
                                           
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <h4 class="appdet">Brief Description <span class="r5">*</span> (Maximum 2000 Characters)</43>
                                <div class="r1">
                                    <div class="r2">
                                        <div class="r3">
                                            <textarea name="Brief_Description" class="r6" style="width: 920px;background: #dbe1ebe6;font-size: 17px;"><?php echo $BriefDescription?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="r1">
                                        <div class="r2">
                                            <div class="r3">
                                                <label for="exampleInputPassword1" class="r4">
                                                    <h6>Document Type</h6>
                                                </label>
                                                <span class="r5"></span>
                                                <select class="r6" aria-label="Default select example" style="background: #dbe1ebe6;">
                                                    <option selected><?php echo $DocumentType?></option>
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
                                    

                                </div>
                                
                                <hr>
                                <h2>Take a action on application :</h2>
                                            <div class="container-fluid ">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1" class="form-label">Action Type</label>
                                                        <select class="form-control"  name="takeaction" required>
                                                            <option selected value="">-Select-</option>
                                                            <option value="Approved">Approved</option>
                                                            <option value="Under Scrutiny">Under Scrutiny</option>
                                                            <option value="Rejected">Reject</option>

                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="actionBY" class="form-label">Action taken BY :</label>
                                                        <input type="text" class="form-control" id="actionBY" aria-describedby="ActionBY" value="<?php echo $_SESSION["user"] ." (PSO)"; ?>" style="background: #E4DEDE;"  disabled>
                                                    </div>
                                                </div>
                                                <div class="row mt-3 ">
                                                    <div class="col-md-8">
                                                        <label for="action Remark" class="form-label">Action Remarks:</label>
                                                        <div class="mb-2">
                                                            <textarea class="form-control"  style="width: 100%; height: 60px;" maxlength="50" name="action_remark" placeholder="Remark Action taken by you  " required></textarea>
                                                        </div>
                                                    </div>
                                                    <!-- End row tag -->
                                                </div>
                                            </div>


                                <div>
                                    <center class="">
                                    <div class="m-1">
                                                    <button type="submit" class="btn btn-primary" value="action" name="actionn">Take Action</button>
                                                    <!-- <button type="reset" class="btn btn-secondary "></button> -->
                                                    <button type="reset" class="btn btn-danger">Cancel</button>
                                                </div>
                                    </center>

                                </div>

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
if($done ==  true){
echo "
<script>
Swal.fire(
    'Action Taked Successfully!',
    '',
    'success'
  ).then(function() {
    window.location = '../rpt_missing_person.php';
});
</script>";
}
?>

</body>

</html>