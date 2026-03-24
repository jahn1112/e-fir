<?php
include_once "DBconfig.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FIR</title>
    <!-- website logo -->
    <link rel="icon" href="img\weblogo1.ico" type="image/icon">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="Get a copy of fir.css">
      <!-- datatable css -->
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">

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
            <h2> <b>Get a Copy of Fir</b> </h2>
        </div>

        <div class="app1">
            <div class="">
                <div class="app2">
                    <label for="">Note: Parameters marked with a <span class="r5">*</span> are mandatory</label>

                    <form>

                        <div class="r1">
                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">Fir Number:</label>
                                    <span class="r5"></span>
                                    <input type="text" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" required name="Fir Number">
                                </div>
                            </div>


                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">City/District</label>
                                    <span class="r5">*</span>
                                    <select class="r6" aria-label="Default select example" name="City/District">
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
                                    <span class="r5">*</span>
                                    <select class="r6" aria-label="Default select example" name="Police Station">
                                        <option selected>-Select-</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        


                        <div class="r1">
                            <div class="r2">
                                <div class="">
                                    <label for="exampleInputEmail1" class="">Accused:</label>
                                    <span class="r5">*</span>
                                    <div class="bu1">
                                        <div class="bu2">
                                            <input class="bu3" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                            <label class="" for="inlineRadio1">Known</label>
                                        </div>
                                        <div class="bu4">
                                            <input class="bu3" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                                            <label class="" for="inlineRadio2">Anonymous</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="r1">
                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">	First Name of Accused:</label>
                                    <span class="r5"></span>
                                    <input type="text" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" required name="First Name of Accused">

                                </div>
                            </div>
                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">	Middle Name of Accused:</label>
                                    <span class="r5"></span>
                                    <input type="text" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" required name="Middle Name of Accused">

                                </div>
                            </div>
                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">Last Name of Accused:</label>
                                    <span class="r5"></span>
                                    <input type="text" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" required name="Last Name of Accused">

                                </div>
                            </div>
                        </div>
                        <div class="r1">
                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">	First Name of Complainant:</label>
                                    <span class="r5"></span>
                                    <input type="text" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" required name="First Name of Complainant">

                                </div>
                            </div>
                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">	Middle Name of Complainant:</label>
                                    <span class="r5"></span>
                                    <input type="text" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" required name="Middle Name of Complainant">

                                </div>
                            </div>
                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">Last Name of Complainant:</label>
                                    <span class="r5"></span>
                                    <input type="text" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" required name="Last Name of Complainant">

                                </div>
                            </div>
                        </div>

                        <div class="r1">
                            <div class="r2">
                                <div class="r3">
                                    <label for="exampleInputEmail1" class="r4">	FIR Date:</label>
                                    <span class="r5">*</span>
                                    <input type="date" class="r6" id="exampleInputEmail1" aria-describedby="emailHelp" required name="From FIR Date">

                                </div>
                            </div>

                        </div>
                    </form>

                </div>
                <div>
                    <center class="">
                        <button type="submit" class="boot1">view</button>
                        <button type="reset" class="boot2">reset</button>
                        <button type="Cancel" class="boot3"><a href="index.php" style="color: aliceblue; text-decoration: none;">Cancel</button>
                    </center>

                </div>

                </form>

            </div>
           
           </div>
       
        </div>

        <section class="apptab">
            <div>
                <center><h2>View Details</h2></center>
            <table class="content-table" id="myTable1">
                            <thead>
                                <tr>
                                    <th scope="col">Sr.No.</th>
                                    <th scope="col">Applicant Name</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Gender</th>
                                    <th scope="col">Reference No.</th>
                                    <th scope="col">Request Date & Time</th>
                                    <th scope="col">DOB</th>
                                    <th scope="col">Status</th>


                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                for ($i = 0; $i <= 1; $i++) {
                                    echo '<tr>
                                        <th scope="row">' . $i + 1 . '</th>
                                        <td>Mark</td>
                                        <td>e-Application</td>
                                        <td>male</td>
                                        <td><a href=".\e-app\e-app_info.php?rno=878997">878337</a></td>
                                        <td>12/12/2022</td>
                                        <td>12/12/2022</td>
                                        <td>In Progress</td>
                                      </tr>';
                                }

                                
                    
                                // $qry = "SELECT * FROM `e_application_table` e join user_master u WHERE e.user_id = u.user_id;";
                                // $res = mysqli_query($con,$qry);
                                
                                // while($row = mysqli_fetch_assoc($res))
                                // {
                                //     echo '<tr>
                                //         <th scope="row">' . $row['e_application_id']. '</th>
                                //          <td>' . $row['user_fname'].' '.$row['user_lname'].'</td>
                                //          <td>'. $row['application_type'].'</td>
                                //          <td>'. $row['gender'].'</td>
                                //          <td><a href=".\e-app\e-app_info.php?rno='. $row['e_application_id']. '">000'. $row['e_application_id']. '</a></td>
                                //          <td>'. $row['sbmt_date']. '</td>
                                //          <td>'. $row['user_dob']. '</td>
                                //          <td>'. $row['action_taken']. '</td>
                                //        </tr>';
                                // }
                            

                                // ?>
                            </tbody>
                        </table>
            </div>
        </section>
        

        <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script> -->

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
     <!-- datatable js/jquery file -->
     <script src="js\jquery.min.js"></script>
    <script type="text/javascript" charset="utf8" src="js\jquery.datatables.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable1').DataTable();
        });
    </script>


</body>

</html>

