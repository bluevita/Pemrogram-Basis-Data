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

$id_solusi = $_GET["id_solusi"];  // Mendapatkan ID solusi dari URL

// Ambil data penyakit untuk dropdown
$queryPenyakit = mysqli_query($koneksi, "SELECT * FROM penyakit");

// Ambil data deskripsi_relasi untuk dropdown
$queryRelasi = mysqli_query($koneksi, "SELECT * FROM relasi");

// Ambil data solusi berdasarkan ID solusi
$query = mysqli_query($koneksi, "SELECT * FROM solusi INNER JOIN penyakit ON solusi.penyakit = penyakit.penyakit INNER JOIN relasi ON solusi.deskripsi_relasi = relasi.deskripsi_relasi WHERE id_solusi = '$id_solusi'");
$data = mysqli_fetch_assoc($query);
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
            const confirmation = confirm("Apakah Anda yakin ingin mengubah data ini?");
            if (!confirmation) {
                event.preventDefault(); // Membatalkan submit jika pengguna menekan 'Cancel'
            }
        }

        // Fungsi untuk mengarahkan pengguna ke halaman sebelumnya jika tombol batal diklik
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
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Ubah Data Solusi</h1>
            </div>

            <!-- Content Row -->
            <div class="row">
                <form action="function.php?act=ubahSolusi&id_solusi=<?= $data['id_solusi']; ?>" id="ubah" method="POST">
                    <div class="form-group">
                        <label for="penyakit" class="form-label">Nama Penyakit</label>
                        <select name="penyakit" id="penyakit" class="form-control" required>
                            <option value="<?= $data['penyakit']; ?>"><?= $data['penyakit']; ?></option>
                            <?php while ($penyakit = mysqli_fetch_assoc($queryPenyakit)) { ?>
                                <option value="<?= $penyakit["id_penyakit"]; ?>"><?= $penyakit["penyakit"]; ?></option>
                            <?php } ?>
                        </select>

                        <label for="deskripsi_relasi" class="form-label">Deskripsi Relasi</label>
                        <select name="deskripsi_relasi" id="deskripsi_relasi" class="form-control" required>
                            <option value="<?= $data['deskripsi_relasi']; ?>"><?= $data['deskripsi_relasi']; ?></option>
                            <?php while ($relasi = mysqli_fetch_assoc($queryRelasi)) { ?>
                                <option value="<?= $relasi["deskripsi_relasi"]; ?>"><?= $relasi["deskripsi_relasi"]; ?></option>
                            <?php } ?>
                        </select>

                        <label for="namaSolusi">Solusi</label>
                        <input type="text" class="form-control" id="namaSolusi" name="namaSolusi" value="<?= $data['solusi']; ?>" required>

                        <label for="metode_pengobatan">Metode Pengobatan</label>
                        <input type="text" class="form-control" id="metode_pengobatan" name="metode_pengobatan" value="<?= $data['metode_pengobatan']; ?>" required>
                    </div>
                    
                    <div class="mt-3">
                        <input type="submit" name="ubah_btn" class="btn btn-primary" value="Ubah" onclick="confirmSubmit(event)">
                        <button type="button" class="btn btn-secondary" onclick="cancelEdit()">Kembali</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
