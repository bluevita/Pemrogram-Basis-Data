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

// Ambil id_relasi dari URL
$id_relasi = $_GET['id_relasi'];

// Ambil data relasi yang sesuai dengan id_relasi
$queryRelasi = mysqli_query($koneksi, "SELECT * FROM relasi 
    INNER JOIN gejala ON relasi.gejala = gejala.gejala 
    INNER JOIN penyakit ON relasi.penyakit = penyakit.penyakit 
    WHERE id_relasi = '$id_relasi'");
$dataRelasi = mysqli_fetch_assoc($queryRelasi);

// Validasi jika data tidak ditemukan
if (!$dataRelasi) {
    echo "<script>
    alert('Data tidak ditemukan!');
    document.location.href = 'indexRelasi.php';</script>";
    exit;
}

// Ambil data gejala dan penyakit untuk dropdown
$queryGejala = mysqli_query($koneksi, "SELECT * FROM gejala");
$queryPenyakit = mysqli_query($koneksi, "SELECT * FROM penyakit");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ubah Relasi</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
          crossorigin="anonymous" />
    <script>
        // Fungsi untuk konfirmasi sebelum submit
        function confirmSubmit(event) {
            const confirmation = confirm("Apakah Anda yakin ingin mengubah data ini?");
            if (!confirmation) {
                event.preventDefault(); // Membatalkan submit jika pengguna menekan 'Cancel'
            }
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
                <h1 class="h3 mb-0 text-gray-800">Ubah Data Relasi Gejala dan Penyakit</h1>
            </div>

            <!-- Content Row -->
            <div class="row">
            <form action="function.php?act=ubahRelasi&id_relasi=<?= $dataRelasi['id_relasi']; ?>" method="POST">
    <div class="form-group">
        <label for="gejala">Nama Gejala</label>
        <select class="form-control" id="gejala" name="gejala" required>
            <option value="<?= $dataRelasi['gejala']; ?>"><?= $dataRelasi['gejala']; ?></option>
            <?php while ($gejala = mysqli_fetch_assoc($queryGejala)) { ?>
                <option value="<?= $gejala['gejala']; ?>"><?= $gejala['gejala']; ?></option>
            <?php } ?>
        </select>

        <label for="penyakit">Nama Penyakit</label>
        <select class="form-control" id="penyakit" name="penyakit" required>
            <option value="<?= $dataRelasi['penyakit']; ?>"><?= $dataRelasi['penyakit']; ?></option>
            <?php while ($penyakit = mysqli_fetch_assoc($queryPenyakit)) { ?>
                <option value="<?= $penyakit['penyakit']; ?>"><?= $penyakit['penyakit']; ?></option>
            <?php } ?>
        </select>

        <label for="deskripsi_relasi">Deskripsi Relasi</label>
        <input type="text" class="form-control" id="deskripsi_relasi" name="deskripsi_relasi" value="<?= $dataRelasi['deskripsi_relasi']; ?>" required>

        <label for="tingkat_keterkaitan">Tingkat Keterkaitan</label>
        <select class="form-control" id="tingkat_keterkaitan" name="tingkat_keterkaitan" required>
            <option value="1" <?= $dataRelasi['tingkat_keterkaitan'] == 1 ? 'selected' : ''; ?>>1 (Sangat Rendah)</option>
            <option value="2" <?= $dataRelasi['tingkat_keterkaitan'] == 2 ? 'selected' : ''; ?>>2 (Rendah)</option>
            <option value="3" <?= $dataRelasi['tingkat_keterkaitan'] == 3 ? 'selected' : ''; ?>>3 (Sedang)</option>
            <option value="4" <?= $dataRelasi['tingkat_keterkaitan'] == 4 ? 'selected' : ''; ?>>4 (Tinggi)</option>
            <option value="5" <?= $dataRelasi['tingkat_keterkaitan'] == 5 ? 'selected' : ''; ?>>5 (Sangat Tinggi)</option>
        </select>
    </div>

    <div class="mt-3">
        <input type="submit" name="ubah_btn" class="btn btn-primary" value="Ubah" onclick="confirmSubmit(event)">
        <a href="indexRelasi.php" class="btn btn-secondary">Kembali</a>
    </div>
</form>

            </div>
        </div>
    </div>
</body>

</html>
