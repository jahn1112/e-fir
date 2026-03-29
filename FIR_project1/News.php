<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News</title>
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

    <div class="main-form-container" style="min-height: 50vh;">
        <div class="page-header">
            <h1>Latest Notices & News</h1>
            <p>Stay updated with official announcements from Gujarat Police</p>
        </div>

        <div class="glass-container" style="text-align: center; padding: 4rem 2rem;">
            <div style="background: rgba(14, 165, 233, 0.1); width: 80px; height: 80px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 2rem;">
                <i class="fas fa-bell-slash" style="font-size: 2rem; color: var(--accent);"></i>
            </div>
            <h2 style="color: var(--text-white); margin-bottom: 1rem;">No New Notices</h2>
            <p style="color: var(--text-muted); max-width: 500px; margin: 0 auto;">There are currently no new official notices or news items to display. Please check back later for updates.</p>
        </div>
    </div>

    <?php include "common/_footer.php"; ?>
</body>

   

   
</body>

</html>