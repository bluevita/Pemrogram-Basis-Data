<?php
// Memasukkan file fungsi atau koneksi
include "function.php";

// Periksa apakah user sudah login dan memiliki hak akses
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 1) {
        header("Location: test.php");
        exit;
    }
} else {
    header("Location: index.php");
    exit;
}

// Query untuk mengambil data penyakit dari database
$queryPenyakit = mysqli_query($koneksi, "SELECT * FROM penyakit");
// Query untuk mengambil data deskripsi_relasi dari database
$queryRelasi = mysqli_query($koneksi, "SELECT * FROM relasi");
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
        crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,700&display=swap" rel="stylesheet" />
    <script>
        // Fungsi untuk menampilkan peringatan konfirmasi sebelum submit
        function confirmSubmit(event) {
            const confirmation = confirm("Apakah Anda yakin ingin menambahkan data Solusi ini?");
            if (!confirmation) {
                event.preventDefault(); // Membatalkan submit jika pengguna menekan 'Cancel'
            }
        }

        // Fungsi untuk mengarahkan pengguna ke indexSolusi.php jika tombol batal diklik
        function cancelEdit() {
            window.location.href = "indexSolusi.php"; // Redirect ke halaman indexSolusi.php
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
            <div class="d-sm-flex align-items-center justify-content-between ml-4 py-5">
                <h1 class="h3 mb-0 text-gray-800" id="tess">Form Tambah Solusi</h1>
            </div>

            <div class="row ml-4">
                <!-- Form untuk tambah solusi -->
                <form action="function.php?act=tambahSolusi" id="tambah" method="POST" onsubmit="confirmSubmit(event)">
                    <div class="form-group">
                        <label for="namaSolusi">Solusi</label>
                        <input type="text" class="form-control" id="namaSolusi" name="namaSolusi" placeholder="Masukkan Solusi" required>
                    </div>

                    <div class="form-group">
                        <label for="penyakit" class="form-label">Nama Penyakit</label>
                        <select name="penyakit" id="penyakit" class="form-control" required>
                            <option value="">Pilih Penyakit dari Solusi</option>
                            <?php while ($penyakit = mysqli_fetch_assoc($queryPenyakit)) { ?>
                                <option value="<?= $penyakit["penyakit"]; ?>"><?= $penyakit["penyakit"]; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="deskripsi_relasi" class="form-label">Deskripsi Relasi</label>
                        <select name="deskripsi_relasi" id="deskripsi_relasi" class="form-control" required>
                            <option value="">Pilih Deskripsi Relasi</option>
                            <?php while ($relasi = mysqli_fetch_assoc($queryRelasi)) { ?>
                                <option value="<?= $relasi["deskripsi_relasi"]; ?>"><?= $relasi["deskripsi_relasi"]; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="metode_pengobatan">Metode Pengobatan</label>
                        <input type="text" class="form-control" id="metode_pengobatan" name="metode_pengobatan" placeholder="Masukkan Metode Pengobatan" required>
                    </div>

                    <!-- Tombol untuk submit data -->
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
