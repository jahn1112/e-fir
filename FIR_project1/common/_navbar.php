<?php
// common/_navbar.php - Unified Navigation for Citizen Portal
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<nav>
    <a href="index.php" class="logo">
        <img src="img/police.png" alt="Gujarat Police Logo">
    </a>
    <div class="nav-links">
        <ul>
            <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
            <li><a href="Form.php"><i class="fa fa-file-alt"></i> Online Form</a></li>
            <?php if(isset($_SESSION['login']) && $_SESSION['login'] == true): ?>
                <li><a href="tracking.php"><i class="fa fa-search-location"></i> Tracking FIR</a></li>
            <?php endif; ?>
            <li><a href="Gallery.php"><i class="fa fa-images"></i> Gallery</a></li>
            <li><a href="Department.php"><i class="fa fa-building"></i> Department</a></li>
            <li><a href="Absconder.php"><i class="fa fa-user-secret"></i> Absconders</a></li>
            <li><a href="Contact.php"><i class="fa fa-phone"></i> Contact</a></li>
            <li><a href="Notice.php"><i class="fa fa-book"></i> Notice</a></li>
        </ul>
    </div>
    <div class="nav-right">
         <?php if(isset($_SESSION['login']) && $_SESSION['login'] == true): ?>
            <div class="user-greeting">Welcome, <?php echo $_SESSION['userfname']; ?></div>
            <a href="logout.php" class="login-link logout"><i class="fa fa-sign-out-alt"></i> Logout</a>
         <?php else: ?>
            <div class="login-gateways">
                <a href="login.php" class="login-link"><i class="fa fa-user"></i> Citizen Login</a>
                <a href="../Admin/login.php" class="login-link admin-btn" style="background: #334155;"><i class="fa fa-user-shield"></i> Admin</a>
            </div>
         <?php endif; ?>
    </div>
</nav>
