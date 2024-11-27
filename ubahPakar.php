<?php
include "function.php";
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 1) {
        header("location: test.php");
    } else if ($_SESSION['role'] == 2) {
        header("location: indexPakar.php");
    }
} else {
    header("location:index.php");
}

$id_user = $_GET["id_user"];
$queryUser = mysqli_query($koneksi, "SELECT * FROM user WHERE id_user = '$id_user'");
$user = mysqli_fetch_assoc($queryUser);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"/>
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,700&display=swap" rel="stylesheet"/>
    <script>
        // Fungsi untuk menampilkan peringatan konfirmasi sebelum submit
        function confirmSubmit(event) {
            const confirmation = confirm("Apakah Anda yakin ingin mengubah data ini?");
            if (!confirmation) {
                event.preventDefault(); // Membatalkan submit jika pengguna menekan 'Cancel'
            }
        }

        // Fungsi untuk mengarahkan pengguna ke indexAdmin.php jika tombol batal diklik
        function cancelEdit() {
            window.location.href = "indexPakar.php"; // Redirect ke halaman indexAdmin.php
        }
    </script>
</head>

<body>
    <div class="kiri">
        <section class="logo">
            <img src="gambar/kebugaran.png" alt="logo" height="150px" />
        </section>
        <div class="sidebar-heading">
            <h5 class="font-weight-bold text-white text-uppercase teks">Data User</h5>
        </div>
        <section class="isi">
            <a class="nav-link" href="indexAdmin.php"><span>Data Pasien</span></a>
        </section>
        <section class="isi">
            <a class="nav-link" href="indexPakar.php"><span>Data Pakar</span></a>
        </section>
        <div class="sidebar-heading">
            <h5 class="font-weight-bold text-white text-uppercase teks">Gejala & Penyakit</h5>
        </div>
        <section class="isi">
            <a class="nav-link" href="indexPenyakit.php"><span>Data Penyakit</span></a>
        </section>
        <section class="isi">
            <a class="nav-link" href="indexGejala.php"><span>Data Gejala</span></a>
        </section>
        </section>
        <section class="isi">
            <a class="nav-link" href="indexRelasi.php">Data Relasi</a>
        </section>
        <div class="sidebar-heading">
            <h5 class="font-weight-bold text-white text-uppercase teks">Solusi</h5>
        </div>
        <section class="isi">
            <a class="nav-link" href="indexSolusi.php"><span>Data Solusi</span></a>
        </section>
        <section class="isi">
            <a class="nav-link" href="logout.php"><span>Logout</span></a>
        </section>
    </div>

    <div class="kanan">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Ubah Data Pakar</h1>
            </div>

            <!-- Form Ubah Data -->
            <div class="row">
                <form action="function.php?act=ubahPakar&id_user=<?= $user['id_user']; ?>" id="formUbah" method="POST" onsubmit="confirmSubmit(event)">
                    <div class="form-group">
                        <label for="nama">Nama Pakar</label>
                        <input type="text" class="form-control" id="nama" name="nama" required value="<?= $user['nama']; ?>">

                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required value="<?= $user['email']; ?>">

                        <label for="tgl_lahir">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" required value="<?= $user['tgl_lahir']; ?>">

                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="L" <?= $user['jenis_kelamin'] == 'L' ? 'selected' : ''; ?>>Laki-Laki</option>
                            <option value="P" <?= $user['jenis_kelamin'] == 'P' ? 'selected' : ''; ?>>Perempuan</option>
                        </select>

                        <div class="mt-3">
                            <input type="submit" name="ubah_btn" class="btn btn-primary" value="Ubah">
                            <button type="button" class="btn btn-secondary" onclick="cancelEdit()">Batal</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
