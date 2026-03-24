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
// File_Name

if (isset($_POST['sbmt'])) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // echo "called";
        $userid = $_SESSION["userid"];
        // $Firstname = $_POST['First_name'];
        // $FatherName = $_POST['Father_Name'];
        // $Surname = $_POST['Surname'];
        // $PermanentAddress = $_POST['Permanent_Address'];
        // $Emailaddress = $_POST['Email_address'];
        // $MobileNumber = $_POST['Mobile_Number'];
        // $LandlineNo = $_POST['Landline_No'];
        $SCFirstName =$_POST['SC_First_Name'];
        $SCFatherName=$_POST['SC_Father_Name'];
        $SCSurname=$_POST['SC_Surname'];
        $NameofCity = $_POST['name_of_City'];
        $PoliceStation = $_POST['Police_Station'];
        $YearOfRetirement = $_POST['Year_Of_Retirement'];
        $RetiredFrom = $_POST['Retired_From'];
        $Health = $_POST['Health'];
        $Family = $_POST['Family'];
        $ResidingWith = $_POST['Residing_With'];
        $NoofChildren = $_POST['No_of_Children'];
        $SpouseName = $_POST['Spouse_Name'];
        $DateOfBirth = $_POST['Date_Of_Birth'];
        $WeddingDate = $_POST['Wedding_Date']; 
        $LastPoliceVisitDate = $_POST['Last_Police_Visit_Date'];
        $Relative_ServentDetails = $_POST['Relative_Servent_Details'];
        $FileDesk = $_POST['File_Desk'];
        // $FileName = $_POST['File_Name'];
        // $Uploadfile = $_POST['Upload_file'];

        if (isset($_FILES['File_Name'])) {

            $file_name = $_FILES["File_Name"]["name"];
            $file_size = $_FILES["File_Name"]["size"];
            $file_tmp = $_FILES["File_Name"]["tmp_name"];
            $file_type = $_FILES["File_Name"]["type"];

            // print_r($_POST);
            if ($file_type == 'application/pdf' || $file_type == 'image/jpeg' || $file_type == 'image/png') {
                $res =  move_uploaded_file($file_tmp, "./sc_reg_doc/" . $file_name);
                if ($res) {
                    $sql = 'INSERT INTO `senior_citizen_reg_table` (`sc_reg_id`, `user_id`,`sc_fname`,`sc_mname`, `sc_lname`,`city_id`, `police_station_id`, `year_retirement`,  `health`, `family`, `residing_with`, `no_of_child`, `spouse_name`, `dob`, `wedding_date`, `lst_plc_visit_date`, `relative_details`,  `document_id`, `reg_date_time`) VALUES ( NULL,' . $userid . ',"'.$SCFirstName.'","'.$SCFatherName.'","'.$SCSurname.'",' . $NameofCity . ',' . $PoliceStation . ',' . $YearOfRetirement . ', "' . $Health . '", "' . $Family . '","' . $ResidingWith . '" ,"' . $NoofChildren . '", "' . $SpouseName . '", "' . $DateOfBirth . '", "' . $WeddingDate . '", "' . $LastPoliceVisitDate . '", "' . $Relative_ServentDetails . '",' . $FileDesk . ', current_timestamp());';
                    $result = mysqli_query($con, $sql);
                    if ($result) {
                        echo '';
                        echo "<script>alert('Submited successsfully...')</script>";
                    } else {
                        // echo 'The record was not inserted successfully because of this error' . mysqli_error($con);
                        echo "<script>alert('Not Submited ...')</script>";
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
    <title>Senior Citizen Registration</title>
    <!-- website logo -->
    <link rel="icon" href="img\weblogo1.ico" type="image/icon">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="Senior CitizenRegestration.css">
    <link rel="stylesheet" href="form_theme.css">
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


        <h2 class="t"><b>
                <center>Senior Citizen Regestration</center>
            </b></h2>

        <div class="app1">


            <div class="">

                <div class="app2">
                    <form action="#" method="POST" enctype="multipart/form-data">

                        <h3 class="appdet"><u>Applicant Details</u></h3>


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
                                    <label for="exampleInputEmail1" class="r4">Father's/Husband's Name</label>
                                    <span class="r5"></span>
                                    <input type="text" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" style="background: #E4DEDE;" value="<?php echo $umname; ?>" disabled>
                                </div>

                            </div>
                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">Surname</label>
                                    <span class="r5"></span>
                                    <input type="text" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" style="background: #E4DEDE;" value="<?php echo $ulname; ?>" disabled>
                                </div>
                            </div>

                        </div>


                        <div class="r1">
                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">Permanent Address</label>
                                    <span class="r5"></span><br>
                                    <textarea class="r6" id="textAreaExample1" rows="4" disabled><?php echo $uaddress ?></textarea>
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
                                    <input type="text" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" style="background: #E4DEDE;" value="NA" disabled>
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
                                    <input type="text" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" name="SC_First_Name"  required >
                                </div>

                            </div>
                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">SC Father Name</label>
                                    <span class="r5"></span>
                                    <input type="text" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp"  name="SC_Father_Name" required>
                                </div>

                            </div>
                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">SC Surname</label>
                                    <span class="r5"></span>
                                    <input type="text" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp"  name="SC_Surname" required>
                                </div>
                            </div>

                        </div>

                        <div class="r1">
                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">Name of City</label>
                                    <span class="r5">*</span>
                                    <select class="r6" aria-label="Default select example" name="name_of_City" id="select" required>
                                        <option selected>-Select-</option>
                                        <option value="2">Ahmedabad City</option>
                                        <option value="3">Ahmedabad Rural</option>
                                        <option value="4">Amreli</option>
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
                                    <span class="r5">*</span>
                                    <select class="r6" aria-label="Default select example" name="Police_Station" id="select" required>
                                        <option selected>-Select-</option>
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
                                    <label for="exampleInputEmail1" class="r4">Year Of Retirement</label>
                                    <span class="r5"></span>
                                    <select class="r6" aria-label="Default select example" name="Year_Of_Retirement" id="select" required>
                                        <option selected>-Select-</option>
                                        <option value="1901">1901</option>
                                        <option value="1902">1902</option>
                                        <option value="1903">1903</option>
                                        <option value="1904">1904</option>
                                        <option value="1905">1905</option>
                                        <option value="1906">1906</option>
                                        <option value="1907">1907</option>
                                        <option value="1908">1908</option>
                                        <option value="1909">1909</option>
                                        <option value="1910">1910</option>
                                        <option value="1911">1911</option>
                                        <option value="1912">1912</option>
                                        <option value="1913">1913</option>
                                        <option value="1914">1914</option>
                                        <option value="1915">1915</option>
                                        <option value="1916">1916</option>
                                        <option value="1917">1917</option>
                                        <option value="1918">1918</option>
                                        <option value="1919">1919</option>
                                        <option value="1920">1920</option>
                                        <option value="1921">1921</option>
                                        <option value="1922">1922</option>
                                        <option value="1923">1923</option>
                                        <option value="1924">1924</option>
                                        <option value="1925">1925</option>
                                        <option value="1926">1926</option>
                                        <option value="1927">1927</option>
                                        <option value="1928">1928</option>
                                        <option value="1929">1929</option>
                                        <option value="1930">1930</option>
                                        <option value="1931">1931</option>
                                        <option value="1932">1932</option>
                                        <option value="1933">1933</option>
                                        <option value="1934">1934</option>
                                        <option value="1935">1935</option>
                                        <option value="1936">1936</option>
                                        <option value="1937">1937</option>
                                        <option value="1938">1938</option>
                                        <option value="1939">1939</option>
                                        <option value="1940">1940</option>
                                        <option value="1941">1941</option>
                                        <option value="1942">1942</option>
                                        <option value="1943">1943</option>
                                        <option value="1944">1944</option>
                                        <option value="1945">1945</option>
                                        <option value="1946">1946</option>
                                        <option value="1947">1947</option>
                                        <option value="1948">1948</option>
                                        <option value="1949">1949</option>
                                        <option value="1950">1950</option>
                                        <option value="1951">1951</option>
                                        <option value="1952">1952</option>
                                        <option value="1953">1953</option>
                                        <option value="1954">1954</option>
                                        <option value="1955">1955</option>
                                        <option value="1956">1956</option>
                                        <option value="1957">1957</option>
                                        <option value="1958">1958</option>
                                        <option value="1959">1959</option>
                                        <option value="1960">1960</option>
                                        <option value="1961">1961</option>
                                        <option value="1962">1962</option>
                                        <option value="1963">1963</option>
                                        <option value="1964">1964</option>
                                        <option value="1965">1965</option>19
                                        <option value="1966">1966</option>
                                        <option value="1967">1967</option>
                                        <option value="1968">1968</option>
                                        <option value="1969">1969</option>
                                        <option value="1970">1970</option>
                                        <option value="1971">1971</option>
                                        <option value="1972">1972</option>
                                        <option value="1973">1973</option>
                                        <option value="1974">1974</option>
                                        <option value="1975">1975</option>
                                        <option value="1976">1976</option>
                                        <option value="1977">1977</option>
                                        <option value="1978">1978</option>
                                        <option value="1979">1979</option>
                                        <option value="1980">1980</option>
                                        <option value="1981">1981</option>
                                        <option value="1982">1982</option>
                                        <option value="1983">1983</option>
                                        <option value="1984">1984</option>
                                        <option value="1985">1985</option>
                                        <option value="1986">1986</option>
                                        <option value="1987">1987</option>
                                        <option value="1988">1988</option>
                                        <option value="1989">1989</option>
                                        <option value="1990">1990</option>
                                        <option value="1991">1991</option>
                                        <option value="1992">1992</option>
                                        <option value="1993">1993</option>19
                                        <option value="1994">1994</option>
                                        <option value="1995">1995</option>
                                        <option value="1996">1996</option>
                                        <option value="1997">1997</option>
                                        <option value="1998">1998</option>
                                        <option value="1999">1999</option>
                                        <option value="2000">2000</option>
                                        <option value="2001">2001</option>
                                        <option value="2002">2002</option>
                                        <option value="2003">2003</option>
                                        <option value="2004">2004</option>
                                        <option value="2005">2005</option>
                                        <option value="2006">2006</option>
                                        <option value="2007">2007</option>
                                        <option value="2008">2008</option>
                                        <option value="2009">2009</option>
                                        <option value="2010">2010</option>
                                        <option value="2011">2011</option>
                                        <option value="2012">2012</option>
                                        <option value="2013">2013</option>
                                        <option value="2014">2014</option>
                                        <option value="2015">2015</option>
                                        <option value="2016">2016</option>
                                        <option value="2017">2017</option>
                                        <option value="2018">2018</option>
                                        <option value="2019">2019</option>
                                        <option value="2020">2020</option>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>




                                    </select>

                                </div>
                            </div>
                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">Retired From</label>
                                    <span class="r5"></span>
                                    <input type="text" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" required name=" Retired_From" required>
                                </div>
                            </div>
                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">Health</label>
                                    <span class="r5"></span>
                                    <select class="r6" aria-label="Default select example" name="Health" id="select" required>
                                        <option value="">-Select-</option>
                                        <option value="Bad">Bad</option>
                                        <option value="Good">Good</option>
                                    </select>

                                </div>
                            </div>

                        </div>
                        <div class="r1">
                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">Family</label>
                                    <span class="r5"></span>
                                    <select class="r6" aria-label="Default select example" name="Family" id="select" required>
                                        <option value="">-Select-</option>
                                        <option value="Joint">Joint</option>
                                        <option value="Nuclear">Nuclear</option>
                                        <option value="Single">Single</option>
                                    </select>

                                </div>
                            </div>
                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">Residing with</label>
                                    <span class="r5"></span>
                                    <select class="r6" aria-label="Default select example" name="Residing_With" id="select" required>
                                        <option value="">-Select-</option>
                                        <option value="Alone">Alone</option>
                                        <option value="Children">Children</option>
                                        <option value="Friends">Friends</option>
                                        <option value="Relatives">Relatives</option>
                                        <option value="Spouse">Spouse</option>
                                    </select>

                                </div>
                            </div>
                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">No of Children</label>
                                    <span class="r5"></span>
                                    <input type="text" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" required name="No_of_Children" required>
                                </div>
                            </div>

                        </div>

                        <h3 class="appdet"><u>Spouse Details</u></h3>

                        <div class="r1">
                            <div class="r2">
                                <div class="r3">
                                    <label for="" class="r4">Spouse Name</label>
                                    <input type="text" class="r6" required name="Spouse_Name" required>

                                </div>
                            </div>
                            <div class="r2">
                                <div class="r3">
                                    <label for="" class="r4">Date Of Birth</label>
                                    <input type="date" class="r6" name="Date_Of_Birth" required>
                                </div>
                            </div>
                            <div class="r2">
                                <div class="r3">
                                    <label for="" class="r4">Wedding Date</label>
                                    <input type="date" class="r6" name="Wedding_Date" required>
                                </div>
                            </div>

                        </div>

                        <h3 class="appdet">Other Details</h3>

                        <div class="r1">
                            <div class="r2">
                                <div class="r3">
                                    <label for="" class="r4">Last Police Visit Date</label>
                                    <input type="date" class="r6" name="Last_Police_Visit_Date" required>

                                </div>
                            </div>

                        </div>
                        <div class="r1">
                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">Relative_Servent Details</label>
                                    <span class="r5"></span>
                                    <select class="r6" aria-label="Default select example" name="Relative_Servent_Details" id="select" required>
                                        <option value="">-Select-</option>
                                        <option value="Driver">Driver</option>
                                        <option value="Friend">Friend</option>
                                        <option value="Relative">Relative</option>
                                        <option value="Servent">Servent</option>
                                        <option value="Tenant">Tenant</option>
                                        <option value="Watchman">Watchman</option>
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
                                    <select class="r6" aria-label="Default select example" name="File_Desk" id="select" required>
                                        <option value="">-Select-</option>
                                        <option value="1">Aadhar Card</option>
                                        <option value="2">Pan Card</option>
                                        <option value="3">Voter ID</option>
                                    </select>
                                </div>
                            </div>

                            <div class="r2">
                                <div class="r3">
                                    <label for="" class="r4">File Name</label>
                                    <input type="file" class="r6" name="File_Name" required>
                                </div>
                            </div>
                            <!-- <div class="r2">
                                <div class="r3">
                                    <label>
                                        <h6> <u>Upload file</u></h6>
                                    </label>
                                    <div>
                                        <button type="button" id="boot1" name="Upload_file" style="color: aliceblue; text-decoration: none;">Upload Document</button>
                                    </div>
                                </div>
                            </div> -->






                        </div>
                        <label class="r5"><b>Note : Only PDF,JPEG,PNG,JPG are allowed</b></label>


                        <h3>Disclaimer</h3>
                        <label for="" class="">
                            The facility of complaint on this site is purely a measure of public service. The complaint
                            cannot be treated as First Information Report. While every effort has been made to ensure
                            the
                            prompt and accurate action, Gujarat Police and Home Department, Government of Gujarat does
                            not
                            hold itself liable in any aspect, for any consequences, legal or otherwise.
                        </label>
                        <h3>Warning</h3>
                        <label class="">
                            Legal action will be taken under the relevant law of India against the person who misuses
                            theportal.
                        </label>

                        <div>
                            <input class="" id="..." type="checkbox" class="checkboxNoLabel" required>
                            <label for="...">I Agree</label>
                        </div>
                        <center class="">
                            <button type="submit" class="boot1" name="sbmt" value="sbmt">Submit</button>
                            <button type="reset" class="boot2">Reset</button>
                            <button type="Cancel" class="boot3"><a href="index.php" style="color: aliceblue; text-decoration: none;">Cancel</button>
                        </center>

                    </form>


                </div>

            </div>

        </div>




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
    </section>
</body>

</html>