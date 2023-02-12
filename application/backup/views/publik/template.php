<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>SIPEDAS</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <link rel="icon" type="image/png" href="<?php echo base_url('assets/images/icon.png'); ?>" />

    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="<?= base_url('assets/publik') ?>/css/one-page-parallax/app.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/select2/dist/css/select2.min.css">
    <!-- ================== END BASE CSS STYLE ================== -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
	<style>

        /* Extra small devices (phones, 600px and down) */
        @media only screen and (max-width: 600px) {  

            /* Your CSS Code for this device size */    
            .logo-simpeg {
                max-width: 360px;
            }

        }
</style>

</head>

<body style="min-height: 100vh;
  position: relative;
  margin: 0;" data-spy="scroll" data-target="#header" data-offset="51">
    <!-- begin #page-container -->
    <div id="page-container" class="fade">
        <!-- begin #header -->
        <div id="header" class="header navbar navbar-default navbar-fixed-top navbar-expand-lg">
            <!-- begin container -->
            <div class="container">
                <!-- begin navbar-brand -->
                <a href="#" class="navbar-brand">
                    <img src="<?= base_url('assets/publik') ?>/img/logo-2021.png" alt="">
                </a>
                <!-- end navbar-brand -->
                <!-- begin navbar-toggle -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#header-navbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- end navbar-toggle -->
                <!-- begin navbar-collapse -->
                <div class="collapse navbar-collapse" id="header-navbar">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="nav-item">
                            <a class="nav-link active" href="<?= site_url('Home') ?>">HOME</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="#struktur">STRUKTUR ORGANISASI</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= site_url('Akun/register') ?>">MUTASI ONLINE</a></li>
                        <?php if (empty($this->session->userdata('login'))) : ?>
                            <li class="nav-item"><a class="nav-link" href="<?= site_url('Akun') ?>">LOGIN</a></li>
                        <?php endif ?>
                        <?php if (!empty($this->session->userdata('login'))) : ?>
                            <li class="nav-item"><a class="nav-link" href="<?= site_url() ?>">ADMIN</a></li>
                        <?php endif ?>
                    </ul>
                </div>
                <!-- end navbar-collapse -->
            </div>
            <!-- end container -->
        </div>
        <!-- end #header -->

        <!-- //content  -->
        <?= $content ?>

        <!-- begin #footer -->
        <div id="foot" class="" style="height:10px;">
            <center>
    <strong>Copyright &copy; 2020 SIPEDAS.</strong> 
            </center>
        </div>
        <!-- end #footer -->


    </div>
    <!-- end #page-container -->

    <!-- ================== BEGIN BASE JS ================== -->
    <script src="<?= base_url('assets/publik') ?>/js/one-page-parallax/app.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>
    <!-- ================== END BASE JS ================== -->
    <script>
        $('.select2').select2();
    </script>
</body>

</html>