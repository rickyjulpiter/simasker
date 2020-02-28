<!DOCTYPE html>
<html>

<?php
include '../koneksi.php';
include '../template/head.php'; ?>

<body class="hold-transition register-page">
  <div class="register-box">
    <div class="register-logo">
      <a href="../../index2.html">Aplikasi <br><b>Monitoring Masa Kerja</b></a>
    </div>

    <div class="card">
      <div class="card-body register-card-body">

        <form action="login-aksi" method="POST">
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Username" name="username" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Katasandi" name="password" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <!-- /.col -->
            <div class="col-12">
              <button type="submit" class="btn btn-primary btn-block">Masuk</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <!-- <div class="social-auth-links text-center">
          <p>- Atau -</p>
          <a href="register" class="btn btn-block btn-info">
            Daftar
          </a>
        </div> -->
      </div>
      <!-- /.form-box -->
    </div><!-- /.card -->
  </div>
  <!-- /.register-box -->

  <?php include '../template/script.php' ?>
</body>

</html>