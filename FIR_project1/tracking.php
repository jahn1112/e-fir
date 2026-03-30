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
    
    // Enhanced numeric ID extraction
    $prefix = ($searchType == "FIR" ? "GJFIR" : "GJEAPP");
    $numericId = $rawInput;
    
    // 1. Strip the alphabetic prefix (e.g., GJFIR or GJEAPP)
    if (stripos($numericId, $prefix) === 0) {
        $numericId = substr($numericId, strlen($prefix));
    }
    
    // 2. Strip the year prefix if it looks like [YEAR][ID] (e.g., 20260001)
    if (strlen($numericId) >= 5) {
        $possibleYear = substr($numericId, 0, 4);
        if (ctype_digit($possibleYear) && intval($possibleYear) >= 2020) {
            $numericId = substr($numericId, 4);
        }
    }
    
    // 3. Clean up to just the numeric ID
    $numericId = preg_replace('/[^0-9]/', '', $numericId);
    $numericId = ltrim($numericId, '0');

    if (empty($numericId)) {
        $alertMessage = "The FIR/application number is wrong";
    } else {
        if ($searchType == "FIR") {
            $qry = "SELECT e_fir_id, user_id, action_taken, action_takenBY, sbmt_date FROM e_fir_master WHERE e_fir_id = '$numericId'";
        } else {
            $qry = "SELECT e_application_id, user_id, action_taken, action_takenBY, sbmt_date FROM e_application_table WHERE e_application_id = '$numericId'";
        }

        $res = mysqli_query($con, $qry);
        if (!$res || mysqli_num_rows($res) == 0) {
            $alertMessage = "The FIR/application number is wrong";
        } else {
            $row = mysqli_fetch_assoc($res);
            if ($row['user_id'] != $_SESSION['userid']) {
                $alertMessage = "The FIR/application is not submitted by you so you cant check status";
                $searchResult = null;
            } else {
                $year = date('Y', strtotime($row['sbmt_date'] ?? 'now'));
                $searchResult = [
                    'type' => $searchType,
                    'ref' => $prefix . $year . sprintf('%04d', $numericId),
                    'status' => empty($row['action_taken']) ? "Pending" : $row['action_taken'],
                    'by' => empty($row['action_takenBY']) ? "Investigation Officer" : $row['action_takenBY']
                ];
            }
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
    <link rel="icon" href="img/weblogo1.ico" type="image/icon">
    <!-- Base Styling -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="modern_index.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700&display=swap">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <style>
        .main-form-container {
            padding: 8rem 2rem 4rem;
            min-height: 100vh;
            background: radial-gradient(circle at top right, rgba(14, 165, 233, 0.1), transparent 50%),
                        radial-gradient(circle at bottom left, rgba(15, 23, 42, 0.1), transparent 50%);
        }

        .tracking-card {
            background: rgba(15, 23, 42, 0.4) !important;
            backdrop-filter: blur(25px);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            padding: 3rem;
            max-width: 650px;
            margin: 0 auto;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            animation: slideUp 0.8s ease-out;
        }

        .search-inner {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .input-group {
            position: relative;
        }

        .input-group i {
            position: absolute;
            left: 1.2rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary);
            font-size: 1.1rem;
            pointer-events: none;
        }

        .input-group select, .input-group input {
            width: 100%;
            padding: 1rem 1rem 1rem 3.2rem;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid var(--glass-border);
            border-radius: 12px;
            color: #fff;
            outline: none;
            transition: all 0.3s ease;
            font-size: 1rem;
        }

        .input-group select:focus, .input-group input:focus {
            border-color: var(--primary);
            background: rgba(255, 255, 255, 0.05);
            box-shadow: 0 0 15px rgba(14, 165, 233, 0.2);
        }

        .input-group select option {
            background: #0f172a;
            color: #fff;
        }

        .btn-tracking {
            background: linear-gradient(135deg, var(--primary) 0%, #0284c7 100%);
            color: #fff;
            border: none;
            padding: 1.2rem;
            border-radius: 12px;
            font-weight: 700;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            box-shadow: 0 10px 20px rgba(14, 165, 233, 0.2);
        }

        .btn-tracking:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(14, 165, 233, 0.4);
            letter-spacing: 0.5px;
        }

        .result-reveal {
            margin-top: 3rem;
            padding-top: 2rem;
            border-top: 1px solid var(--glass-border);
            animation: fadeIn 1s ease forwards;
        }

        .status-hero {
            text-align: center;
            padding: 2rem;
            background: rgba(255,255,255,0.03);
            border-radius: 20px;
            border: 1px solid var(--glass-border);
            margin-bottom: 2rem;
        }

        .status-badge-lg {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 0.8rem 2.5rem;
            border-radius: 50px;
            font-weight: 800;
            text-transform: uppercase;
            font-size: 1rem;
            letter-spacing: 1px;
            margin-bottom: 1rem;
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }

        .status-pending { background: rgba(245, 158, 11, 0.2); color: #fbbf24; border: 1px solid rgba(245, 158, 11, 0.3); }
        .status-approved { background: rgba(16, 185, 129, 0.2); color: #10b981; border: 1px solid rgba(16, 185, 129, 0.3); }
        .status-rejected { background: rgba(239, 68, 68, 0.2); color: #ef4444; border: 1px solid rgba(239, 68, 68, 0.3); }

        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 1.2rem;
            background: rgba(255, 255, 255, 0.02);
            border-radius: 12px;
            margin-bottom: 0.8rem;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .detail-row .lbl { color: var(--text-muted); font-size: 0.95rem; }
        .detail-row .val { color: #fff; font-weight: 600; display: flex; align-items: center; gap: 8px; }

        @keyframes slideUp { from { opacity: 0; transform: translateY(40px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }

        .page-header h1 {
            font-size: 3rem;
            font-weight: 800;
            letter-spacing: -1.5px;
            margin-bottom: 1rem;
            background: linear-gradient(to right, #fff, #94a3b8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
</head>

<body>
    <?php include "common/_navbar.php"; ?>

    <!-- Alert System using SweetAlert2 -->
    <?php if (!empty($alertMessage)) { ?>
        <script>
            Swal.fire({
                icon: '<?php echo (strpos($alertMessage, "Denied") !== false || strpos($alertMessage, "correct") !== false) ? "error" : "warning"; ?>',
                title: 'Search Status',
                text: '<?php echo htmlspecialchars($alertMessage); ?>',
                confirmButtonColor: '#0ea5e9'
            });
        </script>
    <?php } ?>

    <div class="main-form-container">
        <div class="page-header text-center mb-5">
            <h1>Tracking Center</h1>
            <p class="text-muted">Real-time surveillance on your filed FIRs and applications.</p>
        </div>

        <div class="tracking-card">
            <form action="tracking.php" method="POST" class="search-inner">
                <div class="input-group">
                    <i class="fas fa-filter"></i>
                    <select name="search_type" id="search_type" required>
                        <option value="FIR" <?php echo ($searchType == 'FIR' ? 'selected' : ''); ?>>First Information Report (FIR)</option>
                        <option value="APP" <?php echo ($searchType == 'APP' ? 'selected' : ''); ?>>E-Application</option>
                    </select>
                </div>

                <div class="input-group">
                    <i class="fas fa-hashtag"></i>
                    <input type="text" name="ref_no" id="ref_no" 
                           placeholder="Reference Number (e.g., GJFIR2023001)" 
                           autocomplete="off" required
                           value="<?php echo htmlspecialchars($rawInput); ?>">
                </div>

                <button type="submit" name="search_btn" class="btn-tracking">
                    <i class="fas fa-search-location"></i> Verify Real-time Fulfillment
                </button>
            </form>

            <?php if ($searchResult != null) { 
                $badgeClass = "status-pending";
                $statusIcon = "fas fa-clock";
                
                if (strpos(strtolower($searchResult['status']), 'approv') !== false || strpos(strtolower($searchResult['status']), 'done') !== false) {
                    $badgeClass = "status-approved";
                    $statusIcon = "fas fa-check-circle";
                } elseif (strpos(strtolower($searchResult['status']), 'reject') !== false) {
                    $badgeClass = "status-rejected";
                    $statusIcon = "fas fa-times-circle";
                }
            ?>
                <div class="result-reveal">
                    <div class="status-hero">
                        <div class="status-badge-lg <?php echo $badgeClass; ?>">
                            <i class="<?php echo $statusIcon; ?>"></i> <?php echo htmlspecialchars($searchResult['status']); ?>
                        </div>
                        <p class="text-white mb-0" style="opacity: 0.7;">Case #<?php echo htmlspecialchars($searchResult['ref']); ?></p>
                    </div>
                    
                    <div class="detail-row">
                        <span class="lbl"><i class="fas fa-tags mr-2"></i> Record Type</span>
                        <span class="val"><?php echo ($searchResult['type'] == 'FIR' ? 'F.I.R' : 'Application'); ?></span>
                    </div>
                    
                    <div class="detail-row">
                        <span class="lbl"><i class="fas fa-user-shield mr-2"></i> Validated By</span>
                        <span class="val"><?php echo htmlspecialchars($searchResult['by']); ?></span>
                    </div>

                    <div class="text-center mt-4 pt-3">
                        <button onclick="window.print()" class="text-muted bg-transparent border-0" style="cursor:pointer; font-size: 0.9rem;">
                            <i class="fas fa-print mr-1"></i> Generate Hard Copy
                        </button>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <?php include "common/_footer.php"; ?>
</body>
</html>
