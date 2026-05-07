<?php
// 1. fungsi pengaturan pengaturan jam
date_default_timezone_set('Asia/Jakarta');
$waktu_sekarang = date('Y-m-d H:i:s');

// 2. fungsi koneksi ke database
$servername ="localhost";
$username = "root";
$password= "";
$dbname ="klinikbaru";

//membuat koneksi ke database
$koneksi = mysqli_connect ($servername, $username, $password, $dbname);

//cek apakah koneksi berhasil
if (!$koneksi){
    die("koneksi gagal: " . mysqli_error());
}

// 3.fungsi auto number untuk id_user
function autonumber($tabel,$kolom,$lebar=0,$awalan=''){
    global $koneksi;

    $query = "SELECT $kolom From $tabel ORDER BY $kolom DESC LIMIT 1";
    $hasil = mysqli_query($koneksi,$query) or die (mysqli_error($koneksi));

    //menghitung jumblah record untuk menentukan nomr urut berikutnya
    $jumlahrecord = mysqli_num_rows($hasil);
    if($jumlahrecord == 0)
        $nomor = 1;
    else{
        $row = mysqli_fetch_array($hasil);
        $nomor = intval(substr($row[0],strlen($awalan))) + 1;
    }

    //membuat format nomor unurt berikutnya
    if($lebar > 0){
        $angka = $awalan . str_pad($nomor,$lebar,"0", STR_PAD_LEFT);
    }else{
        $angka = $awalan . $nomor;
    }
    return $angka;
}
// autonumber ("tbl_users", "id_user", 7,"ADM");
// 4.fungsi register untuk  melakukan registerasi user baru
// proses register
// mengmbi data dari form register
// validasi data yang di masukan oleh user(cek email, password,confirm password)
// simpan ke tabel tbl_users dan tbl_admin

function registrasi($data) {
    // mengambil variabel eksternal yang di butuhkan
    global $koneksi,$waktu_sekarang;
    // a. mengambi data dari form dan di bersihkan (disamakan)
    //stripslashes untuk menghilangkan  backslash (\) yang mungkin dimasukan oleh suser

    $id_user = stripslashes($data["id_user"]);
    $nama = stripcslashes($data["nama"]);

    //strtolower untuk mengubah eaail mejadi huruf kecl semua,agar tida terjadi dplikasi email perbedaan huruf besar dan kecil
    $email = strtolower(stripslashes($data["email"]));

    //mysqli_real_escape_string untuk mengamankan unputan passowrd agar tidak terjadi SQL Injection
    $password = mysqli_real_escape_string($koneksi, $data["password"]);
    $confirm_password = mysqli_real_escape_string($koneksi,$data["confirm_password"]);

    // b. cek apakah email sudah terdaftar ataw belum
    $result = mysqli_query($koneksi,"SELECT email FROM tbl_users WHERE email = '$email'") or die(mysqli_error($koneksi));

    // jika berhasil pencarian kita temukan email yang sama, maka tampilkan pesan bahwa email sudah terdaftar
    if(mysqli_fetch_assoc($result)) {
        echo "<script>
                alert('Email sudah terdaftar!');
            </script>";
        return false; //berhenti sampai disini tidak lanjut ke proses berikut nya
    }

    // c. cek apakah pasowrd dan confirm password sama ataw tida
    // badingkan isi dari password dengan confirm password, jika tidak sama maka tampilan pesan bahwa password tidak sesuai
    if($password !== $confirm_password){
        echo "<script>
                alert('konfirmasi password tidak sesuai!');
                </script>";
        return false; // berhenti sampai di sini, tidak lanjut ke proses selanjutnya
    }

    // d. kita lakukan enkripsi password menggunakan passworkd_hash dengan algoritma default(bcypt)
    $password = password_hash($password, PASSWORD_DEFAULT);

    // e. kita cari apakah ID untuk role admin
    $tipe_user = "SELECT * FROM tbl_tipe_user WHERE tipe_user = 'Admin'";
    $result = mysqli_query($koneksi,$tipe_user) or die (mysqli_error($koneksi));
    $row = mysqli_fetch_assoc($result);
    $id = $row['id_tipe_user'];

    // f. jika kita lanjut degan menyimpan data ke tabel tbl_users dan tbl_admin
    $query ="INSERT INTO tbl_users SET
                id_user = '$id_user',
                email = '$email',
                password = '$password',
                role = '$id',
                created_at = '$waktu_sekarang'
                ";
    mysqli_query ($koneksi, $query) or die("gagal simpan ke tabel tbl_users:".  mysqli_error($koneksi));

    $query2 ="INSERT INTO tbl_admin SET
                nama_admin = '$nama',
                id_user = '$id_user',
                created_at = '$waktu_sekarang'
                ";
    mysqli_query ($koneksi, $query2) or die("gagal simpan ke tabel tbl_admin:".  mysqli_error($koneksi));

    echo "<script>
            alert('user baru berhasil tambahkan!');
            document.location.href = 'login.php';
            </script>";
    
    // g. jika berhasl maka kembalikan 1, jika gagal maka kembalian nilai 0
    return mysqli_affected_rows($koneksi);
}

// membuat Fungsi tampil \\
// ===================== \\
function tampil($DATA){
    global $koneksi; // variable yang ada di dalam scope asli berbeda dengan yang ada di luar, agar bariable di luar bisa dibaca dalam scope maka gunakan global
    $HASIL= mysqli_query($koneksi, $DATA);
    $data = [];// menyiapkan variable/wadah yang masih kosong untuk nantinya akan kita gunakan udah menyimpan data yang kita query/penggli dari database.
    while ($row = mysqli_fetch_assoc($HASIL)) {
        $data[] = $row; // kita masukan datanya di sini
    }
    return $data; // kita kembalikan nilainya, di munculkan
}

// fungsi untuk proses tambah admin \\
// ================================ \\

function tambah_admin($data, $file) {
    global $koneksi, $waktu_sekarang;

    // 1. Ambil dan bersihkan data dari form
    $id_admin = htmlspecialchars(trim($data['id_admin']));
    $nama_admin = htmlspecialchars(trim($data['nama_admin']));
    $alamat_admin = htmlspecialchars(trim($data['alamat_admin']));
    $telepon = htmlspecialchars(trim($data['telepon']));
    $jenis_kelamin = htmlspecialchars(trim($data['jenis_kelamin']));
    $email = htmlspecialchars(trim($data['email']));
    $password = mysqli_real_escape_string($koneksi, $data['password']);
    $password2 = mysqli_real_escape_string($koneksi, $data['password2']);
    $role = htmlspecialchars(trim($data['role']));

    // 2. Validasi form yang kosong
    $errors = [];

    if (empty($id_admin)) {
        $errors[] = "ID Admin tidak boleh kosong";
    }
    if (empty($nama_admin)) {
        $errors[] = "Nama Admin tidak boleh kosong";
    }
    if (empty($alamat_admin)) {
        $errors[] = "Alamat Admin tidak boleh kosong";
    }
    if (empty($telepon)) {
        $errors[] = "Telepon tidak boleh kosong";
    }
    if (empty($jenis_kelamin)) {
        $errors[] = "Jenis Kelamin tidak boleh kosong";
    }
    if (empty($email)) {
        $errors[] = "Email tidak boleh kosong";
    }
    if (empty($password)) {
        $errors[] = "Password tidak boleh kosong";
    }
    if (empty($password2)) {
        $errors[] = "Konfirmasi Password tidak boleh kosong";
    }
    if (empty($role)) {
        $errors[] = "Role tidak boleh kosong";
    }

    // Jika ada error, tampilkan pesan error
    if (!empty($errors)) {
        $_SESSION['form_errors'] = $errors;
        echo "<script>
        alert('". implode("\\n", $errors) . "');
        window.history.back();
        </script>";
        return false;
    }

    // 3. Validasi email/username sudah terdaftar atau belum
    $result = mysqli_query($koneksi, "SELECT email FROM tbl_users WHERE email = '$email'");

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['form_errors'] = ["Email sudah terdaftar"];
        echo "<script>
        alert('Email sudah terdaftar');
        window.history.back();
        </script>";
        return false;
    }

    // 4. Validasi konfirm password
    if ($password != $password2) {
        $_SESSION['form_errors'] = ["Konfirmasi password tidak sesuai"];
        echo "<script>
        alert('Konfirmasi password tidak sesuai');
        window.history.back();
        </script>";
        return false;
    }

    // 5. Validasi minimal panjang password (diubah jadi 4 karakter sesuai form)
    if (strlen($password) < 4) {
        $_SESSION['form_errors'] = ["Password minimal 4 karakter"];
        echo "<script>
        alert('Password minimal 4 karakter');
        window.history.back();
        </script>";
        return false;
    }

    // 6. Enkripsi password
    $password_hashed = password_hash($password, PASSWORD_DEFAULT);

    // 7. Mulai transaksi untuk menyimpan data ke tabel tbl_users dan tbl_admin
    mysqli_begin_transaction($koneksi);
    
    try {
        // Cek apakah role ada di tabel tbl_tipe_user
        $query_cek_role = "SELECT id_tipe_user FROM tbl_tipe_user WHERE tipe_user = '$role'";
        $result_role = mysqli_query($koneksi, $query_cek_role);
        
        if (mysqli_num_rows($result_role) == 0) {
            throw new Exception("Role tidak ditemukan");
        }
        
        $row_role = mysqli_fetch_assoc($result_role);
        $id_tipe_user = $row_role['id_tipe_user'];
        
        // Simpan ke tabel tbl_users
        $query_users = "INSERT INTO tbl_users (id_user, email, password, role, created_at) 
                        VALUES ('$id_admin', '$email', '$password_hashed', '$id_tipe_user', '$waktu_sekarang')";
        
        if (!mysqli_query($koneksi, $query_users)) {
            throw new Exception("Gagal menyimpan ke tabel tbl_users: " . mysqli_error($koneksi));
        }

        // Simpan ke tabel tbl_admin
        $query_admin = "INSERT INTO tbl_admin (nama_admin, alamat_admin, telepon_admin, jenis_kelamin, id_user, created_at) 
                        VALUES ('$nama_admin', '$alamat_admin', '$telepon', '$jenis_kelamin', '$id_admin', '$waktu_sekarang')";
        
        if (!mysqli_query($koneksi, $query_admin)) {
            throw new Exception("Gagal menyimpan ke tabel tbl_admin: " . mysqli_error($koneksi));
        }

        // Jika semua query berhasil, commit transaksi
        mysqli_commit($koneksi);

        $_SESSION['success'] = "Admin baru berhasil ditambahkan!";
        echo "<script>
        alert('Admin baru berhasil ditambahkan!');
        window.location.href = '?pages=pengguna_admin&aksi=tampil';
        </script>";
        exit;
        
    } catch (Exception $e) {
        // Jika terjadi error, rollback transaksi
        mysqli_rollback($koneksi);
        $_SESSION['form_errors'] = [$e->getMessage()];
        return false;
    }
}
?>
