<?php
session_start();
include "DBconfig.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lookout Notices | Gujarat Police</title>
    <link rel="icon" href="img\weblogo1.ico" type="image/icon">
    <link rel="stylesheet" href="modern_efir.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        .notice-container {
            max-width: 800px;
            margin: 100px auto;
            padding: 40px;
            background: var(--glass-bg);
            backdrop-filter: var(--glass-blur);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            text-align: center;
            box-shadow: var(--glass-shadow);
        }
        .download-box {
            margin-top: 30px;
            padding: 30px;
            border: 2px dashed var(--accent-blue);
            border-radius: 15px;
            background: rgba(14, 165, 233, 0.05);
            transition: all 0.3s ease;
        }
        .download-box:hover {
            background: rgba(14, 165, 233, 0.1);
            transform: translateY(-5px);
        }
        .download-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 15px 35px;
            background: var(--accent-blue);
            color: white;
            text-decoration: none;
            border-radius: 30px;
            font-weight: 600;
            box-shadow: 0 10px 20px -5px rgba(14, 165, 233, 0.4);
            transition: all 0.3s ease;
        }
        .download-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 15px 25px -5px rgba(14, 165, 233, 0.5);
        }
    </style>
</head>
<body>

    <?php include "common/_navbar.php"; ?>

    <div class="notice-container">
        <div class="page-header" style="margin: 0;">
            <i class="fas fa-bullhorn" style="font-size: 4rem; color: var(--accent-blue); margin-bottom: 20px;"></i>
            <h1>Public Lookout Notices</h1>
            <p>Help us find missing persons across Gujarat State</p>
        </div>

        <div class="download-box">
            <h3 style="color: var(--text-white);">Missing Person Report</h3>
            <p style="color: var(--text-muted); font-size: 0.9rem; margin-top: 10px;">Download the latest consolidate lookout notice for active cases.</p>
            <a href="PDF/MISSING_PERSON_LOOKOUT_NOTICE.pdf" target="_blank" class="download-btn">
                <i class="fas fa-file-pdf mr-2"></i> View Lookout Notice (PDF)
            </a>
        </div>
        
        <p style="margin-top: 30px; font-size: 0.85rem; color: var(--text-muted);">
            <i class="fas fa-info-circle"></i> Every lead counts. Your small information can bring someone home.
        </p>
    </div>

    <?php include "common/_footer.php"; ?>


</body>
</html>