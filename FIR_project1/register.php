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

    // Check for duplicate username
    $check_user_sql = "SELECT username FROM user_master WHERE username='".mysqli_real_escape_string($con, $username)."'";
    $check_result = mysqli_query($con, $check_user_sql);
    if (mysqli_num_rows($check_result) > 0) {
        $msg = 'duplicate';
        $uploadOk = false;
    }

    if ($uploadOk && isset($_FILES['reg_doc']) && $_FILES['reg_doc']['error'] == 0) {
        $file_name = $_FILES["reg_doc"]["name"];
        $file_tmp = $_FILES["reg_doc"]["tmp_name"];
        $file_type = $_FILES["reg_doc"]["type"];

        if ($file_type == 'application/pdf' || $file_type == 'image/jpeg' || $file_type == 'image/png') {
            // Ensure directory exists
            if (!is_dir("registration_doc")) {
                mkdir("registration_doc", 0777, true);
            }
            // Secure file naming: timestamp + random + original extension
            $ext = pathinfo($file_name, PATHINFO_EXTENSION);
            $new_file_name = time() . "_" . rand(1000, 9999) . "." . $ext;
            
            if (move_uploaded_file($file_tmp, "registration_doc/" . $new_file_name)) {
                $file_path = $new_file_name;
            }
        } else if (!empty($file_name)) {
            $msg = 'file_error';
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
            '".password_hash($password, PASSWORD_DEFAULT)."', 
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
                $msg = 'success';
            } else {
                $msg = 'error';
                $error_msg = mysqli_error($con);
            }
        } catch (Exception $e) {
            $msg = 'error';
            $error_msg = addslashes($e.getMessage());
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
    <link rel="stylesheet" href="modern_efir.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700&display=swap">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php include "common/_navbar.php"; ?>

    <div class="main-form-container">
        <div class="page-header">
            <h1>Citizen Registration</h1>
            <p>Join the E-FIR portal to access online services and track your applications</p>
        </div>

        <div class="glass-container">
            <form action="#" method='POST' enctype="multipart/form-data">
                <div class="form-section">
                    <h2 class="section-title"><i class="fas fa-user-circle"></i> Personal Details</h2>
                    <div class="form-grid">
                        <div class="form-group">
                            <label>First Name <span class="required">*</span></label>
                            <input type="text" name="First_Name" required>
                        </div>
                        <div class="form-group">
                            <label>Middle Name</label>
                            <input type="text" name="middle_name">
                        </div>
                        <div class="form-group">
                            <label>Last Name <span class="required">*</span></label>
                            <input type="text" name="last_name" required>
                        </div>
                        <div class="form-group">
                            <label>Username <span class="required">*</span></label>
                            <input type="text" name="username" required>
                        </div>
                        <div class="form-group">
                            <label>Mobile Number <span class="required">*</span></label>
                            <input type="tel" name="mobile_number" maxlength="10" minlength="10" pattern="[0-9]{10}" required>
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" name="Address" maxlength="60">
                        </div>
                        <div class="form-group">
                            <label>Occupation</label>
                            <input type="text" name="occupation">
                        </div>
                        <div class="form-group">
                            <label>Gender <span class="required">*</span></label>
                            <select name="Gender" required>
                                <option value="" selected disabled>Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Religion</label>
                            <select name="Religion">
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
                        <div class="form-group">
                            <label>Date Of Birth</label>
                            <input type="date" name="Date_Of_Birth">
                        </div>
                        <div class="form-group">
                            <label>Nationality</label>
                            <select name="nationality">
                                <option value="" selected disabled>Select</option>
                                <option value="1">Indian</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Pincode</label>
                            <input type="number" name="pincode">
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h2 class="section-title"><i class="fas fa-shield-alt"></i> Documents & Security</h2>
                    <div class="form-grid">
                        <div class="form-group">
                            <label>Upload Document</label>
                            <input type="file" name="reg_doc">
                        </div>
                        <div class="form-group">
                            <label>Document Type <span class="required">*</span></label>
                            <select name="Document_Type" required>
                                <option value="" selected disabled>Select Document</option>
                                <option value="1">Aadhar card</option>
                                <option value="2">Pan card</option>
                                <option value="3">Voter Id</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Document No <span class="required">*</span></label>
                            <input type="text" name="document_no" maxlength="12" required>
                        </div>
                        <div class="form-group">
                            <label>Password <span class="required">*</span></label>
                            <input type="password" id="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label>Confirm Password <span class="required">*</span></label>
                            <input type="password" id="confirm_password" name="confirm_password" required>
                        </div>
                        <div class="form-group">
                            <label>Email Address <span class="required">*</span></label>
                            <input type="email" name="E-mail_address" placeholder="name@example.com" required>
                        </div>
                        <div class="form-group">
                            <label>Security Question</label>
                            <select name="Select_Question">
                                <option value="" selected disabled>Select Question</option>
                                <option value="1">What is your nickname?</option>
                                <option value="2">What is your favourite food?</option>
                                <option value="3">What is your favourite place?</option>
                                <option value="4">Who is your favourite cricketer?</option>
                                <option value="5">Which is your birth place?</option>
                                <option value="6">Who is your ideal person?</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Answer</label>
                            <input type="text" name="answere">
                        </div>
                    </div>
                </div>

                <div class="form-actions" style="margin-top: 3rem;">
                    <button type="submit" class="btn-submit">Create Account</button>
                    <button type="reset" class="btn-reset">Reset Form</button>
                    <button type="button" onclick="window.location='./index.php'" class="btn-reset" style="background: rgba(239, 68, 68, 0.1); color: #ef4444; border-color: rgba(239, 68, 68, 0.2);">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <?php include "common/_footer.php"; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

    <script>
        // Password matching validation
        const form = document.querySelector('form');
        const password = document.getElementById('password');
        const confirmPassword = document.getElementById('confirm_password');

        form.addEventListener('submit', function(e) {
            if (password.value !== confirmPassword.value) {
                e.preventDefault();
                alert("Passwords do not match! Please try again.");
                confirmPassword.focus();
                return false;
            }
        });

        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>

    <?php
    if (isset($msg)) {
        if ($msg == 'success') {
            echo "<script>
            Swal.fire({
                title: 'Success!',
                text: 'Registered Successfully...',
                icon: 'success',
                confirmButtonColor: '#0ea5e9'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = './login.php';
                }
            });
            </script>";
        } elseif ($msg == 'duplicate') {
            echo "<script>
            Swal.fire({
                title: 'Duplicate Username!',
                text: 'Error: Username already exists. Please choose another one.',
                icon: 'warning',
                confirmButtonColor: '#f59e0b'
            });
            </script>";
        } elseif ($msg == 'file_error') {
            echo "<script>
            Swal.fire({
                title: 'Invalid File!',
                text: 'The uploaded file is in incorrect format. Please upload PDF, JPG, or PNG.',
                icon: 'error',
                confirmButtonColor: '#ef4444'
            });
            </script>";
        } elseif ($msg == 'error') {
            $display_err = isset($error_msg) ? $error_msg : 'Unknown database error occurred.';
            echo "<script>
            Swal.fire({
                title: 'Registration Failed!',
                text: '" . $display_err . "',
                icon: 'error',
                confirmButtonColor: '#ef4444'
            });
            </script>";
        }
    }
    ?>
</body>

</html>