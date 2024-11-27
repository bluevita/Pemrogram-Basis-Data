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

$queryGejala = mysqli_query($koneksi, "SELECT * FROM gejala");
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
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,700&display=swap" rel="stylesheet"/>
    <script>
        // Fungsi untuk menampilkan peringatan konfirmasi sebelum submit
        function confirmSubmit(event) {
            const confirmation = confirm("Apakah Anda yakin ingin menambahkan data ini?");
            if (!confirmation) {
                event.preventDefault(); // Membatalkan submit jika pengguna menekan 'Cancel'
            }
        }

        // Fungsi untuk mengarahkan pengguna ke indexGejala.php jika tombol batal diklik
        function cancelEdit() {
            window.location.href = "indexGejala.php"; // Redirect ke halaman indexGejala.php
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
                <h1 class="h3 mb-0 text-gray-800 " id="tess">Form Tambah Gejala</h1>
            </div>

            <!-- Content Row -->
            <div class="row ml-4">
                <form action="function.php?act=tambahGejala" id="tambah" method="POST" onsubmit="confirmSubmit(event)">
                    <div class="form-group">
                        <label for="namaGejala">Gejala</label>
                        <input type="text" class="form-control" id="namaGejala" name="namaGejala" placeholder="Masukkan gejala" required>

                        <!-- Deskripsi Gejala -->
                        <label for="deskripsi">Deskripsi Gejala</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>

                        <!-- Tingkat Frekuensi -->
                        <label for="tingkat_frekuensi">Tingkat Frekuensi (1-5)</label>
                        <select class="form-control" id="tingkat_frekuensi" name="tingkat_frekuensi" required>
                            <option value="1">1 (Sangat Rendah)</option>
                            <option value="2">2 (Rendah)</option>
                            <option value="3">3 (Sedang)</option>
                            <option value="4">4 (Tinggi)</option>
                            <option value="5">5 (Sangat Tinggi)</option>
                        </select>

                        <!-- Kategori Gejala -->
                        <label for="kategori_gejala">Kategori Gejala</label>
                        <input class="form-control" id="kategori_gejala" name="kategori_gejala" required />

                    </div>
                    
                    <div class="mt-3">
                        <input type="submit" name="tambah_btn" id="tambah" class="btn btn-primary" value="Tambah">
                        <button type="button" class="btn btn-secondary" onclick="cancelEdit()">Kembali</button>
                    </div>
                </form>
            </div>

        </div>
    </div>

</body>

</html>