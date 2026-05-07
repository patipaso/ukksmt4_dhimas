<?php
// Cek apakah form sudah di submit
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['tambahdata'])) {
        $result = tambah_admin($_POST, $_FILES);
    // Jika fungsi mengembalikan true, redirect akan dilakukan di dalam fungsi
    // Jika false, tetap di halaman tambah
    }

// Cek apakah ada error dari session
    if (isset($_SESSION['form_errors']) && !empty($_SESSION['form_errors'])) {
            echo "<div class='alert alert-danger alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                <ul>";
        foreach ($_SESSION['form_errors'] as $error) {
            echo "<li>$error</li>";
        }
        echo "</ul></div>";
            unset($_SESSION['form_errors']);
    }

// Cek apakah ada success message
        if (isset($_SESSION['success'])) {
            echo "<script>
            alert('".$_SESSION['success']."');
            </script>";
            unset($_SESSION['success']);
        }

// Ambil ID User Auto Number
    $sql_tipe_user = "SELECT id_tipe_user FROM tbl_tipe_user WHERE tipe_user='Admin'";
    $hasil = mysqli_query($koneksi, $sql_tipe_user);
    $row = mysqli_fetch_assoc($hasil);
    $id_user = autonumber("tbl_users", "id_user", 7, "ADM");
?>
    <div class="content-page">
        <div class="content">
            <!-- Start Content-->
            <div class="container-fluid">
                <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                    <div class="flex-grow-1">
                        <h4 class="fs-18 fw-semibold m-0">pengguna admin</h4>
                    </div>
    
                    <div class="text-end">
                        <ol class="breadcrumb m-0 py-0">
                            <li class="breadcrumb-item"><a href="#">home</a></li>
                            <li class="breadcrumb-item active" ><a href="index.php?pages=pengguna_admin"></a>pengguna admin</li>
                        </ol>
                    </div>
                </div>

                <!-- General Form -->

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Basic Example</h5>
                            </div><!-- end card header -->
                            <div class="card-body">
                                    <form method="POST" action="" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">ID_admin</label>
                                        <input type="text" name="id_admin" value="<?=$id_user?>" readonly>
                                    </div>
                                        <label for="exampleInputEmail1" class="form-label">nama admin</label>
                                        <input name="nama_admin" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="nama">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">alamat admin</label>
                                        <input name="alamat_admin" type="text" class="form-control" id="exampleInputPassword1" placeholder="alamat">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">no telp</label>
                                        <input name="telepon" type="number" class="form-control" id="exampleInputPassword1" placeholder="nombur telepon">
                                    </div>

                                  <fieldset class="row mb-3">
                                            <legend class="col-form-label col-sm-2 pt-0">jenis kelamin</legend>
                                            <div class="col-sm-10 d-flex gap-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" value="L" type="radio" name="jenis_kelamin" id="gridRadios1" value="L" checked>
                                                    <label class="form-check-label" for="gridRadios1">
                                                        laki laki
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" value="P" type="radio" name="jenis_kelamin" id="gridRadios2" value="P">
                                                    <label class="form-check-label" for="gridRadios2">
                                                        Perempuan
                                                    </label>
                                                </div>
                                            </div>
                                        </fieldset>
                                    
                                     <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">username</label>
                                        <input name="email" type="text" class="form-control" id="exampleInputPassword1" placeholder="email">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Password</label>
                                        <input name="password" type="text" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                    </div>
                                     <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">retype Password</label>
                                        <input name="password2" type="password" class="form-control" id="exampleInputPassword1" placeholder="retype password">
                                    </div>
                                    <input type="text" name="role" value="admin" hidden>
                                    <div class=" mb-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="checkmeout0">
                                            <label class="form-check-label" for="checkmeout0">Check me out !</label>
                                        </div>
                                    </div>
                                    <button type="submit" name="tambahdata" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
                
            </div> <!-- container-fluid -->

        </div> <!-- content -->

        <!-- Footer Start -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col fs-13 text-muted text-center">
                        &copy; <script>document.write(new Date().getFullYear())</script> - Made with <span class="mdi mdi-heart text-danger"></span> by <a href="#!" class="text-reset fw-semibold">Zoyothemes</a> 
                    </div>
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
