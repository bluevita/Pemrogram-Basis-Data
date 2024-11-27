<?php 
include 'function.php';

// Check if user role is valid
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 0) {
        header("location: indexAdmin.php");
        exit;
    } else if ($_SESSION['role'] == 2) {
        header("location: indexPakar.php");
        exit;
    }
}

// Initialize session variables if not already set
if (!isset($_SESSION['persentase'])) {
    $_SESSION['persentase'] = [];
}
if (!isset($_SESSION['id_gejala'])) {
    $_SESSION['id_gejala'] = 1;  // Start from the first gejala
}

// Fetch gejala from database
$gejala = mysqli_query($koneksi, "SELECT * FROM gejala");

// Handle the progression through gejala (symptoms)
$id_penyakit = 1;  // Assume we are checking for a specific penyakit
$id_gejala = $_SESSION['id_gejala'];

// Fetch the current gejala
$data = mysqli_query($koneksi, "SELECT gejala FROM gejala WHERE id_gejala = '$id_gejala'");
$row = mysqli_fetch_assoc($data);
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
            <a class="navbar-brand" href="#">
                <img src="gambar/Kebugaran.png" width="147" alt="logo" />
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li><a class="btn px-4 btn-primary ml-2" href="logout.php" role="button">Log Out</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="test mt-5">
        <div class="container">
            <div class="row">
                <div class="col align-self-center">
                    <h2 class="mb-4">Pertanyaan : </h2>
                    <form action="" method="post">
                        <p class="mb-4">
                            Apakah anda mengalami <?= $row['gejala']; ?> ?
                        </p>
                        <input type="submit" class="btn btn-primary mr-2 px-4 py-2" name="ya" value="Ya">
                        <input type="submit" class="btn btn-danger px-3 py-2" name="tidak" value="Tidak">

                        <?php 
                        $persentase = $_SESSION['persentase'];
                        $next_gejala = $_SESSION['id_gejala'];

                        // Handle 'Ya' response
                        if (isset($_POST['ya'])) {
                            $temp = $id_gejala;
                            array_push($persentase, $temp);
                            $_SESSION['persentase'] = $persentase;
                            $next_gejala = $id_gejala + 1;
                            $_SESSION['id_gejala'] = $next_gejala;
                        } 
                        // Handle 'Tidak' response
                        else if (isset($_POST['tidak'])) {
                            $next_gejala = $id_gejala + 1;
                            $_SESSION['id_gejala'] = $next_gejala;
                        }

                        // Once all gejala are answered, calculate the disease probabilities
                        if ($_SESSION['id_gejala'] > 11) {
                            $Fatigue_Syndrome = array(1, 5, 8, 2);
                            $Overtraining_Syndrome = array(2, 6, 8, 11);
                            $Sleep_Disorder = array(3, 10, 1, 11);
                            $Hypertension = array(4, 7, 9, 6);
                            $nilai = 0;

                            // Calculate for Fatigue_Syndrome
                            foreach ($persentase as $value) {
                                if (in_array($value, $Fatigue_Syndrome)) {
                                    $nilai += 1;
                                }
                            }
                            $Fatigue_Syndrome = $nilai / count($Fatigue_Syndrome);
                            $hasilFatigue_Syndrome = number_format($Fatigue_Syndrome, 3) * 100;
                            $_SESSION['Fatigue Syndrome'] = $hasilFatigue_Syndrome;

                            // Calculate for Overtraining_Syndrome
                            $nilai = 0;
                            foreach ($persentase as $value) {
                                if (in_array($value, $Overtraining_Syndrome)) {
                                    $nilai += 1;
                                }
                            }
                            $Overtraining_Syndrome = $nilai / count($Overtraining_Syndrome);
                            $hasilOvertraining_Syndrome = number_format($Overtraining_Syndrome, 4) * 100;
                            $_SESSION['Overtraining Syndrome'] = $hasilOvertraining_Syndrome;

                            // Calculate for Sleep_Disorder
                            $nilai = 0;
                            foreach ($persentase as $value) {
                                if (in_array($value, $Sleep_Disorder)) {
                                    $nilai += 1;
                                }
                            }
                            $Sleep_Disorder = $nilai / count($Sleep_Disorder);
                            $hasilSleep_Disorder = number_format($Sleep_Disorder, 4) * 100;
                            $_SESSION['Sleep Disorder'] = $hasilSleep_Disorder;

                            // Calculate for Hypertension
                            $nilai = 0;
                            foreach ($persentase as $value) {
                                if (in_array($value, $Hypertension)) {
                                    $nilai += 1;
                                }
                            }
                            $Hypertension = $nilai / count($Hypertension);
                            $hasilHypertension = number_format($Hypertension, 4) * 100;
                            $_SESSION['Hypertensionr'] = $hasilHypertension;

                            header('Location: hasil.php');
                            exit;
                        }
                        ?>
                    </form>
                </div>
                <div class="col d-none d-sm-block">
                    <img width="500" src="gambar/jawab.png" alt="hero" />
                </div>
            </div>
        </div>
    </section>
</body>
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</html>
