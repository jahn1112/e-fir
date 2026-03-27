<!-- import registraion model -->
<?php
include "modals/logout_model.php";



?>
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block <?php if ($_SESSION["curr_page"] == "home") {
    echo 'active ';
}?>">
            <a href="index.php" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block <?php if ($_SESSION["curr_page"] == "Contact") {
    echo 'active ';
}?> ">
            <a href="contact.php" class="nav-link">Contact</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
                <form class="form-inline">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>
        
        <!-- Logout Link -->
        <li class="nav-item">
            <a class="nav-link" href="#" data-toggle="modal" data-target="#regModal" role="button" title="Logout">
                <i class="fas fa-sign-out-alt"></i>
                <span class="d-none d-md-inline ml-1">Logout</span>
            </a>
        </li>

        <!-- full screen button -->
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
    </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary elevation-3">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link m-0 pl-0">
        <img src="https://gumlet.assettype.com/afaqs%2F2020-06%2F58a77941-cd90-4789-87ac-47e9cb25cb24%2FSTP_logo.png?format=webp&w=400&dpr=2.6"
            alt="LOGO" data-bs-toggle="tooltip" title="GUJARAT POLICE" style="opacity: .9" height="50" width="70">
        <span class="brand-text font-weight-bold">Admin Portal</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3  d-flex">
            <div class="image">
                <img src="img/user.png" class="img-circle elevation-3" alt="User">
            </div>
            <div class="info">
                <a href="#" class="d-block font-weight-black ml-2 text-bold" ><?php echo $_SESSION['cat']; ?></a>
            </div>
        </div>

 <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-item mb-2" style="background-color:rgba(5, 28, 160, 0.836); border-radius: 5px;">
                    <a  class="nav-link" >
                        <i class="fa fa-bars fa-5x nav-icon text-white" aria-hidden="true"></i>
                        <p style="font-size: 23px; " class="text-white"><u>Services</u></p>
                    </a>
                </li>
                
                <?php
if ($_SESSION['cat'] == "Police Station Officer" || $_SESSION['cat'] == "Investigation Officer") {
    echo '
                <li class="nav-item">
                    <a href="#" class="nav-link" >
                        <i class="fa fa-file-text fa-lg nav-icon" aria-hidden="true"></i>
                        <p>Manage FIR</p>
                    </a>
                    <ul class="nav nav-treeview">
             ';
    if ($_SESSION['cat'] == "Investigation Officer") {
        echo '  <li class="nav-item ml-2">
               <a href="./manage_FIR_list.php?typ=P" class="nav-link ">
                 <i class="far fa-circle nav-icon"></i>
                 <p>Pending FIR</p>
               </a>
             </li>';
    }
    else {
        echo '  <li class="nav-item ml-2">
                <a href="./manage_FIR.php?typ=P" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pending FIR</p>
                </a>
              </li>';
    }
    if ($_SESSION['cat'] == "Investigation Officer") {
        echo ' <li class="nav-item  ml-2">
                <a href="./manage_FIR.php?typ=A" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Assign FIR</p>
                </a>
              </li>';
    }
    else {
        echo ' <li class="nav-item  ml-2">
                <a href="./manage_FIR_list.php?typ=A" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Assign FIR</p>
                </a>
              </li>';
    }
    echo '
              <li class="nav-item  ml-2">
                <a href="./manage_FIR_list.php?typ=R" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Rejected FIR</p>
                </a>
              </li>
              <li class="nav-item  ml-2">
                <a href="./manage_FIR_list.php?typ=done" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Approved FIR</p>
                </a>
              </li>
            </ul>
                </li>';

    if ($_SESSION['cat'] == "Police Station Officer") {
        echo ' 
                        <li class="nav-item">
                            <a href="e-app.php" class="nav-link" >
                                <i class="fa fa-file-text-o fa-lg nav-icon" aria-hidden="true"></i>
                                <p>e-Application</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="rpt_missing_person.php" class="nav-link" >
                                <i class="fa fa-flag-o fa-lg nav-icon" aria-hidden="true"></i>
                                <p>Report Missing Person</p>
                            </a>
                        </li>
                        
                        
                        <li class="nav-item">
                            <a href="snr_citizen.php" class="nav-link" >
                                <i class="fa fa-user-o fa-lg nav-icon" aria-hidden="true"></i>
                                <p>Senior Citizen</p>
                            </a>
                        </li>';
    } //nested if end
} //navbar if end
?>
                
                <li class="nav-item">
                    <a href="#" class="nav-link" data-toggle="modal" data-target="#regModal">
                        <i class="fa fa-sign-out nav-icon" aria-hidden="true"></i>
                        <p>Log Out</p>
                    </a>
                </li>
            </ul>

        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>

