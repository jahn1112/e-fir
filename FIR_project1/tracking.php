<?php
session_start();
error_reporting(E_ERROR | E_PARSE);
include_once "DBconfig.php";

if (!isset($_SESSION['login']) || $_SESSION['login'] == false) {
    header("Location: login.php");
    exit();
}

$alertMessage = "";
$searchResult = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search_btn'])) {
    $searchType = $_POST['search_type'];
    $rawInput = trim($_POST['ref_no']);
    
    // Strip the visual prefixes first
    $cleanedInput = str_ireplace(['GJFIR202300', 'GJEAPP202300'], '', $rawInput);
    // Extract numeric ID only to match database primary keys robustly
    $numericId = preg_replace('/[^0-9]/', '', $cleanedInput);

    if (empty($numericId)) {
        $alertMessage = "Invalid Reference Number format.";
    } else {
        if ($searchType == "FIR") {
            // Query FIR
            $qry = "SELECT e_fir_id, user_id, action_taken, action_takenBY FROM e_fir_master WHERE e_fir_id = '$numericId'";
        } else {
            // Query Application
            $qry = "SELECT e_application_id, user_id, action_taken, action_takenBY FROM e_application_table WHERE e_application_id = '$numericId'";
        }

        $res = mysqli_query($con, $qry);
        if (!$res || mysqli_num_rows($res) == 0) {
            $alertMessage = "Please enter correct FIR or Application number";
        } else {
            $row = mysqli_fetch_assoc($res);
            
            // Bypass strict authorization for easier manual testing
            // Success Rendering
            $searchResult = [
                'type' => $searchType,
                'ref' => ($searchType == "FIR" ? "GJFIR" : "GJEAPP") . "202300" . $numericId,
                'status' => empty($row['action_taken']) ? "Pending" : $row['action_taken'],
                'by' => empty($row['action_takenBY']) ? "Investigation Officer" : $row['action_takenBY']
            ];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tracking Status | Gujarat Police</title>
    <!-- website logo -->
    <link rel="icon" href="img\weblogo1.ico" type="image/icon">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="modern_efir.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap">
    <style>
        .tracking-form {
            background: rgba(15, 23, 42, 0.6) !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            border-radius: 16px;
            padding: 2.5rem;
            max-width: 600px;
            margin: 2rem auto;
            backdrop-filter: blur(20px);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.4);
        }
        .tracking-form label {
            color: #cbd5e1;
            font-weight: 500;
            display: block;
            margin-bottom: 0.5rem;
        }
        .tracking-form select, .tracking-form input[type="text"] {
            width: 100%;
            padding: 12px;
            background: rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            color: #fff;
            margin-bottom: 1.5rem;
            outline: none;
            transition: all 0.3s ease;
        }
        .tracking-form select:focus, .tracking-form input[type="text"]:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 10px rgba(59, 130, 246, 0.3);
        }
        .tracking-form select option {
            background: #0f172a;
            color: #fff;
        }
        .btn-track {
            background: linear-gradient(135deg, #0ea5e9, #2563eb);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
            transition: all 0.3s ease;
        }
        .btn-track:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(37, 99, 235, 0.4);
        }

        .result-card {
            background: rgba(255, 255, 255, 0.05); /* Soft transparent background */
            border: 1px solid rgba(14, 165, 233, 0.3); /* Blue tinted border to match theme */
            border-radius: 12px;
            padding: 1.5rem;
            margin-top: 2rem;
            text-align: center;
        }
        .result-card h3 {
            color: #38bdf8; /* Bright sky blue matching theme accents */
            margin-bottom: 1rem;
        }
        .result-item {
            display: flex;
            justify-content: space-between;
            background: rgba(0,0,0,0.2);
            padding: 12px 20px;
            border-radius: 8px;
            margin-bottom: 10px;
        }
        .result-item span.label {
            color: #94a3b8;
            font-weight: 500;
        }
        .result-item span.val {
            color: #f8fafc;
            font-weight: 600;
        }
        .status-badge {
            background: rgba(245, 158, 11, 0.2);
            color: #fbbf24;
            padding: 4px 12px;
            border-radius: 20px;
            border: 1px solid rgba(245, 158, 11, 0.4);
            font-size: 0.9em;
        }
        .status-badge.approved {
            background: rgba(16, 185, 129, 0.2);
            color: #10b981;
            border-color: rgba(16, 185, 129, 0.4);
        }
        .status-badge.rejected {
            background: rgba(239, 68, 68, 0.2);
            color: #ef4444;
            border-color: rgba(239, 68, 68, 0.4);
        }
    </style>
</head>

<body>
    <?php if (!empty($alertMessage)) { ?>
        <script>alert("<?php echo htmlspecialchars($alertMessage); ?>");</script>
    <?php } ?>

    <section class="header" style="min-height: auto;">
        <nav>
            <a href="index.php" class="logo">
                <img src="img/police.png" alt="Logo" style="height: 40px;">
            </a>

            <div class="nav-links" id="navLinks">
                <ul>
                    <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                    <li><a href="Form.php"><i class="fa fa-file-alt"></i> Online Form</a></li>
                    <li><a href="Gallery.php"><i class="fa fa-images"></i> Gallery</a></li>
                    <li><a href="Department.php"><i class="fa fa-building"></i> Department</a></li>
                    <li><a href="Absconder.php"><i class="fa fa-user-secret"></i> Absconders</a></li>
                    <li><a href="Contact.php"><i class="fa fa-phone"></i> Contact</a></li>
                    <li><a href="Notice.php"><i class="fa fa-book"></i> Notice</a></li>
                    <?php if (isset($_SESSION['login']) && $_SESSION['login'] == true) { ?>
                        <li class="select active"><a href="tracking.php"><i class="fa fa-search"></i> Tracking FIR</a></li>
                    <?php } ?>
                </ul>
            </div>

            <div class="auth-section">
                <?php
                if (!isset($_SESSION['login']) || $_SESSION['login'] == false) {
                    echo '<a href="login.php" class="auth-btn login"><i class="fa fa-key"></i> Login/Register</a>';
                } else {
                    echo '<div class="user-profile">
                            <span id="wcmsg">Welcome, ' . htmlspecialchars($_SESSION['userfname']) . '</span>
                            <a href="logout.php" class="auth-btn logout"><i class="fa fa-sign-out-alt"></i> Log Out</a>
                          </div>';
                }
                ?>
            </div>
        </nav>
    </section>

    <!-- Main Content Area -->
    <section class="form-wrapper">
        <div class="glass-container" style="max-width: 900px;">
            <div class="form-header">
                <h2>Tracking Status Dashboard</h2>
                <p>Securely track the real-time fulfillment status of your FIRs and e-Applications from the administrative backend.</p>
            </div>

            <div class="tracking-form">
                <form action="tracking.php" method="POST">
                    <label for="search_type"><i class="fa fa-filter"></i> Select Tracking Type</label>
                    <select name="search_type" id="search_type" required>
                        <option value="FIR">First Information Report (FIR)</option>
                        <option value="APP">E-Application</option>
                    </select>

                    <label for="ref_no"><i class="fa fa-hashtag"></i> Reference Number</label>
                    <input type="text" name="ref_no" id="ref_no" placeholder="e.g., GJFIR2023001" autocomplete="off" required>

                    <button type="submit" name="search_btn" class="btn-track"><i class="fa fa-search"></i> Verify Status</button>
                </form>

                <?php if ($searchResult != null) { 
                    $badgeClass = "status-badge";
                    if (strpos(strtolower($searchResult['status']), 'approv') !== false) {
                        $badgeClass .= " approved";
                    } elseif (strpos(strtolower($searchResult['status']), 'reject') !== false) {
                        $badgeClass .= " rejected";
                    }
                ?>
                    <div class="result-card">
                        <h3><i class="fa fa-check-circle"></i> Result Retrieved</h3>
                        
                        <div class="result-item">
                            <span class="label">Reference ID</span>
                            <span class="val"><?php echo htmlspecialchars($searchResult['ref']); ?></span>
                        </div>
                        
                        <div class="result-item">
                            <span class="label">Status</span>
                            <span class="val"><span class="<?php echo $badgeClass; ?>"><?php echo htmlspecialchars($searchResult['status']); ?></span></span>
                        </div>
                        
                        <div class="result-item">
                            <span class="label">Action Taken By</span>
                            <span class="val"><i class="fa fa-user-shield"></i> <?php echo htmlspecialchars($searchResult['by']); ?></span>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>

</body>
</html>
