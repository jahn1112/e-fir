<?php
session_start();
include "DBconfig.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Department | Gujarat Police</title>
    <link rel="icon" href="img\weblogo1.ico" type="image/icon">
    <link rel="stylesheet" href="modern_efir.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        .dept-container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 20px;
        }
        .official-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 15px;
            margin-bottom: 40px;
        }
        .official-table tr {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border-radius: 12px;
            overflow: hidden;
            transition: transform 0.3s ease;
        }
        .official-table tr:hover {
            transform: translateY(-5px);
            background: rgba(255, 255, 255, 0.1);
        }
        .official-table td {
            padding: 20px;
            color: var(--text-white);
            border-top: 1px solid var(--glass-border);
            border-bottom: 1px solid var(--glass-border);
        }
        .official-table td:first-child { border-left: 1px solid var(--glass-border); border-top-left-radius: 12px; border-bottom-left-radius: 12px; }
        .official-table td:last-child { border-right: 1px solid var(--glass-border); border-top-right-radius: 12px; border-bottom-right-radius: 12px; }
        
        .official-img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--accent-blue);
        }
        
        .info-card {
            background: var(--glass-bg);
            backdrop-filter: var(--glass-blur);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 30px;
            color: var(--text-white);
        }
        .info-card h2 {
            color: var(--accent-blue);
            margin-bottom: 20px;
            border-bottom: 1px solid var(--glass-border);
            padding-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .info-card p, .info-card li {
            font-size: 0.95rem;
            line-height: 1.8;
            color: var(--text-muted);
            margin-bottom: 15px;
        }
        .info-card b { color: var(--text-white); font-weight: 600; display: block; margin-top: 20px; margin-bottom: 10px; }
    </style>
</head>
<body>

    <?php include "common/_navbar.php"; ?>

    <div class="dept-container">
        <div class="page-header" style="margin-bottom: 50px;">
            <h1 style="font-size: 3rem; background: linear-gradient(to right, #fff, #94a3b8); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Know Home Department</h1>
            <p>Government of Gujarat | Internal Security & Administration</p>
        </div>

        <!-- Leadership Section -->
        <table class="official-table">
            <tbody>
                <tr>
                    <td width="150"><img src="img/bhupendra-patel-cm.jpg" class="official-img"></td>
                    <td>
                        <h4 style="color: var(--accent-blue);">Shri Bhupendra Patel</h4>
                        <p style="margin: 0; color: #fff;">Hon'ble Chief Minister, Gujarat State</p>
                    </td>
                    <td><i class="fas fa-phone mr-2"></i> 079-23232611 / 23250073</td>
                </tr>
                <tr>
                    <td><img src="img/Sanghvi-Harsh-Rameshkumar.jpg" class="official-img"></td>
                    <td>
                        <h4 style="color: var(--accent-blue);">Shri Harsh Sanghavi</h4>
                        <p style="margin: 0; color: #fff;">Hon'ble Minister (State), Home Department</p>
                    </td>
                    <td><i class="fas fa-phone mr-2"></i> 079-23250266 / 23250268</td>
                </tr>
                <tr>
                    <td><img src="img/pankaj.jpeg" class="official-img"></td>
                    <td>
                        <h4 style="color: var(--accent-blue);">Shri Pankaj Kumar (IAS)</h4>
                        <p style="margin: 0; color: #fff;">Chief Secretary</p>
                    </td>
                    <td><i class="fas fa-phone mr-2"></i> 079-23250303</td>
                </tr>
                <tr>
                    <td><img src="img/Shri-Ashish-Bhatia.jpg" class="official-img"></td>
                    <td>
                        <h4 style="color: var(--accent-blue);">Shri Ashish Bhatia (IPS)</h4>
                        <p style="margin: 0; color: #fff;">Director General of Police</p>
                    </td>
                    <td><i class="fas fa-phone mr-2"></i> 079-23254201</td>
                </tr>
            </tbody>
        </table>

        <!-- Details Section (Gujarati) -->
        <div class="info-card">
            <h2><i class="fas fa-info-circle"></i> પરિચય (Introduction)</h2>
            <p>ગૃહ વિભાગ, સચિવાલયના વિભાગોમાં મહત્વનો વિભાગ છે. આ વિભાગનો મુખ્ય હેતુ સમગ્ર રાજયમાં કાયદો અને વ્યવસ્થાની અસરકારક જાળવણી અને રાજયની પ્રજાને આંતરિક સલામતી બક્ષવાનો છે.</p>
            
            <b>ગૃહ વિભાગનો ટૂંકો ઈતિહાસ</b>
            <p>મુંબઈ રાજયમાંથી તા.1/5/1960 થી ગુજરાત એક સ્વતંત્ર રાજ્ય તરીકે અસ્તિત્વમાં આવતાં સૌ પ્રથમ ગૃહ, માહિતી પ્રસારણ અને નાગરિક પુરવઠા વિભાગ નામનો અલગ વિભાગ અસ્તિત્વમાં આવ્યો.</p>
            <p>૧૯૯૬ ના વર્ષમાં સામાન્ય વહીવટ વિભાગમાંથી સચિવાલય પ્રવેશ નિયંત્રણ અને પાસપોર્ટની કામગીરી ગૃહ વિભાગને તબદીલ કરવામાં આવી.</p>
        </div>

        <div class="info-card">
            <h2><i class="fas fa-bullseye"></i> લક્ષ્ય/હેતુઓ (Objectives)</h2>
            <b>ધ્યેય</b>
            <p>પોલીસની કામગીરીમાં અસરકારકતા લાવીને ભૂમિ અને દરિયાઇ સીમા સુરક્ષા સઘન કરી રાજયમાં શાંતિ અને સંવાદિતા જાળવવી.</p>
            
            <b>લક્ષ્યાંકો</b>
            <ul style="list-style: none; padding: 0;">
                <li><i class="fas fa-check-circle text-info mr-2"></i> બધાજ પોલીસ સ્ટેશનોનું 100 ટકા કોમ્પ્યુટરાઇઝેશન.</li>
                <li><i class="fas fa-check-circle text-info mr-2"></i> મિલકત વિષયક ગુનાના સંશોધનમાં ૫ ટકાનો વધારો કરવો.</li>
                <li><i class="fas fa-check-circle text-info mr-2"></i> પોલીસ કર્મચારીઓ તથા તેઓના કુટુંબીજનોની ૧૦૦ ટકા આરોગ્ય તપાસણી.</li>
            </ul>
        </div>
    </div>

    <?php include "common/_footer.php"; ?>


</body>
</html>