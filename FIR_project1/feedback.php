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



if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $Feedback_id = 0;
    $email = $_POST['Email'];
    $subject = $_POST['Subject'];
    $feed_back = $_POST['Feedback'];


    $sql = "INSERT INTO `feedback_table` (`feedback_id`, `email`, `subject`, `feedback`,  `submmit_date`) VALUES ('" . $Feedback_id . "', '" . $email . "', '" . $subject . "', '" . $feed_back . "', current_timestamp());";
    $result = mysqli_query($con, $sql);
    if ($result) {
        echo "<script>alert('Feedback Accepted...')</script>";
    }
    else {
        echo 'The record was not inserted successfully because of this error' . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback</title>
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
            <h2><b>Feedback</b> </h2>
        </div>
        <form action="#" method="POST">
            <div class="app1">
                <div class="">
                    <div class="app2">
                        
                    
                            <div class="r1">
                                
                                <div class="r2">
                                    <div class="r3">
                                        <label for="exampleInputEmail1" class="r4">Email <span class="r5">*</span></label>
                                        <span class="r5"></span>
                                        <input type="email" class="r6" class="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email" name="Email" required>
                                    </div>

                                </div>
                            </div>

                            <div class="r1">
                                
                                <div class="r2">
                                    <div class="r3">
                                        <label for="exampleInputEmail1" class="r4">Subject <span class="r5">*</span></label>
                                        <span class="r5"></span>
                                        <input type="text" class="r6" class="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Sunject" name="Subject" required>
                                    </div>

                                </div>
                            </div>
                            
                                
                                <h3 class="appdet">Give Your Feedback <span class="r5">*</span></h3>
                                    <div class="r1">
                                        <div class="r2">
                                            <div class="r3">
                                                <textarea class="r6"  id style="width: 280%;" maxlength="300" name="Brief" name="Feedback" required ></textarea>
                                            </div>
                                        </div>
                                    </div>
                                


                                

                                <div>
                                    <center class="">
                                        <button type="submit" class="boot1">submit</button>
                                        <button type="reset" class="boot2">reset</button>
                                        <button type="Cancel" class="boot3"><a href="index.php" style="color: aliceblue; text-decoration: none;">Cancel</button>
                                    </center>

                                </div>
                        

                    </div>
                </div>
            </div>
        </form>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
        </script>




        
        <script src="script.js"></script>



</body>

</html>