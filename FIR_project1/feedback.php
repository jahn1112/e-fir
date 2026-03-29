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
    <link rel="stylesheet" href="modern_index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700&display=swap">
</head>


<body>


<body>
    <?php include "common/_navbar.php"; ?>

    <div class="main-form-container">
        <div class="page-header">
            <h1>Citizen Feedback</h1>
            <p>Your feedback helps us serve you better</p>
        </div>

        <div class="glass-container" style="max-width: 800px; margin: 0 auto;">
            <form action="#" method="POST">
                <div class="form-section">
                    <h2 class="section-title"><i class="fas fa-comment-alt"></i> Share Your Thoughts</h2>
                    <div class="form-grid">
                        <div class="form-group full-width">
                            <label>Email Address <span class="required">*</span></label>
                            <input type="email" name="Email" placeholder="Enter your email" required>
                        </div>
                        <div class="form-group full-width">
                            <label>Subject <span class="required">*</span></label>
                            <input type="text" name="Subject" placeholder="Brief summary of your feedback" required>
                        </div>
                    </div>
                    <div class="form-group full-width" style="margin-top: 15px;">
                        <label>Your Feedback <span class="required">*</span></label>
                        <textarea name="Feedback" maxlength="500" placeholder="Please describe your experience or suggestions..." style="min-height: 150px;" required></textarea>
                        <p style="font-size: 0.75rem; color: var(--text-muted); margin-top: 5px;">Maximum 500 characters</p>
                    </div>
                </div>

                <div class="form-actions" style="margin-top: 2rem;">
                    <button type="submit" class="btn-submit">Submit Feedback</button>
                    <button type="reset" class="btn-reset">Clear</button>
                    <button type="button" class="btn-reset" onclick="window.location.href='index.php'" style="background: rgba(239, 68, 68, 0.1); color: #ef4444; border-color: rgba(239, 68, 68, 0.2);">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <?php include "common/_footer.php"; ?>
</body>

</html>