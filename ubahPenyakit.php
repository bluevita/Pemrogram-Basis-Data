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

$id_penyakit = $_GET["id_penyakit"];

// Ambil data penyakit berdasarkan ID
$queryPenyakit = mysqli_query($koneksi, "SELECT * FROM penyakit WHERE id_penyakit = '$id_penyakit'");
$penyakit = mysqli_fetch_assoc($queryPenyakit);
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
    <link
        href="https://fonts.googleapis.com/css?family=Poppins:300,400,700&display=swap"
        rel="stylesheet" />
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
            window.location.href = "indexAdmin.php"; // Redirect ke halaman indexAdmin.php
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
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Ubah Data Penyakit</h1>
            </div>

            <!-- Content Row -->
            <div class="row">

                <form action="function.php?act=ubahPenyakit&id_penyakit=<?= $penyakit['id_penyakit']; ?>" id="ubah" method="POST">
                    <div class="form-group">
                        <!-- Nama Penyakit -->
                        <label for="namaPenyakit">Nama Penyakit</label>
                        <input type="text" class="form-control" id="namaPenyakit" name="namaPenyakit" required value="<?= $penyakit['penyakit']; ?>">

                        <!-- Nama Kategori -->
                        <label for="namakategori">Nama Kategori</label>
                        <input type="text" class="form-control" id="namakategori" name="namakategori" required value="<?= $penyakit['kategori']; ?>">

                        <!-- Tingkat Keparahan -->
                        <label for="tingkat_keparahan">Tingkat Keparahan</label>
                        <select class="form-control" id="tingkat_keparahan" name="tingkat_keparahan" required>
                            <option value="1" <?= $penyakit['tingkat_keparahan'] == 1 ? 'selected' : ''; ?>>1 (Sangat Rendah)</option>
                            <option value="2" <?= $penyakit['tingkat_keparahan'] == 2 ? 'selected' : ''; ?>>2 (Rendah)</option>
                            <option value="3" <?= $penyakit['tingkat_keparahan'] == 3 ? 'selected' : ''; ?>>3 (Sedang)</option>
                            <option value="4" <?= $penyakit['tingkat_keparahan'] == 4 ? 'selected' : ''; ?>>4 (Tinggi)</option>
                            <option value="5" <?= $penyakit['tingkat_keparahan'] == 5 ? 'selected' : ''; ?>>5 (Sangat Tinggi)</option>
                        </select>

                        <!-- Nama Pengobatan -->
                        <label for="pengobatan">Nama Pengobatan</label>
                        <textarea class="form-control" id="pengobatan" name="pengobatan" rows="3" required><?= $penyakit['pengobatan']; ?></textarea>
                    </div>

                    <!-- Tombol Submit -->
                    <div class="mt-3">
                        <input type="submit" name="ubah_btn" class="btn btn-primary" value="Ubah" onclick="confirmSubmit(event)">
                        <a href="indexPenyakit.php" class="btn btn-secondary">Batal</a>
                    </div>
                </form>

            </div>

        </div>
    </div>

</body>

</html>
