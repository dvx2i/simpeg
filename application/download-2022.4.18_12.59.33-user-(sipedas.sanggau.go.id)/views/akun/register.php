<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sistem Kepegawaian | Buat Akun</title>
    <link rel="icon" type="image/png" href="<?php echo base_url('assets/images/icon.png'); ?>" />
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/iCheck/square/blue.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition register-page">
<div class="register-box">
        <div class="register-logo">
            <!-- <img src="<?= base_url('assets/images/logo.png') ?>" class="img-responsive"/> -->
            <img src="<?= base_url('assets/publik') ?>/img/logo-2021.png" alt="" class="img-responsive">
        </div>
        <!-- /.login-logo -->
        <div class="register-box-body">
            <b><p class="register-box-msg">Buat Akun Mutasi Online</p></b>
            <form action="<?php echo base_url(); ?>Akun/save" id="form-register" method="POST">
            <div class="form-group has-feedback">
                <label for="">NIP <?php echo form_error('nip') ?></label>
                <input type="text" class="form-control" id="nip" name="nip" autocomplete="FALSE" placeholder="NIP">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                <span><button type="button" id="cek_nip" class="btn btn-sm btn-grey">Cek</button></span>
            </div>
            <div class="form-group has-feedback">
                <label for="">Nama Lengkap <?php echo form_error('nama') ?></label>
                <input type="text" class="form-control" id="nama" name="nama" autocomplete="FALSE" placeholder="Nama Lengkap">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <label for="">Username <?php echo form_error('username') ?></label>
                <input type="text" class="form-control" id="username" name="username" autocomplete="FALSE" placeholder="Username">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <label for="">Password <?php echo form_error('password') ?></label>
                <input type="password" class="form-control" id="password" name="password" autocomplete="FALSE" placeholder="Password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <label for="">Ketik Ulang Password <?php echo form_error('repassword') ?></label>
                <input type="password" class="form-control" id="repassword" name="repassword" autocomplete="FALSE" placeholder="Ketik ulang password">
                <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
            </div>
                <div class="row">
                    <div class="col-xs-4">

                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <input type="hidden" name="unit" id="unit" value="">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Buat Akun</button>
                    </div>
                    <div class="col-xs-4">

                    </div>
                    <!-- /.col -->
                </div>
            </form>


            <br />

            <center>
                <?php echo $this->session->flashdata('message'); ?>
            </center>
            <div class="social-auth-links text-center hide">
                <p>- OR -</p>
                <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
                    Facebook</a>
                <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
                    Google+</a>
            </div>
            <!-- /.social-auth-links -->


            <b>Sudah punya akun mutasi online? <a href="<?= site_url('Akun') ?>" class="text-center">Login</a></b>

        </div>
        <!-- /.register-box-body -->
    </div>
    <!-- /.register-box -->

    <!-- jQuery 3 -->
    <script src="<?= base_url() ?>/assets/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="<?= base_url() ?>/assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="<?= base_url() ?>/assets/plugins/iCheck/icheck.min.js"></script>
    <script>
        $(function() {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' /* optional */
            });
        });

        $('#cek_nip').on('click', function(){
            var settings = {
            "url": "<?= site_url('referensi/ReferensiJson/getPegawai') ?>/"+$('#nip').val(),
            "method": "POST",
            };

            $.ajax(settings).done(function (response) {
				obj_respon = jQuery.parseJSON(response);

                if(obj_respon.success == true){
                // console.log(obj_respon.success);
                var data = obj_respon.pegawai

				$('#nama').val(data.pegawai_nama);
				$('#username').val(data.pegawai_nip);
				$('#unit').val(data.pegawai_unit_id);

                }else{
                    // $('#form-register')[0].reset()
                    document.getElementById("form-register").reset();
                    alert('NIP tidak ditemukan')
                }
            });
        })
    </script>
</body>

</html>