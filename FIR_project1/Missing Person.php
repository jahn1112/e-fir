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

//logged user details from database
$uqry = "select user_fname,user_mname,user_lname,user_email,user_dob,rt.religion_name,um.contact_no,um.address,um.pincode from user_master um LEFT join religion_table rt on um.religion_id=rt.religion_id where `user_id`= " . $_SESSION["userid"] . ";";
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
// arpit --- upldFILE

if (isset($_POST['sbmt'])) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $userid = $_SESSION["userid"];
        // $Firstname = $_POST['First_name'];
        // $FatherName = $_POST['Father_Name'];
        // $surname = $_POST['surname'];
        // $PermanentAddress = $_POST['Permanent_Address'];
        // $Emailaddress = $_POST['Email_address'];
        // $MobileNumber = $_POST['Mobile_Number'];
        // $LandlineNo = $_POST['Landline_No'];
        $MissingPersonFirstname = $_POST['Missing_Person_First_name'];
        $MissingPersonFathername = $_POST['Missing_Person_Father_name'];
        $MissingPersonSurname = $_POST['Missing_Person_Surname'];
        $DateOfBirth = $_POST['Date_Of_Birth'];
        $Gender = $_POST['Gender'];
        $Missingdate = $_POST['Missing_date'];
        $MissingTime = $_POST['Missing_time'];
        $Religion = $_POST['Religion'];
        $Caste = $_POST['Caste'];
        $Category = $_POST['Category'];
        $Occupation = $_POST['Occupation'];
        $Height = $_POST['Height'];
        $Weight = $_POST['Weight'];

        $MissingPersonDescription = $_POST['Missing_Person_Description'];


        $Country = $_POST['Country'];
        $State = $_POST['State'];
        $PinCode = $_POST['Pin_Code'];
        $City = $_POST['City'];
        $Area = $_POST['Area'];
        $PlaceOfMissingCountry = $_POST['Place_Of_Missing_Country'];
        $PlaceOfMissingState = $_POST['Place_Of_Missing_State'];
        $PlaceOfMissingPinCode = $_POST['Place_Of_Missing_Pin_Code'];
        $PlaceOfMissingCity = $_POST['Place_Of_Missing_City'];
        $PlaceOfMissingArea = $_POST['Place_Of_Missing_Area'];
        $Reporting_PS_City = $_POST['Reporting_PS_City'];
        $PoliceStation = $_POST['Police_Station'];
        $BriefDescription = $_POST['Brief_Description'];
        $DocumentType = $_POST['Document_Type'];
        // $UploadDocument = $_POST['Upload_Document'];
        // $Uploadfile = $_POST['Upload_file'];


        if (isset($_FILES['upldFILE'])) {

            $file_name = $_FILES["upldFILE"]["name"];
            $file_size = $_FILES["upldFILE"]["size"];
            $file_tmp = $_FILES["upldFILE"]["tmp_name"];
            $file_type = $_FILES["upldFILE"]["type"];

            // print_r($_POST);
            if ($file_type == 'application/pdf' || $file_type == 'image/jpeg' || $file_type == 'image/png') {
                $res =  move_uploaded_file($file_tmp, "./msng_prsn_doc/" . $file_name);
                if ($res) {

                    $sql = 'INSERT INTO `report_missing_person_table` ( `user_id`, `first_name`, `middle_name`, `surname`, `dob`, `gender`, `missing_date`, `missing_time`, `religion_id`, `caste`, `category`, `occupation`, `height(cm)`, `weight(kgs)`, `missing_person_description`, `area`, `pincode`, `police_station_id`, `brief_description`, `document_id`, `sbmt_date`) VALUES (' . $userid . ',"'.$MissingPersonFirstname.'","' . $MissingPersonFathername . '","' . $MissingPersonSurname . '","' . $DateOfBirth . '","' . $Gender . '","' . $Missingdate . '","' . $MissingTime . '","' . $Religion . '","' . $Caste . '","' . $Category . '","' . $Occupation . '",' . $Height . ',' . $Weight . ',"' . $MissingPersonDescription . '","' . $Area . '",' . $PinCode . ',' . $PoliceStation . ',"' . $BriefDescription . '",' . $DocumentType . ',current_timestamp())';
                    $result = mysqli_query($con, $sql);
                    if ($result) {
                        echo "<script>alert('Missing Report Person Form Submited...')</script>";
                    } else {
                        // echo 'The record was not inserted successfully because of this error' . mysqli_error($con);
                        echo "<script>alert('Form Not Submited...')</script>";
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
    <title>Missing Person</title>
    <!-- website logo -->
    <link rel="icon" href="img\weblogo1.ico" type="image/icon">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="form_theme.css">
    <link rel="stylesheet" href="missing person report.css">
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
                <center>Report Missing Person</center>
            </b> </h2>
        <div class="app1">
            <div class="">
                <div class="app2">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <h3 class="appdet"><u>Applicant Details</u> </h3>

                        <div class="r1">
                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">First Name</label>
                                    <span class="r5"></span>
                                    <input type="text" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" style="background: #E4DEDE;" value="<?php echo $ufname; ?>" disabled>
                                </div>

                            </div>
                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">Father Name</label>
                                    <span class="r5"></span>
                                    <input type="text" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" style="background: #E4DEDE;" value="<?php echo $umname; ?>" disabled>
                                </div>

                            </div>
                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">surname</label>
                                    <span class="r5"></span>
                                    <input type="text" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" style="background: #E4DEDE;" value="<?php echo $ulname; ?>" disabled>
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
                                    <label for="exampleInputEmail1" class="r4">Email address</label>
                                    <span class="r5"></span>
                                    <input type="email" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" style="background: #E4DEDE;" value="<?php echo $uemail; ?>" disabled>
                                </div>
                            </div>
                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">Mobile Number</label>
                                    <span class="r5"></span>
                                    <input type="number" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" style="background: #E4DEDE;" value="<?php echo $ucontact; ?>" disabled>
                                </div>
                            </div>


                        </div>
                        <div class="r1">
                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">Landline No</label>
                                    <span class="r5"></span>
                                    <input type="text" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" value="NA" style="background: #E4DEDE;" disabled>
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
                                    <input type="text" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" required name="Missing_Person_First_name">
                                </div>

                            </div>
                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">Missing Person Father Name</label>
                                    <span class="r5"></span>
                                    <input type="text" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" required name="Missing_Person_Father_name">
                                </div>

                            </div>
                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">Missing Person surname</label>
                                    <span class="r5">*</span>
                                    <input type="text" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" required name="Missing_Person_Surname">
                                </div>
                            </div>

                        </div>
                        <div class="r1">
                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">Date Of Birth</label>
                                    <span class="r5"></span>
                                    <input type="date" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" required name="Date_Of_Birth">
                                </div>
                            </div>


                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">Gender</label>
                                    <span class="r5">*</span>
                                    <select class="r6" aria-label="Default select example" name="Gender" id="select">
                                        <option selected>-Select-</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Other">Other</option>

                                    </select>
                                </div>
                            </div>
                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">Missing Person Description</label>
                                    <span class="r5">*</span>
                                    <!-- <input type="text" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" required name="Area"> -->
                                    <textarea name="Missing_Person_Description" class="r6" id="textAreaExample2" cols="30" rows="1.5"  required></textarea>

                                </div>
                            </div>
                        </div>



                        <div class="r1">
                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">Missing Date</label>
                                    <span class="r5">*</span>
                                    <input type="date" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" required name="Missing_date">
                                </div>
                            </div>
                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">Missing Time</label>
                                    <span class="r5">*</span>
                                    <input type="time" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" required name="Missing_time">
                                </div>
                            </div>
                        </div>

                        <div class="r1">
                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">Religion</label>
                                    <span class="r5">*</span>
                                    <select class="r6" aria-label="Default select example" name="Religion" id="select">
                                        <option selected>-Select-</option>
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
                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">Caste</label>
                                    <span class="r5"></span>
                                    <select class="r6" aria-label="Default select example" name="Caste" id="select">
                                        <option selected>-Select-</option>
                                        <option value="Anjana">Anjana</option>
                                        <option value="Adiwasi">Adiwasi</option>
                                        <option value="Ahir">Ahir</option>
                                        <option value="Atit">Atit</option>
                                        <option value="Atit Bavaji">Atit Bavaji</option>
                                        <option value="Ayadi">Ayadi</option>
                                        <option value="Balahi">Balahi</option>
                                        <option value="Baria">Baria</option>
                                        <option value="Baraiya">Baraiya</option>
                                        <option value="Barol">Barot</option>
                                        <option value="Bawaji">Bavaji</option>
                                        <option value="Bhaiya">Bhaiya</option>
                                        <option value="Bhanbhi">Bhanbhi</option>
                                        <option value="Bhandari">Bhandari</option>
                                        <option value="Bharvad">Bharvad</option>
                                        <option value="Bheel">Bheel</option>
                                        <option value="Bhoye">Bhoye</option>
                                        <option value="Boriya">Boriya</option>
                                        <option value="Brahmbhatt">Brahmbhatt</option>
                                        <option value="Brahmin">Brahmin</option>
                                        <option value="Chamar">Chamar</option>
                                        <option value="Charan">Charan</option>
                                        <option value="Chauhan">Chauhan</option>
                                        <option value="Chavda">Chavda</option>
                                        <option value="Choudhry">Choudhary</option>
                                        <option value="Dalwadi">Dalwadi</option>
                                        <option value="Darbar">Darbar</option>
                                        <option value="Darzi">Darzi</option>
                                        <option value="Desai">Desai</option>
                                        <option value="Dhobi">Dhobi</option>
                                        <option value="Dodiya">Dodiya</option>
                                        <option value="Dubala">Dubala</option>
                                        <option value="Gadvi">Gadvi</option>
                                        <option value="Gamit">Gamit</option>
                                        <option value="Garasiya">Garasiya</option>
                                        <option value="Garoda">Garoda</option>
                                        <option value="Gavit">Gavit</option>
                                        <option value="Ghanchi">Ghanchi</option>
                                        <option value="Goswami">Goswami</option>
                                        <option value="Gurjar">Gurjar</option>
                                        <option value="Hadpati">Hadpati</option>
                                        <option value="Harizan">Harizan</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Jat">Jat</option>
                                        <option value="Jhala">Jhala</option>
                                        <option value="Jogi">Jogi</option>
                                        <option value="Kadiya">Kadiya</option>
                                        <option value="Kanbi">Kanbi</option>
                                        <option value="Kardiya">Kardiya</option>
                                        <option value="Kathud">Kathud</option>
                                        <option value="Khant">Khant</option>
                                        <option value="Kharwa">Kharwa</option>
                                        <option value="Khati">Khati</option>
                                        <option value="Khatri-Hazuri">Khatri-Hazuri</option>
                                        <option value="Kokna">kokna</option>
                                        <option value="Kokni">Kokni</option>
                                        <option value="Koicha">Koicha</option>
                                        <option value="Kolis">Kolis</option>
                                        <option value="Koli">Koli</option>
                                        <option value="Khsatriya">Khsatriya</option>
                                        <option value="Kukna">Kukna</option>
                                        <option value="Kumhar">Kumhar</option>
                                        <option value="Kumbi">Kumbi</option>
                                        <option value="Leuva">Leuva</option>
                                        <option value="Limbachia">Limbachia</option>
                                        <option value="Luhar">Luhar</option>
                                        <option value="Luvana">Luvana</option>
                                        <option value="Mahaar">Mahaar</option>
                                        <option value="Mahar">Mahar</option>
                                        <option value="Maharastriyan">Maharastriyan</option>
                                        <option value="Mahavanshi">Mahavanshi</option>
                                        <option value="Mali">Mali</option>
                                        <option value="Maratha">Maratha</option>
                                        <option value="Marwari">Marwari</option>
                                        <option value="Mashi">Mashi</option>
                                        <option value="Matrasi">Matrasi</option>
                                        <option value="Meghwal">Meghwal</option>
                                        <option value="Mer">Mer</option>
                                        <option value="Mochi">Mochi</option>
                                        <option value="Modi">Modi</option>
                                        <option value="Murai">Murai</option>
                                        <option value="Nadoda">Nadoda</option>
                                        <option value="Nathi">Nathi</option>
                                        <option value="Mayaka">Mayaka</option>
                                        <option value="Nhavi">Nhavi</option>
                                        <option value="Oza">Oza</option>
                                        <option value="Panchal">Panchal</option>
                                        <option value="Pardhi">Pardhi</option>
                                        <option value="Mahavanshi">Mahavanshi</option>
                                        <option value="Mali">Mali</option>
                                        <option value="Maratha">Maratha</option>
                                        <option value="Marwari">Marwari</option>
                                        <option value="Mashi">Mashi</option>
                                        <option value="Matrasi">Matrasi</option>
                                        <option value="Meghwal">Meghwal</option>
                                        <option value="Mer">Mer</option>
                                        <option value="Mochi">Mochi</option>
                                        <option value="Modi">Modi</option>
                                        <option value="Murai">Murai</option>
                                        <option value="Nadoda">Nadoda</option>
                                        <option value="Nathi">Nathi</option>
                                        <option value="Mayaka">Mayaka</option>
                                        <option value="Nhavi">Nhavi</option>
                                        <option value="Oza">Oza</option>
                                        <option value="Panchal">Panchal</option>
                                        <option value="Pardhi">Pardhi</option>
                                        <option value="Parmar">Parmar</option>
                                        <option value="Patel">Patel</option>
                                        <option value="Patil">Patil</option>
                                        <option value="Kahturiya">Kahturiya</option>
                                        <option value="Peta">Peta</option>
                                        <option value="Prajapati">Prajapati</option>
                                        <option value="Puwar">Puwar</option>
                                        <option value="Rabari">Rabari</option>
                                        <option value="Rajabhoai">Rajabhoai</option>
                                        <option value="Rajgor">Rajgor</option>
                                        <option value="Rajput">Rajput</option>
                                        <option value="Raval">Raval</option>
                                        <option value="Ravalbheel">RavalBheel</option>
                                        <option value="Ravaliya">Ravaliya</option>
                                        <option value="Rohit">Rohit</option>
                                        <option value="Saardi">Saardi</option>
                                        <option value="Sagar">Sagar</option>
                                        <option value="Sandhi">Sandhi</option>
                                        <option value="Saradi">Saradi</option>
                                        <option value="Satwara">Satwara</option>
                                        <option value="Senma">Senma</option>
                                        <option value="Shevna">Shenva</option>
                                        <option value="Shimpi">Shimpi</option>
                                        <option value="Sindhi">Sindhi</option>
                                        <option value="Solanki">Solanki</option>
                                        <option value="Somar">Somar</option>
                                        <option value="Soni">Soni</option>
                                        <option value="Suthar">Suthar</option>
                                        <option value="Suwalia">Suwalia</option>
                                        <option value="Tadvi">Tadvi</option>
                                        <option value="Taiti">Taiti</option>
                                        <option value="Talpada Koli">Talpada Koli</option>
                                        <option value="Talaviya">Talaviya</option>
                                        <option value="Taragala">Taragala</option>
                                        <option value="Thakarda">Thakarda</option>
                                        <option value="Thakur">Thakur</option>
                                        <option value="Thori">Thori</option>
                                        <option value="Turi">Turi</option>
                                        <option value="Vaghela">Vaghela</option>
                                        <option value="Vaghri">Vaghri</option>
                                        <option value="Vairagi Bava">Vairagi Bava</option>
                                        <option value="Vaishnav">Vaishnav</option>
                                        <option value="Valandi">Valandi</option>
                                        <option value="Valmiki">Valmiki</option>
                                        <option value="Vanand">Vanand</option>
                                        <option value="Vani">Vani</option>
                                        <option value="Vaniya">Vaniya</option>
                                        <option value="Vankar">Vankar</option>
                                        <option value="Vanvi">Vanvi</option>
                                        <option value="Vanza">Vanza</option>
                                        <option value="Vanzara">Vanzara</option>
                                        <option value="Varli">Varli</option>
                                        <option value="Vasav">Vasav</option>
                                        <option value="Yadav">Yadav</option>
                                        <option value="Zala">Zala</option>
                                        <option value="Mangela">Mangela</option>








                                    </select>
                                </div>

                            </div>
                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">Category</label>
                                    <span class="r5"></span>
                                    <select class="r6" aria-label="Default select example" name="Category"  id="select">
                                        <option selected>-Select-</option>
                                        <option value="General">General</option>
                                        <option value="OBC">OBC</option>
                                        <option value="SC">SC</option>
                                        <option value="ST">ST</option>

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="r1">
                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">Occupation</label>
                                    <span class="r5"></span>
                                    <select class="r6" aria-label="Default select example" name="Occupation"  id="select">
                                        <option selected>-Select-</option>
                                        <option value="Academician">Academician</option>
                                        <option value="Accountant">Accountant</option>
                                        <option value="Administrative Personnel">Administrative Personnel</option>
                                        <option value="Agent">Agent</option>
                                        <option value="Air ">Air Lines Staff</option>
                                        <option value="Airpot ">Airpot Staff</option>
                                        <option value="Architect">Architect</option>
                                        <option value="Artisan">Artisan</option>
                                        <option value="Artist">Artist</option>
                                        <option value="Bank ">Bank Employee</option>
                                        <option value="Begger">Begger</option>
                                        <option value="Broker">Broker</option>
                                        <option value="Builder">Builder</option>
                                        <option value="Businessman">Businessman</option>
                                        <option value="Cable Operator">Cable Operator</option>
                                        <option value="Calusal Visitor">Calusal Visitor</option>
                                        <option value="Carpenter">Carpenter</option>
                                        <option value="Cleaner Bus">Cleaner Bus</option>
                                        <option value="Cleaner Truck">Cleaner Truck</option>
                                        <option value="Cobbler">Cobbler</option>
                                        <option value="Company Executive">Company Executive</option>
                                        <option value="Computer Professional">Computer Professional</option>
                                        <option value="Contractor">Contractor</option>
                                        <option value="Courier">Courier</option>
                                        <option value="Craftsman">Craftsman</option>
                                        <option value="Crew">Crew</option>
                                        <option value="Dealer-Antique">Dealer-Antique</option>
                                        <option value="Dealer-Skin & FUR 027">Dealer-Skin & FUR 027</option>
                                        <option value="Defence Personnel">Defence Personnel</option>
                                        <option value="Defegate">Defegate</option>
                                        <option value="Dentist">Dentist</option>
                                        <option value="Doctor">Doctor</option>
                                        <option value="Domestic Servent">Domestic Servent</option>
                                        <option value="Driver-Autorickshaw">Driver-Autorickshaw</option>
                                        <option value="Driver-Bus">Driver-Bus</option>
                                        <option value="Driver-Car">Driver-Car</option>
                                        <option value="Driver-Cart">Driver-Cart</option>
                                        <option value="Driver-Taxi">Driver-Taxi</option>
                                        <option value="Driver-Truck">Driver-Truck</option>
                                        <option value="Elected Representives">Elected Representives</option>
                                        <option value="Electrician">Electrician</option>
                                        <option value="Employed In Private Firms">Employed In Private Firms</option>
                                        <option value="Engineers">Engineers</option>
                                        <option value="Evangelist">Evangelist</option>
                                        <option value="Exporter">Exporter</option>
                                        <option value="Factory Worker">Factory Worker</option>
                                        <option value="Farm">Farm</option>
                                        <option value="Farmer">Farmer</option>
                                        <option value="Financier">Financier</option>
                                        <option value="Fisherman">Fisherman</option>
                                        <option value="Foreign Official">Foreign Official</option>
                                        <option value="Gardner">Gardner</option>
                                        <option value="Gold Smith">Gold Smith</option>
                                        <option value="Govt. Official Gazetted">Govt. Official Gazetted</option>
                                        <option value="Govt. Official Non-Gazetted">Govt. Official Non-Gazetted</option>
                                        <option value="Hawkers">Hawkers</option>
                                        <option value="Head Of Mission">Head Of Mission</option>
                                        <option value="Home Guard">Home Guard</option>
                                        <option value="Hotel Employee">Hotel Employee</option>
                                        <option value="House Help Hired">House Help Hired</option>
                                        <option value="Housewife">Housewife</option>
                                        <option value="Importer">Importer</option>
                                        <option value="Industrialist">Industrialist</option>
                                        <option value="Jail Staff">Jail Staff</option>
                                        <option value="Journalist">Journalist</option>
                                        <option value="Judical Officer">Judical Officer</option>
                                        <option value="Jugglers">Jugglers</option>
                                        <option value="Labourer">Labourer</option>
                                        <option value="Launderer (Dhobi)">Launderer (Dhobi)</option>
                                        <option value="Law Practitioner">Law Practitioner</option>
                                        <option value="Lawyer">Lawyer</option>
                                        <option value="Litrary Person">Litrary Person</option>
                                        <option value="Manager">Manager</option>
                                        <option value="Mason">Mason</option>
                                        <option value="Mechanic">Mechanic</option>
                                        <option value="Media Person">Media Person</option>
                                        <option value="Medical Prectitioner">Medical Prectitioner</option>
                                        <option value="Mercenary">Mercenary</option>
                                        <option value="Milkman">Milkman</option>
                                        <option value="Mines Employee">Mines Employee</option>
                                        <option value="MLA">MLA</option>
                                        <option value="Money Lender">Money Lender</option>
                                        <option value="MP">MP</option>
                                        <option value="Nomad">Nomad</option>
                                        <option value="Nurse">Nurse</option>
                                        <option value="Employee">Employee</option>
                                        <option value="Other">Other</option>
                                        <option value="Paramadical Staff">Paramadical Staff</option>
                                        <option value="Peon">Peon</option>
                                        <option value="Petty Treader">Petty Treader</option>
                                        <option value="Photographer">Photographer</option>
                                        <option value="Pilot">Pilot</option>
                                        <option value="Plumber">Plumber</option>
                                        <option value="Police Officer">Police Officer</option>
                                        <option value="Politician">Politician</option>
                                        <option value="Porter">Porter</option>
                                        <option value="Postal Staff">Postal Staff</option>
                                        <option value="Private Service">Private Service</option>
                                        <option value="Proprietor">Proprietor</option>
                                        <option value="Raliway Station">Raliway Station</option>
                                        <option value="Real Estate Dealer">Real Estate Dealer</option>
                                        <option value="Relative/Friend">Relative/Friend</option>
                                        <option value="Religious Person">Religious Person</option>
                                        <option value="Salesman">Salesman</option>
                                        <option value="Sanitary Worker">Sanitary Worker</option>
                                        <option value="Sarpanch">Sarpanch</option>
                                        <option value="Security Guard">Security Guard</option>
                                        <option value="Service">Service</option>
                                        <option value="Shop Employee">Shop Employee</option>
                                        <option value="Shopkeeper">Shopkeeper</option>
                                        <option value="Social Worker">Social Worker</option>
                                        <option value="Sports person">Sports person</option>
                                        <option value="Student">Student</option>
                                        <option value="Surveyor">Surveyor</option>
                                        <option value="Sweeper">Sweeper</option>
                                        <option value="Tailor">Tailor</option>
                                        <option value="Talati">Talati</option>
                                        <option value="Teacher">Teacher</option>
                                        <option value="Technical Expert">Technical Expert</option>
                                        <option value="Technician">Technician</option>
                                        <option value="Sarpanch">Sarpanch</option>
                                        <option value="Security Guard">Security Guard</option>
                                        <option value="Service">Service</option>
                                        <option value="Shop Employee">Shop Employee</option>
                                        <option value="Shopkeeper">Shopkeeper</option>
                                        <option value="Social Worker">Social Worker</option>
                                        <option value="Sports person">Sports person</option>
                                        <option value="Student">Student</option>
                                        <option value="Surveyor">Surveyor</option>
                                        <option value="Sweeper">Sweeper</option>
                                        <option value="Tailor">Tailor</option>
                                        <option value="Talati">Talati</option>
                                        <option value="Teacher">Teacher</option>
                                        <option value="Technical Expert">Technical Expert</option>
                                        <option value="Technician">Technician</option>
                                        <option value="Telecom Staff">Telecom Staff</option>
                                        <option value="Tourist">Tourist</option>
                                        <option value="Trader">Trader</option>
                                        <option value="Travelling As Co-passenger">Travelling As Co-passenger</option>
                                        <option value="Unemployed">Unemployed</option>
                                        <option value="Utility Serviceman">Utility Serviceman</option>
                                        <option value="Vegabond">Vegabond</option>
                                        <option value="Vendor">Vendor</option>
                                        <option value="Video Exhibition">Video Exhibition</option>
                                        <option value="Watchman">Watchman</option>
                                        <option value="Weaver">Weaver</option>



                                    </select>


                                </div>
                            </div>
                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">Height</label>
                                    <span class="r5">*</span>
                                    <input type="text" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" required name="Height">
                                </div>

                            </div>
                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">Weight</label>
                                    <span class="r5">*</span>
                                    <input type="text" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" required name="Weight">
                                </div>
                            </div>
                        </div>


                        <h4 class="appdet"><u>Address of Missing Person</u></h4>
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
                                    <select class="r6" aria-label="Default select example" name="State" id="select">
                                        <option selected>-Select-</option>

                                        <option value="1">Gujarat</option>



                                    </select>

                                </div>
                            </div>
                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">Pin Code</label>
                                    <span class="r5"></span>
                                    <input type="text" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" required name="Pin_Code">
                                </div>
                            </div>
                        </div>




                        <div class="r1">
                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">City</label>
                                    <span class="r5">*</span>
                                    <select class="r6" aria-label="Default select example" name="City" id="select">
                                        <option selected>-Select-</option>
                                        <option value="1">Ahmedabad City</option>
                                        <option value="2">Rajkot City</option>
                                        <option value="3">Surat City</option>
                                        <option value="4">Vadodara City</option> 
                                    </select>

                                </div>
                            </div>
                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">Area</label>
                                    <span class="r5">*</span>
                                    <!-- <input type="text" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" required name="Area"> -->
                                    <textarea name="Area" class="r6" id="textAreaExample3" cols="30" rows="1.5" ></textarea>

                                </div>
                            </div>

                        </div>

                        <h2 class="appdet"><u>Place Of Missing</u></h2>
                        <div class="r1">
                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">Place Of Missing Country</label>
                                    <span class="r5">*</span>
                                    <select class="r6" aria-label="Default select example" name="Place_Of_Missing_Country" id="select">
                                        <option selected>-Select-</option>
                                        <option value="1">India</option>



                                    </select>

                                </div>
                            </div>
                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">Place Of Missing State</label>
                                    <span class="r5">*</span>
                                    <select class="r6" aria-label="Default select example" name="Place_Of_Missing_State" id="select">
                                        <option selected>-Select-</option>
                                        <!-- <option value="100">Andaman and Nicobar Island</option>
                                    <option value="2">Andhra Pradesh</option>
                                    <option value="3">Arunachal Pradesh</option>
                                    <option value="4">Assam</option>
                                    <option value="5">Bihar</option>
                                    <option value="6">Chandigarh</option>
                                    <option value="7">Chhattisgarh</option>
                                    <option value="8">Dadra and Nagar Haveli</option>
                                    <option value="9">Daman and diu</option>
                                    <option value="10">Delhi</option>
                                    <option value="11">Goa</option> -->
                                        <option value="1">Gujarat</option>
                                        <!-- <option value="13">Haryana</option>
                                    <option value="14">Himachal Pradesh</option>
                                    <option value="15">Jammu and Kashmir</option>
                                    <option value="16">Jharkhand</option>
                                    <option value="17">Karnataka</option>
                                    <option value="18">Kerala</option>
                                    <option value="19">Lakshadweep</option>
                                    <option value="20">Madhya Pradesh</option>
                                    <option value="21">Maharashtra</option>
                                    <option value="22">Manipur</option>
                                    <option value="23">Meghalaya</option>
                                    <option value="24">Mizoram</option>
                                    <option value="25">Nagaland</option>
                                    <option value="26">Orissa</option>
                                    <option value="27">Puducherry</option>
                                    <option value="28">Punjab</option>
                                    <option value="29">Rajasthan</option>
                                    <option value="30">Sikkim</option>
                                    <option value="31">Tamilnadu</option>
                                    <option value="32">Telengana</option>
                                    <option value="33">Tripura</option>
                                    <option value="34">Uttar Pradesh</option>
                                    <option value="35">Uttrakhand</option>
                                    <option value="36">West Bengal</option> -->


                                    </select>


                                </div>
                            </div>
                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">Place Of Missing Pin Code</label>
                                    <span class="r5"></span>
                                    <input type="text" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" required name="Place_Of_Missing_Pin_Code">
                                </div>
                            </div>
                        </div>



                        <div class="r1">
                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">Place Of Missing City</label>
                                    <span class="r5">*</span>
                                    <select class="r6" aria-label="Default select example" name="Place_Of_Missing_City" id="select">
                                        <option selected>-Select-</option>
                                        <option value="1">Ahmedabad City</option>
                                        <option value="2">Rajkot City</option>
                                        <option value="3">Surat City</option>
                                        <option value="4">Vadodara City</option>
                                    </select>

                                </div>

                            </div>
                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">Place Of Missing Area</label>
                                    <span class="r5">*</span>
                                    <!-- <input type="text" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" required name="Area"> -->
                                    <textarea name="Place_Of_Missing_Area" class="r6" id="textAreaExample3" cols="30" rows="1.5" style="height: 38px;"></textarea>


                                </div>
                            </div>
                            <!-- <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">Pin Code</label>
                                    <span class="r5"></span>
                                    <input type="text" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" required 
                                    name="Pin_Code">
                                </div>
                            </div> -->

                        </div>
                        <h2 class="appdet"><u>Reporting Police Station Details</u></h2>
                        <div class="r1">
                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">Reporting PS City</label>
                                    <span class="r5">*</span>
                                    <select class="r6" aria-label="Default select example" name="Reporting_PS_City"  id="select">
                                        <option selected>-Select-</option>
                                        <option value="1">Ahmedabad City</option>
                                        <option value="2">Ahmedabad Rural</option>
                                    <option value="3">Amreli</option>
                                    <option value="4">Anand</option>
                                    <option value="5">Arvalli</option>
                                    <option value="6">Banaskantha</option>
                                    <option value="7">Bharuch</option>
                                    <option value="8">Bhavnagar</option>
                                    <option value="9">Botad</option>
                                    <option value="10">Chhotaudepur</option>
                                    <option value="11">Dahod</option>
                                    <option value="12">Dang</option>
                                    <option value="13">Devbhumi Dwarka</option>
                                    <option value="14">Gandhinagar</option>
                                    <option value="15">Gir Somnath</option>
                                    <option value="16">Jamnagar</option>
                                    <option value="17">Junagath</option>
                                    <option value="18">Kheda</option>
                                    <option value="19">Kutch East - Gandhidham</option>
                                    <option value="20">Kutch West - Bhuj</option>
                                    <option value="21">Mahisagar</option>
                                    <option value="22">Mehsana</option>
                                    <option value="23">Morbi</option>
                                    <option value="24">Narmada</option>
                                    <option value="25">Navsari</option>
                                    <option value="26">Panchmahal</option>
                                    <option value="27">Patan</option>
                                    <option value="28">Porbandar</option>
                                    <option value="29">Rajkot City</option>
                                    <option value="30">Sabarkantha</option>
                                    <option value="31">Surat City</option>
                                    <option value="32">Surat Rural</option>
                                    <option value="33">Surendranagar</option>
                                    <option value="34">Tapi</option>
                                    <option value="35">Vadodara City</option>
                                     <option value="36">Vadodara Rural</option>
                                    <option value="37">Valsad</option>



                                    </select>
                                </div>
                            </div>
                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">Police Station</label>
                                    <span class="r5"></span>
                                    <select class="r6" aria-label="Default select example" name="Police_Station" id="select">
                                        <option selected>-Select-</option>
                                        <option value="11">Nana Varachha</option>
                                        <option value="12">Mota Varachha</option>
                                        <option value="13">Yogichowk</option>
                                        <option value="14">Vesu</option>
                                        <option value="15">Gujarat University</option>
                                        <option value="16">Adajan</option>
                                        <option value="17">Sarathana</option>
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
                        <h4 class="appdet">Brief Description <span class="r5">*</span> (Maximum 2000 Characters)</43>
                            <div class="r1">
                                <div class="r2">
                                    <div class="r3">
                                        <textarea name="Brief_Description" class="r6" id="brief"></textarea>
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
                                            <select class="r6" aria-label="Default select example" name="Document_Type" id="select">
                                                <option selected>SELECT</option>
                                                <option value="1">Aadhar card</option>
                                                <option value="2">Pan card</option>
                                                <option value="3">VoterId</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="">
                                        <div class="">
                                            <label class=""><u>
                                                    <h6>Upload Document</h6>
                                                </u></label>
                                            <input type="file" class="r6" ids="up1" aria-describedby="emailHelp" name="upldFILE" style="margin-top: 0.5em;">
                                        </div>

                                    </div>
                                    <!-- <div class="">
                                        <div class="">
                                            <label>
                                                <h6> <u>Upload file</u></h6>
                                            </label>
                                            <div>
                                                <button type="button" id="boot1" name="Upload_file" style="color: aliceblue; text-decoration: none;">Upload Document</button>
                                            </div>
                                        </div>
                                    </div> -->


                                </div>




                                <label for="" class="r5">
                                    <h6>Note : Only PDF,JPEG,PNG,JPG are allowed</h6>
                                </label>

                            </div>

                            <h3>Disclaimer</h3>
                            <label for="" id="for">
                                The facility of complaint on this site is purely a measure of public service. The complaint
                                cannot be treated as First Information Report. While every effort has been made to ensure the
                                prompt and accurate action, Gujarat Police and Home Department, Government of Gujarat does not
                                hold itself liable in any aspect, for any consequences, legal or otherwise.
                            </label>
                            <h3>Warning</h3>
                            <label id="for">Legal action will be taken under the relevant law of India against the person who misuses the portal. </label>
                            <div>
                                <input class="" id="..." type="checkbox" class="checkboxNoLabel" required>
                                <label for="...">I Agree</label>
                            </div>
                            <div>
                                <center class="">
                                    <button type="submit" class="boot1" name="sbmt" value="sbmt">Submit</button>
                                    <button type="reset" class="boot2">Reset</button>
                                    <button type="Cancel" class="boot3"><a href="index.php" style="color: aliceblue; text-decoration: none;">Cancel</button>
                                </center>

                            </div>

                    </form>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

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
</body>

</html>