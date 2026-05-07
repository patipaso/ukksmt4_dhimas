<?php
@session_start();
require_once "../inc/function.php";

/* kita akan cek apakah sudah login apa belum, jika sudah dia levelnya apa, maka harus kita arahkan sesuai levelnya
Jika dia level admin ===> admin/index.php
Jika dia level petugas ===> petugas/index.php
Jika dia level penyewa ===> penyewa/index.php
*/

if (@$_SESSION['email']) {
    if (@$_SESSION['level'] == "Admin") {
        header("Location: ../admin/index.php");
    } else {
        if (@$_SESSION['level'] == "Penyewa") {
            header("Location: ../penyewa/index.php");
        } elseif (@$_SESSION['level'] == "Owner") {
            header("Location: ../owner/index.php");
        } elseif (@$_SESSION['level'] == "Karyawan") {
            header("Location: ../karyawan/index.php");
        }
    }
} else {
    header("Location: ../inc/login.php");
}

// Ambil data User
$email = $_SESSION['email'];
// echo $email;

$sql_login = tampil("SELECT `tbl_admin`.`nama_admin`, `tbl_users`.`email`, `tbl_tipe_user`.`tipe_user` FROM `tbl_admin` 
LEFT JOIN `tbl_users` ON `tbl_admin`.`id_user` = `tbl_users`.`id_user`
LEFT JOIN `tbl_tipe_user` ON `tbl_users`.`role` = `tbl_tipe_user`.`id_tipe_user` WHERE tbl_users.email='$email'");

// var_dump($sql_login);

foreach ($sql_login as $user_login) {
    $nama_user = $user_login['nama_admin'];
    $tipe_user = $user_login['tipe_user'];
}
?>
<!DOCTYPE html>
<html lang="en">

    
<!-- Mirrored from zoyothemes.com/hando/html/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 16 Apr 2026 07:23:07 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>

        <meta charset="utf-8" />
        <title>Dashboard | Hando - Responsive Admin Dashboard Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc."/>
        <meta name="author" content="Zoyothemes"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="../assets/images/favicon.ico">

        <!-- App css -->
        <link href="../assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />

        <!-- Icons -->
        <link href="../assets/css/icons.min.css" rel="stylesheet" type="text/css" />

        <script src="../assets/js/head.js"></script>


    </head>

    <!-- body start -->
    <body data-menu-color="light" data-sidebar="default">

        <!-- Begin page -->
        <div id="app-layout">
            
            <!-- Topbar Start -->
            <div class="topbar-custom">
                <div class="container-fluid">
                    <div class="d-flex justify-content-between">
                        <ul class="list-unstyled topnav-menu mb-0 d-flex align-items-center">
                            <li>
                                <button class="button-toggle-menu nav-link">
                                    <i data-feather="menu" class="noti-icon"></i>
                                </button>
                            </li>
                            <li class="d-none d-lg-block">
                                <h5 class="mb-0">Good Morning, Alex</h5>
                            </li>
                        </ul>

                        <ul class="list-unstyled topnav-menu mb-0 d-flex align-items-center">
                            <li class="d-none d-lg-block">
                                <form class="app-search d-none d-md-block me-auto">
                                    <div class="position-relative topbar-search">
                                        <input type="text" class="form-control ps-4" placeholder="Search..." />
                                        <i class="mdi mdi-magnify fs-16 position-absolute text-muted top-50 translate-middle-y ms-2"></i>
                                    </div>
                                </form>
                            </li>

                            <!-- Button Trigger Customizer Offcanvas -->
                            <li class="d-none d-sm-flex">
                                <button type="button" class="btn nav-link" data-toggle="fullscreen">
                                    <i data-feather="maximize" class="align-middle fullscreen noti-icon"></i>
                                </button>
                            </li>

                            <!-- Light/Dark Mode Button Themes -->
                            <li class="d-none d-sm-flex">
                                <button type="button" class="btn nav-link" id="light-dark-mode">
                                    <i data-feather="moon" class="align-middle dark-mode"></i>
                                    <i data-feather="sun" class="align-middle light-mode"></i>
                                </button>
                            </li>

                            <li class="dropdown notification-list topbar-dropdown">
                                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <i data-feather="bell" class="noti-icon"></i>
                                    <span class="badge bg-danger rounded-circle noti-icon-badge">9</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-lg">
                                    <!-- item-->
                                    <div class="dropdown-item noti-title">
                                        <h5 class="m-0">
                                            <span class="float-end"><a href="#" class="text-dark"><small>Clear All</small></a></span>Notification
                                        </h5>
                                    </div>

                                    <div class="noti-scroll" data-simplebar>
                                        <!-- item-->
                                        <a href="javascript:void(0);"
                                            class="dropdown-item notify-item text-muted link-primary active">
                                            <div class="notify-icon">
                                                <img src="../assets/images/users/user-12.jpg" class="img-fluid rounded-circle" alt="" />
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <p class="notify-details">Carl Steadham</p>
                                                <small class="text-muted">5 min ago</small>
                                            </div>
                                            <p class="mb-0 user-msg">
                                                <small class="fs-14">Completed <span class="text-reset">Improve workflow in Figma</span></small>
                                            </p>
                                        </a>

                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item notify-item text-muted link-primary">
                                            <div class="notify-icon">
                                                <img src="../assets/images/users/user-2.jpg" class="img-fluid rounded-circle" alt="" />
                                            </div>
                                            <div class="notify-content">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <p class="notify-details">Olivia McGuire</p>
                                                    <small class="text-muted">1 min ago</small>
                                                </div>

                                                <div class="d-flex mt-2 align-items-center">
                                                    <div class="notify-sub-icon">
                                                        <i class="mdi mdi-download-box text-dark"></i>
                                                    </div>

                                                    <div>
                                                        <p class="notify-details mb-0">dark-themes.zip</p>
                                                        <small class="text-muted">2.4 MB</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>

                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item notify-item text-muted link-primary">
                                            <div class="notify-icon">
                                                <img src="../assets/images/users/user-3.jpg" class="img-fluid rounded-circle" alt="" />
                                            </div>
                                            <div class="notify-content">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <p class="notify-details">Travis Williams</p>
                                                    <small class="text-muted">7 min ago</small>
                                                </div>
                                                <p class="noti-mentioned p-2 rounded-2 mb-0 mt-2">
                                                    <span class="text-primary">@Patryk</span> Please make sure that you're....
                                                </p>
                                            </div>
                                        </a>

                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item notify-item text-muted link-primary">
                                            <div class="notify-icon">
                                                <img src="../assets/images/users/user-8.jpg" class="img-fluid rounded-circle" alt="" />
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <p class="notify-details">Violette Lasky</p>
                                                <small class="text-muted">5 min ago</small>
                                            </div>
                                            <p class="mb-0 user-msg">
                                                <small class="fs-14">Completed <span class="text-reset">Create new components</span></small>
                                            </p>
                                        </a>

                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item notify-item text-muted link-primary">
                                            <div class="notify-icon">
                                                <img src="../assets/images/users/user-5.jpg" class="img-fluid rounded-circle" alt="" />
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <p class="notify-details">Ralph Edwards</p>
                                                <small class="text-muted">5 min ago</small>
                                            </div>
                                            <p class="mb-0 user-msg">
                                                <small class="fs-14">Completed<span class="text-reset">Improve workflow in React</span></small>
                                            </p>
                                        </a>

                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item notify-item text-muted link-primary">
                                            <div class="notify-icon">
                                                <img src="../assets/images/users/user-6.jpg" class="img-fluid rounded-circle" alt="" />
                                            </div>
                                            <div class="notify-content">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <p class="notify-details">Jocab jones</p>
                                                    <small class="text-muted">7 min ago</small>
                                                </div>
                                                <p class="noti-mentioned p-2 rounded-2 mb-0 mt-2">
                                                    <span class="text-reset">@Patryk</span> Please make sure that you're....
                                                </p>
                                            </div>
                                        </a>
                                    </div>

                                    <!-- All-->
                                    <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all">View all
                                        <i class="fe-arrow-right"></i>
                                    </a>
                                </div>
                            </li>

                            <!-- User Dropdown -->
                            <li class="dropdown notification-list topbar-dropdown">
                                <a class="nav-link dropdown-toggle nav-user me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <img src="../assets/images/users/user-13.jpg" alt="user-image" class="rounded-circle" />
                                    <span class="pro-user-name ms-1">Alex <i class="mdi mdi-chevron-down"></i></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end profile-dropdown">
                                    <!-- item-->
                                    <div class="dropdown-header noti-title">
                                        <h6 class="text-overflow m-0">Welcome !</h6>
                                    </div>

                                    <!-- item-->
                                    <a class='dropdown-item notify-item' href='pages-profile.html'>
                                        <i class="mdi mdi-account-circle-outline fs-16 align-middle"></i>
                                        <span>My Account</span>
                                    </a>

                                    <!-- item-->
                                    <a class='dropdown-item notify-item' href='auth-lock-screen.html'>
                                        <i class="mdi mdi-lock-outline fs-16 align-middle"></i>
                                        <span>Lock Screen</span>
                                    </a>

                                    <div class="dropdown-divider"></div>

                                    <!-- item-->
                                    <a class='dropdown-item notify-item' href='auth-logout.html'>
                                        <i class="mdi mdi-location-exit fs-16 align-middle"></i>
                                        <a href="../inc/logout.php">log out</a>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- end Topbar -->

            <!-- Left Sidebar Start -->
            <div class="app-sidebar-menu">
                <div class="h-100" data-simplebar>

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">

                        <div class="logo-box">
                            <a class='logo logo-light' href='index.html'>
                                <span class="logo-sm">
                                    <img src="../assets/images/logo-sm.png" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="../assets/images/logo-light.png" alt="" height="24">
                                </span>
                            </a>
                            <a class='logo logo-dark' href='index.html'>
                                <span class="logo-sm">
                                    <img src="../assets/images/logo-sm.png" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="../assets/images/logo-dark.png" alt="" height="24">
                                </span>
                            </a>
                        </div>

                        <ul id="side-menu">

                            <li class="menu-title">Menu</li>

                            <li>
                                <a class='tp-link' href='apps-todolist.html'>
                                    <i data-feather="columns"></i>
                                    <span> dashboard </span>
                                </a>
                            </li>

                            <li class="menu-title">Pages</li>
                            <li>
                                <a href="#sidebarMaster" data-bs-toggle="collapse">
                                    <i data-feather="alert-octagon"></i>
                                    <span>master data</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarMaster">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a class='tp-link' href='error-404.html'>- Lantai</a>
                                        </li>
                                        <li>
                                            <a class='tp-link' href='error-500.html'>- Fasilitas Kamar</a>
                                        </li>
                                        <li>
                                            <a class='tp-link' href='error-503.html'>- Type Unit</a>
                                        </li>
                                        <li>
                                            <a class='tp-link' href='error-429.html'>- Pegawai</a>
                                        </li>
                                        <li>
                                            <a class='tp-link' href='offline-page.html'>- Costumer</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a href="#sidebarError" data-bs-toggle="collapse">
                                    <i data-feather="alert-octagon"></i>
                                    <span>transaksi</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarError">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a class='tp-link' href='error-404.html'>Error 404</a>
                                        </li>
                                        <li>
                                            <a class='tp-link' href='error-500.html'>Error 500</a>
                                        </li>
                                        <li>
                                            <a class='tp-link' href='error-503.html'>Error 503</a>
                                        </li>
                                        <li>
                                            <a class='tp-link' href='error-429.html'>Error 429</a>
                                        </li>
                                        <li>
                                            <a class='tp-link' href='offline-page.html'>Offline Page</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li>
                                <a href="#sidebarExpages" data-bs-toggle="collapse">
                                    <i data-feather="file-text"></i>
                                    <span> Laporan </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarExpages">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a class='tp-link' href='pages-starter.html'>Starter</a>
                                        </li>
                                        <li>
                                            <a class='tp-link' href='pages-profile.html'>Profile</a>
                                        </li>
                                        <li>
                                            <a class='tp-link' href='pages-pricing.html'>Pricing</a>
                                        </li>
                                        <li>
                                            <a class='tp-link' href='pages-timeline.html'>Timeline</a>
                                        </li>
                                        <li>
                                            <a class='tp-link' href='pages-invoice.html'>Invoice</a>
                                        </li>
                                        <li>
                                            <a class='tp-link' href='pages-faqs.html'>FAQs</a>
                                        </li>
                                        <li>
                                            <a class='tp-link' href='pages-gallery.html'>Gallery</a>
                                        </li>
                                        <li>
                                            <a class='tp-link' href='pages-maintenance.html'>Maintenance</a>
                                        </li>
                                        <li>
                                            <a class='tp-link' href='pages-coming-soon.html'>Coming Soon</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a href="#sidebarTables" data-bs-toggle="collapse">
                                    <i data-feather="table"></i>
                                    <span> Tables </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarTables">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a class='tp-link' href='tables-basic.html'>Basic Tables</a>
                                        </li>
                                        <li>
                                            <a class='tp-link' href='tables-datatables.html'>Data Tables</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a href="#sidebarAuth" data-bs-toggle="collapse">
                                    <i data-feather="users"></i>
                                    <span> setting </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarAuth">
                                    <ul class="nav-second-level">
                                        <li>
                                        <a href="#sidebarcihuy" data-bs-toggle="collapse">
                                            <span> pengguna </span>
                                            <span class="menu-arrow"></span>
                                            </a>
                                        <div class="collapse" id="sidebarcihuy">
                                            <ul>
                                                <li>
                                                    <a class='tp-link' href='?pages=pengguna_admin'>-Admin</a>
                                                </li>
                                                <li>
                                                    <a class='tp-link' href='?pages=pengguna_kasir'>-kasir</a>
                                                </li>
                                                <li>
                                                    <a class='tp-link' href='?pages=pengguna_dokter'>-dokter</a>
                                                </li>
                                                <li>
                                                    <a class='tp-link' href='?pages=pengguna_admin'>-Owner</a>
                                                </li>

                                            </ul>
                                        </li>
                                        <li>
                                        <a href="#sidebarconfi" data-bs-toggle="collapse">
                                            <span>konfigurasi</span>
                                            <span class="menu-arrow"></span>
                                            </a>
                                        <div class="collapse" id="sidebarconfi">
                                            <ul>
                                                <li>
                                                    <a class='tp-link' href='auth-login.html'>Log In</a> 
                                                </li>
                                                <li>
                                                    <a class='tp-link' href='auth-login.html'>Log In</a>
                                                </li>
                                                <li>
                                                    <a class='tp-link' href='auth-login.html'>Log In</a>
                                                </li>
                                                <li>
                                                    <a class='tp-link' href='auth-login.html'>Log In</a>
                                                </li>
                                                <li>
                                                    <a class='tp-link' href='auth-login.html'>Log In</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a class='tp-link' href='auth-logout.html'>Logout</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                        </ul>
            
                    </div>
                    <!-- End Sidebar -->

                    <div class="clearfix"></div>

                </div>
            </div>
       
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div> <!-- container-fluid -->
                </div> <!-- content -->
            <?php
            include "../inc/menu.php"
            ?>
                <!-- Footer Start -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            uaaoaoao
                        </div>
                    </div>
                </footer>
                <!-- end Footer -->

            </div>
            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->

        </div>
        <!-- END wrapper -->

        <!-- Vendor -->
        <script src="../assets/libs/jquery/jquery.min.js"></script>
        <script src="../assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../assets/libs/simplebar/simplebar.min.js"></script>
        <script src="../assets/libs/node-waves/waves.min.js"></script>
        <script src="../assets/libs/waypoints/lib/jquery.waypoints.min.js"></script>
        <script src="../assets/libs/jquery.counterup/jquery.counterup.min.js"></script>
        <script src="../assets/libs/feather-icons/feather.min.js"></script>

        <!-- Apexcharts JS -->
        <script src="../assets/libs/apexcharts/apexcharts.min.js"></script>

        <!-- Widgets Init Js -->
        <script src="../assets/js/pages/crm-dashboard.init.js"></script>

        <!-- App js-->
        <script src="../assets/js/app.js"></script>

    </body>


<!-- Mirrored from zoyothemes.com/hando/html/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 16 Apr 2026 07:23:12 GMT -->
</html>