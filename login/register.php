<!DOCTYPE html>
<html>

<?php
include '../koneksi.php';
include '../template/head.php'; ?>

<body class="hold-transition register-page">
    <div class="register-box">
        <div class="register-logo">
            <a href="../../index2.html"><b>Pelayanan</b> Pintar</a>
        </div>

        <div class="card">
            <div class="card-body register-card-body">

                <form action="register-aksi.php" method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Username" name="username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <!-- <label>Role</label> -->
                        <select class="form-control" name="role">
                            <option value="1">Master</option>
                            <option value="2">Asisten</option>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Retype password" name="password_verif">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Daftar</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <div class="social-auth-links text-center">
                    <p>- Atau -</p>
                    <a href="index" class="btn btn-block btn-info">
                        Masuk
                    </a>
                </div>

            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
    <!-- /.register-box -->

    <?php include '../template/script.php' ?>
    <script>
        // $(function() {
        //     //Initialize Select2 Elements
        //     $('.select2').select2()

        //     //Initialize Select2 Elements
        //     $('.select2bs4').select2({
        //         theme: 'bootstrap4'
        //     })
        // })
    </script>
</body>

</html>