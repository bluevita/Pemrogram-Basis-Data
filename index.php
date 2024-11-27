<?php 
include 'function.php';

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
      integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
      crossorigin="anonymous"/>
    <link
      href="https://fonts.googleapis.com/css?family=Poppins:300,400,700&display=swap"
      rel="stylesheet"/>
    <link rel="stylesheet" href="custom.css" />
    <title>Kebugaran Expert: Solusi Digital untuk Kesehatan Anda</title>
  </head>
  <body>
    <nav class="navbar py-2 navbar-expand-lg navbar-light">
      <div class="container">
        <a class="navbar-brand" href="#"
          ><img src="gambar/kebugaran.png" width="147" alt="logo"
        /></a>
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item align-self-center active">
              <a class="nav-link" href="index.php"
                >Home <span class="sr-only">(current)</span></a
              >
            </li>
            <li class="nav-item align-self-center active">
              <a class="nav-link"  href="#alur">Alur Kerja <span class="sr-only">(current)</span></a>
            </li>
            
            <li class="nav-item ">
              <!-- Button trigger modal -->
              <button type="button" class="btn px-4 btn-secondary ml-5 logintombol" data-toggle="modal" data-target="#exampleModal">Log In</button>
              </button>

              <!-- Login -->
              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Log In</h5>
                      <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button> -->
                    </div>
                    <div class="modal-body">
                      <form id="login-form" action="function.php?act=login" method="POST" >
                        <div class="form-group">
                          <div id="result"></div>
                            <label for="nama" class="col-form-label">Username :</label>
                              <input type="text" class="form-control" id="nama" name="nama" rows="3" placeholder="Username">
                              <label for="pass" class="col-form-label">Password :</label>
                              <input type="password" class="form-control" id="password" name="password" rows="3" placeholder="Password">
                          </div>
                        <div class="form-row">
                    </div>
                        <div class="modal-footer">
                          <input type="submit" name="login_btn" id="login" class="btn btn-primary" value="Login">
                        </div>
                    </form>
                  </div>
                </div>
              </div>
            </li>
            <li>
              <a class="btn px-4 btn-primary ml-2" href="register.php" role="button"
              >Register</a>
            </li>
            
          </ul>
        </div>
      </div>
    </nav>

    <section class="heroBWA mt-5">
      <div class="container">
        <div class="row">
          <div class="col align-self-center">
            <h1 class="mb-4">Kebugaran Expert: Solusi Digital untuk Kesehatan Anda</h1>
            <p class="mb-4">
            Kebugaran Expert adalah platform berbasis web yang dirancang untuk membantu pengguna memahami kondisi kesehatan mereka melalui teknologi Sistem Pakar. Dengan fitur unggulan seperti analisis gejala, deteksi kemungkinan penyakit, dan rekomendasi solusi, platform ini bertujuan untuk mempermudah pengambilan keputusan kesehatan dengan cepat dan tepat.
          </p>
            <a class="btn btn-primary" href="register.php" role="button">Ayo Mulai!</a>
          </div>
          <div class="col d-none d-sm-block">
            <img width="500" src="gambar/hero.png" alt="hero" />
          </div>
        </div>
      </div>
    </section>

    <section id="alur">
      <!--Content2-->
      <div id="konten2" class="container konten">
        <h2 style="font-weight: bold;text-align: center;">Alur Kerja Sistem Pakar Kebugaran Expert</h2>
        <div class="card-deck">
          <div class="card">
            <h5 class="card-title">Login</h5>
            <img src="gambar/login.png" class="card-img-top" alt="...">
            <div class="card-body">

              <p class="card-text">
              Pengguna perlu login terlebih dahulu untuk melanjutkan ke tahap berikutnya. Jika belum memiliki akun, mereka akan diarahkan ke halaman registrasi.
            </p>
            </div>
          </div>
          <div class="card">
            <h5 class="card-title">Test Gejala Pasien</h5>
            <img src="gambar/jawab.png" class="card-img-top" alt="...">
            <div class="card-body">
              <p class="card-text">Pada tahap ini, pengguna diminta untuk menjawab sejumlah pertanyaan terkait gejala yang sedang mereka rasakan.</p>
            </div>
          </div>
          <div class="card">
            <h5 class="card-title">Hasil dan Solusi</h5>
            <img src="gambar/hasil.png" class="card-img-top" alt="...">

            <div class="card-body">

              <p class="card-text">Tahap ini merupakan tahap terakhir, di mana pengguna akan mendapatkan hasil analisis setelah menjawab pertanyaan seputar gejala yang dialami. Hasil tersebut mencakup kemungkinan penyakit yang terdeteksi serta rekomendasi solusi yang disarankan.</p>
            </div>
          </div>
        </div>
      </div>
    </sect>

  </body>

  <script
    src="https://code.jquery.com/jquery-3.4.1.js"
    integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
    crossorigin="anonymous"
  ></script>
  <script
    src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous"
  ></script>
  <script
    src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"
  ></script>
  <script
    src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
    crossorigin="anonymous"
  ></script>
  <script>
  document.getElementById('login-form').addEventListener('submit', function (e) {
    const username = document.getElementById('nama').value.trim();
    const password = document.getElementById('password').value.trim();

    if (!username || !password) {
      e.preventDefault();
      document.getElementById('result').innerHTML = '<div class="alert alert-danger">Semua kolom harus diisi!</div>';
    }
  });
</script>

</html>
