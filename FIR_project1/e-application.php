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

// add by parimal
//logged user details from database
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
        $country = $_POST['Country'];
        $state = $_POST['State'];
        $Pincode = $_POST['Pin_Code'];
        $city = $_POST['City'];
        $Occuranceaddress = $_POST['Occurance_Address'];
        $Applicationdetails = $_POST['Application_Details'];
        $Citydistrict = $_POST['City_District'];
        $Policestation = $_POST['Police_Station'];
        $Occurancedate = $_POST['Occurance_Date'];
        $Occurancetime = $_POST['Occurance_Time'];
        $brief = $_POST['Brief'];
        $document = $_POST['Document'];
        // $Uploaddocument = $_POST['Upload_Document'];
        // Upload_Document

        
        if (isset($_FILES['upldfile'])) {
           
            $file_name = $_FILES["upldfile"]["name"];
            $file_size = $_FILES["upldfile"]["size"];
            $file_tmp = $_FILES["upldfile"]["tmp_name"];
            $file_type = $_FILES["upldfile"]["type"];

            // print_r($_POST);
            if ($file_type == 'application/pdf' || $file_type == 'image/jpeg' || $file_type == 'image/png') {
                $res =  move_uploaded_file($file_tmp, "./e_app_doc/" . $file_name);
                if ($res) {

                    $sql = "INSERT INTO `e_application_table` (`e_application_id`, `user_id`, `occurance_address`, `pincode`, `police_station_id`, `application_type`, `occurance_date`, `occurance_time`, `brief_desc`, `document_id`,  `sbmt_date`) VALUES (NULL, '" . $userid . "', '" . $Occuranceaddress . "', '" . $Pincode . "', '" . $Policestation . "', '" . $Applicationdetails . "', '" . $Occurancedate . "', '" . $Occurancetime . "', '" . $brief . "', '" . $document . "', current_timestamp());";
                    $result = mysqli_query($con, $sql);

                    if ($result) {
                        echo "<script>alert('e-Application Form Submited')</script>";
                    } else {
                        echo 'The record was not inserted successfully because of this error' . mysqli_error($con);
                    }
                } else {
                    // $docalert = true;
                    echo "<script>alert('The uploaded file is in incorrect format...')</script>";
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
    <title>e-application</title>
    <!-- website logo -->
    <link rel="icon" href="img\weblogo1.ico" type="image/icon">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="form_theme.css">
    <link rel="stylesheet" href="e-application.css">
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



        <div class="t">
            <h2><b>E-Application</b> </h2>
        </div>
        <form action="#" method="POST" enctype="multipart/form-data">
            <div class="app1">
                <div class="">
                    <div class="app2">
                        <h3 class="appdet"><u>Applicant Details</u> </h3>

                        <div class="r1">
                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">First Name</label>
                                    <span class="r5"></span>
                                    <input type="text" class="r6" class="exampleInputEmail1" aria-describedby="emailHelp" style="background: #E4DEDE;" value="<?php echo $ufname; ?>" disabled>
                                </div>

                            </div>
                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">Father's/Husband's Name</label>
                                    <span class="r5"></span>
                                    <input type="text" class="r6" class="exampleInputEmail1" aria-describedby="emailHelp" style="background: #E4DEDE;" value="<?php echo $umname; ?>" disabled>
                                </div>

                            </div>
                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">surname</label>
                                    <span class="r5"></span>
                                    <input type="text" class="r6" class="exampleInputEmail1" aria-describedby="emailHelp" style="background: #E4DEDE;" value="<?php echo $ulname; ?>" disabled>
                                </div>
                            </div>

                        </div>


                        <div class="r1">
                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">Permanent Address</label>
                                    <span class="r5"></span>
                                    <textarea class="r6" id="textAreaExample1" rows="4"  disabled><?php echo $uaddress ?></textarea>
                                </div>

                            </div>
                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">Email</label>
                                    <span class="r5"></span>
                                    <input type="email" class="r6" class="exampleInputEmail1" aria-describedby="emailHelp" style="background: #E4DEDE;" value="<?php echo $uemail; ?>" disabled>
                                </div>

                            </div>
                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">Mobile Number</label>
                                    <span class="r5"></span>
                                    <input type="number" class="r6" class="exampleInputEmail1" aria-describedby="emailHelp" style="background: #E4DEDE;" value="<?php echo $ucontact; ?>" disabled>
                                </div>
                            </div>

                        </div>
                        <div class="r1">
                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">Landline No. (If available, prefix
                                        with STD Code)</label>
                                    <span class="r5"></span>
                                    <input type="tel" class="r6" class="exampleInputEmail1" aria-describedby="emailHelp" style="background: #E4DEDE;" value="NA" disabled>
                                </div>

                            </div>

                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">Pin Code</label>
                                    <span class="r5"></span>
                                    <input type="number" class="r6" class="exampleInputEmail1" aria-describedby="emailHelp" style="background: #E4DEDE;" value="<?php echo $upincode; ?>" disabled>
                                </div>
                            </div>

                        </div>

                        <h4 class="appdet"><u>Incident Occurance Place</u> </h4>
                        <div class="r1">
                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">Country</label>
                                    <span class="r5">*</span>
                                    <select class="r6" aria-label="Default select example" name="Country" id="select">
                                        <option selected>-Select-</option>
                                        <option value="1">India</option>



                                    </select>

                                </div>
                            </div>
                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">State</label>
                                    <span class="r5">*</span>
                                    <select class="r6" aria-label="Default select example" name="State" id="select" required>
                                        <option selected>-Select-</option>
                                        <option value="1">Gujarat</option>


                                    </select>

                                </div>
                            </div>
                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">Pin Code</label>
                                    <span class="r5">*</span>
                                    <input type="text" class="r6" class="exampleInputEmail1" aria-describedby="emailHelp" name="Pin_Code" required>
                                </div>
                            </div>
                        </div>


                        <div class="r1">
                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">City</label>
                                    <span class="r5">*</span>
                                    <select class="r6" aria-label="Default select example" name="City" id="select" required>
                                        <option selected>-Select-</option>
                                        <option value="1">Ahmedabad City</option>
                                        <option value="2">Surat City</option>
                                        <option value="3">Vadodara City</option>

                                    </select>

                                </div>
                            </div>
                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">Occurance Address</label>
                                    <span class="r5">*</span>
                                    <textarea class="r6" id="textAreaExample1" maxlength="300" name="Occurance_Address" required></textarea>
                                </div>
                            </div>

                        </div>
                        <h4 class="appdet"><u>Complaint/Application Details</u> </h4>
                        <div class="r1">
                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">Type</label>
                                    <span class="r5">*</span>
                                    <select class="r6" aria-label="Default select example" name="Application_Details" id="select" required>
                                        <option selected>-Select-</option>
                                        <option value="Application">Application</option>
                                        <option value="Information">Information</option>
                                        <option value="Cyber Crime">Cyber Crime</option>

                                    </select>

                                </div>
                            </div>
                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">City/District</label>
                                    <span class="r5">*</span>
                                    <select class="r6" aria-label="Default select example" name="City_District" id="select" required>
                                        <option selected>-Select-</option>
                                        <option value="1">Ahmedabad City</option>
                                        <option value="2">Surat City</option>
                                        <option value="3">Vadodara City</option>




                                    </select>
                                </div>
                            </div>
                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">Police Station</label>
                                    <span class="r5"></span>
                                    <select class="r6" aria-label="Default select example" name="Police_Station" id="select">
                                        <option selected>-Select-</option>
                                        <option value="15">Adajan</option>
                                        <option value="16">Kamarej</option>
                                        <option value="17">Sarathana</option>
                                        <option value="12">Vesu</option>
                                        <option value="13">Mota Varachha</option>
                                        <option value="14">Nana Varachha</option>
                                        <option value="1">Kalupur</option>
                                        <option value="2">Bapunagar</option>
                                        <option value="3">Bodakdev</option>
                                        <option value="4">Ellisbridge</option>
                                        <option value="5">Gujarat University</option>
                                        <option value="6">Nikol</option>
                                        <option value="7">Ranip</option>
                                        <option value="8">Sabarmati River Front</option>
                                        <option value="9">Satellite</option>
                                        <option value="10">Vastrapur</option>
                                        <option value="11">Sarkhej</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="r1">
                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4"> Occurance Date </label>
                                    <span class="r5">*</span>
                                    <input type="date" class="r6" class="exampleInputEmail1" aria-describedby="emailHelp" name="Occurance_Date">

                                </div>

                            </div>
                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">Occurance Time </label>
                                    <span class="r5"></span>
                                    <input type="time" class="r6" class="exampleInputEmail1" aria-describedby="emailHelp" name="Occurance_Time">

                                </div>

                            </div>
                        </div>
                        <!-- <div class="r1">
                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">Date To</label>
                                    <span class="r5">*</span>
                                    <input type="date" class="r6" class="exampleInputEmail1"
                                        aria-describedby="emailHelp" name="Date To">

                                </div>

                            </div>
                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">Time To</label>
                                    <span class="r5"></span>
                                    <input type="datetime" class="r6" class="exampleInputEmail1"
                                        aria-describedby="emailHelp" name="Time To">

                                </div>

                            </div>
                        </div> -->
                        <h4 class="appdet">Brief Description <span class="r5">*</span> (Maximum 300 Characters)</43>
                            <div class="r1">
                                <div class="r2">
                                    <div class="r3">
                                        <textarea class="r6" id="textAreaExample2"  maxlength="300" name="Brief"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="">
                                <div class="r1">

                                    <div class="r2">
                                        <div class="r3">
                                            <label class="">
                                                <h6>Document Type</h6>
                                            </label>
                                            <select class="r6" aria-label="Default select example" required name="Document" id="select">
                                                <option selected>-Select-</option>
                                                <option value="1">Aadhar Card</option>
                                                <option value="2">Pan Card</option>
                                                <option value="3">Voter ID</option>

                                            </select>
                                        </div>

                                    </div>
                                    <div class="r2">
                                        <div class="r3">
                                            <label class="">
                                                <h6>Upload Document</h6>
                                            </label>
                                            <input type="file" class="r6" ids="up1" aria-describedby="emailHelp" name="upldfile" style="margin-top: 0.5em;" required>
                                        </div>

                                    </div>
                                    <!-- <div class="">
                                        <div class="">

                                            <div>
                                                <button type="button" id="boot1" style="color: aliceblue; text-decoration: none; margin-top: 30px;" name="upld_btn">Upload
                                                    Document</button>
                                            </div>
                                        </div>

                                    </div> -->


                                </div>


                                <label for="" class="r5">
                                    <h6>Note : Only PDF,JPEG,PNG,JPG are allowed
                                    </h6>
                                </label>

                            </div>


                            <h3>Disclaimer</h3>
                            <label for="" class="">
                                The facility of complaint on this site is purely a measure of public service. The
                                complaint
                                cannot be treated as First Information Report. While every effort has been made to
                                ensure the
                                prompt and accurate action, Gujarat Police and Home Department, Government of Gujarat
                                does not
                                hold itself liable in any aspect, for any consequences, legal or otherwise.
                            </label>
                            <h3>Warning</h3>
                            <label class="">
                                Legal action will be taken under the relevant law of India against the person who
                                misuses theportal.
                            </label>

                            <div >
                                <input class="" id="..." type="checkbox" class="checkboxNoLabel" required>
                                <label for="...">I Agree</label>
                            </div>

                            <div>
                                <center class="">
                                    <button type="submit" class="boot1" name="sbmtt" value="sbmt">Submit</button>
                                    <button type="reset" class="boot2">Reset</button>
                                    <button type="Cancel" class="boot3"><a href="index.php" style="color: aliceblue; text-decoration: none;">Cancel</button>
                                </center>

                            </div>


                    </div>
                </div>
            </div>
        </form>

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

        <script src="script.js"></script>



</body>

</html>