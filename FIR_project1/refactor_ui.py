import os
import re

def update_file(filepath, title, subtitle):
    with open(filepath, 'r', encoding='utf-8') as f:
        content = f.read()

    # Extract body content (everything after <nav>...</nav> and before <section class="footer">)
    # The start is different. Let's find '</nav>'
    nav_end = content.find('</nav>')
    if nav_end == -1:
        print(f"Error: </nav> not found in {filepath}")
        return

    # Find where the old footer starts
    footer_start = content.find('<section class="footer">')
    if footer_start == -1:
        footer_start = content.find('<footer class="footer">')
        if footer_start == -1:
            print(f"Error: Footer section not found in {filepath}")
            return

    # Extract the middle part
    middle_content = content[nav_end+6:footer_start].strip()

    # Remove any stray <hr>
    middle_content = middle_content.replace('<hr>', '')

    # Specific formatting for tables to look good in dark UI
    middle_content = middle_content.replace('<table class="table">', '<table width="100%" style="color: #fff; border-collapse: collapse; margin-top: 1rem;">')
    middle_content = middle_content.replace('<table id="Contact_table">', '<table width="100%" style="color: #fff; border-collapse: collapse; margin-top: 1rem;" border="1">')
    middle_content = middle_content.replace('<table id="Contact_table2">', '<table width="100%" style="color: #fff; border-collapse: collapse; margin-top: 1rem;" border="1">')
    
    # Modern PHP header
    new_head = f'''<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{title} | Gujarat Police</title>
    <!-- website logo -->
    <link rel="icon" href="img\\weblogo1.ico" type="image/icon">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="modern_efir.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap">
    <style>
        .premium-content b {{ color: #60a5fa; }}
        .premium-content p {{ color: #cbd5e1; line-height: 1.6; margin-bottom: 1rem; }}
        .premium-content td, .premium-content th {{ padding: 12px; border: 1px solid rgba(255,255,255,0.1); }}
        .premium-content th {{ background: rgba(255,255,255,0.05); color: #94a3b8; font-weight: 600; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 1px; }}
        .premium-content tr:hover {{ background: rgba(255,255,255,0.02); }}
        .premium-content form.in {{ background: transparent !important; border: none !important; margin: 0 !important; }}
    </style>
</head>

<body>

    <section class="header" style="min-height: auto;">
        <nav>
            <a href="index.php" class="logo">
                <img src="img/weblogo1.ico" alt="Logo" style="height: 40px;">
            </a>

            <div class="nav-links" id="navLinks">
                <ul>
                    <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                    <li><a href="Form.php"><i class="fa fa-file-alt"></i> Online Form</a></li>
                    <li><a href="Gallery.php"><i class="fa fa-images"></i> Gallery</a></li>
                    <li><a href="Department.php"><i class="fa fa-building"></i> Department</a></li>
                    <li><a href="Absconder.php"><i class="fa fa-user-secret"></i> Absconders</a></li>
                    <li><a href="Contact.php"><i class="fa fa-phone"></i> Contact</a></li>
                </ul>
            </div>

            <div class="auth-section">
                <?php
                if (!isset($_SESSION['login']) || $_SESSION['login'] == false) {{
                    echo '<a href="login.php" class="auth-btn login"><i class="fa fa-key"></i> Login/Register</a>';
                }} else {{
                    echo '<div class="user-profile">
                            <span id="wcmsg">Welcome, ' . htmlspecialchars($_SESSION['userfname']) . '</span>
                            <a href="logout.php" class="auth-btn logout"><i class="fa fa-sign-out-alt"></i> Log Out</a>
                          </div>';
                }}
                ?>
            </div>
        </nav>
    </section>

    <!-- Main Content Area -->
    <section class="form-wrapper">
        <div class="glass-container" style="max-width: 1000px;">
            <div class="form-header">
                <h2>{title}</h2>
                <p>{subtitle}</p>
            </div>

            <div class="form-body premium-content" style="padding: 2rem;">
'''

    new_footer = '''
            </div>
        </div>
    </section>

    <!-- Footer - Modern Style -->
    <footer style="margin-top: 5rem; padding: 4rem 5%; background: rgba(15, 23, 42, 0.9); border-top: 1px solid var(--glass-border); text-align: center;">
        <div style="display: flex; justify-content: center; gap: 3rem; margin-bottom: 2rem; flex-wrap: wrap;">
            <a href="PDF/T_And_C.pdf" style="color: var(--text-muted); text-decoration: none; font-size: 0.9rem;">Terms</a>
            <a href="PDF/F_And_Q.pdf" style="color: var(--text-muted); text-decoration: none; font-size: 0.9rem;">FAQ</a>
            <a href="PDF/P_And_p.pdf" style="color: var(--text-muted); text-decoration: none; font-size: 0.9rem;">Privacy</a>
            <a href="feedback.php" style="color: var(--text-muted); text-decoration: none; font-size: 0.9rem;">Feedback</a>
        </div>
        <p style="color: var(--text-muted); font-size: 0.8rem;">&copy; <?php echo date("Y"); ?> Gujarat Police. Digital India Initiative.</p>
    </footer>

</body>
</html>
'''

    full_new_content = new_head + middle_content + new_footer
    with open(filepath, 'w', encoding='utf-8') as f:
        f.write(full_new_content)
    print(f"Successfully updated {filepath}")

base_dir = r"C:\\Users\\Asus\\Desktop\\e-fir\\FIR_project1"
update_file(os.path.join(base_dir, "department.php"), "Department Info", "Detailed information about the Home Department structure and officers")
update_file(os.path.join(base_dir, "contact.php"), "Contact Directory", "Emergency Helplines and District Wise Contact Information")
