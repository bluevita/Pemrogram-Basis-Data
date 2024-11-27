<?php 
include 'function.php';

if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 0) {
        header("location: indexAdmin.php");
        exit;
    } else if ($_SESSION['role'] == 2) {
        header("location: indexPakar.php");
        exit;
    }
} else {
    header("location:index.php");
    exit;
}

$gejala = mysqli_query($koneksi, "SELECT * FROM gejala");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" />
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="custom.css" />
    <title>Kebugaran Expert: Solusi Digital untuk Kesehatan Anda</title>
</head>
<body>
    <nav class="navbar py-2 navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="#"><img src="gambar/Kebugaran.png" width="147" alt="logo" /></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li><a class="btn px-2 py-2 btn-success ml-2" href="function.php?act=ulang" role="button">Cek Ulang</a></li>
                    <li><a class="btn px-2 py-2 btn-primary ml-2" href="logout.php" role="button">Log Out</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="hasil mt-4">
        <div class="container">
            <div class="row">
                <div class="col align-self-center">
                    <h3 class="mb-4">Penyakit yang Anda Alami:</h3>
                    <?php if (isset($_SESSION['Fatigue Syndrome'])): ?>
                    <h5 class="mb-4">
                        <div class="py-1"><strong>Fatigue Syndrome: <?= $_SESSION['Fatigue Syndrome']; ?>%</strong></div>
                        <div class="py-1"><strong>Overtraining Syndrome: <?= $_SESSION['Overtraining Syndrome']; ?>%</strong></div>
                        <div class="py-1"><strong>Sleep Disorder: <?= $_SESSION['Sleep Disorder']; ?>%</strong></div>
                        <div class="py-1"><strong>Hypertension: <?= $_SESSION['Hypertensionr']; ?>%</strong></div>
                    </h5>
                    <?php endif; ?>

                    <h3 class="mb-4">Solusi untuk Penyakit Anda:</h3>
                    <form action="" method="post" enctype="multipart/form-data" role="form">
                        <?php
                        // Fungsi untuk mencari penyakit dengan persentase tertinggi
                        function getHighest($results) {
                            arsort($results);
                            return key($results);
                        }

                        // Ambil penyakit dengan persentase tertinggi
                        $penyakit = [
                            'Fatigue Syndrome' => $_SESSION['Fatigue Syndrome'],
                            'Overtraining Syndrome' => $_SESSION['Overtraining Syndrome'],
                            'Sleep Disorder' => $_SESSION['Sleep Disorder'],
                            'Hypertension' => $_SESSION['Hypertensionr']
                        ];
                        $tertinggi = getHighest($penyakit);

                        // Ambil solusi dari database berdasarkan penyakit tertinggi
                        $query = "SELECT * FROM solusi WHERE penyakit = '$tertinggi'";
                        $data = mysqli_query($koneksi, $query);

                        while ($row = mysqli_fetch_array($data)) {
                            echo '<p>' . $row['solusi'] . '</p>';
                        }
                        ?>
                    </form>
                </div>
                <div class="col d-none d-sm-block">
                    <img width="500" src="gambar/hasil.png" alt="hero" />
                </div>
            </div>
        </div>
    </section>
</body>

<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</html>
