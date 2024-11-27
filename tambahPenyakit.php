<?php
include "function.php";

// Periksa sesi dan role
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 1) {
        header("location: test.php");
        exit;
    }
} else {
    header("location:index.php");
    exit;
}

$queryPenyakit = mysqli_query($koneksi, "SELECT * FROM penyakit");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="styles.css">
    <link
        rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
        crossorigin="anonymous"/>
    <link
        href="https://fonts.googleapis.com/css?family=Poppins:300,400,700&display=swap"
        rel="stylesheet"/>
    <script>
        // Fungsi untuk menampilkan peringatan konfirmasi sebelum submit
        function confirmSubmit(event) {
            const confirmation = confirm("Apakah Anda yakin ingin menambahkan data penyakit ini?");
            if (!confirmation) {
                event.preventDefault(); // Membatalkan submit jika pengguna menekan 'Cancel'
            }
        }

        // Fungsi untuk mengarahkan pengguna ke indexPenyakit.php jika tombol batal diklik
        function cancelEdit() {
            window.location.href = "indexPenyakit.php"; // Redirect ke halaman indexPenyakit.php
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
            <a class="nav-link" href="indexAdmin.php">
            <span>Data Pasien</span></a>
        </section>
        <section class="isi">
            <a class="nav-link" href="indexPakar.php">
            <span>Data Pakar</span></a>
        </section>
        <div class="sidebar-heading">
            <h5 class="font-weight-bold text-white text-uppercase teks">Gejala & Penyakit</h5> 
        </div>
        <section class="isi">
            <a class="nav-link" href="indexPenyakit.php">
            <span>Data Penyakit</span>
            </a>
        </section>
        <section class="isi">
            <a class="nav-link" href="indexGejala.php">
            <span>Data Gejala</span>
            </a>
        </section>
        <section class="isi">
            <a class="nav-link" href="indexRelasi.php">
            <span>Data Relasi</span>
            </a>
        </section>
        <div class="sidebar-heading">
            <h5 class="font-weight-bold text-white text-uppercase teks">Solusi</h5> 
        </div>
        <section class="isi">
            <a class="nav-link" href="indexSolusi.php">
            <span>Data Solusi</span>
            </a>
        </section>
        <section class="isi">
            <a class="nav-link" href="logout.php">
            <span>Logout</span>
            </a>
        </section>
    </div>

    <div class="kanan">
    <div class="container-fluid">

    <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between ml-4 py-5">
            <h1 class="h3 mb-0 text-gray-800 " id="tess">Form Tambah Penyakit</h1>
        </div>

    <!-- Content Row -->
    <div class="row ml-4">
    <form action="function.php?act=tambahPenyakit" id="tambah" method="POST" onsubmit="confirmSubmit(event)">
        <div class="form-group">
            <label for="namaPenyakit">Penyakit</label>
            <input type="text" class="form-control" id="namaPenyakit" name="namaPenyakit" placeholder="Masukkan penyakit" required>
        </div>
        <div class="form-group">
            <label for="namakategori">Kategori Penyakit</label>
            <input type="text" class="form-control" id="namakategori" name="namakategori" placeholder="Masukkan kategori penyakit" required>
        </div>
        <div class="form-group">
            <label for="tingkat_keparahan">Tingkat Keparahan</label>
            <select class="form-control" id="tingkat_keparahan" name="tingkat_keparahan" required>
                <option value="1">1 (Sangat Rendah)</option>
                <option value="2">2 (Rendah)</option>
                <option value="3">3 (Sedang)</option>
                <option value="4">4 (Tinggi)</option>
                <option value="5">5 (Sangat Tinggi)</option>
            </select>
        </div>
        <div class="form-group">
            <label for="pengobatan">Pengobatan</label>
            <textarea class="form-control" id="pengobatan" name="pengobatan" rows="3" required></textarea>
        </div>

        <!-- Tombol Submit dan Batal -->
        <div class="mt-3">
            <input type="submit" name="tambah_btn" class="btn btn-primary" value="Tambah">
            <button type="button" class="btn btn-secondary" onclick="cancelEdit()">Kembali</button>
        </div>
    </form>
    </div>

</div>
</div>

</body>

</html>
