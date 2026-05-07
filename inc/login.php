<?php
@session_start();
require_once "function.php";

    // cek session apakah sudah ada/sudah login
    if (@$_SESSION['email']) {
        if(@$_SESSION['role'] == "Admin") {
            header("location: ../admin/index.php");
        } elseif (@$_SESSION['role'] == "Petugas") {
            header("location: ../petugas/index.php");
        } elseif (@$_SESSION['role'] == "Dokter"){
            header("location: ../dokter/index.php");
        } elseif (@$_SESSION['role'] == "Pasien"){
            header("location: ../pasien/index.php");
        }
    } 


//cek login

// 1. Jika tombol login ditekan, maka akan mengirim variabel yang ada pada form login yaitu username (email) dan password
if (isset($_POST['login'])) {
    $email = strtolower(stripslashes($_POST['email'])); // kita buat huruf kecil semua dan hilangkan backslash
    $userpass = $_POST['password']; // kita ambil password yang diinputkan oleh user

    // 2. Lalu kita query ke database untuk mencari email yang sama dengan email yang diinputkan oleh user
    $sql = mysqli_query($koneksi, "SELECT password, role FROM tbl_users WHERE email = '$email'");
    
    // 3. Kita ambil data password dan role hasil query yang ada kita simpan ke dalam variabel $pawd dan $role
    list($pawd, $role) = mysqli_fetch_array($sql);
    
    // 4. Kita cari role yang ada di tbl_user itu di tabel tbl_tipe_user sebagai apa
    $type_user = "SELECT * FROM tbl_tipe_user WHERE id_tipe_user = '$role'";
    $query = mysqli_query($koneksi, $type_user);
    $row = mysqli_fetch_assoc($query);
    $level = $row['tipe_user'];
    
    // 5. Jika data ditemukan dalam database, maka kita akan melakukan pengecekan apakah password yang diinputkan oleh user sama dengan password yang ada di database (tapi ingat password yang di database itu dalam bentuk hash, jadi kita gunakan fungsi password_verify untuk mengecek apakah password yang diinputkan sama dengan password yang di database)
    if (mysqli_num_rows($sql) > 0) {
        if (password_verify($userpass, $pawd)) {
            $_SESSION['email'] = $email; // kita buat session email untuk menyimpan email yang login
            $_SESSION['role'] = $level; // kita buat session role untuk menyimpan role yang login

            // 6. Jika password benar, maka kita akan cek role yang login itu apa, jika role yang login itu admin, maka kita akan arahkan ke halaman admin
            if ($level == "Admin") {
                header("Location: ../admin/index.php");
            } elseif ($level == "Petugas") {
                header("Location: ../petugas/index.php");
            } elseif ($level == "Dokter") {
                header("Location: ../dokter/index.php");
            } elseif ($level == "Pasien") {
                header("Location: ../pasien/index.php");
            }
            die();
        } else {
            echo "<script>
            alert('LOGIN Gagal : Password yang Anda masukkan salah!');
            document.location.href = 'login.php';
            </script>";
            exit();
        }
    } else {
        echo "<script>
        alert('LOGIN Gagal : Email Anda tidak ditemukan!');
        document.location.href = 'login.php';
        </script>";
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    
<!-- Mirrored from zoyothemes.com/hando/html/auth-login by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 16 Apr 2026 07:23:24 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>

        <meta charset="utf-8"/>
        <title>Log In | Hando - Responsive Admin Dashboard Template</title>
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

    <body>
        <!-- Begin page -->
        <div class="account-page">
            <div class="container-fluid p-0">
                <div class="row align-items-center g-0 px-3 py-3 vh-100">

                    <div class="col-xl-5">
                        <div class="row">
                            <div class="col-md-8 mx-auto">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="mb-0 p-0 p-lg-3">
                                            <div class="mb-0 border-0 p-md-4 p-lg-0">
                                                <div class="mb-4 p-0 text-lg-start text-center">
                                                    <div class="auth-brand">
                                                        <a class='logo logo-light' href='index.html'>
                                                            <span class="logo-lg">
                                                                <img src="../assets/images/logo-light-3.png" alt="" height="24">
                                                            </span>
                                                        </a>
                                                        <a class='logo logo-dark' href='index.html'>
                                                            <span class="logo-lg">
                                                                <img src="../assets/images/logo-dark-3.png" alt="" height="24">
                                                            </span>
                                                        </a>
                                                    </div>
                                                </div>
        
                                               
                                                <div class="pt-0">
                                                    <form method="POST" class="my-4">
                                                        <div class="form-group mb-3">
                                                            <label for="emailaddress" class="form-label">Email address</label>
                                                            <input name="email" class="form-control" type="email" id="emailaddress" required="" placeholder="Enter your email">
                                                        </div>
                            
                                                        <div class="form-group mb-3">
                                                            <label for="password" class="form-label">Password</label>
                                                            <input name="password" class="form-control" type="password" required="" id="password" placeholder="Enter your password">
                                                        </div>
                            
                                                        <div class="form-group d-flex mb-3">
                                                            <div class="col-sm-6">
                                                                <div class="form-check">
                                                                    <input type="checkbox" class="form-check-input" id="checkbox-signin" checked>
                                                                    <label class="form-check-label" for="checkbox-signin">Remember me</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 text-end">
                                                                <a class='text-muted fs-14' href='auth-recoverpw.html'>Forgot password?</a>                             
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="form-group mb-0 row">
                                                            <div class="col-12">
                                                                <div class="d-grid">
                                                                    <button name="login" class="btn btn-primary fw-semibold" type="submit"> Log In </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                
                                                    <div class="text-center text-muted">
                                                        <p class="mb-0">Don't have an account ?<a class='text-primary ms-2 fw-medium' href='register.php'>Sing up</a></p>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xl-7 d-none d-xl-inline-block">
                        <div class="account-page-bg rounded-4">
                            <div class="auth-user-review text-center">
                                <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                                    <div class="carousel-inner">

                                        <div class="carousel-item active">
                                            <p class="prelead mb-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24"><path fill="#ffffff" d="M4.583 17.321C3.553 16.227 3 15 3 13.011c0-3.5 2.457-6.637 6.03-8.188l.893 1.378c-3.335 1.804-3.987 4.145-4.247 5.621c.537-.278 1.24-.375 1.929-.311c1.804.167 3.226 1.648 3.226 3.489a3.5 3.5 0 0 1-3.5 3.5a3.87 3.87 0 0 1-2.748-1.179m10 0C13.553 16.227 13 15 13 13.011c0-3.5 2.457-6.637 6.03-8.188l.893 1.378c-3.335 1.804-3.987 4.145-4.247 5.621c.537-.278 1.24-.375 1.929-.311c1.804.167 3.226 1.648 3.226 3.489a3.5 3.5 0 0 1-3.5 3.5a3.87 3.87 0 0 1-2.748-1.179"/></svg> 
                                                    With Untitled, your support process can be as enjoyable as your product. With it's this easy, customers keep coming back.
                                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24"><path fill="#ffffff" d="M19.417 6.679C20.447 7.773 21 9 21 10.989c0 3.5-2.456 6.637-6.03 8.188l-.893-1.378c3.335-1.804 3.987-4.145 4.248-5.621c-.537.278-1.24.375-1.93.311c-1.804-.167-3.226-1.648-3.226-3.489a3.5 3.5 0 0 1 3.5-3.5c1.073 0 2.1.49 2.748 1.179m-10 0C10.447 7.773 11 9 11 10.989c0 3.5-2.456 6.637-6.03 8.188l-.893-1.378c3.335-1.804 3.987-4.145 4.247-5.621c-.537.278-1.24.375-1.929.311C4.591 12.323 3.17 10.842 3.17 9a3.5 3.5 0 0 1 3.5-3.5c1.073 0 2.1.49 2.748 1.179"/></svg>
                                            </p>
                                            <h4 class="mb-1">Camilla Johnson</h4>
                                            <p class="mb-0">Software Developer</p>
                                        </div>

                                        <div class="carousel-item">
                                            <p class="prelead mb-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24"><path fill="#ffffff" d="M4.583 17.321C3.553 16.227 3 15 3 13.011c0-3.5 2.457-6.637 6.03-8.188l.893 1.378c-3.335 1.804-3.987 4.145-4.247 5.621c.537-.278 1.24-.375 1.929-.311c1.804.167 3.226 1.648 3.226 3.489a3.5 3.5 0 0 1-3.5 3.5a3.87 3.87 0 0 1-2.748-1.179m10 0C13.553 16.227 13 15 13 13.011c0-3.5 2.457-6.637 6.03-8.188l.893 1.378c-3.335 1.804-3.987 4.145-4.247 5.621c.537-.278 1.24-.375 1.929-.311c1.804.167 3.226 1.648 3.226 3.489a3.5 3.5 0 0 1-3.5 3.5a3.87 3.87 0 0 1-2.748-1.179"/></svg> 
                                                    Pretty nice theme, hoping you guys could add more features to this. Keep up the good work.
                                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24"><path fill="#ffffff" d="M19.417 6.679C20.447 7.773 21 9 21 10.989c0 3.5-2.456 6.637-6.03 8.188l-.893-1.378c3.335-1.804 3.987-4.145 4.248-5.621c-.537.278-1.24.375-1.93.311c-1.804-.167-3.226-1.648-3.226-3.489a3.5 3.5 0 0 1 3.5-3.5c1.073 0 2.1.49 2.748 1.179m-10 0C10.447 7.773 11 9 11 10.989c0 3.5-2.456 6.637-6.03 8.188l-.893-1.378c3.335-1.804 3.987-4.145 4.247-5.621c-.537.278-1.24.375-1.929.311C4.591 12.323 3.17 10.842 3.17 9a3.5 3.5 0 0 1 3.5-3.5c1.073 0 2.1.49 2.748 1.179"/></svg>
                                            </p>
                                            <h4 class="mb-1">Palak Awoo</h4>
                                            <p class="mb-0">Lead Designer</p>
                                        </div>

                                        <div class="carousel-item">
                                            <p class="prelead mb-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24"><path fill="#ffffff" d="M4.583 17.321C3.553 16.227 3 15 3 13.011c0-3.5 2.457-6.637 6.03-8.188l.893 1.378c-3.335 1.804-3.987 4.145-4.247 5.621c.537-.278 1.24-.375 1.929-.311c1.804.167 3.226 1.648 3.226 3.489a3.5 3.5 0 0 1-3.5 3.5a3.87 3.87 0 0 1-2.748-1.179m10 0C13.553 16.227 13 15 13 13.011c0-3.5 2.457-6.637 6.03-8.188l.893 1.378c-3.335 1.804-3.987 4.145-4.247 5.621c.537-.278 1.24-.375 1.929-.311c1.804.167 3.226 1.648 3.226 3.489a3.5 3.5 0 0 1-3.5 3.5a3.87 3.87 0 0 1-2.748-1.179"/></svg> 
                                                    This is a great product, helped us a lot and very quick to work with and implement. 
                                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24"><path fill="#ffffff" d="M19.417 6.679C20.447 7.773 21 9 21 10.989c0 3.5-2.456 6.637-6.03 8.188l-.893-1.378c3.335-1.804 3.987-4.145 4.248-5.621c-.537.278-1.24.375-1.93.311c-1.804-.167-3.226-1.648-3.226-3.489a3.5 3.5 0 0 1 3.5-3.5c1.073 0 2.1.49 2.748 1.179m-10 0C10.447 7.773 11 9 11 10.989c0 3.5-2.456 6.637-6.03 8.188l-.893-1.378c3.335-1.804 3.987-4.145 4.247-5.621c-.537.278-1.24.375-1.929.311C4.591 12.323 3.17 10.842 3.17 9a3.5 3.5 0 0 1 3.5-3.5c1.073 0 2.1.49 2.748 1.179"/></svg>
                                            </p>
                                            <h4 class="mb-1">Laurent Smith</h4>
                                            <p class="mb-0">Product designer</p>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
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

        <!-- App js-->
        <script src="../assets/js/app.js"></script>
        
    </body>

<!-- Mirrored from zoyothemes.com/hando/html/auth-login by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 16 Apr 2026 07:23:24 GMT -->
</html>