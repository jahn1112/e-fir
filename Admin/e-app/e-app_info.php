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

    $qry = "SELECT * FROM `e_application_table` e LEFT JOIN user_master u ON e.user_id = u.user_id LEFT JOIN police_station_table as ps ON e.police_station_id = ps.police_station_id WHERE e_application_id = $rno;";
    $result = mysqli_query($con, $qry);
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            // user data
            $firstname = $row['user_fname'];
            $middlename = $row['user_mname'];
            $lastname = $row['user_lname'];
            $uaddress = $row['address'];
            $email = $row['user_email'];
            $mobile = $row['contact_no'];
            $pincode = $row['pincode'];

            $occurence_address = $row['occurance_address'];
            $apptype = $row['application_type'];
            $occurance_date = $row['occurance_date'];
            $occurance_time = $row['occurance_time'];
            $desc = $row['brief_desc'];
            $policestation = $row['ps_name'];
        }
    }

    // Update Actions 
    // 

    if (isset($_POST['actionn'])) {
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $action_tkn = $_POST['takeaction'];
            // echo "cdcmlm";
            $rno = $_GET["rno"];
            // $action_tknBY = $_POST['action_by'];
            $remark = $_POST['action_remark'];
            
            // echo "callled";
            $qry = "UPDATE `e_application_table` SET `action_taken` = '".$action_tkn."', `Remarks_act` = '".$remark."', `action_takenBY` = '".$_SESSION["user"] ." (PSO)' WHERE `e_application_id` = ".$rno.";";
            $res = mysqli_query($con,$qry);
       
            if($res > 0)
            {
                $done = true;
                // echo "update";
                $_GET['rno'] = null;
                if (!isset($rno) || $rno == null) {
                    header('location:..\e-app.php');
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
    <title>Application - Dashboard</title>


    <!-- website logo -->
    <link rel="icon" href="../img/weblogo1.ico" type="image/icon type" />


    <!-- css -->

    <link rel="stylesheet" href="..\css\e-app.css">

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
                <li class="breadcrumb-item"><a href="..\e-app.php">E-application</a></li>
                <li class="breadcrumb-item active" aria-current="page">Application - services</li>
            </ol>
        </nav>

        <!-- list of records -->

        <div class="row mt-1">
            <div class="col-md-12 ">
                <div class="card">
                    <div class="card-header">
                        <b style="font-size: xx-large;">List of Application</b>
                    </div>
                    <div class="card-body">
                        <!-- --------------------------------------------------------------------------e - Application Form  -->
                        <h2 class="text-center "><b>E-Application</b> </h2>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col">
                                    <h3><u>Applicant Details</u> </h3>
                                    <form action=""  method="POST">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="mb-2">
                                                    <label for="exampleInputEmail1" class="form-label">First Name</label>
                                                    <span id="required"></span>
                                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $firstname ?>" disabled>
                                                </div>

                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-2">
                                                    <label for="exampleInputEmail1" class="form-label">Father's/Husband's Name</label>
                                                    <span id="required"></span>
                                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $middlename ?>" disabled>
                                                </div>

                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-2">
                                                    <label for="exampleInputEmail1" class="form-label">Surname</label>
                                                    <span id="required"></span>
                                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $lastname ?>" disabled>
                                                </div>
                                            </div>

                                        </div>

                                        <!-- end row tag -->
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="mb-2">
                                                    <label for="exampleInputEmail1" class="form-label">Permanent Address</label>
                                                    <span id="required"></span>
                                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $uaddress ?>" disabled>
                                                </div>

                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-2">
                                                    <label for="exampleInputEmail1" class="form-label">Email</label>
                                                    <span id="required"></span>
                                                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $email ?>" disabled>
                                                </div>

                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-2">
                                                    <label for="exampleInputEmail1" class="form-label">Mobile Number</label>
                                                    <span id="required"></span>
                                                    <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $mobile ?>" disabled>
                                                </div>
                                            </div>

                                        </div>
                                        <!-- end row tag -->
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="mb-2">
                                                    <label for="exampleInputEmail1" class="form-label">Landline No. (If available, prefix
                                                        with STD Code)</label>
                                                    <span id="required"></span>
                                                    <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo "" ?>" disabled>
                                                </div>

                                            </div>

                                            <div class="col-md-4">
                                                <div class="mb-2">
                                                    <label for="exampleInputEmail1" class="form-label">Pin Code</label>
                                                    <span id="required"></span>
                                                    <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $pincode ?>" disabled>
                                                </div>
                                            </div>

                                        </div>

                                        <h4><u>Incident Occurance Place</u> </h4>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="mb-2">
                                                    <label for="exampleInputEmail1" class="form-label">Country</label>
                                                    <span id="required">*</span>
                                                    <select class="form-control" aria-label="Default select example" disabled>
                                                        <option>-Select-</option>
                                                        <option value="1" selected>India</option>
                                                        <!-- only for india -->


                                                    </select>

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-2">
                                                    <label for="exampleInputEmail1" class="form-label">State</label>
                                                    <span id="required">*</span>
                                                    <select class="form-control" aria-label="Default select example" disabled>
                                                        <option selected>-Select-</option>
                                                        <option value="12" selected>Gujarat</option>
                                                    </select>

                                                </div>
                                            </div>
                                            <!-- End row tag -->
                                        </div>


                                        <div class="row">

                                            <div class="col-md-8">
                                                <div class="mb-2">
                                                    <label for="exampleInputEmail1" class="form-label"> Occurance Area</label>
                                                    <span id="required">*</span>
                                                    <textarea class="form-control" name id style="width: 100%;" maxlength="300" disabled><?php echo $occurence_address ?></textarea>
                                                </div>
                                            </div>

                                            <!-- End row tag -->
                                        </div>
                                        <h4><u>Complaint/Application Details</u> </h4>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="mb-2">
                                                    <label for="exampleInputEmail1" class="form-label">Type</label>
                                                    <span id="required">*</span>
                                                    <select class="form-control" aria-label="Default select example" disabled>
                                                        <?php

                                                        echo " <option selected>" . $apptype . "</option>";

                                                        ?>

                                                    </select>

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-2">
                                                    <label for="exampleInputEmail1" class="form-label">City/District</label>
                                                    <span id="required">*</span>
                                                    <select class="form-control" aria-label="Default select example" disabled>

                                                        <option value="1" selected>Ahmedabad City</option>

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-2">
                                                    <label for="exampleInputEmail1" class="form-label">Police Station</label>
                                                    <span id="required"></span>
                                                    <select class="form-control" aria-label="Default select example" disabled>
                                                        <option selected><?php echo $policestation; ?></option>
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- End row tag -->
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="mb-2">
                                                    <label for="exampleInputEmail1" class="form-label">Occurance Date</label>
                                                    <span id="required">*</span>
                                                    <input type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $occurance_date ?>" disabled>

                                                </div>

                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-2">
                                                    <label for="exampleInputEmail1" class="form-label">Occurance Time</label>
                                                    <span id="required"></span>
                                                    <input type="time" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $occurance_time ?>" disabled>

                                                </div>

                                            </div>
                                            <!-- End row tag -->
                                        </div>

                                        <h4>Brief Description <span id="brief">*</span> (Maximum 300 Characters)</43>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="mb-2">
                                                        <textarea class="form-control" name id style="width: 100%; height: 180px;" maxlength="300" disabled><?php echo $desc ?></textarea>
                                                    </div>
                                                </div>
                                                <!-- End row tag -->
                                            </div>
                                            <!-- officer's action  -->
                                            <hr>
                                            <h2><b>Take a action on application :</b></h2>
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
                                                        <label for="action Remark" class="form-label">Action Remarks :</label>
                                                        <div class="mb-2">
                                                            <textarea class="form-control"  style="width: 100%; height: 60px;" maxlength="50" name="action_remark" placeholder="Remark Action taken by you  " required></textarea>
                                                        </div>
                                                    </div>
                                                    <!-- End row tag -->
                                                </div>
                                            </div>

                                            <center>
                                                <div class="m-1">
                                                    <button type="submit" class="btn btn-primary" value="action" name="actionn">Take Action</button>
                                                    <!-- <button type="reset" class="btn btn-secondary "></button> -->
                                                    <button type="reset" class="btn btn-danger">Cancel</button>
                                                </div>
                                            </center>


                                    </form>

                                </div>
                            </div>
                        </div>




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
    window.location = '../e-app.php';
});
</script>";
}
?>
</body>

</html>