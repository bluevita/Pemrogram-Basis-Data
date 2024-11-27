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

// Ambil data gejala dan penyakit untuk ditampilkan pada form
$queryGejala = mysqli_query($koneksi, "SELECT * FROM gejala");
$queryPenyakit = mysqli_query($koneksi, "SELECT * FROM penyakit");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tambah Data Relasi</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" />
    <script>
        // Fungsi untuk menampilkan peringatan konfirmasi sebelum submit
        function confirmSubmit(event) {
            const confirmation = confirm("Apakah Anda yakin ingin menambahkan data relasi ini?");
            if (!confirmation) {
                event.preventDefault(); // Membatalkan submit jika pengguna menekan 'Cancel'
            }
        }

        // Fungsi untuk mengarahkan pengguna ke indexRelasi.php jika tombol batal diklik
        function cancelAdd() {
            window.location.href = "indexRelasi.php"; // Redirect ke halaman indexRelasi.php
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
                <span>Data Pasien</span>
            </a>
        </section>
        <section class="isi">
            <a class="nav-link" href="indexPakar.php">
                <span>Data Pakar</span>
            </a>
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
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Tambah Data Relasi</h1>
            </div>

            <!-- Content Row -->
            <div class="row">
                <form action="function.php?act=tambahRelasi" method="POST">
                    <div class="form-group">
                        <!-- Pilih Gejala -->
                        <label for="gejala">Gejala</label>
                        <select class="form-control" name="gejala" required>
                            <option value="">Pilih Gejala</option>
                            <?php
                            // Mengambil data gejala
                            while ($gejala = mysqli_fetch_assoc($queryGejala)) {
                                echo "<option value='" . $gejala['gejala'] . "'>" . $gejala['gejala'] . "</option>";
                            }
                            ?>
                        </select>

                        <!-- Pilih Penyakit -->
                        <label for="penyakit">Penyakit</label>
                        <select class="form-control" name="penyakit" required>
                            <option value="">Pilih Penyakit</option>
                            <?php
                            // Mengambil data penyakit
                            while ($penyakit = mysqli_fetch_assoc($queryPenyakit)) {
                                echo "<option value='" . $penyakit['penyakit'] . "'>" . $penyakit['penyakit'] . "</option>";
                            }
                            ?>
                        </select>

                        <!-- Deskripsi Relasi -->
                        <label for="deskripsi_relasi">Deskripsi Relasi</label>
                        <textarea class="form-control" name="deskripsi_relasi" rows="3" required></textarea>

                        <!-- Tingkat Keterkaitan -->
                        <label for="tingkat_keterkaitan">Tingkat Keterkaitan (1-5)</label>
                        <select class="form-control" name="tingkat_keterkaitan" required>
                            <option value="1">1 (Sangat Rendah)</option>
                            <option value="2">2 (Rendah)</option>
                            <option value="3">3 (Sedang)</option>
                            <option value="4">4 (Tinggi)</option>
                            <option value="5">5 (Sangat Tinggi)</option>
                        </select>
                    </div>

                    <div class="mt-3">
                        <input type="submit" class="btn btn-primary" value="Tambah" onclick="confirmSubmit(event)">
                        <button type="button" class="btn btn-secondary" onclick="cancelAdd()">Kembali</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>
