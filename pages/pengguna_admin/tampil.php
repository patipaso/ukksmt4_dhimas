 <div class="content-page">
        <div class="content">

            <!-- Start Content-->
            <div class="container-fluid">

                <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                    <div class="flex-grow-1">
                        <h4 class="fs-18 fw-semibold m-0">Data Tables</h4>
                    </div>
    
                    <div class="text-end">
                        <ol class="breadcrumb m-0 py-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                            <li class="breadcrumb-item active">Data Tables</li>
                        </ol>
                    </div>
                </div>

                <!-- Datatables  -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">

                            <div class="card-header">
                                <h5 class="card-title mb-0">Basic Datatable</h5>
                            </div><!-- end card header -->
                            <a href="?pages=pengguna_admin&aksi=tambah">Tambah data</a>
                            <div class="card-body">
                                <table id="datatable" class="table table-bordered dt-responsive table-responsive nowrap">
                                    <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>nama</th>
                                        <th>no telepon</th>
                                        <th>email</th>
                                        <th>role</th>
                                        <th>aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // memanggol data user admin inner dengan  tbl_users

                                        $sql = "SELECT tbl_admin.*, tbl_users.*, tbl_tipe_user.* FROM tbl_admin 
                                            LEFT JOIN tbl_users ON tbl_admin.id_user = tbl_users.id_user LEFT JOIN tbl_tipe_user ON tbl_users.role = tbl_tipe_user.id_tipe_user";
                                        $tampil = tampil ("$sql");
                                        $no = 1;
                                        foreach($tampil as $user):
        
                                        ?>
                                        <tr>
                                            <td><?php echo $no++;?></td>
                                            <td><?php echo $user['nama_admin'];?></td>
                                            <td><?php echo $user['telepon_admin'];?></td>
                                            <td><?php echo $user['email'];?></td>
                                            <td><?php echo $user['tipe_user'];?></td>
                                            <td>
                                                <a href="?pages=pengguna_admin&aksi=edit&id<?=$user['id_user'];?>">edit</a>
                                                <a href="?pages=pengguna_admin&aksi=delete&id<?=$user['id_user'];?>">delete</a>
                                            </td>
                                        </tr>
                                        <?php
                                        endforeach;
                                        ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div> <!-- container-fluid -->
        </div> <!-- content -->
    </div>
</div>