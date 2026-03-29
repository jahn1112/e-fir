<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guideline</title>
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

    <div class="main-form-container" style="min-height: 50vh; display: flex; flex-direction: column; justify-content: center; align-items: center;">
        <div class="page-header">
            <h1>User Guidelines</h1>
            <p>Helpful resources for using the E-FIR Portal</p>
        </div>

        <div class="glass-container" style="max-width: 600px; text-align: center; padding: 3rem;">
            <i class="fas fa-file-pdf" style="font-size: 4rem; color: var(--accent); margin-bottom: 2rem;"></i>
            <h3 style="color: var(--text-white); margin-bottom: 1.5rem;">Citizen User Manual</h3>
            <p style="color: var(--text-muted); margin-bottom: 2rem;">Download our comprehensive guide to understand how to file FIRs, applications, and track your cases online.</p>
            <a href="PDF/UserGuideline_En.pdf" target="_blank" class="btn-submit" style="display: inline-flex; align-items: center; gap: 10px; text-decoration: none;">
                <i class="fas fa-download"></i> Download User Guideline (PDF)
            </a>
        </div>
    </div>

    <?php include "common/_footer.php"; ?>
</body>
</body>

</html>