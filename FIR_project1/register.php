<?php
include "DBconfig.php";
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $firstname = trim($_POST['First_Name'] ?? '');
    $middlename = trim($_POST['middle_name'] ?? '');
    $lastname = trim($_POST['last_name'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $mobilenumber = trim($_POST['mobile_number'] ?? '');
    $address = trim($_POST['Address'] ?? '');
    $occupation = trim($_POST['occupation'] ?? '');
    $gender = $_POST['Gender'] ?? '';
    $religion = $_POST['Religion'] ?? '';
    $dateofbirth = $_POST['Date_Of_Birth'] ?? '';
    $nationality = $_POST['nationality'] ?? '';
    $pincode = $_POST['pincode'] ?? '';
    $documenttype = $_POST['Document_Type'] ?? '';
    $documentno = trim($_POST['document_no'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirmpassword = $_POST['confirm_password'] ?? '';
    $emailaddress = trim($_POST['E-mail_address'] ?? '');
    $selectquestion = $_POST['Select_Question'] ?? '';
    $answere = trim($_POST['answere'] ?? '');

    // Initialize optional fields with defaults to avoid NOT NULL constraint failures
    $religion_id = !empty($religion) ? (int)$religion : 9; // Default to 'Other' if empty
    $nationality_id = !empty($nationality) ? (int)$nationality : 1; // Default to 'Indian'
    $pincode_val = !empty($pincode) ? (int)$pincode : 0; 
    $document_id = !empty($documenttype) ? (int)$documenttype : 1; // Default to 'Aadhar Card'
    $que_id = !empty($selectquestion) ? (int)$selectquestion : 1; // Default to first question
    $dob_val = !empty($dateofbirth) ? "'".mysqli_real_escape_string($con, $dateofbirth)."'" : "'1900-01-01'"; 
    $occupation = !empty($occupation) ? $occupation : "N/A";
    $address = !empty($address) ? $address : "N/A";
    $answere = !empty($answere) ? $answere : "N/A";

    $uploadOk = true;
    $file_path = "";

    // file upload check
    if (isset($_FILES['reg_doc']) && $_FILES['reg_doc']['error'] == 0) {
        $file_name = $_FILES["reg_doc"]["name"];
        $file_tmp = $_FILES["reg_doc"]["tmp_name"];
        $file_type = $_FILES["reg_doc"]["type"];

        if ($file_type == 'application/pdf' || $file_type == 'image/jpeg' || $file_type == 'image/png') {
            // Ensure directory exists
            if (!is_dir("registration_doc")) {
                mkdir("registration_doc");
            }
            if (move_uploaded_file($file_tmp, "registration_doc/" . $file_name)) {
                $file_path = $file_name;
            } else {
                // If it fails but was required, set uploadOk to false. 
                // Since user said it might be optional, we just note it.
            }
        } else if (!empty($file_name)) {
            echo "<script>alert('The uploaded file is in incorrect format. Please upload PDF, JPG, or PNG.')</script>";
            $uploadOk = false;
        }
    }

    if ($uploadOk) {
        $sql = "INSERT INTO `user_master` (`address`, `que_id`, `nationality_id`, `user_fname`, `user_mname`, `user_lname`, `contact_no`, `user_dob`, `username`, `password`, `user_email`, `q_ans`, `gender`, `religion_id`, `occupation`, `pincode`, `document_id`, `doc_no`, `reg_date`) VALUES ( 
            '".mysqli_real_escape_string($con, $address)."', 
            $que_id, 
            $nationality_id, 
            '".mysqli_real_escape_string($con, $firstname)."', 
            '".mysqli_real_escape_string($con, $middlename)."', 
            '".mysqli_real_escape_string($con, $lastname)."', 
            '".mysqli_real_escape_string($con, $mobilenumber)."', 
            $dob_val, 
            '".mysqli_real_escape_string($con, $username)."', 
            '".mysqli_real_escape_string($con, $password)."', 
            '".mysqli_real_escape_string($con, $emailaddress)."', 
            '".mysqli_real_escape_string($con, $answere)."', 
            '".mysqli_real_escape_string($con, $gender)."', 
            $religion_id, 
            '".mysqli_real_escape_string($con, $occupation)."', 
            $pincode_val, 
            $document_id, 
            '".mysqli_real_escape_string($con, $documentno)."', 
            current_timestamp()
        );";

        try {
            $result = mysqli_query($con, $sql);
            if ($result) {
                echo "<script>alert('Registered Successfully...')</script>";
                echo "<script> window.location = './index.php';</script>";
            } else {
                $error_msg = mysqli_error($con);
                echo "<script>alert('Registration Failed: " . addslashes($error_msg) . "')</script>";
            }
        } catch (Exception $e) {
            $error_msg = addslashes($e->getMessage());
            echo "<script>alert('Registration Error: " . $error_msg . "')</script>";
        }
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registration Form</title>
    <link rel="icon" href="img/weblogo1.ico" type="image/icon">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="register.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <section class="header">
        <div class="gov-banner">
            <img src="img/gujaratpolice.png" alt="Government of Gujarat" />
            <div class="gov-title">
                <h1>Government of Gujarat - Police Department</h1>
                <p>Citizen Registration Portal</p>
            </div>
        </div>
        <nav>
            <div class="nav-links" id="navLinks">
                <ul>
                    <li class="select"><a href="index.php"><i class="fa fa-home"></i>Home</a></li>
                    <li><a href="Form.php"><i class="fa fa-file"></i>Online Form</a></li>
                    <li><a href="Gallery.php"><i class="fa fa-image"></i>Photo Gallery</a></li>
                    <li><a href="Department.php"><i class="fa fa-star"></i>Know Home Department</a></li>
                    <li><a href="Absconder.php"><i class="fa fa-list"></i>Absconder List</a></li>
                    <li><a href="Contact.php"><i class="fa fa-phone"></i>Contact Details</a></li>
                    <li><a href="Notice.php"><i class="fa fa-info-circle"></i>Lookout Notice</a></li>
                </ul>
            </div>
        </nav>

        <div class="container">
            <div class="t">
                <h2>Registration Form</h2>
            </div>

            <div class="app1">
                <form action="#" method='POST' enctype="multipart/form-data">
                    <div class="app2">
                        <h6>Personal Details</h6>
                        <div class="r1">
                            <div class="r3">
                                <label class="r4">First Name <span class="r5">*</span></label>
                                <input type="text" class="r6" name="First_Name" required>
                            </div>
                            <div class="r3">
                                <label class="r4">Middle Name</label>
                                <input type="text" class="r6" name="middle_name">
                            </div>
                            <div class="r3">
                                <label class="r4">Last Name <span class="r5">*</span></label>
                                <input type="text" class="r6" name="last_name" required>
                            </div>
                        </div>

                        <div class="r1">
                            <div class="r3">
                                <label class="r4">Username <span class="r5">*</span></label>
                                <input type="text" class="r6" name="username" required>
                            </div>
                            <div class="r3">
                                <label class="r4">Mobile Number <span class="r5">*</span></label>
                                <input type="tel" class="r6" name="mobile_number" maxlength="10" minlength="10" pattern="[0-9]{10}" required>
                            </div>
                            <div class="r3">
                                <label class="r4">Address</label>
                                <input type="text" class="r6" name="Address" maxlength="60">
                            </div>
                        </div>

                        <div class="r1">
                            <div class="r3">
                                <label class="r4">Occupation</label>
                                <input type="text" class="r6" name="occupation">
                            </div>
                            <div class="r3">
                                <label class="r4">Gender <span class="r5">*</span></label>
                                <select class="r6" name="Gender" required>
                                    <option value="" selected disabled>Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="r3">
                                <label class="r4">Religion</label>
                                <select class="r6" name="Religion">
                                    <option value="" selected disabled>Select Religion</option>
                                    <option value="1">Buddhist</option>
                                    <option value="2">Christian</option>
                                    <option value="3">Donyipolo</option>
                                    <option value="4">Hindu</option>
                                    <option value="5">Islam</option>
                                    <option value="6">Jain</option>
                                    <option value="7">Jews/Yehudi</option>
                                    <option value="8">Muslim</option>
                                    <option value="9">Other</option>
                                    <option value="10">Parsi</option>
                                    <option value="11">Sikh</option>
                                </select>
                            </div>
                        </div>

                        <div class="r1">
                            <div class="r3">
                                <label class="r4">Date Of Birth</label>
                                <input type="date" class="r6" name="Date_Of_Birth">
                            </div>
                            <div class="r3">
                                <label class="r4">Nationality</label>
                                <select class="r6" name="nationality">
                                    <option value="" selected disabled>Select</option>
                                    <option value="1">Indian</option>
                                </select>
                            </div>
                            <div class="r3">
                                <label class="r4">Pincode</label>
                                <input type="number" class="r6" name="pincode">
                            </div>
                        </div>

                        <h6>Documents & Security</h6>
                        <div class="r1">
                            <div class="r3">
                                <label class="r4">Upload Document</label>
                                <input type="file" class="r6" name="reg_doc">
                            </div>
                            <div class="r3">
                                <label class="r4">Document Type <span class="r5">*</span></label>
                                <select class="r6" name="Document_Type" required>
                                    <option value="" selected disabled>Select Document</option>
                                    <option value="1">Aadhar card</option>
                                    <option value="2">Pan card</option>
                                    <option value="3">Voter Id</option>
                                </select>
                            </div>
                            <div class="r3">
                                <label class="r4">Document No <span class="r5">*</span></label>
                                <input type="text" class="r6" name="document_no" maxlength="12" required>
                            </div>
                        </div>

                        <div class="r1">
                            <div class="r3">
                                <label class="r4">Password <span class="r5">*</span></label>
                                <input type="password" class="r6" name="password" required>
                            </div>
                            <div class="r3">
                                <label class="r4">Confirm Password <span class="r5">*</span></label>
                                <input type="password" class="r6" name="confirm_password" required>
                            </div>
                            <div class="r3">
                                <label class="r4">Email Address <span class="r5">*</span></label>
                                <input type="email" class="r6" name="E-mail_address" placeholder="name@example.com" required>
                            </div>
                        </div>

                        <div class="r1">
                            <div class="r3">
                                <label class="r4">Security Question</label>
                                <select class="r6" name="Select_Question">
                                    <option value="" selected disabled>Select Question</option>
                                    <option value="1">What is your nickname?</option>
                                    <option value="2">What is your favourite food?</option>
                                    <option value="3">What is your favourite place?</option>
                                    <option value="4">Who is your favourite cricketer?</option>
                                    <option value="5">Which is your birth place?</option>
                                    <option value="6">Who is your ideal person?</option>
                                </select>
                            </div>
                            <div class="r3">
                                <label class="r4">Answer</label>
                                <input type="text" class="r6" name="answere">
                            </div>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="flexCheckChecked">
                            <label class="form-check-label" for="flexCheckChecked">
                                I have read and agree to the <a href="#">Terms & Conditions</a>
                            </label>
                        </div>

                        <div class="button-container">
                            <button type="submit" class="boot1 shadow-lg">Create Account</button>
                            <button type="reset" class="boot2">Reset Form</button>
                            <button type="button" onclick="window.location='./index.php'" class="boot3">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>


    </section>




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










    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

    <script>
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.href);
            }
        </script>
</body>

</html>