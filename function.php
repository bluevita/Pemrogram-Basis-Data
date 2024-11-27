<?php
$koneksi = mysqli_connect('localhost', 'root', '', 'kebugaran');

if (mysqli_connect_errno()) {
    echo "Koneksi Database Gagal : " . mysqli_connect_error();
}

session_start();
if (isset($_GET["act"])) {
    $act = $_GET["act"];

    // Pastikan aksi yang diminta valid.
    switch ($act) {
        case "register":
            register();
            break;
        case "login":
            login();
            break;
        case "registerPakar":
            registerPakar();
            break;
        case "tambahGejala":
            tambahGejala();
            break;
        case "tambahPenyakit":
            tambahPenyakit();
            break;
        case "tambahSolusi":
            tambahSolusi();
            break;
        case "tambahRelasi":  // New action for adding relasi
            tambahRelasi();
            break;
        case "hapusGejala":
            if (isset($_GET["id_gejala"])) {
                hapusGejala($_GET["id_gejala"]);
            }
            break;
        case "hapusPenyakit":
            if (isset($_GET["id_penyakit"])) {
                hapusPenyakit($_GET["id_penyakit"]);
            }
            break;
        case "hapusPasien":
            if (isset($_GET["id_user"])) {
                hapusPasien($_GET["id_user"]);
            }
            break;
        case "hapusPakar":
            if (isset($_GET["id_user"])) {
                hapusPakar($_GET["id_user"]);
            }
            break;
        case "hapusSolusi":
            if (isset($_GET["id_solusi"])) {
                hapusSolusi($_GET["id_solusi"]);
            }
            break;
        case "hapusRelasi":  // New action for deleting relasi
            if (isset($_GET["id_relasi"])) {
                hapusRelasi($_GET["id_relasi"]);
            }
            break;
        case "ubahGejala":
            if (isset($_GET["id_gejala"])) {
                ubahGejala($_GET["id_gejala"]);
            }
            break;
        case "ubahPasien":
            if (isset($_GET["id_user"])) {
                ubahPasien($_GET["id_user"]);
            }
            break;
        case "ubahPakar":
            if (isset($_GET["id_user"])) {
                ubahPakar($_GET["id_user"]);
            }
            break;
        case "ubahPenyakit":
            if (isset($_GET["id_penyakit"])) {
                ubahPenyakit($_GET["id_penyakit"]);
            }
            break;
        case "ubahSolusi":
            if (isset($_GET["id_solusi"])) {
                ubahSolusi($_GET["id_solusi"]);
            }
            break;
        case "ubahRelasi":  // New action for updating relasi
            if (isset($_GET["id_relasi"])) {
                ubahRelasi($_GET["id_relasi"]);
            }
            break;
        case "ulang":
            ulang();
            break;
        default:
            // Jika aksi tidak dikenal, tampilkan pesan kesalahan atau arahkan ke halaman tertentu
            echo "Aksi tidak ditemukan.";
            break;
    }
}


// Fungsi untuk logout dan membersihkan sesi
function ulang() {
    session_unset();
    session_destroy();
    header("Location: test.php");
    exit();
}

function register()
{
    global $koneksi;

    // Get and sanitize user input
    $nama = htmlspecialchars(trim($_POST['nama']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));
    $tgl_lahir = htmlspecialchars(trim($_POST['tgl_lahir']));
    $jenis_kelamin = htmlspecialchars(trim($_POST['jenis_kelamin']));

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>
                alert('Email tidak valid!');
                document.location.href = 'register.php';
              </script>";
        return;  // Stop execution if email is invalid
    }

    // Check if email already exists in the database
    $query_check_email = "SELECT * FROM user WHERE email = '$email'";
    $result = mysqli_query($koneksi, $query_check_email);
    if (mysqli_num_rows($result) > 0) {
        echo "<script>
                alert('Email sudah terdaftar!');
                document.location.href = 'register.php';
              </script>";
        return;  // Stop execution if email exists
    }

    // Hash the password securely
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Default role as '1' for regular user
    $role = 1;

    // Prepare the query to insert the user into the database
    $query_user = "INSERT INTO user (role, nama, email, tgl_lahir, jenis_kelamin, password)
                   VALUES ('$role', '$nama', '$email', '$tgl_lahir', '$jenis_kelamin', '$hashed_password')";

    // Execute the query
    $exe = mysqli_query($koneksi, $query_user);

    if (!$exe) {
        // Error handling if query fails
        echo "<script>
                alert('Terjadi kesalahan saat registrasi. Silakan coba lagi!');
                document.location.href = 'register.php';
              </script>";
    } else {
        // Successful registration
        echo "<script>
                alert('Berhasil Registrasi! Silahkan Login');
                document.location.href = 'index.php';
              </script>";
    }
}


function registerPakar()
{
    global $koneksi;

    // Sanitize user input
    $nama = htmlspecialchars(trim($_POST['nama']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));
    $tgl_lahir = htmlspecialchars(trim($_POST['tgl_lahir']));
    $jenis_kelamin = htmlspecialchars(trim($_POST['jenis_kelamin']));

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>
                alert('Email tidak valid!');
                document.location.href = 'registerPakar.php';
              </script>";
        return;  // Stop execution if email is invalid
    }

    // Check if email already exists in the database
    $query_check_email = "SELECT * FROM user WHERE email = '$email'";
    $result = mysqli_query($koneksi, $query_check_email);
    if (mysqli_num_rows($result) > 0) {
        echo "<script>
                alert('Email sudah terdaftar!');
                document.location.href = 'registerPakar.php';
              </script>";
        return;  // Stop execution if email exists
    }

    // Hash the password securely
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Default role as '2' for Pakar (Expert)
    $role = 2;

    // Prepare the query to insert the Pakar (Expert) into the database
    $query_pakar = "INSERT INTO user (role, nama, email, tgl_lahir, jenis_kelamin, password)
                    VALUES ('$role', '$nama', '$email', '$tgl_lahir', '$jenis_kelamin', '$hashed_password')";

    // Execute the query
    $exe = mysqli_query($koneksi, $query_pakar);

    if (!$exe) {
        // Error handling if query fails
        echo "<script>
                alert('Terjadi kesalahan saat registrasi pakar. Silakan coba lagi!');
                document.location.href = 'registerPakar.php';
              </script>";
    } else {
        // Successful registration
        echo "<script>
                alert('Berhasil Registrasi Pakar! Segera beritahu pakar Login');
                document.location.href = 'indexPakar.php';
              </script>";
    }
}

function login() {
    global $koneksi;

    // Sanitize user input
    $nama = htmlspecialchars(trim($_POST["nama"]));
    $input_pass = htmlspecialchars(trim($_POST['password']));

    // Check if both fields are filled
    if (empty($nama) || empty($input_pass)) {
        echo "<script>
                alert('Username atau Password tidak boleh kosong!');
                document.location.href = 'index.php';
              </script>";
        return; // Stop further execution
    }

    // Query the database for the user with the provided username
    $query = mysqli_query($koneksi, "SELECT * FROM user WHERE nama = '$nama'");

    // Check if a user with the provided username exists
    if (mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_assoc($query);
        $password = $data['password'];
        $role = $data['role'];

        // Verify the password
        if (password_verify($input_pass, hash: $password)) {
            // Set session variable based on the user's role
            $_SESSION['role'] = $role;
            $_SESSION['id_user'] = $data['id_user']; // Store user ID in session

            // Redirect user based on their role
            if ($role == 1) {
                echo "<script>
                        document.location.href = 'test.php';
                      </script>";
            } elseif ($role == 0) {
                echo "<script>
                        document.location.href = 'indexAdmin.php';
                      </script>";
            } elseif ($role == 2) {
                echo "<script>
                        document.location.href = 'indexPakar.php';
                      </script>";
            }
        } else {
            // If the password is incorrect
            echo "<script>
                    alert('Password salah!');
                    document.location.href = 'index.php';
                  </script>";
        }
    } else {
        // If the username doesn't exist in the database
        echo "<script>
                alert('Username tidak ditemukan!');
                document.location.href = 'index.php';
              </script>";
    }
}

function tambahGejala()
{
    global $koneksi;
    
    // Menangkap data dari form
    $gejala = htmlspecialchars($_POST['namaGejala']);
    $deskripsi = htmlspecialchars($_POST['deskripsi']);
    $tingkat_frekuensi = htmlspecialchars($_POST['tingkat_frekuensi']);
    $kategori_gejala = htmlspecialchars($_POST['kategori_gejala']);
    
    // Query untuk menambahkan data gejala
    $queryGejala = "INSERT INTO gejala (gejala, deskripsi, tingkat_frekuensi, kategori_gejala) VALUES ('$gejala', '$deskripsi', '$tingkat_frekuensi', '$kategori_gejala')";
    $exe = mysqli_query($koneksi, $queryGejala);

    // Cek apakah query berhasil
    if (!$exe) {
        die('Error pada database saat memasukkan gejala');
    }

    // Ambil ID gejala yang baru saja dimasukkan
    $id_gejala = mysqli_insert_id($koneksi);

    // Tidak ada relasi dengan id_penyakit lagi, jadi kita hapus bagian queryRelasi
    // Langsung menampilkan pesan sukses
    echo "<script>
    alert('Gejala berhasil ditambahkan');
    document.location.href = 'indexGejala.php';</script>";
}



function tambahPenyakit()
{
    global $koneksi;

    // Ambil data dari form
    $Penyakit = htmlspecialchars($_POST['namaPenyakit']);
    $kategori = htmlspecialchars($_POST['namakategori']);
    $tingkat_keparahan = htmlspecialchars($_POST['tingkat_keparahan']);
    $pengobatan = htmlspecialchars($_POST['pengobatan']);

    // Query untuk menambahkan data penyakit baru
    $queryPenyakit = "INSERT INTO penyakit (penyakit, kategori, tingkat_keparahan, pengobatan) 
              VALUES ('$Penyakit', '$kategori', '$tingkat_keparahan', '$pengobatan')";

    $exe = mysqli_query($koneksi, $queryPenyakit);

    if (!$exe) {
        die('Error pada database: ' . mysqli_error($koneksi));
    } else {
        echo "<script>
                alert('Data Penyakit berhasil ditambahkan!');
                document.location.href = 'indexPenyakit.php';
              </script>";
    }
}


function tambahSolusi()
{
    global $koneksi;
    
    // Ambil data dari form
    $solusi = htmlspecialchars($_POST['namaSolusi']);
    $penyakit = htmlspecialchars($_POST['penyakit']);
    $deskripsi_relasi = htmlspecialchars($_POST['deskripsi_relasi']);  // Ambil deskripsi relasi
    $metode_pengobatan = htmlspecialchars($_POST['metode_pengobatan']);  // Ambil metode pengobatan

    // Query untuk memasukkan data ke tabel solusi
    $querySolusi = "INSERT INTO solusi (penyakit, deskripsi_relasi, solusi, metode_pengobatan) 
                    VALUES ('$penyakit', '$deskripsi_relasi', '$solusi', '$metode_pengobatan')";

    // Eksekusi query
    $exe = mysqli_query($koneksi, $querySolusi);

    // Cek apakah query berhasil
    if (!$exe) {
        die('Error pada database: ' . mysqli_error($koneksi));
    }

    // Beri notifikasi dan arahkan kembali
    echo "<script>
            alert('Solusi berhasil ditambahkan');
            document.location.href = 'indexSolusi.php'</script>";
}


function tambahRelasi()
{
    global $koneksi;

    // Menangkap data dari form
    $gejala = htmlspecialchars($_POST['gejala']);
    $penyakit = htmlspecialchars($_POST['penyakit']);
    $deskripsi_relasi = htmlspecialchars($_POST['deskripsi_relasi']);
    $tingkat_keterkaitan = htmlspecialchars($_POST['tingkat_keterkaitan']);

    // Query untuk menambah data relasi
    $queryRelasi = "INSERT INTO relasi (gejala, penyakit, deskripsi_relasi, tingkat_keterkaitan) 
                    VALUES ('$gejala', '$penyakit', '$deskripsi_relasi', '$tingkat_keterkaitan')";

    $exe = mysqli_query($koneksi, $queryRelasi);

    if (!$exe) {
        die('Error pada database');
    }

    echo "<script>
        alert('Data Relasi berhasil ditambahkan');
        document.location.href = 'indexRelasi.php'</script>";
}


function ubahGejala($id_gejala) {
    global $koneksi;

    // Sanitasi input menggunakan htmlspecialchars
    $gejala = htmlspecialchars($_POST['namaGejala']);
    $deskripsi = htmlspecialchars($_POST['deskripsi']);
    $tingkat_frekuensi = htmlspecialchars($_POST['tingkat_frekuensi']);
    $kategori_gejala = htmlspecialchars($_POST['kategori_gejala']);

    // Validasi tingkat frekuensi sebagai angka antara 1-5
    if (!in_array($tingkat_frekuensi, ['1', '2', '3', '4', '5'])) {
        die('Tingkat frekuensi tidak valid!');
    }

    // Gunakan prepared statements untuk menghindari SQL Injection
    $query = "UPDATE gejala 
              SET gejala = ?, deskripsi = ?, tingkat_frekuensi = ?, kategori_gejala = ?
              WHERE id_gejala = ?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "ssisi", $gejala, $deskripsi, $tingkat_frekuensi, $kategori_gejala, $id_gejala);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>
                alert('Data Gejala berhasil diubah!');
                document.location.href = 'indexGejala.php';
              </script>";
    } else {
        die('Error pada database: ' . mysqli_error($koneksi));
    }

    mysqli_stmt_close($stmt);
}




function ubahSolusi($id_solusi) {
    global $koneksi;

    // Pastikan data dari form sudah ada
    if (isset($_POST['namaSolusi']) && isset($_POST['penyakit']) && isset($_POST['deskripsi_relasi'])) {
        // Mengambil data dari form dan membersihkan input
        $solusi = htmlspecialchars($_POST['namaSolusi']);
        $penyakit = htmlspecialchars($_POST['penyakit']);
        $deskripsi_relasi = htmlspecialchars($_POST['deskripsi_relasi']);
        $metode_pengobatan = htmlspecialchars($_POST['metode_pengobatan']);

        // Query untuk memperbarui data solusi
        $querySolusi = "UPDATE solusi SET solusi = '$solusi', penyakit = '$penyakit', deskripsi_relasi = '$deskripsi_relasi', metode_pengobatan = '$metode_pengobatan' WHERE id_solusi = '$id_solusi'";

        // Menjalankan query
        $exe = mysqli_query($koneksi, $querySolusi);

        // Cek apakah query berhasil dijalankan
        if (!$exe) {
            // Jika query gagal, tampilkan error
            die('Error pada database: ' . mysqli_error($koneksi));
        }

        // Jika berhasil, beri pesan berhasil dan redirect ke halaman indexSolusi.php
        echo "<script>
            alert('Data Solusi berhasil diubah!');
            document.location.href = 'indexSolusi.php';
        </script>";
    } else {
        // Jika data tidak valid, beri pesan error
        echo "<script>
            alert('Data tidak lengkap!');
            document.location.href = 'indexSolusi.php';
        </script>";
    }
}


function ubahPenyakit($id_penyakit) {
    global $koneksi;

    // Sanitasi input menggunakan htmlspecialchars
    $penyakit = htmlspecialchars($_POST['namaPenyakit']);
    $kategori = htmlspecialchars($_POST['namakategori']);
    $tingkat_keparahan = htmlspecialchars($_POST['tingkat_keparahan']);
    $pengobatan = htmlspecialchars($_POST['pengobatan']);

    // Validasi tingkat keparahan sebagai angka antara 1-5
    if (!in_array($tingkat_keparahan, ['1', '2', '3', '4', '5'])) {
        die('Tingkat keparahan tidak valid!');
    }

    // Gunakan prepared statements untuk menghindari SQL Injection
    $query = "UPDATE penyakit 
              SET penyakit = ?, kategori = ?, tingkat_keparahan = ?, pengobatan = ?
              WHERE id_penyakit = ?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "ssisi", $penyakit, $kategori, $tingkat_keparahan, $pengobatan, $id_penyakit);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>
                alert('Data Penyakit berhasil diubah!');
                document.location.href = 'indexPenyakit.php';
              </script>";
    } else {
        die('Error pada database: ' . mysqli_error($koneksi));
    }

    mysqli_stmt_close($stmt);
}

function ubahPasien($id_user) {
    global $koneksi;

    $nama = htmlspecialchars($_POST['nama']);
    $email = htmlspecialchars($_POST['email']);
    $tgl_lahir = htmlspecialchars($_POST['tgl_lahir']);
    $jenis_kelamin = htmlspecialchars($_POST['jenis_kelamin']);

    // Gunakan prepared statement untuk keamanan
    $queryUser = "UPDATE user 
                  SET 
                      nama = ?, 
                      email = ?, 
                      tgl_lahir = ?, 
                      jenis_kelamin = ?
                  WHERE 
                      id_user = ?";
    $stmt = mysqli_prepare($koneksi, $queryUser);
    mysqli_stmt_bind_param($stmt, "ssssi", $nama, $email, $tgl_lahir, $jenis_kelamin, $id_user);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>
                alert('Data Pasien berhasil diubah!');
                document.location.href = 'indexAdmin.php';
              </script>";
    } else {
        die('Error pada database: ' . mysqli_error($koneksi));
    }

    mysqli_stmt_close($stmt);
}


function ubahPakar($id_user) {
    global $koneksi;

    $nama = htmlspecialchars($_POST['nama']);
    $email = htmlspecialchars($_POST['email']);
    $tgl_lahir = htmlspecialchars($_POST['tgl_lahir']);
    $jenis_kelamin = htmlspecialchars($_POST['jenis_kelamin']); // Menambahkan jenis kelamin

    // Validasi data jenis kelamin
    if (!in_array($jenis_kelamin, ['L', 'P'])) {
        die('Jenis kelamin tidak valid!');
    }

    // Gunakan prepared statement untuk menghindari SQL Injection
    $queryUser = "UPDATE user 
                  SET nama = ?, 
                      email = ?, 
                      tgl_lahir = ?, 
                      jenis_kelamin = ? 
                  WHERE id_user = ?";
    $stmt = mysqli_prepare($koneksi, $queryUser);
    mysqli_stmt_bind_param($stmt, "ssssi", $nama, $email, $tgl_lahir, $jenis_kelamin, $id_user);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>
                alert('Data Pakar berhasil diubah!');
                document.location.href = 'indexPakar.php';
              </script>";
    } else {
        die('Error pada database: ' . mysqli_error($koneksi));
    }

    mysqli_stmt_close($stmt);
}


function ubahRelasi($id_relasi)
{
    global $koneksi;

    // Validasi ID Relasi
    if (!$id_relasi) {
        echo "<script>alert('ID Relasi tidak valid!');</script>";
        return;
    }

    // Ambil data dari form
    $gejala = htmlspecialchars($_POST['gejala']);
    $penyakit = htmlspecialchars($_POST['penyakit']);
    $deskripsi_relasi = htmlspecialchars($_POST['deskripsi_relasi']);
    $tingkat_keterkaitan = htmlspecialchars($_POST['tingkat_keterkaitan']);

    // Query untuk update data relasi
    $queryRelasi = "UPDATE relasi 
                    SET gejala = '$gejala', 
                        penyakit = '$penyakit', 
                        deskripsi_relasi = '$deskripsi_relasi', 
                        tingkat_keterkaitan = '$tingkat_keterkaitan' 
                    WHERE id_relasi = '$id_relasi'";

    // Eksekusi query
    $exe = mysqli_query($koneksi, $queryRelasi);

    if (!$exe) {
        die('Error pada database: ' . mysqli_error($koneksi));
    }

    echo "<script>
    alert('Relasi berhasil diubah!');
    document.location.href = 'indexRelasi.php';</script>";
}


function hapusGejala($id_gejala)
{
    global $koneksi;

    // Hapus data yang terkait di tabel relasi
    $deleteRelasiQuery = "DELETE FROM relasi WHERE id_gejala = '$id_gejala'";
    $deleteRelasiResult = mysqli_query($koneksi, $deleteRelasiQuery);

    if ($deleteRelasiResult) {
        // Jika data di tabel relasi berhasil dihapus, lanjutkan hapus di tabel gejala
        $deleteGejalaQuery = "DELETE FROM gejala WHERE id_gejala = '$id_gejala'";
        $deleteGejalaResult = mysqli_query($koneksi, $deleteGejalaQuery);

        if ($deleteGejalaResult) {
            echo "<script>
                alert('Data gejala dan relasi terkait berhasil dihapus!');
                document.location.href = 'indexGejala.php';
            </script>";
        } else {
            echo "<script>
                alert('Gagal menghapus data gejala. Silakan coba lagi.');
                document.location.href = 'indexGejala.php';
            </script>";
        }
    } else {
        echo "<script>
            alert('Gagal menghapus data di tabel relasi. Silakan coba lagi.');
            document.location.href = 'indexGejala.php';
        </script>";
    }
}


function hapusPasien($id_user)
{
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM user WHERE id_user = $id_user");
    $result = mysqli_affected_rows($koneksi);
    if ($result > 0) {
        echo "
        <script>
                alert('Akun Pasien berhasil dihapus!');
                document.location.href = 'indexAdmin.php';
            </script>	
        ";
    } else {
        echo "
        <script>
                    alert('Akun Pasien gagal dihapus!');
                    document.location.href = 'indexAdmin.php';
            </script>	
        ";
    }
}

function hapusPakar($id_user)
{
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM user WHERE id_user = $id_user");
    $result = mysqli_affected_rows($koneksi);
    if ($result > 0) {
        echo "
        <script>
                alert('Akun Pakar berhasil dihapus!');
                document.location.href = 'indexPakar.php';
            </script>	
        ";
    } else {
        echo "
        <script>
                    alert('Akun Pakar gagal dihapus!');
                    document.location.href = 'indexPakar.php';
            </script>	
        ";
    }
}

function hapusPenyakit($id_penyakit)
{
    global $koneksi;

    // Sanitasi input ID
    $id_penyakit = htmlspecialchars($id_penyakit);

    // Gunakan prepared statements untuk menghapus data
    $query = "DELETE FROM penyakit WHERE id_penyakit = ?";
    $stmt = mysqli_prepare($koneksi, $query);

    if (!$stmt) {
        die("Kesalahan pada persiapan query: " . mysqli_error($koneksi));
    }

    // Bind parameter
    mysqli_stmt_bind_param($stmt, "i", $id_penyakit);

    // Eksekusi query
    if (mysqli_stmt_execute($stmt)) {
        $affectedRows = mysqli_stmt_affected_rows($stmt);

        if ($affectedRows > 0) {
            echo "
            <script>
                alert('Penyakit berhasil dihapus!');
                document.location.href = 'indexPenyakit.php';
            </script>";
        } else {
            echo "
            <script>
                alert('Penyakit gagal dihapus. Mungkin data tidak ditemukan atau terikat dengan gejala.');
                document.location.href = 'indexPenyakit.php';
            </script>";
        }
    } else {
        echo "
        <script>
            alert('Terjadi kesalahan saat menghapus data: " . mysqli_error($koneksi) . "');
            document.location.href = 'indexPenyakit.php';
        </script>";
    }

    // Tutup prepared statement
    mysqli_stmt_close($stmt);
}

function hapusSolusi($id_solusi)
{
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM solusi WHERE id_solusi = $id_solusi");
    $result = mysqli_affected_rows($koneksi);
    if ($result > 0) {
        echo "
        <script>
                alert('Solusi berhasil dihapus!');
                document.location.href = 'indexSolusi.php';
            </script>	
        ";
    } else {
        echo "
        <script>
                    alert('Solusi gagal dihapus!');
                    document.location.href = 'indexSolusi.php';
            </script>	
        ";
    }
}

function hapusRelasi($id_relasi)
{
    global $koneksi;

    // Hapus data dari tabel relasi berdasarkan id_relasi
    $deleteRelasiQuery = "DELETE FROM relasi WHERE id_relasi = '$id_relasi'";
    $deleteRelasiResult = mysqli_query($koneksi, $deleteRelasiQuery);

    if ($deleteRelasiResult) {
        echo "<script>
            alert('Data relasi berhasil dihapus!');
            document.location.href = 'indexRelasi.php';
        </script>";
    } else {
        echo "<script>
            alert('Gagal menghapus data relasi. Silakan coba lagi.');
            document.location.href = 'indexRelasi.php';
        </script>";
    }
}



function gejala($id_penyakit){
    global $koneksi;
    $query = "SELECT relasi.id_gejala as id_gejala FROM relasi INNER JOIN gejala ON relasi.id_gejala = gejala.id_gejala INNER JOIN penyakit ON relasi.id_penyakit = penyakit.id_penyakit WHERE relasi.id_penyakit = '$id_penyakit' ";
    $data = mysqli_query($koneksi, $query);
    // var_dump($data);
    $row = mysqli_fetch_assoc($data);
    
    return $row['id_gejala'];
    // echo "hasil". $row['id_gejala'];
}


?>