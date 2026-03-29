<?php
session_start();
include "DBconfig.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Directory | Gujarat Police</title>
    <link rel="icon" href="img\weblogo1.ico" type="image/icon">
    <link rel="stylesheet" href="modern_efir.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        .contact-container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 20px;
        }
        .contact-card {
            background: var(--glass-bg);
            backdrop-filter: var(--glass-blur);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 40px;
            overflow-x: auto;
        }
        .contact-card h2 {
            color: var(--accent-blue);
            margin-bottom: 25px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 15px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            color: var(--text-white);
        }
        th {
            background: rgba(255, 255, 255, 0.1);
            padding: 15px;
            text-align: left;
            font-weight: 600;
            border-bottom: 2px solid var(--accent-blue);
        }
        td {
            padding: 15px;
            border-bottom: 1px solid var(--glass-border);
            font-size: 0.9rem;
        }
        tr:hover {
            background: rgba(255, 255, 255, 0.05);
        }
        .badge-helpline {
            background: var(--accent-blue);
            padding: 5px 12px;
            border-radius: 20px;
            font-weight: 700;
            font-size: 1rem;
        }
    </style>
</head>
<body>

    <?php include "common/_navbar.php"; ?>

    <div class="contact-container">
        <div class="page-header">
            <h1>Emergency & Admin Contact</h1>
            <p>Direct Access to Gujarat Law Enforcement Authorities</p>
        </div>

        <!-- Helpline Section -->
        <div class="contact-card">
            <h2><i class="fas fa-life-ring"></i> Emergency Helplines</h2>
            <table>
                <thead>
                    <tr>
                        <th width="100">Sr. No.</th>
                        <th>Helpline Number</th>
                        <th>Service Description</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td><span class="badge-helpline">100</span></td>
                        <td>Police Emergency Services</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td><span class="badge-helpline">108</span></td>
                        <td>Ambulance & Medical Emergency</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td><span class="badge-helpline">181</span></td>
                        <td>Abhayam Women Helpline</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td><span class="badge-helpline">112</span></td>
                        <td>National Emergency Number</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Regional Directory Section -->
        <div class="contact-card">
            <h2><i class="fas fa-envelope-open-text"></i> City/District Directory</h2>
            <table>
                <thead>
                    <tr>
                        <th>Sr.</th>
                        <th>Range/CP</th>
                        <th>Municipality / District</th>
                        <th>Official Email</th>
                        <th>Contact Number</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td rowspan="4" style="font-weight: bold; background: rgba(14, 165, 233, 0.1);">C.P. Offices</td>
                        <td>Ahmedabad City</td>
                        <td>cp-ahd@gujarat.gov.in</td>
                        <td>079-25630100, 25630500</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Rajkot City</td>
                        <td>cp-raj@gujarat.gov.in</td>
                        <td>0281-2457777</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Surat City</td>
                        <td>cp-sur@gujarat.gov.in</td>
                        <td>0261-2241301</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Vadodara City</td>
                        <td>cp-vad@gujarat.gov.in</td>
                        <td>0265-2415111</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td rowspan="3" style="font-weight: bold; background: rgba(255, 255, 255, 0.05);">Ahmedabad Range</td>
                        <td>Ahmedabad Rural</td>
                        <td>sp-ahd@gujarat.gov.in</td>
                        <td>079-26891168</td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>Anand</td>
                        <td>sp-and@gujarat.gov.in</td>
                        <td>02692-261033</td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td>Kheda</td>
                        <td>sp-khe@gujarat.gov.in</td>
                        <td>0268-2561800</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <?php include "common/_footer.php"; ?>


</body>
</html>